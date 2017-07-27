<!DOCTYPE html>
<?php 
session_start();
include("functions/func.php");
include("includes/db.php"); 
?>
<html>
<head>
	<title>Registration</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" media="all" /> 
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
  	#cont1{
  		width: 100%;
  		padding-left: 0;
  		padding-right: 0;
  		padding-top: 0;
      margin-top: 0;
  	}
  	#nav{
  		padding-bottom: 0;
  	}
    #h2i{
      text-align: center;
      font-family: sans-serif;
    }
    #product{
      text-align: center;
    }
    #c1{
      text-align: center;
    }
  </style>
</head>
<body>
<nav id=nav class="navbar navbar-inverse">

  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">City Medicos</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="#">Home</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Catagories<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php getCats(); ?>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Brands<span class="caret"></span></a>
        <ul class="dropdown-menu">
          <?php getBrands() ?>
        </ul>
      </li>
        
    </ul>
    <ul class="nav navbar-nav navbar-right">
      <li><a href="#"><?php 
          if(isset($_SESSION['customer_email'])){
          echo "<b>Welcome:</b>" . $_SESSION['customer_email'];
          }
          else {
          echo "<b>Welcome Guest</b>";
          }
          ?></a></li>
       
        <li><a href="#">Total Price: <?php total_price(); ?></a></li> 
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
      <li><?php
      if (!isset($_SESSION['customer_email'])) {
        echo "<a href='checkout.php'>";
      }
      else
      {
        echo "<a href='customer/my_account.php'>";
      }


      ?><span class="glyphicon glyphicon-user"></span>My Account</a></li>
      <li><?php 
          if(!isset($_SESSION['customer_email'])){
          
          echo "<a href='checkout.php'>Login</a>";
          
          }
          else {
          echo "<a href='logout.php'>Logout</a>";
          }
          ?></li>
    </ul>
  </div>
</nav>
<form class="form-horizontal" action="customer_register.php" method="post" enctype="multipart/form-data">
<fieldset>

<!-- Form Name -->
<legend id="c1">Register</legend>

<!-- Text input-->
<div  class="form-group" action="customer_register.php" method="post" enctype="multipart/form-data">
  <label class="col-md-4 control-label" for="fn">Customer name</label>  
  <div class="col-md-4">
  <input id="fn" name="c_name" type="text" placeholder="Customer Name" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->


<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="cmpny">Email</label>  
  <div class="col-md-4">
  <input id="cmpny" name="c_email" type="text" placeholder="Email" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="email">Password</label>  
  <div class="col-md-4">
  <input id="email" name="c_pass" type="password" placeholder="password" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="add1">Customer Image</label>  
  <div class="col-md-4">
   <td><input type="file" name="c_image" required/></td>
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="add2">Country</label>  
  <div class="col-md-4">
  <input id="add2" name="c_country" type="text" placeholder="Country" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="city">City</label>  
  <div class="col-md-4">
  <input id="city" name="c_city" type="text" placeholder="city" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="zip">Contact</label>  
  <div class="col-md-4">
  <input id="zip" name="c_contact" type="text" placeholder="Contact" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="ctry">Address</label>  
  <div class="col-md-4">
  <input id="ctry" name="c_address" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->


<!-- Multiple Radios (inline) -->

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="submit"></label>
  <div class="col-md-4">
    <input type="submit" name="register" value="Create Account" />
  </div>
</div>

</fieldset>
</form>

</body>
</html>
<?php 
  if(isset($_POST['register'])){
  
    
    $ip = getIp();
    
    $c_name = $_POST['c_name'];
    $c_email = $_POST['c_email'];
    $c_pass = $_POST['c_pass'];
    $c_image = $_FILES['c_image']['name'];
    $c_image_tmp = $_FILES['c_image']['tmp_name'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
  
    
    move_uploaded_file($c_image_tmp,"customer/customer_images/$c_image");
    
     $insert_c = "insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image')";
  
    $run_c = mysqli_query($con, $insert_c); 
    
    $sel_cart = "select * from cart where ip_add='$ip'";
    
    $run_cart = mysqli_query($con, $sel_cart); 
    
    $check_cart = mysqli_num_rows($run_cart); 
    
    if($check_cart==0){
    
    $_SESSION['customer_email']=$c_email; 
    
    echo "<script>alert('Account has been created successfully, Thanks!')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
    
    }
    else {
    
    $_SESSION['customer_email']=$c_email; 
    
    echo "<script>alert('Account has been created successfully, Thanks!')</script>";
    
    echo "<script>window.open('checkout.php','_self')</script>";
    
    
    }
  }





?>