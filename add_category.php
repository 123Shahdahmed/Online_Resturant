<?php
include "conn.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {


    $name   = trim($_POST['name']);

    if (!$name)   $errors[] = "category name is required.";

    if (strlen($name) > 255)   $errors[] = " name is too long.";


    if (empty($errors)) {
        $stmt = $conn->prepare("
            INSERT INTO res_category (c_name)
            VALUES (?)
        ");
        $stmt->bind_param("s", $name);

        if ($stmt->execute()) {
            $success = "category added successfully!";
            header("refresh:1; url=add_category.php");
        } else {
            $errors[] = "Database error: " . $conn->error;
        }
    }
}
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="res_cs.css">

</head>

<body>
    <div class="navv">
        <nav class="navbar" style="background-color:black;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="newOnline_resturant/admin/images/icn.png" alt="Logo" width="100" height="24" class="d-inline-block align-text-top">
                </a>
                <a href="admin.php"><i class="fa-solid fa-arrow-right-from-bracket" style="color:aliceblue; font-size:25px;"></i></a>


            </div>
        </nav>
    </div>
    <div class="main d-flex">

        <div class="d-flex justify-content-between">
            <!-- Sidebar -->
            <nav id="sidebar" class="bg-light border-end vh-100 p-4">
                <h5 class="text-secondary mb-4">Home</h5>
                <ul class="list-unstyled">

                    <li>
                        <a href="dashboard.php" class="d-flex align-items-center mb-3">
                            <i class="fa fa-tachometer me-2"></i> Dashboard
                        </a>
                    </li>

                    <h6 class="text-secondary mt-4">Log</h6>

                    <li>
                        <a href="all_users.php" class="d-flex align-items-center mb-3">
                            <i class="fa fa-user me-2"></i> Users
                        </a>
                    </li>

                    <!-- Restaurant Menu -->
                    <li>
                        <a class="d-flex align-items-center mb-2" data-bs-toggle="collapse" href="#restaurantCollapse" role="button">
                            <i class="fa fa-archive me-2"></i> Restaurant
                        </a>

                        <div class="collapse ps-4" id="restaurantCollapse">
                            <a href="all_resturant.php" class="d-block mb-2">All Restaurant</a>
                            <a href="add_category.php" class="d-block mb-2">Add Category</a>
                            <a href="add_restaurant.php" class="d-block mb-2">Add Restaurant</a>
                        </div>
                    </li>

                    <!-- Menu -->
                    <li>
                        <a class="d-flex align-items-center mb-2" data-bs-toggle="collapse" href="#menuCollapse" role="button">
                            <i class="fa fa-cutlery me-2"></i> Menu
                        </a>

                        <div class="collapse ps-4" id="menuCollapse">
                            <a href="all_menu.php" class="d-block mb-2">All Menues</a>
                            <a href="add_menu.php" class="d-block mb-2">Add Menu</a>
                        </div>
                    </li>

                    <li>
                        <a href="all_orders.php" class="d-flex align-items-center mt-3">
                            <i class="fa fa-shopping-cart me-2"></i> Orders
                        </a>
                    </li>

                </ul>
            </nav>
        </div>
        <div style="width: 85%;">
            <div class="total">
                <div class="Title">Add Restaurant Category

                </div>
                <div style="width: 100%;">
                    <hr>
                    <form class="row g-3" method="POST">
                        <div class="col-md-12">
                            <label for="inputName" class="form-label">Category</label>
                            <input type="text" class="form-control" id="inputName" name="name">
                        </div>

                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Save</button>
                            <a class="btn btn-dark" href="add_category.php">Cancel</a>
                        </div>
                    </form>
                </div>

            </div>
            <div class="total mt-4" style="overflow-x: auto; width: 100%; ">
                <h5 style="color:darkgrey;">Listed Categories

                </h5>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category Name</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "conn.php";
                        $result = $conn->query("SELECT * FROM  res_category  order by c_id desc;");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr><td>" . $row["c_id"] .  "</td>";
                                echo "<td>" . $row["c_name"] . "</td>";
                                echo "<td>" . $row["created_at"] . "</td>";
                                echo "<td>
                             <div class='btns'>
                             <a  class='btn btn-primary '  href='edit_category.php?id={$row['c_id']}'><i class='fa-solid fa-pen' style='font-size:14px;'></i></a>
                            <a class='btn btn-danger' href='delete_category.php?delete={$row['c_id']}' onclick=\"return confirm('Are you sure?');\"><i class='fa-solid fa-trash' style='font-size:16px;'></i></a>
                            </div></td></tr>";
                            }
                        } else {

                            echo "<tr><td colspan='3' class='text-center text-danger fw-bold'>No Category Found</td></tr>";
                        }

                        ?>

                    </tbody>



                </table>

            </div>

        </div>



    </div>


</body>

</html>