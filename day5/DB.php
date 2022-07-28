<?php


$table_name ='';
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $id = $_POST['id'];
    $table_name = $_POST['table'];

  
}


class student{

    function __construct(){
        
        define("DB_HOST", "localhost");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_DATABASE", "faculty");
        try {
            $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);

            // checking errors
            if (mysqli_connect_errno()) {
                trigger_error(mysqli_connect_error());
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            } else {
            }
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }

    function insert_student($id,$name,$email){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $sql = "INSERT INTO students VALUES ('$id','$name','$email')";
        if (mysqli_query($conn, $sql)) {
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    function delete_student($id){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $sql = "DELETE FROM students WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    function update_student($id,$name,$email){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $sql = "UPDATE students set name='$name',email='$email' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
        } 
        else
        {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    function show_student(){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $result = mysqli_query($conn, "select * from students");
        echo '<table border=2> ';
        echo '<tr><th>id</th><th>name</th><th>email</th></tr>';
        while ($obj = mysqli_fetch_row($result)) {
            echo '<tr>';
            foreach ($obj as $i) {
                echo '<td>' . $i . '</td>';
            }
            echo '</tr>';
        }
    }


 
}

class professor{

    function __construct(){
        
        define("DB_HOST", "127.0.0.1");
        define("DB_USER", "root");
        define("DB_PASSWORD", "");
        define("DB_DATABASE", "faculty");
        try {
            $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);

            // checking errors
            if (mysqli_connect_errno()) {
                trigger_error(mysqli_connect_error());
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            } else {
            }
        } catch (Exception $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }


    }

    function insert_professor($id,$name,$email){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $sql = "INSERT INTO professors VALUES ('$id','$name','$email')";
        if (mysqli_query($conn, $sql)) {
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    function delete_professor($id){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $sql = "DELETE FROM professors WHERE id='$id'";
        if (mysqli_query($conn, $sql)) {
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    function update_professor($id,$name,$email){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $sql = "UPDATE professors set name='$name',email='$email' WHERE id=$id";
        if (mysqli_query($conn, $sql)) {
        } 
        else
        {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

    }

    function show_professor(){
        $conn = mysqli_connect(DB_HOST, 'root', DB_PASSWORD, DB_DATABASE, 3306);
        $result = mysqli_query($conn, "select * from professors");
        echo '<table border=2> ';
        echo '<tr><th>id</th><th>name</th><th>email</th></tr>';
        while ($obj = mysqli_fetch_row($result)) {
            echo '<tr>';
            foreach ($obj as $i) {
                echo '<td>' . $i . '</td>';
            }
            echo '</tr>';
        }
    }

}

//show professors table 

if($table_name == 'professors'|| isset($_POST['subprof'])||isset($_POST['upprof']) ){


    $objprof =new professor();

    if(isset($_POST['submit'])){
        $objprof->insert_professor($id,$name,$email);
    }

    echo '

    <h1 style="color:red;">Delete from professor table</h1>
    <form method="post">
            <input type="number" name="del_id" placeholder="delete professor id" >
            <input type="submit" name="subprof">
    </form>';

    echo '

    <h1 style="color:red;">Update professor table</h1>
    <form method="post">
            <input type="number" name="up_id" placeholder="enter id professor to update" ><br><br>
            <input type="text" name="up_name" placeholder="enter name professor to update" ><br><br>
            <input type="email" name="up_email" placeholder="enter email professor to update" ><br><br>
            <input type="submit" name="upprof">
    </form>';

    if(isset($_POST['subprof'])){
        $objprof->delete_professor( $_POST['del_id']);
        $table_name == 'professors';
    }

    if(isset($_POST['upprof'])){
        $objprof->update_professor($_POST['up_id'],$_POST['up_name'],$_POST['up_email']);
    }
    $objprof->show_professor();

}


// show  students table

if($table_name == 'students' || isset($_POST['sub'])||isset($_POST['up'])){
    $objstu =new student();
    if(isset($_POST['submit'])){
        $objstu->insert_student($id,$name,$email);
    }

    echo '

    <h1 style="color:red;">Delete from student table</h1>
    <form method="post">
            <input type="number" name="del_id" placeholder="delete student id" >
            <input type="submit" name="sub">
    </form>';

    echo '

    <h1 style="color:red;">Update student table</h1>
    <form method="post">
            <input type="number" name="up_id" placeholder="enter id student to update" ><br><br>
            <input type="text" name="up_name" placeholder="enter name student to update" ><br><br>
            <input type="email" name="up_email" placeholder="enter email student to update" ><br><br>
            <input type="submit" name="up">
    </form>';

    if(isset($_POST['sub'])){
        $objstu->delete_student( $_POST['del_id']);

    }

    if(isset($_POST['up'])){
        $objstu->update_student($_POST['up_id'],$_POST['up_name'],$_POST['up_email']);
    }
        $objstu->show_student();
}
