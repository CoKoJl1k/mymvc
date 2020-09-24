<?php

class Login_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
		//echo md5('jesse');
	}

	function run()
	{
		$sth = $this -> db -> prepare ("select id, role from users where login = :login and password = md5(:password)");
		$sth -> execute (array (
			':login' => htmlspecialchars ($_POST['login']),
			':password' => addslashes(htmlspecialchars($_POST['password']))
		 ));

		$data = $sth -> fetch();
		$count = $sth -> rowCount();

		if ($count > 0){
			//login
			Session::init();
			Session::set('role', $data['role']);
			Session::set('loggedIn',true);
			header('location: ../user');
		} else {
			 //show error
			header('location: ../error');
		}

	}

}
?>