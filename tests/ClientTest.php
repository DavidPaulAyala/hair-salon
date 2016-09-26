<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttrivutes disabled
    */

    require_once "src/Stylist.php";
    require_once "src/Client.php";

    $server = 'mysql:host=localhost:8889;dbname=hair_salon_test';
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
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $id = 1;
            $client_name = "Carlos";
            $test_client_name = new Client($client_name, $stylist_id, $id);

            //Act
            $result = $test_client_name->getId();

            //Assert
            $this->assertEquals($id, $result);
        }

        function test_getClient()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Carlos";
            $test_client_name = new Client($client_name, $stylist_id);

            //Act
            $result = $test_client_name->getClient();

            //Assert
            $this->assertEquals($client_name, $result);
        }

        function test_setClient()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Carlos";
            $test_client_name = new Client($client_name, $stylist_id);
            $new_client_name = "Jane";

            //Act
            $test_client_name->setClient($new_client_name);
            $result = $test_client_name->getClient();

            //Assert
            $this->assertEquals($new_client_name, $result);
        }

        function test_getClientId()
        {
            //Arrange
            $stylist_name = "Chuck";
            $test_stylist_name = new Stylist($stylist_name);
            $test_stylist_name->save();
            $stylist_id = $test_stylist_name->getId();

            $client_name = "James";
            $test_client_name = new Client($stylist_name, $stylist_id);

            //Act
            $result = $test_client_name->getStylistId();

            //Assert
            $this->assertEquals($stylist_id, $result);
        }

        function test_setClientId()
        {
            //Arrange
            $stylist_name = "Chuck";
            $test_stylist_name = new Stylist($stylist_name);
            $test_stylist_name->save();
            $stylist_id = $test_stylist_name->getId();

            $stylist_name = "Lila";
            $test_stylist_name2 = new Stylist($stylist_name);
            $test_stylist_name2->save();
            $stylist_id2 = $test_stylist_name2->getId();

            $client_name = "James";
            $test_client_name = new Client($stylist_name, $stylist_id);

            //Act
            $test_client_name->setStylistId($stylist_id2);
            $result = $test_client_name->getStylistId();

            //Assert
            $this->assertEquals($stylist_id2, $result);
        }

        function test_save()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Megan";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals($test_client, $result[0]);

        }

        function test_getAll()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Megan";
            $client_name2 = "Cate";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::getAll();

            //Assert
            $this->assertEquals([$test_client, $test_client2], $result);

        }

        function test_deleteAll()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Megan";
            $client_name2 = "Cate";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            Client::deleteAll();
            $result = Client::getAll();

            //Assert
            $this->assertEquals([], $result);
        }

        function test_find()
        {
            //Arrange
            $stylist_name = "James";
            $test_stylist = new Stylist($stylist_name);
            $test_stylist->save();
            $stylist_id = $test_stylist->getId();

            $client_name = "Megan";
            $client_name2 = "Cate";
            $test_client = new Client($client_name, $stylist_id);
            $test_client->save();
            $test_client2 = new Client($client_name2, $stylist_id);
            $test_client2->save();

            //Act
            $result = Client::find($test_client->getId());

            //Assert
            $this->assertEquals($test_client, $result);

        }

        function testUpdate()
        {
            //Arrange
            $client_name = "Michelle";
            $id = null;
            $test_client = new Client($client_name, $id);
            $test_client->save();

            $new_client_name = "Jenny";

            //Act
            $test_client->update($new_client_name);

            //Assert
            $this->assertEquals("Jenny", $test_client->getClient());
        }

        function testDelete()
        {
            //Arrange
            $client_name = "Gayle";
            $id = null;
            $test_client = new Client($client_name, $stylist_id, $id);
            $test_client->save();

            $client_name2 = "Sheena";
            $test_client2 = new Client($client_name2, $stylist_id, $id);
            $test_client2->save();


            //Act
            $test_client->delete();

            //Assert
            $this->assertEquals([], Client::getAll());
        }
    }
?>
