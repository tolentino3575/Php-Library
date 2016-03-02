<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Author.php";

$server = 'mysql:host=localhost;dbname=library_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class AuthorTest extends PHPUnit_Framework_TestCase
    {
        protected function TearDown()
        {
            Author::deleteAll();
        }

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

            $name2 = "Marissa Meyer";
            $test_author2 = new Author($name2, $id);

            //Act
            $test_author->save();
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





    }
?>
