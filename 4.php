<!DOCTYPE html>
<?php
session_start();
include("functions/func.php");
include("includes/db.php");
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
          <?php getBrands(); ?>
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
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>
      </ul>
    </div>
  </div>
</nav>

<div class="container">   
<form action="customer_register.php" method="post" enctype="multipart/form-data">
  <table align="center" width="750">

  <tr>
    <td>
      <h2>
        Create an account!
      </h2>
    </td>
  </tr>

  <tr>
    <td align="right">
      customer name:
    </td>
    <td>
      <input type="text" name="c_name" required/>
    </td>
  </tr>
  <tr>
    <td align="right">
      customer email:
    </td>
    <td>
      <input type="text" name="c_email" required>
    </td>
  </tr>
  <tr>
    <td align="right">
      customer password:
    </td>
    <td>
      <input type="password" name="c_pass" required>
    </td>
  </tr>
  <tr>
    <td align="right">customer image</td>
    <td><input type="file" name="c_image"></td>
  </tr>
  <tr>
    <td align="right">
      customer country:
    </td>
    <td>
      <select name="c_country">
        <option>select a country</option>
        <option>afhganistan</option>
        <option>india</option>
        <option>japan</option>
        <option>usa</option>
        <option>uk</option>
      </select>
    </td>
  </tr>
  <tr>
    <td align="right">
      customer city:
    </td>
    <td>
      <input type="text" name="c_city">
    </td>
  </tr>
    <tr>
      <td align="right">customer contact:</td>
      <td><input type="text" name="c_contact"></td>
    </tr>
  <tr>
    <td align="right">customer address</td>
    <td><textarea cols="20" rows="10" name="c_address">  
    </textarea></td>
  </tr>

  <tr>
    <td align="right"><input type="submit" name="register" value="create account"></td>
  </tr>
  </table>

</form>

</div><br><br>



</body>
</html>
<?php

if(isset($_POST['register'])){

$ip=getIp();
$c_name=$_POST['c_name'];
$c_email=$_POST['c_email'];
$c_pass=$_POST['c_pass'];
$c_image=$_FILES['c_image']['name'];
$c_image_tmp=$_FILES['c_image']['tmp_name'];
$c_country=$_POST['c_country'];
$c_city=$_POST['c_city'];
$c_contact=$_POST['c_contact'];
$c_address=$_POST['c_address'];

move_uploaded_file($c_image_tmp,"customer/c_image/$c_image");

$insert_c="insert into customers (customer_ip,customer_name,customer_email,customer_pass,customer_country,customer_city,customer_contact,customer_address,customer_image) values ('$ip','$c_name','$c_email','$c_pass','$c_country','$c_city','$c_contact','$c_address','$c_image') ";

$run_c=mysqli_query($con,$insert_c);

$sel_cart="select * from cart where ip_add='$ip'";

$run_cart=mysqli_query($con,$sel_cart);

$check_cart=mysqli_num_rows($run_cart);

if($check_cart==0)
{
  $_SESSION['customer_email']=$c_email;
  echo "<script>alert('account ahas been created successfully!')</script>";
  echo "<script>window.open('customer/my_account.php','_self')</script>";
}
else
{
  $_SESSION['customer_email']=$c_email;
  echo "<script>alert('account ahas been created successfully!')</script>";
  echo "<script>window.open('checkout.php','_self')</script>";
}

}





?>
