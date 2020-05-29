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

    public function __construct(string $readerEmail, string $isbnNumber)
    {
        $this->readerEmail = $readerEmail;
        $this->isbnNumber = $isbnNumber;
    }
    public function getReaderEmail(): string
    {
        return $this->readerEmail;
    }

    public function getIsbnNumber(): string
    {
        return $this->isbnNumber;
    }
}
