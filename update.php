<?php
include 'connect.php';


$id = $_GET['updateid'];    // Fetch id from URL

// Taking values from DB to show in update form
$sql = "SELECT * FROM `crud` WHERE `Sr No.` = '$id'";
$result = mysqli_query($conn, $sql);

$row = mysqli_fetch_assoc($result);

$nameq = $row['Name'];
$emailq = $row['Email'];
$phoneq = $row['Phone'];
$cityq = $row['City'];

// VALIDATION
function commonTask($data)
{
    $data = trim($data);                             // remove spaces
    $data = stripslashes($data);                     // remove back slashes
    $data = htmlspecialchars($data);                 // convert special characters into html entities
    return $data;
}

$nameError = $emailError = $phoneError = $cityError = "";       // set all the values empty
$name = $email = $phone = $city = "";

// Run after Submit
if (isset($_POST['submit'])) {

    // NAME VALIDATION
    if (empty($_POST['name'])) {
        $nameError = "Name is required";
    } else {
        $name = commonTask($_POST['name']);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
            $nameError = "Only letters and white space allowed";
        }
    }

    // EMAIL VALIDATION
    if (empty($_POST["email"])) {
        $emailError = "Email is required";
    } else {
        $email = commonTask($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format";
        }
    }

    // PHONE VALIDATION
    if (empty($_POST["phone"])) {
        $phoneError = "Phone number is mendatory";
    } else {
        $phone = commonTask($_POST["phone"]);
        if (preg_match("/^\d{3}-\d{3}-\d{4}$/", $phone)) {
            $phoneError = "Phone number should be contain ten digits";
        }
    }

    // CITY VALIDATION
    if (empty($_POST["city"])) {
        $cityError = "City name is required";
    } else {
        $city = commonTask($_POST["city"]);
        if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
            $cityError = "Only letters and white space allowed";
        }
    }

    if ($nameError == "" && $emailError == "" && $phoneError == "" && $cityError == "") {

        $sql = "UPDATE `crud` SET `Name` = '$name', `Email` = '$email', `Phone` = '$phone', `city` = '$city' WHERE `Sr No.` = '$id'";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
        } else {
            // echo "The record has been updated successfully";
            header('location:read.php');
        }
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD Practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .msg {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container my-5">

        <!-- form start -->

        <form method="post">
            <!-- NAME -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" value="<?php echo $nameq; ?>" aria-describedby="emailHelp">
                <span class="msg">* <?php echo $nameError; ?></span>
            </div>
            <!-- EMAIL -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" value="<?php echo $emailq; ?>" aria-describedby="emailHelp">
                <span class="msg">* <?php echo $emailError; ?></span>
            </div>
            <!-- PHONE -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $phoneq; ?>" aria-describedby="emailHelp">
                <span class="msg">* <?php echo $phoneError; ?></span>
            </div>
            <!-- CITY -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="city" class="form-control" name="city" id="city" value="<?php echo $cityq; ?>">
                <span class="msg">* <?php echo $cityError; ?></span>
            </div>
            <!-- BUTTON -->
            <button type="submit" name="submit" class="btn btn-primary">Update</button>
        </form>
        <!-- form end -->
    </div>
</body>

</html>