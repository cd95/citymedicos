<!DOCTYPE html>
<?php 
session_start();

include("includes/db.php");
?>
<html>
<head>
	<title>Customer Login</title>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="styles/style.css" media="all" /> 
  <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
  <style>
    @charset "utf-8";
/* CSS Document */

/* ---------- FONTAWESOME ---------- */
/* ---------- https://fortawesome.github.com/Font-Awesome/ ---------- */
/* ---------- http://weloveiconfonts.com/ ---------- */

@import url(http://weloveiconfonts.com/api/?family=fontawesome);

/* ---------- ERIC MEYER'S RESET CSS ---------- */
/* ---------- https://meyerweb.com/eric/tools/css/reset/ ---------- */

@import url(https://meyerweb.com/eric/tools/css/reset/reset.css);

/* ---------- FONTAWESOME ---------- */

[class*="fontawesome-"]:before {
  font-family: 'FontAwesome', sans-serif;
}

/* ---------- GENERAL ---------- */

body {
  background: #f4f4f4;
  color: #5a5656;
  font: 100%/1.5em 'Open Sans', sans-serif;
  margin: 0;
}

a { text-decoration: none; }

h1 { font-size: 1em; }

h1, p {
  margin-bottom: 10px;
}

strong {
  font-weight: bold;
}

.uppercase { text-transform: uppercase; }

/* ---------- LOGIN ---------- */

#login {
  margin: 50px auto;
  width: 300px;
}

form fieldset input[type="text"], input[type="password"] {
  background: #e5e5e5;
  border: none;
  border-radius: 3px;
  color: #5a5656;
  font-family: inherit;
  font-size: 14px;
  height: 50px;
  outline: none;
  padding: 0px 10px;
  width: 280px;
  -webkit-appearance:none;
}

form fieldset input[type="submit"] {
  background-color: #008dde;
  border: none;
  border-radius: 3px;
  color: #f4f4f4;
  cursor: pointer;
  font-family: inherit;
  height: 50px;
  text-transform: uppercase;
  width: 300px;
  -webkit-appearance:none;
}

form fieldset a {
  color: #5a5656;
  font-size: 10px;
}

form fieldset a:hover { text-decoration: underline; }

.btn-round {
  background: #5a5656;
  border-radius: 50%;
  color: #f4f4f4;
  display: block;
  font-size: 12px;
  height: 50px;
  line-height: 50px;
  margin: 30px 125px;
  text-align: center;
  text-transform: uppercase;
  width: 50px;
}

  </style>
</head>
<body>

<div id="login">
<h1><strong>Welcome.</strong> Please login.</h1>
	<form method="post" action="" class="form-signin">
		<fieldset>

        <p><input type="text" name="email" placeholder="Email address" required="" ></p> <!-- JS because of IE support; better: placeholder="Username" -->

        <p><input type="password" name="pass" placeholder="password" onBlur="if(this.value=='')this.value='Password'" onFocus="if(this.value=='Password')this.value='' "></p> <!-- JS because of IE support; better: placeholder="Password" -->

        <p><a href="checkout.php?forgot_pass">Forgot Password?</a></p>

        <p><input name="login" type="submit"></p>
        <p><a href="customer_register.php">New?Register here</a></p>

      </fieldset>

	</form>
  </div>
<?php 
	if(isset($_POST['login'])){
	
		$c_email = $_POST['email'];
		$c_pass = $_POST['pass'];
		
		$sel_c = "select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
		
		$run_c = mysqli_query($con, $sel_c);
		
		$check_customer = mysqli_num_rows($run_c); 
		
		if($check_customer==0){
		
		echo "<script>alert('Password or email is incorrect, plz try again!')</script>";
		exit();
		}
		$ip = getIp(); 
		
		$sel_cart = "select * from cart1 where ip_add='$ip'";
		
		$run_cart = mysqli_query($con, $sel_cart); 
		
		$check_cart = mysqli_num_rows($run_cart); 
		
		if($check_customer>0 AND $check_cart==0){
		
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('customer/my_account.php','_self')</script>";
		
		}
		else {
		$_SESSION['customer_email']=$c_email; 
		
		echo "<script>alert('You logged in successfully, Thanks!')</script>";
		echo "<script>window.open('payment.php','_self')</script>";
		
		
		}
	}
	
	
	?>
	

</body>
</html>