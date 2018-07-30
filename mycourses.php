<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$q = "SELECT id_ev, titu, nper, dia, hora FROM ev left join gev on ev . id_ev = gev . ev_id  WHERE gev . user_id = ? ";
	$res = mysqli_prepare($c,$q);
	mysqli_stmt_bind_param($res,"i",$id);
	mysqli_stmt_execute($res);
	mysqli_stmt_store_result($res); 
	$rows = mysqli_stmt_num_rows($res);
	if($rows > 0){
		$mcursos = array();
		mysqli_stmt_bind_result($res, $id_e, $titu, $nper, $dia, $hora);
		while(mysqli_stmt_fetch($res)){
			$info = array("id_e"=>$id_e, "titu"=>$titu, "nper"=>$nper, "dia"=>$dia,"hora"=>$hora);
	                	$mcursos[] = $info;
		}
		echo json_encode($mcursos);
		mysqli_stmt_close($res);
	}else{
		echo '0';
	}
}else{
	header("Location:index.php");
}
mysqli_close($c); 
?>