<?php
if(!isset($_SESSION["EMPID"]) || $_SESSION["EMPID"]==""){
	echo'<meta http-equiv="refresh" content="0;url=index.php">';
	exit(0);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>borrow</title>
<script src="js/modal.js"></script>
</head>
<body>
<div id="add_data_Modal" class="modal fade" tabindex="-1" role="dialog" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" align="center">ยืนยัน</h4>
      </div>
<div class="modal-body" align="center">
<div class="row">
   <div class="col-xs-12">
    <div class="col-xs-6 col-sm-6" align="right">
		<label class="control-label">ในวันที่ : </label>
	</div>
	<div align="left">
	  	<div id="lalon_date"></div>
	</div>
   </div>
	   
   <div class="col-xs-12">
    <div class="col-xs-6 col-sm-6" align="right">
		<label class="control-label">ถึงวันที่ : </label>
	</div>
	<div align="left">
	  	<div id="lalto_date"></div>
	</div>
   </div>
   <div class="col-xs-12">
    <div class="col-lg-6 col-xs-6 col-sm-6" align="right">
		<label class="control-label">ความประสงค์/กิจกรรม : </label>
	</div>
	<div align="left">
        <div id="laldetail" class="col-lg-5 col-xs-5 col-sm-5" style="padding-left: 0px;"></div>
	</div>
   </div>
   <div class="col-xs-12">
    <div class="col-xs-6 col-sm-6" align="right">
		<label class="control-label">สถานที่ : </label>
	</div>
	<div align="left">
        <div id="lalplace" class="col-lg-5 col-xs-5 col-sm-5" style="padding-left: 0px;"></div>
	</div>
   </div>
   <div class="col-xs-12">
    <div class="col-xs-6 col-sm-6" align="right">
		<label class="control-label">บริการติดตั้ง : </label>
	</div>
	<div align="left">
        <div id="lalservice_id">
	</div>
   </div>
</div><br>
	<label>รายการอุปกรณ์</label><br>
<table style="width: 80%;" class="table table-striped table-bordered table-condensed">
	<thead>
	<tr>
		<th>ชื่ออุปกรณ์</th>
		<th>จำนวนยืม</th>
	</tr>
	</thead>
		<tr>
		<td align="left"><div id="lalequipment_id"></div></td>
		<td align="left"><div id="lalequipment_unit"></div></td>
		</tr>
		<tr>
		<td align="left"><div id="lalname"></div></td>
		<td align="left"><div id="lalnumber"></div></td>
	</tr>
</table>
   <div class="col-xs-12">
    <div class="col-lg-6 col-xs-6 col-sm-6" align="right">
		<label class="control-label">หมายเหตุ : </label>
	</div>
	<div align="left">
        <div id="lalnote" class="col-lg-6 col-xs-6 col-sm-6" style="padding-left: 0px;"></div>
	</div>
   </div>
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">ยกเลิก</button>
        <button type="button" class="btn btn-primary" id="buttontext" onClick="submit();"><i class="fa fa-check" aria-hidden="true"></i> ยืนยัน</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<div class="row">

<div class="text-center bg" style="margin: 10px; margin-top: 0px;">
<hr>
<h3 align="center"><!-- <i class="fa fa-wpforms" style="font-size:20px"></i> -->&#128203; ฟอร์มขอใช้บริการ</h3>
<hr>
<form id="frmborrow" method="post" class="form-horizontal" action="?page=borrow_save" >
	<div class="form-group">
		<label class="col-sm-5 control-label">วันที่ขอใช้บริการ :</label>
		<div class="col-sm-4" style="margin-top: 8px;" align="left">
<div id="date"></div>
			<input type="hidden" name="servicedetail_date" id="servicedetail_date" class="form-control-static" value="<?=date("Y-m-d H:i:s");?>">
		</div>
	  <div class="col-md-3"></div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">ในวันที่ :</label>
		<div class="col-sm-2 on_date">
			<input type="date" class="form-control" name="on_date" id="on_date" required="required" min="<?=date("Y-m-d",strtotime("+2 day"));?>" value="<?=date("Y-m-d",strtotime("+2 day"));?>" onBlur="chkondate();">
		</div>
		<label class="col-sm-1 control-label" style="width: 70px;">เวลา :</label>
		<div class="col-sm-1 on_time" style="width: 130px;">
		<input type="time" class="form-control" name="on_time" id="on_time" required="required" onBlur="chkontime();">
		</div>
		<div class="col-sm-3" align="left"><span class="required" style="color:red;">* ล่วงหน้า2วัน</span></div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">ถึงวันที่ <span class="required">*</span></label>
		<div class="col-sm-2 to_date">
			<input type="date" class="form-control" name="to_date" id="to_date" required="required" min="<?=date("Y-m-d",strtotime("+2 day"));?>" onBlur="chktodate();">
		</div>
		<label class="col-sm-1 control-label" style="width: 70px;">เวลา :</label>
		<div class="col-sm-1 to_time" style="width: 130px;">
		<input type="time" class="form-control" name="to_time" id="to_time" required="required" onBlur="chktotime();">
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">ความประสงค์/กิจกรรม <span class="required">*</span></label>
		<div class="col-sm-3 detail">
			<textarea type="text" class="form-control" name="detail" id="detail" requirement onBlur="chkdetail();"></textarea>
		</div>
	</div>
	<div class="form-group">
		<label class="col-sm-5 control-label">สถานที่ <span class="required">*</span></label>
		<div class="col-sm-3 place">
			<textarea type="text" class="form-control" name="place" id="place" required="required" onBlur="chkplace();"></textarea>
		</div>
	</div>
	<div class="form-group ">
	  <label class="col-sm-5 control-label">บริการติดตั้ง </label>
	  <div class="col-lg-2 col-md-2 col-sm-3 service_id has-success">
		  <select class="form-control"  name="service_id" id="service_id" onBlur="chkservice();">
			<?php
			$sql="select * from tb_service ";
			$result=$db->query($sql);
			while($row=$result->fetch_array(MYSQLI_ASSOC)){
			?>
			<option value="<?=$row["service_id"]?>"><?=$row["service_name"]?></option>
			<?php
			}
			?>
		</select>
	  </div>
	</div><br>

<div style="margin: 10px; margin-top: 0px;" class="bgtable">
<div class="table-responsive">
<table class="table table-striped table-bordered table-condensed" id="dynamic_field">
	<thead bgcolor="#9c76b3">
		<tr>
		<th>รหัสอุปกรณ์</th>
		<th>ชื่ออุปกรณ์</th>
		<th>รายละเอียดอุปกรณ์</th>
		<th>จำนวนที่สามารถยืมได้</th>
		<th>สถานะของอุปกรณ์</th>
		<th>จำนวนยืม</th>
		</tr>
	</thead>
		<tbody>
		<?php
		$sql="select * from tb_equipment eq inner join tb_status st where eq.status_id=st.status_id and st.status_id=1";
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
			<input class="form-control" type="number" min="0" placeholder="จำนวน" name="equipment_unit[]" id="equipment_unit_<?=$i?>" max="<?=$row["equipment_number"]?>" onblur="checknumber('<?=$i?>')">
		</td>
			
	 	<?php $i++;} ?>
 		</tr>
		</tbody>
</table>
	</div>
<button type="button" name="add" id="add" class="btn btn-success" title="เพิ่มอุปกรณ์">เพิ่มอุปกรณ์</button><br>
<br>
	<div class="form-group">
		<label class="col-sm-4 control-label">หมายเหตุ :</label>
			<div class="col-sm-5">
				<textarea class="form-control" name="note" id="note"></textarea>
			</div>
	</div>
		<div class="form-group">
			<button class="btn btn-primary" type="button" style="font-size:16px" title="บันทึก" onClick="confirmdata();"><i class="fa fa-save" ></i> บันทึกข้อมูลยืม</button>
		</div>
  </form>
  </div>
 </div><!-- div text-center&style margin-->
</div><!-- row-->
<div><br><br></div>
</body>
</html>
<script>
$(document).ready(function(){
	//var delform="";//อาร์เรย์
	var i=0;
	$('#add').click(function(){
		i++;
		$('#dynamic_field').append('<tr id="row'+i+'"><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove" title="ลบ" onClick=remove_row("row'+i+'");>X</button></td>									 	<td colspan="4">       																			<input type="text" name="name[]" id="name'+i+'" placeholder="ชื่ออุปกรณ์" class="form-control name_list"></td>             																		<td>																							<input type="number" name="number[]" id="number'+i+'" placeholder="จำนวน" min="1" class="form-control name_list"><input type="hidden" name="fm[]" id="fm'+i+'" value="'+i+'" placeholder="จำนวน" min="1" class="form-control name_list"></td>																		</tr>');
	});
	
	/*$(document).on('click', '.btn_remove', function(){
		var button_id = $(this).attr("id"); 
		$('#row'+button_id+'').remove();
		i=i-1;
	});*/
});
	
	function remove_row(ids){
		$('#'+ids).remove();
		//alert(ids);
	}
</script>
<script>
	function chkondate(){
		if(document.getElementById('on_date').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#on_date').focus();
			$('#frmborrow .on_date').addClass('has-error');
			$('#frmborrow .on_date').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .on_date').addClass('has-success');
			$('#frmborrow .on_date').removeClass('has-error');
		}
	}
	function chkontime(){
		if(document.getElementById('on_time').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#to_date').focus();
			$('#frmborrow .on_time').addClass('has-error');
			$('#frmborrow .on_time').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .on_time').addClass('has-success');
			$('#frmborrow .on_time').removeClass('has-error');
		}
	}
	function chktodate(){
		if(document.getElementById('to_date').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#to_date').focus();
			$('#frmborrow .to_date').addClass('has-error');
			$('#frmborrow .to_date').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .to_date').addClass('has-success');
			$('#frmborrow .to_date').removeClass('has-error');
		}
	}
	function chktotime(){
		if(document.getElementById('to_time').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#to_date').focus();
			$('#frmborrow .to_time').addClass('has-error');
			$('#frmborrow .to_time').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .to_time').addClass('has-success');
			$('#frmborrow .to_time').removeClass('has-error');
		}
	}
	function chkdetail(){
		if(document.getElementById('detail').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#detail').focus();
			$('#frmborrow .detail').addClass('has-error');
			$('#frmborrow .detail').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .detail').addClass('has-success');
			$('#frmborrow .detail').removeClass('has-error');
		}
	}
	function chkplace(){
		if(document.getElementById('place').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#place').focus();
			$('#frmborrow .place').addClass('has-error');
			$('#frmborrow .place').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .place').addClass('has-success');
			$('#frmborrow .place').removeClass('has-error');
		}
	}
	function chkservice(){
		if(document.getElementById('service_id').value == "")
		{
        //alert('กรุณากรอกวันที่คืนด้วย');
			//$('#service_id').focus();
			$('#frmborrow .service_id').addClass('has-error');
			$('#frmborrow .service_id').removeClass('has-success');
			return false;
    	}else{
			$('#frmborrow .service_id').addClass('has-success');
			$('#frmborrow .service_id').removeClass('has-error');
		}
	}

	function confirmdata(){
	/*chkondate();	
	chktodate();
	chkdetail();
	chkplace();
	chkservice();*/
	if(document.getElementById('on_date').value == "")
    {
		chkondate();
		$('#on_date').focus();
		return false;
    }
	if(document.getElementById('on_time').value == "")
    {
        chkontime();
		$('#on_time').focus();
		return false;
    }
	if(document.getElementById('to_date').value == "")
    {
        chktodate();
		$('#to_date').focus();
		return false;
    }
	if(document.getElementById('to_time').value == "")
    {
        chktotime();
		$('#to_time').focus();
		return false;
    }
	if(document.getElementById('detail').value == "")
    {
        chkdetail();
		$('#detail').focus();
		return false;
    }
	if(document.getElementById('place').value == "")
    {
        chkplace();
		$('#place').focus();
		return false;
    }
	if(document.getElementById('service_id').value == "")
    {
        chkservice();
		$('#service_id').focus();
		return false;
    }
		//var servicedetail_date=$('#frmborrow #servicedetail_date').val();
		var on_date=$('#frmborrow #on_date').val();
		var to_date=$('#frmborrow #to_date').val();
		var detail=$('#frmborrow #detail').val();
		var place=$('#frmborrow #place').val();
		var service_id=$('#frmborrow #service_id').val();
		var servicetext=$("#frmborrow #service_id option:selected").text();
		var equipmenttext=$('#frmborrow #equipment_id').text();
		var equipmentunit=$("#frmborrow input[name='equipment_unit[]']").length;
		var note=$('#frmborrow #note').val();
		var msg="";
		var eqmtext="";
			var checkval=false;
			for (var i=1;i<=equipmentunit;i++){
				if ($("#frmborrow #equipment_unit_"+i).val()>0){
					msg+="<div style=\"border-bottom: #E4E2E2 1px solid;\">"+$("#frmborrow #equipment_unit_"+i).val()+"</div>";
					eqmtext+="<div style=\"border-bottom: #E4E2E2 1px solid;\">"+$("#frmborrow #equipment_name_"+i).html()+"</div>";
					checkval=true;
					//แทรกคำสั่งเช็คค่ามากกว่า

				}
			}
			equipmentunit=msg;
			equipmenttext=eqmtext;
		var equipmentname=$("#frmborrow input[name='name[]']").length;
		var equipmentnumber=$("#frmborrow input[name='number[]']").length;
		var equipmentnameTXT="";
		var equipmentnumberTXT="";
		/*var a=$('input[name="name[]"]').val();
		alert a[1];*/
			var checkval2=false;
			if(equipmentnumber>0){
			for (var i=1;i<= 50 ;i++){
				if ($("#number"+i).val()>0 && $("#name"+i).val()!=""){
					equipmentnumberTXT+="<div style=\"border-bottom: #E4E2E2 1px solid;\">"+$("#number"+i).val()+"</div>";
					equipmentnameTXT+="<div style=\"border-bottom: #E4E2E2 1px solid;\">"+$("#name"+i).val()+"</div>";
					checkval2=true;
				}
			}
			
			}else{
			}
		if(checkval==true || checkval2==true){
		//$('#add_data_Modal #lalservicedetail_date').html(servicedetail_date);
		$('#add_data_Modal #lalon_date').html(on_date);
		$('#add_data_Modal #lalto_date').html(to_date);
		$('#add_data_Modal #laldetail').html(detail);
		$('#add_data_Modal #lalplace').html(place);
		$('#add_data_Modal #lalservice_id').html(servicetext);
		$('#add_data_Modal #lalequipment_id').html(equipmenttext);
		$('#add_data_Modal #lalequipment_unit').html(equipmentunit);
		$('#add_data_Modal #lalname').html(equipmentnameTXT);
		$('#add_data_Modal #lalnumber').html(equipmentnumberTXT);
		$('#add_data_Modal #lalnote').html(note);
		//$('#add_data_Modal #textdetail').val(detail); //ถ้าต้องการให้มีtextboxขึ้นให้แก้ไข
		$('#add_data_Modal').modal('show');
		}else {
			alert ("กรุณากรอกข้อมูลให้ครบ");
		}
		
	}
	function submit(){
		document.getElementById("frmborrow").submit();
		$("#buttontext").html("ระบบกำลังทำการโปรดรอสักครู่.....");
		document.getElementById("buttontext").disabled = true;
		return true;
	}
	function checknumber(index){
		//debugger;
		var equipmentnumber=$('#frmborrow #equipment_number_'+index).html();
		var equipmentunit=$('#frmborrow #equipment_unit_'+index).val();
		if(parseInt(equipmentnumber)< parseInt(equipmentunit)){
			//ถ้าจำนวนอุปกรณ์ที่มีอยู่น้อยกว่าที่ผู้ใช้ต้องการให้ทำ
			//alert('เกินจำนวนที่สามารถยืมได้');
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
var day = ["วันอาทิตย์","วันจันทร์","วันอังคาร","วันพุทธ","วันพฤหัสบดี","วันศุกร์","วันเสาร์"];
var month = ["มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน",
"กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤษจิกายน","ธันวาคม"];
var d = new Date();
document.getElementById("date").innerHTML=day[d.getDay()]+" ที่ "+(d.getDate())+" "+(month[d.getMonth()])+" พ.ศ. "+(d.getFullYear()+543)+" เวลา "+(d.getHours())+":"+(d.getMinutes()>9? d.getMinutes():'0'+d.getMinutes())+" น.";
</script>