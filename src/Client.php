<?php
class Client
{
    private $client_name;
    private $id;
    private $stylist_id;

    function __construct($client_name, $stylist_id, $id = null)
    {
        $this->client_name = $client_name;
        $this->stylist_id = $stylist_id;
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

    function getStylistId()
    {
        return $this->stylist_id;
    }

    function setClient($new_client_name)
    {
        $this->client_name = (string) $new_client_name;
    }

    function setStylistId($new_stylist_id)
    {
        $this->stylist_id = (int) $new_stylist_id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO clients (client_name) VALUES ('{$this->getClient()}', {$this->getStylistId()})");
        $this->id = $GLOBALS['DB']->lastinsertId();
    }

    static function getAll()
    {
      $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients;");
      $clients = array();
      foreach($returned_clients as $client) {
          $client_name = $client['client_name'];
          $id = $client['id'];
          $stylist_id = $client['stylist_id'];
          $new_client = new Client($client_name, $stylist_id, $id);
          array_push($clients, $new_client);
      }
      return $clients;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM clients;");
    }

    static function find($search_id)
    {
        $found_client = null;
        $clients = Client::getAll();
        foreach($clients as $client) {
            $client_id = $client->getId();
            if ($client_id == $search_id) {
              $found_client = $client;
            }
        }
        return $found_client;
    }

    // function getStylists()
    //     {
    //         $stylists = Array();
    //         $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists WHERE client_id = {$this->getId()};");
    //         foreach($returned_stylists as $stylist) {
    //             $stylist_name = $stylist['stylist_name'];
    //             $id = $stylist['id'];
    //             $client_id = $stylist['client_id'];
    //             $new_stylist = new Stylist($stylist_name, $client_id, $id);
    //             array_push($stylists, $new_stylist);
    //         }
    //         return $stylists;
    //     }
}
?>
