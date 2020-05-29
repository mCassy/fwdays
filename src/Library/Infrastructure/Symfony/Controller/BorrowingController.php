<?php

namespace Library\Infrastructure\Symfony\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Library\Application\Command\BorrowBook;
use Library\Application\Handler\BorrowBookHandler;
use Library\Domain\Book;
use Library\Domain\BookRepository;
use Library\Domain\LibraryCard;
use Library\Domain\LibraryCardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BorrowingController extends AbstractController
{
    /**
     * @Route("/library/borrow", name="library_borrow", methods={"POST"})
     */
    public function borrow(
        Request $request,
        BorrowBookHandler $borrowBookHandler,
        EntityManagerInterface $entityManager
    ) {
        $isbn = $request->get('isbn');
        $readerEmail = $request->get('readerEmail');

        if (!$isbn || !$readerEmail) {
            return $this->json(['status' => 'error'], Response::HTTP_BAD_REQUEST);
        }

        $borrowBookHandler->handle(
            new BorrowBook(
                $readerEmail,
                $isbn,
                new \DateTimeImmutable()
            )
        );

        $entityManager->flush();

        return $this->redirectToRoute('library_cards_list');
    }

    /**
     * @Route("/library/init", name="library_init", methods={"POST"})
     */
    public function init(
        Request $request,
        BookRepository $bookRepository,
        LibraryCardRepository $libraryCardRepository
    ) {
        $bookRepository->add(new Book( '9781234567897', 'PHP6', 30));
        $bookRepository->add(new Book('9781234567898', 'REST API', 15));

        $libraryCardRepository->add(new LibraryCard('john@test.com'));

        return $this->json(
            [
                'status' => 'ok',
                'libraryCards' => $libraryCardRepository->findAll(),
                'books' => $bookRepository->findAll(),
            ],
            Response::HTTP_CREATED
        );
    }

    /**
     * @Route("/books/list", name="books_list", methods={"GET"})
     */
    public function booksList(
        Request $request,
        BookRepository $bookRepository
    ) {
        return $this->json(['books' => $bookRepository->findAll()], Response::HTTP_OK);
    }

    /**
     * @Route("/library-cards/list", name="library_cards_list", methods={"GET"})
     */
    public function libraryCardsList(
        Request $request,
        LibraryCardRepository $libraryCardRepository
    ) {
        return $this->json(['books' => $libraryCardRepository->findAll()], Response::HTTP_OK);
    }


}
