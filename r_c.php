<?php 
session_start();
include 'c.php';
sleep(1);
if(isset($_SESSION['id'])){
	$id = $_SESSION['id'];
	$nid = $_POST['nid'];
	$i="INSERT INTO gev(user_id, ev_id) VALUES(?, ?)";
	$p= mysqli_prepare($c,$i);
		mysqli_stmt_bind_param($p,"ii",$id, $nid);
		$b = mysqli_stmt_execute($p);
		if($b){
			mysqli_stmt_close($p);
			$q=mysqli_query($c, "SELECT nper FROM ev WHERE id_ev='$nid' ");
			$f=mysqli_fetch_assoc($q);
			$a=$f['nper'];
			$n = '1';
			$base=$a+$n;
			$q2=mysqli_query($c, "UPDATE ev SET nper='$base' WHERE id_ev='$nid' ");
				if($q2){
					echo '1';
				}else{
					echo '0';	
				}
		}else{
			echo '0';
		  	mysqli_stmt_close($p);
		}		
}else{
	header("Location:index.php");
}
mysqli_close($c);
?>