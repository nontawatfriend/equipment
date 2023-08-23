<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Notapproved</title>
</head>
<body>
<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-left"></i> ย้อนกลับ</th></a>
<h3 align="center"><!-- <i class="glyphicon fa fa-times" style="font-size:20px"></i> -->&#128473; รายการที่ไม่อนุมัติ</h3>
<hr>
<!--<table class="datatable table table-hover table-bordered">-->
<div class="table-responsive">
<table class="Datatable table table-hover table-bordered " id="example">
<thead style="background-color: #d9534f">
 <tr>
 <th><h4>รหัสยืมอุปกรณ์</h4></th>
 <th><h4>ชื่อผู้ใช้</h4></th>
 <th><h4>วันที่ยืม</h4></th>
 <th><h4>ถึงวันที่</h4></th>
 <th><h4>หมายเหตุ</h4></th>
 <th><h4>สถานะการยืม</h4></th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_servicedetails where status_id=2";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
	$row["on_date"]=show_tdate($row["on_date"]);
	$row["to_date"]=show_tdate($row["to_date"]);
?>
 <tr>
 <td><?=$row["servicedetail_id"]?></td>
  <?php
	$sqlmember="select * from tblemployment where ID='$row[user_id]'";
	$resultmember=$db->query($sqlmember);
	$rowmember=$resultmember->fetch_array(MYSQLI_BOTH);
 ?>
 <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
 <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
 <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
 <td><?=$row["notapproved_note"]?></td>
 <td><a href="?page=check_nothistory&servicedetail_id=<?=$row["servicedetail_id"];?>"  title="ดูรายละเอียด"><span class="btn btn-danger"><i class="fa fa-search"></i> ดูรายละเอียด</span></a></td>
<?php } ?>
 </tr>
</tbody>
</table>
</div>
</body>
</html>
<?php
function  show_tdate($date_in)
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
</script>