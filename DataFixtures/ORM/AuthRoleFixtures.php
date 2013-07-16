<?php
namespace MESD\Security\AuthenticationBundle\DataFixtures\ORM;

use Doctrine\Common\Persistence\ObjectManager;
use MESD\DoctrineExtensions\DependentFixtureBundle\DataFixtures\AbstractDependentFixture;
use MESD\Security\AuthenticationBundle\Entity\AuthRole;

class AuthRoleFixtures extends AbstractDependentFixture
{
    static public $count;

    public function load(ObjectManager $manager)
    {
        $i = 0;
        $referenceName = 'auth_role_';

        $object = new AuthRole();
        $this->addReference($referenceName . 'user', $object);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $object->setName('User');
        $object->setRole('ROLE_USER');
        $manager->persist($object);

        $object = new AuthRole();
        $this->addReference($referenceName . 'admin', $object);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $object->setName('Administrator');
        $object->setRole('ROLE_ADMIN');
        $manager->persist($object);

        $object = new AuthRole();
        $this->addReference($referenceName . 'superadmin', $object);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $object->setName('Super Administrator');
        $object->setRole('ROLE_SUPERADMIN');
        $object->addRoleElement($manager->merge($this->getReference('auth_role_admin')));
        $manager->persist($object);

        $objectA = new AuthRole();
        $this->addReference($referenceName . 'a', $objectA);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $objectA->setName('A -> _');
        $objectA->setRole('ROLE_A');
        $manager->persist($objectA);

        $objectB = new AuthRole();
        $this->addReference($referenceName . 'b', $objectB);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $objectB->setName('B -> C');
        $objectB->setRole('ROLE_B');
        $manager->persist($objectB);

        $objectC = new AuthRole();
        $this->addReference($referenceName . 'c', $objectC);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $objectC->setName('C -> D');
        $objectC->setRole('ROLE_C');
        $manager->persist($objectC);

        $objectD = new AuthRole();
        $this->addReference($referenceName . 'd', $objectD);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $objectD->setName('D -> B');
        $objectD->setRole('ROLE_D');
        $manager->persist($objectD);

        $objectE = new AuthRole();
        $this->addReference($referenceName . 'e', $objectE);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $objectE->setName('E -> B,F');
        $objectE->setRole('ROLE_E');
        $manager->persist($objectE);

        $objectF = new AuthRole();
        $this->addReference($referenceName . 'f', $objectF);
        $this->addReference($referenceName . $i, $object);
        $i++;
        $objectF->setName('F -> _');
        $objectF->setRole('ROLE_F');
        $manager->persist($objectF);

        $objectB->addRoleElement($manager->merge($this->getReference($referenceName . 'c')));
        $objectC->addRoleElement($manager->merge($this->getReference($referenceName . 'd')));
        $objectD->addRoleElement($manager->merge($this->getReference($referenceName . 'b')));
        $objectE->addRoleElement($manager->merge($this->getReference($referenceName . 'b')));
        $objectE->addRoleElement($manager->merge($this->getReference($referenceName . 'f')));
        $manager->persist($objectA);
        $manager->persist($objectB);
        $manager->persist($objectC);
        $manager->persist($objectD);
        $manager->persist($objectE);
        $manager->persist($objectF);

        self::$count = $i;
        $manager->flush();
    }
}
