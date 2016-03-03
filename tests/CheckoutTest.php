<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Checkout.php";
    require_once "src/Copy.php";
    require_once "src/Patron.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CheckoutTest extends PHPUnit_Framework_TestCase
    {
        protected function TearDown()
        {
            Checkout::deleteAll();
            Copy::deleteAll();
            Patron::deleteAll();
        }

        function test_allGetters()
        {
            $book_copy_id = 3;
            $patron_id = 4;
            $date_checked_out = "2015-03-14";
            $due_date = "2015-03-28";
            $id = 4;

            $test_checkout = new Checkout($book_copy_id, $patron_id, $date_checked_out, $due_date, $id);

            $result1 = $test_checkout->getBookCopyId();
            $result2 = $test_checkout->getPatronId();
            $result3 = $test_checkout->getDateCheckedOut();
            $result4 = $test_checkout->getDueDate();
            $result5 = $test_checkout->getId();

            $this->assertEquals($book_copy_id, $result1);
            $this->assertEquals($patron_id, $result2);
            $this->assertEquals($date_checked_out, $result3);
            $this->assertEquals($due_date, $result4);
            $this->assertEquals($id, $result5);
        }

        function test_save()
        {
//Creates new instance of a copy
            $book_id = 3;
            $checked_out = 0;
            $new_copy = new Copy($book_id, $checked_out, null);
            $new_copy->save();
//Creates instance of patron
            $patron_name = "Walter Rick";
            $new_patron = new Patron($patron_name, null);
            $new_patron->save();
//Creates instance of Checkout
            $book_copy_id = $new_copy->getId();
            $patron_id = $new_patron->getId();
            $date_checked_out = "2015-03-14";
            $due_date = null;
            $id = 4;
            $test_checkout = new Checkout($book_copy_id, $patron_id, $date_checked_out, $due_date, $id);

            //Act
            $test_checkout->save();
            $result = Checkout::getAll();
            $result2 = Copy::find($book_copy_id);

            //Assert
            $this->assertEquals([$test_checkout], $result);
            $this->assertEquals(1, $result2->getCheckedOut());

        }

        function test_getAll()
        {
            $book_copy_id = 3;
            $patron_id = 4;
            $date_checked_out = "2015-03-14";
            $due_date = "2015-03-28";
            $id = 4;
            $test_checkout = new Checkout($book_copy_id, $patron_id, $date_checked_out, $due_date, $id);
            $test_checkout->save();

            $book_copy_id2 = 3;
            $patron_id2 = 4;
            $date_checked_out2 = "2015-03-14";
            $due_date2 = "2015-03-28";
            $id2 = 4;
            $test_checkout2 = new Checkout($book_copy_id2, $patron_id2, $date_checked_out2, $due_date2, $id2);
            $test_checkout2->save();

            //Act
            $result = Checkout::getAll();

            //Assert
            $this->assertEquals([$test_checkout, $test_checkout2], $result);
        }

        function test_find()
        {
          //Arrange
          $book_copy_id = 3;
          $patron_id = 4;
          $date_checked_out = "2016-04-30";
          $due_date = null;
          $test_checkout = new Checkout($book_copy_id, $patron_id, $date_checked_out, $due_date, null);
          $test_checkout->save();

          $book_copy_id2 = 4;
          $patron_id2 = 5;
          $date_checked_out2 = "2016-05-03";
          $test_checkout2 = new Checkout($book_copy_id2, $patron_id2, $date_checked_out2, $due_date, null);
          $test_checkout2->save();

          //Act
          $result = Checkout::find($test_checkout2->getId());

          //Assert
          $this->assertEquals($test_checkout2, $result);
        }

        function getPatronByBook()
        {
          $
        }


    }










 ?>
