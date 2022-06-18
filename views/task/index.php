<h4>Создание задачи</h4>

<?php  
    $url = isset($_GET['url']) ? $_GET['url'] : null ;
    $url = rtrim($url, '/');
    $url = explode('/', $url);
    $url[3] = isset( $url[3] ) ? $url[3] : 1 ;
?>

<form method="post" action="<?php echo URL;?>task/create">
	<label class="col-1">Имя</label><input type="name" name="name"><br/>
	<label class="col-1">Email</label><input type="email" name="email"><br/>
	<label class="col-1">Текст задачи</label><textarea type="textarea" name="text"></textarea><br/>
	<label class="col-1">&nbsp;</label> <button type="submit" class="btn btn-primary">Добавить</button> 
</form>

  <div class="row">
        <div class="col-2"> <h4>Список задач</h4></div>
        <div class="col-2"></div>
        <div class="col-2"><a href="<?php echo URL; ?>task/pagination/3/<?php echo $url[3]; ?>" class="btn btn-primary">Сбросить сортировку</a></div>
  </div>

<table class="table">
  <thead>
    <tr>
      <th scope="col">№</th>
      <th scope="col"><a href="<?php echo URL; ?>task/pagination/3/<?php echo $url[3]; ?>/1">Имя</a></th>
      <th scope="col"><a href="<?php echo URL; ?>task/pagination/3/<?php echo $url[3]; ?>/2">email</a></th>    
      <th scope="col">Текст задачи</th> 
      <th scope="col"><a href="<?php echo URL; ?>task/pagination/3/<?php echo $url[3]; ?>/3">Статус</a></th> 
    </tr>
    <?php // echo '<pre>'; print_r($data); echo '<pre>';  exit();?>
    <?php if (count($data['tasks']) > 0) {  ?>
        <?php  foreach ($data['tasks'] as $value) { ?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['name'] ?></td>
            <td><?= $value['email'] ?></td>
            <td><?= $value['text'] ?></td>
            <td><?= $value['status'] == 'Y' ?  'Выполнено' :  'Не выполнено' ?></td>
        </tr>
        <?php } ?>
    <?php  } ?>

<?php
//echo '<pre>'; print_r($data); echo '<pre>';
?>
</table>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="<?= URL ?>task/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Previous'] ?>">Предыдущая</a></li>
        <?php  for($i = 1; $i<= $data['pages']; $i++) : ?>
            <li class="page-item"><a class="page-link" href="<?=URL?>task/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item"><a class="page-link" href="<?= URL ?>task/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Next'] ?>">Следующая</a></li>
    </ul>
</nav>

<?php
//var_dump(  $url[4] );
//exit();
?>
