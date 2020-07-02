<?php 

require_once("vendor/autoload.php");

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
     $page = new PhpClass\Page();
     $page->setTpl("index");
});

$app->get('/admin', function() {
     $page = new PhpClass\PageAdmin();
     $page->setTpl("index");
});

$app->get('/admin/login', function() {
     $page = new PhpClass\PageAdmin([
     	"header"=>false,
     	"footer"=>false

     ]);
     $page->setTpl("login");
});


$app->run();

 ?>