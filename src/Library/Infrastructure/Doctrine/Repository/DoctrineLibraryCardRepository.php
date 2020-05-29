<?php

namespace Library\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Library\Domain\LibraryCard;
use Library\Domain\LibraryCardRepository;

class DoctrineLibraryCardRepository implements LibraryCardRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(LibraryCard $libraryCard)
    {
        // TODO: Implement add() method.
    }

    public function find(string $readerEmail): ?LibraryCard
    {
        // TODO: Implement find() method.
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository(LibraryCard::class)->findAll();
    }
}
