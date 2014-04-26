<div id="body">
<?php
	echo "<h3>Enter a valid Booking Id</h3>";
	echo form_open();
	echo form_input(array('name'=>'booking_id', 'class'=>'options', 'placeholder'=>'Unit-No', 'size'=>'20'),set_value('booking_id'));
	echo "<br/><sub>Help: Start typing the unit number and the booking id will be filled automatically</sub><br/><br/>";
	echo form_submit('submit', 'Submit');
	echo form_close();
?>

</div>
<script>
$(function() {
    var availableTags = [
        <?php foreach ($all_units as $key => $value) {
            echo '{';
                echo 'label: '.json_encode($value['unit_no'].' in '.$value['project']).", ";
                echo 'value: '.json_encode($value['id']);
            echo '},';
        } 
        ?>
    ];

    $( ".options" ).autocomplete({
        source: availableTags
    });
});
</script>
