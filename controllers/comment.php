<?php 

class Comment extends Controller {


	function __construct() {
		parent::__construct();	
		//echo "We are in index </br>";
	}

	function index() {
		//echo 'Inside index index ';
        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $data = $this->model->userList($limit,$page);

 		$this->view->render('comment/index', $data);
 	}


 	function pagination() {
        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $sort = $this->get_params['sort'] ?: 'id';
        //var_dump($this->get_params, $limit);
	   // die();

        $data = $this->model->userList($limit, $page, $sort);
        $data['limit'] = $limit;
        $data['page'] = $page;


        $data['pages'] = ceil($data['total']/3);
        $data['Previous'] = $page == 1 ? $data['total'] : $page - 1;
        $data['Next'] = $page == $data['pages'] ? $data['pages'] : $page + 1;

 		$this->view->render('comment/index', $data);

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