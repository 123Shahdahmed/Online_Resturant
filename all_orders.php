<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="order.css">
</head>

<body>

    <!-- Navbar -->
    <div class="navv">
        <nav class="navbar" style="background-color:black;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="newOnline_resturant/admin/images/icn.png" alt="Logo" width="100" height="24">
                </a>
                <a href="admin.php">
                    <i class="fa-solid fa-arrow-right-from-bracket" style="color:aliceblue; font-size:25px;"></i>
                </a>
            </div>
        </nav>
    </div>

    <!-- Main Layout -->
    <div class="d-flex">

        <!-- Sidebar -->
        <nav id="sidebar" class="bg-light border-end vh-100 p-4" style="width:240px;">
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

                <li>
                    <a class="d-flex align-items-center mb-2" data-bs-toggle="collapse" href="#restaurantCollapse">
                        <i class="fa fa-archive me-2"></i> Restaurant
                    </a>
                    <div class="collapse ps-4" id="restaurantCollapse">
                        <a href="all_resturant.php" class="d-block mb-2">All Restaurant</a>
                        <a href="add_category.php" class="d-block mb-2">Add Category</a>
                        <a href="add_restaurant.php" class="d-block mb-2">Add Restaurant</a>
                    </div>
                </li>

                <li>
                    <a class="d-flex align-items-center mb-2" data-bs-toggle="collapse" href="#menuCollapse">
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

        <div class="containar">
            <div class="page-title">
                <h2>All Orders</h2>
            </div>

            <div class="my-box">

                <table class="my-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Title</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th>Reg-Date</th>
                            <th>Action</th>

                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include("conn.php");
                        $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id";
                        $query = mysqli_query($conn, $sql);

                        if (!mysqli_num_rows($query) > 0) {
                            echo '<tr><td colspan="8"><center>No Order</center></td></tr>';
                        } else {
                            while ($rows = mysqli_fetch_array($query)) {
                        ?>
                                <?php
                                echo '
                            <tr>
                                     <td>' . $rows['username'] . '</td>
							         <td>' . $rows['title'] . '</td>
									<td>' . $rows['quantity'] . '</td>
									<td>' . $rows['price'] . '</td>
									<td>' . $rows['address'] . '</td>';
                                ?>
                                <?php
                                $status = $rows['status'];

                                if ($status == "" || $status == "NULL") {
                                ?>
                                    <td>
                                        <button type="button" class="btn btn-info">
                                            <span class="fa fa-bars" aria-hidden="true"></span>
                                            Dispatch
                                        </button>
                                    </td>
                                <?php
                                }

                                if ($status == "in process") {
                                ?>
                                    <td>
                                        <button type="button" class="btn btn-warning">
                                            <span class="fa fa-cog fa-spin" aria-hidden="true"></span>
                                            On The Way!
                                        </button>
                                    </td>
                                <?php
                                }

                                if ($status == "closed") {
                                ?>
                                    <td>
                                        <button type="button" class="btn btn-primary">
                                            <span class="fa fa-check-circle" aria-hidden="true"></span>
                                            Delivered
                                        </button>
                                    </td>
                                <?php
                                }

                                if ($status == "rejected") {
                                ?>
                                    <td>
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-close"></i>
                                            Cancelled
                                        </button>
                                    </td>
                                <?php
                                }

                                echo '<td>' . $rows["created_at"] . '</td>';
                                ?>


                                <td class="actions">

                                    <a class="delete" href="delete_order.php?user_del=<?php echo $rows['o_id']; ?>">
                                        <i class="fa-solid fa-trash" style="font-size:16px;"></i>
                                    </a>

                                    <a class="edit" href="view_order.php?user_upd=<?php echo $rows['o_id']; ?>">
                                        <i class="fa-solid fa-pen" style="font-size:16px;"></i>
                                    </a>

                                </td>

                                </tr>
                        <?php
                            }
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</body>

</html>