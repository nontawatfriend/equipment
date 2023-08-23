<script type="text/javascript">
	$(document).ready(function() {
		$('#example').DataTable( {
			"lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]]
		} );
	} );		
</script>
<?php 
require'config.php';
?>
<?php
//ค้นหาทั้ง id อุปกรณ์ และ ค้นหาตามวันเวลา
if($_POST["equipment_id"] >0){
	if($_POST["on_date"]!="" && $_POST["to_date"]!="" && $_POST["equipment_id"]!==""){?>
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
	$sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) inner join tb_equipment as te  on (tl.equipment_id=te.equipment_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '".$_POST["on_date"]."' AND '".$_POST["to_date"]."' AND te.equipment_id=".$_POST["equipment_id"]."";
    $result=$db->query($sql);
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
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
	 <td><a href="?page=check_history&servicedetail_id=<?=$row["servicedetail_id"];?>"  title="ดูรายละเอียด"><span class="btn btn-success"><i class="fa fa-search"></i> คืนอุปกรณ์แล้ว</span></a></td>
	<?php } ?>
	 </tr>
	</tbody>
	</table>
    </div>
	<?php
    }else{
        ?>
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
        $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) inner join tb_equipment as te  on (tl.equipment_id=te.equipment_id) WHERE tl.status_id=4 AND te.equipment_id=".$_POST["equipment_id"]."";
        $result=$db->query($sql);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
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
        <td><a href="?page=check_history&servicedetail_id=<?=$row["servicedetail_id"];?>"  title="ดูรายละเอียด"><span class="btn btn-success"><i class="fa fa-search"></i> คืนอุปกรณ์แล้ว</span></a></td>
        <?php } ?>
        </tr>
	</tbody>
	</table>
    </div>
    <?php
    }
    ?>
    <?php
}else if($_POST["on_date"] !="" && $_POST["to_date"] !="" && $_POST["equipment_id"] !=""){
    ?>
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
        $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '".$_POST["on_date"]."' AND '".$_POST["to_date"]."' AND tl.equipment_text='".$_POST["equipment_id"]."'";
        $result=$db->query($sql);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
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
         <td><a href="?page=check_history&servicedetail_id=<?=$row["servicedetail_id"];?>"  title="ดูรายละเอียด"><span class="btn btn-success"><i class="fa fa-search"></i> คืนอุปกรณ์แล้ว</span></a></td>
        <?php } ?>
         </tr>
        </tbody>
        </table>
    </div>
    <?php
    }else{
        ?>
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
        $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND tl.equipment_text='".$_POST["equipment_id"]."'";
        $result=$db->query($sql);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
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
         <td><a href="?page=check_history&servicedetail_id=<?=$row["servicedetail_id"];?>"  title="ดูรายละเอียด"><span class="btn btn-success"><i class="fa fa-search"></i> คืนอุปกรณ์แล้ว</span></a></td>
        <?php } ?>
         </tr>
        </tbody>
        </table>
    </div>
    <?php
    }
    ?>
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