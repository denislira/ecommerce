<?php

namespace PhpClass\Model;

use \PhpClass\DB\Sql;
use \PhpClass\Model;

class User extends Model{


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

		}else{
			throw new \Exception("Senha Incorreta", 1);
		}
	}
}

?>