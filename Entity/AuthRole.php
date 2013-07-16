<?php

namespace MESD\Security\AuthenticationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\Role\RoleInterface;

/**
 * AuthRole
 */
class AuthRole implements RoleInterface, \Serializable
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
     * @var string
     */
    private $role;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $authUser;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roleElement;

    /**
     * @var \Doctrine\Common\Collections\Collection
     */
    private $roleSet;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authUser = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roleElement = new \Doctrine\Common\Collections\ArrayCollection();
        $this->roleSet = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return AuthRole
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
     * Set role
     *
     * @param string $role
     * @return AuthRole
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Add authUser
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthUser $authUser
     * @return AuthRole
     */
    public function addAuthUser(\MESD\Security\AuthenticationBundle\Entity\AuthUser $authUser)
    {
        $this->authUser[] = $authUser;

        return $this;
    }

    /**
     * Remove authUser
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthUser $authUser
     */
    public function removeAuthUser(\MESD\Security\AuthenticationBundle\Entity\AuthUser $authUser)
    {
        $this->authUser->removeElement($authUser);
    }

    /**
     * Get authUser
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthUser()
    {
        return $this->authUser;
    }

    /**
     * Serializes the content of the current Role object
     *
     * @return string
     */
    public function serialize() {
        return \serialize(
            array( $this->role, $this->id ) );
    }

    /**
     * Unserializes the given string in the current Role object
     *
     * @param serialized
     */
    public function unserialize( $serialized ) {
        list( $this->role, $this->id ) = \unserialize(
            $serialized );
    }

    public function __toString()
    {
        return $this->getName();
    }

    /**
     * Add roleElement
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthRole $roleElement
     * @return AuthRole
     */
    public function addRoleElement(\MESD\Security\AuthenticationBundle\Entity\AuthRole $roleElement)
    {
        $this->roleElement[] = $roleElement;
        $roleElement->addRoleSet($this);

        return $this;
    }

    /**
     * Remove roleElement
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthRole $roleElement
     */
    public function removeRoleElement(\MESD\Security\AuthenticationBundle\Entity\AuthRole $roleElement)
    {
        $this->roleElement->removeElement($roleElement);
        $roleElement->removeRoleSet($this);
    }

    /**
     * Get roleElement
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoleElement()
    {
        return $this->roleElement;
    }

    /**
     * Add roleSet
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthRole $roleSet
     * @return AuthRole
     */
    public function addRoleSet(\MESD\Security\AuthenticationBundle\Entity\AuthRole $roleSet)
    {
        $this->roleSet[] = $roleSet;

        return $this;
    }

    /**
     * Remove roleSet
     *
     * @param \MESD\Security\AuthenticationBundle\Entity\AuthRole $roleSet
     */
    public function removeRoleSet(\MESD\Security\AuthenticationBundle\Entity\AuthRole $roleSet)
    {
        $this->roleSet->removeElement($roleSet);
    }

    /**
     * Get roleSet
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoleSet()
    {
        return $this->roleSet;
    }

    public function getRoles(&$singleDimension)
    {
        if (isset($singleDimension[$this->role])) {
            return;
        }
        $singleDimension[$this->role] = $this->role;
        foreach($this->roleElement as $authRole) {
            $authRole->getRoles($singleDimension);
        }
    }
}