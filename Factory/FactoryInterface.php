<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\Factory;

use Usyme\ResourceBundle\ResourceBundle\Model\ResourceInterface;

interface FactoryInterface
{
    /**
     * Create a new resource instance.
     *
     * @return ResourceInterface
     */
    public function createNew(): ResourceInterface;
}