<?php
session_start();
include("connection/connection.php");

$message = "";
$success = "";

// 3. Handle login
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $message = "Please enter both username and password.";
    } else {
        $stmt = $quer->prepare("SELECT u_id, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if ($row['password'] === md5($password)) {
                $_SESSION['user_id'] = $row['u_id'];
                $_SESSION['username'] = $row['username'];

                // Redirect **مباشر**
                header("Location: index.php");
                exit;
            } else {
                $message = "Invalid Username or Password.";
            }
        } else {
            $message = "Username does not exist.";
        }
        $stmt->close();
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login </title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css"> 
</head>
<body>
    
    <header id="header" class="header-scroll top-header headrom">
        <nav class="navbar navbar-dark navbar-expand-lg bg-dark">
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
                        
                        <?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Login</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Register</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">My Orders</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Logout</a> </li>';
							}

						?>

                    </ul>
                </div>

            </div>
        </nav>
    </header>
    
    <div class="page-background">
    </div>

    




    <div id="login-modal" class="login-modal-container">
      <div class="login-modal">
           
          <p class="login-title">Login to your account</p> 
          <span style="color:red;"><?php echo $message; ?></span> 
   <span style="color:green;"><?php echo $success; ?></span>
            
          <form class="modal-form" action="" method="post">
                
              <div class="form-group">
                  <input type="text" name="username" placeholder="Username" required>
              </div>
                
              <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
              </div>
                
              <button type="submit" name="submit" class="modal-submit-btn">Login</button>
                
          </form>
            
          <div class="not-registered">
            Not registered?
            <a href="registration.php" style="color:#5c4ac7;">Create an account</a>
          </div>
            
      </div>
    </div>

    <footer class="footer bg-dark text-white py-5">
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>