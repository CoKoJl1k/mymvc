<?php 

class Task extends Controller {


	function __construct() {
		parent::__construct();	
		//echo "We are in index </br>";

	}

	function index() {
		//echo 'Inside index index ';
		//$this->view->userList = $this->model->userList(3,1);

        $data = $this->model->userList(3,1);
 		$this->view->render('task/index', $data);
 	}


 	function pagination($limit = 3, $page = 0, $sort_value = 10) {
        $limit = $this->get_params['limit'] ?: '';
        $page = $this->get_params['page'] ?: '';
        $sort_value = $this->get_params['sort'] ?: '';
       // var_dump($this->get_params);
	    //die();
        $data = $this->model->userList($limit, $page, $sort_value);
 		$this->view->render('task/index', $data);

 	}

 	public function create(){	
		$data = array();
        if (!empty($_POST)) {
            $data['name'] = $_POST['name'];
            $data['email'] = $_POST['email'];
            $data['text'] = $_POST['text'];
        }
		$this->model->create($data);
		$this->view->userList = $this->model->userList(3, 1);
	}
}