<?php
// Getting the URL for AJAX request
$ajaxUrl = JURI::base() . 'index.php?option=com_ajax&module=my_ajax_module&format=json';
?>

<script type="text/javascript">
jQuery(document).ready(function($) {
    $('#myButton').click(function() {
        $.ajax({
            url: "<?php echo $ajaxUrl; ?>",
            method: "POST",
            data: {
                action: "getData",
                value: "someValue"
            },
            success: function(response) {
                // Handle the response here
                $('#output').html(response.data);
            }
        });
    });
});
</script>

<button id="myButton">Click me</button>
<div id="output"></div>
