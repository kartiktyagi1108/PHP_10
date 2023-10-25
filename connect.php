<?php
    // Error Reporting
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
    
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "crudoperation";

    $conn = mysqli_connect($servername, $username, $password, $database) or die("Sorry failed to connect : ".mysqli_connect_error());
?>