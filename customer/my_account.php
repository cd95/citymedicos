<!DOCTYPE html>
<?php 
session_start();
include("../functions/func.php");

?>
<html>
<head>
	<title>my account</title>
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
    /***
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
***/

body {
  background: #F1F3FA;
}

/* Profile container */
.profile {
  margin: 20px 0;
}

/* Profile sidebar */
.profile-sidebar {
  padding: 20px 0 10px 0;
  background: #fff;
}

.profile-userpic img {

  float: none;
  margin: 0 auto;
  width: 50%;
  height: 50%;
  -webkit-border-radius: 50% !important;
  -moz-border-radius: 50% !important;
  border-radius: 50% !important;
}

.profile-usertitle {
  text-align: center;
  margin-top: 20px;
}

.profile-usertitle-name {
  color: #5a7391;
  font-size: 16px;
  font-weight: 600;
  margin-bottom: 7px;
}

.profile-usertitle-job {
  text-transform: uppercase;
  color: #5b9bd1;
  font-size: 12px;
  font-weight: 600;
  margin-bottom: 15px;
}

.profile-userbuttons {
  text-align: center;
  margin-top: 10px;
}

.profile-userbuttons .btn {
  text-transform: uppercase;
  font-size: 11px;
  font-weight: 600;
  padding: 6px 15px;
  margin-right: 5px;
}

.profile-userbuttons .btn:last-child {
  margin-right: 0px;
}
    
.profile-usermenu {
  margin-top: 30px;
}

.profile-usermenu ul li {
  border-bottom: 1px solid #f0f4f7;
}

.profile-usermenu ul li:last-child {
  border-bottom: none;
}

.profile-usermenu ul li a {
  color: #93a3b5;
  font-size: 14px;
  font-weight: 400;
}

.profile-usermenu ul li a i {
  margin-right: 8px;
  font-size: 14px;
}

.profile-usermenu ul li a:hover {
  background-color: #fafcfd;
  color: #5b9bd1;
}

.profile-usermenu ul li.active {
  border-bottom: none;
}

.profile-usermenu ul li.active a {
  color: #5b9bd1;
  background-color: #f6f9fb;
  border-left: 2px solid #5b9bd1;
  margin-left: -2px;
}

/* Profile Content */
.profile-content {
  padding: 20px;
  background: #fff;
  min-height: 460px;
}
#cent{
	text-align: center;
	margin: auto;
	font-family: sans-serif;
	}	
  .red{
    color:red;
    }
.form-area
{
    background-color: #FAFAFA;
  padding: 10px 40px 60px;
  margin: 10px 0px 60px;
  border: 1px solid GREY;
  }
  #s1{
    text-align: center;
  }
  </style>

</head>
<body>
<nav id=nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="../index.php">CityMedicos</a>
    </div>
    <ul class="nav navbar-nav">
      <li ><a href="../index.php">Home</a></li>
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
      <li><a href="my_account.php"><span class="glyphicon glyphicon-user"></span>My Account</a></li>
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
<!--
User Profile Sidebar by @keenthemes
A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
Licensed under MIT
-->
<?php 
        $user = $_SESSION['customer_email'];
        
        $get_img = "select * from customers where customer_email='$user'";
        
        $run_img = mysqli_query($con, $get_img); 
        
        $row_img = mysqli_fetch_array($run_img); 
        
        $c_image = $row_img['customer_image'];
        
        $c_name = $row_img['customer_name'];
?>
<div class="container">
    <div class="row profile">
		<div class="col-md-3">
			<div class="profile-sidebar">
				<!-- SIDEBAR USERPIC -->
				<div class="profile-userpic">
				<<?php  echo "img src='c_image/$c_image'"; ?> class="img-responsive" alt="">
					
				</div>
				<!-- END SIDEBAR USERPIC -->
				<!-- SIDEBAR USER TITLE -->
				<div class="profile-usertitle">
					<div class="profile-usertitle-name">
						<?php echo $c_name;?>
					</div>
					
				</div>
				<!-- END SIDEBAR USER TITLE -->
				<!-- SIDEBAR BUTTONS -->
				<div class="profile-userbuttons">
					
					<a href="logout.php"><button type="button" class="btn btn-danger btn-sm">Logout</button></a>
				</div>
				<!-- END SIDEBAR BUTTONS -->
				<!-- SIDEBAR MENU -->
				<div class="profile-usermenu">
					<ul class="nav">
						<li class="active">
							<a href="my_account.php?my_orders">
							<i class="glyphicon glyphicon-home"></i>
							My Orders </a>
						</li>
						<li>
							<a href="my_account.php?edit_account">
							<i class="glyphicon glyphicon-user"></i>
							Edit Account </a>
						</li>
						<li>
							<a href="my_account.php?change_pass" target="_blank">
							<i class="glyphicon glyphicon-ok"></i>
							Change Password </a>
						</li>
						<li>
							<a href="my_account.php?delete_account">
							<i class="glyphicon glyphicon-flag"></i>
							Delete Account</a>
						</li>
					</ul>
				</div>
				<!-- END MENU -->
			</div>
		</div>
		<div class="col-md-9">
            <div class="profile-content">
			    <?php 
        if(!isset($_GET['my_orders'])){
          if(!isset($_GET['edit_account'])){
            if(!isset($_GET['change_pass'])){
              if(!isset($_GET['delete_account'])){
              
        echo "
        <div id='cent'>
        <h2>Welcome:  $c_name </h2>
        <b>You can see your orders progress by clicking this <a href='my_account.php?my_orders'>link</a></b>
        </div>";
        }
        }
        }
        }
        ?>
        
        <?php 
        if(isset($_GET['edit_account'])){
        include("edit_account.php");
        }
        if(isset($_GET['change_pass'])){
        include("change_pass.php");
        }
        if(isset($_GET['delete_account'])){
        include("delete_account.php");
        }
        
        
        ?>
            </div>
		</div>
	</div>
</div>

</body>
</html>