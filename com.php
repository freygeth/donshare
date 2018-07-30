<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
	$idpost= $_GET['idpost'];
    $q="SELECT text_com, time_com, com_nick FROM com  WHERE post_id = ?";
    $r = mysqli_prepare($c,$q);
    mysqli_stmt_bind_param($r,"i",$idpost);
	mysqli_stmt_execute($r);
    mysqli_stmt_store_result($r);
    $row = mysqli_stmt_num_rows($r);
    if($row > 0){
    	$com = array();
    	mysqli_stmt_bind_result($r, $text, $time, $user);
    	while(mysqli_stmt_fetch($r)){    		
    		$info = array("text"=>$text, "time"=>$time, "user"=>$user);
	                	$com[] = $info;	
    	}        
    	echo json_encode($com);
        mysqli_stmt_close($r);
    }else{
    	echo '0';
    }
}else{
	header("Location:index.php");
}
mysqli_close($c);   
?>