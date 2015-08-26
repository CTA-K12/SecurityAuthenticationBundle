<?php
namespace Mesd\Security\AuthenticationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use Mesd\DoctrineExtensions\DependentFixtureBundle\DataFixtures\AbstractDependentFixture;
use Mesd\Security\AuthenticationBundle\Entity\AuthType;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class AuthTypeFixtures extends AbstractDependentFixture implements ContainerAwareInterface
{
    static public $count;

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        $i = 0;
        $referenceName = 'auth_type_';
        $authServices = $this->container->getParameter('auth_service');

        foreach ($authServices as $authTypeName => $authType) {
            $object = new AuthType();
            $this->addReference($referenceName . strtolower($authTypeName), $object);
            $this->addReference($referenceName . $i, $object);
            $i++;
            $object->setName($authTypeName);
            $manager->persist($object);
        }

        self::$count = $i;
        $manager->flush();
    }
}
