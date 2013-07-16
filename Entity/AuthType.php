<?php

namespace MESD\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthType
 */
class AuthType
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $authService;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authService = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return AuthType
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add authService
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthService $authService
     * @return AuthType
     */
    public function addAuthService(\MESD\Security\AuthenticationBundle\Entity\AuthService $authService)
    {
        $this->authService[] = $authService;
    
        return $this;
    }

    /**
     * Remove authService
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthService $authService
     */
    public function removeAuthService(\MESD\Security\AuthenticationBundle\Entity\AuthService $authService)
    {
        $this->authService->removeElement($authService);
    }

    /**
     * Get authService
     *
     * @return \Doctrine\Common\Collections\Collection 
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
        return $this->id."";
    }
    


}