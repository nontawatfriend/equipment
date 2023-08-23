<?php
$equipment_photo=$_FILES["equipment_photo"]["tmp_name"];
$equipment_photo_name=$_FILES["equipment_photo"]["name"];$array_lastname=explode(".",$equipment_photo_name);//รูปใหม่
$c=count($array_lastname)-1;
$lastname=strtolower($array_lastname[$c]);
if(!$equipment_photo){//กรณีเมื่อไม่เลือกรูป
	$sql="update tb_equipment set equipment_name='".$_POST["equipment_name"]."',equipment_number='".$_POST["equipment_number"]."',status_id='".$_POST["status_id"]."',equipment_detail='".$_POST["equipment_detail"]."',dur_id='".$_POST["dur_id"]."' where equipment_id='".$_POST["equipment_id"]."'";
	$result=$db->query($sql);
}
else{//กรณีมีรูปภาพใหม่เข้ามา
	if($lastname=='jpg' or $lastname=='gif' or $lastname=='png'){
	$equipment_photo_name="equipment_".time().".".$lastname;copy($equipment_photo,"equipment_img/".$equipment_photo_name);unlink($equipment_photo);
	@unlink("equipment_img/".$_POST["equipment_photo"]);
	}
	$sql="update tb_equipment set equipment_name='".$_POST["equipment_name"]."',equipment_photo='$equipment_photo_name',equipment_number='".$_POST["equipment_number"]."',status_id='".$_POST["status_id"]."',equipment_detail='".$_POST["equipment_detail"]."',dur_id='".$_POST["dur_id"]."' where equipment_id='".$_POST["equipment_id"]."'";
	$result=$db->query($sql);
}

$balance=$_POST["equipment_number"]-$_POST["equipment_numbersum"];
$balances=$balance+$_POST["equipment_numbersum"];
$sumbablance=$balances-$_POST["balance"];
$sql="update tb_equipment set equipment_balance = ".$sumbablance." where equipment_id='".$_POST["equipment_id"]."'";
$result=$db->query($sql);

if($result){?>
<script type="text/javascript">
	  Swal.fire({
	  position: 'Top-center',
	  type: 'success',
	  title: 'แก้ไขข้อมูล สำเร็จ',
	  showConfirmButton: false,
	  timer: 1500
	  })
</script>
<meta http-equiv="refresh" content='1;url=?page=equipment'>

<?php
	}
	else
	{?>
<script type="text/javascript">
	  Swal.fire({
	  type: 'error',
	  title: 'Oops...',
	  text: 'แก้ไขข้อมูล ไม่สำเร็จ!',
	  })
</script>
<meta http-equiv="refresh" content='1;url=?page=equipment'>
<?php
	}
?>