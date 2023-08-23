<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>history_equipment</title>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<link href="css/bootstrap-select.min.css" rel="stylesheet"><!--การ select ค้นหาด้วยชื่อ-->
<script src="js/jquery-ui.js"></script><!-- date search-->
</head>
<body>
<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-left"></i> ย้อนกลับ</th></a>
<h3 align="center"><i class="glyphicon glyphicon-th-list" style="font-size:20px"></i> ประวัติทำรายการ</h3><br>
<!--<table class="datatable table table-hover table-bordered">-->
<div class="col-md-1"></div>
	<div class="col-md-3 service_id">
		  <select class="form-control selectpicker" id="equipment_id" name="equipment_id" data-live-search="true"><!--onchange="man()"-->
			  <option value="">&emsp;&emsp;--- เลือกอุปกรณ์เพื่อค้นหา --- </option>
			<?php
			$sql="select * from tb_equipment";
			$result=$db->query($sql);
			while($row=$result->fetch_array(MYSQLI_ASSOC)){
			?>
			<option value="<?=$row["equipment_id"]?>"><?=$row["equipment_name"]?></option>
			<?php
            }
			?>
            <option value="" disabled="disabled">>>>>>>>>>> อุปกรณ์อื่นๆ <<<<<<<<<<</option>
            <?php
			$sqli="SELECT DISTINCT equipment_text from tb_list where equipment_id=0 AND status_id=4";
			$resulti=$db->query($sqli);
			while($rowi=$resulti->fetch_array(MYSQLI_ASSOC)){
			?>
			<option value="<?=$rowi["equipment_text"]?>"><?=$rowi["equipment_text"]?></option>
            
			<?php
            }
            
			?>
		</select>
	  </div>
<div class="col-md-2">
<input type="date" name="on_date" id="on_date" class="form-control" placeholder="วันที่"/>
</div>
<div class="col-md-2">
<input type="date" name="to_date" id="to_date" class="form-control" placeholder="ถึงวันที่"/>
</div>
<div class="col-md-4">
<input type="button" name="range" id="range" value="ค้นหา" class="btn btn-primary" title="ค้นหา"/>
<button type="button" id="reset" class="btn btn-warning"title="Refresh"><span class="fa fa-refresh"></span></button>
<button type="button" class="btn btn-info" title="ค้นหาจากรายชื่อ" onclick="window.location='?page=history_admin'"><span class="fa fa-search"></span> ค้นหาจากรายชื่อ</button>
<button type="button" class="btn btn-success" onClick="exports_equipment();" id="buttontext"><i class="fa fa-file-excel-o"></i> Export</button>
</div>
<div class="clearfix"></div>
<div id="form_history">
<br/>
<div class="table-responsive">
<table class="Datatable table table-hover table-bordered" id="example">
<thead style="background-color: #5cb85c">
 <tr>
 <th width="8%">รหัสยืม</th>
 <th width="20%">ชื่อผู้ใช้</th>
 <th width="20%">วันที่ยืม</th>
 <th width="20%">ถึงวันที่</th>
 <th width="8%">ผู้ให้ยืม</th>
 <th width="8%">ผู้รับคืน</th>
 <th width="8%">หมายเหตุคืน</th>
 <th width="8%">สถานะการยืม</th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_servicedetails where status_id=4 order by servicedetail_id DESC";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_ASSOC)){
?>
 <tr>
 <td><?=$row["servicedetail_id"]?></td>
  <?php
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
	$row["on_date"]=show_tdate($row["on_date"]);
	$row["to_date"]=show_tdate($row["to_date"]);
 ?>
 <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
 <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
 <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
 <td><?=$row["userapprove_id"]?></td>
 <td><?=$row["userrecipient_id"]?></td>
 <td><?=$row["recipient_note"]?></td>
 <td><a href="?page=check_history&servicedetail_id=<?=$row["servicedetail_id"];?>"  title="ดูรายละเอียด"><span class="btn btn-success"><i class="fa fa-search"></i> คืนอุปกรณ์แล้ว</span></a></td>
 </tr>
 <?php } ?>
</tbody>
</table>
</div>
</div>
</body>
</html>
<?php
function  show_tdate($date_in) // กำหนดชื่อของฟังชั่น show_tdate และสร้างตัวแปล $date_in ในการรับค่าที่ส่งมา
{
$month_arr = array("มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ;
$tok = strtok($date_in, "-");
$year = $tok ;
$tok  = strtok("-");
$month = $tok ;
$tok = strtok("-");
$day = $tok ;
$year_out = $year + 543 ;
$cnt = $month-1 ;
$month_out = $month_arr[$cnt] ;
$t_date = $day." ".$month_out." ".$year_out ;
return $t_date ;
}
?>
<script type="text/javascript">
    //คำสั่ง Jquery เริ่มทำงาน เมื่อ โหลดหน้า Page เสร็จ 
	$(document).ready(function() {
    //กำหนดให้  Plug-in dataTable ทำงาน ใน ตาราง Html ที่มี id เท่ากับ example
		$('#example').DataTable( {
			
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		} );
	} );
	
$(document).ready(function(){
	$.datepicker.setDefaults({
		dateFormat: 'yy-mm-dd'
	});
	$(function(){
		$("#on_date").datepicker();
		$("#to_date").datepicker();
		$("#equipment_id").datepicker();
	});
	$('#range').click(function(){
		var on_date = $('#on_date').val();
		var to_date = $('#to_date').val();
		var equipment_id = $('#equipment_id').val();
		
		if(on_date != '' && to_date != '' && equipment_id != '')
		{
			$.ajax({
				url:"search_equipment.php",
				method:"POST",
				data:{on_date:on_date, to_date:to_date, equipment_id:equipment_id},
				success:function(data)
				{
					$('#form_history').html("");
					$('#form_history').html(data);
					//.hide(0).fadeIn(1000)
				}
			});
		}else if(on_date == '' && to_date == '' && equipment_id != '')
		{
			$.ajax({
				url:"search_equipment.php",
				method:"POST",
				data:{on_date:on_date, to_date:to_date, equipment_id:equipment_id},
				success:function(data)
				{
					$('#form_history').html("");
					$('#form_history').html(data);
					//.hide(0).fadeIn(1000)
				}
			});
		}
		else
		{
			alert("กรุณาระบุข้อมูลให้ครบเพื่อค้นหา");
		}
	});
});
	
	$('#reset').on('click', function(){
		location.reload();
	});

	$(function() {
  $('.selectpicker').selectpicker();
});
</script>
<script>
		function exports_equipment(){
			var on_date = $('#on_date').val();
			var to_date = $('#to_date').val();
			var equipment_id = $('#equipment_id').val();
			debugger;
			if(on_date != '' && to_date != '' && equipment_id !==""){
				window.location.href ="export_equipment.php?ondate="+on_date+"&todate="+to_date+"&equipmentid="+equipment_id;
			}else if(on_date == '' && to_date == '' && equipment_id !==""){
				window.location.href ="export_equipment.php?ondate="+on_date+"&todate="+to_date+"&equipmentid="+equipment_id;
			}else
			{
				alert("กรุณากรอกข้อมูลให้ครบ");
			}
			/* debugger; */
		}
</script>
