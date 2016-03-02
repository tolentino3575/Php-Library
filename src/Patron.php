<?php

    class Patron
    {
        private $patron_name;
        private $id;

        function __construct($patron_name, $id = null)
        {
            $this->patron_name = $patron_name;
            $this->id = $id;
        }

        function setPatronName($new_name)
        {
            $this->patron_name = $new_name;
        }

        function getPatronName()
        {
            return $this->patron_name;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $this->setDueDate($this->generateDueDate($this->getCheckedOutDate()))
            $GLOBALS['DB']->exec("INSERT INTO patrons (patron_name) VALUES ('{$this->getPatronName()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $returned_patrons = $GLOBALS['DB']->query("SELECT * FROM patrons;");
            $patrons = array();
            foreach($returned_patrons as $patron) {
                $title = $patron['patron_name'];
                $id = $patron['id'];
                $new_patron = new Patron($title, $id);
                array_push($patrons, $new_patron);
            }
            return $patrons;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons");
        }

        static function find($id)
        {
            $returned_patrons = Patron::getAll();
            $found_patron = null;
            foreach($returned_patrons as $patron) {
                $patron_id = $patron->getId();
                if ($patron_id == $id) {
                    $found_patron = $patron;
                }
            }
            return $found_patron;
        }

        function update($new_name)
        {
            $GLOBALS['DB']->exec("UPDATE patrons SET patron_name = '{$new_name}' WHERE id = {$this->getId()};");
            $this->setPatronName($new_name);
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM patrons WHERE id = {$this->getId()};");
        }
    }



 ?>
