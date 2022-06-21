
<div class="row">
    <div class="col-2"><h4>Список комментариев</h4></div>
</div>

<?php
//$data=array('limit'=>3);
//echo '<pre>'; print_r($data); echo '<pre>';
?>
<?php if (count($data) > 0) {  ?>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][1] ?>">Имя</a>
            </th>
            <th scope="col">
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][5] ?>">Телефон</a>
            </th>

            <th scope="col">
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][2] ?>">email</a>
            </th>
            <th scope="col">
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][3] ?>">Текст сообщения</a>
            </th>
            <th scope="col">
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][4] ?>">Статус</a>
            </th>
          <!--  <th scope="col">Изображение</th>-->
            <th scope="col">
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][6] ?>">Дата создания</a>
            </th>
        <!--    <th>Предварительный просмотр</th>-->
            <th scope="col">Изображение</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
        </tr>
        <?php // echo '<pre>'; print_r($data); echo '<pre>';  exit();?>
        <?php if (count($data['comment']) > 0) {  ?>
            <?php  foreach ($data['comment'] as $value) { ?>
                <tr>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['phone'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['text'] ?></td>
                    <td><a href="<?URL?>user/statusUpdate?id=<?= $value['id']?>&status=<?= $value['status']?>"><?= $value['status'] == 'Y' ?  'Принят' :  'Отклонен' ?></a></td>
                    <td><?= $value['date_create']?></td>
                    <td><img src="<?=URL?>uploads/<?= $value['file_name']?>" width="100px" height="70px"/></td>
                    <td><a  href="<?URL?>user/edit?id=<?= $value['id'] ?>">Редактировать</a></td>

                    <td><?= $value['status_edit'] === 'owner' ? 'Изменен администратором' : '' ?></td>
                </tr>
            <?php } ?>
        <?php } ?>
    </table>
<?php } ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($data['page'] != 1) { ?>
            <li class="page-item"><a class="page-link" href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Previous'] ?>">Предыдущая</a></li>
        <?php } ?>
        <?php  for($i = 1; $i<= $data['pages']; $i++) {?>
            <li class="page-item  <?= $data['page'] == $i ? 'active' : ''?> " ><a class="page-link " href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php }?>
        <li class="page-item"><a class="page-link" href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Next'] ?>">Следующая</a></li>
    </ul>
</nav>