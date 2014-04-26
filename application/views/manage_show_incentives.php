<div id="body">
		<p style="font-size:16px;"></p>
	</div>
	<p>Total Business Done: 
	<?php echo sizeof($incentive_array); ?></p>
	
	<?php
	$business_amount = 0;
	$effective_bamount = 0;
	$collected_amount = 0;
	$effective_camount = 0;
	$percent_collected = 0;
	$spot_inc = 0;
	$first_inc = 0;
	$second_inc = 0;
	$third_inc = 0;
	$reversed = 0;
	$eff_r_amt = 0;
	foreach ($incentive_array as $incentives) {
		$business_amount += $incentives->revenue;
		$effective_bamount += ($incentives->revenue*$incentives->contribution)/100;
		if($incentives->collected==1){
			$collected_amount += $incentives->revenue;
			$effective_camount += ($incentives->revenue*$incentives->contribution)/100;
		}
		if($incentives->is_reversed == 1){
			$reversed += $incentives->revenue;
			$eff_r_amt = ($incentives->revenue->contribution)/100;
		}

	}
	$effect_of_reversal = $eff_r_amt*0.2;
	if($effective_bamount>100000&&$effective_bamount<250000){
		$inc_percent = 5;
	}elseif ($effective_bamount>=250000&&$effective_bamount<350000) {
		$inc_percent = 7;
	}elseif ($effective_bamount>=350000&&$effective_bamount<500000) {
		$inc_percent = 8;
	}elseif ($effective_bamount>=500000&&$effective_bamount<650000) {
		$inc_percent = 9;
	}elseif ($effective_bamount>=650000) {
		$inc_percent = 10;
	}else{
		$inc_percent = 0;
	}
	if($effective_bamount){	
		$percent_collected = ($effective_camount/$effective_bamount)*100;
		$spot_inc = (0.2*$effective_bamount*$inc_percent)/100;
		if ($percent_collected>=40&&$percent_collected<70) {
			$first_inc = (0.15*$effective_bamount*$inc_percent)/100;
		}elseif ($percent_collected>=70&&$percent_collected<100) {
			$first_inc = (0.15*$effective_bamount*$inc_percent)/100;
			$second_inc = (0.25*$effective_bamount*$inc_percent)/100;
		}elseif ($percent_collected==100) {
			$first_inc = (0.15*$effective_bamount*$inc_percent)/100;
			$second_inc = (0.25*$effective_bamount*$inc_percent)/100;
			$third_inc = (0.40*$effective_bamount*$inc_percent)/100;
		}
	}
	if($percent_collected<40){
		$release_amount = '<br/>Spot Incentive : '.$spot_inc;
	}elseif ($percent_collected>=40&&$percent_collected<70) {
		$release_amount = '<br/>Spot Incentive : '.$spot_inc.'<br/>40% Complete : '.$first_inc;
	}elseif ($percent_collected>=70&&$percent_collected<100) {
		$release_amount = '<br/>Spot Incentive : '.$spot_inc.'<br/>40% Complete : '.$first_inc.'<br/>70% Complete : '.$second_inc;
	}elseif ($percent_collected==100) {
		$release_amount = '<br/>Spot Incentive : '.$spot_inc.'<br/>40% Complete : '.$first_inc.'<br/>70% Complete : '.$second_inc.'<br/>100% Complete : '.$third_inc ;
	}else{
		$release_amount = 'Invalid';
	}

	?>
	<p>Total Business Done(Amount): 
	<?php echo $effective_bamount.' Rs'; ?></p>

	<p>Incentive Slab: 
	<?php echo $inc_percent.'%'; ?></p>

	<p>Amount Collected: 
	<?php echo $collected_amount.' Rs'; ?></p>

	<p>Effective Collection for Employee (Considering contribution): 
	<?php echo $effective_camount.' Rs'; ?></p>

	<p>Percentage Collected: 
	<?php echo $percent_collected.' Rs'; ?></p>

	<p>Amount to be released (Incentive Split): 
	<?php echo $release_amount.' Rs'; ?></p>

	<p>Reversed Amount: 
	<?php echo $eff_r_amt.' Rs'; ?></p>
	
	<p>Effect on Incentive due to this Reversal amount: 
	<?php echo $effect_of_reversal.' Rs'; ?></p>


	<?php echo anchor("manage/freeze_incentive/$executive_id/$month/$spot_inc/$first_inc/$second_inc/$third_inc", 'Incentives Given', array('onClick'=>"return confirmation();")); ?>

	<script type="text/javascript">
		$("div.header").html("<h1>Hello <i><?php echo $this->session->userdata('name') ?></i>, Viewing Incentives Split</h1>");
		
		function confirmation() {
              return confirm("Are you sure?")
          }
	</script>