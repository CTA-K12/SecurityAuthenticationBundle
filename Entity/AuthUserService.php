<?php

namespace Mesd\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthUserService
 */
class AuthUserService
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $username;

    /**
     * @var \Mesd\Security\AuthenticationBundle\Entity\AuthUser
     */
    private $authUser;

    /**
     * @var \Mesd\Security\AuthenticationBundle\Entity\AuthService
     */
    private $authService;

    /**
     * @var \Doctrine\Common\Collections\ArrayCollection
     */
    private $authUserSetting;


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
     * Set username
     *
     * @param string $username
     * @return AuthUserService
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set authUser
     *
     * @param \Mesd\Security\AuthenticationBundle\Entity\AuthUser $authUser
     * @return AuthUserService
     */
    public function setAuthUser(\Mesd\Security\AuthenticationBundle\Entity\AuthUser $authUser = null)
    {
        $this->authUser = $authUser;

        return $this;
    }

    /**
     * Get authUser
     *
     * @return \Mesd\Security\AuthenticationBundle\Entity\AuthUser
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * Set authService
     *
     * @param \Mesd\Security\AuthenticationBundle\Entity\AuthService $authService
     * @return AuthUserService
     */
    public function setAuthService(\Mesd\Security\AuthenticationBundle\Entity\AuthService $authService = null)
    {
        $this->authService = $authService;

        return $this;
    }

    /**
     * Get authService
     *
     * @return \Mesd\Security\AuthenticationBundle\Entity\AuthService
     */
    public function getAuthService()
    {
        return $this->authService;
    }

    /**
     * Default __toString.  Customize to suit
     */
    public function __toString()
    {
        return (string)$this->getId();
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authUserSetting = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add authUserSetting
     *
     * @param Mesd\Security\AuthenticationBundle\Entity\AuthUserSetting $authUserSetting
     * @return AuthUserService
     */
    public function addAuthUserSetting(\Mesd\Security\AuthenticationBundle\Entity\AuthUserSetting $authUserSetting)
    {
        $this->authUserSetting[] = $authUserSetting;

        return $this;
    }

    /**
     * Remove authUserSetting
     *
     * @param Mesd\Security\AuthenticationBundle\Entity\AuthUserSetting $authUserSetting
     */
    public function removeAuthUserSetting(\Mesd\Security\AuthenticationBundle\Entity\AuthUserSetting $authUserSetting)
    {
        $this->authUserSetting->removeElement($authUserSetting);
    }

    /**
     * Get authUserSetting
     *
     * @return Doctrine\Common\Collections\Collection
     */
    public function getAuthUserSetting()
    {
        return $this->authUserSetting;
    }
}