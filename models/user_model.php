<?php

class User_Model extends Model
{

	function __construct()
	{
		parent::__construct();
	}

    public function userList($limit = null, $page = null, $sort = null)
    {
        $sthTotal = $this->db->prepare('select count(id) as total from comments');
        $sthTotal->execute();
        $arrTotal = $sthTotal->fetchAll();
        $data['total'] = $arrTotal[0]['total'];

        $limit = $limit ?: 3;
        $page =  $page ?: 1;
        $sort = $sort ?: 'date_create';
        $start = ($page - 1) * $limit;

        $sth = $this->db->prepare('select id, name, email, text, status, phone, file_name, date_create from comments order by '.$sort.' DESC LIMIT :start, :limit');

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

	public function userSingleList($id)
	{
		$sth = $this->db->prepare('select id, text, status from comments where id = :id');
		$sth->execute(array(
			':id' => $id 
		) );
		return $sth->fetch();
	}

	public function editSave($data)
	{
		if ($data['status'] == "") {
			$data['status'] = "N";
		}

		$data_text_old = $this->userSingleList($data['id']);

		if ($data_text_old['text'] == $data['text'] ) {
			$sth = $this->db->prepare('update comments set `status` = :status  where id = :id' );
			$sth -> execute( array(
			':id' => $data['id'],
			':status' => htmlspecialchars($data['status'])
			));
		} else {
			$sth = $this->db->prepare ('update comments set `text` = :text , `status` = :status, `status_edit` =  :status_edit  where id = :id' );
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
		$sth = $this->db->prepare ('delete from comments where id = :id');
		$sth -> execute( array(
			':id' => $id
		));
	}

}