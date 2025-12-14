<?php
include("conn.php");

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    $conn->query("DELETE FROM res_category WHERE c_id = $id");
    header("Location: add_category.php");
    exit;
}
