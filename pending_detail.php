<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>pending_detail</title>
</head>
<body>
<div class="row bg">
<h3 align="center"><i class="fa fa-clock-o" style="font-size:20px"></i> กำลังรออนุมัติ</h3>
<hr>
<div class="text-center" style="margin: 10px; margin-top: 0px;">
<form method="post" id="frmborrow" class="form-horizontal"  action="?page=pending_update" align="center">
	<?php
		$sql="select * from tb_servicedetails inner join tb_service on tb_servicedetails.service_id=tb_service.service_id where servicedetail_id='$_GET[servicedetail_id]'";
		$result=$db->query($sql);
		while($row=$result->fetch_array(MYSQLI_BOTH)){
		?>
			<div class="form-group">
				<label class="col-sm-5 control-label">รหัสยืมอุปกรณ์ที่ : </label>
				<div class="col-sm-2">
					<div class="form-control-static btn btn-primary btn-md disabled" value="<?=$row["servicedetail_id"]?>"><?=$row["servicedetail_id"]?></div>
				</div>
			</div>

			<div class="form-group">
				<label class="col-sm-5 control-label">วันที่ขอใช้บริการ : </label>
				<div class="col-sm-4">
					<div class="form-control-static" value="<?=$row["servicedetail_date"]?>" align="left">
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
	<!--
			<div class="form-group">
				<label class="col-sm-5 control-label">ชื่อผู้ใช้ : </label>
				<div class="col-sm-2">
					<input type="text" class="form-control" name="firstName" placeholder="First name" value="<?=$row["user_id"]?>" disabled >
				</div>
			</div>-->

			<div class="form-group">
				<label class="col-sm-5 control-label">ในวันที่ : </label>
				<div class="col-sm-2">
					<input type="date" name="on_date" class="form-control" min="<?=date("Y-m-d",strtotime("+2 day"));?>" value="<?=$row["on_date"]?>">
				</div>
				<label class="col-sm-1 control-label" style="width: 70px;">เวลา :</label>
				<div class="col-sm-1 on_time" style="width: 130px;">
					<input type="time" class="form-control" name="on_time" id="on_time" required="required" value="<?=$row["on_time"]?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">ถึงวันที่ : </label>
				<div class="col-sm-2">
					<input type="date" name="to_date" class="form-control" min="<?=date("Y-m-d",strtotime("+2 day"));?>" value="<?=$row["to_date"]?>">
				</div>
				<label class="col-sm-1 control-label" style="width: 70px;">เวลา :</label>
				<div class="col-sm-1 to_time" style="width: 130px;">
					<input type="time" class="form-control" name="to_time" id="to_time" required="required" value="<?=$row["to_time"]?>">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">ความประสงค์/กิจกรรม : </label>
				<div class="col-sm-3">
					<textarea type="text" name="detail" class="form-control" rows="4"><?=$row["detail"]?></textarea>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-5 control-label">สถานที่ : </label>
				<div class="col-sm-3">
					<textarea type="text" name="place" class="form-control" rows="4"><?=$row["place"]?></textarea>
				</div>
			</div>

			<div class="form-group ">
			  <label class="col-sm-5 control-label">บริการติดตั้ง : </label>
			  <div class="col-lg-2">
			   <select class="form-control animated" name="service_id">
				 <?php
		 		$strDefault=$row["service_id"];
				$sqli="select * from tb_service";
				$resulti=$db->query($sqli);
				while($rowi=$resulti->fetch_array(MYSQLI_ASSOC)){
						if($strDefault == $rowi["service_id"])
						{
							$sel = "selected";
						}
						else
						{
							$sel = "";
						}
					
				?>
 <option value="<?=$rowi["service_id"];?>" <?=$sel;?>><?=$rowi["service_name"];?></option>				   
				   
			<!--	<option value="<?=$rowi["service_id"]?>"><?=$rowi["service_name"]?></option>-->
				<?php } ?>
				<input type="hidden" name="<?=$rowi["service_id"]?>" value="<?=$rowi["service_id"]?>" />
			</select>
			  </div>
			</div>
<div class="table-responsive">
<table class="table table-striped table-bordered table-condensed" id="dynamic_field">
	<thead bgcolor="#f0ad4e">
		<tr>
		<th>รหัสอุปกรณ์</th>
		<th>ชื่ออุปกรณ์</th>
		<th>รายละเอียดอุปกรณ์</th>
		<th>จำนวนคงเหลือที่สามารถยืมได้</th>
		<th>สถานะของอุปกรณ์</th>
		<th>จำนวนยืม</th>
		</tr>
	</thead>
		<tbody>
			<?php
			$sql="select * from tb_equipment inner join tb_status where tb_equipment.status_id=tb_status.status_id and tb_status.status_id=1";
			$result=$db->query($sql);
			$i=1;
			while($row=$result->fetch_array(MYSQLI_BOTH)){
			?>
		<tr>
			 <td><?=$row["equipment_id"]?></td>
			 <td id="equipment_name_<?=$i?>"><?=$row["equipment_name"]?></td>
			 <td><?=$row["equipment_detail"]?></td>
			 <td id="equipment_number_<?=$i?>"><?=$row["equipment_balance"]?></td>
				<?php
				if($row["status_id"] == "1"){
				echo "<td><span style='color:green'>ปกติ</span></td>";
				}else if($row["status_id"] == "2"){
				echo "<td><span style='color:red'>ใช้งานไม่ได้</span></td>";
				}else{
				echo "<td><span style='color:red'>ข้อมูลไม่แน่ชัด</span></td>";
				}
				?> 
			<td style="width: 100px;" id="row_<?=$i?>">
				<input type="hidden" name="equipment_id[]" id="equipment_id" value="<?=$row["equipment_id"]?>">
				<input type="hidden" name="equipment_number[]" id="equipment_number_<?=$i?>" value="<?=$row["equipment_number"]?>">
				<input type="hidden" name="equipment_balance[]" id="equipment_balance_<?=$i?>" value="<?=$row["equipment_balance"]?>">
				<?php
				$sqlCheck="select * from tb_list inner join tb_equipment on tb_list.equipment_id=tb_equipment.equipment_id inner join service_status on tb_list.status_id=service_status.status_id where servicedetail_id='".$_GET["servicedetail_id"]."' and tb_list.equipment_id=".$row["equipment_id"];
				$resultCheck=$db->query($sqlCheck);
				$rowData=$resultCheck->fetch_array(MYSQLI_ASSOC);
				?>
				<?php $balance=$rowData["equipment_unit"]+$row["equipment_balance"]?>
				<!--<?php echo $balance?>-->
				
				<input type="hidden" name="balance[]" id="balance_<?=$i?>" value="<?=$balance?>">
				<input type="hidden" name="equipment_unitsum[]" id="equipment_unitsum_<?=$i?>" value="<?=$rowData["equipment_unit"]?>">
				<input class="form-control" type="number" max="<?php echo $balance?>" placeholder="จำนวน" name="equipment_unit[]" id="equipment_unit_<?=$i?>" onblur="checknumber('<?=$i?>')" value="<?php echo $rowData["equipment_unit"]?>">
			</td>
	 	<?php $i++;} ?>
 		</tr>
<?php
$sql="select * from tb_list inner join service_status on tb_list.status_id=service_status.status_id where servicedetail_id='$_GET[servicedetail_id]' and equipment_id=0";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
?>
 <tr>
 <td>อุปกรณ์อื่น</td>
 <td colspan="4"><input type="text" name="name2[]" class="form-control" value="<?=$row["equipment_text"]?>"></td>
 <td style="width: 150px;" id="row_<?=$row["list_id"]?>">
 	<input name="equipment_unit2[]" class="form-control" type="number" value="<?=$row["equipment_unit"]?>">
 </td>
<!-- <td><?=$row["status_name"]?></td>-->
 </tr>
<?php } ?>
		</tbody>
</table>
</div>
	<button type="button" name="add" id="add" class="btn btn-success" title="เพิ่มอุปกรณ์"><i class="fa fa-plus"></i> เพิ่มอุปกรณ์</button><br><br>
	<?php
		$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
		$result=$db->query($sql);
		while($row=$result->fetch_array(MYSQLI_BOTH)){
		?>
			<div class="form-group ">
			  <label class="col-sm-5 control-label">หมายเหตุ : </label>
			  <div class="col-lg-3">
				<textarea type="text" name="note" class="form-control"><?=$row["note"]?></textarea>
			  </div>
			</div>
	<br>
	<?php } ?>
	<?php } ?>
<?php
$sql="select * from tb_servicedetails where servicedetail_id='$_GET[servicedetail_id]'";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
?>
				<div class="form-group">
           			<label class="col-sm-5 control-label">ผู้ยืมอุปกรณ์ : </label>
             			<div class="col-sm-3" align="left">
<?php
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
 ?>
               				<div class="form-control-static" value="<?=$row["user_id"]?>"><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></div>
             			</div>
         		</div><br>

		<a href="?page=pending" class="btn btn-danger" title="กลับ"><i class="fa fa-arrow-left" style="font-size:14px"></i> ย้อนกลับ</th></a>
        <a href="?page=pending_update&servicedetail_id=<?=$row["servicedetail_id"];?>"><button class="btn btn-warning" type="submit" title="อัพเดท"><i class="fa fa-check-square-o"></i> อัพเดท</button></a>
	
	</div>
</div>
		<input type="hidden" name="servicedetail_id" value="<?=$row["servicedetail_id"]?>" />
		<?php } ?>
	</form>

	</div><!-- class row -->
</div><!-- class contailner -->
<div ><br><br></div>
</body>
</html>
<script>
	function checknumber(index){
		debugger;
		var balances=$('#frmborrow #balance_'+index).val();
		var equipmentnumber=$('#frmborrow #equipment_number_'+index).html();
		var equipmentunit=$('#frmborrow #equipment_unit_'+index).val();
		if(parseInt(balances)< parseInt(equipmentunit)||0>parseInt(equipmentunit)){
			//ถ้าจำนวนอุปกรณ์ที่มีอยู่น้อยกว่าที่ผู้ใช้ต้องการให้ทำ
			$('#frmborrow #equipment_unit_'+index).val('');
			$('#frmborrow #equipment_unit_'+index).focus();
			$('#frmborrow #row_'+index).addClass('has-error');
			$('#frmborrow #row_'+index).removeClass('has-success');
		}
		else
		{
			$('#frmborrow #row_'+index).removeClass('has-error');
			$('#frmborrow #row_'+index).addClass('has-success');
		}
	}
</script>
<script>
$(document).ready(function(){
	var i=0;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" title="ลบ">X</button></td>				<td colspan="4">       																<input type="text" name="name[]" id="name'+i+'" placeholder="ชื่ออุปกรณ์" class="form-control name_list"></td>             													<td>																				<input type="number" name="number[]" id="number'+i+'" placeholder="จำนวน" min="1" class="form-control name_list"></td>													</tr>');
	});
	
	$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
		i=i-1;
	});
});
</script>
<!--<script>
var d = new Date();
var day = ["วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุทธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์"];
var month = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
"กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];
document.getElementById("date").innerHTML=day[d.getDay()]+" ที่ "+(d.getDate())+" "+(month[d.getMonth()])+" พ.ศ. "+(d.getFullYear()+543)+" เวลา "+(d.getHours())+":"+(d.getMinutes());
</script>-->