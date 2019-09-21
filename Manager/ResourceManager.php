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

namespace Usyme\ResourceBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Usyme\ResourceBundle\Factory\FactoryInterface;
use Usyme\ResourceBundle\Model\ResourceInterface;
use Usyme\ResourceBundle\Repository\RepositoryInterface;

class ResourceManager implements ResourceManagerInterface
{
    /**
     * @var RepositoryInterface
     */
    protected $repository;

    /**
     * @var FactoryInterface
     */
    protected $factory;

    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;

    /**
     * {@inheritDoc}
     */
    public function save(ResourceInterface $resource): void
    {
        if (null === $resource->getId()) {
            $this->entityManager->persist($resource);
        }

        $this->entityManager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function remove(ResourceInterface $resource): void
    {
        $this->repository->remove($resource);
    }

    /**
     * {@inheritDoc}
     */
    public function createInstance(): ResourceInterface
    {
        return $this->factory->createNew();
    }

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function setEntityManager(EntityManagerInterface $entityManager): void
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @param FactoryInterface $factory
     */
    public function setFactory(FactoryInterface $factory): void
    {
        $this->factory = $factory;
    }

    /**
     * @param RepositoryInterface $repository
     */
    public function setRepository(RepositoryInterface $repository): void
    {
        $this->repository = $repository;
    }
}