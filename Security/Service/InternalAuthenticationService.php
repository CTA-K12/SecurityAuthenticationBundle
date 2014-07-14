<?php

namespace Mesd\Security\AuthenticationBundle\Security\Service;

use Symfony\Component\Security\Core\Encoder\MessageDigestPasswordEncoder;
use Symfony\Component\Security\Core\User\UserInterface;

class InternalAuthenticationService extends AbstractUniversalAuthenticationService
{

    /**
     * Constructor.
     *
     * @param UserInterface $user               A UserInterface interface
     * @param string        $postedPassword     A posted password
     */
    public function __construct(UserInterface $user, $postedPassword) {

        parent::__construct($user, $postedPassword);

    }


    public function authenticate() {

        $encoder = new MessageDigestPasswordEncoder('sha512');
        $password = $encoder->encodePassword('testadmin', $this->user->getSalt());

        return $this->postedPassword === $password;

    }





}
