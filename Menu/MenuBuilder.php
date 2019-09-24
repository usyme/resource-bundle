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

namespace Usyme\ResourceBundle\Menu;

use Usyme\ResourceBundle\Menu\Model\Item;
use Usyme\ResourceBundle\Menu\Model\Menu;
use Usyme\ResourceBundle\Menu\Model\MenuInterface;

abstract class MenuBuilder
{
    /**
     * @return MenuInterface
     */
    abstract protected function build(): MenuInterface;

    /**
     * @param Item[] $items
     *
     * @return MenuInterface
     */
    protected function createMenu(array $items = []): MenuInterface
    {
        return new Menu($items);
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return Item
     */
    protected function createItem(string $name, array $options = []): Item
    {
        return new Item($name, $options);
    }
}