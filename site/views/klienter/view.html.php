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




//$modKlient = $this->getModel('klienter');




global $myGlobalVar;
// $myGlobalVar='';
// if (isset($_GET['epost'])) {
// 	echo $_GET['epost'];
// } else {
// 	echo 'No epost provided<br>';
// }
/**
 * HTML View class for the HelloWorld Component
 *
 * @since  0.0.1
 * class KlientViewAbc extends JViewLegacy
 */
global $myGlobalVar;
if (isset($_GET['bruker'])) {
	echo 'bruker: ' . $_GET['bruker'] . '<br>';
	echo 'pasord: ' . $_GET['passw'] . '<br>';
	if ($_GET["bruker"] != '') {
		$myGlobalVar = 'reg';
	}
} else {

	$app = JFactory::getApplication();
	$input = $app->input;

	$option = $input->getCmd('option'); // component
	$view = $input->getCmd('view');   // view
	$task = $input->getCmd('task');   // task

	if ($option === 'com_regn' && $view === 'klienter' && $task === 'edit') {
		$app->setTemplate('');
	}
}

// $modKlient = new KlientViewKlienter;

// $csvfil = $modKlient->hent_filnavn1	();

// $model = $this->getModel('klienter');
// $klientliste = $model->lagre_klient($res);

class RegnViewKlienter extends JViewLegacy
{
	/**
	 * Display the Hello World view
	 *
	 * @param   string  $tpl  The name of the template file to parse; automatically searches through the template paths.
	 *
	 * @return  void
	 */
	// $res = array(
//     'brukernavn' => $brukernavn,
//     'passord' => $passord,
//     'jsVar' => $base,
//     'firma' => $firma,
//     'telefon' => $telefon,
//     'mal' => $malid
// );








	function hent_filnavn1()
	{
		echo 'hent_filnavn1<br>';
	}
	function display($tpl = null)
	{

		global $myGlobalVar;

		// Print the global variable
		echo $myGlobalVar; // Outputs: Hello from Global Scope!

		// You can also assign it to the template
		// $this->myVar = $myGlobalVar;

		// $this->msg = 'Klienter';
		// if ($myGlobalVar != '')
		// 	$tpl = $myGlobalVar;
		//echo '  tpl: '.$tpl.'|'.$myGlobalVar.'|<br>';
		// Display the view
		parent::display($tpl);











		// //	echo "Tilbud<br>";
		// 	// Assign data to the view
		// 	$this->msg = 'Klienter';

		// 	// Display the view
		// 	parent::display($tpl);
	}
}


