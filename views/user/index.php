<?php  
  $url = isset($_GET['url']) ? $_GET['url'] : null ;
  $url = rtrim($url, '/');
  $url = explode('/', $url);
  $url[3] = isset($url[3]) ? $url[3] : 1 ; 
?>

<div class="row">
        <div class="col-2"> <h4>Список задач</h4> </div>
        <div class="col-2"></div>
        <div class="col-2"><a href="<?php echo URL; ?>user/pagination/3/<?php echo $url[3]; ?>" class="btn btn-primary">Сбросить сортировку</a> </div>
</div>


<table class="table">
  <thead>
    <tr>
      <th scope="col">№</th>
      <th scope="col"><a href="<?php echo URL; ?>user/pagination/3/<?php echo $url[3]; ?>/1">Имя</a></th>
      <th scope="col"><a href="<?php echo URL; ?>user/pagination/3/<?php echo $url[3]; ?>/2">email</a></th>
      <th scope="col">Текст задачи</th>
      <th scope="col"><a href="<?php echo URL; ?>user/pagination/3/<?php echo $url[3]; ?>/3">Статус</a></th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>	
<?php
	foreach ($this -> userList as $key => $value) {
		echo '<tr>';
		echo '<td>'.$value['id'].'</td>';
		echo '<td>'.$value['name'].'</td>';
		echo '<td>'.$value['email'].'</td>';
		echo '<td>'.$value['text'].'</td>';
    echo '<td>'   .$value['status'] = $value['status'] == 'Y' ? 'Выполнено' :  'Не выполнено'.'</td>';
    echo '<td>'.$value['status_edit'].'</td>';
		echo '<td><a href="'.URL.'user/edit/'.$value['id'].'">Редактировать</a><span> / </span>
		          <a href="'.URL.'user/delete/'.$value['id'].'">Удалить</a></td>';

		echo '</tr>';
	}	

	$pages = ceil($this -> userList[0]['total']/3);
	$page = $this -> userList[0]['page'];

    if ($page == 1) {
    	$Previous = $page ;
    } else{
    	$Previous = $page - 1;
    }

    if ($page == $pages) {
    	$Next = $pages ;
    } else{
    	$Next = $page + 1;
    }
	//print_r($this -> userList);
?>
</table>
<nav aria-label="Page navigation example">
  <ul class="pagination">
    <li class="page-item"><a class="page-link" href="<?php echo URL; ?>user/pagination/3/<?= $Previous; ?>/<?php echo $url[4]; ?>">Следующая</a></li>
     <?php  for($i = 1; $i<= $pages; $i++) : ?>
		    <li class="page-item"><a class="page-link" href="<?php echo URL; ?>user/pagination/3/<?= $i; ?>/<?php echo $url[4]; ?>"><?= $i; ?></a></li>
	 <?php endfor; ?>
     <li class="page-item"><a class="page-link" href="<?php echo URL; ?>user/pagination/3/<?= $Next; ?>/<?php echo $url[4]; ?>">Предыдущая</a></li>
  </ul>
</nav>