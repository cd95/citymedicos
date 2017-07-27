<!DOCTYPE html>
<?php 
session_start();
include("functions/func.php");

?>
<html>
<head>
	<title>SUCCESS</title>
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
  </style>
</head>
<body>
<nav id=nav class="navbar navbar-inverse">

  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php">City Medicos</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="index.php">Home</a></li>
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
<div id="product">
	<h2>Payment Successful!Please go back to your account</h2>
	<a href="customer/my_account.php">Go to your account</a>
</div>
</body>
</html>