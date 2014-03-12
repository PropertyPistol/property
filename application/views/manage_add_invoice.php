
	
	<div id="body">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)){echo $error; }?>
        <h1>1. Add Invoice Data</h1>
		<?php echo form_open(); ?>
		<p>Invoice Number:
		<?php echo form_input(array('name'=>'invoice_no', 'id'=>'invoice_no'), set_value('invoice_no')); ?></p>
        <p>Invoice Amount:
        <?php echo form_input(array('name'=>'invoice', 'id'=>'invoice'), set_value('invoice')); ?></p>

       <?php
        $options = array(
                          'Jan'  => 'January',
                          'Feb'    => 'February',
                          'Mar'   => 'March',
                          'Apr' => 'April',
                          'May' => 'May',
                          'Jun' => 'June',
                          'Jul' => 'July',
                          'Aug' => 'August',
                          'Sept' => 'September',
                          'Oct' => 'October',
                          'Nov' => 'November',
                          'Dec' => 'December',
                        );


        echo form_dropdown('invoice_month', $options); 
        ?>

        <?php echo form_submit('submit', 'Submit Data'); ?>
		<?php echo form_close(); ?>
        <h1>2. Invoice Already added:</h1>
        <?php if($invoices){ ?>
        <table border="1px">
            <tr>
                <th>Invoice No.</th>
                <th>Invoice Value</th>
                <th>Invoice Month</th>
            </tr>
            <?php foreach ($invoices as $invoice) {
                echo "<tr><td>$invoice->invoice_no</td><td>$invoice->invoice</td><td>$invoice->invoice_month</td></tr>";
            } ?>
        </table>
        <?php }else{ ?>
        <?php echo "You have Not Entered Any Data";} ?>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Add Invoice</h1>");

	</script>
