<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
//echo 'view.html.php - Registrering';
// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
//  */
// class RegnViewSok extends JViewLegacy
// {
// 	/**
// 	 * Display the Hello World view
// 	 *
// 	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
// 	 *
// 	 * @return  void
// 	 */
// 	function display($tpl = null)
// 	{
// 	$sok2= new	RegnModelsok;
// 	echo $sok2->getListQuery();
// 		// Assign data to the view
// 	$this->msg = 'Søk';

// 		// Display the view
// 		parent::display($tpl);
// 		//echo 'tpl: '.$tpl.'<br>';
// 	}
// }


use Joomla\CMS\MVC\View\HtmlView;

class RegnViewSok extends HtmlView
{
    public function display($tpl = null)
    {
        // Get the data from the model
        // $this->items = $this->get('Items');
        // $this->pagination = $this->get('Pagination');
 		$this->msg = 'Søk';


		// if ($message1) {
		// 	foreach ($message1 as $message) {
		// 		echo $message->Dato . '<br>';
		// 	}
		// }
		// echo $sok2[0]['Dato'].'<br>';
        // Check for errors
        // if (count($errors = $this->get('Errors')))
        // {
        //     throw new Exception(implode("\n", $errors), 500);
        // }

        parent::display($tpl);
    }
}
