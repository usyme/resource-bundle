<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Usyme\ResourceBundle\ResourceBundle\DependencyInjection\Compiler\ResourceRegistryPass;

class UsymeResourceBundle extends Bundle
{
    /**
     * {@inheritDoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new ResourceRegistryPass());
    }
}