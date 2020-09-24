<?php 

class Login extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Session::init();
		Session::destroy();
	//	echo 'das';
		//header('location: ../login');
 		$this -> view -> render('login/index', false);	
 	}

 	function run() {
 		$this -> model -> run();
 	}
 	
}
?>