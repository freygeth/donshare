<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
    $idu = $_SESSION['id'];
    $q="SELECT id_ev, titu, nper, dia, hora FROM ev WHERE id_ev NOT IN(SELECT id_ev FROM ev LEFT JOIN gev on ev . id_ev = gev . ev_id WHERE gev . user_id = ?) ";    
	$r = mysqli_prepare($c,$q);
    mysqli_stmt_bind_param($r,"i",$idu);
	mysqli_stmt_execute($r);
    mysqli_stmt_store_result($r);
    $row = mysqli_stmt_num_rows($r);
    if($row > 0){
    	$cursos = array();
    	mysqli_stmt_bind_result($r, $id_e, $titu, $nper, $dia, $hora);
    	while(mysqli_stmt_fetch($r)){    		
    		$info = array("id_e"=>$id_e, "titu"=>$titu, "nper"=>$nper, "dia"=>$dia,"hora"=>$hora);
	                	$cursos[] = $info;	
    	}        
    	echo json_encode($cursos);
        mysqli_stmt_close($r);
    }else{
    	echo '0';
    }
}else{
	header("Location:index.php");
}
mysqli_close($c);   
?>