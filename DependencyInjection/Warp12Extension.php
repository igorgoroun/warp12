<?php

namespace snakemkua\Warp12Bundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class Warp12Extension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        /*array_push($config['sidebarmenu'], [
            'showname' => 'Test3444',
            'mainroute' => 'warp',
            'materialicon' => 'folder'
        ]);*/
        $container->setParameter('warp12.modules', $config['modules']);
        //$container->register(WarpUserCreateCommand::class)->addTag('console.command', array('command'=>'warp:user:create'));
    }
}
