<?php
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Stylist.php";
require_once __DIR__."/../src/Client.php";

use Symfony\Component\Debug\Debug;
Debug::enable();

$app = new Silex\Application();

$app['debug'] = true;

$server = 'mysql:host=localhost;dbname=hair_salon';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));



return $app;
?>
