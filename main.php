<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Home</title>
<link rel="stylesheet" href="css/jquery.fancybox.min.css" media="screen">
<script src="js/jquery.fancybox.min.js"></script>
<!--ดูภาพอุปกรณ์-->
</head>
<style>
	.gallery
        {
        display: inline-block;
        margin-top: 20px;
        }
</style>
<body>
<div class="row bg">
    <div class="col-lg-12">
	<hr>
	   <h3 align="center">รายการอุปกรณ์</h3>
	<hr>
<div class="table-responsive">
<table class="table table-hover table-bordered" id="example">
<thead style="background-color: #9c76b3">
 <tr>
 <th><h4>รหัสอุปกรณ์</h4></th>
 <th><h4>รูปภาพอุปกรณ์</h4></th>
 <th><h4>ชื่ออุปกรณ์</h4></th>
 <th><h4>รายละเอียดอุปกรณ์</h4></th>
 <th><h4>จำนวนที่สามารถยืมได้</h4></th>
 <th><h4>สถานะของอุปกรณ์</h4></th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_equipment inner join tb_status where tb_equipment.status_id=tb_status.status_id and  tb_status.status_id=1";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
?>
 <tr>
 <td><?=$row["equipment_id"]?></td>
 <td>
	 <a href="admin/equipment_img/<?=$row['equipment_photo'];?>" title="<?=$row['equipment_name'];?>" rel="ligthbox" class="fancybox btn btn-info">ดูรูปภาพ</a>
	 <!--<img src="admin/equipment_img/ep.jpg" class="img-thumbnail" height="75"width="75" >-->
 </td>
 <td><?=$row["equipment_name"]?></td>
 <td><?=$row["equipment_detail"]?></td>
 <td><?=$row["equipment_balance"]?></td>
<?php
if($row["status_id"] == "1"){
echo "<td><span style='color:green'>ปกติ</span></td>";
}else if($row["status_id"] == "2"){
echo "<td><span style='color:red'>ใช้งานไม่ได้</span></td>";
}else{
echo "<td><span style='color:red'>ข้อมูลไม่แน่ชัด</span></td>";
}
?>
<?php } ?>
 </tr>
</tbody>
</table>
</div>
      </div> <!-- /.col-lg-12 -->
   </div> <!-- /.row -->
</body>
</html>
<script type="text/javascript">
    //คำสั่ง Jquery เริ่มทำงาน เมื่อ โหลดหน้า Page เสร็จ 
	$(document).ready(function() {
    //กำหนดให้  Plug-in dataTable ทำงาน ใน ตาราง Html ที่มี id เท่ากับ example
	$('#example').DataTable( {
	"lengthMenu": [[25, 50, 100, -1 ], [25, 50, 100, "All" ]]
	} );
	} );
</script>
<script>
	$(document).ready(function(){
    //FANCYBOX
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
</script>