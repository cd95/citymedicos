<!DOCTYPE html>
<?php
session_start();
include("functions/func.php");
?>
<html>
<head>
    <title></title>
    <style>
        .table>tbody>tr>td, .table>tfoot>tr>td{
    vertical-align: middle;
}
@media screen and (max-width: 600px) {
    table#cart tbody td .form-control{
        width:20%;
        display: inline !important;
    }
    .actions .btn{
        width:36%;
        margin:1.5em 0;
    }
    
    .actions .btn-info{
        float:left;
    }
    .actions .btn-danger{
        float:right;
    }
    
    table#cart thead { display: none; }
    table#cart tbody td { display: block; padding: .6rem; min-width:320px;}
    table#cart tbody tr td:first-child { background: #333; color: #fff; }
    table#cart tbody td:before {
        content: attr(data-th); font-weight: bold;
        display: inline-block; width: 8rem;
    }
    
    
    
    table#cart tfoot td{display:block; }
    table#cart tfoot td .btn{display:block;}
    
}
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
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" media="all" /> 
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
<nav id=nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">WebSiteName</a>
    </div>
    <ul class="nav navbar-nav">
      <li class="active"><a href="#">Home</a></li>
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
<h2 id="h2i">Your Cart!</h2>
<div class="container">
<form action="" method="post" enctype="multipart/form-data">
    <table id="cart" class="table table-hover table-condensed" align="center">
                    
                        <tr>
                            <th style="width:50%">Product</th>
                            <th style="width:10%">Remove</th>
                            <th style="width:10%">Price</th>
                            <th style="width:8%">Quantity</th>
                            
                            
                        </tr>
                        <?php 
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
      
      $product_title = $pp_price['product_title'];
      
      $product_image = $pp_price['product_image']; 
      
      $single_price = $pp_price['product_price'];
      
      $values = array_sum($product_price); 
      
      $total += $values; 
          
          ?>

                    
                        <tr>
                            <td data-th="Product">
                                <div class="row">
                                    <div class="col-sm-2 hidden-xs"><img src="admin_area/product_images/<?php echo $product_image;?>" width="60" height="60" alt="..." class="img-responsive"/></div>
                                    <div class="col-sm-10">
                                        <h4 class="nomargin"><?php echo $product_title; ?></h4>
                                        
                                    </div>
                                </div>
                            </td>
                            <td align="center"><input type="checkbox" name="remove[]" value="<?php echo $pro_id;?>"></td>
                            <td data-th="Price"><?php echo "$" . $single_price; ?></td>
                            <td><input type="text" size="4" name="qty" value="<?php echo $_SESSION['qty'];?>"/></td>
                            <?php 
            if(isset($_POST['update_cart'])){
            
              $qty = $_POST['qty'];
              
              $update_qty = "update cart1 set qty='$qty'";
              
              $run_qty = mysqli_query($con, $update_qty); 
              
              $_SESSION['qty']=$qty;
              
              $total = $total*$qty;
            }
            
            
            ?>
                            
                           
                        </tr>
                    
                    
                        <tr class="visible-xs">
                            
                        </tr>
                        <?php } } ?>
                        <tr>
                            <td><input type="submit" name="update_cart" value="Update Cart"/></td>
                            <td><input type="submit" name="continue" value="Continue Shopping" /></td>
                            
                            <td class="hidden-xs text-center"><strong><?php echo "$" . $total;?></strong></td>
                            <td><a href="checkout.php" class="btn btn-success btn-block">Checkout <i class="fa fa-angle-right"></i></a></td>
                        </tr>
                    
                </table>
                </form>
 <?php 
    
  function updatecart(){
    
    global $con; 
    
    $ip = getIp();
    
    if(isset($_POST['update_cart'])){
    
      foreach($_POST['remove'] as $remove_id){
      
      $delete_product = "delete from cart1 where p_id='$remove_id' AND ip_add='$ip'";
      
      $run_delete = mysqli_query($con, $delete_product); 
      
      if($run_delete){
      
      echo "<script>window.open('cart.php','_self')</script>";
      
      }
      
      }
    
    }
    if(isset($_POST['continue'])){
    
    echo "<script>window.open('index.php','_self')</script>";
    
    }
  
  }
  echo @$up_cart = updatecart();
  
  ?>

</div>
</body>

</html>