<?php

namespace Library\Domain;

interface LibraryCardRepository
{
    public function add(LibraryCard $libraryCard);

    public function find(string $readerEmail): ?LibraryCard;
}
