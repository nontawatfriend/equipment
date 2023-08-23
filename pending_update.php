<?php
	$sql="select status_id from tb_servicedetails where servicedetail_id='".$_POST["servicedetail_id"]."'";
	$result=$db->query($sql);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	$status=$row["status_id"];
if($status==1){
	for($s=0;$s<count($_POST["equipment_id"]);$s++){
		if($_POST["equipment_id"][$s]==0){
		continue;
		}
		$sqlbalance="select * from tb_equipment where equipment_id='".$_POST["equipment_id"][$s]."'";
		$resultbalance=$db->query($sqlbalance);
		$rowbalance=$resultbalance->fetch_array(MYSQLI_ASSOC);
			
		$chkbalance=$rowbalance["equipment_balance"];
		$chkeqbalance=$_POST["equipment_balance"][$s];
		//echo $chksumbalance."<br>";
		//echo 'ฐานข้อมูล = '.$chkbalance." : ".$chkunit.' ';
		if($chkeqbalance>0){
			if($chkbalance!=$chkeqbalance){
			?>
						<script type="text/javascript">
							Swal.fire({
							position: 'Top-center',
							type: 'error',
							title: 'กรุณาทำรายการใหม่!',
							text: "ไม่สามารถจองได้ จำนวนอุปกรณ์คงเหลือไม่เพียงพอ",
							html:  "ไม่สามารถจองได้ จำนวนอุปกรณ์คงเหลือไม่เพียงพอ"+'<h1><a href="?page=pending_detail&servicedetail_id=<?=$_POST['servicedetail_id']?>" class="btn btn-primary">ตกลง</a></h1>',
							showConfirmButton: false,
							//timer: 20000
							})
						</script>	
				<?php
				exit(0);
			}
		}
	}

		
			
	for($a=0;$a<count($_POST["equipment_id"]);$a++){
		if($_POST["equipment_unit"][$a]>=0){
			$unitsum=$_POST["equipment_unitsum"][$a];
			if($unitsum==""){
				$unitsum=0;
			}
			$unit=$_POST["equipment_unit"][$a];
			if($unit==""){
				$unit=0;
			}
			$sqlbalance="select * from tb_equipment where equipment_id='".$_POST["equipment_id"][$a]."'";
			$resultbalance=$db->query($sqlbalance);
			$rowbalance=$resultbalance->fetch_array(MYSQLI_ASSOC);
			$chkbalance=$rowbalance["equipment_balance"];
			
			$balance=$unitsum-$unit;
			$balances=$balance+$chkbalance;
			$sql="update tb_equipment set equipment_balance = ".$balances." where equipment_id='".$_POST["equipment_id"][$a]."'";
			$result=$db->query($sql);
		}
	}
	/*อัพเดทฟอร์มรายละเอียดการยืม*/
	$sql="update tb_servicedetails set on_date='".$_POST["on_date"]."',to_date='".$_POST["to_date"]."',detail='".$_POST["detail"]."',place='".$_POST["place"]."',service_id='".$_POST["service_id"]."',note='".$_POST["note"]."',on_time='".$_POST["on_time"]."',to_time='".$_POST["to_time"]."' where servicedetail_id='".$_POST["servicedetail_id"]."'";
	$result=$db->query($sql);

	/*ลบข้อมูลที่ยืมเก่าออก*/
	$sql="delete from tb_list where servicedetail_id='".$_POST["servicedetail_id"]."'";
	$result=$db->query($sql);

	/*เพิ่มอุปกรณ์*/
	if(isset($_POST["equipment_id"])){
	for ($i=0;$i<count($_POST["equipment_id"]);$i++)
	{
		if($_POST["equipment_id"][$i] !="" && $_POST["equipment_unit"][$i]>0)
		{
			$sql="insert into tb_list (equipment_id,servicedetail_id,equipment_unit,status_id) values ('".$_POST["equipment_id"][$i]."','".$_POST["servicedetail_id"]."','".$_POST["equipment_unit"][$i]. "','1')"; 
			$result=$db->query($sql);
			//echo $sql."<br/>";
		}
	}
	}
	/*เพิ่มอุปกรณ์อื่นๆ*/
	if(isset($_POST["name"])){
	for ($i=0;$i<count($_POST["name"]);$i++)
	{
		if($_POST["name"][$i] !="" && $_POST["number"][$i]>0)
		{
			$sqli="insert into tb_list (equipment_text,servicedetail_id,equipment_unit,status_id) values ('".$_POST["name"][$i]. "','".$_POST["servicedetail_id"]."','".$_POST["number"][$i]. "','1')"; 
			$result=$db->query($sqli);
			//echo $sql."<br/>";
		}
	}

	}
	/*เพิ่มอุปกรณ์อื่นๆ*/
	if(isset($_POST["name2"])){
	for ($i=0;$i<count($_POST["name2"]);$i++)
	{
		if($_POST["name2"][$i] !="" && $_POST["equipment_unit2"][$i]>0)
		{
			$sqli="insert into tb_list (equipment_text,servicedetail_id,equipment_unit,status_id) values ('".$_POST["name2"][$i]. "','".$_POST["servicedetail_id"]."','".$_POST["equipment_unit2"][$i]. "','1')"; 
			$result=$db->query($sqli);
			//echo $sql."<br/>";
		}
	}

	}

	if($result){?>
	<script type="text/javascript">
		Swal.fire({
	position: 'Top-center',
	type: 'success',
	title: 'บันทึกข้อมูล สำเร็จ',
	showConfirmButton: false,
	timer: 2000
	})
	</script>	
	<?php
		}
		else
		{?>
	<script type="text/javascript">
			Swal.fire({
	type: 'error',
	title: 'บันทึกข้อมูล ไม่สำเร็จ!',
	text: 'ลองใหม่อีกครั้ง',
	//footer: '<a href>Why do I have this issue?</a>'
	})
		</script>
	<?php
		}
	?>

	<meta http-equiv="refresh" content="1;url=?page=pending_detail&servicedetail_id=<?=$_POST['servicedetail_id']?>" />
	<?php
}else{
	?>
					<script type="text/javascript">
						Swal.fire({
						position: 'Top-center',
						type: 'error',
						title: 'อัพเดทไม่สำเร็จ',
						text: "อนุมัติรับไปแล้ว",
						html:  "ADMIN ได้อนุมัติรับไปแล้ว"+'<h1><a href="?page=pending" class="btn btn-primary">ตกลง</a></h1>',
						showConfirmButton: false,
						//timer: 20000
						})
					</script>	
			<?php
}
?>