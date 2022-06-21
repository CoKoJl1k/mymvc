<?php

class Comment_Model extends Model
{

	function __construct()
	{
		parent::__construct();
	}

	public function getListComments($limit = null, $page = null, $sort = null)
	{
        $sthTotal = $this->db->prepare('select count(id) as total from comments where status = "Y"');
        $sthTotal->execute();
        $arrTotal = $sthTotal->fetchAll();
        $data['total'] = $arrTotal[0]['total'];

        $limit = $limit ?: 3;
        $page =  $page ?: 1;
        $sort = $sort ?: 'date_create';
        $start = ($page - 1) * $limit;

        $sth = $this->db->prepare('select id, name, email, text, status, phone, file_name, date_create from comments  where status = "Y" order by '.$sort.' DESC LIMIT :start, :limit');

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


    public function create($data)
    {
        $count = 0;
        if (!empty($data)) {
            $sth = $this->db->prepare('insert into comments (name, email, text, phone, file_name) values (:name, :email, :text, :phone, :file_name)');
            $sth->execute(array(
                ':name' => $data['name'],
                ':email' => $data['email'],
                ':text' => $data['text'],
                ':phone' => $data['phone'],
                ':file_name' => $data['file_name']
            ));
            $count = $sth->rowCount();
        }
        if ($count > 0) {
            return true;
		} else {
            return false;
		}
	}

    public function detail($id = 0)
    {
        $sth = $this->db->prepare('select id, name, email, text, status, phone, file_name, date_create from comments where id = :id');
        $sth->bindValue(":id", $id, PDO::PARAM_INT);
        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_ASSOC);
    }
}