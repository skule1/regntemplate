<?php
defined('_JEXEC') or die;

jimport('joomla.application.component.view');
echo 'raw  ';
class SimilarViewAbc extends JView
{
    
    function display($tpl = null)
    {
        echo 'XXX RegnViewAbc<br>';
          parent::display($tpl);



        // // We assume that the whatver you do was a success.
        // $response = array("success" => true);
        // // You can also return something like:
        // $response = array("success" => false, "error" => "Could not find ...");

        // // Get the document object.
        // $document = JFactory::getDocument();

        // // Set the MIME type for JSON output.
        // $document->setMimeEncoding('application/json');

        // // Change the suggested filename.
        // JResponse::setHeader('Content-Disposition', 'attachment;filename="result.json"');

        // echo json_encode($response);












    }



}