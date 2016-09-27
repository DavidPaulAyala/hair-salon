<?php
require_once __DIR__."/../vendor/autoload.php";
require_once __DIR__."/../src/Stylist.php";
require_once __DIR__."/../src/Client.php";

use Symfony\Component\Debug\Debug;
Debug::enable();

$app = new Silex\Application();

$app['debug'] = true;

$server = 'mysql:host=localhost:8889;dbname=hair_salon';
$username = 'root';
$password = 'root';
$DB = new PDO($server, $username, $password);

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
));

$app->get("/", function() use ($app) {
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
});

$app->get("/clients", function() use ($app) {
    return $app['twig']->render('clients.html.twig', array('clients' => Client::getAll()));
});

$app->get("/stylists", function() use ($app) {
    return $app['twig']->render('stylists.html.twig', array('stylists' => Stylist::getAll()));
});

$app->post("/stylists", function() use ($app) {
    $stylist = new Stylist($_POST['name']);
    $stylist->save();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
});

$app->post("/delete_stylists", function() use ($app) {
    Stylist::deleteAll();
    return $app['twig']->render('index.html.twig');
});

$app->post("/clients", function() use ($app) {
    $client_name = $_POST['name'];
    $stylist_id = $_POST['stylist_id'];
    $client = new Client($client_name, $id = null, $stylist_id);
    $client->save();
    $stylist = Stylist::find($stylist_id);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->findClients()));
});

$app->post("/delete_clients", function() use ($app) {
    Client::deleteAll();
    return $app['twig']->render('index.html.twig');
});

$app->get("/stylists/{id}", function($id) use ($app) {
    $stylist = Stylist::find($id);
    return $app['twig']->render('stylist.html.twig', array('stylist' => $stylist, 'clients' => $stylist->findClients()));
});

$app->delete("/stylists/{id}", function($id) use ($app) {
    $stylist = Stylist::find($id);
    $stylist->delete();
    return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
});

return $app;
?>
