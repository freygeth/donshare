<?php 
session_start();
include 'c.php';
if(isset($_SESSION['id'])){
header("Location:home.php");
}else{
	if(isset($_POST['l_email']) && ($_POST['l_pass'])){	
	sleep(1);
	$email = $_POST['l_email'];
    $pass = $_POST['l_pass'];
    $q="SELECT id_user, pass, nick FROM users WHERE email = ?";
    $p= mysqli_prepare($c,$q);
    mysqli_stmt_bind_param($p,"s",$email);
    mysqli_stmt_execute($p);
    mysqli_stmt_store_result($p); 
    $row = mysqli_stmt_num_rows($p);
	    if($row ===1){
	        $pa=mysqli_stmt_bind_result($p, $id_u, $hashed, $nick);
	        mysqli_stmt_fetch($p);
	        	if( password_verify($pass, $hashed) ){
	        		$_SESSION['id'] = $id_u;
	        		$_SESSION['nick'] = $nick;
			        echo "1";
			        mysqli_stmt_close($p);
	        	}else{
	        		echo '0';
	        		mysqli_stmt_close($p);
	        	}	         
	    }else{
	        echo "0";
	        mysqli_stmt_close($p);
	    }
	}else{
		header("Location:index.php");
	}	
}
mysqli_close($c);	
?>