<?php

namespace Library\Infrastructure\InMemory\Repository;

use Library\Domain\LibraryCard;
use Library\Domain\LibraryCardRepository;

class InMemoryLibraryCardRepository implements LibraryCardRepository
{
    private $libraryCards = [];

    public function add(LibraryCard $libraryCard)
    {
        $this->libraryCards[$libraryCard->getEmail()] = $libraryCard;
    }

    public function find(string $readerEmail): ?LibraryCard
    {
        if (array_key_exists($readerEmail, $this->libraryCards)) {
            return $this->libraryCards[$readerEmail];
        }

        return null;
    }
}
