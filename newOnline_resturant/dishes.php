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


    <!-- Font Awesome Free -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"
        integrity="sha512-KyZXEAg3QhqLMpG8r+Knujsl5+5hb7VYvG5X0y1xYFQzQkJoY5MlN1kq9qI0Y1qZfY+uh5l1U+FJmBJp4F3eLg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>



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
        <!-- Top Links -->
        <div class="top-links">
            <div class="container" style="padding-top: 1rem;">
                <ul class="mt-3 pt-5 row list" style="list-style:none ">
                    <li class="col-xl-4 col-sm-12 link-item active text-center mb-2 mb-sm-0" style="color:#000">
                        <span class="res" style="border: 1px solid #fff;
                                        padding: 4px;
                                        border-radius: 50%;">1</span>
                        <a href="restaurants.php" style="color:#000">Choose Restaurant</a>
                    </li>
                    <li class="col-xl-4 col-sm-12 link-item text-center mb-2 mb-sm-0">
                        <span class="res" style="border: 1px solid #fff;
                                        padding: 4px;
                                        border-radius: 50%;">2</span>
                        <a href="#" style="color:#000">Pick Your Favorite Food</a>
                    </li>
                    <li class="col-xl-4 col-sm-12 link-item text-center">
                        <span class="res" style="border: 1px solid #fff;
                                        padding: 4px;
                                        border-radius: 50%;">3</span>
                        <a href="checkout.php" style="color:#000">Order and Pay</a>
                    </li>
                </ul>
            </div>

          <?php $ress= mysqli_query($quer,"select * from restaurant where rs_id='$_GET[res_id]'");
          $rows=mysqli_fetch_array($ress);?>
          





 <section class="inner-page-hero bg-image dish" data-image-src="admin/images/img/restrrr.png" style="background-image: url('admin/images/img/restrrr.png')">
    <div class="profile py-4">
        <div class="container">
            <div class="row align-items-center">

                <!-- Image -->
                <div class="col-12 col-md-4 profile-img mb-3 mb-md-0">
                    <div class="image-wrap">
                        <figure>
                            <?php echo '<img src="admin/Res_img/'.$rows['image'].'" alt="Restaurant logo" class="img-fluid rounded">'; ?>
                        </figure>
                    </div>
                </div>

                <!-- Description -->
                <div class="col-12 col-md-8 profile-desc">
                    <div class="text-start text-white">
                        <h6>
                            <a href="#" class="text-white text-decoration-none">
                                <?php echo $rows['title']; ?>
                            </a>
                        </h6>
                        <p><?php echo $rows['address']; ?></p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<div class="breadcrumb">
    <div class="container">
    </div>
</div>

<div class="container mt-4">

    <div class="row">
        <!-- CART SIDEBAR -->
        <div class="col-12 col-sm-4 col-md-4 col-lg-3 text-center">
            <div class="widget widget-cart">
                <div class="widget-heading mb-3">
                    <h3 class="widget-title text-dark">Your Cart</h3>
                </div>

                <div class="order-row bg-white">
                    <div class="widget-body ">

                        <?php
                        $item_total = 0;
                        foreach ($_SESSION["cart_item"] as $item) {
                        ?>

                        <div class="title-row d-flex justify-content-between align-items-center mt-3">
                            <?php echo $item["title"]; ?>
                            <a href="dishes.php?res_id=<?php echo $_GET['res_id']; ?>&action=remove&id=<?php echo $item["d_id"]; ?>">
                                <!-- <i class="fa-solid fa-trash-can"></i> -->
                                 <button class="btn btn-danger">delet</button>
                            </a>
                        </div>

                        <div class="row g-0 mt-2">
                            <div class="col-8">
                                <input type="text" class="form-control" value="<?php echo "$".$item["price"]; ?>" readonly>
                            </div>
                            <div class="col-4">
                                <input class="form-control" type="text" readonly value="<?php echo $item["quantity"]; ?>">
                            </div>
                        </div>

                        <?php
                        $item_total += ($item["price"] * $item["quantity"]);
                        }
                        ?>

                    </div>
                </div>

                <div class="widget-body mt-3">
                    <div class="price-wrap text-center">
                        <p>TOTAL</p>
                        <h3 class="value"><strong><?php echo "$".$item_total; ?></strong></h3>
                        <p>Free Delivery!</p>

                        <?php if($item_total==0){ ?>
                            <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check" class="btn btn-danger btn-lg disabled">Checkout</a>
                        <?php } else { ?>
                            <a href="checkout.php?res_id=<?php echo $_GET['res_id'];?>&action=check" class="btn btn-success btn-lg">Checkout</a>
                        <?php } ?>
                    </div>
                </div>

            </div>
        </div>

        <!-- MENU SECTION -->
        <div class="col-md-8">

            <div class="menu-widget" id="2">
                <div class="widget-heading">
                    <h3 class="widget-title text-dark d-flex justify-content-between align-items-center">
                        MENU
                        <button class="btn btn-link p-0" data-bs-toggle="collapse" data-bs-target="#popular2">
                            <i class="fa fa-angle-down"></i>
                        </button>
                    </h3>
                </div>

                <div class="collapse show" id="popular2">

                    <?php
                    $stmt = $quer->prepare("select * from dishes where rs_id='$_GET[res_id]'");
                    $stmt->execute();
                    $products = $stmt->get_result();

                    if (!empty($products)) {
                        foreach($products as $product) {
                    ?>

                    <div class="food-item border-bottom py-3">
                        <div class="row">

                            <div class="col-12 col-lg-8 d-flex">
                                <form method="post" action='dishes.php?res_id=<?php echo $_GET['res_id'];?>&action=add&id=<?php echo $product['d_id']; ?>' class="w-100 d-flex">
                                    <div class="row">
                                        <div class="rest-logo me-3 col-12 col-lg-4">
                                        <a href="#">
                                            <?php echo '<img src="admin/Res_img/dishes/'.$product['img'].' " width="200px" alt="Food" class=" rounded">'; ?>
                                        </a>
                                    </div>

                                    <div class="rest-descr col-12 col-lg-7 ">
                                        <h6><a href="#"><?php echo $product['title']; ?></a></h6>
                                        <p><?php echo $product['describtion']; ?></p>
                                    </div>
                                    </div>
                                    

                            </div>

                            <div class="col-12 col-lg-3 mt-3 mt-lg-0 text-end">
                                <span class="price d-block mb-2">$<?php echo $product['price']; ?></span>
                                <input class="form-control d-inline-block w-50" type="text" name="quantity" value="1">
                                <input type="submit" class="btn btn-primary mt-2" value="Add To Cart">
                                </form>
                            </div>

                        </div>
                    </div>

                    <?php
                        }
                    }
                    ?>

                </div>

            </div>

        </div>
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