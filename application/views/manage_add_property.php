<div id="body">
	<?php echo validation_errors(); ?>
	<?php echo form_open(); ?>
	<p>Enter Project Name: 
	<?php echo form_input(array('name'=>'project', 'size'=>'70'),set_value('project')); ?></p>
	<p>Enter Builder: 
	<?php echo form_input(array('name'=>'builder', 'size'=>'70'),set_value('builder')); ?></p>
	<p>Enter Brokerage: 
	<?php echo form_input(array('name'=>'brokerage', 'size'=>'10'),set_value('brokerage')); ?><sub>%</sub></p>
	<?php echo form_submit('submit', 'Submit'); ?>
	<?php echo form_close(); ?>

	<h3>Projects Already are: </h3><sub>Click on Project Names to add their units.</sub>
	<table width='100%' border='1px'>
		<tr>
			<th>Project Name</th>
			<th>Builder Name</th>
			<th>Brokerage</th>
		</tr>
	<?php foreach ($projects as $project) {
	?>
		<tr>
			<td><?php echo anchor("manage/add_unit_value/$project->id", $project->project); ?></td>
			<td><?php echo $project->builder; ?></td>
			<td><?php echo $project->brokerage; ?>%</td>
		</tr>
	<?php
	} ?>
		

	</table>

</div>

<script type="text/javascript">
		$("div.header").html("<h1>Add a Project</h1>");
	</script>