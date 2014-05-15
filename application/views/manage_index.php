<div id="body">
	<?php if($this->session->flashdata('authorized')){echo $this->session->flashdata('authorized');} ?>
		<p style="font-size:16px;"><h2>What do you want to do?</h2></p>
		<ol >
			<li><h3><?php echo anchor('manage/add_property', 'Add Project'); ?></h3></li>
			<!--<li><h3><?php //echo anchor('manage/add_units', 'Add Unit Types'); ?></h3></li> -->
			<li><h3><?php echo anchor('manage/booking', 'Make a Booking'); ?></h3></li>
			<li><h3><?php echo anchor('booking/view', 'View a Booking'); ?></h3></li>
			<!-- <li><h3><?php //echo anchor('manage/booking_details', 'Add More Booking Details'); ?></h3></li> -->
			<li><h3><?php echo anchor('manage/add_invoice', 'Manage Invoice'); ?></h3></li>
			<li><h3><?php echo anchor('manage/reporting', 'Show Reporting'); ?></h3></li>
			<!-- <li><h3><?php //echo anchor('manage/incentives', 'Give Incentives'); ?></h3></li> -->
			<li><h3><a href="<?php echo base_url('upload') ?>">Upload Data File</a></h3></li>
			
		</ol>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Hello <i><?php echo $this->session->userdata('name') ?></i>, Manage Your Account</h1>");
	</script>