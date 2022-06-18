<?php

class View {
	
	function __construct(){

	}

    public function render($name, $data = null){
			require 'views/header.php'; 
			require 'views/'.$name.'.php';
			require 'views/footer.php';
	}
}