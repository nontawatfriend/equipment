<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>member</title>
</head>
<body>
<a href=javascript:history.back(1) class="btn btn-danger"><i class="fa fa-arrow-left"></i> ย้อนกลับ</th></a>
<hr>
<h3 align="center"><!-- <i class="fa fa-users" style="font-size:20px"></i> -->&#128101; ข้อมูลสมาชิก</h3>
<hr>
<div class="table-responsive">
<table class="datatable table table-hover table-bordered">
	<thead>
		<tr>			
			<th>ชื่อ-นาสกุล</th>
			<th>E-Mail</th>
		</tr>
	</thead>
	<tbody>			
			<?php
			$sql="select * from tblemployment";
			$result=$db->query($sql);
			while($row=$result->fetch_array(MYSQLI_BOTH)){
			?>
		<tr>
			<td><a href="?page=history_member&ID=<?=$row["ID"];?>" title="ดูรายละเอียด" name="ID" value="<?=$_GET["ID"];?>"><?=$row["prefixThai"]?>&nbsp;<?=$row["nameThai"]?></a></td>
			<!-- <td><?=$row["prefixThai"]?>&nbsp;<?=$row["nameThai"]?></td> -->
			<td><?=$row["email"]?></td>
			<?php } ?>
		</tr>
	</tbody>
</table>
</div>
</body>
</html>