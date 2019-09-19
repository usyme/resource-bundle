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

namespace Usyme\ResourceBundle\ResourceBundle\Model;

use DateTimeInterface;

interface TimestampableInterface
{
    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $createdAt
     */
    public function setCreatedAt(DateTimeInterface $createdAt): void;

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): ?DateTimeInterface;

    /**
     * @param DateTimeInterface $updatedAt
     */
    public function setUpdatedAt(DateTimeInterface $updatedAt): void;
}