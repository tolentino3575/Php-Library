<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Book.php";

$server = 'mysql:host=localhost;dbname=library_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class BookTest extends PHPUnit_Framework_TestCase
    {
        protected function TearDown()
        {
            Book::deleteAll();
        }

        function test_allGetters()
        {
            //Arrange
            $title = "Harry Potter";
            $id = 1;
            $test_book = new Book($title, $id);

            //Act
            $result1 = $test_book->getTitle();
            $result2 = $test_book->getId();

            //Assert
            $this->assertEquals($title, $result1);
            $this->assertEquals($id, is_numeric($result2));
        }

        function test_save()
        {
            //Arrange
            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);

            //Act
            $test_book->save();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book], $result);
        }

        function test_getAll()
        {
            //Arrange
            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);

            $title2 = "Cinder";
            $test_book2 = new Book($title2, $id);

            //Act
            $test_book->save();
            $test_book2->save();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([$test_book, $test_book2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);
            $test_book->save();

            $title2 = "Cinder";
            $test_book2 = new Book($title2, $id);
            $test_book2->save();

            //Act
            Book::deleteAll();
            $result = Book::getAll();

            //Assert
            $this->assertEquals([], $result);

        }

        function test_findBook()
        {
            //Arrange
            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);
            $test_book->save();

            $title2 = "Cinder";
            $test_book2 = new Book($title2, $id);
            $test_book2->save();

            //Act
            $result = Book::find($test_book->getId());

            //Assert
            $this->assertEquals($test_book, $result);
        }

        

    }

?>
