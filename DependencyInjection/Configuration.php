<?php

namespace Armetiz\FacebookBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('armetiz_facebook');

        $rootNode
            ->children()
                ->booleanNode ("enabled")
                    ->defaultTrue()
                ->end()
                ->arrayNode("sdk")
                    ->requiresAtLeastOneElement()
                    ->useAttributeAsKey('name')
                    ->prototype('array')
                        ->children()
                            ->scalarNode("app_id")
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->scalarNode("secret")
                            ->isRequired()
                            ->cannotBeEmpty()
                        ->end()
                        ->booleanNode ("enabled")
                            ->defaultTrue()
                        ->end()
                        ->booleanNode("default")
                            ->defaultFalse()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
