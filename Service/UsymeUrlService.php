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

namespace Usyme\ResourceBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Usyme\ResourceBundle\Service\Exception\UrlMaximumDepthException;

class UsymeUrlService
{
    /**
     * @var UrlGeneratorInterface
     */
    protected $urlGenerator;

    /**
     * @var RequestStack
     */
    protected $requestStack;

    /**
     * UrlService constructor.
     *
     * @param UrlGeneratorInterface $urlGenerator
     * @param RequestStack          $requestStack
     */
    public function __construct(UrlGeneratorInterface $urlGenerator, RequestStack $requestStack)
    {
        $this->urlGenerator = $urlGenerator;
        $this->requestStack = $requestStack;
    }

    /**
     * @param string $routeName
     * @param array  $parameters
     * @param bool   $keepQuery
     *
     * @return string
     */
    public function generate(string $routeName, array $parameters, bool $keepQuery = false): string
    {
        $request = $this->getCurrentRequest();

        if (true === $keepQuery) {
            // Add or override the existing parameters
            $parameters = array_merge($request->query->all(), $parameters);
        }

        return $this->urlGenerator->generate($routeName, $parameters);
    }

    /**
     * @param string $routeName
     * @param int    $depth
     *
     * @return bool
     */
    public function isCurrent(string $routeName, int $depth = 0): bool
    {
        $request          = $this->getCurrentRequest();
        $currentRouteName = $request->attributes->get('_route');

        if ($depth === 0) {
            return $currentRouteName === $routeName;
        }

        return $this->isSegmentsEquals(
            $this->getRouteSegments($currentRouteName),
            $this->getRouteSegments($routeName),
            $depth
        );
    }

    /**
     * @param array $parameters
     *
     * @return bool
     */
    public function queryHas($parameters = []): bool
    {
        $request = $this->getCurrentRequest();

        foreach ($parameters as $key => $value) {
            if ($request->query->get($key) !== $value) {
                return false;
            }
        }

        return true;
    }

    /**
     * @return Request
     */
    protected function getCurrentRequest(): Request
    {
        return $this->requestStack->getCurrentRequest();
    }

    /**
     * @param array $segmentOne
     * @param array $segmentTwo
     * @param int   $depth
     *
     * @return bool
     *
     * @throws UrlMaximumDepthException
     */
    private function isSegmentsEquals(array $segmentOne, array $segmentTwo, int $depth): bool
    {
        if (count($segmentOne) < $depth || count($segmentTwo) < $depth) {
            // We cannot compare here.
            throw new UrlMaximumDepthException($depth, $segmentOne, $segmentTwo);
        }

        for ($index = 0; $index < $depth; $index++) {
            if ($segmentOne[$index] !== $segmentTwo[$index]) {
                return false;
            }
        }

        return true;
    }

    /**
     * @param string $routeName
     *
     * @return array
     */
    private function getRouteSegments(string $routeName): array
    {
        return explode('_', $routeName);
    }
}