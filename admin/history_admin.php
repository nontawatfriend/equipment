<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>history</title>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-select.min.js"></script>
<link href="css/bootstrap-select.min.css" rel="stylesheet"><!--การ select ค้นหาด้วยชื่อ-->
<script src="js/jquery-ui.js"></script><!-- date search-->
</head>
<body>
<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-left"></i> ย้อนกลับ</th></a>
<h3 align="center"><i class="glyphicon glyphicon-th-list" style="font-size:20px"></i> ประวัติทำรายการ</h3>
<hr>
<!--<table class="datatable table table-hover table-bordered">-->
<div class="col-md-1"></div>
	<div class="col-md-3 service_id">
		  <select class="form-control selectpicker" id="user_id" name="user_id" data-live-search="true"><!--onchange="man()"-->
			  <option value="">&emsp;&emsp;--- เลือกรายชื่อเพื่อค้นหา --- </option>
			<?php
			$sql="select * from tblemployment";
			$result=$db->query($sql);
			while($row=$result->fetch_array(MYSQLI_ASSOC)){
			?>
			<option value="<?=$row["ID"]?>"><?=$row["prefixThai"]?> <?=$row["nameThai"]?></option>
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
<button type="button" class="btn btn-primarybtn btn-info" title="ค้นหาจากอุปกรณ์" onclick="window.location='?page=history_equipment'"><span class="fa fa-search"></span> ค้นหาจากอุปกรณ์</button>
<button type="button" class="btn btn-success" onClick="exports();" id="buttontext"><i class="fa fa-file-excel-o"></i> Export</button>
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
$sql="select * from tb_servicedetails where status_id=4 order by servicedetail_id ASC";
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
$month_arr = array("มกราคม" , "กุมภาพันธ์" , "มีนาคม" , "เมษายน" , "พฤษภาคม" , "มิถุนายน" , "กรกฏาคม" , "สิงหาคม" , "กันยายน" , "ตุลาคม" ,"พฤศจิกายน" , "ธันวาคม" ) ; //กำหนด อาร์เรย์ $month_arr  เพื่อเก็บ ชื่อเดือน ของไทย
// ใช้ฟังชั่น strtok เพื่อแยก ปี เดือน วัน
// โดยเริ่มจาก ปีก่อน
$tok = strtok($date_in, "-"); //สร้างตัวแปล $tok เพื่อเก็บค่าแยกของปี ออกมา
$year = $tok ; //กำหนดค่าให้ ตัวแปล $year มีค่าเท่ากับ ปีที่ ถูกแยกออกมาจาก ตัวแปล $tok 
//ต่อไปคือส่วนของ เดือน
$tok  = strtok("-");// ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
$month = $tok ;//สร้างตัวแปล$monthเพื่อเก็บค่าแยกของเดือน ออกมา
//ต่อไปส่วนสุดท้ายคือ ส่วนของวันที่
$tok = strtok("-");//ส่วนนี้เราจะมีไว้เพื่อทำการแยกเดือน
$day = $tok ;//สร้างตัวแปล $$dayเพื่อเก็บค่าแยกของเดือน ออกมา
//เมื่อได้ส่วนแยกของ วัน เดือน ปี มาแล้วว แต่ ปี ยังเป็นรูปแบบของ ค.ศ. ดังนั้นเราต้องแปล เป็น พ.ศ.  ก่อนด้ววิธีกรนนี้
$year_out = $year + 543 ;// สร้างตัวแแปลขึ้นมาเพื่อเก็บค่าที่ได้จากการนำปี ค.ศ. มาบวกกับ 543  ก็จะได้ปีที่เป็น  พ.ศ. ออกมา
$cnt = $month-1 ;// เราตัองสร้างตัวแปล มาเพื่อเก็บค่าเดือน โดยจะต้องเอาเดือนที่ได้มา ลบ 1 เพราะว่า เราจะต้องใช้ในการเทียบกับ ค่าที่อยู่ได้อาร์เรย์ เนื่องจาก อาร์เรย์จะมีค่า เริ่มจาก 0
$month_out = $month_arr[$cnt] ;// ทำการเทียบค่าเดือนที่ได้กับเดือนที่เก็บไว้ในอาร์เรย์ แล้วเก็บลงใน ตัวแปล
$t_date = $day." ".$month_out." ".$year_out ; //สร้างตัวแปลเก็บค่า วัน เดือน ปี ที่แปลเป็นไทยแล้ว
return $t_date ;// ส่งค่ากลับไปยังส่วนที่ส่งมา
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
		$("#user_id").datepicker();
	});
	$('#range').click(function(){
		var on_date = $('#on_date').val();
		var to_date = $('#to_date').val();
		var user_id = $('#user_id').val();
		
		if(on_date != '' && to_date != '')
		{
			$.ajax({
				url:"history_search.php",
				method:"POST",
				data:{on_date:on_date, to_date:to_date, user_id:user_id},
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
			alert("กรุณาระบุวันที่เพื่อค้นหา");
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
		function exports(){
			var on_date = $('#on_date').val();
			var to_date = $('#to_date').val();
			var user_id = $('#user_id').val();
			if(on_date != '' && to_date != ''){
				window.location.href ="export.php?ondate="+on_date+"&todate="+to_date+"&userid="+user_id;
			}else if(on_date == '' && to_date == ''){
				window.location.href ="export.php?ondate="+on_date+"&todate="+to_date+"&userid="+user_id;
			}else
			{
				alert("กรุณาระบุวันที่");
			}
			/* debugger; */
		}
</script>