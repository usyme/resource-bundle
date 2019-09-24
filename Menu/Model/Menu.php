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

namespace Usyme\ResourceBundle\Menu\Model;

class Menu implements MenuInterface
{
    /**
     * @var Item[]
     */
    protected $items;

    /**
     * Menu constructor.
     *
     * @param Item[] $items
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * @param Item $item
     *
     * @return MenuInterface
     */
    public function addItem(Item $item): MenuInterface
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param string $name
     * @param        $options
     *
     * @return MenuInterface
     */
    public function add(string $name, array $options = []): MenuInterface
    {
        return $this->addItem(new Item($name, $options));
    }
}