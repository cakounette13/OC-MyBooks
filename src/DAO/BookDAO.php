<?php

namespace MyBooks\DAO;

use MyBooks\Entity\Book;

class BookDAO extends DAO {

    private $authorDAO;

    /**
     * @param mixed $author
     */
    public function setAuthorDAO(AuthorDAO $authorDAO)
    {
        $this->authorDAO = $authorDAO;
    }

    public function findBookDAO($id) {
        $sql = "select * from book WHERE book_id = ?";
        $result = $this->getDb()->fetchAssoc($sql, array($id));

        if ($result) {
            return $this->buildDomainObject($result);
        } else {
            throw new \Exception("No book with id " . $id);
        }
    }

    public function findAllBooksDAO() {
        $sql = "select * from book ORDER BY book_id DESC ";
        $result = $this->getDb()->fetchAll($sql);

        //Convert query result to an array of entity objects
        $books = [];
        foreach ($result as $row) {
            $bookId = $row['book_id'];
            $books[$bookId] = $this->buildDomainObject($row);
        }
        return $books;
    }

    /**
     * Creates a book object based on a DB row.
     *
     * @param array $row The DB row containing Book data.
     * @return \MyBooks\Entity\Book
     */
    protected function buildDomainObject(array $row) {
        $book = new Book();
        $book->setId($row['book_id']);
        $book->setTitle($row['book_title']);
        $book->setIsbn($row['book_isbn']);
        $book->setSummary($row['book_summary']);

        if (array_key_exists('auth_id', $row)) {
            $authorId = $row['auth_id'];
            $author = $this->authorDAO->findAuthorDAO($authorId);
            $book->setAuthor($author);
        }
        return $book;
    }
}