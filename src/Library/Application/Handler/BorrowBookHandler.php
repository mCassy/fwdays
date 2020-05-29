<?php

namespace Library\Application\Handler;

use Library\Application\Command\BorrowBook;

class BorrowBookHandler
{
    public function __construct()
    {
        //Think if you need any services to use here and if - inject them through constructor
    }

    public function handle(BorrowBook $command)
    {
        //@todo fill the handle method for book borrowing
        //think about old-school library when all your borrowings
        //were recorded by librarian on your card

        //think if that kind of record on library card make sense to exist outside of the card
    }
}
