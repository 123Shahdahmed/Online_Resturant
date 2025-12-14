<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("connection/connection.php");
    error_reporting(0);
    session_start();

    if(empty($_SESSION['user_id']))  
{
	header('location:login.php');
}
else
{
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>your_order</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">



    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



    <link rel="stylesheet" href="index.css">
<style type="text/css" rel="stylesheet">


.indent-small {
  margin-left: 5px;
}
.form-group.internal {
  margin-bottom: 0;
}
.dialog-panel {
  margin: 10px;
}
.datepicker-dropdown {
  z-index: 200 !important;
}
.panel-body {
  background: #e5e5e5;
  /* Old browsers */
  background: -moz-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* FF3.6+ */
  background: -webkit-gradient(radial, center center, 0px, center center, 100%, color-stop(0%, #e5e5e5), color-stop(100%, #ffffff));
  /* Chrome,Safari4+ */
  background: -webkit-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Chrome10+,Safari5.1+ */
  background: -o-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* Opera 12+ */
  background: -ms-radial-gradient(center, ellipse cover, #e5e5e5 0%, #ffffff 100%);
  /* IE10+ */
  background: radial-gradient(ellipse at center, #e5e5e5 0%, #ffffff 100%);
  /* W3C */
  filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#e5e5e5', endColorstr='#ffffff', GradientType=1);
  font: 600 15px "Open Sans", Arial, sans-serif;
}
label.control-label {
  font-weight: 600;
  color: #777;
}


	</style>
</head>    

<body>
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
            <div class="container">

                <a class="navbar-brand" href="index.php">
                    <img class="img-rounded" src="images/icn.png" alt="">
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="restaurants.php">Restaurants</a></li>

                        <?php if (empty($_SESSION["user_id"])) { ?>
                            <li class="nav-item"><a href="login.php" class="nav-link active">Login</a></li>
                            <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a></li>
                        <?php } else { ?>
                            <li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a></li>
                            <li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a></li>
                        <?php } ?>

                    </ul>
                </div>

            </div>
        </nav>
    </header>



    <div class="page-wrapper">

    <div class="inner-page-hero bg-image" style="background-image: url('images/img/pimg.jpg'); height:250px;">
        <div class="container"></div>
    </div>

    <section class="restaurants-page py-5">
        <div class="container">

            <div class="row">
                <div class="col-12">

                    <div class="bg-light p-3 rounded shadow-sm">
                        <div class="table-responsive">

                            <table class="table table-bordered table-hover text-center align-middle">
                                <thead style="background: #404040; color:white;">
                                    <tr>
                                        <th>Item</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>

                                <?php 
                                $query_res = mysqli_query($quer,"SELECT * FROM users_orders WHERE u_id='".$_SESSION['user_id']."'");
                                
                                if (!mysqli_num_rows($query_res)) {
                                    echo '<tr><td colspan="6"><center>You have No orders placed yet.</center></td></tr>';
                                } else {
                                    while ($row = mysqli_fetch_array($query_res)) { ?>

                                        <tr>
                                            <td><?php echo $row['title']; ?></td>
                                            <td><?php echo $row['quantity']; ?></td>
                                            <td>$<?php echo $row['price']; ?></td>

                                            <td>
                                                <?php 
                                                    $status = $row['status'];

                                                    if ($status == "" || $status == "NULL") {
                                                        echo '<button class="btn btn-info btn-sm">
                                                                <i class="fa fa-bars"></i> Dispatch
                                                              </button>';
                                                    }

                                                    if ($status == "in process") {
                                                        echo '<button class="btn btn-warning btn-sm">
                                                                <i class="fa fa-cog fa-spin"></i> On The Way!
                                                              </button>';
                                                    }

                                                    if ($status == "closed") {
                                                        echo '<button class="btn btn-success btn-sm">
                                                                <i class="fa fa-check-circle"></i> Delivered
                                                              </button>';
                                                    }

                                                    if ($status == "rejected") {
                                                        echo '<button class="btn btn-danger btn-sm">
                                                                <i class="fa fa-close"></i> Cancelled
                                                              </button>';
                                                    }
                                                ?>
                                            </td>

                                            <td><?php echo $row['date']; ?></td>

                                            <td>
                                                <a href="delete_order.php?order_del=<?php echo $row['o_id'];?>"
                                                   onclick="return confirm('Are you sure you want to cancel your order?');"
                                                   class="btn btn-danger btn-sm">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                    <?php }} ?>

                                </tbody>
                            </table>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </section>

</div>




    
    
          





 






            


     




        <footer class="footer bg-dark text-white py-5 mt-5">
            <div class="container">

                <div class="row">

                    <!-- Payment Options -->
                    <div class="col-12 col-md-3 mb-4">
                        <h5 class="mb-3">Payment Options</h5>
                        <ul class="list-unstyled d-flex flex-wrap gap-3">
                            <li><a href="#"><img src="admin/images/paypal.png" alt="Paypal" width="30"></a></li>
                            <li><a href="#"><img src="admin/images/mastercard.png" alt="Mastercard" width="30"></a></li>
                            <li><a href="#"><img src="admin/images/maestro.png" alt="Maestro" width="30"></a></li>
                            <li><a href="#"><img src="admin/images/stripe.png" alt="Stripe" width="30"></a></li>
                            <li><a href="#"><img src="admin/images/bitcoin.png" alt="Bitcoin" width="30"></a></li>
                        </ul>
                    </div>

<!-- Address -->
                    <div class="col-12 col-md-4 mb-4">
                        <h5 class="mb-3">Address</h5>
                        <p class="mb-1">1086 Stockert Hollow Road, Seattle</p>
                        <p class="mb-0">Phone: 75696969855</p>
                    </div>

                    <!-- Additional Info -->
                    <div class="col-12 col-md-5 mb-4">
                        <h5 class="mb-3">Additional Information</h5>
                        <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
                    </div>

                </div>

            </div>
        </footer>

</body>

</html>
<?php
}
?>