<?php 


class Login extends Controller {

	function __construct()
    {
		parent::__construct();
	}

	function index()
    {
		Session::init();
		Session::destroy();
 		$this->view->render('login/index', false);
 	}

 	function run()
    {
        $data_check =array();
        if (!empty($_POST)) {
            $data_check['login'] = addslashes(htmlspecialchars($_POST['login']));
            $data_check['password'] = addslashes(htmlspecialchars($_POST['password']));
        }
        $data_user = $this->model->checkUser($data_check);

        if ($data_user) {
            Session::init();
            Session::set('role', $data_user['role']);
            Session::set('loggedIn',true);
            header('location: ../user');
        } else {
            header('location: ../login');
        }
 	}
}
