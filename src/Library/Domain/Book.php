<?php

namespace Library\Domain;

class Book
{
    /**
     * @var string
     */
    private $isbn;
    /**
     * @var string
     */
    private $title;
    /**
     * @var int
     */
    private $borrowingDays;

    public function __construct(
        string $isbn,
        string $title,
        int $borrowingDays
    ) {
        $this->isbn = $isbn;
        $this->title = $title;
        $this->borrowingDays = $borrowingDays;
    }

    public function getIsbn(): string
    {
        return $this->isbn;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getBorrowingDays(): int
    {
        return $this->borrowingDays;
    }
}
