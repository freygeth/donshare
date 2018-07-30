<?php 
session_start();
include 'c.php';
if(isset($_SESSION['id'])){
header("Location:home.php");	
}else{
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>donShare.com</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">	
</head>
<body>	
	<div style="background-color: #563d7c;">
	  	<div class="container-fluid">
	  		<div class="row">
	  			<div class="col-12 col-md-4">
					<a class="navbar-brand" href="index.php"><h3 class="text-white ml-3">donShare.com</h3></a>
	  			</div>
	  			<div class="col-12 col-md-8" style="display: flex;align-items: center;">
	  				<p class="text-white mb-0 ml-2"><b>Aprendre gratis Aws,Php o Bootstrap</b></p>
	  			</div>
	  		</div>
	  	</div>
	</div>		
	<div class="main">				
			<div class="row text-center">
		        <div class="col-md-8 col-8">
		            <div class="container-fluid">           
			            <form action="" method="post" accept-charset="utf-8" >
			              <div class="form-group row justify-content-center">
			                  <label for="email" class="col-sm-2 col-form-label">Email</label>
			                  <div class="col-sm-10 col-12">
			                    <input type="email" class="form-control" name="email" id="r-email" maxlength="30"  placeholder="Email" required>
			                  </div>
			              </div>
			              <div class="form-group row justify-content-center">
			                  <label for="pass" class="col-sm-2 col-form-label">Password</label>
			                  <div class="col-sm-10 col-12">
			                    <input type="password" class="form-control" name="pass" id="r-pass1"  minlength="6" placeholder="Password (6 min)" required>			                    
								<input type="password" class="form-control" id="r-pass2" placeholder="Repeat your password">
			                  </div>
			               </div> 
			               <div class="form-group row justify-content-center">
			                  <label class="col-sm-2 col-form-label" for="username">Username</label>
			                  <div class="col-sm-10 col-12">                    
			                    <input type="text" class="form-control" name="user" id="r-username" maxlength="15" placeholder="Username (Sin espacios)" required>
			                  </div>
			                </div>   
			                  <div class="form-group row justify-content-center">
			                    <div class="col-sm-10 col-12">
			                      <button type="submit" id="btn-r" class="btn-sm"><b>Sign up</b></button>
			                    </div>
			                  </div>
			            </form>
		            	<div id="res-reg" style="width: auto;height: 25px;"></div>
		       		</div>
		        </div>
	      </div> 
	      <div class="row text-center mt-4">
	        <div class="col-md-8 col-8">
	            <div class="container-fluid">          
	              <form action="" method="post" accept-charset="utf-8" >
	                    <div class="form-group row justify-content-center">
	                      <label for="email" class="col-sm-2 col-form-label">Email</label>
	                      <div class="col-sm-10 col-12">
	                        <input type="email" class="form-control" id="u-email" name="email" placeholder="Email" required>
	                      </div>
	                    </div>
	                    <div class="form-group row justify-content-center">
	                      <label for="pass" class="col-sm-2 col-form-label">Password</label>
	                      <div class="col-sm-10 col-12">
	                        <input type="password" class="form-control" id="u-pass" name="pass" minlength="6" placeholder="Password" required>
	                      </div>
	                    </div>    
	                    <div class="form-group row justify-content-center">
	                      <div class="col-sm-10 col-12">
	                        <button type="submit" id="btn-u" class="btn-sm"><b>Sign in</b></button>
	                      </div>
	                    </div>
	              </form>
	              <div id="res-log"></div>    
	            </div>          
	        </div>
	      </div>
	</div>	
<script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/popper.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/bootstrap.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/users.js"></script>	
</body>
</html>
<?php
}
?>
