<?php 
session_start();
require_once("vendor/autoload.php");

use \Slim\Slim;
use \PhpClass\Page;
use \PhpClass\PageAdmin;
use \PhpClass\Model\User;

$app = new \Slim\Slim();

$app->config('debug', true);

$app->get('/', function() {
     $page = new Page();
     $page->setTpl("index");
});

$app->get('/admin', function() {
	 User::verifylogin(); //verificar se está logado
     $page = new PageAdmin();
     $page->setTpl("index");
});

$app->get('/admin/login', function() {
     $page = new PageAdmin([
     	"header"=>false,
     	"footer"=>false
     ]);
     $page->setTpl("login");
});

$app->post('/admin/login', function() {
	User::login($_POST["login"], $_POST["password"]);
	header("Location: ../admin");
   exit;
});

$app->get('/admin/logout', function() {
     
     User::logout();
     header("Location: login");
     exit;
});

$app->get('/admin/users', function(){
	User::verifylogin(); //verificar se está logado
	$users = User::listAll();
	$page = new PageAdmin();
     $page->setTpl("users", array(
     	"users"=>$users
     ));
});

$app->post("/admin/users/create", function () {

 	User::verifyLogin();
	$user = new User();
 	$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;
 	$_POST['despassword'] = password_hash($_POST["despassword"], PASSWORD_DEFAULT, [
 	"cost"=>12
 	]);
 	$user->setData($_POST);
	$user->save();
	header("Location: /admin/users");
 	exit;

});

$app->get('/admin/users/:iduser', function($iduser){
	User::verifylogin(); //verificar se está logado
	$page = new PageAdmin();
     $page->setTpl("users-update");
});

$app->post('/admin/users/create', function(){
	User::verifylogin();

});

$app->post('/admin/users/:iduser', function($iduser){
	User::verifylogin();
	
});

$app->delete('/admin/users/:iduser', function($iduser){
	User::verifylogin();
	
});

$app->run();

 ?>