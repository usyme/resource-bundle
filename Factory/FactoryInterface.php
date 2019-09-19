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