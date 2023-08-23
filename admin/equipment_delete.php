<?php 
require'config.php';
?>
<?php
$id=$_POST["equipment_id"];
$sql_photo="SELECT equipment_photo from tb_equipment where equipment_id=$id";
$result_photo=$db->query($sql_photo);
$record_photo=$result_photo->fetch_array(MYSQLI_BOTH);
unlink("equipment_img/".$record_photo["equipment_photo"]);
$sql="DELETE from tb_equipment where equipment_id=$id";
$result=$db->query($sql);
/* if($result){?>
	<script type="text/javascript">
		Swal.fire({
  position: 'Top-center',
  type: 'success',
  title: 'ลบข้อมูล สำเร็จ',
  showConfirmButton: false,
  timer: 2500
})
	</script>	
<meta http-equiv="refresh" content="0;url=?page=equipment">
<?php unlink("equipment_img/".$record_photo["equipment_photo"]);
	}
	else
	{?>
<script type="text/javascript">
		Swal.fire({
  type: 'error',
  title: 'ลบข้อมูล ไม่สำเร็จ!',
  text: 'ลองใหม่อีกครั้ง',
})
	</script>
<meta http-equiv="refresh" content="3;url=?page=equipment" />
<?php
	} */
?>