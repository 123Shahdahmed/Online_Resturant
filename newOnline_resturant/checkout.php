<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("connection/connection.php");
    error_reporting(0);
    session_start();
    

function function_alert() { 
      

    echo "<script>
    alert('Thank you. Your Order has been placed!');
    window.location.href='your_orders.php';
    </script>";



} 

if(empty($_SESSION["user_id"]))
{
	header('location:login.php');
}
else{

										  
												foreach ($_SESSION["cart_item"] as $item)
												{
											
												$item_total += ($item["price"]*$item["quantity"]);
												
													if(isset($_POST['submit']))
													{
						
													$SQL="insert into users_orders(u_id,title,quantity,price) values('".$_SESSION["user_id"]."','".$item["title"]."','".$item["quantity"]."','".$item["price"]."')";
						
														mysqli_query($quer,$SQL);
														
                                                        
                                                        unset($_SESSION["cart_item"]);
                                                        unset($item["title"]);
                                                        unset($item["quantity"]);
                                                        unset($item["price"]);
														$success = "Thank you. Your order has been placed!";

                                                        function_alert();

														
														
													}
												}}

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>checkout</title>


    <!-- Font Awesome -->
     <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">


    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">


    <link rel="stylesheet" href="index.css">
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

    <!-- Top Steps Navigation -->
    <div class="top-links py-3 bg-light border-bottom">
        <div class="container">
            <ul class="row list-unstyled text-center fw-bold mt-5">

                <li class="col-12 col-sm-4 py-2">
                    <span class="badge bg-primary me-2">1</span>
                    <a href="restaurants.php" class="text-decoration-none">Choose Restaurant</a>
                </li>

                <li class="col-12 col-sm-4 py-2">
                    <span class="badge bg-primary me-2">2</span>
                    <a href="#" class="text-decoration-none">Pick Your Favorite Food</a>
                </li>

                <li class="col-12 col-sm-4 py-2 active">
                    <span class="badge bg-success me-2">3</span>
                    <a href="checkout.php" class="text-decoration-none text-success">Order and Pay</a>
                </li>

            </ul>
        </div>
    </div>

    <!-- Success message -->
    <div class="container mt-3">
        <span class="text-success fw-bold">
            <?php echo $success; ?>
        </span>
    </div>

    <!-- Cart Summary + Payment -->
    <div class="container mt-4">

        <form action="" method="post" class="p-4 border rounded shadow-sm bg-white">

            <!-- Cart Summary -->
            <h4 class="mb-3">Cart Summary</h4>

            <table class="table table-bordered">
                <tbody>
                    <tr>
                        <td>Cart Subtotal</td>
                        <td><?php echo "$" . $item_total; ?></td>
                    </tr>

                    <tr>
                        <td>Delivery Charges</td>
                        <td>Free</td>
                    </tr>

                    <tr>
                        <td><strong>Total</strong></td>
                        <td><strong><?php echo "$" . $item_total; ?></strong></td>
                    </tr>
                </tbody>
            </table>

            <!-- Payment Options -->
            <h5 class="mt-4">Payment Method</h5>

            <div class="form-check mb-3">
                <input class="form-check-input" type="radio" name="mod" id="cod" value="COD" checked>
                <label class="form-check-label" for="cod">
                    Cash on Delivery
                </label>
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="radio" name="mod" id="paypal" value="paypal" disabled>
                <label class="form-check-label" for="paypal">
                    Paypal <img src="admin/images/paypal.jpg" width="90" class="ms-2">
                </label>
            </div>

            <button type="submit" name="submit" class="btn btn-success w-100"
                onclick="return confirm('Do you want to confirm the order?');">
                Order Now
            </button>

        </form>

    </div>

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