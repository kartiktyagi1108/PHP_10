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
    }
    ?>