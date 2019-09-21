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

namespace Usyme\ResourceBundle\Manager;

use Usyme\ResourceBundle\Model\ResourceInterface;

interface ResourceManagerInterface
{
    /**
     * Save new or existing resource.
     *
     * @param ResourceInterface $resource
     */
    public function save(ResourceInterface $resource): void;

    /**
     * Remove resource.
     *
     * @param ResourceInterface $resource
     */
    public function remove(ResourceInterface $resource): void;

    /**
     * Create new instance object of resource.
     *
     * @return ResourceInterface
     */
    public function createInstance(): ResourceInterface;
}