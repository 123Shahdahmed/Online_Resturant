<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("connection/connection.php");
    error_reporting(0);
    session_start();

    ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>




    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php session_start(); ?>

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

    <section class="hero bg-image" data-image-src="admin/images/img/pimg.jpg">
        <div class="hero-inner">
            <div class="container text-center hero-text text-white">
                <h1>Order Delivery & Take-Out</h1>
                <div class="banner-form">
                    <form class="d-flex justify-content-center"> <!-- Add your inputs here --> </form>
                </div>
                <div class="steps d-flex justify-content-center gap-5 mt-4 flex-wrap"> <!-- Step 1 -->
                    <div class="step-item text-center"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483 483"
                            width="80" height="80">
                            <g fill="#fff"> <!-- SVG Path (unchanged) --> </g>
                        </svg>
                        <h4><span style="color:white;">1.</span> Choose Restaurant</h4>
                    </div> <!-- Step 2 -->
                    <div class="step-item text-center"> <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                            viewBox="0 0 380.721 380.721">
                            <g fill="#FFF"> <!-- SVG Path --> </g>
                        </svg>
                        <h4><span style="color:white;">2.</span> Order Food</h4>
                    </div> <!-- Step 3 -->
                    <div class="step-item text-center"> <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                            viewBox="0 0 612.001 612"> <!-- SVG Path --> </svg>
                        <h4><span style="color:white;">3.</span> Delivery or take out</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <section class="popular py-5">
        <div class="container">
            <!-- عنوان القسم -->
            <div class="text-center mb-4">
                <h2>Popular Dishes of the Month</h2>
                <p class="lead">Easiest way to order your favourite food among these top 6 dishes</p>
            </div>

            <div class="row g-4">
                <?php
                $query_res = mysqli_query($quer, "SELECT * FROM dishes LIMIT 6");
                while ($r = mysqli_fetch_array($query_res)) {
                    echo '
                <div class="col-12 col-sm-6 col-md-4 food-item">
                    <div class="food-item-wrap card h-100">
                        <div class="figure-wrap" style="background-image: url(admin/Res_img/dishes/' . $r['img'] . '); background-size: cover; background-position: center; height: 200px;"></div>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><a href="dishes.php?res_id=' . $r['rs_id'] . '" class="text-decoration-none">' . $r['title'] . '</a></h5>
                            <p class="card-text">' . $r['slogan'] . '</p>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="price fw-bold">$' . $r['price'] . '</span>
                                <a href="dishes.php?res_id=' . $r['rs_id'] . '" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                    </div>
                </div>';
                }
                ?>
            </div>
        </div>
    </section>



    <section class="how-it-works py-5 bg-dark text-white">
        <div class="container">

            <div class="text-center mb-5">
                <h2>Easy to Order</h2>
            </div>


            <div class="row g-4">

                <div class="col-12 col-md-4">
                    <div class="how-it-works-step text-center p-4">
                        <div class="icon mb-3" data-step="1">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 483 483" width="80" height="80">
                                <g fill="#FFF">
                                    <path d="M467.006 177.92c-.055-1.573..." />
                                    <path
                                        d="M202.494 386h22c5.799 0 10.5-4.701 10.5-10.5s-4.701-10.5-10.5-10.5h-22c-5.799 0-10.5 4.701-10.5 10.5s4.701 10.5 10.5 10.5z" />
                                </g>
                            </svg>
                        </div>
                        <h3>Choose a restaurant</h3>
                        <p>We've got you covered with menus from a variety of delivery restaurants online.</p>
                    </div>
                </div>


                <div class="col-12 col-md-4">
                    <div class="how-it-works-step text-center p-4">
                        <div class="icon mb-3" data-step="2">

                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80"
                                viewBox="0 0 380.721 380.721">
                                <g fill="#FFF">
                                    <path d="M58.727 281.236c.32-5.217..." />
                                </g>
                            </svg>
                        </div>
                        <h3>Choose a dish</h3>
                        <p>We've got you covered with a variety of delivery restaurants online.</p>
                    </div>
                </div>

                <div class="col-12 col-md-4">
                    <div class="how-it-works-step text-center p-4">
                        <div class="icon mb-3" data-step="3">

                            <svg xmlns="http://www.w3.org/2000/svg" width="80" height="80" viewBox="0 0 612 612">
                                <path d="M604.131 440.17h-19.12V333.237..." fill="#FFF" />
                            </svg>
                        </div>
                        <h3>Pick up or Delivery</h3>
                        <p>Get your food delivered! And enjoy your meal!</p>
                    </div>
                </div>
            </div>


            <div class="row mt-4">
                <div class="col-12 text-center">
                    <p class="pay-info">Cash on Delivery</p>
                </div>
            </div>
        </div>
    </section>


    <section class="featured-restaurants">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="title-block pull-left">
                        <h4>Featured Restaurants</h4>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="restaurants-filter float-end mr-5">
                        <nav class="primary ">
                            <ul>
                                <li><a href="#" class="selected" data-filter="*">all</a></li>
                                <?php

                                $res = $quer->query("SELECT * FROM res_category");
                                while ($row = $res->fetch_assoc()) {
                                    echo '<li><a href="#" data-filter=".' . $row['c_name'] . '">' . $row['c_name'] . '</a></li>';
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="restaurant-listing row">
                    <?php
                    $ress = $quer->query("
                    SELECT restaurant.*, res_category.c_name 
                    FROM restaurant 
                    JOIN res_category ON restaurant.c_id = res_category.c_id
                ");

                    while ($rows = $ress->fetch_assoc()) {
                        echo '<div class="col-xs-6 col-sm-12 col-md-6 single-restaurant all ' . $rows['c_name'] . '" >
                            <div class="restaurant-wrap">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-3 col-md-12 col-lg-3 text-xs-center">
                                        <a class="restaurant-logo" href="dishes.php?res_id='.$rows['rs_id'].'">
                                            <img src="admin/Res_img/' . $rows['image'] . '" alt="Restaurant logo">
                                        </a>
                                    </div>
                                    <div class="col-xs-12 col-sm-9 col-md-12 col-lg-9">
                                        <h5><a href="#">' . $rows['title'] . '</a></h5>
                                        <span>' . $rows['address'] . '</span>
                                    </div>
                                </div>
                            </div>
                        </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>



    <footer class="footer bg-dark text-white py-5 mt-5">
        <div class="container">

            <div class="row">

                <!-- Payment Options -->
                <div class="col-12 col-md-3 mb-4">
                    <h5 class="mb-3">Payment Options</h5>
                    <ul class="list-unstyled d-flex flex-wrap gap-3">
                        <li><a href="#"><img src="admin/images/paypal.png" alt="Paypal" width="50"></a></li>
                        <li><a href="#"><img src="admin/images/mastercard.png" alt="Mastercard" width="50"></a></li>
                        <li><a href="#"><img src="admin/images/maestro.png" alt="Maestro" width="50"></a></li>
                        <li><a href="#"><img src="admin/images/stripe.png" alt="Stripe" width="50"></a></li>
                        <li><a href="#"><img src="admin/images/bitcoin.png" alt="Bitcoin" width="50"></a></li>
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


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>