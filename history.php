<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>history</title>
</head>
<!-- <style>
	tr:nth-child(even){background-color: #FFFFFF}
</style> -->
<body>
      <div class="row bg">
       <div class="col-lg-12">
	   <hr>
	   <h3 align="center"><i class="fa fa-th-list" style="font-size:20px"></i> ประวัติทำรายการ</h3>
	   <hr>
<div class="table-responsive">
<table class="datatable table table-hover table-bordered">
<thead style="background-color: #5cb85c">
 <tr>
 <th><h4>รหัสยืมอุปกรณ์</h4></th>
 <th><h4>ชื่อผู้ใช้</h4></th>
 <th><h4>วันที่ยืม</h4></th>
 <th><h4>ถึงวันที่</h4></th>
 <th><h4>ผู้อนุมัติ</h4></th>
 <th><h4>ผู้รับคืน</h4></th>
 <th><h4>หมายเหตุคืน</h4></th>
 <th><h4>สถานะการยืม</h4></th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_servicedetails where user_id='$_SESSION[EMPID]' and status_id=4";
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
 <td><?=$row["userapprove_id"]?></td>
 <td><?=$row["userrecipient_id"]?></td>
 <td><?=$row["recipient_note"]?></td>
 <td><a href="?page=history_detail&servicedetail_id=<?=$row["servicedetail_id"];?>" title="ดูรายละเอียด"><span class="btn btn-success"><i class="fa fa-search"></i> คืนอุปกรณ์แล้ว</span></a></td>
<?php } ?>
 </tr>
</tbody>
</table>
</div>
      </div> <!-- /.col-lg-12 -->
    </div> <!-- /.row -->
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