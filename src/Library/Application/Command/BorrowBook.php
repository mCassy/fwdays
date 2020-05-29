<?php

namespace Library\Application\Command;

class BorrowBook
{
    /**
     * @var string
     */
    private $readerEmail;
    /**
     * @var string
     */
    private $isbnNumber;
    /**
     * @var \DateTimeImmutable
     */
    private \DateTimeImmutable $borrowDate;

    public function __construct(string $readerEmail, string $isbnNumber, \DateTimeImmutable $borrowDate)
    {
        $this->readerEmail = $readerEmail;
        $this->isbnNumber = $isbnNumber;
        $this->borrowDate = $borrowDate;
    }
    public function getReaderEmail(): string
    {
        return $this->readerEmail;
    }

    public function getIsbnNumber(): string
    {
        return $this->isbnNumber;
    }

    public function getBorrowDate(): \DateTimeImmutable
    {
        return $this->borrowDate;
    }

}
