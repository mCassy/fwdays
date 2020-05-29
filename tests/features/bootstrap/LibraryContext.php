<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Library\Application\Command\BorrowBook;
use Library\Application\Handler\BorrowBookHandler;
use Library\Domain\Book;
use Library\Domain\BookRepository;
use Library\Domain\LibraryCard;
use Library\Domain\LibraryCardRepository;
use Library\Infrastructure\InMemory\Repository\InMemoryBookRepository;
use Library\Infrastructure\InMemory\Repository\InMemoryLibraryCardRepository;

class LibraryContext implements Context
{
    /**
     * @var LibraryCardRepository
     */
    private $libraryCardRepository;

    /**
     * @var BookRepository
     */
    private $bookRepository;

    /**
     * @var DateTimeImmutable
     */
    private $todayDate;

    /**
     * @var BorrowBookHandler
     */
    private $borrowBookHandler;

    public function __construct()
    {
        $this->libraryCardRepository = new InMemoryLibraryCardRepository();
        $this->bookRepository = new InMemoryBookRepository();
        $this->borrowBookHandler = new BorrowBookHandler(
            $this->bookRepository,
            $this->libraryCardRepository
        );

    }

    /**
     * @Given there is reader :readerEmail
     */
    public function thereIsReader($readerEmail)
    {
        $libraryCard = new LibraryCard($readerEmail);

        $this->libraryCardRepository->add($libraryCard);
    }

    /**
     * @Given there is book :bookTitle with isbn number :bookIsbn that can be borrowed for :borrowindDays days
     */
    public function thereIsBookWithIsbnNumberThatCanBeBorrowedForDays($bookTitle, $bookIsbn, $borrowingDays)
    {
        $book = new Book($bookIsbn, $bookTitle, $borrowingDays);

        $this->bookRepository->add($book);
    }

    /**
     * @Given today is :todayDate
     */
    public function todayIs($todayDate)
    {
        $this->todayDate = new \DateTimeImmutable($todayDate);
    }

    /**
     * @When :readerEmail borrow book marked with isbn :bookIsbn
     */
    public function borrowBookMarkedWithIsbn($readerEmail, $bookIsbn)
    {
        $command = new BorrowBook($readerEmail, $bookIsbn, $this->todayDate);

        $this->borrowBookHandler->handle($command);
    }

    /**
     * @Then :readerEmail library card should contain borrowing of book with isbn :isbn
     */
    public function libraryCardShouldContainBorrowingOfBookWithIsbn($readerEmail, $isbn)
    {
        /** @var LibraryCard $libraryCard */
        $libraryCard = $this->libraryCardRepository->find($readerEmail);

        foreach ($libraryCard->getBorrowings() as $borrowing) {
            if ($borrowing->getBookIsbn() === $isbn) {
                return;
            }
        }

        throw new \LogicException(sprintf('there is no borrowing of book %s', $isbn));
    }

    /**
     * @Then :readerEmail should return book with isbn :isbn at least on :returnDate
     */
    public function shouldReturnBookWithIsbnAtLeastOn($readerEmail, $isbn, $returnDate)
    {
        /** @var LibraryCard $libraryCard */
        $libraryCard = $this->libraryCardRepository->find($readerEmail);

        foreach ($libraryCard->getBorrowings() as $borrowing) {
            if ($borrowing->getBookIsbn() === $isbn) {
                if ($borrowing->getReturnDate()->format('d-m-Y') !== $returnDate) {
                    throw new \LogicException(
                        sprintf(
                            'return date should be %s not %s',
                            $borrowing->getReturnDate()->format('d-m-Y'),
                            $returnDate
                        )
                    );
                }

                return;
            }
        }

        throw new \LogicException(sprintf('there is no borrowing of book %s', $isbn));
    }
}
