<!DOCTYPE html>
<?php 
session_start();

include("functions/func.php");

?>
<html>
<head>
	<title>payment</title>
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
      <a class="navbar-brand" href="index.php">CityMedicos</a>
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
       <li><a href="#">Total Items in cart: <?php total_items();?></a></li> 
        <li><a href="#">Total Price: <?php total_price(); ?></a></li> 
        <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span>Cart</a></li>
      <li><a href="customer/my_account.php"><span class="glyphicon glyphicon-user"></span>My Account</a></li>
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
<div>
<?php 
    include("includes/db.php"); 
    
    $total = 0;
    
    global $con; 
    
    $ip = getIp(); 
    
    $sel_price = "select * from cart1 where ip_add='$ip'";
    
    $run_price = mysqli_query($con, $sel_price); 
    
    while($p_price=mysqli_fetch_array($run_price)){
      
      $pro_id = $p_price['p_id']; 
      
      $pro_price = "select * from products where product_id='$pro_id'";
      
      $run_pro_price = mysqli_query($con,$pro_price); 
      
      while ($pp_price = mysqli_fetch_array($run_pro_price)){
      
      $product_price = array($pp_price['product_price']);
      
      $product_name = $pp_price['product_title'];
      
      $values = array_sum($product_price);
      
      $total +=$values;
      
}
}

      // getting Quantity of the product 
      $get_qty = "select * from cart1 where p_id='$pro_id'";
      
      $run_qty = mysqli_query($con, $get_qty); 
      
      $row_qty = mysqli_fetch_array($run_qty); 
      
      $qty = $row_qty['qty'];
      
      if($qty==0){
      
      $qty=1;
      }
      else {
      
      $qty=$qty;
      
      }


?>
<h2 align="center" style="padding:2px;">Pay now with Paypal:</h2>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post" >

<!-- Identify your business so that you can collect the payments. -->
<input type="hidden" name="business" value="sriniv_1293527277_biz@inbox.com">

<!-- Specify a Buy Now button. -->
<input type="hidden" name="cmd" value="_xclick">

<!-- Specify details about the item that buyers will purchase. -->
<input type="hidden" name="item_name" value="<?php echo $product_name; ?>">
<input type="hidden" name="item_number" value="<?php echo $pro_id; ?>">
<input type="hidden" name="amount" value="<?php echo $total; ?>">
<input type="hidden" name="quantity" value="<?php echo $qty; ?>">
<input type="hidden" name="currency_code" value="USD">

<input type="hidden" name="return" value="http://www.onlinetuting.com/myshop/paypal_success.php"/>
<input type="hidden" name="cancel_return" value="http://www.onlinetuting.com/myshop/paypal_cancel.php"/>

<!-- Display the payment button. -->
<input type="image" name="submit" border="0"
src="paypal_button.png"
alt="PayPal - The safer, easier way to pay online">
<img alt="" border="0" width="1" height="1"
 src="http://www.yogawhite.com/wp-content/uploads/2015/05/paypal-checkout-button-300x156.png" >

</form>

</div>
</body>
</html>