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

namespace Usyme\ResourceBundle\Factory;

use Usyme\ResourceBundle\Model\ResourceInterface;

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