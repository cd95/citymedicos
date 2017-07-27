<form action="" method="post">
	
	<br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">Change Password</h3>
    				<div class="form-group">
						<input type="password" class="form-control" id="name" name="current_pass" placeholder="Current Password" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="email" name="new_pass" placeholder="New password" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="mobile" name="new_pass_again" placeholder="New Password Again" required>
					</div>
					
                    
            
        <button type="submit" id="submit" name="change_pass"  class="btn btn-primary pull-right">Change Password</button>








</form>


<?php 

include("includes/db.php"); 


	if(isset($_POST['change_pass'])){
		
		$user = $_SESSION['customer_email']; 
	
		$current_pass = $_POST['current_pass']; 
		$new_pass = $_POST['new_pass']; 
		$new_again = $_POST['new_pass_again']; 
		
		$sel_pass = "select * from customers where customer_pass='$current_pass' AND customer_email='$user'";
		
		$run_pass = mysqli_query($con, $sel_pass); 
		
		$check_pass = mysqli_num_rows($run_pass); 
		
		if($check_pass==0){
		
		echo "<script>alert('Your Current Password is wrong!')</script>";
		exit();
		}
		
		if($new_pass!=$new_again){
		
		echo "<script>alert('New password do not match!')</script>";
		exit();
		}
		else {
		
		$update_pass = "update customers set customer_pass='$new_pass' where customer_email='$user'";
		
		$run_update = mysqli_query($con, $update_pass); 
		
		echo "<script>alert('Your password was updated succesfully!')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		}
	
	}




?>