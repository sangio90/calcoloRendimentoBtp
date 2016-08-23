<?php
use CalcoloRendimentoBtp\Controller\IndexController;
use Silex\Application;

require_once(__DIR__ . '/../vendor/autoload.php');

$app = new Application([
    'debug' => true
]);

$app->register(new Silex\Provider\TwigServiceProvider(), [
    'twig.path' => __DIR__ . '/../src/CalcoloRendimentoBtp/Views',
]);

$app->get('/', function() use ($app) {
    $controller = new IndexController();
    $controller->setApp($app);
    return $controller->indexAction();
});

$app->post('/read', function() use ($app) {
    $request = $_POST;
    $controller = new IndexController();
    $controller->setApp($app);
    return $controller->readAction($request);
});

$app->run();