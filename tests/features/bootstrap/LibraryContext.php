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
     * @Then :arg1 library card should contain borrowing of book with isbn :arg2
     */
    public function libraryCardShouldContainBorrowingOfBookWithIsbn($arg1, $arg2)
    {
        throw new PendingException();
    }

    /**
     * @Then :arg1 should return book with isbn :arg2 at least on :arg3
     */
    public function shouldReturnBookWithIsbnAtLeastOn($arg1, $arg2, $arg3)
    {
        throw new PendingException();
    }
}
