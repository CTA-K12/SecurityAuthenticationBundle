<?php

namespace Mesd\Security\AuthenticationBundle\Controller;

use Mesd\Security\AuthenticationBundle\Entity\AuthLoginAttempt;
use Mesd\Security\AuthenticationBundle\Entity\AuthUser;
use Mesd\Security\AuthenticationBundle\Entity\AuthUserService;
use Mesd\Security\AuthenticationBundle\Entity\AuthUserSetting;
use Mesd\Security\AuthenticationBundle\FormType\ChangePasswordType;
use Mesd\Security\AuthenticationBundle\FormType\RegisterType;
use Mesd\Security\AuthenticationBundle\FormType\ResetPasswordType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction()
    {
        $securityContext = $this->get('security.context');
        $lastUsername = $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME);
        if ($securityContext->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl($this->container->getParameter('login_alias')));
        }
        if (!(is_null($lastUsername))) {
            $em = $this->getDoctrine()->getManager();
            $loginAttempt = new AuthLoginAttempt();
            $loginAttempt->setUsername($lastUsername);
            $loginAttempt->setIPAddress($this->container->get('request')->server->get('REMOTE_ADDR'));
            $loginAttempt->setLoginTime(new \DateTime());
            $loginAttempt->setSuccessful(false);
            $em->persist($loginAttempt);
            $em->flush();
        }

        if ($this->get('request')->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $this->get('request')->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $this->get('request')->getSession()->get(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('MESDSecurityAuthenticationBundle:Security:login.html.twig'
            ,array(
                'last_username' => $lastUsername,
                'error' => $error
                )
            );
    }

    /**
    * @Template()
    *
    */

    public function registerAction(Request $request)
    {
        $form = $this->createForm(new RegisterType($this->container->getParameter('user_path')));

        if ($request->isMethod('POST')) {
            $form->bind($request);
            if ($form->isValid()) {
                $authUser = $form->getData();

                $factory = $this->get('security.encoder_factory');
                $authUser->encodePassword($factory->getEncoder($authUser));
                $authUser->setPasswordDate(new \DateTime());
                $authUser->setUsername($authUser->getEmail());

                $em = $this->getDoctrine()->getManager();
                $authRole = $em->getRepository('MESDSecurityAuthenticationBundle:AuthRole')->findOneByRole('ROLE_USER');
                $authUser->addAuthRole($authRole);
                $em->persist($authUser);

                $authUserService = new AuthUserService();
                $authUserService->setUsername('');
                $authUserService->setAuthUser($authUser);
                $authService = $em->getRepository('MESDSecurityAuthenticationBundle:AuthService')->findOneByDescription('Band Camp');
                $authUserService->setAuthService($authService);
                $em->persist($authUserService);

                $authUserSetting = new AuthUserSetting();
                $authUserSetting->setAuthUser($authUser);
                $authUserSetting->setAuthUserService($authUserService);
                $em->persist($authUserSetting);

                $em->flush();

                $token = new UsernamePasswordToken($authUser, null, 'main', $authUser->getRoles());
                $this->get('security.context')->setToken($token);

                return $this->redirect($this->generateUrl('login'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
    * @Template()
    *
    */

    public function resetPasswordAction(Request $request)
    {

        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $email = $data['_username'];

            $verification = sha1(uniqid(mt_rand(0, 999999) . $email));
            $emailTime = new \DateTime();
            $verifyExpiration = new \DateTime();
            $verifyExpiration->add(new \DateInterval('PT30M'));

            $em = $this->getDoctrine()->getManager();
            $authUser = $em->getRepository('MESDSecurityAuthenticationBundle:AuthUser')->findOneByEmail($email);

            if (null != $authUser) {
                $authUser->setVerification($verification);
                $authUser->setVerifyExpiration($verifyExpiration);
                $em->persist($authUser);
                $em->flush();

                $body = $this->renderView('MESDSecurityAuthenticationBundle:Security:resetEmail.html.twig', array(
                    'verification' => $verification,
                    'email' => $authUser->getEmail(),
                    'sent' => $emailTime->format('g:ia'),
                    'expire' => $verifyExpiration->format('g:ia'),
                    ));

                $message = \Swift_Message::newInstance()
                ->setSubject('Reset Password')
                ->setFrom('noreply@mesd.k12.or.us')
                ->setTo($authUser->getEmail())
                ->setBody($body, 'text/html')
                ;
                $this->get('mailer')->send($message);
                return $this->redirect($this->generateUrl('check_email'));
            }
            return $this->redirect($this->generateUrl('does_not_exist'));
        }

        return array(
            'last_username' => $this->get('request')->getSession()->get(SecurityContext::LAST_USERNAME),
            );
    }

    /**
    * @Template()
    *
    */

    public function doesNotExistAction(Request $request) {
        return array(
            );
    }

    public function verifyAction(Request $request, $email, $verification)
    {
        $em = $this->getDoctrine()->getManager();
        $authUser = $em->getRepository('MESDSecurityAuthenticationBundle:AuthUser')->findOneByEmail($email);
        if (($authUser->getVerification() === $verification) && ($authUser->getVerifyExpiration() > new \DateTime()))
        {
            $authUser->setVerifyExpiration(new \DateTime());
            $em = $this->getDoctrine()->getManager();
            $em->persist($authUser);
            $em->flush();
            $token = new UsernamePasswordToken($authUser, null, 'main', $authUser->getRoles());
            $this->get('security.context')->setToken($token);
            return $this->redirect($this->generateUrl('change_password'));
        }

        return $this->redirect($this->generateUrl('check_email'));
    }

    /**
    * @Template()
    *
    */

    public function changePasswordAction(Request $request)
    {
        $form = $this->createForm(new ChangePasswordType());
        $authUser = $this->getUser();

        if ($request->isMethod('POST')) {
            $form->setData($authUser);
            $form->bind($request);
            if ($form->isValid()) {
                $data = $form->getData();
                $authUser->setRawPassword($data->getRawPassword());

                $factory = $this->get('security.encoder_factory');
                $authUser->encodePassword($factory->getEncoder($authUser));
                $authUser->setPasswordDate(new \DateTime());

                $em = $this->getDoctrine()->getManager();
                $em->persist($authUser);
                $em->flush();

                return $this->redirect($this->generateUrl('login'));
            }
        }

        return array('form' => $form->createView());
    }

    /**
    * @Template()
    *
    */

    public function checkEmailAction(Request $request)
    {
    }
}
