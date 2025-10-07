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
//echo 'view'.'<br>';
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
		//echo 'HTML RegnViewRegistrering<br>';


		// Assign data to the view
	$this->msg = 'Registrering';

		// Display the view
		parent::display($tpl);
		//echo 'tpl: '.$tpl.'<br>';
	}
}