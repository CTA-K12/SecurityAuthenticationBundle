<?php

namespace MESD\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUserSetting
 */
class AuthUserSetting
{
    /**
     * @var integer
     */
    private $id;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * @var MESD\Security\AuthenticationBundle\Entity\AuthUser
     */
    private $authUser;

    /**
     * @var MESD\Security\AuthenticationBundle\Entity\AuthUserService
     */
    private $authUserService;


    /**
     * Default __toString.  Customize to suit
     */
    public function __toString()
    {
        return (string)$this->getId();
    }


    /**
     * Set authUser
     *
     * @param MESD\Security\AuthenticationBundle\Entity\AuthUser $authUser
     * @return AuthUserSetting
     */
    public function setAuthUser(\MESD\Security\AuthenticationBundle\Entity\AuthUser $authUser = null)
    {
        $this->authUser = $authUser;

        return $this;
    }

    /**
     * Get authUser
     *
     * @return MESD\Security\AuthenticationBundle\Entity\AuthUser
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * Set authUserService
     *
     * @param MESD\Security\AuthenticationBundle\Entity\AuthUserService $authUserService
     * @return AuthUserSetting
     */
    public function setAuthUserService(\MESD\Security\AuthenticationBundle\Entity\AuthUserService $authUserService = null)
    {
        $this->authUserService = $authUserService;

        return $this;
    }

    /**
     * Get authUserService
     *
     * @return MESD\Security\AuthenticationBundle\Entity\AuthUserService
     */
    public function getAuthUserService()
    {
        return $this->authUserService;
    }
}