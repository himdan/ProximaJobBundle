<?php
/**
 * Created by PhpStorm.
 * User: chehimi
 * Date: 16/07/22
 * Time: 11:46 ص
 */

namespace Proxima\JobBundle;

use Symfony\Component\Config\Definition\Configurator\DefinitionConfigurator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Bundle\AbstractBundle;
use Proxima\JobBundle\Registry\DagConfigurator;

class ProximaJobBundle extends AbstractBundle
{
    public function getPath(): string
    {
        return __DIR__;
    }

    public function configure(DefinitionConfigurator $definition): void
    {
        $definition
            ->rootNode()
            ->children()
            ->arrayNode('dag')
            ->children()
            ->scalarNode('namespace')->end()
            ->scalarNode('root_path')->end()
            ->end()
            ->end()
            ->end();
        parent::configure($definition);
    }


}