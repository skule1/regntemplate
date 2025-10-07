<?php
// defined('_JEXEC') or die;

// use Joomla\CMS\MVC\View\JsonView;

// class RegnViewAbc extends JsonView
// {
//     public function display($tpl = null)
//     {
//         // Get the model
//         $model = $this->getModel();

//         // Get data from the model (process your data here)
//         $data = $model->getSomeData();

//         // Prepare the response array
//         $response = array(
//             'status' => 'success',
//             'data'   => $data
//         );

//         // Set the response (this will automatically be converted to JSON)
//         $this->setData($response);
        
//         // Render the view as JSON
//         parent::display($tpl);
//     }
// }
?>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    
    jQuery(document).ready(function($) {
        $('#my-button').on('click', function() {
            $.ajax({
                url: 'default.php?option=com_example&task=example.getData',//&format=json',
                type: 'POST',
                data: {
                    param1: 'value1',
                    param2: 'value2'
                },
                success: function(response) {
                    // Handle the JSON response
                    console.log('AJAX Success:', response);
                    $('#result').html('Response: ' + response.data);
                },
                error: function(xhr, status, error) {
                    console.log('AJAX Error:', error);
                }
            });
        });
    });
</script>

<button id="my-button">Send AJAX Request</button>
<div id="result"></div>
