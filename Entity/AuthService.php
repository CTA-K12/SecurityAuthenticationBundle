<?php

namespace Mesd\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthService
 */
class AuthService
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $description;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $authUserService;

    /**
     * @var \Mesd\Security\AuthenticationBundle\Entity\AuthType
     */
    private $authType;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authUserService = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * Set description
     *
     * @param string $description
     * @return AuthService
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Add authUserService
     *
     * @param \Mesd\Security\AuthenticationBundle\Entity\AuthUserService $authUserService
     * @return AuthService
     */
    public function addAuthUserService(\Mesd\Security\AuthenticationBundle\Entity\AuthUserService $authUserService)
    {
        $this->authUserService[] = $authUserService;
    
        return $this;
    }

    /**
     * Remove authUserService
     *
     * @param \Mesd\Security\AuthenticationBundle\Entity\AuthUserService $authUserService
     */
    public function removeAuthUserService(\Mesd\Security\AuthenticationBundle\Entity\AuthUserService $authUserService)
    {
        $this->authUserService->removeElement($authUserService);
    }

    /**
     * Get authUserService
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAuthUserService()
    {
        return $this->authUserService;
    }

    /**
     * Set authType
     *
     * @param \Mesd\Security\AuthenticationBundle\Entity\AuthType $authType
     * @return AuthService
     */
    public function setAuthType(\Mesd\Security\AuthenticationBundle\Entity\AuthType $authType = null)
    {
        $this->authType = $authType;
    
        return $this;
    }

    /**
     * Get authType
     *
     * @return \Mesd\Security\AuthenticationBundle\Entity\AuthType 
     */
    public function getAuthType()
    {
        return $this->authType;
    }

    /**
     * Default __toString.  Customize to suit
     */
    public function __toString()
    {
        return $this->id."";
    }
    


}