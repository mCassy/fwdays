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
}
