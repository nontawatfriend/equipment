<?php include("config.php"); ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>admin</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ระบบการขอใช้งานโสตทัศนูปกรณ์ คณะวิทยาศาสตร์ มหาวิทยาลัยเชียงใหม่">
<meta name="keywords" content="ระบบยืมคืนอุปกรณ์,คณะวิทยาศาสตร์,มหาวิทยาลัยเชียงใหม่,ระบบยืมคืนคณะวิทยาศาสตร์ มช,ระบบยืมคืนอุปกรณ์คณะวิทยาศาสตร์ มช,ระบบยืมคืนอุปกรณ์คณะวิทยาศาสตร์,ระบบการขอใช้งานโสตทัศนูปกรณ์คณะวิทยาศาสตร์เชียงใหม่,ระบบการขอใช้งานโสตทัศนูปกรณ์ มช,ขอใช้งานโสตทัศนูปกรณ์ มช,งานโสตทัศนูปกรณ์ มช">
<meta name="author" content="ระบบการขอใช้งานโสตทัศนูปกรณ์คณะวิทยาศาสตร์เชียงใหม่">
<link rel="icon" href="img/Faculty_of_Science.png">
<!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">-->
<!-- <link href="css/bootstrap-theme.css" rel="stylesheet"> --><!--ทีมปุ่ม-->
<link href="css/bootstrap3.3.6.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<!--<script src="js/bootstrap.min.js"></script>-->
<!--<script src="//code.jquery.com/jquery-1.11.1.min.js"></script> Datatable Search -->
<script src="js/jquery-1.11.1.min.js"></script>
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --><!--icon i fa fa w3school-->
<link href="fonts/Kamit.css" rel="stylesheet">
<!--<link href="fonts/Maitree.css" rel="stylesheet">
<link href="fonts/Sarabun.css" rel="stylesheet">-->
<!-- Datatable -->
<!-- <link rel="stylesheet" href="css/datatable.css"/> -->
<link rel="stylesheet" href="css/dataTables.main.css"/>
<script src="js/sweetalert2@8.js"></script><!--ป๊อบอัพสถานะ--> 
</head>
<style>
 header {
       font-family: 'Kanit', sans-serif;
      }
	body,a {
		font-family: 'Kanit', sans-serif;
		font-size: 16px;
      }
	th{
  		text-align: center;
		font-size: 16px;
	}
	td {
  		text-align: center;
		font-size: 15px;
	}
	tbody{
		background-color:#FDFDFD;
	}
	hr{
		border: 0;
		height: 1px;
		background-image: linear-gradient(to right, rgba(0, 0, 0, 0), rgba(1, 1, 1, 0.08), rgba(0, 0, 0, 0));
	}
	.bgtable{
		border-radius: 10px;
		background-color: #f5f5f5;
		padding: 3px;
	} 
/*			body {
			background: url("../img/macos-catalina.jpg");
			background-color: transparent; 
			padding-top: 40px;
			padding-bottom: 40px;
		}*/
</style>
	
<body style="margin: 20px; margin-top: 0px;">
		<div class="row">
		  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		  	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 well lead">
				<div class="col-md-3"></div>
				<div class="col-md-6">
					  <p align="center">&#128373; ยินดีต้อนรับผู้ดูแลระบบ คุณ : 
						  <?php
						  if($_SESSION){
							 echo "$_SESSION[USERNAME]";
							}else{
							 echo "คุณยังไม่ได้เข้าสู่ระบบ";
							}
							?>
					  </p>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3" align="right">
					<a href="logout.php" style="font-size:16px" title="ออกจากระบบ" onclick="return confirm('คุณต้องการออกจากระบบ');"><button  class="btn btn btn-danger"><i class="glyphicon glyphicon-log-out"></i> ออกจากระบบ</button></a></div>
			 </div>
			   <!-- <div class="well" align="center">-->
					<div align="center">
						<h1><span class="current-theme"></span></h1>
						
						<?php
						$sql="select * from tb_servicedetails where status_id='1'";
						$result=$db->query($sql);
						$row=$result->fetch_array(MYSQLI_BOTH);
						$num=$result->num_rows;
						?>
						<!-- onclick="window.location='test.php'" -->
						<a href="index.php" title="หน้าแรก"><button type="button" title="หน้าแรก" onclick="window.location='index.php'" class="btn btn-lg btn-default">หน้าแรก <!-- <span class="sub_icon glyphicon glyphicon-home"></span> -->&#127969; </button></a> :: 
						<a href="?page=pending_admin" title="รออนุมัติ"><button type="button" class="btn btn btn-warning"><i class="fa fa-history fa-1x"></i> รออนุมัติ <span class="badge"><?=$num?></span></button></a> ||
						<?php
						$sql="select * from tb_servicedetails where status_id='3'";
						$result=$db->query($sql);
						$row=$result->fetch_array(MYSQLI_BOTH);
						$num=$result->num_rows;
						?>
						<a href="?page=return_admin" title="อยู่ระหว่างยืม"><button type="button" class="btn btn btn-info"><i class="fa fa-refresh  fa-1x"></i> อยู่ระหว่างยืม <span class="badge"><?=$num?></span></button></a> ||
						<?php
						$sql="select * from tb_servicedetails where status_id='4'";
						$result=$db->query($sql);
						$row=$result->fetch_array(MYSQLI_BOTH);
						$num=$result->num_rows;
						?>
						<a href="?page=history_admin" title="ประวัติทำรายการ"><button type="button" class="btn btn btn-success"><i class="fa fa-list fa-1x"></i> ประวัติทำรายการ <span class="badge"><?=$num?></span></button></a> ||
						<?php
						$sql="select * from tb_servicedetails where status_id='2'";
						$result=$db->query($sql);
						$row=$result->fetch_array(MYSQLI_BOTH);
						$num=$result->num_rows;
						?>
						<a href="?page=notapproved_admin" title="รายการไม่อนุมัติ"><button type="button" class="btn btn btn-danger"><i class="fa fa-times  fa-1x"></i> ไม่อนุมัติ <span class="badge"><?=$num?></span></button></a> ||
						<?php
						$sql="select * from tblemployment";
						$result=$db->query($sql);
						$row=$result->fetch_array(MYSQLI_BOTH);
						$num=$result->num_rows;
						?>
						<a href="?page=member" title="สมาชิก"><button type="button" class="btn btn btn-primary"><i class="fa fa-users fa-1x"></i> สมาชิก <span class="badge"><?=$num?></span></button></a> ||
						<?php
						$sql="select * from tb_equipment";
						$result=$db->query($sql);
						$row=$result->fetch_array(MYSQLI_BOTH);
						$num=$result->num_rows;
						?>
						<a href="?page=equipment" title="จัดการวัสดุ/ครุภัณฑ์"><button type="button" class="btn btn-inverse">จัดการวัสดุ/ครุภัณฑ์ <span class="badge"><?=$num?></span></button></a>
						
					</div>
		<?php
		if(@$_GET['fd'])
		$file=$_GET['fd']."/".$_GET['page'].".php";
		else
		$file=@$_GET['page'].".php";
		if(is_file($file)){
		require_once("$file");
		}
		else{
		require_once("main.php");
		}
		?>
		</div>
	  </div>
<!--  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
<script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <!-- Buttons extension 
  <script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script>-->
  <!-- Export to Excel -->
  <script src="js/datatable.js"></script>
</body>
</html> 
