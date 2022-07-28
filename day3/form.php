<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Add User</h1>
    <form action="" method="POST" enctype="multipart/form-data">
        <label style="margin-right: 120px;" for="Name">Name </label>
        <input type="text" name="name">
        <span>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    if (empty($_POST["name"])) 
                        echo "<span style='color: red;'>Name is required!</span>";
                    else if (is_numeric($_POST["name"]))
                        echo "<span style='color: red;'>Not a valid format!</span>";
                    else
                        echo "<span style='color: green;'>Valid name!</span>";
                }
            ?>
        </span>
        <br><br>

        <label style="margin-right: 120px;" for="email">Email </label>
        <input type="text" name="email"> <!--Here i replaced email type with text type to make my own validation-->
        <span>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    #Method one to validate email is with email type in the input

                    /*==================================================================*/

                    #Method two to validate email is with filter_var function

                    // if (empty($_POST["email"])) 
                    //     echo "<span style='color: red;'>email is required!</span>";
                    // else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) 
                    //     echo "<span style='color: green;'>Valid email address.</span>";
                    // else 
                    //     echo "<span style='color: red;'>Not a valid email !</span>";

                    /*==================================================================*/

                    #Method three to validate email is with regex

                    if (empty($_POST["email"])) 
                        echo "<span style='color: red;'>email is required!</span>";
                    else if (preg_match("/^([a-zA-Z0-9]+)(\.[a-z0-9]+)*@([a-z0-9]+\.)+[a-z]{2,6}$/", $_POST['email']))
                        echo "<span style='color: green;'>Valid email</span>";
                    else
                        echo "<span style='color: red;'>Invalid email</span>";

                }
            ?>
        </span><br><br> 

        <label style="margin-right: 97px;" for="password">Password </label>
        <input type="password" name="password">
        <span>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    if (empty($_POST["password"])) 
                        echo "<span style='color: red;'>Password is required!</span>";
                    else
                        echo "<span style='color: green;'>Valid password.</span>";
                }
            ?>
        </span><br><br> 

        <label style="margin-right: 38px;" for="confirm_password">Confirm Password </label>
        <input type="password" name="confirm_password">
        <span>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    if (empty($_POST["confirm_password"])) 
                        echo "<span style='color: red;'>Password is required!</span>";
                    else if ($_POST["password"]===$_POST["confirm_password"])
                        echo "<span style='color: green;'>Password is matched.</span>";
                    else
                        echo "<span style='color: red;'>Password isn't matched.</span>";
                }
            ?>
        </span><br><br> 

        <label style="margin-right: 91px;" for="room">Room No.</label>
        <select name="room">
            <option disabled selected value> -- select an option -- </option>
            <option value="app1">Application1</option>
            <option value="app2">Application2</option>
            <option value="cloud">cloud</option>
        </select>
        <span>
            <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") 
                {
                    if (!isset($_POST["room"])) 
                        echo "<span style='color: red;'>Room number is required!</span>";
                    else
                        echo "<span style='color: green;'>Room number selected.</span>";
                }
            ?>
        </span><br><br>

        <label style="margin-right: 23px;" for="room">Select profile picture</label>
        <input type="file" name="file">
        <span>  
            <?php
                if(isset($_FILES["file"]))
                {
                    $errors= array();
                    $file_name = $_FILES['file']['name'];
                    $file_size =$_FILES['file']['size'];
                    $file_tmp =$_FILES['file']['tmp_name'];
                    $file_type=$_FILES['file']['type'];
                    
                    $ext=explode('.',$_FILES['file']['name']);
                    $file_ext=strtolower(end($ext));
                    
                    $extensions= array("jpeg","jpg","png");
                    if(in_array($file_ext,$extensions)=== true && $file_size < 2097152)
                    {
                        move_uploaded_file($file_tmp,"files/".$file_name);
                        echo "<span style='color: green;'>Success</span>";
                    }
                    else
                        echo "<span style='color: red;'>extension or size not allowed, please choose a JPEG or PNG file and max 2 MB!</span>";
                }
            ?>
        </span><br><br>

        <input type="submit" value="Submit">
        <input type="reset" value="Reset">
    </form>
</body>

</html>
<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $newFile = fopen("users.txt", "w");
        $newline = $_POST['name']."\n".$_POST['email']."\n".$_POST['room']."\n".$_POST['password'];		
        fwrite($newFile, $newline);
        fclose($newFile);
    }
?>