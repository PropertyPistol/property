<?php
	session_start();
	if(isset($_SESSION['username'])){
		header( 'Location: upload.php' );
	}
	if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		if(sha1($username) === 'eeac508ae21eb6b994e0b2aea9fa3175e794f142'){
			if(md5($password) === 'df7c905d9ffebe7cda405cf1c82a3add'){
				$_SESSION['username'] = $username;
				header( 'Location: upload.php' );
			}else{
				echo "Incorrect Password";
			}
		}else{
			echo "Incorrect Username";
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<style>
body{
	font-family:Tahoma, Geneva, sans-serif;
}
</style>
</head>
<body>
	<form method="POST" action="index.php">
		<h2>
			Enter Admin Login<br/>
			<input name="username" type="text" placeholder="Enter Username"><br/>
			<input name="password" type="password" placeholder="Enter Password"><br/>
			<input type="submit" name="submit" value="Login">
		</h2>
	</form>
</body>
</html>