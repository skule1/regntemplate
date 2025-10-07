<?php

// class HelloWorldControllerHelloWorld extends JControllerForm
// class HelloWorldController extends JControllerLega
// class RegnController extends BaseController


// use Joomla\CMS\Factory;
// use Joomla\CMS\MVC\Controller\BaseController;

// require_once __DIR__ . '/jsonresponse.php';

// class RegnControllerRegn1 extends BaseController
// {
//     public function yourtask()
//     {
//         // Call the JSON view
//      //   $this->setRedirect(JRoute::_('index.php?option=com_regnt&task=.display'));
//         $result = "halloooAA";
//         echo json_encode($result);
//         JFactory::getApplication()->close();
//     }
// }


defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

// echo 'controllers<br>';
class RegnControllerRegn1 extends BaseController
{
  
    public function handleAjax()
    {
        // Get the input from the AJAX request
        $input = Factory::getApplication()->input;
        $param1 = $input->getString('param1', '');
        $param2 = $input->getString('param2', '');

        // Process the data as necessary
        $processedData = 'Received param1 CONTROLLERS: ' . $param1 . ', param2: ' . $param2;

        // Prepare the response data
        $responseData = array(
            'data' => $processedData
        );

        // Send a JSON response back to the client
        echo new JsonResponse($responseData);
      //  echo json_encode($responseData);
        // Stop further execution to prevent Joomla from rendering the full page
        Factory::getApplication()->close();
    }


    public function getData()
    {
        // Set the view format to JSON
        $this->input->set('view', 'example');
        $this->input->set('format', 'json');

        // Call the parent display method to render the view
        parent::display();
    }


}















//echo 'rrretttur<br>';


        // Get the input from the AJAX request
    //     $input = Factory::getApplication()->input;
    //     $param1 = $input->getString('param1', '');
    //     $param2 = $input->getString('param2', '');

    //     // Process the data as necessary
    //     $processedData = 'Received param1: ' . $param1 . ', param2: ' . $param2;

    //     // Prepare the response data
    //     $responseData = array(
    //         'data' => $processedData
    //     );

    //     // Send a JSON response back to the client
    //     echo new JsonResponse($responseData);

    //     // Stop further execution to prevent Joomla from rendering the full page
    //     JFactory::getApplication()->close();
    // }





?>