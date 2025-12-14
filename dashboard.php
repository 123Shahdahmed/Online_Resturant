<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="dash_cs.css">
</head>

<body>
    <div class="main">
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

            <div class="card p-2 mt-2" style="width: 90%">
                <div class="card-body">
                    <div class="row g-3"> <!-- g-3 يضيف مسافة بين الأعمدة -->
                        <div class="col-md-3">
                            <div class="card h-100"> <!-- h-100 يجعلها تمتد على ارتفاع متساوي -->
                                <div class="card-body row">
                                    <div class="col-4"><i class="fa-solid fa-house"></i></div>
                                    <div class="col-8" style="text-align:end;"><?php
                                                                                include("conn.php");

                                                                                $sql = "SELECT rs_id from restaurant;";
                                                                                $result = mysqli_query($conn, $sql);

                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    echo "<h2> $result->num_rows</h2><h5>Restaurant</h5>";
                                                                                } else {
                                                                                    echo "<h2> 0</h2><h5>Restaurant</h5>";
                                                                                }

                                                                                mysqli_close($conn);



                                                                                ?>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-4"><i class="fa fa-cutlery "></i></div>
                                    <div class="col-8" style="text-align:end"><?php
                                                                                include("conn.php");

                                                                                $sql = "SELECT d_id from dishes;";
                                                                                $result = mysqli_query($conn, $sql);

                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    echo "<h2> $result->num_rows</h2><h5>Dishes</h5>";
                                                                                } else {
                                                                                    echo "<h2> 0</h2><h5>Dishes</h5>";
                                                                                }

                                                                                mysqli_close($conn);



                                                                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-4"> <i class="fa fa-users f-s-40"></i></div>
                                    <div class="col-8" style="text-align:end">
                                        <?php
                                        include("conn.php");

                                        $sql = "SELECT u_id from users;";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            echo "<h2> $result->num_rows</h2><h5>Users</h5>";
                                        } else {
                                            echo "<h2> 0</h2><h5>Users</h5>";
                                        }

                                        mysqli_close($conn);



                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-4"> <i class="fa fa-shopping-cart"></i></div>
                                    <div class="col-8" style="text-align:end">
                                        <?php
                                        include("conn.php");

                                        $sql = "SELECT o_id from users_orders;";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            echo "<h2> $result->num_rows</h2><h5>total Orders</h5>";
                                        } else {
                                            echo "<h2> 0</h2><h5>Total Orders</h5>";
                                        }

                                        mysqli_close($conn);



                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row g-3 mt-3"> <!-- g-3 يضيف مسافة بين الأعمدة -->
                        <div class="col-md-3">
                            <div class="card h-100"> <!-- h-100 يجعلها تمتد على ارتفاع متساوي -->
                                <div class="card-body row">
                                    <div class="col-4"><i class="fa fa-th-large "></i></div>
                                    <div class="col-8" style="text-align:end"><?php
                                                                                include("conn.php");

                                                                                $sql = "SELECT c_id from res_category;";
                                                                                $result = mysqli_query($conn, $sql);

                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    echo "<h2> $result->num_rows</h2><h5>Restro Categories</h5>";
                                                                                } else {
                                                                                    echo "<h2> 0</h2><h5>Restro Categories</h5>";
                                                                                }

                                                                                mysqli_close($conn);



                                                                                ?>


                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-4"><i class="fa fa-spinner f-s-40"></i></div>
                                    <div class="col-8" style="text-align:end"><?php
                                                                                include("conn.php");

                                                                                $sql = "SELECT u_id FROM `users_orders` WHERE status like 'in process';";
                                                                                $result = mysqli_query($conn, $sql);

                                                                                if (mysqli_num_rows($result) > 0) {
                                                                                    echo "<h2> $result->num_rows</h2><h5>Processing Orders</h5>";
                                                                                } else {
                                                                                    echo "<h2> 0</h2><h5>Processing Orders</h5>";
                                                                                }

                                                                                mysqli_close($conn);



                                                                                ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-4"> <i class="fa fa-check f-s-40"></i></div>
                                    <div class="col-8" style="text-align:end">
                                        <?php
                                        include("conn.php");

                                        $sql = "SELECT u_id FROM `users_orders` WHERE status like 'closed';";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            echo "<h2> $result->num_rows</h2><h5>Deliverd Orders</h5>";
                                        } else {
                                            echo "<h2> 0</h2><h5>Deliverd Orders</h5>";
                                        }

                                        mysqli_close($conn);



                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card h-100">
                                <div class="card-body row">
                                    <div class="col-4"> <i class="fa fa-times f-s-40" aria-hidden="true"></i></div>
                                    <div class="col-8" style="text-align:end">
                                        <?php
                                        include("conn.php");

                                        $sql = "SELECT u_id FROM `users_orders` WHERE status like 'rejected';";
                                        $result = mysqli_query($conn, $sql);

                                        if (mysqli_num_rows($result) > 0) {
                                            echo "<h2> $result->num_rows</h2><h5>Cancelled Orders</h5>";
                                        } else {
                                            echo "<h2> 0</h2><h5>Total Orders</h5>";
                                        }

                                        mysqli_close($conn);



                                        ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row g-3 mt-3"> <!-- g-3 يضيف مسافة بين الأعمدة -->
                        <div class="col-md-3">
                            <div class="card h-100"> <!-- h-100 يجعلها تمتد على ارتفاع متساوي -->
                                <div class="card-body row">
                                    <div class="col-4"><i class="fa fa-usd f-s-40" aria-hidden="true"></i></div>
                                    <div class="col-8" style="text-align:end"><?php
                                                                                include("conn.php");

                                                                                $sql = "SELECT SUM(price * quantity) AS value_sum FROM users_orders WHERE status = 'closed'";
                                                                                $result = mysqli_query($conn, $sql);

                                                                                $row = mysqli_fetch_assoc($result);

                                                                                $value = $row['value_sum'] ?? 0;

                                                                                echo "<h2>$value</h2><h5>Total Earnings</h5>";
                                                                                mysqli_close($conn);



                                                                                ?>


                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>

    </div>

</body>

</html>