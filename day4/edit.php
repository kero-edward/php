<?php
    $error_fields = array();
    try 
    {
        $conn = mysqli_connect("localhost", "root", "", "users");
        if (mysqli_connect_errno()) 
        {
            trigger_error(mysqli_connect_error());
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
    } 
    catch (Exception $e) 
    {
        echo 'Connection failed: ' . $e->getMessage();
    }

    $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    $dispaly_user = "select * from user_info where id = " .$id. " LIMIT 1";
    $display = mysqli_query($conn, $dispaly_user);
    $row = mysqli_fetch_assoc($display);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') 
    {
        // Validations
        if (empty($_POST["name"]))
            $error_fields[] = "name1";
        else if (is_numeric($_POST["name"]))
            $error_fields[] = "name1";
        
        if (empty($_POST["email"])) 
            $error_fields[] = "email1";

        if (empty($_POST["password"])) 
            $error_fields[] = "password1";

        else if ($_POST["password"]!==$_POST["confirm_password"])
            $error_fields[] = "password2";

        if (!isset($_POST["room"]))                 
            $error_fields[] = "room";

        /*=============================================================================*/
        if (!$error_fields)
        {
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
            $name=mysqli_escape_string($conn, $_POST['name']);
            $password=mysqli_escape_string($conn, $_POST['password']);
            $email=mysqli_escape_string($conn, $_POST['email']);
            $room=mysqli_escape_string($conn, $_POST['room']);
            $update_user = "update user_info set name = '".$name."', password = '".$password."',email = '".$email."',room = '".$room."'where id = ". $id;
            if (mysqli_query($conn, $update_user))
            {
                header("Location: users.php");
                exit;
            }
            else
                echo "<span style='color: red;'>Failed to add new user, </span>" . mysqli_connect_error();
        }
        else
            echo "<span style='color: red;'>Failed to update user, Please check all inputs!</span>";
    }
    mysqli_free_result($display);
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit users</title>
</head>

<body>
    <h1>Edit User</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= (isset($row['id']) ? $row['id'] : '') ?>">

        <label style="margin-right: 120px;" for="Name">Name </label>
        <input type="text" name="name" value="<?= (isset($row['name']) ? $row['name'] : '') ?>">
        <span>
            <?php 
                if (in_array("name1", $error_fields)) 
                    echo "<span style='color: red;'>Name is required!</span>";
                else if (in_array("name2", $error_fields)) 
                    echo "<span style='color: red;'>Not a valid format!</span>";
            ?>
        </span>
        <br><br>

        <label style="margin-right: 120px;" for="email">Email </label>
        <input type="email" name="email" value="<?= (isset($row['email']) ? $row['email'] : '') ?>">
        <span>
            <?php
                if (in_array("email1", $error_fields)) 
                    echo "<span style='color: red;'>email is required!</span>";
            ?>
        </span><br><br> 

        <label style="margin-right: 97px;" for="password">Password </label>
        <input type="password" name="password">
        <span>
            <?php
                if (in_array("password1", $error_fields)) 
                    echo "<span style='color: red;'>Password is required!</span>";
                
            ?>
        </span><br><br> 

        <label style="margin-right: 38px;" for="confirm_password">Confirm Password </label>
        <input type="password" name="confirm_password">
        <span>
            <?php
                if (in_array("password1", $error_fields)) 
                    echo "<span style='color: red;'>Password is required!</span>";
                else if (in_array("password2", $error_fields))
                    echo "<span style='color: red;'>Password isn't matched!</span>";
            ?>
        </span><br><br> 

        <label style="margin-right: 91px;" for="room">Room No.</label>
        <select name="room" value="<?= (isset($row['room']) ? $row['room'] : '') ?>">
            <option disabled selected value> -- select an option -- </option>
            <option value="app1">Application1</option>
            <option value="app2">Application2</option>
            <option value="cloud">cloud</option>
        </select>
        <span>
            <?php
                if (in_array("room", $error_fields)) 
                    echo "<span style='color: red;'>Room number is required!</span>";
            ?>
        </span><br><br>

        <input type="submit" value="Submit" name="add">
        <input type="reset" value="Reset">
    </form>
</body>

</html>