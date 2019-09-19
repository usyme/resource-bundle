<?php
declare(strict_types=1);

namespace Usyme\ResourceBundle\ResourceBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;
use Usyme\ResourceBundle\ResourceBundle\Model\ResourceInterface;

class ResourceRepository extends ServiceEntityRepository implements RepositoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function add(ResourceInterface $resource): void
    {
        $this->_em->persist($resource);
        $this->_em->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function remove(ResourceInterface $resource): void
    {
        if (null !== $this->find($resource->getId())) {
            $this->_em->remove($resource);
            $this->_em->flush();
        }
    }

    /**
     * {@inheritDoc}
     */
    public function createPaginator(array $criteria = [], array $sorting = []): iterable
    {
        $queryBuilder = $this->createQueryBuilder('o');

        $this->applyCriteria($queryBuilder, $criteria);
        $this->applySorting($queryBuilder, $sorting);

        return $this->getPaginator($queryBuilder);
    }

    /**
     * Get Pagerfanta doctrine paginator object.
     *
     * @param QueryBuilder $queryBuilder
     *
     * @return Pagerfanta
     */
    protected function getPaginator(QueryBuilder $queryBuilder): Pagerfanta
    {
        return new Pagerfanta(new DoctrineORMAdapter($queryBuilder, false, false));
    }

    /**
     * Apply criteria for a query builder object.
     *
     * @param QueryBuilder $queryBuilder
     * @param array        $criteria
     */
    protected function applyCriteria(QueryBuilder $queryBuilder, array $criteria = []): void
    {
        foreach ($criteria as $property => $value) {
            if (!$this->resourceHasProperty($property)) {
                continue;
            }

            $name = $this->getPropertyName($property);

            if (null === $value) {
                $queryBuilder->andWhere(
                    $queryBuilder->expr()->isNull($name)
                );
            } elseif (is_array($value)) {
                $queryBuilder->andWhere(
                    $queryBuilder->expr()->in($name, $value)
                );
            } elseif ('' !== $value) {
                $parameter = str_replace('.', '_', $property);
                $queryBuilder
                    ->andWhere(
                        $queryBuilder->expr()->eq($name, ':' . $parameter)
                    )
                    ->setParameter($parameter, $value);
            }
        }
    }

    /**
     * Apply sorting for a query builder object.
     *
     * @param QueryBuilder $queryBuilder
     * @param array        $sorting
     */
    protected function applySorting(QueryBuilder $queryBuilder, array $sorting = []): void
    {
        foreach ($sorting as $property => $order) {
            if (!$this->resourceHasProperty($property)) {
                continue;
            }

            if (!empty($order)) {
                $queryBuilder->addOrderBy($this->getPropertyName($property), $order);
            }
        }
    }

    /**
     * @param string $name
     *
     * @return string
     */
    protected function getPropertyName(string $name): string
    {
        if (false === strpos($name, '.')) {
            return 'o' . '.' . $name;
        }

        return $name;
    }

    /**
     * @param string $property
     *
     * @return bool
     */
    private function resourceHasProperty(string $property): bool
    {
        return in_array($property, array_merge($this->_class->getAssociationNames(), $this->_class->getFieldNames()), true);
    }
}