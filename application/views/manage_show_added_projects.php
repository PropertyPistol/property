<h3>Projects Already are: </h3><sub>Click here to edit Project Names to edit them.</sub>
	<table width='100%' border='1px'>
		<tr>
			<th>Project Name</th>
			<th>Builder Name</th>
			<th>Brokerage</th>
		</tr>
	<?php foreach ($projects as $project) {
	?>
		<tr>
			<td><?php echo anchor("manage/edit_project/$project->id", $project->project); ?></td>
			<td><?php echo $project->builder; ?></td>
			<td><?php echo $project->brokerage; ?>%</td>
		</tr>
	<?php
	} ?>
		

	</table>