
<form action="" method="post">
	
	<br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">Want to delete your account?</h3>
    				
                    
          
        <button style="margin-left:20px;"  type="submit" id="submit" name="yes"  class="btn btn-danger pull-right">Yes</button>
         <button type="submit" id="submit" name="no"  class="btn btn-primary pull-right">No</button>








</form>
<?php 
include("includes/db.php"); 

	$user = $_SESSION['customer_email']; 
	
	if(isset($_POST['yes'])){
	
	$delete_customer = "delete from customers where customer_email='$user'";
	
	$run_customer = mysqli_query($con,$delete_customer); 
	
	echo "<script>alert('We are really sorry, your account has been deleted!')</script>";
	echo "<script>window.open('../index.php','_self')</script>";
	}
	if(isset($_POST['no'])){
	
	echo "<script>alert('oh! dont crack such kind of joke again!')</script>";
	echo "<script>window.open('my_account.php','_self')</script>";
	
	}
	


?>