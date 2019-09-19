<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\Repository;

use Doctrine\Common\Persistence\ObjectRepository;
use Usyme\ResourceBundle\ResourceBundle\Model\ResourceInterface;

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