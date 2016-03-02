<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Copy.php";
require_once "src/Book.php";

$server = 'mysql:host=localhost;dbname=library_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class CopyTest extends PHPUnit_Framework_TestCase
{
    protected function TearDown()
    {
        Copy::deleteAll();
        Book::deleteAll();
    }
    function test_getBookId()
    {
        //Arrange
        $book_id = 3;
        $checked_out = null;
        $test_copy = new Copy($book_id, $checked_out);

        //Act
        $result = $test_copy->getBookId();

        //Assert
        $this->assertEquals(3, $result);
    }

    function test_getCheckedOut()
    {
        //Arrange
        $book_id = null;
        $checked_out = 0;
        $test_copy = new Copy($book_id, $checked_out);

        //Act
        $result = $test_copy->getCheckedOut();

        //Assert
        $this->assertEquals($checked_out, $result);
    }

    function test_getId()
    {
        //Arrange
        $book_id = 1;
        $checked_out = 0;
        $id = 1;
        $test_copy = new Copy($book_id, $checked_out, $id);

        //Act
        $result = $test_copy->getId();

        //Assert
        $this->assertEquals($id, $result);
    }

    function test_save()
    {
        //Arrange
        $name = "Harry Potter";
        $id = null;
        $test_book = new Book($name, $id);
        $test_book->save();

        $book_id = $test_book->getId();
        $checked_out = 0;
        $test_copy = new Copy($book_id, $checked_out, $id);
        $test_copy->save();

        //Act
        $result = Copy::getAll();

        //Assert
        $this->assertEquals([$test_copy], $result);
    }

    function test_getAll()
    {
        //Arrange
        $name = "Harry Potter";
        $id = null;
        $test_book = new Book($name, $id);
        $test_book->save();

        $book_id = $test_book->getId();
        $checked_out = 0;
        $test_copy = new Copy($book_id, $checked_out, $id);
        $test_copy->save();

        $test_copy2 = new Copy($book_id, $checked_out, $id);
        $test_copy2->save();

        //Act
        $result = Copy::getAll();

        //Assert
        $this->assertEquals([$test_copy, $test_copy2], $result);

    }

    function test_deleteAll()
    {
        //Arrange
        $name = "Harry Potter";
        $id = null;
        $test_book = new Book($name, $id);
        $test_book->save();

        $book_id = $test_book->getId();
        $checked_out = 0;
        $test_copy = new Copy($book_id, $checked_out, $id);
        $test_copy->save();

        $test_copy2 = new Copy($book_id, $checked_out, $id);
        $test_copy2->save();

        //Act
        Copy::deleteAll();
        $result = Copy::getAll();

        //Assert
        $this->assertEquals([], $result);
    }

    function test_find()
    {
        //Arrange
        $name = "Harry Potter";
        $id = null;
        $test_book = new Book($name, $id);
        $test_book->save();

        $book_id = $test_book->getId();
        $checked_out = 0;
        $test_copy = new Copy($book_id, $checked_out, $id);
        $test_copy->save();

        $test_copy2 = new Copy($book_id, $checked_out, $id);
        $test_copy2->save();

        //Act
        $result = Copy::find($test_copy->getId());

        //Assert
        $this->assertEquals($test_copy, $result);
    }

    function test_delete()
    {
        //Arrange
        $name = "Harry Potter";
        $id = null;
        $test_book = new Book($name, $id);
        $test_book->save();

        $book_id = $test_book->getId();
        $checked_out = 0;
        $test_copy = new Copy($book_id, $checked_out, $id);
        $test_copy->save();

        $test_copy2 = new Copy($book_id, $checked_out, $id);
        $test_copy2->save();

        //Act
        $test_copy->delete();
        $result = Copy::getAll();

        //Assert
        $this->assertEquals([$test_copy2], $result);
    }

}








?>
