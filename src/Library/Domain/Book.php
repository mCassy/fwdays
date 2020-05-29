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
     * @var string
     */
    private $borrowingDays;

    public function __construct(
        string $isbn,
        string $title,
        string $borrowingDays
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

    public function getBorrowingDays(): string
    {
        return $this->borrowingDays;
    }
}
