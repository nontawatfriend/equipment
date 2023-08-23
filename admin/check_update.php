<?php
if($_POST["notapproval"]=="ไม่อนุมัติ"){
	for($a=0;$a<count($_POST["equipment_id"]);$a++){
		$balance=$_POST["equipment_balance"][$a]+$_POST["equipment_unitsum"][$a];
		$sql="update tb_equipment set equipment_balance = ".$balance." where equipment_id='".$_POST["equipment_id"][$a]."'";
		$result=$db->query($sql);
	}
	if(isset($_POST["list_note"])){
		for ($i=0;$i<count($_POST["list_note"]);$i++){
			if($_POST["list_note"][$i] !=""){
			$sql="update tb_list set list_note='".$_POST["list_note"][$i]."',status_id='2' where servicedetail_id='".$_POST["servicedetail_id"]."' and list_id='".$_POST["list_id"][$i]."'"; 
			$result=$db->query($sql);
			}
	   	}
	}
	$sql="update tb_servicedetails set status_id='2',notapproved_note='".$_POST["approval_note"]."',usernotapprove_id='".$_SESSION["USERNAME"]."' where servicedetail_id='".$_POST["servicedetail_id"]."'";
	$result=$db->query($sql);
	$sql="update tb_list set status_id='2' where servicedetail_id='".$_POST["servicedetail_id"]."'";
	$result=$db->query($sql);
	if($result){
	?>
		<script type="text/javascript">
				Swal.fire({
		  position: 'Top-center',
		  type: 'success',
		  title: 'ไม่อนุมัติแล้ว',
		  showConfirmButton: false,
		  timer: 1500
		})
			</script>
			<?php echo "<meta http-equiv='refresh' content='1;url=?page=pending_admin'>" ?>
		<?php
			}
		else
			{?>
		<script type="text/javascript">
				Swal.fire({
		  type: 'error',
		  title: 'ไม่อนุมัติ ไม่สำเร็จ!',
		  text: 'ลองใหม่ครั้ง',
		})
			</script>
		<?php echo "<meta http-equiv='refresh' content='1;url=?page=pending_admin'>" ?>
		<?php
			}
			?>
	<?php }else{
for($e=0;$e<count($_POST["equipment_balance"]);$e++){
$sqli="SELECT list_id from tb_list where list_id='".$_POST["list_id"][$e]."'";
$resulti=$db->query($sqli);
$rowi=$resulti->fetch_array(MYSQLI_ASSOC);
$eqbalance=$rowi["list_id"];
//echo $eqbalance. "=".$_POST["list_id"][$e].'<br>';

	if($eqbalance==$_POST["list_id"][$e]){
		//echo('เท่ากัน');
		$sql="update tb_servicedetails set status_id='2' where servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
		$sql="update tb_list set status_id='2' where servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
		for($k=0;$k<count($_POST["list_id"]);$k++){
			$ids=$_POST["list_id"][$k];
			if($_POST["radio_$ids"]==2){
				if($_POST["equipment_id"][$k]==0){
				continue;
				}
					$balance=$_POST["equipment_balance"][$k]+$_POST["equipment_unitsum"][$k];
					$sql="update tb_equipment set equipment_balance=".$balance." where equipment_id='".$_POST["equipment_id"][$k]."'";
					$result=$db->query($sql);
			}
			else{
				$sql="update tb_servicedetails set status_id='3' where servicedetail_id='".$_POST["servicedetail_id"]."'";
				$result=$db->query($sql);
				$numberbalance=$_POST["equipment_unitsum"][$k]-$_POST["equipment_unit"][$k];
				$sum=$numberbalance+$_POST["equipment_balance"][$k];
				$sql="update tb_equipment set equipment_balance=".$sum." where equipment_id='".$_POST["equipment_id"][$k]."'";
				$result=$db->query($sql);
				$sql="update tb_list set status_id='3' where list_id='".$_POST["list_id"][$k]."'";
				$result=$db->query($sql);
				$sql="update tb_list set equipment_unit='".$_POST["equipment_unit"][$k]. "' where list_id=".$_POST["list_id"][$k]." and servicedetail_id='".$_POST["servicedetail_id"]."'"; 
				$result=$db->query($sql);
			}
		}
	
		if(isset($_POST["list_note"])){
		for ($i=0;$i<count($_POST["list_note"]);$i++)
		  {
			if($_POST["list_note"][$i] !="")
			{
				$sql="update tb_list set list_note='".$_POST["list_note"][$i]."' where servicedetail_id='".$_POST["servicedetail_id"]."' and list_id='".$_POST["list_id"][$i]."'"; 
				$result=$db->query($sql);
			}
		   }
		}
	
		$sqlSelect="select userapprove_id from tb_servicedetails where  userapprove_id='".$_SESSION["USER_TYPE"]."' order by servicedetail_id desc ";
		$resultSelect=$db->query($sqlSelect);
		$rowSelect=$resultSelect->fetch_array(MYSQLI_ASSOC);
	
		$sql="update tb_servicedetails set userapprove_id='".$_SESSION["USERNAME"]."',approval_note='".$_POST["approval_note"]."' where servicedetail_id='".$_POST["servicedetail_id"]."'";
		$result=$db->query($sql);
	
		if($result){
		?>
		<script type="text/javascript">
		  Swal.fire({
		  position: 'Top-center',
		  type: 'success',
		  title: 'ยืนยันเรียบร้อยแล้ว',
		  showConfirmButton: false,
		  timer: 2500
		  })
		</script>
		<meta http-equiv="refresh" content="1;url=?page=check_return&servicedetail_id=<?=$_POST['servicedetail_id']?>" />
		<?php
			}
			else
			{?>
		<script type="text/javascript">
		  Swal.fire({
		  type: 'error',
		  title: 'อนุมัติ ไม่สำเร็จ!',
		  text: 'ลองใหม่ครั้ง',
		  })
		</script>
		<?php echo "<meta http-equiv='refresh' content='1;url=?page=pending_admin'>" ?>
		<?php
		}
		?>
	<?php
	}else{
		//echo('ไม่เท่ากัน');
		?>
		<script type="text/javascript">
			Swal.fire({
			position: 'Top-center',
			type: 'error',
			title: 'ผู้ใช้ได้อัพเดทรายการ',
			text: "ผู้ใช้ได้อัพเดทรายการ ทำรายการใหม่อีกครั้ง!",
			html:  "กรุณาทำรายการใหม่อีกครั้ง!"+'<h1><a href="?page=check&servicedetail_id=<?=$_POST['servicedetail_id']?>" class="btn btn-primary">ตกลง</a></h1>',
			showConfirmButton: false,
			//timer: 20000
			})
		</script>	
	<?php
	}exit;
}
exit;//จบloop for ครั้งเดียว
}
?>

