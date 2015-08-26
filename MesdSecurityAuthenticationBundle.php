<?php

namespace Mesd\Security\AuthenticationBundle;

use Mesd\Security\AuthenticationBundle\Security\Factory\UniversalAuthenticationFactory;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;


class MesdSecurityAuthenticationBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $extension = $container->getExtension('security');
        $extension->addSecurityListenerFactory(new UniversalAuthenticationFactory());
    }

}
