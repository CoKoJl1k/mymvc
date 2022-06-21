<?php

class Login_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
		//echo md5('123');
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

		if ($count > 0){
		    return $data;
		} else {
            return false;
		}
	}
}