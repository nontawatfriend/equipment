
<?php
$equipment_img=$_FILES["equipment_img"]["tmp_name"];
$equipment_img_name=$_FILES["equipment_img"]["name"];
$array_lastname=explode(".",$equipment_img_name);
$c=count($array_lastname)-1;
$lastname=strtolower($array_lastname[$c]);
if(!$equipment_img){
$equipment_img_name="ep.jpg";
}
else{
if($lastname=='jpg' or $lastname=='gif' or $lastname=='png' ){
$equipment_img_name="equipment_".time().".".$lastname;
copy($equipment_img,"equipment_img/".$equipment_img_name);
unlink($equipment_img);
}
}
 $sql="insert into tb_equipment(equipment_name,equipment_number,dur_id,equipment_photo,status_id,equipment_detail,equipment_balance)values('$_POST[equipment_name]','$_POST[equipment_number]','$_POST[dur_id]','$equipment_img_name','$_POST[status_id]','$_POST[equipment_detail]','$_POST[equipment_number]')";
$result=$db->query($sql);
if($result){?>
<script type="text/javascript">
	Swal.fire({
  position: 'Top-center',
  type: 'success',
  title: 'บันทึกอุปกรณ์ สำเร็จ',
  showConfirmButton: false,
  timer: 2000
})
	</script>	
<meta http-equiv="refresh" content="1;url=?page=equipment">
<?php
	}
	else
	{?>
<script type="text/javascript">
		Swal.fire({
  type: 'error',
  title: 'บันทึกอุปกรณ์ ไม่สำเร็จ!',
  text: 'ลองใหม่อีกครั้ง',
})
	</script>
<meta http-equiv="refresh" content="2;url=?page=equipment" />
<?php
	}
?>