<?php
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