<?php 
session_start();
$db_server="localhost";
$db_user="root";
$db_pass="";
$db_src="equipment";
$db=new mysqli($db_server,$db_user,$db_pass,$db_src);
if($db->connect_errno){
	echo "ไม่สามารถติดต่อ MySQL ได้: ".$db->connect_error;
}
$db->query("set names utf8");

$_SESSION["EMPID"]="015B97FE-47FD-45B1-97DB-6C3A3F894781";
//$_SESSION["USER_TYPE"]="1";

if($_SESSION["EMPID"]){
	$sql="select * from tblemployment where ID='".$_SESSION["EMPID"]."'";
	$result=$db->query($sql);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	echo $_SESSION["EMPID"];
	echo '<br>';
	echo $_SESSION["EMPPREFIX"]=$row["prefixThai"];
	echo ' ';
	echo $_SESSION["EMPNAME"]=$row["nameThai"];
	echo "<meta http-equiv='refresh' content='1;url=/equipment/index.php' />";
}else{
	$sql="select * from tb_admin where admin_id='".$_SESSION["USER_TYPE"]."'";
	$result=$db->query($sql);
	$row=$result->fetch_array(MYSQLI_ASSOC);
	echo $_SESSION["USER_TYPE"];
	echo '<br>';
	echo $_SESSION["USERNAME"]=$row["admin_name"];
	echo "<meta http-equiv='refresh' content='1;url=/equipment/admin/index.php' />";
}

//$_SESSION["USER_TYPE"]="ADMIN";

/*if($_SESSION["EMPID"]){
	echo "<meta http-equiv='refresh' content='1;url=/equipment/index.php' />";
}else{
	echo "<meta http-equiv='refresh' content='1;url=/equipment/admin/index.php' />";
}*/


?>