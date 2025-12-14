<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href=" view_order.css">
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
                        <a href="all_restaurant.php" class="d-block mb-2">All Restaurant</a>
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
                <h2>View Order</h2>
            </div>
            <div class="my-box">

                <table class="my-table">

                    <tbody>
                        <?php
                        include("conn.php");
                        $sql = "SELECT users.*, users_orders.* 
                           FROM users 
                             INNER JOIN users_orders ON users.u_id = users_orders.u_id 
                         where    o_id='" . $_GET['user_upd'] . "'";
                        $query = mysqli_query($conn, $sql);


                        $rows = mysqli_fetch_array($query)
                        ?>

                        <tr>
                            <td><strong>Username:</strong></td>
                            <td>
                                <center><?php echo $rows['username']; ?></center>
                            </td>
                            <td>
                                <center>
                                    <button data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setFormID('<?php echo $rows['o_id']; ?>')">
                                        Update Order status
                                    </button>

                                </center>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Title:</strong></td>
                            <td>
                                <center><?php echo $rows['title']; ?></center>
                            </td>
                            <td>
                                <center>
                                    <button
                                        data-bs-toggle="modal"
                                        data-bs-target="#updateOrderModal_<?php echo $rows['o_id']; ?>">
                                        View User Details
                                    </button>

                                </center>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Quantity:</strong></td>
                            <td>
                                <center><?php echo $rows['quantity']; ?></center>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Price:</strong></td>
                            <td>
                                <center>$<?php echo $rows['price']; ?></center>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Address:</strong></td>
                            <td>
                                <center><?php echo $rows['address']; ?></center>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Date:</strong></td>
                            <td>
                                <center><?php echo $rows['created_at']; ?></center>
                            </td>
                        </tr>

                        <tr>
                            <td><strong>Status:</strong></td>

                            <?php $status = $rows['status']; ?>

                            <?php if ($status == "" || $status == "NULL") { ?>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-info">
                                            <span class="fa fa-bars" aria-hidden="true"></span> Dispatch
                                        </button>
                                    </center>
                                </td>
                            <?php } ?>

                            <?php if ($status == "in process") { ?>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-warning">
                                            <span class="fa fa-cog fa-spin" aria-hidden="true"></span> On The Way!
                                        </button>
                                    </center>
                                </td>
                            <?php } ?>

                            <?php if ($status == "closed") { ?>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-primary">
                                            <span class="fa fa-check-circle" aria-hidden="true"></span> Delivered
                                        </button>
                                    </center>
                                </td>
                            <?php } ?>

                            <?php if ($status == "rejected") { ?>
                                <td>
                                    <center>
                                        <button type="button" class="btn btn-danger">
                                            <i class="fa fa-close"></i> Cancelled
                                        </button>
                                    </center>
                                </td>
                            <?php } ?>
                        </tr>


                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <?php
    include("conn.php");
    if (isset($_POST['update'])) {
        $form_id = $_GET['user_upd'];
        $status = $_POST['status'];
        $remark = $_POST['remark'];
        $query = mysqli_query($conn, "insert into remark(frm_id,status,remark) values('$form_id','$status','$remark')");
        $sql = mysqli_query($conn, "update users_orders set status='$status' where o_id='$form_id'");
    }

    ?>
    <div class="modal fade" id="updateModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <form method="POST">
                    <div class="modal-body">

                        <table class="my-table">
                            <tbody>
                                <tr>
                                    <td><b>Form Number</b></td>
                                    <td><?php echo htmlentities($_GET['user_upd']); ?>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Status</b></td>
                                    <td>
                                        <select name="status" required="required">
                                            <option value="">Select Status</option>
                                            <option value="in process">On the way</option>
                                            <option value="closed">Delivered</option>
                                            <option value="rejected">Cancelled</option>
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td><b>Message</b></td>
                                    <td>
                                        <textarea name="remark" cols="50" rows="3"></textarea>
                                    </td>
                                </tr>

                            </tbody>
                        </table>

                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary" name="update" type="submit">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            Close
                        </button>



                    </div>

                </form>

            </div>
        </div>
    </div>
    <div class="modal fade" id="updateOrderModal_<?php echo $rows['o_id']; ?>" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><?php echo $rows['f_name']; ?>'s Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">

                    <table class="my-table">
                        <tr>
                            <td>First Name</td>
                            <td><?php echo $rows['f_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name</td>
                            <td><?php echo $rows['l_name']; ?></td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td><?php echo $rows['email']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td><?php echo $rows['phone']; ?></td>
                        </tr>
                        <tr>
                            <td>Status</td>
                            <?php
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
                            } ?>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>