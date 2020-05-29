<?php

namespace Library\Domain;

interface BookRepository
{
    public function add(Book $book);
}
