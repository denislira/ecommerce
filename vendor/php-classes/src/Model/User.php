<?php

namespace PhpClass\Model;

use \PhpClass\DB\Sql;
use \PhpClass\Model;

class User extends Model{

 const SESSION = "User";

	public static function login($login, $password){

		$sql = new Sql();
		$result = $sql->select("SELECT * FROM tb_users WHERE deslogin = :LOGIN", array(
            ":LOGIN"=>$login
		));

		if (count($result)===0)
		{
			throw new \Exception("Usuário não existe", 1);
			
		}

		$data = $result[0];

		if (password_verify($password, $data['despassword']) === true)
		{
			$user = new User();

			$user->setData($data);

			$_SESSION[User::SESSION] = $user->getValues();

			return $user;

		}else{
			throw new \Exception("Senha Incorreta", 1);
		}
	}

	public static function verifylogin($inadmin = true)
	{
		if(!isset($_SESSION[User::SESSION])
			|| !$_SESSION[User::SESSION]
			|| !(int)$_SESSION[User::SESSION]['iduser'] > 0
			|| (bool)$_SESSION[User::SESSION]['inadmin'] !== $inadmin
		){
			header("Location: admin/login");
			exit;
		}
	}

	public static function logout()
	{
		$_SESSION[User::SESSION] = NULL;
	}

	public static function listAll(){
		$sql = new Sql();
	return $sql->select("SELECT * FROM tb_users a INNER JOIN tb_persons b USING(idperson) ORDER BY b.desperson");
	}

}

?>