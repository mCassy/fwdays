<?php

namespace Library\Infrastructure\InMemory\Repository;

use Library\Domain\Book;
use Library\Domain\BookRepository;

class InMemoryBookRepository implements BookRepository
{
    private $books = [];

    public function add(Book $book)
    {
        $this->books[$book->getIsbn()] = $book;
    }

    public function find(string $isbnNumber): ?Book
    {
        if (array_key_exists($isbnNumber, $this->books)) {
            return $this->books[$isbnNumber];
        }

        return null;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->books;
    }
}
