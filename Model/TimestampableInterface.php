<?php
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