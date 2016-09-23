<?php
class Client
{
    private $client_name;
    private $id;

    function __construct($client_name, $id = null)
    {
        $this->client_name = $client_name;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getClient()
    {
        return $this->client_name;
    }

    function setClient($new_client_name)
    {
        $this->client_name = (string) $new_client_name;
    }
}
?>
