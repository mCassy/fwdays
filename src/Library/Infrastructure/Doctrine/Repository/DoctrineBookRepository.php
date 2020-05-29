<?php

namespace Library\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Library\Domain\Book;
use Library\Domain\BookRepository;

class DoctrineBookRepository implements BookRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Book $book)
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function find(string $isbnNumber): ?Book
    {
        return $this->entityManager->getRepository(Book::class)->find($isbnNumber);
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->entityManager->getRepository(Book::class)->findAll();
    }
}
