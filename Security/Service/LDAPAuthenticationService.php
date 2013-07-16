<?php

namespace MESD\Security\AuthenticationBundle\Security\Service;

use Symfony\Component\Security\Core\User\UserInterface;


class LDAPAuthenticationService extends AbstractUniversalAuthenticationService
{

    /**
     * Constructor.
     *
     * @param UserInterface $user               A UserInterface interface
     * @param string        $postedPassword     A posted password
     */
    public function __construct(UserInterface $user, $postedPassword) {

        parent::__construct($user, $postedPassword);

    }


    public function authenticate() {
        $authenticated = false;
        $userService = $this->user
            ->getAuthUserSetting()
            ->getAuthUserService();
        $ldapService =  $userService
            ->getAuthService();
        $ldapHandle = ldap_connect($ldapService->getHost());
        if ($ldapHandle) {
            $bind = ldap_bind($ldapHandle);
            $filter = "(" . $ldapService->getFilter() . "=" . $userService->getUsername() . ")";
            $attrs = array("dn");
            $search = ldap_search($ldapHandle,$ldapService->getBaseDN(),$filter,$attrs);
            $list = ldap_get_entries($ldapHandle,$search);
            if ($list["count"] == "0") {
                ldap_close($ldapHandle);
                return false;
            }
            elseif ($list["count"] > "1") {
                ldap_close($ldapHandle);
                return false;
            }
            else {
                $ldap_dn = $list["0"]["dn"];
                $auth = @ldap_bind($ldapHandle, $ldap_dn, $this->postedPassword);
                ldap_close($ldapHandle);
                if($auth == "0") {
                    return false;
                }
                elseif($auth == "1") {
                    return true;
                }
                else {
                    return false;
                }
            }
        }
        else  {
            return false;
        }
    }





}
