<?php
include 'connect.php';

    if(isset($_GET['deleteid'])){       // Access the parameters from the URL
        $id = $_GET['deleteid'];
        
        $sql = "DELETE FROM `crud` WHERE `Sr No.` = $id";
        $result = mysqli_query($conn, $sql);

        if($result){
            // echo "Deleted successfully";
            header('location: read.php');
        }
        else{
            echo "Not deleted";
        }
    }
?>