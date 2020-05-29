<?php

namespace Library\Domain;

class BookBorrowing
{
    /**
     * @var string
     */
    private $bookIsbn;
    /**
     * @var \DateTimeImmutable
     */
    private $borrowingDate;
    /**
     * @var \DateTimeImmutable
     */
    private $returnDate;

    public function __construct(string $bookIsbn, \DateTimeImmutable $borrowingDate, \DateTimeImmutable $returnDate)
    {
        $this->bookIsbn = $bookIsbn;
        $this->borrowingDate = $borrowingDate;
        $this->returnDate = $returnDate;
    }

    /**
     * @return string
     */
    public function getBookIsbn(): string
    {
        return $this->bookIsbn;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getBorrowingDate(): \DateTimeImmutable
    {
        return $this->borrowingDate;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getReturnDate(): \DateTimeImmutable
    {
        return $this->returnDate;
    }
}
