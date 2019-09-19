<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\Model;

interface ResourceInterface
{
    /**
     * Get the resource ID.
     *
     * @return int
     */
    public function getId(): int;
}