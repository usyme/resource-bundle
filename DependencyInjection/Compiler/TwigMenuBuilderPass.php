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

class TwigMenuBuilderPass extends ResourceConfigurationProcessor implements CompilerPassInterface
{
    /**
     * {@inheritDoc}
     */
    public function process(ContainerBuilder $container): void
    {
        if (!$container->has('twig')) {
            return;
        }

        $config = $this->processConfiguration($container)['menus'];

        foreach ($config as $menuName => $menuClass) {
            // Save the menus as globals
            $container->getDefinition('twig')
                ->addMethodCall('addGlobal', [$menuName, new Reference($menuClass)]);
        }
    }
}