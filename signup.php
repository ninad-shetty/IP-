<!DOCTYPE html>
<html lang="en">
<head>
  

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    
    <meta name="viewport"
              content="width=device-width,
                       initial-scale=1" />
    <meta charset="UTF-8">
    <style>
      li a {
        color: beige;

      }
    </style>  

    <title>Sign Up</title>
</head>
<body>
<style>
            
            .forma{

                padding: 20px;
                max-width: 500px;
                margin-top: 1000px;
                margin: auto;
                background-color: white;
                float: none;
                box-shadow: 5px 5px grey;

            }

        
        </style>
<nav class="navbar navbar-expand-lg navbar-light"  style="background-color: #663399;">
  <a class="navbar-brand" href="index.html">Tribazon</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item ">
        <a class="nav-link" href="index.html">Home </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="buyer.php">Buy</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Become A Seller</a>
      </li>
     
    </ul>
  </div>
</nav>
<!--Form to sign up-->
<div class = "forma">
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Enter username</label>
            <input type="text" name="username" id="username" value="" >
            <br>
            <span id="ava"></span>
            <br>
            <label >Enter your password</label>
            <input type="password" name ="password" value="">
            <br>
            <label >Confirm your password</label>
            <input type="password" name ="repassword" value="">
            <br>

            <input type ="submit" name="submit" value="Login">

        </form>
        <br>

    <!--Ajax to check availability of the username from the system-->
    <script>
        $(document).ready(function(){
            $('#username').blur(function(){
                
                var username = $(this).val();
                
                $.ajax({
                    url: "username.php",
                    method: "POST",
                    data:{username: username},
                    dataType: "text",
                    success:function(html)
                    {
                        $('#ava').html(html);
                    }


                });

            });

            
        });
    
    </script>
    <?php
    $mysqli = new mysqli('localhost','root','','items') or die($mysqli->connect_error);
    $table = 'users';
   $password = $repassword='';
    $checker= 0;
 if(isset($_POST['submit'])){
     //check if username field is empty else store the username in an variable.
    if(empty(trim($_POST['username']))){
        echo "<script>alert('Username cannot be empty')</script>";
    }
    else{
        $user_name=trim($_POST['username']);
    }
    //check if password is empty.
    if(empty(trim($_POST['password']))){
        echo "<script>alert('Password cannot be empty')</script>";
    }
    else{
        $password=$_POST['password'];
    }
    if(empty(trim($_POST['repassword']))){
        
        echo "<script>alert('Confirm password cannot be empty')</script>";
    }
    else{
        $repassword=$_POST['repassword'];
    }
    //check if the password and confirm password are the same or not.
    if($password!=$repassword){
        {
        
            echo "<script>alert('Passwords do not match')</script>";
            
        }
    }
    else{
       
        //hash the password before storing into database for safer and more secure password saving
        $hash_pass = password_hash($password, PASSWORD_DEFAULT);
        $checker = 1;
    }

    if(empty($user_name) or empty($hash_pass) or $checker==0){
        //final check if everything is proper
        echo "<script>alert('Please fill all details')</script>";

    }
    elseif($checker == 1){
        //insert the new user into the database
                 $sql1 = "INSERT INTO $table(username, password) VALUES ('$user_name', '$hash_pass')";
                $stmt = mysqli_prepare($mysqli,$sql1);
                $stmt->execute();
                echo "<script>alert('Account Created.')</script>";
    }
   

}
    
    ?>


</body>
