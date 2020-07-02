<?php 

require_once("vendor/autoload.php");

use \Slim\Slim;
use \PhpClass\Page;
use \PhpClass\PageAdmin;
use \PhpClass\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
     $page = Page();
     $page->setTpl("index");
});

$app->get('/admin', function() {
     $page = new PhpClass\PageAdmin();
     $page->setTpl("index");
});

$app->get('/admin/login', function() {
     $page = new PageAdmin([
     	"header"=>false,
     	"footer"=>fals
     ]);
     $page->setTpl("login");
});

$app->post('/admin/login', function() {
	User::login($_POST['login'], $_POST['password']);
	header("Location: /admin")
   
});

$app->run();

 ?>