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

use Usyme\ResourceBundle\Menu\Helper\Str;

class Item
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var array
     */
    protected $options;

    /**
     * Item constructor.
     *
     * @param string $name
     * @param array  $options
     */
    public function __construct(string $name, array $options = [])
    {
        $this->name    = $name;
        $this->options = $options;
    }

    /**
     * @param string $currentRoute
     *
     * @return bool
     */
    public function isActive(string $currentRoute): bool
    {
        $routes = $this->getRoutes();

        foreach ($routes as $route) {
            if (strpos($route, '*') !== false) {
                $partName = str_replace('*', '', $route);

                if (Str::startsWith($currentRoute, $partName)) {
                    return true;
                }
            }
        }

        foreach ($this->getChildren() as $child) {
            $routes = array_merge($routes, $child->getRoutes());
        }

        return in_array($currentRoute, $routes, true);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getIcon(): ?string
    {
        return $this->getOption('icon');
    }

    /**
     * @return string[]
     */
    public function getRoutes(): array
    {
        return $this->getOption('routes', []);
    }

    /**
     * @return string|null
     */
    public function getFirstRoute(): ?string
    {
        if (!empty($routes = $this->getRoutes())) {
            return $routes[0];
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasDivider(): bool
    {
        return $this->getOption('divider', false);
    }

    /**
     * @return bool
     */
    public function hasChildren(): bool
    {
        return !empty($this->getChildren());
    }

    /**
     * @return Item[]
     */
    public function getChildren(): array
    {
        return $this->getOption('children', []);
    }

    /**
     * @param string $key
     * @param        $default
     *
     * @return mixed
     */
    public function getOption(string $key, $default = null)
    {
        if (array_key_exists($key, $this->options)) {
            return $this->options[$key];
        }

        return $default;
    }
}