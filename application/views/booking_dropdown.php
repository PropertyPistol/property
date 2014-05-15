<div id="body">
    <?php if($this->session->flashdata('error')){echo $this->session->flashdata('error');} ?>
    <?php if($this->session->flashdata('booking_deleted')){echo $this->session->flashdata('booking_deleted');} ?>
    <?php
    echo "<h3>Enter a valid Booking Id</h3>";
    echo validation_errors();
    echo form_open();
    echo form_input(array('name'=>'booking_name', 'class'=>'options', 'placeholder'=>'Unit-No', 'size'=>'20'),set_value('booking_id'));
    ?>
    <input type="hidden" name="booking_id" class="options-id" />
    <?php
    echo "<br/><sub>Help: Start typing the unit number and the booking id will be filled automatically</sub><br/><br/>";
    echo form_submit('submit', 'Submit');
    echo form_close();
    ?>
    <h3>All Bookings</h3>

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
        source: availableTags,
        select: function(event, ui){
            $( ".options" ).val( ui.item.label );
            $( ".options-id" ).val( ui.item.value );
            return false;
        }
    });
});
</script>
