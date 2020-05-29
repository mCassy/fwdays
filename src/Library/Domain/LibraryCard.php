<?php

namespace Library\Domain;

class LibraryCard
{
    /**
     * @var string
     */
    private $email;
    /**
     * @var array|
     */
    private $borrowings;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function recordBookBorrowing(Book $book, \DateTimeImmutable $borrowingDate)
    {
        $this->borrowings[] = new BookBorrowing(
            $book->getIsbn(),
            $borrowingDate,
            ($borrowingDate)->add(
                new \DateInterval(
                    sprintf('P%sD', $book->getBorrowingDays()
                    )
                )
            )
        );
    }

    /**
     * @return array|BookBorrowing[]
     */
    public function getBorrowings(): array
    {
        return $this->borrowings;
    }
}
