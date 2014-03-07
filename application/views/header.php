<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Property Pistol Reality Pvt. Ltd.</title>
	<link href="<?php echo base_url('static/css/style.css') ?>" rel='stylesheet' type='text/css'>
	<script src="<?php echo base_url('static/js/jquery.js') ?>" type="text/javascript"></script>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
	<script>
		$(function() {
		$( "#datepicker" ).datepicker();
		});
		function init(project_id){
		   search(project_id);
		}
	</script>
</head>
<body>

<div id="container">
	
	<img style="float:left;" src="<?php echo base_url('static/img/logo.png'); ?>"><div class="header" style="float:center;">
	</div>
	<div class="clear"></div>