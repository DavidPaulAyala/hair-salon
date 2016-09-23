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
            Client::deleteAll();
        }

        function test_getId()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $id = 1;
            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $client_id, $id);

            //Act
            $result = $test_stylist_name->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getStylist()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $client_id);

            //Act
            $result = $test_stylist_name->getStylist();

            //Assert
            $this->assertEquals($stylist_name, $result);
        }

        function test_setStylist()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $client_id);
            $new_stylist_name = "Sue";

            //Act
            $test_stylist_name->setStylist($new_stylist_name);
            $result = $test_stylist_name->getStylist();

            //Assert
            $this->assertEquals($new_stylist_name, $result);
        }

        function test_getClientId()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $client_id);

            //Act
            $result = $test_stylist_name->getClientId();

            //Assert
            $this->assertEquals($client_id, $result);
        }

        function test_setClientId()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();
            $client_name = "Lila";
            $test_client_name2 = new Client($client_name);
            $test_client_name2->save();
            $client_id2 = $test_client_name2->getId();

            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $client_id);

            //Act
            $test_stylist_name->setClientId($client_id2);
            $result = $test_stylist_name->getClientId();

            //Assert
            $this->assertEquals($client_id2, $result);
        }

        function test_save()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $test_stylist_name = new Stylist($stylist_name, $client_id);
            $test_stylist_name->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals($test_stylist_name, $result[0]);
        }

        function test_getAll()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $stylist_name2 = "Barb";
            $test_stylist_name = new Stylist($stylist_name, $client_id);
            $test_stylist_name->save();
            $test_stylist_name2 = new Stylist($stylist_name2, $client_id);
            $test_stylist_name2->save();

            //Act
            $result = Stylist::getAll();

            //Assert
            $this->assertEquals([$test_stylist_name, $test_stylist_name2], $result);
        }

        function test_deleteAll()
        {
            //Arrange
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $stylist_name2 = "Barb";
            $test_stylist_name = new Stylist($stylist_name, $client_id);
            $test_stylist_name->save();
            $test_stylist_name2 = new Stylist($stylist_name2, $client_id);
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
            $client_name = "Chuck";
            $test_client_name = new Client($client_name);
            $test_client_name->save();
            $client_id = $test_client_name->getId();

            $stylist_name = "James";
            $stylist_name2 = "Barb";
            $test_stylist_name = new Stylist($stylist_name, $client_id);
            $test_stylist_name->save();
            $test_stylist_name2 = new Stylist($stylist_name2, $client_id);
            $test_stylist_name2->save();

            //Act
            $result = Stylist::find($test_stylist_name->getId());

            //Assert
            $this->assertEquals($test_stylist_name, $result);
        }
    }
?>
