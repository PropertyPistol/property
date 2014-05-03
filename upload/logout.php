<?php
	session_start();
	if(isset($_SESSION['username'])){
		unset($_SESSION['username']);
	}else{
		echo "No Session Found";
	}
	header( 'Location: index.php' );
?>