<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\Factory;

use Usyme\ResourceBundle\ResourceBundle\Model\ResourceInterface;

class ResourceFactory implements FactoryInterface
{
    /**
     * @var string
     */
    protected $className;

    /**
     * ResourceFactory constructor.
     *
     * @param string $className
     */
    public function __construct(string $className)
    {
        $this->className = $className;
    }

    /**
     * {@inheritDoc}
     */
    public function createNew(): ResourceInterface
    {
        return new $this->className();
    }
}