<?php

namespace MyBooks\Controller;

class BookController {

    public function findAllBooksAction($app) {

       $books = $app['dao.book']->findAllBooksDAO();

       return $app['twig']->render('book/index.html.twig', array(
           'books' => $books)
       );
    }

    public function findBookAction($bookId, $app) {
        $book = $app['dao.book']->findBookDAO($bookId);

        return $app['twig']->render('book/book.html.twig', array(
            'book' => $book,
            //'author' => $author
        ));
    }
}