<?php 
session_start(); 
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
header("Location:home.php");
}else{	
	$email = $_POST['r_email'];	
	$nick = $_POST['r_user'];
	$pass = $_POST['r_pass1'];
	$pic = ' ';
	if($email != '' && $pass != '' && $nick != ''){
		$hashed_password = password_hash($pass, PASSWORD_DEFAULT);
		$v="SELECT email FROM users WHERE email = ? || nick = ?";
		$re = mysqli_prepare($c,$v);
		mysqli_stmt_bind_param($re,"ss",$email,$nick);
		mysqli_stmt_execute($re);
		mysqli_stmt_store_result($re); 
		$rows = mysqli_stmt_num_rows($re);
		if($rows === 0){
			$q = "INSERT INTO users(email, pass, nick, pic) VALUES(?, ?, ?, ?)";
			$r = mysqli_prepare($c,$q);
			mysqli_stmt_bind_param($r,"ssss", $email, $hashed_password, $nick, $pic);
			$ok = mysqli_stmt_execute($r);
			if($ok){
				echo '1';				
				mysqli_stmt_close($r);
			}else{
				echo '0';				
				mysqli_stmt_close($r);
			}
		mysqli_stmt_close($re);	
		}else{			
			echo '0';
			mysqli_stmt_close($re);
		}		
	}else{
		header("Location:index.php");	
	}		
}
mysqli_close($c);
?>