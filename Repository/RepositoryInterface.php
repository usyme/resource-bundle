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

namespace Usyme\ResourceBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Usyme\ResourceBundle\Model\ResourceInterface;

interface RepositoryInterface extends ObjectRepository
{
    public const ORDER_ASC  = 'ASC';
    public const ORDER_DESC = 'DESC';

    /**
     * Create paginator iterator.
     *
     * @param array $criteria
     * @param array $sorting
     *
     * @return iterable
     */
    public function createPaginator(array $criteria = [], array $sorting = []): iterable;

    /**
     * Add resource to repository.
     *
     * @param ResourceInterface $resource
     */
    public function add(ResourceInterface $resource): void;

    /**
     * Remove resource from repository.
     *
     * @param ResourceInterface $resource
     */
    public function remove(ResourceInterface $resource): void;
}