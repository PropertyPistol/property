<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Property Pistol Reality Pvt. Ltd.</title>
	<link href="<?php echo base_url('static/css/style.css') ?>" rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo base_url('static/css/jquery-ui.css') ?>">
	<script src="<?php echo base_url('static/js/jquery.js') ?>" type="text/javascript"></script>
	<script src="<?php echo base_url('static/js/jquery-ui.js') ?>" type="text/javascript"></script>
	<script>
		$(function() {
		$( ".datepicker" ).datepicker({ dateFormat: "yy-mm-dd" });
		});
	</script>
	
</head>
<body>

<div id="container">
	
	<img style="float:left;" src="<?php echo base_url('static/img/logo.png'); ?>"><div class="header" style="float:center;">
	</div>
	<div class="clear"></div>
	<div style="float:left; padding-left:50px;">
		<br/><sub><?php echo anchor('manage', 'Back to Main Page'); ?></sub>
	</div>
	<div style="float:right; padding-right:50px;">
		<br/><sub><?php echo anchor('manage/logout', 'Logout!'); ?></sub>
	</div>
	<div style="float:right; padding-right:650px;">
		<br/><sub><?php echo anchor('manage/account', 'Change Password'); ?></sub>
	</div>
	
	<div class="clear"></div>