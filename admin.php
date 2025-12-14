<?php
session_start();
include("conn.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['adm_name'];
    $password = $_POST['adm_pass'];

    $stmt = $conn->prepare("select username ,password from admin where username= ? and password=?");
    $stmt->bind_param("ss", $username, $password);

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION["user_session"] = $username;
        header("location:dashboard.php");
        exit();
    } else {
        echo "<p style='color:red;text-align:center;margin-top:20px;'>Invalid Username or Password</p>";
    }

    $stmt->close();
    $conn->close();
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="admin_cs.css">

</head>

<body>
    <div class="main-login">
        <form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="Post">
            <i class="fa-solid fa-user-tie"></i>
            <input type="text" placeholder="Username" name="adm_name" required>
            <input type="password" placeholder="Password" name="adm_pass" required>
            <input type="submit" value="Login" name="submit" class="submit">

        </form>
    </div>


</body>

</html>