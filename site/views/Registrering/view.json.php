<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
echo 'start RegnViewRegistrering JSON  <br>';
/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
class RegnViewRegistrering extends JViewLegacy
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
		echo 'display view.html.php<br>';
		// Assign data to the view
		$this->msg = 'Registrering';

		// Display the view
		parent::display($tpl);
		//echo 'tpl: '.$tpl.'<br>';
	}
	
	
	//  public function display($tpl = null)
	// {



	// 	// Get the data you want to return
	// 	$data = array(
	// 		'message' => 'Hello, this is a JSON response!',
	// 		'status' => 'success',
	// 	);

	// 	// Set the response header to application/json
	// 	$this->getApplication()->setHeader('Content-Type', 'application/json');

	// 	// Output the JSON encoded data
	// 	echo json_encode($data);

	// 	// Close the application to prevent Joomla from loading the full page
	// 	$this->getApplication()->close();








		// echo 'display view.html.php<br>';
		// // Assign data to the view
		// $this->msg = 'Registrering';

		// // Display the view
		// parent::display($tpl);
		// //echo 'tpl: '.$tpl.'<br>';
	}



// 	 function display($tpl = null)
// 	 {
// 		echo 'display view.json.php<br>';
// 	// 	// Assign data to the view
// 	// $this->msg = 'Registrering';

// 	// 	// Display the view
// 	// 	parent::display($tpl);
// echo 'RegnViewRegistrering<br>';
// 	 }
	}