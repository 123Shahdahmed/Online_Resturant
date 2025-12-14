<?php 
session_start(); 
error_reporting(0); 
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

include("connection/connection.php"); 

$message = ""; // Variable to hold error messages
$success = ""; // Variable to hold success messages

if(isset($_POST['submit']))
{
    $username = mysqli_real_escape_string($quer, $_POST['username']);
    $firstname = mysqli_real_escape_string($quer, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($quer, $_POST['lastname']);
    $email = mysqli_real_escape_string($quer, $_POST['email']);
    $phone = mysqli_real_escape_string($quer, $_POST['phone']);
    $password = mysqli_real_escape_string($quer, $_POST['password']);
    $cpass = mysqli_real_escape_string($quer, $_POST['cpass']);
    $address = mysqli_real_escape_string($quer, $_POST['address']);


    if(empty($username) || empty($firstname) || empty($lastname) || empty($email) || empty($phone) || empty($password) || empty($cpass) || empty($address))
    { 
        $message = "All fields are required!";
    }
    elseif($password != $cpass)  
    { 
        $message = "Password and Confirm Password do not match.";
    }
    elseif(strlen($password) < 6)  
    {
        $message = "Password must be 6 characters or more."; 
    }
    elseif(strlen($phone) < 8) 
    {
        $message = "Invalid phone number.";
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
        $message = "Invalid email format."; 
    }
    else
    {
        
        $check_username = mysqli_query($quer, "SELECT username FROM users WHERE username = '$username'");
        $check_email = mysqli_query($quer, "SELECT email FROM users WHERE email = '$email'");

        if(mysqli_num_rows($check_username) > 0) 
        {
            $message = "Username already exists!"; 
        }
        elseif(mysqli_num_rows($check_email) > 0) 
        {
            $message = "Email address already registered!"; 
        }
        else
       {
//             `u_id` int(11) NOT NULL,
//   `username` varchar(222) NOT NULL,
//   `f_name` varchar(222) NOT NULL,
//   `l_name` varchar(222) NOT NULL,
//   `email` varchar(222) NOT NULL,
//   `phone` varchar(222) NOT NULL,
//   `password` varchar(222) NOT NULL,
//   `address` text NOT NULL,
//   `status` int(11) NOT NULL DEFAULT 1,
//   `created_at` timestamp NOT NULL DEFAULT current_timestamp()
            
            // Hash the password using MD5
            $hashed_password = md5($password);
            
            $mql = "INSERT INTO users(username, f_name, l_name, email, phone, password, address) 
        VALUES('$username', '$firstname', '$lastname', '$email', '$phone', '$hashed_password', '$address')";

                 mysqli_query($quer, $mql);


            
            $success = "Account created successfully! Redirecting to login page in 3 seconds...";
            
            header("refresh:2;url=login.php");
            exit;
        }
    }
} 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>registration</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap.min.css" rel="stylesheet">
    <link href="font-awesome.min.css" rel="stylesheet">
    <link href="animsition.min.css" rel="stylesheet">
    <link href="animate.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet"> 
    
</head>
<body>
    <div style=" background-image: url('admin/images/img/pimg.jpg');">
    <header style=" background-image: url('images/menu-bg.jpg') ;" id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark navbar-expand-lg ">
            <div class="container">
                <a class="navbar-brand" href="index.php">
                    <img class="img-rounded" src="images/icn.png" alt="O.F.O.S Logo"> 
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#mainNavbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"><a class="nav-link active" href="index.php">Home</a></li>
                        <li class="nav-item"><a class="nav-link active" href="restaurants.php">Restaurants</a></li>
                        
                        <li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
                        <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    
    <div class="page-background">
    </div>
    
    
    
     <div class="page-wrapper">
    
        <div class="container my-5">
            <div class="row ">
                <div class="col-md-12">
                    <div class="widget" style="background-color: #f2f2f2; padding: 25px; border-radius: 8px;"> 
                        <div class="widget-body">
                            
                                <?php 
                                if (!empty($message)) { 
                                    echo '<div class="alert alert-danger text-center" style="padding: 10px; margin-bottom: 15px; background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; border-radius: 4px;">' . $message . '</div>';
                                } elseif (!empty($success)) {
                                    echo '<div class="alert alert-success text-center" style="padding: 10px; margin-bottom: 15px; background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; border-radius: 4px;">' . $success . '</div>';
                                }
                                ?>
                            <form action="" method="post">
                                <div class="row">
                                    
                                    <div class="form-group col-sm-12">
                                        <label for="exampleInputEmail1">User-Name</label>
                                        <input class="form-control" type="text" name="username" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">First Name</label>
                                        <input class="form-control" type="text" name="firstname" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Last Name</label>
                                        <input class="form-control" type="text" name="lastname" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Email Address</label>
                                        <input type="email" class="form-control" name="email" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputEmail1">Phone number</label>
                                        <input class="form-control" type="text" name="phone" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input type="password" class="form-control" name="password" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-6">
                                        <label for="exampleInputPassword1">Confirm password</label>
                                        <input type="password" class="form-control" name="cpass" > 
                                    </div>
                                    
                                    <div class="form-group col-sm-12 mb-4">
                                        <label for="exampleTextarea">Delivery Address</label>
                                        <textarea class="form-control" name="address" rows="2" ></textarea>
                                    </div>
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-sm-4">
                                        <input type="submit" value="Register" name="submit" class="btn theme-btn" style="background-color: #5c4ac7; color: white; border:none;"> 
                                    </div>
                                </div>
                                
                                 
                                
                            </form>
                            
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>
        </div>
    
</div>
            


    <footer style=" background-image: url('images/menu-bg.jpg') ;" class="footer bg-dark text-white py-5">
        <div class="container">
            <div class="row">
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
                <div class="col-12 col-md-4 mb-4">
                    <h5 class="mb-3">Address</h5>
                    <p class="mb-1">1086 Stockert Hollow Road, Seattle</p>
                    <p class="mb-0">Phone: 75696969855</p>
                </div>
                <div class="col-12 col-md-5 mb-4">
                    <h5 class="mb-3">Additional Information</h5>
                    <p>Join thousands of other restaurants who benefit from having partnered with us.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
     <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>
</html>