<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>equipment_edit</title>
<link href="css/img.css" rel="stylesheet">
</head>
<body>
	<h3 align="center"><i class="fa fa-wrench" style="font-size:20px"></i> แก้ไขอุปกรณ์</h3><br>
	<?php
    $sql="select * from tb_equipment inner join tb_status on tb_equipment.status_id=tb_status.status_id  where equipment_id='$_GET[equipment_id]'";
	$result=$db->query($sql);
	$row=$result->fetch_array(MYSQLI_BOTH);
	?>
	<div class="row">
		<div class="col-md-4"></div>
               <form accept-charset="UTF-8" action="?page=equipment_update" method="post" enctype="multipart/form-data"> 
				  <div class="col-md-4">
				   <label>ชื่ออุปกรณ์ :</label>
                   <input class="form-control animated" cols="25" name="equipment_name" placeholder="ชื่ออุปกรณ์" rows="3"required="required" value="<?=$row['equipment_name']?>"><br>
					<?php $balance=$row['equipment_number']-$row['equipment_balance']?>
				   <div align="center"><label>จำนวนอุปกณ์ที่มีอยู่ทั้งหมด : <?=$row['equipment_number']?> อยู่ระหว่างยืม : <?=$balance?> คงเหลือ : <?=$row['equipment_balance']?></label></div>
					<input type="hidden" name="balance" value="<?=$balance?>">
				   <input type="hidden" name="equipment_balance" value="<?=$row['equipment_balance']?>">
				   <input type="hidden" name="equipment_numbersum" value="<?=$row['equipment_number']?>">
					<input type="number" class="form-control animated" cols="25" name="equipment_number" placeholder="จำนวน" rows="3" required="required" value="<?=$row['equipment_number']?>" min="<?=$balance?>"><br>
					<label>หมายเลขครุภัณฑ์ :</label>
                    <input class="form-control animated" cols="255" name="dur_id" placeholder="หมายเลขครุภัณฑ์" rows="3" required="required" value="<?=$row['dur_id']?>"><br>
				     <label>รายละเอียดอุปกรณ์ :</label>
					<textarea class="form-control" name="equipment_detail"><?=$row['equipment_detail']?></textarea><br>
				   <label>สถานะ</label>		
					  <select class="form-control animated" name="status_id">
						<?php
						$strDefault=$row["status_id"];
						$sqli="select * from tb_status";
						$resulti=$db->query($sqli);
						while($rowi=$resulti->fetch_array(MYSQLI_ASSOC)){
							if($strDefault == $rowi["status_id"])
							{
								$sel = "selected";
							}
							else
							{
								$sel = "";
							}
						?>
	 <option value="<?php echo $rowi["status_id"];?>" <?php echo $sel;?>><?php echo $rowi["status_name"];?></option>	
						<?php
						}
						?>
						<input type="hidden" name="<?=$row['status_id']?>" value="<?=$rowi['status_id']?>" />
					</select><br>			
			<div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" value="<?=$row['equipment_photo']?>" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span  for="equipment_photo" class="image-preview-input-title" >เลือกรูปภาพ</span>
                        <input type="file" id="file" name="equipment_photo"/> <!-- rename it -->
						<input type="hidden" name="equipment_photo" value="<?=$row['equipment_photo']?>"/>
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]--> 
						<div class="text-center">
                            <div ><br></div>
                            <a class="btn btn-danger" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                            <span class="glyphicon glyphicon-remove"></span>ยกเลิก</a>
							<a href=javascript:history.back(1) class="btn btn-danger"><i class="glyphicon glyphicon-arrow-left"></i> ย้อนกลับ</th></a>
                            <button class="btn btn-success" type="submit">อัพเดทอุปกรณ์</button>

                        </div><br>
						
<input type="hidden" name="equipment_id" value="<?=$row['equipment_id']?>" />
					</div>
               </form>
		</div>
</body>
</html>
<script>
$('#file').change( function () {
  var fileExtension = ['jpg','png'];
  if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
     alert("กรุณาอัพโหลดไฟล์ให้ถูกต้อง JPG, PNG, files.");
     this.value = '';
     return false;
  }
});
</script>