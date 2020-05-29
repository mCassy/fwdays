<?php

use Behat\Behat\Context\Context;
use Behat\Behat\Tester\Exception\PendingException;
use Library\Domain\LibraryCard;
use Library\Domain\LibraryCardRepository;
use Library\Infrastructure\InMemory\Repository\InMemoryLibraryCardRepository;

class LibraryContext implements Context
{
    /**
     * @var LibraryCardRepository
     */
    private $libraryCardRepository;

    public function __construct()
    {
        $this->libraryCardRepository = new InMemoryLibraryCardRepository();
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
     * @Given there is book :arg1 with isbn number :arg2 that can be borrowed for :arg3 days
     */
    public function thereIsBookWithIsbnNumberThatCanBeBorrowedForDays($arg1, $arg2, $arg3)
    {
        //@todo implement this step
    }

    /**
     * @Given today is :arg1
     */
    public function todayIs($arg1)
    {
        //@todo implement this step - we need current date assumption to make our tests deterministic
    }

    /**
     * @When :arg1 borrow book marked with isbn :arg2
     */
    public function borrowBookMarkedWithIsbn($arg1, $arg2)
    {
        throw new PendingException();
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
