<h4>Редактирование задачи</h4>

<form method="post" action="<?php echo URL; ?>user/editSave/<?php echo $this->user['id']; ?> ">
	<label class="col-2">Текст задачи</label><textarea type="textarea" name="text" value="<?php echo $this->user['text']; ?> "><?php echo $this->user['text']; ?></textarea><br/>
	<label class="col-2">Выполнено</label>

	<?php
		if ( $this->user['status'] == 'Y') {
			echo ' <input id = "StatusCheck" type="checkbox" name="status" value="Y"  checked ><br/>';
		} else {
			echo '<input id = "StatusCheck" type="checkbox" name="status" value="N"> <br/>';
		}	
	?>
	 <script type="text/javascript">
		var StatusCheck = document.getElementById("StatusCheck");
			StatusCheck.addEventListener("click", function() {  
				var status =  $("#StatusCheck").val();
					if (status == "Y" ){
					 	$("#StatusCheck").val("N");
					} else {
					 	$("#StatusCheck").val("Y");
					}
			}, false);
	</script>

	<label class="col-2">&nbsp;</label> <button type="submit" class="btn btn-primary">Сохранить</button> 
</form>