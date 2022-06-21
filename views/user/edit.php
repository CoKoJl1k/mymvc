<h4>Редактирование комментария</h4>

<form method="post" action="<?=URL?>user/textUpdate">
    <div class = "d-flex justify-content-center">
        <div class="col-md-4 mb-3">
            <input type="hidden" name="id" value="<?=$data['id']?>">
            <label><b>Текст комментария</b></label>
            <textarea class="form-control"  type="textarea" name="text" rows="10" value="<?=$data['text'] ?> "><?=$data['text']?></textarea>
        </div>
    </div>
    <div class = "d-flex justify-content-center">
        <button type="submit" class="btn btn-primary">Сохранить</button>
    </div>
</form>