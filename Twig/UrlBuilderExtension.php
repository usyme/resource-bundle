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
use Usyme\ResourceBundle\Service\UsymeUrlService;

class UrlBuilderExtension extends AbstractExtension
{
    /**
     * @var UsymeUrlService
     */
    protected $urlService;

    /**
     * UrlBuilderExtension constructor.
     *
     * @param UsymeUrlService $urlService
     */
    public function __construct(UsymeUrlService $urlService)
    {
        $this->urlService = $urlService;
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('usyme_url_generate', [$this, 'generateUrl']),
            new TwigFunction('usyme_url_is_current', [$this, 'isCurrent']),
            new TwigFunction('usyme_url_query_has', [$this, 'queryHas'])
        ];
    }

    /**
     * @param array $parameters
     *
     * @return bool
     */
    public function queryHas(array $parameters = []): bool
    {
        return $this->urlService->queryHas($parameters);
    }

    /**
     * @param string $routeName
     * @param array  $parameters
     * @param bool   $keepQuery
     *
     * @return string
     */
    public function generateUrl(string $routeName, array $parameters, bool $keepQuery = false): string
    {
        return $this->urlService->generate($routeName, $parameters, $keepQuery);
    }

    /**
     * @param string $routeName
     * @param int    $depth
     *
     * @return bool
     */
    public function isCurrent(string $routeName, int $depth = 0): bool
    {
        return $this->urlService->isCurrent($routeName, $depth);
    }
}