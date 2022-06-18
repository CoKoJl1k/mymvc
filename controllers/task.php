<?php 


class Task extends Controller {
	function __construct() {
		parent::__construct();	
		//echo "We are in index </br>";	
	}

	function index() {
		//echo 'Inside index index ';	
		$this->view->userList = $this->model->userList(3,1);
 		$this->view->render('task/index');
 	}

 	function pagination($limit , $page, $sort_value) {
 		$this->view->userList = $this->model->userList($limit, $page, $sort_value);
 		$this->view->render('task/index');

 	}

 	public function create(){	
		$data = array();
		$data['name'] = $_POST['name'];
		$data['email'] = $_POST['email'];
		$data['text'] = $_POST['text'];

		// @TODO :Do your error checking

		$this->model->create($data);
		$this->view->userList = $this->model->userList(3, 1);
	}
}
?>