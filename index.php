<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/admin', function() {
     $page = new PhpClass\Page();
     $page->setTpl("index");
});

$app->get('/', function() {
     $page = new PhpClass\PageAdmin();
     $page->setTpl("index");
});


$app->run();

 ?>