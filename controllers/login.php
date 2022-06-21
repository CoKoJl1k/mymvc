<?php 

class Login extends Controller {

	function __construct() {
		parent::__construct();
	}

	function index() {
		Session::init();
		Session::destroy();
 		$this->view ->render('login/index', false);
 	}

 	function run() {
 		$this->model -> run();
 	}
}
