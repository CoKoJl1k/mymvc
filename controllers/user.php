<?php


class User extends Controller
{
	public function __construct()
    {
		parent::__construct();
		Session::init();
		$logged = Session::get('loggedIn');
		$role = Session::get('role');
		
		if ($logged == false || $role != 'owner' ) {
			Session::destroy();
			header('location: ../login');
			exit;
		}
	}

	public function index()
    {
        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $sort = $this->get_params['sort'] ?: 'date_create';
        $descAsc = $this->get_params['$descAsc'] ?: 'DESC';
        $data = $this->model->userList($limit, $page, $sort, $descAsc);

		$this->view->render('user/index',$data);
	}

	public function edit()
    {
        $id = $this->get_params['id'] ?: 0;

		$this->view->user = $this->model->userSingleList($id);
		$this->view->render('user/edit');
	}

	public function editSave($id) {	
		$data = array();
		$data['id'] = $id;
		$data['text'] = $_POST['text'];
		$data['status'] = $_POST['status'];

		$this -> model -> editSave($data);
		header('location: '.URL.'user');
	}

	public function delete($id) {
		$this -> model -> delete($id);
		header('location: '.URL.'user');
	}
	
}