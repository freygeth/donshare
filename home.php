<?php 
session_start();
include 'c.php';
if(isset($_SESSION['id'])){	
	$user=$_SESSION['nick'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<title>donShare | Inicio</title>
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
		<div class="container-fluid">
			<h4 class="text-center">Hola <?php echo $user; ?> !</h4>
			<div class="row">
				<div class="col-10 col-md-4 fixed ">
		            <h5 class="text-center">Cursos</h5>
		            <div class="row mt-2 bg-white justify-content-center text-center">
		            	<button type="button" id="btn-c" class="btn mt-2 mb-2 btn-sm "><b>Ver Cursos</b></button>  	
		            </div> 
		            <div id="courses" class="row mt-2 pt-3 bg-white">                       
		            </div>                               
		        </div>
		        <div class="col-10 col-md-4 ml-md-2 mt-2 mt-md-0 fixed">
			        <h5 class="text-center">Mis Cursos</h5>
					<div class="row mt-2 bg-white justify-content-center text-center">
			            <button type="button" id="btn-mc" class="btn mt-2 mb-2 btn-sm "><b>Ver Cursos</b></button> 	
			        </div>
			        <div id="mycourses" class="row mt-2 pt-3 bg-white">   			            
			        </div> 				       	
		        </div>
		        <div class="col-10 col-md-3 ml-md-5 mt-2 mt-md-0 fixed">
		        	<h5 class="text-center">Notificaciones</h5>
		        	<div class="row mt-2 text-center"> 
			               <div class="col-11 col-md-12 bg-white ">
			               	 <p class="mb-0">De tus publicaciones en los talleres:</p>                
			                 <button type="button" id="btn-nt" class="btn mt-2 btn-sm "><b>Actualizar</b></button>
			                 <hr>
			                 <div id="ntf" class="scroll-notif" ></div>        
			               </div>               
			            </div>			            
			            <div class="row mt-2 text-center"> 
			               <div class="col-11 col-md-12 bg-white"> 
			               	 <p class="mb-0">Publicaciones de otros miembros:</p>                   
			                 <button type="button" id="btn1-nt" class="btn mt-2 btn-sm "><b>Actualizar</b></button>
			                 <hr>
			                 <div id="ntf1" class="scroll-notif" >
			                 </div>        
			               </div>               
			            </div>		        
		    	</div>
			</div>
		</div>		
	</div>	
<script language="JavaScript" type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/popper.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/bootstrap.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/users.js"></script>
<script>
function getc(id){
   	var c = id.split('-');
   	var nid = c[1];   	
   	$.ajax({
				type: 'POST',
			    url: 'r_c.php',
			    dataType: 'json',
			    data:{nid:nid},			    
			    beforeSend: function (){
			    	$('#c-'+nid).hide();
			    	$('#boxc-'+nid).html('<img src="img/loading.gif" id="r_c-gif" width="15" alt=""/>');   	
			    },
			    success: function (r_c){
			    	if( r_c == 0){
			    		$('#r_c-gif').hide();
						$('#boxc-'+nid).html('Error, intentalo luego');			   		
			    	}else{
			    		$('#r_c-gif').hide();
						$('#boxc-'+nid).html('Registrado!');				
			    	 }			   
			    }
			});	
	}
</script>	
</body>
</html>
<?php	
}else{
	header("Location:index.php");		
}
 ?>