<?php
/**
 * This file is part of the Usyme, ResourceBundle package.
 *
 * (c) Mohamed Radhi GUENNICHI <rg@mate.tn> <+216 50 711 816>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Usyme\ResourceBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Usyme\ResourceBundle\Factory\ResourceFactory;

class ResourceRegistryPass extends ResourceConfigurationProcessor implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($container);

        foreach ($config['resources'] as $resource => $metadata) {
            $classes = $metadata['classes'];
            // Build factory
            $this->registerFactory($container, $resource, $classes);
            // Build repository
            $this->registerRepository($container, $resource, $classes);
            // Build manager
            $this->registerManager($container, $resource, $classes);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $resource
     * @param array            $classes
     */
    public function registerManager(ContainerBuilder $container, string $resource, array $classes): void
    {
        if (!array_key_exists('manager', $classes)) {
            return;
        }

        $managerId = sprintf('usyme.resources.%s.manager', $resource);

        $container
            ->register($managerId, $classes['manager'])
            ->addMethodCall('setEntityManager', [new Reference('doctrine.orm.entity_manager')])
            ->addMethodCall('setRepository', [new Reference($classes['repository'])])
            ->addMethodCall('setFactory', [new Reference($classes['factory'])])
            ->setAutowired(true);

        $container->setAlias($classes['manager'], $managerId);
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $resource
     * @param array            $classes
     */
    protected function registerFactory(ContainerBuilder $container, string $resource, array $classes): void
    {
        $baseFactoryId = sprintf('usyme.resources.%s.factory.base', $resource);

        $container
            ->register($baseFactoryId, ResourceFactory::class)
            ->addArgument($classes['model']);

        if (array_key_exists('factory', $classes)) {
            $factoryId = sprintf('usyme.resources.%s.factory', $resource);

            $container
                ->register($factoryId, $classes['factory'])
                ->addArgument(new Reference($baseFactoryId))
                ->setAutowired(true);

            $container->setAlias($classes['factory'], $factoryId);
        }
    }

    /**
     * @param ContainerBuilder $container
     * @param string           $resource
     * @param array            $classes
     */
    protected function registerRepository(ContainerBuilder $container, string $resource, array $classes): void
    {
        $repositoryId = sprintf('usyme.resources.%s.repository', $resource);
        $container
            ->register($repositoryId, $classes['repository'])
            ->addArgument(new Reference('doctrine'))
            ->addArgument($classes['model'])
            ->setAutowired(true);

        $container->setAlias($classes['repository'], $repositoryId);
    }
}