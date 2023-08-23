<?php
for($s=0;$s<count($_POST["equipment_id"]);$s++){
	if($_POST["equipment_id"][$s]==0){
	continue;
	}
	$sqlbalance="select * from tb_equipment where equipment_id='".$_POST["equipment_id"][$s]."'";
	$resultbalance=$db->query($sqlbalance);
	$rowbalance=$resultbalance->fetch_array(MYSQLI_ASSOC);
		
	$chkbalance=$rowbalance["equipment_balance"];//เช็คค่าคงเหลือจากฐานข้อมูล
	$chkunit=$_POST["equipment_unit"][$s];//รับค่าคงเหลือจากฟอร์มก่อนหน้า
	//echo $chksumbalance."<br>";
	//echo 'ฐานข้อมูล = '.$chkbalance." : ".$chkunit.' ';
	if($chkunit>0){
		if($chkbalance<$chkunit){//ถ้าคงเหลือน้อยกว่าจำนวนที่เพิ่งเพิ่มเข้ามาใหม่ให้ทำ if
		?>
					<script type="text/javascript">
						Swal.fire({
						position: 'Top-center',
						type: 'error',
						title: 'กรุณาทำรายการใหม่!',
						text: "ไม่สามารถจองได้ จำนวนอุปกรณ์คงเหลือไม่เพียงพอ",
						html:  "ไม่สามารถจองได้ จำนวนอุปกรณ์คงเหลือไม่เพียงพอ"+'<h1><a href="?page=borrow" class="btn btn-primary">ตกลง</a></h1>',
						showConfirmButton: false,
						//timer: 20000
						})
					</script>	
					<!--<meta http-equiv="refresh" content="10;url=?page=borrow">-->
			<?php
			exit(0);
		}
	}
}

	/*ลบจำนวนอุปกรณ์ออก*/
	for($a=0;$a<count($_POST["equipment_id"]);$a++){
		if($_POST["equipment_id"][$a]==0){
		continue;
		}
		$sqlbalance="select * from tb_equipment where equipment_id='".$_POST["equipment_id"][$a]."'";
		$resultbalance=$db->query($sqlbalance);
		$rowbalance=$resultbalance->fetch_array(MYSQLI_ASSOC);

		$chkbalance=$rowbalance["equipment_balance"];
		$chkunit=$_POST["equipment_unit"][$a];
		
		if($_POST["equipment_unit"][$a]>0){
			$balance=($chkbalance-$_POST["equipment_unit"][$a]);
			$sql="update tb_equipment set equipment_balance=".$balance." where equipment_id='".$_POST["equipment_id"][$a]."'";
			$result=$db->query($sql);
		}
	}

	$today=date("Y-m-d");
	$sql="insert into tb_servicedetails(servicedetail_date,user_id,on_date,to_date,on_time,to_time,detail,place,service_id,note,status_id) values ('".$_POST["servicedetail_date"]."','".$_SESSION["EMPID"]."','".$_POST["on_date"]."','".$_POST["to_date"]."','".$_POST["on_time"]."','".$_POST["to_time"]."','".$_POST["detail"]."','".$_POST["place"]."','".$_POST["service_id"]."','".$_POST["note"]."','1')";
	$result=$db->query($sql);

	$sqlSelect="select servicedetail_id from tb_servicedetails where  user_id='".$_SESSION["EMPID"]."' order by servicedetail_id desc ";
	$resultSelect=$db->query($sqlSelect);
	$rowSelect=$resultSelect->fetch_array(MYSQLI_ASSOC);
	$lastID=$rowSelect["servicedetail_id"];

	if(isset($_POST["equipment_id"])){
	for ($i=0;$i<count($_POST["equipment_id"]);$i++)
	  {
		if($_POST["equipment_id"][$i] !="" && $_POST["equipment_unit"][$i]>0)
		{
			$sql="insert into tb_list (equipment_id,servicedetail_id,equipment_unit,status_id) values ('".$_POST["equipment_id"][$i]."','$lastID','".$_POST["equipment_unit"][$i]. "','1')"; 
			$result=$db->query($sql);
		}
	   }
	}

	if(isset($_POST["name"])){
	for ($i=0;$i<count($_POST["name"]);$i++)
	  {
		if($_POST["name"][$i] !="" && $_POST["number"][$i]>0)
		{
			$sqli="insert into tb_list (equipment_text,servicedetail_id,equipment_unit,status_id) values ('".$_POST["name"][$i]. "','$lastID','".$_POST["number"][$i]. "','1')"; 
			$result=$db->query($sqli);
		}
	  }
	}
			
//การส่งเข้า line_notify
$thai_day_arr=array("อาทิตย์","จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์");
			$thai_month_arr=array(
				"0"=>"",
				"1"=>"มกราคม",
				"2"=>"กุมภาพันธ์",
				"3"=>"มีนาคม",
				"4"=>"เมษายน",
				"5"=>"พฤษภาคม",
				"6"=>"มิถุนายน", 
				"7"=>"กรกฎาคม",
				"8"=>"สิงหาคม",
				"9"=>"กันยายน",
				"10"=>"ตุลาคม",
				"11"=>"พฤศจิกายน",
				"12"=>"ธันวาคม"                 
			);
			function on_date($time){
				global $thai_day_arr,$thai_month_arr;
				$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
				$thai_date_return.= "ที่ ".date("j",$time);
				$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
				$thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
				return $thai_date_return;
			}
			function to_date($time){
				global $thai_day_arr,$thai_month_arr;
				$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
				$thai_date_return.= "ที่ ".date("j",$time);
				$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
				$thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
				return $thai_date_return;
			}
			$sqlSelect="SELECT * from tb_servicedetails as ts inner join tblemployment as tm on ts.user_id=tm.ID where  '".$_SESSION["EMPID"]."'=tm.ID order by servicedetail_id desc ";
			$resultSelect=$db->query($sqlSelect);
			$rowSelect=$resultSelect->fetch_array(MYSQLI_ASSOC);

			$on_dates=$rowSelect["on_date"];  //วันที่จากฐานข้อมูล
			$thaidates=strtotime($on_dates);
			$on_date=on_date($thaidates);

			$to_dates=$rowSelect["to_date"];  //วันที่จากฐานข้อมูล
			$thaidate=strtotime($to_dates); 
			$to_date=to_date($thaidate);

			/* $servicedetail_id=$rowSelect["servicedetail_id"]; *///ได้ไอดียืมมา
			$nameThai=$rowSelect["nameThai"];//ได้ชื่อมา
			$on_time=$rowSelect["on_time"];//ได้เวลา
			$to_time=$rowSelect["to_time"];//ได้วันที่คืน
			$header = "ขอใช้บริการยืมอุปกรณ์";
			$message = $header.
                /* "\n". "รหัสยืมอุปกรณ์ที่: " . $servicedetail_id .*/ 
				"\n". "ชื่อ: " . $nameThai .
				"\n". "วันที่ยืม: " . $on_date . " เวลา " . $on_time .
				"\n". "ถึง: " . $to_date . " เวลา " . $to_time ;
				sendlinemesg();
				/* header('Content-Type: text/html; charset=utf8'); */
				$res = notify_message($message);
				
			function sendlinemesg(){
				define('LINE_API', "https://notify-api.line.me/api/notify");
				define('LINE_TOKEN', "NI2x8J1KqKQ37l8xMI0iPVw7nM20yLcRubKLVOpZhw0");
				function notify_message($message){
					$queryData = array('message' => $message);
					$queryData = http_build_query($queryData,'','&');
					$headerOptions = array(
						'http' => array(
							'method' => 'POST',
							'header' => "Content-Type: application/x-www-form-urlencoded\r\n"
										."Authorization: Bearer ".LINE_TOKEN."\r\n"
										."Content-Length: ".strlen($queryData)."\r\n",
							'content' => $queryData
						)
					);
					$context = stream_context_create($headerOptions);
					$result = file_get_contents(LINE_API, FALSE, $context);
					$res = json_decode($result);
					return $res;
				}
			}
			//จบการส่งเข้า line_notify
{?>
					<script type="text/javascript">
						Swal.fire({
						position: 'Top-center',
						type: 'success',
						title: 'บันทึกข้อมูล สำเร็จ',
						showConfirmButton: false,
						timer: 20000
						})
					</script>	
					<meta http-equiv="refresh" content="1;url=?page=pending">
			<?php
			}
?>