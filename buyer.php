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
 </style>
<!--NavBar design and hrefs -->
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
        <a class="nav-link" href="#">Buy<span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="login.php">Become A Seller</a>
      </li>
     
    </ul>
  </div>
</nav>

<?php
//connect to the Database
    $mysqli = new mysqli('localhost','root','','items') or die($mysqli->connect_error);
    $table = 'items_img';
//make a query to store the row in result
    $result = $mysqli->query("SELECT * FROM $table") or die($mysqli ->error);
//while there are rows available store its data into $data to show up as cards.
    while($data = $result-> fetch_assoc()){
        
        echo "<div class='card' style='width: 18rem; float: left;margin-right: 10px;'>";
        //$data['img'] calls image from the database and similarly for other details of the product
        echo "<img src='{$data['img']}' class='card-img-top' alt='...'>";
        echo  "  <div class='card-body'>";
        echo    "  <h5 class='card-title'>{$data['product_name']}</h5>";
        echo    "  <h5>Rs. {$data['product_cost']}</h5>";
                 echo "<p class='card-text'>{$data['description']}</p>";
                 echo "<p>Seller: {$data['seller_name']}</p>";                   
                   //redirect to the buy_page.php for further processing.
                 echo" <a href='buy_page.php?d={$data['id']}' class='btn btn-primary'>Order Now</a>";
        echo  "  </div>";
        echo"</div>";
    }
?>
</body>