<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\DependencyInjection\Compiler;

use Symfony\Component\Config\Definition\Processor;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Usyme\ResourceBundle\ResourceBundle\DependencyInjection\Configuration;

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