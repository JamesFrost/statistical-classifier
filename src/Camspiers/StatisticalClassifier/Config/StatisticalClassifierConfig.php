<?php

/**
 * This file is part of the Statistical Classifier package.
 *
 * (c) Cam Spiers <camspiers@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Camspiers\StatisticalClassifier\Config;

use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;

/**
 * @author  Cam Spiers <camspiers@gmail.com>
 * @package Statistical Classifier
 */
class StatisticalClassifierConfig implements ConfigurationInterface
{
    /**
     * Return a TreeBuilder to validate configs against
     * @return TreeBuilder An instance of Treebuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('config');

        $replaceCPath = function ($path) {
            return str_replace('%CLASSIFIER_PATH%', CLASSIFIER_PATH, $path);
        };

        $rootNode
            ->children()
            ->scalarNode('container_dir')
            ->beforeNormalization()
            ->always()
            ->then(
                function ($value) {
                    return rtrim($value, '/');
                }
            )
            ->then($replaceCPath)
            ->end()
            ->end()
            ->scalarNode('services_path')
            ->beforeNormalization()
            ->always()
            ->then($replaceCPath)
            ->end()
            ->end()
            ->scalarNode('container_class')->end()
            ->arrayNode('require')
            ->defaultValue(array())
            ->prototype('scalar')->end()
            ->end()
            ->arrayNode('extensions')
            ->defaultValue(array())
            ->prototype('scalar')->end()
            ->end()
            ->arrayNode('compiler_passes')
            ->defaultValue(array())
            ->prototype('scalar')->end()
            ->end()
            ->variableNode('parameters')
            ->end()
            ->end();

        return $treeBuilder;
    }
}
