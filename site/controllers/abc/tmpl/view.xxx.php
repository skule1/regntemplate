<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
//defined('_JEXEC') or die('Restricted access');

/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
class RegnViewXxx extends JViewLegacy
{
  /**
   * Display the Hello World view
   *
   * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
   *
   * @return  void
   */
  function display($tpl = null)
  {

    echo 'XXX  RegnViewAbc<br>';
    $this->msg = 'abc';

    // Display the view
    parent::display($tpl);
  }

  public function getData()
  {
    // echo 'getData<br>';
    // Set the view to 'example' and format to 'json'
    // $this->input->set('view', 'example');
    // $this->input->set('format', 'json');

    // Call the parent's display method which will trigger the view
    //  parent::display();
    $responseData = "getData abc";
    //   echo new JsonResponse($responseData);
    echo 'getdata abc<br>';
    //  echo json_encode($responseData);
    // Stop further execution to prevent Joomla from rendering the full page
    Factory::getApplication()->close();
  }












  // 	function doSomething(){

  // echo '	doSomething';
  // }


  // 		function display($tpl = null)
  // 	{

  // 		 echo 'RegnViewAbc<br>';
  // 		// Assign data to the view
  // 	$this->msg = 'Bilagsart';

  // 		// Display the view
  // 		parent::display($tpl);
  // 	}
}
