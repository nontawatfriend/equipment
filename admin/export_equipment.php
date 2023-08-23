<?php include("config.php");
$startdate=$_GET["ondate"];
$enddate=$_GET["todate"];
$equipmentid=$_GET["equipmentid"];
header("Content-type: application/vnd.ms-excel");
// header('Content-type: application/csv'); //*** CSV ***//
header("Content-Disposition: attachment; filename=ประวัติการทำรายการอุปกรณ์.xls");
?>
<html>
<body>
<?php
$startdatethai=show_tdate($startdate);
$enddatethai=show_tdate($enddate);
    $sqlmem='';
	$sqlmem="select * from tb_equipment where equipment_id='$equipmentid'";
	$resultmem=$db->query($sqlmem);
    $rowmem=$resultmem->fetch_array(MYSQLI_ASSOC);
if($equipmentid == $rowmem["equipment_id"]){
		if(!empty($startdate) && !empty($enddate) && !empty($equipmentid)){?>
			<h3 align="center"> ประวัติรายการยืมอุปกรณ์ <?=$rowmem["equipment_name"]?> วันที่ <?=$startdatethai?> ถึงวันที่ <?=$enddatethai?></h3>
			<?php }
		else if(!empty($startdate) && !empty($enddate) && empty($$equipmentid)){?>
			<h3 align="center">ประวัติรายการวันที่ <?=$startdatethai?> ถึงวันที่ <?=$enddatethai?></h3>
			<?php } 
		else if(empty($startdate) && empty($enddate) && !empty($equipmentid)){?>
			<h3 align="center">ประวัติรายการยืมอุปกรณ์ <?=$rowmem["equipment_name"]?></h3>
			<?php } 
		else{?>
			<h3 align="center">ประวัติรายการ</h3>
        <?php }
}else{
    $sqlmem='';
    $sqlmem="select * from tb_list where equipment_text='$equipmentid'";
	$resultmem=$db->query($sqlmem);
    $rowmem=$resultmem->fetch_array(MYSQLI_ASSOC);
        if(!empty($startdate) && !empty($enddate) && !empty($equipmentid)){?>
			<h3 align="center"> ประวัติรายการยืมอุปกรณ์ <?=$rowmem["equipment_text"]?> ระหว่างวันที่ <?=$startdatethai?> ถึงวันที่ <?=$enddatethai?></h3>
			<?php }
		else if(!empty($startdate) && !empty($enddate) && empty($$equipmentid)){?>
			<h3 align="center">ประวัติรายการระหว่างวันที่ <?=$startdatethai?> ถึงวันที่ <?=$enddatethai?></h3>
			<?php } 
		else if(empty($startdate) && empty($enddate) && !empty($equipmentid)){?>
			<h3 align="center">ประวัติรายการยืมอุปกรณ์ <?=$rowmem["equipment_text"]?></h3>
			<?php } 
		else{?>
			<h3 align="center">ประวัติรายการ</h3>
        <?php }
}
/* if($equipmentid >0){ *///กรณีข้อมูลไอดีอุปกรณ์เท่ากับไอดีในฐานข้อมูล
/*     echo $equipmentid;
    echo ("มีไอดี");exit; */
    /* if(isset($startdate, $enddate, $equipmentid)){ */
    ?>
        <table border="1">
        <tr>
        <th align="center">รหัสยืม</th>
        <th align="center">ชื่อผู้ใช้</th>
        <th align="center">วันที่ยืม</th>
        <th align="center">ถึงวันที่</th>
        <th align="center">ผู้ให้ยืม</th>
        <th align="center">ผู้รับคืน</th>
        <th align="center">หมายเหตุคืน</th>
        <th align="center">สถานะการยืม</th>
        </tr>
        <?php
        $sql='';
        $sqlchk='';
        $sqlchk="select * from tb_equipment where equipment_id='$equipmentid'";
        $resultchk=$db->query($sqlchk);
        $rowchk=$resultchk->fetch_array(MYSQLI_ASSOC);
    if($equipmentid == $rowchk["equipment_id"]){
        if( !empty($startdate) && !empty($enddate) && $equipmentid == $rowchk["equipment_id"] ){//กรณีมีข้อมูลทั้งหมดส่งมา
            $sql="SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) inner join tb_equipment as te  on (tl.equipment_id=te.equipment_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '$startdate' AND '$enddate' AND te.equipment_id='$equipmentid'";
        }
        else if( !empty($startdate) && !empty($enddate) && empty($equipmentid)){//กรณีไม่มีไอดีอุปกรณืส่งมา
            $sql="SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) inner join tb_equipment as te  on (tl.equipment_id=te.equipment_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '$startdate' AND '$enddate'";
        }else if( empty($startdate) && empty($enddate) && !empty($equipmentid)){//กรณีมีไอดีอุปกรณ์ส่งมา
            $sql="SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) inner join tb_equipment as te  on (tl.equipment_id=te.equipment_id) WHERE tl.status_id=4 AND te.equipment_id='$equipmentid'";
        }else{//กรณีไม่มีข้อมูลทั้งหมดส่งมา
            $sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4";
        }
    }else{
        if( !empty($startdate) && !empty($enddate) && !empty($equipmentid)){//กรณีมีข้อมูลทั้งหมดส่งมา
            $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '$startdate' AND '$enddate' AND tl.equipment_text='$equipmentid'";
        }
        else if( !empty($startdate) && !empty($enddate) && empty($equipmentid)){//กรณีไม่มีชื่ออุปกรณืส่งมา
            $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '$startdate' AND '$enddate'";
        }else if( empty($startdate) && empty($enddate) && !empty($equipmentid)){//กรณีชื่อดีอุปกรณ์ส่งมา
            $sql="SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND tl.equipment_text='$equipmentid'";
        }else{//กรณีไม่มีข้อมูลทั้งหมดส่งมา
            $sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4";
        }
    }
        
        $result=$db->query($sql);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
        ?>
        <tr>
            <td><?=$row["servicedetail_id"]?></td>
            <?php
            $sqlmember='';
            $sqlmember="select * from tblemployment where ID='$row[user_id]'";
            $resultmember=$db->query($sqlmember);
            $rowmember=$resultmember->fetch_array(MYSQLI_ASSOC);
            $row["on_date"]=show_tdate($row["on_date"]);
            $row["to_date"]=show_tdate($row["to_date"]);
            ?>
            <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
            <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
            <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
            <td><?=$row["userapprove_id"]?></td>
            <td><?=$row["userrecipient_id"]?></td>
            <td style="mso-number-format:\@;"><?=$row["recipient_note"]?></td>
            <td align="center">คืนอุปกรณ์แล้ว</td>
        </tr>
        <?php
        }
        ?>
        </table>
   
    <?php
/* }else if($equipmentid !=""){ *///กรณีข้อมูลไอดีอุปกรณ์เท่ากับชื่อในฐานข้อมูล
/*     echo $equipmentid;
    echo ("มีชื่อ");exit; */
   /*  if(isset($startdate, $enddate, $equipmentid)){?>
    <table border="1">
        <tr>
        <th align="center">รหัสยืม</th>
        <th align="center">ชื่อผู้ใช้</th>
        <th align="center">วันที่ยืม</th>
        <th align="center">ถึงวันที่</th>
        <th align="center">ผู้ให้ยืม</th>
        <th align="center">ผู้รับคืน</th>
        <th align="center">หมายเหตุคืน</th>
        <th align="center">สถานะการยืม</th>
        </tr>
        <?php
        $sql='';
        if( !empty($startdate) && !empty($enddate) && !empty($equipmentid)){//กรณีมีข้อมูลทั้งหมดส่งมา
            $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '$startdate' AND '$enddate' AND tl.equipment_text='$equipmentid'";
        }
        else if( !empty($startdate) && !empty($enddate) && empty($equipmentid)){//กรณีไม่มีชื่ออุปกรณืส่งมา
            $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND ts.on_date BETWEEN '$startdate' AND '$enddate'";
        }else if( empty($startdate) && empty($enddate) && !empty($equipmentid)){//กรณีมีชื่ออุปกรณ์ส่งมา
            $sql = "SELECT * FROM tb_servicedetails as ts inner join tb_list as tl on (ts.servicedetail_id=tl.servicedetail_id) WHERE tl.status_id=4 AND tl.equipment_text='$equipmentid'";
        }else{//กรณีไม่มีข้อมูลทั้งหมดส่งมา
            $sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4";
        }
        $result=$db->query($sql);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
        
        <tr>
        <td><?=$row["servicedetail_id"]?></td>
        <?php
            $sqlmember='';
            $sqlmember="select * from tblemployment where ID='$row[user_id]'";
            $resultmember=$db->query($sqlmember);
            $rowmember=$resultmember->fetch_array(MYSQLI_ASSOC);
            $row["on_date"]=show_tdate($row["on_date"]);
            $row["to_date"]=show_tdate($row["to_date"]);
        
        <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
        <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
        <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
        <td><?=$row["userapprove_id"]?></td>
        <td><?=$row["userrecipient_id"]?></td>
        <td style="mso-number-format:\@;"><?=$row["recipient_note"]?></td>
        <td align="center">คืนอุปกรณ์แล้ว</td>
        </tr>
        <?php
        }
        
    </table>
    <?php
    } */
/* }else{
    echo $equipmentid;
    echo ("ไม่มี"); */
    /* ?>

    <table border="1">
        <tr>
        <th align="center">รหัสยืม</th>
        <th align="center">ชื่อผู้ใช้</th>
        <th align="center">วันที่ยืม</th>
        <th align="center">ถึงวันที่</th>
        <th align="center">ผู้ให้ยืม</th>
        <th align="center">ผู้รับคืน</th>
        <th align="center">หมายเหตุคืน</th>
        <th align="center">สถานะการยืม</th>
        </tr>
        <?php
        $sql='';
        $sql="SELECT * from tb_servicedetails where tb_servicedetails.status_id=4";
        $result=$db->query($sql);
        while($row=$result->fetch_array(MYSQLI_ASSOC)){
        
        <tr>
        <td><?=$row["servicedetail_id"]?></td>
        <?php
        $sqlmember='';
            $sqlmember="select * from tblemployment where ID='$row[user_id]'";
            $resultmember=$db->query($sqlmember);
            $rowmember=$resultmember->fetch_array(MYSQLI_ASSOC);
            $row["on_date"]=show_tdate($row["on_date"]);
            $row["to_date"]=show_tdate($row["to_date"]);
        
        <td><?=$rowmember["prefixThai"]?> <?=$rowmember["nameThai"]?></td>
        <td><?=$row["on_date"]?> เวลา <?=$row["on_time"]?></td>
        <td><?=$row["to_date"]?> เวลา <?=$row["to_time"]?></td>
        <td><?=$row["userapprove_id"]?></td>
        <td><?=$row["userrecipient_id"]?></td>
        <td style="mso-number-format:\@;"><?=$row["recipient_note"]?></td>
        <td align="center">คืนอุปกรณ์แล้ว</td>
        </tr>
        <?php
        }
        
    </table>
<?php */
/* } */
?>
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