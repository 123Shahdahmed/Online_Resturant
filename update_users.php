<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="update_users.css">
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
                        <a href="all_restaurant.php" class="d-block mb-2">All Restaurant</a>
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

        <?php
        include("conn.php");
        if (isset($_POST['submit'])) {
            if (
                empty($_POST['uname']) ||
                empty($_POST['fname']) ||
                empty($_POST['lname']) ||
                empty($_POST['email']) ||
                empty($_POST['phone']) ||
                empty($_POST['Address'])
            ) {
                $error = '<div class="alert alert-danger alert-dismissible fade show">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>All fields Required!</strong>
										</div>';
            } else {




                if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong>invalid email!</strong>
					</div>';
                } elseif (strlen($_POST['phone']) < 10) {
                    $error = '<div class="alert alert-danger alert-dismissible fade show">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong>invalid phone!</strong>
							</div>';
                } else {


                    $mql = "update users set username='$_POST[uname]', f_name='$_POST[fname]', l_name='$_POST[lname]',email='$_POST[email]',phone='$_POST[phone]',Address='$_POST[Address]' where u_id='$_GET[user_upd]' ";
                    mysqli_query($conn, $mql);
                    if (!empty($_POST['password'])) {

                        $newpass = md5($_POST['password']);

                        $q2 = "UPDATE users SET password='$newpass' where u_id='$_GET[user_upd]'";
                        mysqli_query($conn, $q2);
                    }
                    $success =     '<div class="alert alert-success alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong>User Updated!</strong></div>';
                    header("Location: all_users.php");
                    exit;
                }
            }
        }
        ?>
        <div class="container">

            <?php
            echo $error ?? "";
            echo $success ?? "";
            ?>

            <?php
            $ssql = "SELECT * FROM users WHERE u_id='$_GET[user_upd]'";
            $res = mysqli_query($conn, $ssql);
            $newrow = mysqli_fetch_array($res);
            ?>

            <h2>Update User</h2>

            <form action="" method="post">

                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="uname" value="<?php echo $newrow['username']; ?>">
                </div>

                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="fname" value="<?php echo $newrow['f_name']; ?>">
                </div>

                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="lname" value="<?php echo $newrow['l_name']; ?>">
                </div>

                <div class="form-group">
                    <label>Email</label>
                    <input type="text" name="email" value="<?php echo $newrow['email']; ?>">
                </div>

                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Enter new password">

                </div>

                <div class="form-group">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?php echo $newrow['phone']; ?>">
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="Address" value="<?php echo $newrow['address']; ?>">
                </div>


                <input type="submit" name="submit" class="btn btn-primary" value="Save">
                <a href="all_users.php" class="btn-cancel">Cancel</a>

            </form>
        </div>
</body>

</html>