<?php 
session_start();
include 'c.php';
if(isset($_SESSION['id'])){
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>donShare | Event</title>
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/style.css">	
</head>
<body>
	<div class ="fixed-top  text-center">
		    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #563d7c;">            
		        <a class="navbar-brand" href="home.php"><h3 class="text-white">donShare.com</h3></a>  
		        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navi"
		        aria-controls="navi" aria-expanded="false" aria-label="Toggle navigation">
		        <span id ="icono" class="navbar-toggler-icon"></span>
		        </button>                   
		        <div class="collapse navbar-collapse" id="navi">
		          <div class="navbar-nav ml-auto"> 	
					<a class="nav-item nav-link" href="home.php"><h6 class="text-white">Home</h6></a>
					<a class="nav-item nav-link" href="logout.php"><h6 class="text-white">Logout</h6></a>  
		          </div>        
		        </div>              
		    </nav>
	</div>
	<div class="box-e">
		<div class="container-fluid bg-dark">
			<?php 
				$id_e=$_GET['id'];
				if($id_e != ''){
					echo $id_e;	
					$q ="SELECT titu, nper, dia, hora FROM ev WHERE id_ev = ?";
					$p = mysqli_prepare($c,$q);
					mysqli_stmt_bind_param($p,"i",$id_e);
					mysqli_stmt_execute($p);
					mysqli_stmt_store_result($p);
					$r = mysqli_stmt_num_rows($p);
					if($r == 1){
						mysqli_stmt_bind_result($p, $tit, $nper, $dia ,$hora);
						mysqli_stmt_fetch($p);	
					}else{
						echo 'Esta página no exite';	
					}
				}else{
					echo 'Esta página no exite';
				}
			 
			 ?>
		</div>
	</div>	
<script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/popper.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/bootstrap.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/users.js"></script>	
</body>
</html>
<?php
}else{
	header("Location:index.php");
}
?>