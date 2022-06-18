<?php

class Controller 
{
    public $get_params;

    function __construct()
	{
        $url = $_SERVER['REQUEST_URI'] ?: '';
        $url_components = parse_url($url);
        parse_str($url_components['query'], $get_params);

        $get_params['limit'] = $get_params['limit'] ?: '';
        $get_params['limit'] = htmlspecialchars(stripslashes($get_params['limit']));

        $get_params['page'] = $get_params['page'] ?: '';
        $get_params['page'] = htmlspecialchars(stripslashes($get_params['page']));

        $get_params['sort'] = $get_params['sort'] ?: '';
        $get_params['sort'] = htmlspecialchars(stripslashes($get_params['sort']));

        $this->get_params = $get_params;

		$this->view = new View();
	}

	public function loadModel($name)
	{
		$path = 'models/'.$name.'_model.php';

		if ( file_exists($path) ) {
			require 'models/'.$name.'_model.php';
			$modelName = $name.'_Model';
			$this -> model = new $modelName();
		}
	}
}
