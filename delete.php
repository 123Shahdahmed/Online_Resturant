<?php
include("conn.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM dishes WHERE d_id = $id");
    header("Location: all_menu.php");
    exit;
}
