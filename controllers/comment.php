<?php 

class Comment extends Controller {


	function __construct()
    {
		parent::__construct();
	}

	function index()
    {
        $limit = $this->get_params['limit'] ?: 3;
        $page = $this->get_params['page'] ?: 1;
        $sort = $this->get_params['sort'] ?: 'date_create';
        $descAsc = $this->get_params['$descAsc'] ?: 'DESC';

        $data = $this->model->getListComments($limit, $page, $sort, $descAsc);

 		$this->view->render('comment/index', $data);
 	}

 	public function create()
    {
		$data_save = array();
        if (!empty($_POST)) {
            $data_save['name'] = htmlspecialchars($_POST['name']);
            $data_save['email'] = htmlspecialchars($_POST['email']);
            $data_save['text'] = htmlspecialchars($_POST['text']);
            $data_save['phone'] = htmlspecialchars($_POST['phone']);
        }

        $data_save_file = array();

        if (!empty($_FILES)) {
            $data_save_file = $this->saveFile();
            $data_save['file_name'] = $data_save_file['file_name'];
        }

        $message = $data_save_file['message'];

        if ($this->model->create($data_save)) {
            $message .= ' Data was saved! ';
        }

        $data = $this->model->getListComments();
        $data['message'] = $message;
        $this->view->render('comment/index', $data);
	}


	public function ajaxDetail()
    {
        if(isset($_POST['id'])) {
            $id = htmlspecialchars($_POST['id']);
            $data = $this->model->detail($id);

            //var_dump($data);
            echo json_encode($data);
        }
        return false;
    }


    public function saveFile()
    {
        $target_dir = "uploads/";
        $target_file = $target_dir . date("YmdHis"). '_' .basename(htmlspecialchars($_FILES["fileToUpload"]["name"]));
        $file_name = !empty($_FILES["fileToUpload"]["name"]) ? basename($target_file) : '';
        //var_dump($file_name );
        //exit();
        $uploadOk = 1;

        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Check if image file is a actual image or fake image

        if(isset($_POST["submit"])) {
            $check = getimagesize(htmlspecialchars($_FILES["fileToUpload"]["tmp_name"]));
            //var_dump($check);

            if($check !== false) {
                $message = "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $message = "File is not an image.";
                $uploadOk = 0;
            }
        }

        if ($_FILES["fileToUpload"]["size"] > 5000000) {
            $message = "Sorry, your file is too large. Max size file is 5Mb";
            $uploadOk = 0;
        }

        if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
            $message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            $message .= " Your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {

            if (move_uploaded_file(htmlspecialchars($_FILES["fileToUpload"]["tmp_name"]), $target_file)) {

                list($width, $height) = getimagesize($target_file);

                if ($width > 320 || $height > 240) {
                    if ($imageFileType == "jpg" || $imageFileType == "jpeg") $image = imagecreatefromjpeg($target_file);
                    if ($imageFileType == "png") $image = imagecreatefrompng($target_file);
                    if ($imageFileType == "gif") $image = imagecreatefromgif($target_file);
                    if(!empty($image)) {
                        $imgResized = imagescale($image, 320, 240);
                    }
                    if(!empty($imgResized)) {
                        if ($imageFileType == "jpg" || $imageFileType == "jpeg") imagejpeg($imgResized, $target_file);
                        if ($imageFileType == "png") imagepng($imgResized, $target_file);
                        if ($imageFileType == "gif") imagegif($imgResized, $target_file);
                    }
                }

                $message = "The file ". htmlspecialchars(basename($_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                $message = "Sorry, there was an error uploading your file.";
            }
        }
        $data['uploadOk'] = $uploadOk;
        $data['message'] = $message;
        $data['file_name'] = $file_name;
        return $data;
    }
}