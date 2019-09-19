<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;

class UsymeResourceExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        // We'll use this method later to handle some prebuilt services depending
        // on the app configurations.
    }
}