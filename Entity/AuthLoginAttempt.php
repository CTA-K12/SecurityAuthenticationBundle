<?php

namespace Mesd\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthLoginAttempt
 */
class AuthLoginAttempt
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
     * @var \DateTime
     */
    private $loginTime;

    /**
     * @var boolean
     */
    private $successful;


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
     * @return AuthLoginAttempt
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
     * Set loginTime
     *
     * @param \DateTime $loginTime
     * @return AuthLoginAttempt
     */
    public function setLoginTime($loginTime)
    {
        $this->loginTime = $loginTime;

        return $this;
    }

    /**
     * Get loginTime
     *
     * @return \DateTime
     */
    public function getLoginTime()
    {
        return $this->loginTime;
    }

    /**
     * Set successful
     *
     * @param boolean $successful
     * @return AuthLoginAttempt
     */
    public function setSuccessful($successful)
    {
        $this->successful = $successful;

        return $this;
    }

    /**
     * Get successful
     *
     * @return boolean
     */
    public function getSuccessful()
    {
        return $this->successful;
    }
    /**
     * @var string $IPAddress
     */
    private $IPAddress;


    /**
     * Default __toString.  Customize to suit
     */
    public function __toString()
    {
        return $this->id."";
    }




    /**
     * Set IPAddress
     *
     * @param string $IPAddress
     * @return AuthLoginAttempt
     */
    public function setIPAddress($IPAddress)
    {
        $this->IPAddress = $IPAddress;

        return $this;
    }

    /**
     * Get IPAddress
     *
     * @return string
     */
    public function getIPAddress()
    {
        return $this->IPAddress;
    }






}