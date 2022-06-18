<?php 

class Bootstrap {

	function __construct()
    {
		$url = isset($_GET['url']) ? $_GET['url'] : null ;
		$url = rtrim($url, '/');
		$url = explode('/', $url);

		/*print_r($url) ;*/

		if (empty($url[0])){	
			$url[0] = 'task';
		}

		$file = 'controllers/' . $url[0] . '.php';

		if (file_exists($file)){
			require $file;
		} else{
			require 'controllers/apperror.php';
			//$controller = new AppError();
			//return false;
			throw new Exception("The file :  $file  Does not exists. ");
		}

//var_dump($url[0]);

		$controller = new $url[0];
		$controller->loadModel($url[0]);

		if (isset($url[2])) {

			if (method_exists($controller, $url[1])){
				$controller->{$url[1]}($url[2], $url[3], $url[4]);
			} else {
				echo "method doesn't exists";
			}

		} else {

			if (isset($url[1])) {
				$controller->{$url[1]}();
			} else {
				$controller->index();
			}
		}
	}
}