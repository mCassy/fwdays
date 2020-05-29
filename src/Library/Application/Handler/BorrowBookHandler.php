<?php

namespace Library\Application\Handler;

use Library\Application\Command\BorrowBook;
use Library\Domain\BookRepository;
use Library\Domain\LibraryCardRepository;

class BorrowBookHandler
{
    /**
     * @var BookRepository
     */
    private BookRepository $bookRepository;
    /**
     * @var LibraryCardRepository
     */
    private LibraryCardRepository $libraryCardRepository;

    public function __construct(
        BookRepository $bookRepository,
        LibraryCardRepository $libraryCardRepository
    ) {
        $this->bookRepository = $bookRepository;
        $this->libraryCardRepository = $libraryCardRepository;
    }

    public function handle(BorrowBook $command)
    {
        $book = $this->bookRepository->find($command->getIsbnNumber());
        $libraryCard = $this->libraryCardRepository->find($command->getReaderEmail());

        if (!$book || !$libraryCard) {
            return;
        }

        $libraryCard->recordBookBorrowing($book, $command->getBorrowDate());
    }
}
