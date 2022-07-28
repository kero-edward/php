<?php
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
    $delete_user = "delete from user_info where id = " .$id. " LIMIT 1";
    if(mysqli_query($conn, $delete_user))
    {
        header("Location: users.php");
        exit;
    }
    else
        echo mysqli_error($conn);
    mysqli_close($conn);