<?php

class AppError extends Controller
{
	
	function __construct()
	{
		parent::__construct();
		$this -> view -> render ('error/index');
	}

	function index() {

 	}
}
?>