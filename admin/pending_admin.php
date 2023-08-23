<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pending_admin</title>
<meta http-equiv="refresh" content="300"/>
</head>
<body>
<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-left"></i> ย้อนกลับ</th></a>
<h3 align="center"><!-- <i class="fa fa-clock-o" style="font-size:20px"></i> -->&#128344; กำลังรออนุมัติ</h3>
<hr>
<div class="table-responsive">
<table class="datatable table table-hover table-bordered">
<thead style=" background-color: #f0ad4e">
 <tr>
 <th width="14%"><h4>รหัสยืมอุปกรณ์</h4></th>
 <th width="20%"><h4>ชื่อผู้ใช้</h4></th>
 <th width="23%"><h4>ในวันที่</h4></th>
 <th width="23%"><h4>ถึงวันที่</h4></th>
 <th width="20%"><h4>สถานะการยืม</h4></th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_servicedetails where status_id=1";
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
 <td><a href="?page=check&servicedetail_id=<?=$row["servicedetail_id"];?>" title="ดูรายละเอียด"><button class="btn btn-warning"><i class="fa fa-search"></i> รออนุมัติ/ยืนยัน</button></a></td>
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