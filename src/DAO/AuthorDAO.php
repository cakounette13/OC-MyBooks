<?php

 namespace MyBooks\DAO;

 use MyBooks\Entity\Author;

 class AuthorDAO extends DAO {

     public function findAuthorDAO($id) {
        $sql = "select * from author WHERE auth_id = ?";
        $result = $this->getDb()->fetchAssoc($sql, array($id));

        if ($result) {
            return $this->buildDomainObject($result);
        } else {
            throw new \Exception("No author with id " . $id);
        }
     }


     /**
      * Creates an author object based on a DB row.
      *
      * @param array $row The DB row containing Author data.
      * @return \MyBooks\Entity\Author
      */
     protected function buildDomainObject(array $row) {
         $author = new Author();
         $author->setId($row['auth_id']);
         $author->setFirstName($row['auth_first_name']);
         $author->setLastName($row['auth_last_name']);

         return $author;
     }
 }