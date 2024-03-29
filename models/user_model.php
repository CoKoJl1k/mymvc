<?php

class User_Model extends Model
{

	function __construct()
	{
		parent::__construct();
	}

    public function getListComments($limit = null, $page = null, $sort = null)
    {
        $sthTotal = $this->db->prepare('select count(id) as total from comments');
        $sthTotal->execute();
        $arrTotal = $sthTotal->fetchAll();
        $data['total'] = $arrTotal[0]['total'];

        $limit = $limit ?: 3;
        $page =  $page ?: 1;
        $sort = $sort ?: 'date_create';
        $start = ($page - 1) * $limit;

        $sth = $this->db->prepare('select id, name, email, text, status, phone, file_name, date_create, status_edit from comments order by '.$sort.' DESC LIMIT :start, :limit');

        $sth->bindValue(":start", $start, PDO::PARAM_INT);
        $sth->bindValue(":limit", $limit, PDO::PARAM_INT);

        $sth->execute();
        $data['comment'] = $sth->fetchAll(PDO::FETCH_ASSOC);

        if(!empty($data['comment'][0])) {
            foreach ($data['comment'][0] as $key => $value) {
                $data['columns'][] = $key;
            }
        }

        $data['limit'] = $limit;
        $data['page'] = $page;
        $data['pages'] = ceil($data['total']/3);
        $data['Previous'] = $page == 1 ? $data['total'] : $page - 1;
        $data['Next'] = $page == $data['pages'] ? $data['pages'] : $page + 1;

        return $data;
    }

	public function getComment($id)
	{
		$sth = $this->db->prepare('select id, text, status from comments where id = :id');
		$sth->execute(array(
			':id' => $id 
		) );
		return $sth->fetch(PDO::FETCH_ASSOC);
	}

    public function delete($id)
	{
		$sth = $this->db->prepare ('delete from comments where id = :id');
		$sth -> execute( array(
			':id' => $id
		));
	}

    public function statusUpdateComment($data)
    {
        $sth = $this->db->prepare('update comments set `status` = :status where id = :id');
        $sth->execute( array(
            ':id' => $data['id'],
            ':status' => $data['status'],
        ));
    }

    public function textUpdateComment($data)
    {
        $sth = $this->db->prepare('update comments set text = :text, status_edit = :role where id = :id');
        return $sth->execute( array(
            ':id' => $data['id'],
            ':text' => $data['text'],
            ':role' => $data['role']
        ));
    }
}