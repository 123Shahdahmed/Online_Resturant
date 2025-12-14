<?php
include("conn.php");
mysqli_query($conn,"DELETE FROM users_orders WHERE o_id = '".$_GET['user_del']."'");
header("location:all_orders.php");  

?>