<?php

class Task_Model extends Model
{
	public $table = 'tasks';
	function __construct()
	{
		parent::__construct();
	}

	public function userList($limit=false, $page = false, $sort_value = false)
	{

		$limit = (int) $limit;
        $start = 0;
		$start = ($page - 1) * $limit;

        $sthTotal = $this->db->prepare('select count(id) as total from tasks');
        $sthTotal->execute();
        $arrTotal = $sthTotal->fetchAll();
        $data['total'] = $arrTotal[0]['total'];

       // echo '<pre>'; print_r($total); echo '<pre>';
       // echo '<pre>'; print_r($arrTotal); echo '<pre>';
       // exit();

        if ($sort_value == 1) {
            $sth = $this->db->prepare('select id, name, email, text, status, :page as page from tasks order by name LIMIT :start, :limit');
        } elseif ($sort_value == 2) {
            $sth = $this->db->prepare('select id, name, email, text, status, :page as page from tasks order by email LIMIT :start, :limit');
        } elseif ($sort_value == 3) {
            $sth = $this->db->prepare('select id, name, email, text, status, :page as page from tasks order by status  LIMIT :start, :limit');
        } else {
            $sth = $this->db->prepare('select id, name, email, text, status, :page as page from tasks order by id LIMIT :start, :limit');
        }
	    $sth->bindValue(":start", $start, PDO::PARAM_INT);
        $sth->bindValue(":limit", $limit, PDO::PARAM_INT);
        $sth->bindValue(":page", $page, PDO::PARAM_INT);
        $sth->execute();

        $data['tasks'] = $sth->fetchAll();
        //echo '<pre>'; var_dump($data); echo '<pre>';

        //echo '<pre>'; print_r($data); echo '<pre>';
        //exit();
        return $data;
     	//return $sth->fetchAll();
	}

    /**
     * @throws Exception
     */
    public function create($data)
    {
        $count = 0;
        var_dump($data);
        if (!empty($data)) {
            $sth = $this->db->prepare('insert into tasks (name, email, text) values (:name, :email, :text)');
            $sth->execute(array(
                ':name' =>  htmlspecialchars($data['name']),
                ':email' => htmlspecialchars($data['email']),
                ':text' => htmlspecialchars($data['text'])
            ));
            $count = $sth->rowCount();
        }

        if ($count > 0){
			echo '<script type="text/javascript">
						window.location = "../task";
						alert("Task added successful!");
				  </script>';
		} else {
			 //show error
            throw new Exception('Data was not insert into table ' . $this->table);
			//header('location: ../error');
		}

	}
}