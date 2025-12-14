<?php
include("conn.php");
mysqli_query($conn, "DELETE FROM users WHERE u_id = '" . $_GET['user_del'] . "'");
header("location:all_users.php");
