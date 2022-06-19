<h4>Добавление комментария</h4>

<form method="post" action="<?php echo URL;?>task/create">
	<label class="col-1">Имя</label><input type="name" name="name"><br/>
	<label class="col-1">Email</label><input type="email" name="email"><br/>
	<label class="col-1">Текст комментария</label><textarea type="textarea" name="text"></textarea><br/>
	<label class="col-1">&nbsp</label> <button type="submit" class="btn btn-primary">Добавить</button>
</form>

  <div class="row">
        <div class="col-2"> <h4>Список комментариев</h4></div>
  </div>

<?php
//echo '<pre>'; print_r($data); echo '<pre>';
?>
<?php if (count($data) > 0) {  ?>
<table class="table">
  <thead>
    <tr>
        <th scope="col">
            <a  href="<?=URL?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][0] ?>">№</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][1] ?>">Имя</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][2] ?>">email</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][3] ?>">Текст задачи</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][4] ?>">Статус</a>
        </th>

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
    <?php } ?>
</table>
<?php  } ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item"><a class="page-link" href="<?= URL ?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Previous'] ?>">Предыдущая</a></li>
        <?php  for($i = 1; $i<= $data['pages']; $i++) : ?>
            <li class="page-item  <?= $data['page'] == $i ? 'active' : ''?> " ><a class="page-link " href="<?=URL?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php endfor; ?>
        <li class="page-item"><a class="page-link" href="<?= URL ?>comment/pagination/?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Next'] ?>">Следующая</a></li>
    </ul>
</nav>

<?php
//var_dump(  $url[4] );
//exit();
?>
