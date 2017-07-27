<!DOCTYPE html>
<?php
include("functions/func.php");
?>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" media="all"/>

</head>
<body>

<div class="jumbotron">
  <div class="container text-center">
    <img id="im1"src="images/pedigree.jpg"/>
  </div>
</div>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="#">Logo</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav">
        <li class="active"><a href="index.php">Home</a></li>
        <li><a href="all_products.php">Products</a></li>
        <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Catagory
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php getCats(); ?>
        </ul>
      </li>
      <li class="dropdown">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Brand
        <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php getBrands() ?>
        </ul>
      </li>
        <li><a href="#">Contact</a></li>
      </ul>
      <form class="navbar-form navbar-left">
  <div class="input-group">
    <input type="text" class="form-control" placeholder="Search">
    <div class="input-group-btn">
      <button class="btn btn-default" type="submit">
        <i class="glyphicon glyphicon-search"></i>
      </button>
    </div>
  </div>
</form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Your Account</a></li>
        <li><a href="#"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">    
  <?php 
  $get_pro = "select * from products";

  $run_pro = mysqli_query($con, $get_pro); 
  
  while($row_pro=mysqli_fetch_array($run_pro)){
  
    $pro_id = $row_pro['product_id'];
    $pro_cat = $row_pro['product_cat'];
    $pro_brand = $row_pro['product_brand'];
    $pro_title = $row_pro['product_title'];
    $pro_price = $row_pro['product_price'];
    $pro_image = $row_pro['product_image'];
  
    echo "
       <div id='card'>
                <a href='details.php?pro_id=$pro_id'><img id='img-card' src='admin_area/product_images/$pro_image' width='200' height='200' /></a>
                 <br />
                <div id='card-content'>
                    <h4 id='card-title'>
                      $pro_title    
                    </h4>
                    <div>
                      Price: $ $pro_price    
                    </div>
                </div>
                <div id='card-read-more'>
                    <a href='index.php?add_cart=$pro_id'><button id='btn'>Add to Cart</button></a>
                </div>
            </div>
    
    
    
    ";
  
  }
  ?>
</div><br><br>

<footer class="container-fluid text-center">
  <p>Online Store Copyright</p>  
  <form class="form-inline">Get deals:
    <input type="email" class="form-control" size="50" placeholder="Email Address">
    <button type="button" class="btn btn-danger">Sign Up</button>
  </form>
</footer>

</body>
</html>
