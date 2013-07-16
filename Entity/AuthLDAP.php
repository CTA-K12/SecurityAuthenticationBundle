<?php

namespace MESD\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthLDAP
 */
class AuthLDAP extends AuthService
{
    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $host;

    /**
     * @var integer
     */
    private $portNumber;

    /**
     * @var string
     */
    private $filter;


    /**
     * Set username
     *
     * @param string $username
     * @return AuthLDAP
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
     * Set password
     *
     * @param string $password
     * @return AuthLDAP
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set host
     *
     * @param string $host
     * @return AuthLDAP
     */
    public function setHost($host)
    {
        $this->host = $host;

        return $this;
    }

    /**
     * Get host
     *
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * Set portNumber
     *
     * @param integer $portNumber
     * @return AuthLDAP
     */
    public function setPortNumber($portNumber)
    {
        $this->portNumber = $portNumber;

        return $this;
    }

    /**
     * Get portNumber
     *
     * @return integer
     */
    public function getPortNumber()
    {
        return $this->portNumber;
    }

    /**
     * Set filter
     *
     * @param string $filter
     * @return AuthLDAP
     */
    public function setFilter($filter)
    {
        $this->filter = $filter;

        return $this;
    }

    /**
     * Get filter
     *
     * @return string
     */
    public function getFilter()
    {
        return $this->filter;
    }
    /**
     * @var string
     */
    private $baseDN;


    /**
     * Set baseDN
     *
     * @param string $baseDN
     * @return AuthLDAP
     */
    public function setBaseDN($baseDN)
    {
        $this->baseDN = $baseDN;
    
        return $this;
    }

    /**
     * Get baseDN
     *
     * @return string 
     */
    public function getBaseDN()
    {
        return $this->baseDN;
    }

    /**
     * Default __toString.  Customize to suit
     */
    public function __toString()
    {
        return parent::getDescription();
    }
    










}