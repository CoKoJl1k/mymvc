
<div class="row">
    <div class="col-2"><h4>Список комментариев</h4></div>
</div>

<?php
//echo '<pre>'; print_r($data); echo '<pre>';
?>
<?php if (count($data) > 0) {  ?>
<table class="table">
  <thead>
    <tr>
        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][0] ?>">№</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][1] ?>">Имя</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][5] ?>">Телефон</a>
        </th>

        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][2] ?>">email</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][3] ?>">Текст сообщения</a>
        </th>
        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][4] ?>">Статус</a>
        </th>
        <th scope="col">Изображение</th>

        <th scope="col">
            <a  href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][6] ?>">Дата создания</a>
        </th>
        <th>Предварительный просмотр</th>
        <th scope="col">Изображение</th>

    </tr>
    <?php // echo '<pre>'; print_r($data); echo '<pre>';  exit();?>
    <?php if (count($data['tasks']) > 0) {  ?>
        <?php  foreach ($data['tasks'] as $value) { ?>
        <tr>
            <td><?= $value['id'] ?></td>
            <td><?= $value['name'] ?></td>
            <td><?= $value['phone'] ?></td>
            <td><?= $value['email'] ?></td>
            <td><?= $value['text'] ?></td>
            <td><?= $value['status'] == 'Y' ?  'Принят' :  'Отклонен' ?></td>

            <td><?= $value['file_name']?></td>

            <td><?= $value['date_create']?></td>
            <td><a href="#">Предварительный просмотр</a></td>

            <td><img src="<?=URL?>/uploads/<?= $value['file_name']?>"/> </td>
        </tr>
        <?php } ?>
    <?php } ?>
</table>
<?php } ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">

        <?php if ($data['page'] != 1) { ?>
            <li class="page-item"><a class="page-link" href="<?= URL ?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Previous'] ?>">Предыдущая</a></li>
        <?php } ?>
        <?php  for($i = 1; $i<= $data['pages']; $i++) {?>
            <li class="page-item  <?= $data['page'] == $i ? 'active' : ''?> " ><a class="page-link " href="<?=URL?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php }?>
        <li class="page-item"><a class="page-link" href="<?= URL ?>?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Next'] ?>">Следующая</a></li>
    </ul>
</nav>
<div >
    <?php // echo '<pre>'; print_r(URL); echo '<pre>';  exit();?>
</div>
<h4>Добавление комментария</h4>

<form method="post" action="<?=URL?>comment/create" enctype="multipart/form-data">
    <div class = "d-flex justify-content-center">
        <div class="col-md-4 mb-3">
            <label for="nameUser">Имя</label>
            <input name="name" class="form-control" id="nameUser" >

            <label for="phoneUser">Телефон</label>
            <input name="phone" class="form-control" id="phoneUser" placeholder="+(375) (99) 999-99-99">
           <!-- <input class="form-control" id="phoneUser" placeholder="123-45-67"  pattern="[0-9]{3}-[0-9]{2}-[0-9]{2}" required>-->
            <label for="emailUser">Email address</label>
            <input name="email" type="email" class="form-control" id="emailUser" placeholder="name@example.com">

            <label for="text">Текст сообщения</label>
            <textarea name ="text" class="form-control" id="text" rows="3"></textarea>

            <input class="form-control" type="file" name="fileToUpload" id="fileToUpload">

            <p><?= $data['message'] ?: ''?></p>
            <div class = "d-flex justify-content-center">
                 <button type="submit" class="btn btn-primary">Отправить</button>
            </div>
        </div>
    </div>

</form>

<?php
//echo date("YmdHis");
?>
