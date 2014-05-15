	
	<div id="body">
		<?php if($this->session->flashdata('project_deleted')){echo $this->session->flashdata('project_deleted');} ?>
		<?php echo validation_errors(); ?>
		<?php echo form_open(); ?>

				<p><h2>Enter Project Name: </h2>
					<?php echo form_input(array('name'=>'project', 'size'=>'70'),set_value('project')); ?>
				</p>
				<p><h2>Enter Builder: </h2>
					<?php echo form_input(array('name'=>'builder', 'size'=>'70'),set_value('builder')); ?>
				</p>
				<p><h2>Enter Brokerage: </h2>
					<?php echo form_input(array('name'=>'brokerage', 'size'=>'10'),set_value('brokerage')); ?><sub>%</sub>
				</p>
