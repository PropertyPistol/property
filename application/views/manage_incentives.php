<div id="body">
		<p style="font-size:16px;"><h2>Select the Executive</h2></p>
		<?php
			foreach ($executives as $executive) {
				echo anchor("manage/get_incentive/$executive->id", "$executive->firstname").'<br/>';
			}

		?>
	</div>

	<script type="text/javascript">
		$("div.header").html("<h1>Hello <i><?php echo $this->session->userdata('name') ?></i>, Give Incentives</h1>");
	</script>