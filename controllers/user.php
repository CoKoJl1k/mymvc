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
        $data = $this->model->getListComments($limit, $page, $sort);
		$this->view->render('user/index',$data);
	}

	public function edit()
    {
        $id = $this->get_params['id'] ?: 0;
		$data = $this->model->getComment($id);
		$this->view->render('user/edit', $data);
	}

    public function statusUpdate()
    {
        $data['id'] = $this->get_params['id'] ?: 0;
        $data['status'] = $this->get_params['status'] == "Y" ? "N" : "Y";
        $this->model->statusUpdateComment($data);
        header('location: '.URL.'user');
    }

	public function textUpdate()
    {
        $data['id'] = addslashes(htmlspecialchars($_POST['id']));
		$data['text'] = addslashes(htmlspecialchars($_POST['text']));
		if(!empty($_SESSION['role'])){
            $data['role'] = $_SESSION['role'];
        }

		if($this->model->textUpdateComment($data)) {
            header('location: '.URL.'user');
        } else {
		    echo 'Данные не обновились произошла ошибка.';
        }

	}

	public function delete()
    {
        $data['id'] = $this->get_params['id'] ?: 0;
		$this->model->delete($data['id']);
		header('location: '.URL.'user');
	}
}