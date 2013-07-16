<?php

namespace MESD\Security\AuthenticationBundle\Entity;

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
     * @var \MESD\Security\AuthenticationBundle\Entity\AuthType
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
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthUserService $authUserService
     * @return AuthService
     */
    public function addAuthUserService(\MESD\Security\AuthenticationBundle\Entity\AuthUserService $authUserService)
    {
        $this->authUserService[] = $authUserService;
    
        return $this;
    }

    /**
     * Remove authUserService
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthUserService $authUserService
     */
    public function removeAuthUserService(\MESD\Security\AuthenticationBundle\Entity\AuthUserService $authUserService)
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
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthType $authType
     * @return AuthService
     */
    public function setAuthType(\MESD\Security\AuthenticationBundle\Entity\AuthType $authType = null)
    {
        $this->authType = $authType;
    
        return $this;
    }

    /**
     * Get authType
     *
     * @return \MESD\Security\AuthenticationBundle\Entity\AuthType 
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