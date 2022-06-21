<h4>Редактирование комментария</h4>
<?php
echo '<pre>'; print_r($data); echo '</pre>';
echo '<pre>'; print_r($_SESSION); echo '</pre>';
?>

<form method="post" action="<?=URL?>user/editSave">
    <div class = "d-flex justify-content-center">
        <div class="col-md-4 mb-3">
            <input type="hidden" name="id" value="<?=$this->user['id']?>">
            <input type="hidden" name="role" value="<?=$this->user['role']?>">

            <label><b>Текст комментария</b></label>
            <textarea class="form-control"  type="textarea" name="text" rows="10" value="<?=$data['text'] ?> "><?=$data['text']?></textarea>
            <!--<label class="col-2">Выполнено</label>-->
            <?php
            /*
                if ( $this->user['status'] == 'Y') {
                    echo ' <input id = "StatusCheck" type="checkbox" name="status" value="Y"  checked ><br/>';
                } else {
                    echo '<input id = "StatusCheck" type="checkbox" name="status" value="N"> <br/>';
                }
            */?>
        </div>
    </div>

    <div class = "d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>


</form>

<script type="text/javascript">
    /*
    var StatusCheck = document.getElementById("StatusCheck");
    StatusCheck.addEventListener("click", function() {
        var status =  $("#StatusCheck").val();
        if (status == "Y" ){
            $("#StatusCheck").val("N");
        } else {
            $("#StatusCheck").val("Y");
        }
    }, false);*/
</script>