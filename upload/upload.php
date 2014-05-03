<?php
session_start();
if(!isset($_SESSION['username'])){
	header( 'Location: index.php' );
}
if(isset($_POST['submit'])){
	//var_dump($_FILES);
	$con = mysql_connect("localhost", "property", "Troltomm#@123");
	mysql_select_db("propertypistol", $con);
	$file = $_FILES['file']['tmp_name'];
	$handle = fopen($file, "r");
	$setflag = 1;
	$setmainflag = 1;
	function check_existance($project){
			$query = mysql_query("SELECT * FROM projects WHERE `project` LIKE '$project'") or die(mysql_error());
			$array = mysql_fetch_array($query);
			if($array){
				return $array['id'];
			}else{
				return 'carry_on';
			}
		}
	function get_option_id($project_id, $unit_type){
		$query = mysql_query("SELECT option_id FROM unit_options WHERE `project_id` LIKE '$project_id' && `unit_type` LIKE '$unit_type' ORDER BY option_id DESC LIMIT 1") or die(mysql_error());
		$array = mysql_fetch_array($query);
		if($array){
			return $array['option_id']+1;
		}else{
			return 1;
		}
	}
	function check_for_unit_options($project_id, $unit_type, $size){
		$query = mysql_query("SELECT * FROM unit_options WHERE `project_id` LIKE '$project_id' && `unit_type` LIKE '$unit_type' && `option` LIKE '$size'") or die(mysql_error());
		$array = mysql_fetch_array($query);
		if($array){
			return 1;
		}else{
			return 0;
		}
	}
	while(($fileop = fgetcsv($handle, '1000', ','))!== FALSE){
		$sr_no = $fileop[0];
		$booking_date = date('Y-m-d' , strtotime($fileop[1]));
		$client_id = $fileop[2];
		$client_name = $fileop[3];
		$city = $fileop[7];
		$project = $fileop[8];
		$builder = $fileop[9];
		$type = $fileop[11];
		$unit_number = $fileop[12];
		$size = $fileop[13];
		$basic_rate = $fileop[14];
		$car_park = $fileop[15];
		$floor_rise = $fileop[16];
		$plc = $fileop[17];
		$agreement = $fileop[18];
		$revenue = $fileop[19];
		$cash_back = $fileop[20];
		$net_revenue = $fileop[21];
		
		if($car_park){
			$car_park_bool = 1;
		}else{
			$car_park_bool = 0;
		}
		
		if($sr_no=='Sr Num'){
			$setmainflag=0;
		}
		$project_exist_value = check_existance($project);
		
		if($project_exist_value=='carry_on'&&$setmainflag){
			$sql = mysql_query("INSERT INTO projects (`project`, `builder`) VALUES ('$project', '$builder')")or die(mysql_error());
			if($sql){
				//check for which function provides the insert id value
				$project_id = mysql_insert_id();
			}
		}else{
			$project_id = $project_exist_value;
		}
		$option_id = get_option_id($project_id, $type);
		if(!check_for_unit_options($project_id, $type, $size)&&$setmainflag){
			$sql = mysql_query("INSERT INTO unit_options (`project_id`, `unit_type`, `option_id`, `option`) VALUES ('$project_id', '$type', '$option_id', '$size')") or die(mysql_error());
		}
		if($setmainflag){
			$sql = mysql_query("INSERT INTO client_booking (`client_id`, `project_id`, `booking_date`, `unit_no`, `unit_type`, `size`, `basic_rate`, `car_park`, `car_park_cost`, `floor_rise`, `plc`, `agr_value`, `revenue`, `cashback`, `net_revenue`) VALUES ('$client_id', '$project_id', '$booking_date', '$unit_number', '$type', '$size', '$basic_rate', '$car_park_bool', '$car_park', '$floor_rise', '$plc', '$agreement', '$revenue', '$cash_back', '$net_revenue')") or die(mysql_error());
		}
		$setflag=1;
		$setmainflag=1;
	}
	
}
/*
$file = fopen("welcome.txt", "r");
var_dump($file);
while(!feof($file)){
	echo fgets($file).'<br/>';
	echo "FEOF VALUE: ".feof($file).'<br/>';
}
*/
?>
<!DOCTYPE html>
<html>
<head>

</head>
<body>
	<form method="POST" action="upload.php" enctype="multipart/form-data">
		<input type="file" name="file" />
		<br/>
		<input type="submit" name="submit" value="Submit" />
	</form>
	<br/><br/>
	<a href="logout.php" style="text-decoration:none;">Logout</a>
</body>
</html>