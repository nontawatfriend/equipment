<?php
session_start();
session_destroy();
header("Location:/equipment/index.php ");
//echo"<script>alert('ออกจากระบบเรียบร้อยแล้ว ขอบคุณครับ...');window.location='/equipment/index.php';</script>";
?>
