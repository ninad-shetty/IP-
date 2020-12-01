<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Buy</title>
</head>
<body>
  <style>
    
    .card {
  background-color: white;
  padding: 20px;
  margin-top: 20px;
  margin-right: 10px;
}
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
      <li class="nav-item active">
        <a class="nav-link" href="buyer.php">Buy<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Become A Seller</a>
      </li>
     
    </ul>
  </div>
</nav>
<!--Form for the customer's details-->
<div class = "forma">
        <form action="" method="POST" enctype="multipart/form-data">
            
            <label >Enter your name</label>
            <input type="text" name ="c_name" value="">
            <br>
            <label >Your Address</label>
            <input type="text" name ="c_add" value="">
            <br>
            <input type ="submit" name="submit" value="Buy">
        </form>

<?php
//php connect to ddatabase
$mysqli = new mysqli('localhost','root','','items') or die($mysqli->connect_error);
$table1 = 'items_img';//items_img table from database
$cust = 'customer';//the customer table
$id = $_GET['d'];
//Insert the customer details into the database table customer.
if(isset($_POST["submit"])){
  if(empty($_POST['c_name']) or empty($_POST['c_add'])){
    echo "<script>alert('Fill all details')</script>";
  }
  else{
        $sql = "INSERT INTO $cust(c_name,c_add, p_id) VALUES ( ?, ?, '$id')";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("ss",$_POST['c_name'],$_POST['c_add']);
        $stmt->execute();
                // delete the entry of the product frome the items_img table so no one else can order it.
                $sql1 = "DELETE FROM $table1 WHERE id = '$id'";
                $stmt = mysqli_prepare($mysqli,$sql1);
                $stmt->execute();
                echo "<script>alert('Your order has been placed')</script>";
                //redirect to the buy page to prevent more than one order of the same product from the same person/page
                header("location: buyer.php");
  }          
               

}

?>


<a href="buyer.php"> back to buying page</a>
</html>
