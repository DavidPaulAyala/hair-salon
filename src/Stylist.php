<?php
class Stylist
{
    private $stylist;
    private $id;

    function __construct($stylist, $id = null)
    {
        $this->stylist = $stylist;
        $this->id = $id;
    }

    function getId()
    {
        return $this->id;
    }

    function getStylist()
    {
        return $this->stylist;
    }

    function setStylist($new_stylist)
    {
        $this->stylist = (string) $new_stylist;
    }
}
?>
