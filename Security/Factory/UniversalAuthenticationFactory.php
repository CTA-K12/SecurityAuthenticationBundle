<?php

namespace MESD\Security\AuthenticationBundle\Security\Factory;

use Symfony\Bundle\SecurityBundle\DependencyInjection\Security\Factory\SecurityFactoryInterface;
use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Symfony\Component\DependencyInjection\Reference;

class UniversalAuthenticationFactory implements SecurityFactoryInterface
{
    public function create(ContainerBuilder $container, $id, $config, $userProvider, $defaultEntryPointId)
    {

        $providerId = 'security.authentication.provider.universal_auth.'.$id;
        $container
            ->setDefinition($providerId, new DefinitionDecorator('security.authentication.provider.universal_auth'))
            ->replaceArgument(1, $id)
            ->replaceArgument(2, new Reference($userProvider))
        ;

        $listenerId = 'security.authentication.listener.form.'. $id;
        $listener = $container->setDefinition($listenerId, new DefinitionDecorator('security.authentication.listener.form'));

        return array($providerId, $listenerId, $defaultEntryPointId);
    }

    public function getPosition()
    {
        return 'pre_auth';
    }

    public function getKey()
    {
        return 'universal_auth';
    }

    public function addConfiguration(NodeDefinition $node)
    {
        // Without Configurationuser
    }

}