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

namespace Usyme\ResourceBundle\Service\Exception;

use Exception;
use Throwable;

class UrlMaximumDepthException extends Exception
{
    /**
     * UrlMaximumDepthException constructor.
     *
     * @param int            $depth
     * @param array          $segmentOne
     * @param array          $segmentTwo
     * @param int            $code
     * @param Throwable|null $previous
     */
    public function __construct(int $depth, array $segmentOne, array $segmentTwo, $code = 0, Throwable $previous = null)
    {
        $message = sprintf('Cannot compare two segments (%d, %d) with greater depth (%d)',
            count($segmentOne),
            count($segmentTwo),
            $depth);

        parent::__construct($message, $code, $previous);
    }
}