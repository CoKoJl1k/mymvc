<?php 

class Comment extends Controller {


	function __construct() {
		parent::__construct();	
		//echo "We are in index </br>";
	}

	function index() {

        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $sort = $this->get_params['sort'] ?: 'id';
        $data = $this->model->userList($limit, $page, $sort);

 		$this->view->render('comment/index', $data);
 	}

/*
 	function pagination() {
        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $sort = $this->get_params['sort'] ?: 'id';
        $data = $this->model->userList($limit, $page, $sort);

 		$this->view->render('comment/index', $data);
 	}
*/
 	public function create(){	
		$data = array();
        if (!empty($_POST)) {
            $data['name'] = htmlspecialchars(stripslashes($_POST['name']));
            $data['email'] = htmlspecialchars(stripslashes($_POST['email']));
            $data['text'] = htmlspecialchars(stripslashes($_POST['text']));
        }

		$this->model->create($data);
		$this->view->userList = $this->model->userList(3, 1);
	}
}