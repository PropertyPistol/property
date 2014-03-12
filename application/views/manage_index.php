<div id="body">
		<p style="font-size:16px;"><h2>What do you want to do?</h2></p>
		<ul >
			<li><h3><?php echo anchor('manage/add_property', 'Add Property'); ?></h3></li>
			<li><h3><?php echo anchor('manage/add_units', 'Add Units'); ?></h3></li>
			<li><h3><?php echo anchor('manage/booking', 'Make a Booking'); ?></h3></li>
			<li><h3><?php echo anchor('manage/booking_details', 'Add More Booking Details'); ?></h3></li>
			<li><h3><?php echo anchor('manage/incentives', 'Give Incentives'); ?></h3></li>
		</ul>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Hello <i><?php echo $this->session->userdata('name') ?></i>, Manage Your Account</h1>");
	</script>