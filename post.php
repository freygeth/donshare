<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$user = $_SESSION['nick'];
	$text = $_POST['post'];
	$ev_id = $_POST['ev_id'];
	$q = "INSERT INTO post(post_user_id, text_post, post_nick, ev_id) VALUES( ?, ?, ?, ?)";
	$p = mysqli_prepare($c,$q);		
	mysqli_stmt_bind_param($p,"issi",$id, $text, $user,$ev_id);
	$b = mysqli_stmt_execute($p);		
	if($b){
		echo '1';
	  	mysqli_stmt_close($p);
	}else{
		echo '0';
	  	mysqli_stmt_close($p);
	}
mysqli_close($c);
}else{
	header("Location:index.php");
}
?>