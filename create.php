<?php include 'connect.php'; ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .msg {
            color: red;
        }
    </style>
</head>

<body>

    <?php
    function commonTask($data)
    {
        $data = trim($data);                             // remove spaces
        $data = stripslashes($data);                     // remove back slashes
        $data = htmlspecialchars($data);                 // convert special characters into html entities
        return $data;
    }

    $nameError = $emailError = $phoneError = $cityError = "";       // set all the values empty
    $name = $email = $phone = $city = "";

    // VALIDATION
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // NAME VALIDATION
        if (empty($_POST["name"])) {
            $nameError = "Name is required";
        } else {
            $name = commonTask($_POST["name"]);
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
            $cityError = "Name is required";
        } else {
            $city = commonTask($_POST["city"]);
            if (!preg_match("/^[a-zA-Z-' ]*$/", $city)) {
                $cityError = "Only letters and white space allowed";
            }
        }

        if ($nameError == "" && $emailError == "" && $phoneError == "" && $cityError == "") {

            $sql = "INSERT INTO `crud` (`Name`, `Email`, `Phone`, `City`) VALUES ('$name', '$email', $phone, '$city')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                echo "The record was not inserted successfully because of this error ---> " . mysqli_error($conn);
            }
            else{
                header("location:read.php");
            }
        }
    }
    ?>

    <div class="container my-5">

        <!-- form start -->

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <!-- NAME -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" name="name" id="name" placeholder="Enter your name" aria-describedby="emailHelp">
                <span class="msg">* <?php echo $nameError; ?></span>
            </div>
            <!-- EMAIL -->
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Enter your email" aria-describedby="emailHelp">
                <span class="msg">* <?php echo $emailError; ?></span>
            </div>
            <!-- PHONE -->
            <div class="mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Enter your phone number" aria-describedby="emailHelp">
                <span class="msg">* <?php echo $phoneError; ?></span>
            </div>
            <!-- CITY -->
            <div class="mb-3">
                <label for="city" class="form-label">City</label>
                <input type="city" class="form-control" name="city" placeholder="Enter your city">
                <span class="msg">* <?php echo $cityError; ?></span>

            </div>
            <!-- BUTTON -->
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>

        <!-- form end -->
    </div>
</body>

</html>