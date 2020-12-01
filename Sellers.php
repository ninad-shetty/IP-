<!DOCTYPE html>
<html>
    <title></title>
    <head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <title>Sellers</title>
</head>
    <body style = "background-color: #d3d3d3;">
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
        <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="buyer.php">Buy</a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="login.php">Become A Seller</a>
      </li>
     
          </ul>
        </div>
    </nav>
<!--Seller's and their product's detail form-->
    <div class = "forma">
        <form action="" method="POST" enctype="multipart/form-data">
            <label>Enter product photo</label>
            <input type="file" name="userfile[]" value="" multiple="">
            <label >Enter your name</label>
            <input type="text" name ="seller_name" value="">
            <br>
            <label >Enter Product name</label>
            <input type="text" name ="product_name" value="">
            <br>
            <label >Enter Product Cost</label>
            <input type="text" name ="product_cost" value="">
            <br>
            <label >Product Description</label>
            <input type="text" name ="description" value="">
            <br>
            <input type ="submit" name="submit" value="upload">
        </form>
</div>
<?php
$mysqli = new mysqli('localhost','root','','items') or die($mysqli->connect_error);
$table = 'items_img';




//checkc if files are uploaded.
if(isset($_FILES['userfile'])){
    $file_array = rearr($_FILES['userfile']);
    
    for($i=0;$i<count($file_array);$i++){
        if($file_array[$i]['error']){
            echo "<script>alert('Please fill all the fields')</script>";
        }
        else{
            $extensions = array('jpg','png','jpeg','gif');//allow files with only these extensions to be uploaded
            $file_ext = explode('.',$file_array[$i]['name']);

            $name = $file_ext[0];

            $file_ext = end($file_ext);
            if(!in_array($file_ext,$extensions)){
                echo 'error in extension';
            }
            else{
                if(empty($_POST['product_name']) or empty($_POST['product_cost']) or empty($_POST['seller_name']) or empty($_POST['description'])){
                    echo "<script>alert('Please fill all details')";
                }
                else{
                $img_dir ="seller_image/".$file_array[$i]['name'];
                
                
                //insert into database the seller and product details

                $sql = "INSERT INTO $table(name,img, product_name, product_cost, seller_name, description) VALUES ('$name','$img_dir', ?, ?, ?, ?)";
                $stmt = $mysqli->prepare($sql);
                $stmt->bind_param("ssss",$_POST['product_name'],$_POST['product_cost'],$_POST['seller_name'], $_POST['description']);
                $stmt->execute();
                



                move_uploaded_file($file_array[$i]['tmp_name'], "seller_image/".$file_array[$i]['name']);
                echo "<script>alert('Your Product has been placed')</script>";
                }
            }
        }
    }

}
//makes the file into filename and extension
function rearr($file_post){
    $file_ary= array();
    $file_count = count($file_post['name']);
    $file_keys = array_keys($file_post);

    for($i=0; $i<$file_count; $i++){
        foreach($file_keys as $key){
            $file_ary[$i][$key] = $file_post[$key][$i];
        }
    }
    return $file_ary;
}
?>
</body>




