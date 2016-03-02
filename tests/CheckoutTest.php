<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Checkout.php";

    $server = 'mysql:host=localhost;dbname=library_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class CheckoutTest extends PHPUnit_Framework_TestCase
    {
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




    }



 ?>
