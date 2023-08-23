<?php
for($k=0;$k<count($_POST["list_id"]);$k++){//ส่วนของมีอุปกรณ์
	$ids=$_POST["list_id"][$k];
	//echo $ids.'<br>';exit;
	//$balance=$_POST["equipment_balance"][$k]+$_POST["equipment_unit"][$k];
	//echo $ids.' ยืมไป '.$_POST["equipment_unit"][$k].' คงเหลือ '.$_POST["equipment_balance"][$k].' คืนแล้ว  '.$balance.'<br>';
	if($_POST["status_id"][$k]==3){
		if($_POST["equipment_id"][$k]==0){
			continue;
		}
		//echo $_POST["status_id"][$k].'<br>';
		$balance=$_POST["equipment_balance"][$k]+$_POST["equipment_unit"][$k];
/*echo $ids.' ยืมไป '.$_POST["equipment_unit"][$k].' คงเหลือ '.$_POST["equipment_balance"][$k].' คืนแล้ว  '.$balance.'<br>';*/
		//echo $balance;
		$sql="update tb_equipment set equipment_balance=".$balance." where equipment_id='".$_POST["equipment_id"][$k]."'";
		$result=$db->query($sql);
		$sql="update tb_list set status_id='4' where status_id=3 and servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
		$sql="update tb_servicedetails set status_id='4',recipient_note='".$_POST["recipient_note"]."',userrecipient_id='".$_SESSION["USERNAME"]."',date_return='".$_POST["date_return"]."',time_return='".$_POST["time_return"]."' where servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
	}else{
		$sql="update tb_list set status_id='4' where status_id=3 and servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
		$sql="update tb_servicedetails set status_id='4',recipient_note='".$_POST["recipient_note"]."',userrecipient_id='".$_SESSION["USERNAME"]."',date_return='".$_POST["date_return"]."',time_return='".$_POST["time_return"]."' where servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
	}
}
if($result){
?>
<script type="text/javascript">
		Swal.fire({
  position: 'Top-center',
  type: 'success',
  title: 'รับคืนแล้ว',
  showConfirmButton: false,
  timer: 2500
})
	</script>
	<?php echo "<meta http-equiv='refresh' content='1;url=?page=return_admin'>" ?>
<?php
	}
	else
	{?>
<script type="text/javascript">
		Swal.fire({
  type: 'error',
  title: 'รับคืน ไม่สำเร็จ!',
  text: 'ลองใหม่ครั้ง',
})
	</script>
<?php echo "<meta http-equiv='refresh' content='1;url=?page=return_admin'>" ?>
<?php
	}
?>