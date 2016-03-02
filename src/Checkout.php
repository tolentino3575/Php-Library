<?php

    class Checkout
    {
        private $book_copy_id;
        private $patron_id;
        private $date_checked_out;
        private $due_date;
        private $id;

        function __construct($book_copy_id, $patron_id, $date_checked_out, $due_date, $id = null)
        {
            $this->book_copy_id = $book_copy_id;
            $this->patron_id = $patron_id;
            $this->date_checked_out = $date_checked_out;
            $this->due_date = $due_date;
            $this->id = $id;
        }

        function setBookCopyId($new_book_copy_id)
        {
            $this->book_copy_id = $new_book_copy_id;
        }

        function getBookCopyId()
        {
            return $this->book_copy_id;
        }

        function setPatronId($new_patron_id)
        {
            $this->patron_id = $new_patron_id;
        }

        function getPatronId()
        {
            return $this->patron_id;
        }

        function setDateCheckedOut($new_date_checked_out)
        {
            $this->date_checked_out = $new_date_checked_out;
        }

        function getDateCheckedOut()
        {
            return $this->date_checked_out;
        }

        function setDueDate($new_due_date)
        {
            $this->due_date = $new_due_date;
        }

        function getDueDate()
        {
            return $this->due_date;
        }

        function getId()
        {
            return $this->id;
        }


    }




 ?>
