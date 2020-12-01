<?php
    $mysqli = new mysqli('localhost','root','','items') or die($mysqli->connect_error);
    $table = 'users';
    //ajax continuation to check username availability.
    if(isset($_POST['username'])){
        $user_name = $_POST['username'];
        $sql  = "SELECT * FROM users WHERE username = '$user_name'";
        $result = mysqli_query($mysqli, $sql);
        // check the number of rows with $result values in it if it is more than 1, username is not available.
        if(mysqli_num_rows($result)>0){
            echo "<span style='color: red;'>Username is already taken</span>";
        }
        else{
            echo "<span style='color: green;'>Username available</span>";
        }



    }
    
    
?>