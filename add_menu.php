<?php
include "conn.php";
$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']);
    $about = trim($_POST['about']);
    $price = trim($_POST['price']);

    $restaurant = $_POST['restaurant'] ?? '';
    if (!isset($_FILES['image']) || $_FILES['image']['error'] != 0) {
        $errors['image'] = "Please upload an image.";
    } else {
        $image_name = $_FILES['image']['name'];
        $image_tmp  = $_FILES['image']['tmp_name'];


        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        $ext = strtolower(pathinfo($image_name, PATHINFO_EXTENSION));

        if (!in_array($ext, $allowed)) {
            $errors['image'] = "Only JPG, PNG, GIF images are allowed.";
        } else {

            $upload_path =  uniqid() . "." . $ext;

            move_uploaded_file($image_tmp, $upload_path);

            $image_saved_path = $upload_path;
        }
    }

    if (!$name)     $errors['name'] = "Name is required.";
    if (!$about)    $errors['about'] = "Description is required.";
    if (!$price)    $errors['price'] = "Price is required.";
    if (!$restaurant || $restaurant === '--Select Restaurant--') $errors['restaurant'] = "Please select restaurant Name.";

    if (strlen($name) > 255)      $errors['name'] = "Name is too long.";
    if (strlen($about) > 255)      $errors['about'] = "Description is too long.";

    if (empty($errors)) {
        $stmt = $conn->prepare("
            INSERT INTO dishes  (title, describtion, price, img, rs_id)
            VALUES (?, ?, ?, ?, ?)
        ");
        $stmt->bind_param("ssssi", $name, $about, $price, $image_saved_path, $restaurant);

        if ($stmt->execute()) {
            $success = "New dish added successfully!";
            header("refresh:1; url=add_menu.php"); // wait 1 second then redirect
        } else {
            $errors[] = "Database error: " . $conn->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+Pro:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="res_cs.css">

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
    <div class="main d-flex">


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
                            <a href="all_resturant.php" class="d-block mb-2">All Restaurant</a>
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
        </div>
        <div class="total flex-grow-1">
            <div class="Title">Add Menu </div>

            <hr><br>
            <form class="row g-3" method="POST" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label for="inputName" class="form-label">Dish Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="<?= htmlspecialchars($name ?? '') ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="inputabout" class="form-label">Description</label>
                    <input type="text" class="form-control" id="inputabout" name="about" value="<?= htmlspecialchars($about ?? '') ?>">
                    <?php if (isset($errors['about'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['about'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="inputPrice" class="form-label">Price</label>
                    <input type="text" class="form-control" id="inputPrice" name="price" placeholder="$" value="<?= htmlspecialchars($price ?? '') ?>">
                    <?php if (isset($errors['price'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['price'] ?></div>
                    <?php endif; ?>
                </div>


                <div class="col-md-6">
                    <label for="inputImage" class="form-label">Image</label>

                    <input type="file" name="image" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>">
                    <?php if (isset($errors['image'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['image'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-12">
                    <label for="inputrestaurant" class="form-label">Select Restaurant</label>
                    <select name="restaurant" class="form-select <?= isset($errors['restaurant']) ? 'is-invalid' : '' ?>">
                        <option>--Select Restaurant--</option>
                        <?php
                        include "conn.php";
                        $sql = "SELECT * FROM restaurant";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                $sel = ($restaurant == $row['rs_id']) ? 'selected' : '';
                                echo "<option value='{$row['rs_id']}' $sel>{$row['title']}</option>";
                            }
                        }
                        ?>
                        <?php if (isset($errors['restaurant'])): ?>
                            <div class="invalid-feedback" style="display:block;"><?= $errors['restaurant'] ?></div>
                        <?php endif; ?>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-dark" href="all_menu.php">Cancel</a>
                </div>
            </form>

        </div>

    </div>

</body>

</html>