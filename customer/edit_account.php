<?php 	
				include("includes/db.php"); 
				
				$user = $_SESSION['customer_email'];
				
				$get_customer = "select * from customers where customer_email='$user'";
				
				$run_customer = mysqli_query($con, $get_customer); 
				
				$row_customer = mysqli_fetch_array($run_customer); 
				
				$c_id = $row_customer['customer_id'];
				$name = $row_customer['customer_name'];
				$email = $row_customer['customer_email'];
				$pass = $row_customer['customer_pass'];
				$country = $row_customer['customer_country'];
				$city = $row_customer['customer_city'];
				$contact = $row_customer['customer_contact'];
				$address= $row_customer['customer_address'];
				$image = $row_customer['customer_image'];
				
				
		?>

		<form action="" method="post" enctype="multipart/form-data">
			
			<br style="clear:both">
                    
    				<div class="form-group">
						<input type="text" class="form-control" id="name" name="c_name" placeholder="Name" value="<?php echo $name;?>" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="email" name="c_email" placeholder="Email" value="<?php echo $email;?>" required>
					</div>
					<div class="form-group">
						<input type="password" class="form-control" id="pass" name="c_pass" placeholder="Email" value="<?php echo $pass;?>" required>
					</div>
					<div class="form-group">
						<input type="file" name="c_image"/><img src="c_image/<?php echo $image; ?>" width="50" height="50"/>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="country" name="c_country" placeholder="country" value="<?php echo $country; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="city" name="c_city" placeholder="country" value="<?php echo $city; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="contact" name="c_contact" placeholder="country" value="<?php echo $contact; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" class="form-control" id="city" name="c_address" placeholder="country" value="<?php echo $address; ?>" required>
					</div>
					
                    
                    
            
        <button type="submit" id="submit" name="update" class="btn btn-primary pull-right">Update</button>






		</form>


		<?php 
	if(isset($_POST['update'])){
	
		
		$ip = getIp();
		
		$customer_id = $c_id;
		
		$c_name = $_POST['c_name'];
		$c_email = $_POST['c_email'];
		$c_pass = $_POST['c_pass'];
		$c_image = $_FILES['c_image']['name'];
		$c_image_tmp = $_FILES['c_image']['tmp_name'];
		$c_city = $_POST['c_city'];
		$c_contact = $_POST['c_contact'];
		$c_address = $_POST['c_address'];
	
		
		move_uploaded_file($c_image_tmp,"customer_images/$c_image");
		
		 $update_c = "update customers set customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass',customer_city='$c_city', customer_contact='$c_contact',customer_address='$c_address',customer_image='$c_image' where customer_id='$customer_id'";
	
		$run_update = mysqli_query($con, $update_c); 
		
		if($run_update){
		
		echo "<script>alert('Your account successfully Updated')</script>";
		echo "<script>window.open('my_account.php','_self')</script>";
		
		}
	}





?>