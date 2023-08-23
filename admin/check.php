<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Check</title>
</head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="js/modal.js"></script>
<body>
<a href=javascript:history.back(1) class="btn btn-danger" ><i class="fa fa-arrow-left" style="font-size:14px"></i> ย้อนกลับ</th></a>

<h3 align="center"><i class="fa fa-clock-o" style="font-size:20px"></i> ตรวจสอบ</h3>
<hr>
<form id="frmcheck" method="post" class="form-horizontal" action="?page=check_update">
	<?php
	$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
	$result=$db->query($sql);
	while($row=$result->fetch_array(MYSQLI_BOTH)){
	?>
		<div class="form-group" align="center">
			<label class="col-sm-5 control-label">รหัสยืมอุปกรณ์ที่ : </label>
			<div class="col-sm-2">
				<div class="form-control-static btn btn-primary btn-md disabled"><?=$row["servicedetail_id"]?></div>
				<!--<input class="form-control" type="text" name="servicedetail_id" value="<?=$row["servicedetail_id"]?>" disabled>-->
				<input class="form-control" type="hidden" name="servicedetail_id" value="<?=$row["servicedetail_id"]?>">
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-5 control-label">วันที่ขอใช้บริการ : </label>
			<div class="col-sm-4">
				<div class="form-control-static" name="servicedetail_date" id="servicedetail_date" value="<?=$row["servicedetail_date"]?>" disabled>
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
				<div type="date" name="on_date" id="on_date" class="form-control-static" value="<?=$row["on_date"]?>" disabled>
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
				<p type="text" name="detail" id="detail" class="form-control-static" rows="4"><?=$row["detail"]?></p>
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-5 control-label">สถานที่ : </label>
			<div class="col-sm-4">
				<p type="text" name="place" id="place" class="form-control-static" rows="4"><?=$row["place"]?></p>
			</div>
		</div>

		<div class="form-group ">
		  <label class="col-sm-5 control-label">บริการติดตั้ง : </label>
		   <div class="col-lg-2">	
		<?php
		$sqlser="select * from tb_servicedetails inner join tb_service on tb_servicedetails.service_id=tb_service.service_id where servicedetail_id='$_GET[servicedetail_id]'";
		$resultser=$db->query($sqlser);
		while($rowser=$resultser->fetch_array(MYSQLI_BOTH)){
		?>
	   <input type="text" class="form-control" name="service_id" id="service_id" value="<?=$rowser["service_name"]?>" disabled>
		<?php } ?>
           </div>
       </div>
	<br>
	<?php } ?>
<div style="margin: 10px; margin-top: 0px;" class="bgtable">
<div class="table-responsive">
<table class="table table-bordered table-condensed">
<thead bgcolor="#FFFFCC">
 <tr>
 <th>รหัสอุปกรณ์</th>
 <th>ชื่ออุปกรณ์</th>
 <th width="6%">คงเหลือ</th>
 <th width="7%">จำนวนยืม</th>
 <th>สถานะ</th>
 <th>เลือกเพื่ออนุมัติ</th>
 <th>หมายเหตุ</th>
 </tr>
</thead>

<tbody>
<?php
$sql="select * from tb_list inner join tb_equipment on tb_list.equipment_id=tb_equipment.equipment_id inner join service_status on tb_list.status_id=service_status.status_id where servicedetail_id='$_GET[servicedetail_id]'";
$result=$db->query($sql);
$i=0;
while($row=$result->fetch_array(MYSQLI_BOTH)){
$i++;
?>
<tr>
<td><?=$row["equipment_id"]?></td>
<td id="equipment_name_<?=$i?>"><?=$row["equipment_name"]?></td>
<td id="equipment_number_<?=$i?>"><?=$row["equipment_balance"]?></td>
<td style="width: 150px;" id="row_<?=$i?>">
	<?php
	$sqlCheck="select * from tb_list inner join tb_equipment on tb_list.equipment_id=tb_equipment.equipment_id inner join service_status on tb_list.status_id=service_status.status_id where servicedetail_id='$_GET[servicedetail_id]' and tb_list.equipment_id=".$row["equipment_id"];
	$resultCheck=$db->query($sqlCheck);
	$rowData=$resultCheck->fetch_array(MYSQLI_ASSOC);
	?>
	 <input class="form-control" type="number" min="1" placeholder="จำนวน" name="equipment_unit[]" id="equipment_unit_<?=$i?>" max="<?php echo $rowData["equipment_unit"]?>" onblur="checknumber('<?=$i?>')" value="<?php echo $rowData["equipment_unit"]?>" required>
</td>
<td><?=$row["status_name"]?></td>
<td>
  <input type="hidden" name="equipment_id[]" id="equipment_id_<?=$i?>" value="<?=$row["equipment_id"]?>">
  <input type="hidden" name="equipment_balance[]" id="equipment_balance_<?=$i?>" value="<?=$row["equipment_balance"]?>">
  <input type="hidden" name="equipment_number[]" id="equipment_number_<?=$i?>" value="<?=$row["equipment_number"]?>">
  <input type="hidden" name="equipment_unitsum[]" id="equipment_unitsum_<?=$i?>" value="<?=$rowData["equipment_unit"]?>">
	<label>
  <input type="radio" class="css_data_item" name="radio_<?=$row["list_id"]?>" id="radio_<?=$row["list_id"]?>" value="2"> ไม่อนุมัติ</label>
	&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
  <input type="radio" class="css_data_item" name="radio_<?=$row["list_id"]?>" id="radio_<?=$row["list_id"]?>" value="3" checked> อนุมัติ</label>
</td>
<td>
	<input type="hidden" name="list_id[]" id="list_id" value="<?=$row["list_id"]?>" />
	<input type="text" class="form-control" name="list_note[]" id="list_note<?=$i?>">
</td>
 </tr>
<?php } ?>

<?php
$sql="select * from tb_list inner join service_status on tb_list.status_id=service_status.status_id  where servicedetail_id='".$_GET["servicedetail_id"]."' and equipment_id=0";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
$i++;
?>
<tr>
<td>อุปกรณ์อื่น ๆ</td>
<td id="equipment_name_<?=$i?>"><?=$row["equipment_text"]?></td> 
<td></td>
<td style="width: 150px;">
	<input type="hidden" name="list_id[]" id="list_id" value="<?=$row["list_id"]?>" />
	<input id="equipment_unit_<?=$i?>" name="equipment_unit[]" class="form-control" type="number" value="<?=$row["equipment_unit"]?>" required min="1">
</td>
<td><?=$row["status_name"]?></td>
<td>
  <input type="hidden" name="equipment_text[]" id="equipment_name_<?=$i?>" value="<?=$row["equipment_text"]?>">
	<input type="hidden" name="equipment_unitsum[]" id="equipment_unitsum_<?=$i?>" value="<?=$row["equipment_unit"]?>">
  <label>
  <input type="radio" class="css_data_item" name="radio_<?=$row["list_id"]?>" id="radio_<?=$row["list_id"]?>" value="2"> ไม่อนุมัติ</label>
	&nbsp;&nbsp;&nbsp;&nbsp;
  <label>
  <input type="radio" class="css_data_item" name="radio_<?=$row["list_id"]?>" id="radio_<?=$row["list_id"]?>" value="3" checked> อนุมัติ</label>
</td>
<td>
	<!--<input type="hidden" name="list_id[]" id="list_id" value="<?=$row["list_id"]?>" />-->
	<input type="text" class="form-control" name="list_note[]" id="list_note_<?=$i?>">
</td>
</tr>
		
<?php } ?>

</tbody>
</table>
</div>
</div>
<?php
$sql="select * from tb_servicedetails where servicedetail_id='".$_GET["servicedetail_id"]."'";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_ASSOC)){
?>
<?php
if($row["note"]!=""){
?>
	<div class="form-group ">
	  <label class="col-sm-6 control-label">หมายเหตุการยืม : </label>
	  <div class="col-lg-3">
		<p type="text" class="form-control-static" name="note" id="note" disabled><?=$row["note"]?></p>
	  </div>
	</div>
<?php }else{?>
						<div class="form-group ">
                      <label class="col-sm-6 control-label">หมายเหตุการยืม : </label>
                      <div class="col-lg-4">
                        <p type="text" class="form-control-static">-</p>
                      </div>
                    </div>
	<?php }} ?>
<?php
$sql="select * from tb_servicedetails where servicedetail_id='".$_GET["servicedetail_id"]."'";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
?>
	<div class="form-group">
		<label class="col-sm-6 control-label">ผู้ยืมอุปกรณ์ : </label>
			<div class="col-sm-3">
<?php
	$sqlmember="select * from tblemployment where ID='".$row["user_id"]."'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
 ?>
				<p class="form-control-static" value="<?=$row["user_id"]?>"><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></p>
			</div>
	</div>
		<div class="form-group">
		<label class="col-sm-4 control-label">หมายเหตุ :</label>
			<div class="col-sm-5">
				<textarea class="form-control" name="approval_note" id="approval_note" value="<?=$row["approval_note"]?>"></textarea>
			</div>
		</div>
	<br>
	<input type="hidden" name="servicedetail_id" id="servicedetail_id" value="<?=$row["servicedetail_id"]?>" />
<div align="center">
	<button type="submit" class="btn btn-danger" onclick="return confirm('ยืนยันที่จะไม่อนุมัติรายการ')" value="ไม่อนุมัติ" name="notapproval"><i class="fa fa-times" style="font-size:14px"></i> ไม่อนุมัติ</button>
	
	<button class="btn btn-success" onclick="return confirm('ยืนยันการอนุมัติ')" title="ยืนยัน" type="submit"><i class="fa fa-check"></i> ยืนยัน</button>
	<!-- <button type="button" class="btn btn-primary" onClick="exports();" id="buttontext"><i class="fa fa-file-excel-o"></i> Export</button> -->
	<!-- onClick="confirmcheck();"-->
</div>
<?php } ?>
	</form>
<div ><br><br></div>
</body>
</html>

