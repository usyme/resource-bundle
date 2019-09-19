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

namespace Usyme\ResourceBundle\ResourceBundle\Controller;

use App\Entity\Post;
use App\Factory\PostFactory;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class PageController
{
    public function index(): Response
    {
        return new JsonResponse([
            'ping' => 'pong'
        ]);
    }
}