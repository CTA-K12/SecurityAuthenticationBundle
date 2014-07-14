<?php

namespace Mesd\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthPDO
 */
class AuthPDO extends AuthService
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
    private $driver;

    /**
     * @var string
     */
    private $databaseName;

    /**
     * @var string
     */
    private $tableName;

    /**
     * @var string
     */
    private $usernameColumn;

    /**
     * @var string
     */
    private $passwordColumn;


    /**
     * Set username
     *
     * @param string $username
     * @return AuthPDO
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
     * @return AuthPDO
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
     * @return AuthPDO
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
     * @return AuthPDO
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
     * Set driver
     *
     * @param string $driver
     * @return AuthPDO
     */
    public function setDriver($driver)
    {
        $this->driver = $driver;

        return $this;
    }

    /**
     * Get driver
     *
     * @return string
     */
    public function getDriver()
    {
        return $this->driver;
    }

    /**
     * Set databaseName
     *
     * @param string $databaseName
     * @return AuthPDO
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;

        return $this;
    }

    /**
     * Get databaseName
     *
     * @return string
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**
     * Set tableName
     *
     * @param string $tableName
     * @return AuthPDO
     */
    public function setTableName($tableName)
    {
        $this->tableName = $tableName;

        return $this;
    }

    /**
     * Get tableName
     *
     * @return string
     */
    public function getTableName()
    {
        return $this->tableName;
    }

    /**
     * Set usernameColumn
     *
     * @param string $usernameColumn
     * @return AuthPDO
     */
    public function setUsernameColumn($usernameColumn)
    {
        $this->usernameColumn = $usernameColumn;

        return $this;
    }

    /**
     * Get usernameColumn
     *
     * @return string
     */
    public function getUsernameColumn()
    {
        return $this->usernameColumn;
    }

    /**
     * Set passwordColumn
     *
     * @param string $passwordColumn
     * @return AuthPDO
     */
    public function setPasswordColumn($passwordColumn)
    {
        $this->passwordColumn = $passwordColumn;

        return $this;
    }

    /**
     * Get passwordColumn
     *
     * @return string
     */
    public function getPasswordColumn()
    {
        return $this->passwordColumn;
    }
    /**
     * @var string
     */
    private $saltColumn;

    /**
     * @var string
     */
    private $passwordCrypt;


    /**
     * Set saltColumn
     *
     * @param string $saltColumn
     * @return AuthPDO
     */
    public function setSaltColumn($saltColumn)
    {
        $this->saltColumn = $saltColumn;
    
        return $this;
    }

    /**
     * Get saltColumn
     *
     * @return string 
     */
    public function getSaltColumn()
    {
        return $this->saltColumn;
    }

    /**
     * Set passwordCrypt
     *
     * @param string $passwordCrypt
     * @return AuthPDO
     */
    public function setPasswordCrypt($passwordCrypt)
    {
        $this->passwordCrypt = $passwordCrypt;
    
        return $this;
    }

    /**
     * Get passwordCrypt
     *
     * @return string 
     */
    public function getPasswordCrypt()
    {
        return $this->passwordCrypt;
    }

    /**
     * Default __toString.  Customize to suit
     */
    public function __toString()
    {
        return 'PDO';
    }
    




















}