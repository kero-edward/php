<?php
    if ($_GET['gender'] == 'male')
        echo "Thanks Mr. ".$_GET['fname']." ".$_GET['lname'];
    else
        echo "Thanks Miss. ".$_GET['fname']." ".$_GET['lname'];

    echo "<br><br>";

    echo "Please Review Your Information<br><br>";

    echo "Name: ".$_GET['fname']." ".$_GET['lname']."<br>";

    echo "Address: ".$_GET['address']."<br>";

    if(!empty($_GET['skill'])) {
        echo "Your Skills: ";
        foreach($_GET['skill'] as $value){
            echo $value.'<br/>';
        }
    }

    echo "Department: ".$_GET['department']."<br>";
?>