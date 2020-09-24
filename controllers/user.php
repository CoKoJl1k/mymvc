<?php

class User extends Controller
{
	public function __construct() {
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

	public function index() {
		$this -> view  -> userList = $this -> model -> userList(3,1);
		$this -> view -> render('user/index');
	}


	function pagination($limit , $page, $sort_value) {
 		$this -> view  -> userList = $this -> model -> userList($limit, $page, $sort_value);	
 		$this -> view -> render('user/index');

 	}

	public function edit($id) {	
		$this -> view -> user = $this -> model -> userSingleList($id);
		$this -> view -> render ('user/edit');
	}

	public function editSave($id) {	
		$data = array();
		$data['id'] = $id;
		$data['text'] = $_POST['text'];
		$data['status'] = $_POST['status'];
		// @TODO :Do your error checking
		$this -> model -> editSave($data);
		header('location: '.URL.'user');
	}

	public function delete($id) {
		$this -> model -> delete($id);
		header('location: '.URL.'user');
	}
	
}

?>