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
            // Stylist::deleteAll();
            // Client::deleteAll();
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
    }
?>
