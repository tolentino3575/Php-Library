<<?php

    class Copy
    {
        private $book_id;
        private $checked_out;
        private $id;

        function __construct($book_id, $checked_out, $id = null)
        {
            $this->book_id = $book_id;
            $this->checked_out = $checked_out;
            $this->id = $id;
        }

        function setBookId($new_book_id)
        {
            $this->book_id = $new_book_id;
        }

        function getBookId()
        {
            return $this->book_id;
        }

        function setCheckedOut($new_checked_out)
        {
            $this->checked_out = $new_checked_out;
        }

        function getCheckedOut()
        {
            return $this->checked_out;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO copies (book_id, checked_out) VALUES ({$this->getBookId()}, {$this->getCheckedOut()});");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_copies = $GLOBALS['DB']->query("SELECT * FROM copies;");
            $copies = array();
            foreach ($returned_copies as $copy) {
                $book_id = $copy['book_id'];
                $checked_out = $copy['checked_out'];
                $id = $copy['id'];
                $new_copy = new Copy($book_id, $checked_out, $id);
                array_push($copies, $new_copy);
            }
            return $copies;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM copies;");
        }

    }






?>
