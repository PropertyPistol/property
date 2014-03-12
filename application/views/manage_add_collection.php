
	
	<div id="body">
		<?php echo validation_errors(); ?>
		<?php if(isset($error)){echo $error; }?>
        <h1>1. Add Collection Data</h1>
		<?php echo form_open(); ?>
		<p>Collection Number:
		<?php echo form_input(array('name'=>'collection_no', 'id'=>'invoice_no'), set_value('invoice_no')); ?></p>
        <p>Collection Amount:
        <?php echo form_input(array('name'=>'collection', 'id'=>'invoice'), set_value('invoice')); ?></p>

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

        ?> 
        <p>Collection Month:
        
        <?php
        echo form_dropdown('collection_month', $options); 
        ?></p>

        <?php echo form_submit('submit', 'Submit Data'); ?>
		<?php echo form_close(); ?>
        <h1>2. Collection Already added:</h1>
        <?php if($collections){ ?>
        <table border="1px">
            <tr>
                <th>Collection No.</th>
                <th>Collection Value</th>
                <th>Collection Month</th>
                <th>Outstanding</th>
            </tr>
            <?php foreach ($collections as $collection) {
                echo "<tr><td>$collection->collection_no</td><td>$collection->collection</td><td>$collection->month</td><td>$collection->net_outstanding</td></tr>";
            } ?>
        </table>
        <?php }else{ ?>
        <?php echo "You have Not Entered Any Data";} ?>
	</div>
	<script type="text/javascript">
		$("div.header").html("<h1>Add Collection</h1>");

	</script>
