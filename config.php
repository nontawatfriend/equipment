<?php
session_start();
if(!isset($_SESSION["EMPID"]) || $_SESSION["EMPID"]==""){
	echo'<meta http-equiv="refresh" content="0;url=login.php">';
	exit(0);
}
$db_server="localhost";
$db_user="root";
$db_pass="";
$db_src="equipment";
$db=new mysqli($db_server,$db_user,$db_pass,$db_src);
if($db->connect_errno){
echo "ไม่สามารถติดต่อ MySQL ได้: ".$db->connect_error;
}
$db->query("set names utf8");
?>
