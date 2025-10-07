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



echo "Hello World from /views/abc/tmpl/default.php<br>";
?>
<button id="my-button">Send AJAX Request</button>
<div id="result"></div>

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
            console.log('my-button');
            $.ajax({

                //      url: 'index.php?option=com_regn&task=abc.getData',
                url: 'index.php?option=com_regn&task=abc.getData',
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
                    //          $('#result').html('Response: ' + response.data);
                },
                error: function(xhr, status, error) {
                    console.log('AAJAX Error:', error);
                }
            });
        });
    });
</script>