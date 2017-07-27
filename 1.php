<!DOCTYPE html>
<?php
session_start();
include("includes/db.php");
include("functions/func.php");
?>
<html>
<head>
	<title></title>
</head>
<body>
<div>
	<form method="post" action="">
	<table width="500px" align="center" bgcolor="skyblue">
		<tr align="center">
			<td>
			<h2>Login or Register to Buy!</h2>
			</td>
		</tr>
		<tr>
			<td>Email:</td>
			<td><input type="text" name="email" placeholder="enter email"></td>
		</tr>
		<tr>
			<td>Password:</td>
			<td><input type="password" name="pass" placeholder="enter password"></td>
		</tr>
		<tr>
			<td><a href="checkout.php?Forgot_pass">Forgot password?</a></td>
		</tr>

		<tr>
			<td><input type="submit" name="login" value="login"></td>
		</tr>



	</table>		

	<h2 style="float:right;"><a href="customer_register.php">new?register here!</a></h2>


	</form>
<?php
if (isset($_POST['login'])) {

	$c_email=$_POST['email'];
	$c_pass=$_POST['pass'];

	$sel_c="select * from customers where customer_pass='$c_pass' AND customer_email='$c_email'";
	$run_c=mysqli_query($con,$sel_c);

	$check_customer=mysqli_num_rows($run_c);

	if($check_customer==0)
	{
		echo "<script>alert('password or email is incorrect!please try again')</script>";
	}

	$ip=getIp();

	$sel_cart="select * from cart where ip_add='$ip'";

	$run_cart=mysqli_query($con,$sel_cart);

	$check_cart=mysqli_num_rows($run_cart);

	if($check_customer>0 AND $check_cart==0)
	{
		$_SESSION['customer_email']=$c_email; 
    
    echo "<script>alert('logged in successfully')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
    
    }
else
{
	$_SESSION['customer_email']=$c_email; 
    
    echo "<script>alert('Account has been created successfully, Thanks!')</script>";
    echo "<script>window.open('checkout.php','_self')</script>";
    
    }
}

	




?>



</div>
</body>
</html>