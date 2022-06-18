<?php 

class Task extends Controller {


	function __construct() {
		parent::__construct();	
		//echo "We are in index </br>";

	}

	function index() {
		//echo 'Inside index index ';

        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $data = $this->model->userList($limit,$page);

 		$this->view->render('task/index', $data);
 	}


 	function pagination() {
        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $sort_value = $this->get_params['sort'] ?: '';
        //var_dump($this->get_params, $limit);
	   // die();
        $data = $this->model->userList((int)$limit, (int)$page, $sort_value);
        $data['limit'] = $limit;

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