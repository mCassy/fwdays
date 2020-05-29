<?php

namespace Library\Domain;

interface BookRepository
{
    public function add(Book $book);

    public function find(string $isbnNumber): ?Book;
}
