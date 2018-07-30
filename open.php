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
		<title>donShare | MyEvent</title>
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
			<?php 
				$user=$_SESSION['nick'];
				$id_e=$_GET['id'];
			 	if($id_e != ''){						
					$q ="SELECT titu, nper, dia, hora FROM ev WHERE id_ev = ?";
					$p = mysqli_prepare($c,$q);
					mysqli_stmt_bind_param($p,"i",$id_e);
					mysqli_stmt_execute($p);
					mysqli_stmt_store_result($p);
					$r = mysqli_stmt_num_rows($p);
					if($r == 1){
						mysqli_stmt_bind_result($p, $tit, $nper, $dia ,$hora);
						mysqli_stmt_fetch($p);					
					?>	
				<div class="row">
					<div class="col-md-6 col-10 bg-white">
						<h6><?php echo $tit; ?></h6>
						<h6>Dia: <small><?php echo $dia;?></small></h6>
						<h6>Hora: <small> <?php echo $hora;?></small></h6>
						<h6>Registrados:<small><?php echo $nper; ?></small></h6>
						<form action="">
							<div class="form-group row">
                                   <label for="post_u" class="col-sm-12 col-form-label">Detalles:</label>
                                   <div class="col-sm-10 col-10">
                                       <textarea class="form-control" maxlength="150" id="text_user" placeholder="Escribe aquí en 150 caracteres :)" rows="3"></textarea>                  
                                   </div>
                                 </div>
                                 <div class="form-group row mb-0">
                                    <div class="col-sm-10">
                                        <button  type="button" data-evid="<?php echo $id_e; ?>" data-user="<?php echo $user; ?>" id="post" class="btn-sm btn-primary"><b>Publicar</b></button>
                                      </div>
                                 </div>
						</form>
						<div class="load_o" id="load-post"></div>
					</div>
				</div>
				<div class="row">	
					<div class="comments-container col-md-6 col-10 pt-1">
						<div id="w" class="comments-list">
							<?php 
							 $q2="SELECT id_post, text_post, time_post, post_nick FROM post  WHERE ev_id = '$id_e' ORDER BY id_post DESC ";
							 $r2=mysqli_query($c, $q2);
							 while($f2 = mysqli_fetch_assoc($r2)){
							 	?>
							<li> 
								<div class="comment-main-level">
									<div class="comment-box">
	                                    <div class="comment-head">
	                                        <h5 class="name ml-1 mb-0">&lt;<?php echo $f2['post_nick']; ?>&gt;</h5>
	                                        <h6 class="tiempo float-right mr-1"><?php echo date("d-m-Y",strtotime($f2['time_post'])) ; ?></h6>
	                                    </div>
                                   		 <p class=""><?php echo $f2['text_post'] ; ?></p>
                                	</div>
								</div>
								<ul class="comments-list reply-list">
									<li>
										<form action="" method="post" accept-charset="utf-8">
	                                        <div id="" class="form-group row mt-1">
	                                            <div id="box-ev" class="col-sm-10 col-10">
	                                                <textarea class="form-control" maxlength="50" id="c-<?php echo $f2['id_post']; ?>" placeholder="Escribele en 100 caracteres..." rows="3"></textarea>
	                                            </div>                                                  
	                                        </div>
	                                        <div class="form-group row mb-0 mt-0">
	                                            <div id="btnc-e" class="col-sm-10">
	                                                <button type="button" id ="com-e" data-user="<?php echo $user; ?>" data-postid="<?php echo $f2['id_post']; ?>" class="btn-sm btn-primary mt-1 btn-sm ml-1"><b>Responder</b></button> 
	                                            </div>                                              
	                                        </div>                                                             
                                   		 </form>
                                    	<div class="load_o" id="loadec-<?php echo $f2['id_post']; ?>"></div>
									</li>
									<div id="reply-e">
										<button id="<?php echo $f2['id_post']; ?>" class="btn-sm bg-white text-primary">Ver comentarios...</button><div id="r_c-<?php echo $f2['id_post']; ?>"></div><div id="r-<?php echo $f2['id_post']; ?>"></div>			
									</div>
								</ul>
							</li>
						<?php	 	
							 }
							 mysqli_close($c); 
							 ?>							
						</div>			      
					</div>					
				</div>						
				<?php
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