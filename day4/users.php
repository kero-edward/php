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
    $dispaly_users = "select * from user_info";
    $dispaly = mysqli_query($conn, $dispaly_users);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All users</title>
    <style>
        table, th, td {
            border: 1px solid black;
        }
    </style>
</head>
<body>
    <h1>Our users</h1>
    <table>
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Room</th>
            </tr>
        </thead>
        <?php
            while ($row = mysqli_fetch_assoc($dispaly)) 
            {
        ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name'] ?></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['room'] ?></td>
                    <td>
                        <a href="edit.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="delete.php?id=<?= $row['id'] ?>">Delete</a>
                    </td>
                </tr>
        <?php    
            }
        ?>
        <tfoot>
            <tr>
                <td colspan="5" style="text-align: center;">
                    <a href="form.php">Add new user</a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>
<?php
    mysqli_close($conn);
?>