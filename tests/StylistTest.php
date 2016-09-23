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

        protected function tearDown()
        {
            Stylist::deleteAll();
            // Client::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $id);

            //Act
            $result = $test_stylist_name->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getStylist()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name);

            //Act
            $result = $test_stylist_name->getStylist();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function test_setStylist()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name);
            $new_stylist_name = "Sue";

            //Act
            $test_stylist_name->setStylist($new_stylist_name);
            $result = $test_stylist_name->getStylist();

            //Assert
            $this->assertEquals($new_stylist_name, $result);
        }

        function test_save()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name);
            $test_stylist_name->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist_name, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $stylist_name = "James";
            $stylist_name2 = "Barb";
            $test_stylist_name = new Stylist($stylist_name);
            $test_stylist_name->save();
            $test_stylist_name2 = new Stylist($stylist_name2);
            $test_stylist_name2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist_name, $test_stylist_name2], $result);

        }

        function test_deleteAll()
        {
          //Arrange
          $stylist_name = "James";
          $stylist_name2 = "Barb";
          $test_stylist_name = new Stylist($stylist_name);
          $test_stylist_name->save();
          $test_stylist_name2 = new Stylist($stylist_name2);
          $test_stylist_name2->save();

          //Act
          Stylist::deleteAll();
          $result = Stylist::getAll();

          //Assert
          $this->assertEquals([], $result);

        }

        function test_find()
        {
            //Arrange
            $stylist_name = "James";
            $stylist_name2 = "Barb";
            $test_stylist_name = new Stylist($stylist_name);
            $test_stylist_name->save();
            $test_stylist_name2 = new Stylist($stylist_name2);
            $test_stylist_name2->save();

            //Act
            $result = Stylist::find($test_stylist_name->getId());

            //Assert
            $this->assertEquals($test_stylist_name, $result);

        }

        // function test_name()
        // {
        //     //Arrange
        //
        //     //Act
        //
        //     //Assert
        //
        // }
    }
?>
