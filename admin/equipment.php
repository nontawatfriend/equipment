<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>equipment</title>
<!--<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.1/js/bootstrap.min.js"></script>-->
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>-->
<link rel="stylesheet" href="css/img.css">
<link rel="stylesheet" href="css/jquery.fancybox.min.css" media="screen">
<!-- <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen"> -->
<!-- <link rel="stylesheet" href="css/jquery.fancybox.min.css" media="screen"> -->
<script src="js/jquery.fancybox.min.js"></script>
</head>


<!--ดูภาพอุปกรณ์-->
<style>
	.gallery
{
    display: inline-block;
    margin-top: 20px;
}
</style>
<body>
<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-left"></i> ย้อนกลับ</th></a>
<div class="row" style="margin: 20px; margin-top: 0px;">
    <h3 align="center"><i class="fa fa-briefcase" style="font-size:20px"></i> จัดการอุปกรณ์</h3>
    <hr>
    	<div class="well well-sm">
           <div class="text-right">
                <a class="" href="#reviews-anchor" id="open-review-box"><i class="fa fa-plus"></i> เพิ่มอุปกรณ์</a>
           </div>

        <div class="row" id="post-review-box" style="display:none;">
			<div class="col-md-4"></div>
                <div class="col-md-4">
                    <form accept-charset="UTF-8" action="?page=equipment_add" method="post" enctype="multipart/form-data">
						<label>ชื่ออุปกรณ์ :</label>
                        <input class="form-control animated" cols="255" name="equipment_name" rows="3" required="required"><br>
						<label>จำนวน :</label>
						<input type="number" class="form-control animated" cols="25" name="equipment_number" min="1" rows="3" required="required"><br>
						<label>หมายเลขครุภัณฑ์ :</label>
                        <input class="form-control animated" cols="255" name="dur_id" placeholder="หมายเลขครุภัณฑ์" rows="3" required="required"><br>
           				<label>รายละเอียดอุปกรณ์ :</label>
						<textarea class="form-control" name="equipment_detail" required="required"></textarea>
						<label>สถานะ</label>
	<select class="form-control"  name="status_id" >
	<?php
    $sql="select * from tb_status";
	$result=$db->query($sql);
	while($row=$result->fetch_array(MYSQLI_ASSOC)){
	?>

    <option value="<?=$row['status_id']?>"><?=$row['status_name']?></option>
	<?php
	}
	?>
	<input type="hidden" name="<?=$row['status_id']?>" value="<?=$row['status_id']?>" />
	</select><br>

			<div class="input-group image-preview">
                <input type="text" class="form-control image-preview-filename" disabled="disabled"> <!-- don't give a name === doesn't send on POST/GET -->
                <span class="input-group-btn">
                    <!-- image-preview-clear button -->
                    <button type="button" class="btn btn-default image-preview-clear" style="display:none;">
                        <span class="glyphicon glyphicon-remove"></span> Clear
                    </button>
                    <!-- image-preview-input -->
					
                    <div class="btn btn-default image-preview-input">
                        <span class="glyphicon glyphicon-folder-open"></span>
                        <span class="image-preview-input-title">เลือกรูปภาพ</span>
                        <input name="equipment_img" id="equipment_img" type="file" > <!-- rename it -->
                    </div>
                </span>
            </div><!-- /input-group image-preview [TO HERE]-->
						<div class="text-center"><br>
                            <a class="btn btn-danger" href="#" id="close-review-box" style="display:none; margin-right: 10px;">
                            <span class="glyphicon glyphicon-remove"></span> ยกเลิก</a>
                            <button class="btn btn-success" type="submit">เพิ่มอุปกรณ์</button>
                        </div>
					</div>
                 </form>

            </div>
        </div>
<div class="table-responsive">
<table class="Datatable table table-hover table-bordered" id="example">
<thead bgcolor="#A47A47">
 <tr>
 <th style="width: 10%;">รหัสอุปกรณ์</th>
 <th style="width: 10%;">รูปภาพอุปกรณ์</th>
 <th style="width: 15%;">ชื่ออุปกรณ์</th>
 <th style="width: 20%;">รายละเอียดอุปกรณ์</th>
 <th style="width: 10%;">จำนวนอุปกรณ์ทั้งหมด</th>
 <th style="width: 10%;">จำนวนอุปกรณ์คงเหลือ</th>
 <th style="width: 10%;">สถานะของอุปกรณ์</th>
 <th>แก้ไข / ลบ</th>
 </tr>
</thead>
<tbody>
<?php
$sql="select * from tb_equipment inner join tb_status where tb_equipment.status_id=tb_status.status_id";
$result=$db->query($sql);
while($row=$result->fetch_array(MYSQLI_BOTH)){
?>
 <tr>
 <td><h5><?=$row["equipment_id"]?></h5></td>
 <td><!--<img src="equipment_img/<?=$row["equipment_photo"]?>" class="img-thumbnail" height="75"width="75">-->
<a class="fancybox img-thumbnail" title="<?=$row['equipment_name'];?>" rel="ligthbox" href="equipment_img/<?=$row["equipment_photo"]?>">
	<img class="img-responsive" alt="<?=$row['equipment_name'];?><?=$row['dur_id'];?>" src="equipment_img/<?=$row["equipment_photo"]?>" height="75"width="75" />
<!--	<div class='text-right'>
		<small class='text-muted'><?=$row["equipment_photo"]?></small>
	</div>--> <!-- text-right / end -->
</a>
 </td>
 <td><h5><?=$row["equipment_name"]?><br>(<?=$row["dur_id"]?>)</h5></td>
 <td><h5><?=$row["equipment_detail"]?></h5></td>
 <td><h5><?=$row["equipment_number"]?></h5></td>
 <td><h5><?=$row["equipment_balance"]?></h5></td>
 <?php
if($row["status_id"] == "1"){
echo "<td><h5><span style='color:green'>ปกติ</span></h5></td>";
}else if($row["status_id"] == "2"){
echo "<td><h5><span style='color:red'>ใช้งานไม่ได้</span></h5></td>";
}else{
echo "<td><h5><span style='color:red'>ข้อมูลไม่แน่ชัด</span></h5></td>";
}
?> 
 <td><h4>
	 <a href="?page=equipment_edit&equipment_id=<?=$row["equipment_id"];?>"><span class="btn btn-warning">แก้ไข</span></a>&nbsp;&nbsp;
	 <!-- <a href="?page=equipment_delete&equipment_id=<?=$row["equipment_id"];?>" onclick="return confirm('คุณแน่ใจจะลบใช่หรือไม่')"><span class="btn btn-danger">ลบ</span></a> -->
     <input type="button" class="btn btn-danger delete_data" value="ลบอุปกรณ์" name="delete" id="<?=$row["equipment_id"];?>"></input>
	 </h4>
 </td>
<?php } ?>
 </tr>

</tbody>
</table>
</div>
</div>
	<script src="js/add_equipment.js"></script>
</body>
</html>
<script>
	$(document).ready(function(){
    //FANCYBOX เลื่อนรูป
    //https://github.com/fancyapps/fancyBox
    $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
});
</script>
<script>
	$(document).ready(function() {
    //กำหนดให้  Plug-in dataTable ทำงาน ใน ตาราง Html ที่มี id เท่ากับ example
		$('#example').DataTable( {
			
			"lengthMenu": [[25, 50, 100, -1], [25, 50, 100, "All"]]
		} );
	} );

$('#equipment_img').change( function () {
  var fileExtension = ['jpg','png'];
  if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
     alert("กรุณาอัพโหลดไฟล์ให้ถูกต้อง JPG, PNG, files.");
     this.value = '';
     return false;
  }
});
</script>
<script>
$('.delete_data').click(function(){
	var uid=$(this).attr("id");
	var status=confirm("ยันยืนการลบ"); 
	if(status){
	$.ajax({ 
		url:"equipment_delete.php",
		method:"POST",
		data: {equipment_id:uid},
		success:function(data){
			location.reload();
		}
	});
	}
});
</script>