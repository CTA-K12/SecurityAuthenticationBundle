<?php
namespace Mesd\Security\AuthenticationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use MESD\DoctrineExtensions\DependentFixtureBundle\DataFixtures\AbstractDependentFixture;
use Mesd\Security\AuthenticationBundle\Entity\AuthPDO;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthPDOFixtures extends AbstractDependentFixture implements ContainerAwareInterface
{
    static public $count;

    static public function getDependentOrder()
    {
        return max(array(
            AuthServiceFixtures::getDependentOrder(),
            )) + 1;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $i = 0;
        $referenceName = 'auth_pdo_';
        $authServices = $this->container->getParameter('auth_service');

        foreach($authServices as $authTypeName => $authType) {
            foreach($authType as $authServiceAlias => $authService) {
                if ('PDO' == $authTypeName) {
                    $object = new AuthPDO();
                    $this->addReference($referenceName . strtolower($authServiceAlias), $object);
                    $this->addReference($referenceName . $i, $object);
                    $i++;
                    $object->setDescription($authService['desc']);
                    $object->setUsername($authService['user']);
                    $object->setPassword($authService['pass']);
                    $object->setHost($authService['host']);
                    $object->setPortNumber($authService['port']);
                    $object->setDriver($authService['driver']);
                    $object->setDatabaseName($authService['db']);
                    $object->setTableName($authService['table']);
                    $object->setUsernameColumn($authService['ucol']);
                    $object->setPasswordColumn($authService['pcol']);
                    $object->setSaltColumn($authService['scol']);
                    $object->setPasswordCrypt($authService['pcrypt']);
                    $object->setAuthType($this->getReference('auth_type_' . strtolower($authTypeName)));
                    $manager->persist($object);
                }
            }
        }

        self::$count = $i;
        $manager->flush();
    }
}
