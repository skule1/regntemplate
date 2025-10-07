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

/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 */
//$model = $this->getModel('resultat');
//$hist = $model->historikk(2023);

//$startvariable = $model->startvariable();

class RegnViewResultat extends JViewLegacy
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

		// Assign data to the view
		$this->msg = 'Resultat';

		// Display the view
		parent::display($tpl);
	}
}


/*
class RegnViewResultat extends JViewLegacy
{

	function display($tpl = null)
	{

		$this->msg = 'Resultatrapport';


		$conf = new JConfig();
		$database = $conf->db;
		$hash = $conf->dbprefix;

		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		$query = 'select * from #__regn_firma;';
		$db->setQuery((string) $query);
		$message = json_encode($db->loadObject());
		echo $message.'<br>';
	}
}
*/