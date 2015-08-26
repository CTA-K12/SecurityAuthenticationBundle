<?php

namespace Mesd\Security\AuthenticationBundle\Entity;

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
     * @var Mesd\Security\AuthenticationBundle\Entity\AuthUser
     */
    private $authUser;

    /**
     * @var Mesd\Security\AuthenticationBundle\Entity\AuthUserService
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
     * @param Mesd\Security\AuthenticationBundle\Entity\AuthUser $authUser
     * @return AuthUserSetting
     */
    public function setAuthUser(\Mesd\Security\AuthenticationBundle\Entity\AuthUser $authUser = null)
    {
        $this->authUser = $authUser;

        return $this;
    }

    /**
     * Get authUser
     *
     * @return Mesd\Security\AuthenticationBundle\Entity\AuthUser
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * Set authUserService
     *
     * @param Mesd\Security\AuthenticationBundle\Entity\AuthUserService $authUserService
     * @return AuthUserSetting
     */
    public function setAuthUserService(\Mesd\Security\AuthenticationBundle\Entity\AuthUserService $authUserService = null)
    {
        $this->authUserService = $authUserService;

        return $this;
    }

    /**
     * Get authUserService
     *
     * @return Mesd\Security\AuthenticationBundle\Entity\AuthUserService
     */
    public function getAuthUserService()
    {
        return $this->authUserService;
    }
}