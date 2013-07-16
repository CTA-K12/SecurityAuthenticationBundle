<?php

namespace MESD\Security\AuthenticationBundle\Security\Service;

use Symfony\Component\Security\Core\User\UserInterface;


/**
 * UniversalAuthenticationService authenticates users against
 * an authentication service.
 *
 */

abstract class AbstractUniversalAuthenticationService implements UniversalAuthenticationServiceInterface
{

    /**
     * @var UserInterface
     */
    protected $user;

    /**
     * @var postedPassword
     */
    protected $postedPassword;


    /**
     * Constructor.
     *
     * @param UserInterface $user               A UserInterface interface
     * @param string        $postedPassword     A posted password
     */
    public function __construct(UserInterface $user, $postedPassword)
    {
        $this->user           = $user;
        $this->postedPassword = $postedPassword;

    }


    public function authenticate()
    {

    }

}