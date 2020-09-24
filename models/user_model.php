<?php

class User_Model extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function userList($limit=false, $page = false, $sort_value = false)
	{
		$limit = (int) $limit;
		$start = (int) $start;
		$sort_value = (int) $sort_value;
		$start = ($page - 1) * $limit;

		if ($sort_value == 1) {
		    $sth = $this -> db -> prepare('select id,  name, email , text, status, (select count(id)  as id  from tasks) as total, :page as page, status_edit from tasks order by name  LIMIT :start, :limit');
		 } elseif ($sort_value == 2) {
		    $sth = $this -> db -> prepare('select id,  name, email , text , status, (select count(id)  as id  from tasks) as total, :page as page, status_edit from tasks order by email  LIMIT :start, :limit');   
		  } elseif ($sort_value == 3) {
		    $sth = $this -> db -> prepare('select id,  name, email , text , status, (select count(id)  as id  from tasks) as total, :page as page, status_edit from tasks order by status  LIMIT :start, :limit');      	
		} else {
			$sth = $this -> db -> prepare('select id,  name, email , text, status, (select count(id)  as id  from tasks) as total, :page as page, status_edit from tasks order by id LIMIT :start, :limit');
		}

	    $sth->bindValue(":start", $start, PDO::PARAM_INT);
        $sth->bindValue(":limit", $limit, PDO::PARAM_INT);
        $sth->bindValue(":page", $page, PDO::PARAM_INT);
       
        $sth -> execute();
     	return $sth -> fetchAll();    

	}

	public function userSingleList($id)
	{
		$sth = $this -> db -> prepare('select id, text, status from tasks where id = :id');
		$sth -> execute(  array(
			':id' => $id 
		) );
		return $sth -> fetch();
	}

	public function editSave($data)
	{
		if ($data['status'] == "") {
			$data['status'] = "N";
		}

		$data_text_old = $this -> userSingleList($data['id']);

		if ( $data_text_old['text'] == $data['text'] ) {
			$sth = $this -> db -> prepare ('update tasks set  `status` = :status  where id = :id' );
			$sth -> execute( array(
			':id' => $data['id'],		
			':status' => htmlspecialchars($data['status'])
			));

		} else {
			$sth = $this -> db -> prepare ('update tasks set `text` = :text , `status` = :status, `status_edit` =  :status_edit  where id = :id' );
			$sth -> execute( array(
			':id' => $data['id'],
			':text' => htmlspecialchars($data['text']),
			':status' => htmlspecialchars($data['status']),
			':status_edit' => 'отредактировано администратором'		
			));
		}
		
	}

    public function delete($id)
	{
		$sth = $this -> db -> prepare ('delete from tasks where id = :id');
		$sth -> execute( array(
			':id' => $id
		));
	}

}
?>