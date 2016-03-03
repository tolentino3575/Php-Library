<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Author.php";
require_once "src/Book.php";

$server = 'mysql:host=localhost;dbname=library_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class AuthorTest extends PHPUnit_Framework_TestCase
    {
        // protected function TearDown()
        // {
        //     Author::deleteAll();
        //     Book::deleteAll();
        // }

        function test_allGetters()
        {
            //Arrange
            $name = "JK Rowling";
            $id = 1;
            $test_author = new Author($name, $id);

            //Act
            $result1 = $test_author->getName();
            $result2 = $test_author->getId();

            //Assert
            $this->assertEquals($name, $result1);
            $this->assertEquals($id, is_numeric($result2));
        }

        function test_save()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);

            $name2 = "JK Rowling";
            $test_author2 = new Author($name2, $id);

            //Act
            $test_author->save();
            $test_author2->save();
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author], $result);



        }

        function test_getAll()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);

            $name2 = "Marissa Meyer";
            $test_author2 = new Author($name2, $id);

            //Act
            $test_author->save();
            $test_author2->save();
            $result = Author::getAll();

            //Assert
            $this->assertEquals([$test_author, $test_author2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Marissa Meyer";
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            //Act
            Author::deleteAll();
            $result = Author::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Marissa Meyer";
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            //Act
            $result = Author::find($test_author->getId());

            //Assert
            $this->assertEquals($test_author, $result);
        }

        function test_deleteSingle()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "Marissa Meyer";
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            //Act
            $test_author->delete();
            $result = Author::getAll();

            //Assert
            $this->assertEquals($test_author2, $result[0]);
        }

        function test_searchByAuthor()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $name2 = "JayKay Rowling";
            $id = null;
            $test_author2 = new Author($name2, $id);
            $test_author2->save();

            $search = "JK";

            //Act
            $result = Author::search($search);

            //Assert
            $this->assertEquals([$test_author], $result);
        }

        function test_updateName()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();
            $update_name = "JayKay Rowling";

            //Act
            $test_author->update($update_name);

            //Assert
            $this->assertEquals($update_name, $test_author->getName());
        }

        function test_addBook()
        {
            //Arrange
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);
            $test_book->save();

            //Act
            $test_author->addBook($test_book);

            //Assert
            $this->assertEquals([$test_book], $test_author->getBooks());
        }

        function test_getBooks()
        {
            $name = "JK Rowling";
            $id = null;
            $test_author = new Author($name, $id);
            $test_author->save();

            $title = "Harry Potter";
            $id = null;
            $test_book = new Book($title, $id);
            $test_book->save();

            $title2 = "Harry Potter 2";
            $test_book2 = new Book($title, $id);
            $test_book2->save();

            $test_author->addBook($test_book);
            $test_author->addBook($test_book2);

            $this->assertEquals($test_author->getBooks(), [$test_book, $test_book2]);
        }




    }
?>
