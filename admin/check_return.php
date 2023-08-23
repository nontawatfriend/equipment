<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Check_return</title>
</head>
<body>
<h3 align="center"><i class="fa fa-clock-o" style="font-size:20px" style="background:#FF0000"></i> อยู่ระหว่างยืม</h3>
<hr>
<form id="chkreturn"  class="form-horizontal" method="post" action="?page=return_save">
	<?php
		$sql="SELECT * from tb_servicedetails  where servicedetail_id='$_GET[servicedetail_id]'";
		$result=$db->query($sql);
		while($row=$result->fetch_array(MYSQLI_BOTH)){
	?>
                    <div class="form-group" align="center">
                        <label class="col-sm-12 col-md-5 control-label">รหัสยืมอุปกรณ์ที่ : </label>
                        <div class="col-sm-2">
                            <div class="form-control-static btn btn-primary btn-md disabled" value="<?=$row["servicedetail_id"]?>" name="servicedetail_id"><?=$row["servicedetail_id"]?>
							</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">วันที่ขอใช้บริการ : </label>
                        <div class="col-sm-4">
                            <div class="form-control-static" value="<?=$row["servicedetail_date"]?>">
						<?php
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
						function thai_date($time){
							global $thai_day_arr,$thai_month_arr;
							$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
							$thai_date_return.= "ที่ ".date("j",$time);
							$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
							$thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
							$thai_date_return.= " เวลา ".date("H:i",$time)." น.";
							return $thai_date_return;
						}
						?>
						<?php
							$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
							$result=$db->query($sql);
							$row=$result->fetch_array(MYSQLI_BOTH);
							$my_strDate=$row["servicedetail_date"]; 
							$thaidate=strtotime($my_strDate); //วันที่จากฐานข้อมูล
							echo thai_date($thaidate);
						?>
							</div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-sm-5 control-label">ในวันที่ : </label>
                        <div class="col-sm-4">
                            <div type="date" class="form-control-static" value="<?=$row["on_date"]?>" disabled>
						<?php
						function on_date($time){
							global $thai_day_arr,$thai_month_arr;
							$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
							$thai_date_return.= " ที่ ".date("j",$time);
							$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
							$thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
							//$thai_date_return.= " เวลา ".date("H:i",$time)." น.";
							return $thai_date_return;
						}
						?>
						<?php
							$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
							$result=$db->query($sql);
							$row=$result->fetch_array(MYSQLI_BOTH);
							$my_strDate=$row["on_date"];
							$my_strtime=$row["on_time"];
							$thaidate=strtotime($my_strDate,$my_strtime); //วันที่จากฐานข้อมูล
							//$thaidate=strtotime($my_strtime);
							echo on_date($thaidate)," เวลา ",$my_strtime," น.";
						?>
				</div>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-5 control-label">ถึงวันที่ : </label>
			<div class="col-sm-4">
				<div type="date" name="to_date" id="to_date" class="form-control-static" value="<?=$row["to_date"]?>">
						<?php
						function to_date($time){
							global $thai_day_arr,$thai_month_arr;
							$thai_date_return="วัน".$thai_day_arr[date("w",$time)];
							$thai_date_return.= " ที่ ".date("j",$time);
							$thai_date_return.=" ".$thai_month_arr[date("n",$time)];
							$thai_date_return.= " พ.ศ.".(date("Yํ",$time)+543);
							//$thai_date_return.= " เวลา ".date("H:i",$time)." น.";
							return $thai_date_return;
						}
						?>
						<?php
							$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
							$result=$db->query($sql);
							$row=$result->fetch_array(MYSQLI_BOTH);
							$my_strDate=$row["to_date"];
							$my_strtime=$row["to_time"];
							$thaidate=strtotime($my_strDate,$my_strtime); //วันที่จากฐานข้อมูล
							//$thaidate=strtotime($my_strtime);
							echo to_date($thaidate)," เวลา ",$my_strtime," น.";
						?>
							</div>
                        </div>
					</div>
					<div class="form-group">
                        <label class="col-sm-5 control-label">ความประสงค์/กิจกรรม : </label>
                        <div class="col-sm-4">
                            <p type="text" class="form-control-static" disabled rows="4"><?=$row["detail"]?></p>
                        </div>
                    </div>
					<div class="form-group">
                        <label class="col-sm-5 control-label">สถานที่ : </label>
                        <div class="col-sm-4">
                            <p type="text" class="form-control-static" disabled rows="4"><?=$row["place"]?></p>
                        </div>
                    </div>
	
					<div class="form-group ">
                      <label class="col-sm-6 control-label">บริการติดตั้ง : </label>
                      <div class="col-lg-2">	
		<?php
		$sqlser="select * from tb_servicedetails inner join tb_service on tb_servicedetails.service_id=tb_service.service_id where servicedetail_id='$_GET[servicedetail_id]'";
		$resultser=$db->query($sqlser);
		while($rowser=$resultser->fetch_array(MYSQLI_BOTH)){
		?>
						   <p type="text" class="form-control-static" value="<?=$rowser["service_name"]?>"><?=$rowser["service_name"]?></p>
		<?php } ?>
                      </div>
                    </div>
	<br>
		
	<?php } ?>
<div style="margin: 10px; margin-top: 0px;" class="bgtable">
<div class="table-responsive">
<table class="table table-bordered table-condensed table-hover">
<thead>
 <tr bgcolor="#76a4cb">
 <th>รหัสอุปกรณ์</th>
 <th>ชื่ออุปกรณ์</th>
 <th>จำนวนยืมอุปกรณ์</th>
 <th>สถานะการยืม</th>
 <th>หมายเหตุ</th>
 </tr>
</thead>
<tbody>
<?php
$sql="SELECT * from tb_list inner join tb_equipment on (tb_list.equipment_id=tb_equipment.equipment_id) inner join service_status on (tb_list.status_id=service_status.status_id) where servicedetail_id='$_GET[servicedetail_id]'"; /* order BY tb_equipment.equipment_id ASC */
$result=$db->query($sql);
$i=0;
while($row=$result->fetch_array(MYSQLI_BOTH)){
$i++;
?>
 <tr>
 <td><?=$row["equipment_id"]?></td>
 <td id="equipment_name__<?=$i?>"><?=$row["equipment_name"]?></td>
 <td style="width: 150px;">
 <?=$row["equipment_unit"]?>
	<input type="hidden" name="list_id[]" id="list_id_<?=$i?>" value="<?=$row["list_id"]?>" />
 	<input type="hidden" name="equipment_id[]" id="equipment_id_<?=$i?>" value="<?=$row["equipment_id"]?>">
	<input type="hidden" name="equipment_balance[]" id="equipment_balance_<?=$i?>" value="<?=$row["equipment_balance"]?>">
	<input type="hidden" name="equipment_unit[]" id="equipment_unit_<?=$i?>" value="<?=$row["equipment_unit"]?>">
	<input type="hidden" name="equipment_number[]" id="equipment_number_<?=$i?>" value="<?=$row["equipment_number"]?>">
	<input type="hidden" name="status_id[]" id="status_id_<?=$i?>" value="<?=$row["status_id"]?>">
</td>
		<?php
		$sql="select * from service_status where servicedetail_id='$_GET[servicedetail_id]'";
		if($row["status_id"] == "2"){
		echo "<td><span style='color:red'>ไม่อนุมัติ</span></td>";
		}else if($row["status_id"] == "3"){
		echo "<td><span style='color:green'>อยู่ระหว่างยืม</span></td>";
		}else{
		echo "<td><span style='color:red'>ข้อมูลไม่แน่ชัด</span></td>";
		}
		?>
 <td><div class="form-control-static" name="list_note" id="list_note_<?=$i?>" value="<?=$row["list_note"]?>"><?=$row["list_note"]?></div></td>
 </tr>
<?php } ?>
	
<?php
$sql="select * from tb_list inner join service_status on tb_list.status_id=service_status.status_id where servicedetail_id='$_GET[servicedetail_id]' and equipment_id=0";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
$i++;
?>
 <tr>
 <td>อุปกรณ์อื่น ๆ</td>
 <td><?=$row["equipment_text"]?></td> 
 <td style="width: 150px;">
	<?=$row["equipment_unit"]?>
	<input type="hidden" name="equipment_unit[]" id="equipment_unit_<?=$i?>" value="<?=$row["equipment_unit"]?>">
<input type="hidden" name="status_id[]" id="status_id_<?=$i?>" value="<?=$row["status_id"]?>">
 </td>
 <input type="hidden" name="list_id[]" id="list_id_<?=$i?>" value="<?=$row["list_id"]?>" />
		<?php
		$sql="select * from service_status where servicedetail_id='".$_GET["servicedetail_id"]."'";
		if($row["status_id"] == "2"){
		echo "<td><span style='color:red'>ไม่อนุมัติ</span></td>";
		}else if($row["status_id"] == "3"){
		echo "<td><span style='color:green'>อยู่ระหว่างยืม</span></td>";
		}else{
		echo "<td><span style='color:red'>ข้อมูลไม่แน่ชัด</span></td>";
		}
		?>
  <td><div class="form-control-static" name="list_note" value="<?=$row["list_note"]?>"><?=$row["list_note"]?></div></td>
 </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
<?php
$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
?>
<?php
if($row["note"]!=""){
?>
					<div class="form-group ">
                      <label class="col-sm-6 control-label">หมายเหตุการยืม : </label>
                      <div class="col-lg-4">
                        <p type="text" class="form-control-static"><?=$row["note"]?></p>
                      </div>
                    </div>
<?php }else{?>
						<div class="form-group ">
                      <label class="col-sm-6 control-label">หมายเหตุการยืม : </label>
                      <div class="col-lg-4">
                        <p type="text" class="form-control-static">-</p>
                      </div>
                    </div>
	<?php } ?>
				<div class="form-group">
           			<label class="col-sm-6 control-label">ผู้ยืมอุปกรณ์ : </label>
             			<div class="col-sm-3">
<?php
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
 ?>
               				<p class="form-control-static" value="<?=$row["user_id"]?>"><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></p>
             			</div>
         		</div>
<?php
if($row["approval_note"]!=""){
?>
					<div class="form-group ">
                      <label class="col-sm-6 control-label">หมายเหตุการอนุมัติ : </label>
                      <div class="col-lg-4">
                        <p type="text" class="form-control-static"><?=$row["approval_note"]?></p>
                      </div>
                    </div>
<?php }else{?>
						<div class="form-group ">
                      <label class="col-sm-6 control-label">หมายเหตุการอนุมัติ : </label>
                      <div class="col-lg-4">
                        <p type="text" class="form-control-static">-</p>
                      </div>
                    </div>
	<?php } ?>
		<div class="form-group">
           <label class="col-sm-6 control-label">ผู้อนุมัติ :</label>
             <div class="col-sm-3">
				 <p class="form-control-static" value="<?=$row["userapprove_id"]?>"><?=$row["userapprove_id"]?></p>
             </div>
         </div>
	<div class="form-group">
		<label class="col-sm-5 control-label">วันที่รับคืน *</label>
		<div class="col-sm-2 date_return" style="width: 190px">
			<input type="date" class="form-control" name="date_return" id="date_return" required="required" value="<?=date("Y-m-d");?>" onBlur="chkdate_return();">
		</div>
		<!--<label class="col-sm-1 control-label" style="width: 65px;">เวลา :</label>-->
		<div class="col-sm-1 time_return" style="width: 130px;">
		<input type="time" class="form-control" name="time_return" id="time_return" required="required" onBlur="chktime_return();" placeholder="เวลา" value="<?=date("H:i");?>">
		</div>
	</div>
				<div class="form-group">
           			<label class="col-sm-5 control-label">หมายเหตุรับคืน :</label>
             			<div class="col-sm-3">
							<textarea class="form-control" rows="3" name="recipient_note"></textarea>
             			</div>
         		</div>
	<input type="hidden" name="servicedetail_id" value="<?=$row["servicedetail_id"]?>" />
	<div class="text-center">
		<a href=javascript:history.go(-1) title="กลับ" class="btn btn-danger"><i class="fa fa-arrow-left" style="font-size:12px"></i> ย้อนกลับ</th></a>
		<!--<a href="?page=return_save&servicedetail_id=<?=$row["servicedetail_id"];?>" onclick="return confirm('ยืนยันการรับคืน')"></a>-->
        <button class="btn btn-success" type="button" onClick="confirmdata('');"><i class="fa fa-check"></i> รับคืน</button>
		<!--<button class="btn btn-primary" type="button"><i class="fa fa-print"></i> พิมพ์</button>-->
	<?php } ?>
    </div>
</form>
<div ><br><br></div>
</body>
</html>
<script>
	function chkdate_return(){
		if(document.getElementById('date_return').value == "")
		{
			$('#chkreturn .date_return').addClass('has-error');
			$('#chkreturn .date_return').removeClass('has-success');
			return false;
    	}else{
			$('#chkreturn .date_return').addClass('has-success');
			$('#chkreturn .date_return').removeClass('has-error');
		}
	}
	function chktime_return(){
		if(document.getElementById('time_return').value == "")
		{
			$('#chkreturn .time_return').addClass('has-error');
			$('#chkreturn .time_return').removeClass('has-success');
			return false;
    	}else{
			$('#chkreturn .time_return').addClass('has-success');
			$('#chkreturn .time_return').removeClass('has-error');
		}
	}
	function confirmdata(){
		if(document.getElementById('date_return').value == "")
		{
			chkdate_return();
			$('#date_return').focus();
			return false;
		}
		if(document.getElementById('time_return').value == "")
		{
			chktime_return();
			$('#time_return').focus();
			return false;
		}

		if(confirm("ยืนยันการรับคืน")){
			document.getElementById("chkreturn").submit();
		}
	}
</script>