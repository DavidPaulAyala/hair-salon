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

    class ClientTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Client::deleteAll();
            Stylist::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $id = 1;
            $client_name = "Carlos";
            $test_client_name = new Client($client_name, $id);

            //Act
            $result = $test_client_name->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getClient()
        {
            //Arrange
            $client_name = "Carlos";
            $test_client_name = new Client($client_name);

            //Act
            $result = $test_client_name->getClient();

            //Assert
            $this->assertEquals($client_name, $result);
        }

        function test_setClient()
        {
            //Arrange
            $client_name = "Carlos";
            $test_client_name = new Client($client_name);
            $new_client_name = "Jane";

            //Act
            $test_client_name->setClient($new_client_name);
            $result = $test_client_name->getClient();

            //Assert
            $this->assertEquals($new_client_name, $result);
        }

        function test_save()
        {
            //Arrange
            $client_name = "Megan";
            $test_client_name = new Client($client_name);
            $test_client_name->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client_name, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $client_name = "Megan";
            $client_name2 = "Cate";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $test_client_name2 = new Client($client_name2);
            $test_client_name2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client_name, $test_client_name2], $result);

        }

        function test_deleteAll()
        {
          //Arrange
          $client_name = "Megan";
          $client_name2 = "Cate";
          $test_client_name = new Client($client_name);
          $test_client_name->save();
          $test_client_name2 = new Client($client_name2);
          $test_client_name2->save();

          //Act
          Client::deleteAll();
          $result = Client::getAll();

          //Assert
          $this->assertEquals([], $result);

        }

        function test_find()
        {
            //Arrange
            $client_name = "Megan";
            $client_name2 = "Cate";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $test_client_name2 = new Client($client_name2);
            $test_client_name2->save();

            //Act
            $result = Client::find($test_client_name->getId());

            //Assert
            $this->assertEquals($test_client_name, $result);

        }
        function testGetStylists()
        {
            //Arrange
            $client_name = "Cheryl";
            $client_name2 = "Francis";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $test_client_id = $test_client_name->getId();
            $test_client_name2 = new Client($client_name2);
            $test_client_name2->save();
            $test_client_id2 = $test_client_name2->getId();

            $stylist_name = "Rachel";
            $test_stylist_name = new Stylist($stylist_name, $test_client_id);
            $test_stylist_name->save();

            $stylist_name2 = "Sheila";
            $test_stylist_name2 = new Stylist($stylist_name2, $test_client_id);
            $test_stylist_name2->save();

            $stylist_name3 = "Connie";
            $test_stylist_name3 = new Stylist($stylist_name3, $test_client_id2);
            $test_stylist_name3->save();

            //Act
            $result = $test_client_name->getStylists();

            //Assert
            $this->assertEquals([$test_stylist_name, $test_stylist_name2], $result);
        }
      }
?>
