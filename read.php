<?php
include 'connect.php';
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Read</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <button class="btn btn-primary my-5"><a href="create.php" class="text-light">Add User</a></button>
        <table class="table" style="text-align: center">
            <thead>
                <tr>
                    <th scope="col">Sr No.</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">City</th>
                    <th scope="col">Operations</th>
                </tr>
            </thead>
            <tbody>

                <?php

                $sql = "SELECT * FROM `crud`";
                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    $num=0;
                    while ($row = mysqli_fetch_assoc($result)) {

                        $num++;
                        $id = $row['Sr No.'];
                        $name = $row['Name'];
                        $email = $row['Email'];
                        $phone = $row['Phone'];
                        $city = $row['City'];

                        echo '<tr>
            <th scope="row">' . $num . '</th>
            <td>' . $name . '</td>
            <td>' . $email . '</td>
            <td>' . $phone . '</td>
            <td>' . $city . '</td>
            <td>
    <button class="btn btn-primary"><a href="update.php?updateid=' . $id . '" class="text-light">Update</a></button>
    <button class="btn btn-danger"><a href="delete.php?deleteid=' . $id . '" class="text-light">Delete</a></button>
  </td>
          </tr>';
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

</html>