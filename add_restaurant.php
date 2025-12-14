<?php
include "conn.php";

$errors = [];
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = trim($_POST['name']) ?? '';
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $url = $_POST['url'];
    $opn = $_POST['opn'];
    $close = $_POST['close'];
    $days = $_POST['days'];
    $category = $_POST['category'];
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
    $url = trim($_POST['url']);
    $address = trim($_POST['address']);
    if (!$name)     $errors['name'] = "Name is required.";
    if (!$email)    $errors['email'] = "Email is required.";
    if (!$phone)    $errors['phone'] = "Phone number is required.";
    if (!$url)      $errors['url'] = "Website URL is required.";

    if (!$address)  $errors['address'] = "Address is required.";
    if (!$opn || $opn === '--Select Your Hours--') {
        $errors['opn'] = "Please select opening hours.";
    }
    if (!$close || $close === '--Select Your Hours--') {
        $errors['close'] = "Please select closing hours.";
    }
    if (!$days || $days === '--Select Your Days--') {
        $errors['days'] = "Please select your days.";
    }
    if (!$category || $category === '--Select Category--') $errors['category'] = "Please select category.";
    if ($email && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    if ($phone && !preg_match("/^[0-9]{6,15}$/", $phone)) {
        $errors[] = "Phone number must contain 6–15 digits only.";
    }

    if (strlen($name) > 255)      $errors['name'] = "Name is too long.";
    if (strlen($phone) > 50)      $errors['phone'] = "Phone number is too long.";
    if (strlen($url) > 255)       $errors['url'] = "URL is too long.";
    if (strlen($address) > 500)   $errors['address'] = "Address is too long.";
    $check = $conn->prepare("SELECT rs_id FROM restaurant WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check_result = $check->get_result();

    if ($check_result->num_rows > 0) {
        $errors[] = "This email is already registered.";
    }

    if (empty($errors)) {
        $stmt = $conn->prepare("
            INSERT INTO restaurant  (title, email, phone, url, o_hr,c_hr,o_days,address,image,c_id)
            VALUES (?, ?, ?, ?, ?,?,?,?,?,?)
        ");
        $stmt->bind_param("sssssssssi", $name, $email, $phone, $url, $opn, $close, $days, $address, $image_saved_path, $category);

        if ($stmt->execute()) {
            $success = "New Restaurant added successfully!";
            header("refresh:1; url=add_restaurant.php"); // wait 1 second then redirect
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
            <div class="Title">Add Restaurant

            </div>
            <hr><br>
            <form class="row g-3" method="POST" enctype="multipart/form-data">
                <div class="col-md-6">
                    <label for="inputName" class="form-label">Restaurant Name</label>
                    <input type="text" class="form-control" id="inputName" name="name" value="<?= htmlspecialchars($name ?? '') ?>">
                    <?php if (isset($errors['name'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['name'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Bussiness Email</label>
                    <input type="email" class="form-control" id="inputEmail4" name="email" value="<?= htmlspecialchars($email ?? '') ?>">
                    <?php if (isset($errors['email'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['email'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="inputPhone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="inputPhone" name="phone" value="<?= htmlspecialchars($phone ?? '') ?>">
                    <?php if (isset($errors['phone'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['phone'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="inputUrl" class="form-label">Website URL</label>
                    <input type="text" class="form-control" id="inputUrl" name="url" value="<?= htmlspecialchars($url ?? '') ?>">
                    <?php if (isset($errors['url'])): ?>
                        <div style="color:red; font-size:0.9em;"><?= $errors['url'] ?></div>
                    <?php endif; ?>
                </div>
                <div class="col-md-6">
                    <label for="inputopenh" class="form-label">Open Hours</label>
                    <select class="form-select <?= isset($errors['opn']) ? 'is-invalid' : '' ?>" name="opn" aria-label="Default select example">
                        <option>--Select Your Hours--</option>
                        <option value="6am" <?= ($opn ?? '') === '6am' ? 'selected' : '' ?>>6am</option>
                        <option value="7am" <?= ($opn ?? '') === '7am' ? 'selected' : '' ?>>7am</option>
                        <option value="8am" <?= ($opn ?? '') === '8am' ? 'selected' : '' ?>>8am</option>
                        <option value="9am" <?= ($opn ?? '') === '9am' ? 'selected' : '' ?>>9am</option>
                        <option value="10am" <?= ($opn ?? '') === '10am' ? 'selected' : '' ?>>10am</option>
                        <option value="11am" <?= ($opn ?? '') === '11am' ? 'selected' : '' ?>>11am</option>
                    </select>
                    <?php if (isset($errors['opn'])): ?>
                        <div class="invalid-feedback" style="display:block;"><?= $errors['opn'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label for="inputcloseh" class="form-label">Close Hours</label>
                    <select class="form-select <?= isset($errors['close']) ? 'is-invalid' : '' ?>" name="close" aria-label="Default select example">
                        <option>--Select Your Hours--</option>
                        <option value="3pm" <?= ($close ?? '') === '3pm' ? 'selected' : '' ?>>3pm</option>
                        <option value="4pm" <?= ($close ?? '') === '4pm' ? 'selected' : '' ?>>4pm</option>
                        <option value="5pm" <?= ($close ?? '') === '5pm' ? 'selected' : '' ?>>5pm</option>
                        <option value="6pm" <?= ($close ?? '') === '6pm' ? 'selected' : '' ?>>6pm</option>
                        <option value="7pm" <?= ($close ?? '') === '7pm' ? 'selected' : '' ?>>7pm</option>
                        <option value="8pm" <?= ($close ?? '') === '8pm' ? 'selected' : '' ?>>8pm</option>
                    </select>
                    <?php if (isset($errors['close'])): ?>
                        <div class="invalid-feedback" style="display:block;"><?= $errors['close'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label for="inputO_D" class="form-label">Open Days</label>
                    <select class="form-select <?= isset($errors['days']) ? 'is-invalid' : '' ?>" name="days" aria-label="Default select example">
                        <option>--Select Your Days--</option>
                        <option value="mon-tue" <?= ($days ?? '') === 'mon-tue' ? 'selected' : '' ?>>mon-tue</option>
                        <option value="mon-wed" <?= ($days ?? '') === 'mon-wed' ? 'selected' : '' ?>>mon-wed</option>
                        <option value="mon-thu" <?= ($days ?? '') === 'mon-thu' ? 'selected' : '' ?>>mon-thu</option>
                        <option value="mon-fri" <?= ($days ?? '') === 'mon-fri' ? 'selected' : '' ?>>mon-fri</option>
                        <option value="mon-sat" <?= ($days ?? '') === 'mon-sat' ? 'selected' : '' ?>>mon-sat</option>
                        <option value="24hr-x7" <?= ($days ?? '') === '24hr-x7' ? 'selected' : '' ?>>24hr-x7</option>
                    </select>
                    <?php if (isset($errors['days'])): ?>
                        <div class="invalid-feedback" style="display:block;"><?= $errors['days'] ?></div>
                    <?php endif; ?>
                </div>

                <div class="col-md-6">
                    <label for="inputImage" class="form-label">Image</label>

                    <input type="file" name="image" class="form-control <?= isset($errors['image']) ? 'is-invalid' : '' ?>">

                </div>

                <div class="col-12">
                    <label for="inputcategory" class="form-label">Select Category</label>
                    <select name="category" class="form-select <?= isset($errors['category']) ? 'is-invalid' : '' ?>">
                        <option>--Select Category--</option>
                        <?php
                        include "conn.php";
                        $sql = "SELECT * FROM res_category";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {

                            while ($row = mysqli_fetch_assoc($result)) {
                                $sel = ($category == $row['c_id']) ? 'selected' : '';
                                echo "<option value='{$row['c_id']}' $sel>{$row['c_name']}</option>";
                            }
                        }
                        ?>
                        <?php if (isset($errors['category'])): ?>
                            <div class="invalid-feedback" style="display:block;"><?= $errors['category'] ?></div>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="col-12">
                    <h5 style="color:darkgrey;">Restaurant Address
                        <hr>
                        </h3>
                        <textarea class="form-control" name="address" id="exampleFormControlTextarea1" rows="3">
                            <?= htmlspecialchars($address ?? '') ?>
                                      </textarea>
                        <?php if (isset($errors['address'])): ?>
                            <div style="color:red; font-size:0.9em;"><?= $errors['address'] ?></div>
                        <?php endif; ?>
                </div>


                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a class="btn btn-dark" href="all_resturant.php">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    </div>

</body>

</html>