<?php
class Stylist
{
    private $stylist_name;
    private $id;

    function __construct($stylist_name, $id = null)
    {
        $this->stylist_name = $stylist_name;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getStylist()
    {
        return $this->stylist_name;
    }

    function setStylist($new_stylist_name)
    {
        $this->stylist_name = (string) $new_stylist_name;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stylists (stylist_name) VALUES ('{$this->getStylist()}')");
        $this->id = $GLOBALS['DB']->lastinsertId();
    }

    static function getAll()
    {
      $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
      $stylists = array();
      foreach($returned_stylists as $stylist) {
          $stylist_name = $stylist['stylist_name'];
          $id = $stylist['id'];
          $new_stylist = new Stylist($stylist_name, $id);
          array_push($stylists, $new_stylist);
      }
      return $stylists;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylists;");
    }

    static function find($search_id)
    {
        $found_stylist = null;
        $stylists = Stylist::getAll();
        foreach($stylists as $stylist) {
            $stylist_id = $stylist->getId();
            if ($stylist_id == $search_id) {
              $found_stylist = $stylist;
            }
        }
        return $found_stylist;
    }

    function findClients()
    {
        $returned_clients = $GLOBALS['DB']->query("SELECT * FROM clients WHERE stylist_id = {$this->getId()};");
        $clients = array();
        foreach($returned_clients as $client)
        {
            $client_name = $client['client_name'];
            $stylist_id = $client['stylist_id'];
            $id = $client['id'];
            $new_client = new Client($client_name, $stylist_id, $id);
            array_push($clients, $new_client);
        }
        return $clients;
    }

    function update($new_stylist_name)
    {
        $GLOBALS['DB']->exec("UPDATE stylists SET stylist_name = '{$new_stylist_name}' WHERE id = {$this->getId()};");
        $this->setStylist($new_stylist_name);
    }

    function delete()
    {
        $GLOBALS['DB']->exec("DELETE FROM stylists WHERE id = {$this->getId()};");
        $GLOBALS['DB']->exec("DELETE FROM clients WHERE stylist_id = {$this->getId()};");
    }
}
?>
