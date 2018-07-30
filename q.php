<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
	$idu = $_SESSION['id'];
	$q="SELECT post . ev_id, com . com_nick, com . time_com FROM post INNER JOIN com ON post . id_post = com . post_id WHERE (post . post_user_id = ? AND com . com_user_id != ?) ORDER BY com . id_com DESC ";
	$r = mysqli_prepare($c,$q);
	mysqli_stmt_bind_param($r,"ii",$idu,$idu);
	mysqli_stmt_execute($r);
	mysqli_stmt_store_result($r); 
	$row = mysqli_stmt_num_rows($r);
	if($row > 0){
		$ntf = array();
		mysqli_stmt_bind_result($r, $ide, $nick, $time);
		while(mysqli_stmt_fetch($r)){
			$time2= date("d-m-Y",strtotime($time));
			$data = array("ide"=>$ide, "user"=>$nick, "time"=>$time2);
	                	$ntf[] = $data;
		}
		echo json_encode($ntf);
	}else{
		echo '0';
	}
}else{
	header("Location:index.php");
}
mysqli_stmt_close($r);
mysqli_close($c);
?>