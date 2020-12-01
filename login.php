<!DOCTYPE html>
<html lang="en">
<head>
  

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
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

    <title>Login</title>
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
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Become A Seller<span class="sr-only">(current)</span></a>
      </li>
     
    </ul>
  </div>
</nav>
<!--login form-->
    <div class = "forma">
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Enter username</label>
            <input type="text" name="username" value="" >
            <br>
            <label >Enter your password</label>
            <input type="password" name ="l_password" value="">
            <br>
            <input type ="submit" name="login" value="Login">

        </form>
        <br>
        <p>Dont have an account?<a href= "signup.php">Sign up</a></p>
    </div>

    <?php
    $mysqli = new mysqli('localhost','root','','items') or die($mysqli->connect_error);
    $table = 'users';
    if(isset($_POST['login'])){
        $user_name = $_POST['username'];
        $s_user = $s_pass = '';
        $l_pass = $_POST['l_password'];
        //get username from database
        $sql  = "SELECT * FROM users WHERE username = '$user_name'";
        $result = mysqli_query($mysqli, $sql);
        //put the data from the query into $data to be used 
        $data = $result-> fetch_assoc();
        $user = $data['username'];
        $pass = $data['password'];
        //check if username nputted is there in the sellers database
        if(mysqli_num_rows($result)>0){
             //check if the passord taken from the table, dehashed, is the same as inputted.
            if(password_verify($l_pass, $pass)){
               //if true redirect to the seller.php page
                header("location: Sellers.php");
            }
            else{
                echo "Incorrect password";
            }
            
        }
        else{
            echo "<span>Incorrect username</span>";
        }



    }



            
    ?>

</body>