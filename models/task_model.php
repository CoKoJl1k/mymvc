<?php

class Task_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function userList($limit=false, $page = false, $sort_value = false)
	{
	
		$limit = (int) $limit;
		$start = (int) $start;
		$start = ($page - 1) * $limit;

		if ($sort_value == 1) {
		    $sth = $this -> db -> prepare('select id,  name, email , text, status, (select count(id)  as id  from tasks) as total, :page as page from tasks order by name LIMIT :start, :limit');
		 } elseif ($sort_value == 2) {
		    $sth = $this -> db -> prepare('select id,  name, email , text , status, (select count(id)  as id  from tasks) as total, :page as page from tasks order by email LIMIT :start, :limit');   
		} elseif ($sort_value == 3) {
		    $sth = $this -> db -> prepare('select id,  name, email , text , status, (select count(id)  as id  from tasks) as total, :page as page from tasks order by status  LIMIT :start, :limit');    	
		} else {
			$sth = $this -> db -> prepare('select id,  name, email , text, status, (select count(id)  as id  from tasks) as total, :page as page from tasks order by id LIMIT :start, :limit'); 
		}

	    $sth->bindValue(":start", $start, PDO::PARAM_INT);
        $sth->bindValue(":limit", $limit, PDO::PARAM_INT);
        $sth->bindValue(":page", $page, PDO::PARAM_INT);
       
        $sth -> execute();
     	return $sth -> fetchAll();    	
	}

	public function create($data)
    {
		$sth = $this -> db -> prepare ('insert into tasks (`name`, `email`, `text`  ) values (:name, :email , :text)');
		$sth -> execute( array(
			':name' => htmlspecialchars($data['name']),
			':email' => htmlspecialchars($data['email']), 
			':text' => htmlspecialchars($data['text'])
		));

		$count = $sth -> rowCount();

		if ($count > 0){
			echo '<script type="text/javascript">
						window.location = "../task";
						alert("Задача успешно создана!");
				  </script>';
		} else {
			 //show error
			header('location: ../error');
		}

	}

}
?>