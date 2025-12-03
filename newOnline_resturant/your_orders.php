Reham Omar, [12/1/2025 11:14 PM]
<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("connection/connection.php");
    error_reporting(0);
    session_start();

    include_once 'product-action.php'; 

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dishes</title>


    <!-- Font Awesome -->
    <!-- Font Awesome Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7VYvG5X0y1xYFQzQkJoY5MlN1kq9qI0Y1qZfY+uh5l1U+FJmBJp4F3eLg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


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