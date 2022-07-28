<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Cafeteria</h1>
    <form action="" method="POST">
        <label style="margin-right: 120px;" for="email">Email </label>
        <input type="email" name="email"> 
        <span>
            <?php
                
            ?>
        </span><br><br> 

        <label style="margin-right: 97px;" for="password">Password </label>
        <input type="password" name="password">
        <span>
            <?php
                
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
        $handle = fopen("users.txt", "r");
        $filesize = filesize('users.txt');
        $i=0;
        while(!feof($handle))
        {
            $info[$i++] =  fgets($handle);
        }
        if (trim($_POST['email']) == trim($info[1]) && trim($_POST['password']) == trim($info[3]))
        {
            session_start();
            $_SESSION["name"]= $info[0];
            $_SESSION["email"]= $_POST["email"];
            $_SESSION["password"]=$_POST["password"];
            echo "Login successfully!, Welcome ".$_SESSION["name"];
        }
        else
            echo "Email or Password incorrect!";

        
    }
?>