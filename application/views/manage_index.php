<div id="body">
		<p style="font-size:16px;">What do you want to do?</p>
		<ul>
			<li><?php echo anchor('manage/add_property', 'Add Property'); ?></li>
			<li><?php echo anchor('manage/add_units', 'Add Units'); ?></li>
			<li><?php echo anchor('manage/booking', 'Make a Booking'); ?></li>
			<li><?php echo anchor('manage/booking_edit', 'Add Data For Booking'); ?></li>
		</ul>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Hello <i><?php echo $this->session->userdata('name') ?></i>, Manage Your Account</h1>");
	</script>