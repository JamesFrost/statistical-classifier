<?php

namespace Camspiers\StatisticalClassifier\DependencyInjection;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

class CommandCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $application = $container->getDefinition('console.application');
        foreach ($container->findTaggedServiceIds('console.command') as $id => $tags) {
            foreach ($tags as $tag) {
                $application->addMethodCall(
                    'add',
                    array(
                        new Reference($id)
                    )
                );
            }
        }
        foreach ($container->findTaggedServiceIds('console.cacheable_command') as $id => $tags) {
            foreach ($tags as $tag) {
                $application->addMethodCall(
                    'add',
                    array(
                        new Reference($id)
                    )
                );
                $container->getDefinition($id)->addMethodCall(
                    'setCache',
                    array(
                        new Reference('cache')
                    )
                );
            }
        }
    }
}