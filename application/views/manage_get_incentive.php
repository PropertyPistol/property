<div id="body">
		<p style="font-size:16px;"><h2>Select Month</h2>
		
	<?php echo form_open(); ?>
<?php
        $options = array(
                          '1'  => 'January',
                          '2'    => 'February',
                          '3'   => 'March',
                          '4' => 'April',
                          '5' => 'May',
                          '6' => 'June',
                          '7' => 'July',
                          '8' => 'August',
                          '9' => 'September',
                          '10' => 'October',
                          '11' => 'November',
                          '12' => 'December',
                        );


        echo form_dropdown('month', $options); 
?>
<?php echo form_submit('submit', 'Get Details'); ?>
<?php echo form_close(); ?>
</p>
</div>
<?php echo $executive_id; ?>
	<script type="text/javascript">
		$("div.header").html("<h1>Hello <i><?php echo $this->session->userdata('name') ?></i>, Employee Incentives</h1>");
	</script>