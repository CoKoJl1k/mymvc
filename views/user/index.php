
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
                <a  href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['page'] ?>&sort=<?= $data['columns'][0] ?>">№</a>
            </th>
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
        </tr>
        <?php // echo '<pre>'; print_r($data); echo '<pre>';  exit();?>
        <?php if (count($data['comment']) > 0) {  ?>
            <?php  foreach ($data['comment'] as $value) { ?>
                <tr>
                    <td><?= $value['id'] ?></td>
                    <td><?= $value['name'] ?></td>
                    <td><?= $value['phone'] ?></td>
                    <td><?= $value['email'] ?></td>
                    <td><?= $value['text'] ?></td>
                    <td><?= $value['status'] == 'Y' ?  'Принят' :  'Отклонен' ?></td>
                   <!-- <td><?//=  $value['file_name']?></td>-->
                    <td><?= $value['date_create']?></td>

                    <!--<td><a class="opener" href="#"><input type="hidden" value="<? //= $value['id'] ?>"/>Предварительный просмотр</a></td> -->
                    <td><img src="<?=URL?>uploads/<?= $value['file_name']?>" width="100px" height="70px"/> </td>

                    <td><a  href="<?URL?>user/edit?id=<?= $value['id'] ?>">Редактировать</a></td>

                </tr>
            <?php } ?>
        <?php } ?>
    </table>
<?php } ?>

<nav aria-label="Page navigation example">
    <ul class="pagination">
        <?php if ($data['page'] != 1) { ?>
            <li class="page-item"><a class="page-link" href="<?= URL ?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Previous'] ?>">Предыдущая</a></li>
        <?php } ?>
        <?php  for($i = 1; $i<= $data['pages']; $i++) {?>
            <li class="page-item  <?= $data['page'] == $i ? 'active' : ''?> " ><a class="page-link " href="<?=URL?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $i ?>"><?= $i ?></a></li>
        <?php }?>
        <li class="page-item"><a class="page-link" href="<?= URL ?>user?limit=<?= $data['limit'] ?: '' ?>&page=<?= $data['Next'] ?>">Следующая</a></li>
    </ul>
</nav>
<!--
<div id="ModalDialogComment">
</div>
-->
<script>
    /*
    $(function() {
        $( "#ModalDialogComment" ).dialog({
            width : 650,
            height:550,
            title:"Детальная информация",
            modal : true ,
            autoOpen: false,
            show: {
                effect: "blind",
                duration: 300
            },
            hide: {
                effect: "explode",
                duration: 300
            }
        });

        $(document).on('click', '.opener', function () {
            let id_val = $("input", this ).val();
            $( ".modal-dialog__data" ).remove();
            //id_val = 2088;
            $.post(
                "<?=URL?>comment/ajaxDetail",
                {
                    id: id_val,
                },
                function(data, status){
                    data = JSON.parse(data);
                    // console.log(data);
                    if (status ==='success' && data.length !== 0) {
                        $( "#ModalDialogComment" ).append( "<p class='modal-dialog__data'><b>Имя : </b>"+data[0].name+"</p>" );
                        $( "#ModalDialogComment" ).append( "<p class='modal-dialog__data'><b>Email : </b>"+data[0].email+"</p>" );
                        $( "#ModalDialogComment" ).append( "<p class='modal-dialog__data'><b>Текст комментария: </b>"+data[0].text+"</p>" );
                        $( "#ModalDialogComment" ).append( "<p class='modal-dialog__data'><b>Телефон : </b>"+data[0].phone+"</p>" );
                        $( "#ModalDialogComment" ).append( "<div class='modal-dialog__data'><img src='<?=URL?>uploads/"+data[0].file_name+"'/></div>" );
                        $( "#ModalDialogComment" ).append( "<p class='modal-dialog__data'><b>Дата создания : </b>"+data[0].date_create+"</p>" );
                        $( "#ModalDialogComment" ).dialog( "open" );
                    } else {
                        $( "#ModalDialogComment" ).append( "<h4 class='modal-dialog__data'>Данные не найдены!</h4>" );
                        $( "#ModalDialogComment" ).dialog( "open" );
                    }
                });
        });
    });*/
</script>