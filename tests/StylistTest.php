<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttrivutes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost;dbname=hair_salon_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StylistTest extends PHPUnit_Framework_TestCase
    {

        // protected function tearDown()
        // {
        //     Stylist::deleteAll();
        //     Client::deleteAll();
        // }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $stylist = "James";
            $test_stylist = new Stylist($stylist, $id);

            //Act
            $result = $test_stylist->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getStylist()
        {
            //Arrange
            $stylist = "James";
            $test_stylist = new Stylist($stylist);

            //Act
            $result = $test_stylist->getStylist();

            //Assert
            $this->assertEquals($stylist, $result);
        }

        function test_setStylist()
        {
            //Arrange
            $stylist = "James";
            $test_stylist = new Stylist($stylist);
            $new_stylist = "James";

            //Act
            $test_stylist->setStylist($new_stylist);
            $result = $test_stylist->getStylist();

            //Assert
            $this->assertEquals($new_stylist, $result);
        }
    }
?>
