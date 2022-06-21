<?php

class Login_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
		//echo md5('jesse');
	}

	function checkUser($data_check)
	{
		$sth = $this->db->prepare ("select id, role from users where login = :login and password = md5(:password)");
		$sth->execute (array (
			':login' => $data_check['login'],
			':password' => $data_check['password']
		 ));

		$data = $sth->fetch();
		$count = $sth->rowCount();

//var_dump(addslashes(htmlspecialchars($_POST['password'])));
        //$password = 123;
       //$password = md5($password);
		//var_dump($data,$password);

		if ($count > 0){

		    return $data;
			//login

		} else {
			 //show error
            return false;
            echo 'Неправильный логин или пароль';
           //  throw new Exception('Data was not insert into table');
			//header('location: ../error');
		}
	}
}