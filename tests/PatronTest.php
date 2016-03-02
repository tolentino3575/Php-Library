<?php

/**
* @backupGlobals disabled
* @backupStaticAttributes disabled
*/

require_once "src/Patron.php";

$server = 'mysql:host=localhost;dbname=library_test';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);



class PatronTest extends PHPUnit_Framework_TestCase
    {
        protected function TearDown()
        {
            Patron::deleteAll();
        }

        function test_allGetters()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);

            //Act
            $result1 = $test_patron->getPatronName();
            $result2 = $test_patron->getId();

            //Assert
            $this->assertEquals($patron_name, $result1);
            $this->assertEquals($id, is_numeric($result2));
        }

        function test_save()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = 1;
            $test_patron = new Patron($patron_name, $id);

            //Act
            $test_patron->save();
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron], $result);
        }

        function test_getAll()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = null;
            $test_patron = new Patron($patron_name, $id);

            $patron_name2 = "Sean John";
            $test_patron2 = new Patron($patron_name2, $id);

            //Act
            $test_patron->save();
            $test_patron2->save();
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron, $test_patron2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            $patron_name2 = "Sean John";
            $test_patron2 = new Patron($patron_name2, $id);
            $test_patron2->save();

            //Act
            Patron::deleteAll();
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            $patron_name2 = "Sean John";
            $test_patron2 = new Patron($patron_name2, $id);
            $test_patron2->save();

            //Act
            $result = Patron::find($test_patron->getId());

            //Assert
            $this->assertEquals($test_patron, $result);
        }

        function test_update()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();
            $new_name = "Elizabeth Poarch";

            //Act
            $test_patron->update($new_name);

            //Assert
            $this->assertEquals($new_name, $test_patron->getPatronName());
        }

        function test_deletePatron()
        {
            //Arrange
            $patron_name = "Elizabeth Knopp";
            $id = null;
            $test_patron = new Patron($patron_name, $id);
            $test_patron->save();

            $patron_name2 = "Sean John";
            $test_patron2 = new Patron($patron_name2, $id);
            $test_patron2->save();

            //Act
            $test_patron->delete();
            $result = Patron::getAll();

            //Assert
            $this->assertEquals([$test_patron2], $result);
        }
    }

?>
