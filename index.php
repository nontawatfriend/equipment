<?php include("config.php"); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ระบบการขอใช้งานโสตทัศนูปกรณ์ออนไลน์ คณะวิทยาศาสตร์ มหาวิทยาลัยเชียงใหม่ </title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="ระบบการขอใช้งานโสตทัศนูปกรณ์ คณะวิทยาศาสตร์ มหาวิทยาลัยเชียงใหม่">
<meta name="keywords" content="ระบบยืมคืนอุปกรณ์,คณะวิทยาศาสตร์,มหาวิทยาลัยเชียงใหม่,ระบบยืมคืนคณะวิทยาศาสตร์ มช,ระบบยืมคืนอุปกรณ์คณะวิทยาศาสตร์ มช,ระบบยืมคืนอุปกรณ์คณะวิทยาศาสตร์,ระบบการขอใช้งานโสตทัศนูปกรณ์คณะวิทยาศาสตร์เชียงใหม่,ระบบการขอใช้งานโสตทัศนูปกรณ์ มช,ขอใช้งานโสตทัศนูปกรณ์ มช,งานโสตทัศนูปกรณ์ มช">
<meta name="author" content="ระบบการขอใช้งานโสตทัศนูปกรณ์คณะวิทยาศาสตร์เชียงใหม่">
<link rel="icon" href="img/Faculty_of_Science.png">
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<link rel="stylesheet" href="css/bootstrap.min.css">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"> -->
<link href="fonts/Kamit.css" rel="stylesheet">
<!--<link href="fonts/Maitree.css" rel="stylesheet">
<link href="fonts/Sarabun.css" rel="stylesheet">-->
<link href="css/font-awesome.min.css" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> --><!--icon-->
<!-- Datatable -->
<link rel="stylesheet" href="css/dataTables.main.css"/>
<script src="js/jquery2.2.min.js"></script><!--add textbox -->
<script src="js/sweetalert2@8.js"></script><!--ป๊อบอัพสถานะ--> 
<link rel="stylesheet" href="css/style.css"/>
</head>
<style>
/*body {
  background-color: #f1f1f1;
}*/
body{
	background: url("img/bg.jpg");
	background-color: transparent; 
	/*padding-top: 20px;*/
	padding-bottom: 20px;
}
.navbar-default {
    background-color: #fafafa;
    border-color: #e7e7e7;
}
.navbar-default .navbar-nav>li>a {
    color: #000;
}
</style>
<body>
<header>
<nav class="navbar navbar-default navbar">
<div class="container_img">
  <img class="img" src="img/bannerbg.jpg" alt="Cinque Terre" width="1000" height="300">
</div>
  <div class="container-fluid ">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
		  <a class="navbar-brand " href="index.php" title="หน้าหลัก"><strong><font color="#9c76b3">หน้าหลัก</font></strong></a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
		  <li><a href="index.php" title="หน้าหลัก"><!-- <i class="fa fa-home" style="font-size:21px"></i> -->&#127969;</a></li>
	<!--<li><a href="?page=borrow" title="รายการยืม" class="nav-link">บริการยืมอุปกรณ์</a></li>-->
	<li><a href="" title="ขอใช้บริการ/ติดตั้งอุปกรณ์" class="nav-link" data-toggle="dropdown">ขอใช้บริการ/ติดตั้งอุปกรณ์ <i class="fa fa-caret-down"></i></a>

  		<ul class="dropdown-menu">
    		<li><a href="?page=borrow">ขอใช้บริการ</a></li>
				<?php
				$sql="select sd.* from tb_servicedetails sd inner join tblemployment em on sd.user_id=em.ID where sd.status_id='1' and em.ID='$_SESSION[EMPID]'";
				$result=$db->query($sql);
				$row=$result->fetch_array(MYSQLI_BOTH);
				$num=$result->num_rows;
				?>
    		<li><a href="?page=pending">รออนุมัติ <span class="badge" ><?=$num?></span></a></li>
				<?php
				$sql="select sd.* from tb_servicedetails sd inner join tblemployment em on sd.user_id=em.ID where sd.status_id='3' and em.ID='$_SESSION[EMPID]'";
				$result=$db->query($sql);
				$row=$result->fetch_array(MYSQLI_BOTH);
				$num=$result->num_rows;
				?>
    		<li><a href="?page=return">อยู่ระหว่างยืม <span class="badge"><?=$num?></span></a></li>
				<?php
				$sql="select sd.* from tb_servicedetails sd inner join tblemployment em on sd.user_id=em.ID where sd.status_id='4' and em.ID='$_SESSION[EMPID]'";
				$result=$db->query($sql);
				$row=$result->fetch_array(MYSQLI_BOTH);
				$num=$result->num_rows;
				?>
    		<li><a href="?page=history">ประวัติทำรายการ <span class="badge"><?=$num?></span></a></li>
  		</ul>
	</li>
	<!--<li><a href="?page=borrow" title="แจ้งซ่อม" class="nav-link">แจ้งซ่อม</a></li>  -->
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="" data-toggle="dropdown"><!-- <span class="fa fa-user"></span> -->&#128101; สวัสดีคุณ 
				<?php
				if($_SESSION){
				 echo "$_SESSION[EMPNAME]";
				}else{
				 /*echo "คุณยังไม่ได้เข้าสู่ระบบ";*/
				}
				?>
			</a>
			<ul class="dropdown-menu">
    <!--<li><a href="?page=schedule"><i class="fa fa-cog"></i> แก้ไขข้อมูล</a></li>-->
    <li><a href="logout.php"><i class="fa fa-sign-out"></i> ออกจากระบบ</a></li>
  </ul></li>
       <!-- <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> เข้าสู่ระบบ</a></li>-->
      </ul>
    </div>
  </div>		
<!-- </div>
</div> -->
</nav>
<br>
<br>
</header>
	<div style="margin: 50px; margin-top: 0px;">
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
	<footer class="panel-footer" role="contentinfo">
      <div class="container">
      <div class="text-center">
		  <span class="foot-title">คณะวิทยาศาสตร์ มหาวิทยาลัยเชียงใหม่</span> <br>
            239 ถนนห้วยแก้ว ตำบลสุเทพ 
            อำเภอเมือง จังหวัดเชียงใหม่ 50200 <br>
            โทรศัพท์ : 053-222180 <br>
            แฟกซ์ : 053-222268, 053-892274<br>
            Copyright ©2020
      </div> <!-- /.row -->
		</div> <!-- /.container -->
    </footer>
  <!--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
  <script src="js/jquery.dataTables.min.js"></script>
  <script src="js/dataTables.bootstrap.min.js"></script>
  <!-- Buttons extension -->
<!--   <script src="//cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.bootstrap.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="//cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js"></script> -->
  <!-- Export to Excel -->
  <script src="js/datatable.js"></script>
</body>
</html>