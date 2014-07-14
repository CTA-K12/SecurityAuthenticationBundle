<?php

namespace Mesd\Security\AuthenticationBundle\Security\Authentication;

use Mesd\Security\AuthenticationBundle\Security\Service\LDAPAuthenticationService;
use Symfony\Component\Security\Core\Authentication\Provider\UserAuthenticationProvider;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\AuthenticationServiceException;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;


class UniversalAuthenticationProvider extends UserAuthenticationProvider
{
    /**
     * @var UserProviderInterface
     */
    private $userProvider;

    /**
     * Constructor.
     *
     * @param UserCheckerInterface  $userChecker                An UserCheckerInterface interface
     * @param string                $providerKey                A provider key
     * @param UserProviderInterface $userProvider               An UserProviderInterface interface
     * @param Boolean               $hideUserNotFoundExceptions Whether to hide user not found exception or not
     */
    public function __construct($userChecker, $providerKey, $userProvider, $hideUserNotFoundExceptions = true)
    {
        parent::__construct($userChecker, $providerKey, $hideUserNotFoundExceptions);

        $this->userProvider = $userProvider;
    }

    /**
     * {@inheritdoc}
     */
    protected function retrieveUser($username, UsernamePasswordToken $token)
    {
        $user = $token->getUser();
        if ($user instanceof UserInterface) {
            return $user;
        }

        try {
            $user = $this->userProvider->loadUserByUsername($username);

            return $user;
        } catch (UsernameNotFoundException $notFound) {
            throw $notFound;
        } catch (\Exception $repositoryProblem) {
            throw new AuthenticationServiceException($repositoryProblem->getMessage(), $token, 0, $repositoryProblem);
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function checkAuthentication(UserInterface $user, UsernamePasswordToken $token)
    {
        $currentUser = $token->getUser();

        if (!$postedPassword = $token->getCredentials()) {
            throw new BadCredentialsException('The password cannot be empty.');
        }

        $authServiceClass = 'Mesd\Security\AuthenticationBundle\Security\Service\\' .
                            $user
                            ->getAuthUserSetting()
                            ->getAuthUserService()
                            ->getAuthService()
                            ->getAuthType()
                            ->getName() . 'AuthenticationService';

        $authService = new $authServiceClass($user, $postedPassword);

        if (!$authService->authenticate($user, $postedPassword)) {
            throw new BadCredentialsException('The password is invalid.');
        }

    }
}