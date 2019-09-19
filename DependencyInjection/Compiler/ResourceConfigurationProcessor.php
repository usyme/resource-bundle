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

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Usyme\ResourceBundle\DependencyInjection\Configuration;

class ResourceConfigurationProcessor
{
    /**
     * @param ContainerBuilder $container
     *
     * @return array
     */
    public function processConfiguration(ContainerBuilder $container): array
    {
        $processor = new Processor();

        return $processor->processConfiguration(new Configuration(), $container->getExtensionConfig('usyme_resource'));
    }
}