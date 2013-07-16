<?php
namespace MESD\Security\AuthenticationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use MESD\DoctrineExtensions\DependentFixtureBundle\DataFixtures\AbstractDependentFixture;
use MESD\Security\AuthenticationBundle\Entity\AuthService;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthServiceFixtures extends AbstractDependentFixture implements ContainerAwareInterface
{
    static public $count;

    static public function getDependentOrder()
    {
        return max(array(
            AuthTypeFixtures::getDependentOrder(),
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
        $referenceName = 'auth_service_';
        $authServices = $this->container->getParameter('auth_service');

        foreach($authServices as $authTypeName => $authType) {
            foreach($authType as $authServiceAlias => $authService) {
                if ('Internal' == $authTypeName) {
                    $object = new AuthService();
                    $this->addReference($referenceName . strtolower($authServiceAlias), $object);
                    $this->addReference($referenceName . $i, $object);
                    $i++;
                    $object->setDescription($authService['desc']);
                    $object->setAuthType($this->getReference('auth_type_' . strtolower($authTypeName)));
                    $manager->persist($object);
                }
            }
        }

        self::$count = $i;
        $manager->flush();
    }
}
