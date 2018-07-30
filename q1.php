<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
	$idu = $_SESSION['id'];
 	$q1= "SELECT post . time_post, post . post_nick, post . ev_id FROM post LEFT JOIN gev ON post . ev_id = gev. ev_id WHERE (post . post_user_id != ? and gev . user_id = ?)";
 	$r = mysqli_prepare($c,$q1);
	mysqli_stmt_bind_param($r,"ii",$idu,$idu);
	mysqli_stmt_execute($r);
	mysqli_stmt_store_result($r); 
	$row = mysqli_stmt_num_rows($r);
	if($row > 0){
		$ntf1 = array();
		mysqli_stmt_bind_result($r, $time, $nick, $ide);
		while(mysqli_stmt_fetch($r)){
			$time2= date("d-m-Y",strtotime($time));
			$data = array("time"=>$time2, "user"=>$nick, "ide"=>$ide);
	                	$ntf1[] = $data;
		}
		echo json_encode($ntf1);
		mysqli_stmt_close($r);
	}else{
		echo '0';
	}
}else{
	header("Location:index.php");
}
mysqli_close($c);
?>