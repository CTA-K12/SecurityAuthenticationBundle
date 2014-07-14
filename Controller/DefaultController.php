<?php

namespace Mesd\Security\AuthenticationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {

        $rep = $this->getDoctrine()->getManager()->getRepository('MesdSecurityAuthenticationBundle:AuthService');
        $services = $rep->findAll();
        array_map(function($service) {
            var_dump(get_class($service));
        }, $services);
        $rep = $this->getDoctrine()->getManager()->getRepository('MesdSecurityAuthenticationBundle:AuthLDAP');
        $ldaps = $rep->findAll();
        $rep = $this->getDoctrine()->getManager()->getRepository('MesdSecurityAuthenticationBundle:AuthPDO');
        $pdos = $rep->findAll();

        return $this->render('MesdSecurityAuthenticationBundle:Default:index.html.twig', array('entitiess' => array($services, $ldaps, $pdos)));
    }
}
