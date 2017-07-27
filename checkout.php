<!DOCTYPE html>
<?php 

include("functions/func.php");

?>
<html>
<head>
	<title>checkout</title>
	<title>Bootstrap Example</title>
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

<?php 
        if(!isset($_SESSION['customer_email'])){
          
          include("customer_login.php");
        }
        else {
        
        include("payment.php");
        
        }
        
        ?>
</body>
</html>