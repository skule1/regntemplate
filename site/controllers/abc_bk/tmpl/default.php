<?php
// header('Content-Type: text/html; charset=utf8mb4');
// /**
//  * @package     Joomla.Administrator
//  * @subpackage  com_helloworld
//  *
//  * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
//  * @license     GNU General Public License version 2 or later; see LICENSE.txt
//  */

// // No direct access to this file
// defined('_JEXEC') or die('Restricted access');

JLoader::register('RegnModelMyData', JPATH_COMPONENT . '/models/mydata.php');


echo "Hello World from /controllers/abc/tmpl/default.php";

$model = JModelLegacy::getInstance('MyData', 'RegnModel');
$data = $model->getData();

// Output or process your data
foreach ($data as $item) {
    echo $item->id.'  '. $item->beskrivelse.'<br>'; // Adjust field name according to your database structure
}

?>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    // jQuery(document).ready(function ($) {
    //     $('#my-button').on('click', function () {
    //         jQuery.ajax({
    //       //      url: 'index.php?option=com_regn&module=abc',//&method=getData',
    //             url: 'index.php?option=com_regn&task=getData',//regn1.handleAjax',
    //             type: "post",
    //             success: function (response) {
    //                 console.log(response);
    //             }
    //         });
    //     })}









    jQuery(document).ready(function($) {
        $('#my-button').on('click', function() {
            $.ajax({

                //      url: 'index.php?option=com_regn&task=abc.getData',
                url: 'index.php?option=com_regn&task=abc.add&format=json',
                type: 'GET',
                // format: 'html',








                //     url: "#",
                //     data:{controller:"abc",  task:"abc", format:"json"},
                //     //           url: 'index.php?option=com_ajax&module=Bilagsart',//&format=json',
                //  //    url: 'index.php?option=com_regn&task=abc.getData&format=xxx',
                //    //  url: 'http://index.php?option=com_regn&controller=abc',//&format=raw',//.getData&method=count&format=json',
                //     //  url: 'index.php?option=com_regn&task=getData',//&format=json',                    
                //     method: 'POST',
                //                url: '?option=com_regn&task=abc',//.getData',//&format=json',
                //         url: 'index.php?option=com_regn&task=regn1.handleAjax',//&' + Joomla.getOptions('csrf.token') + '=1', //format=json&
                //             url: 'default.php?option=com_regn&task=getData',//&format=json',
                //           url: 'default.php?option=com_regn&';//&format=json',

                //     url: '#',
                //       type: 'POST',
                // data: {
                //     param1: 'value1',
                //     param2: 'value2'
                // },
                success: function(response) {
                    // Handle the JSON response
                    console.log('AAJAX Success: ', response);
                    obj2 = JSON.parse(response);
                    console.log(obj2);
                    console.log(obj2.data);
                    //          $('#result').html('Response: ' + response.data);
                },
                error: function(xhr, status, error) {
                    console.log('AAJAX Error:', error);
                }
            });
        });
    });
</script>

<button id="my-button">Send AJAX Request</button>
<div id="result"></div>