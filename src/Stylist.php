<?php
class Stylist
{
    private $stylist_name;
    private $id;
    private $client_id;

    function __construct($stylist_name, $assigned_client_id, $id = null)
    {
        $this->stylist_name = $stylist_name;
        $this->id = $id;
        $this->client_id = $assigned_client_id;
    }

    function getId()
    {
        return $this->id;
    }

    function getStylist()
    {
        return $this->stylist_name;
    }

    function getClientId()
    {
        return $this->client_id;
    }

    function setStylist($new_stylist_name)
    {
        $this->stylist_name = (string) $new_stylist_name;
    }

    function setClientId($new_client_id)
    {
        $this->client_id = (int) $new_client_id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stylists (stylist_name, client_id) VALUES ('{$this->getStylist()}', {$this->getClientId()})");
        $this->id = $GLOBALS['DB']->lastinsertId();
    }

    static function getAll()
    {
      $returned_stylists = $GLOBALS['DB']->query("SELECT * FROM stylists;");
      $stylists = array();
      foreach($returned_stylists as $stylist) {
          $stylist_name = $stylist['stylist_name'];
          $id = $stylist['id'];
          $client_id = $stylist['client_id'];
          $new_stylist = new Stylist($stylist_name,$client_id, $id);
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
}
?>
