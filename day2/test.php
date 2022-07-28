<?php   
    if(empty($_GET['fname']) || empty($_GET['lname']) || empty($_GET['email']) || empty($_GET['address']) || !isset($_GET['gender']) || !isset($_GET['city']) || empty($_GET['skill']))
    {
        echo "Please complete your information";
    }
    elseif(is_numeric($_GET['fname']) || is_numeric($_GET['lname']))
    {
        echo "Please enter your information in a valid format";
    }
    else
    {  
        $firstName = $_GET['fname'];
        $lastName = $_GET['lname'];
        $email = $_GET['email'];
        $address = $_GET['address'];
        $gender = $_GET['gender'];
        $city = $_GET['city'];
        $skills = [];
        foreach($_GET['skill'] as $value)
        {
            $skills = $value;
        }
        $myskills = print_r($skills, " - ");
        $username = $_GET['username'];

        $newFile = fopen("customer.txt", "a");
        $newline = $firstName.','.$lastName.','.$email.','.$address.','.$city.','.$gender.','.$myskills.','.$username.','."\n";		
        fwrite($newFile, $newline);
        fclose($newFile);
    }


    $info=file("customer.txt");
    //var_dump($info);
    echo "<table border='2'>";
    echo "<tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>Email</th>
    <th>Address</th>
    <th>City</th>
    <th>Gender</th>
    <th>Skills</th>
    <th>Username</th>
    </tr>";
    foreach ($info as $user)
    {
        $data=explode(",",$user);
        foreach ($data as $val)
        {
            echo "<td>". $val."</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
?>