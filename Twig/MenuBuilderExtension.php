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

namespace Usyme\ResourceBundle\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Usyme\ResourceBundle\Menu\MenuBuilderInterface;
use Usyme\ResourceBundle\Menu\Model\MenuInterface;

class MenuBuilderExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('build_menu', [$this, 'build'])
        ];
    }

    /**
     * @param MenuBuilderInterface $menuBuilder
     *
     * @return MenuInterface
     */
    public function build(MenuBuilderInterface $menuBuilder): MenuInterface
    {
        return $menuBuilder->build();
    }
}