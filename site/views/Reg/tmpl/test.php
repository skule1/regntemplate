<?php

use Joomla\CMS\Factory;

$db = Factory::getDbo();
// use Joomla\CMS\Factory;
// $db = JFactory::getDbo();


$option = array(); //prevent problems

$option['driver']   = 'mysql';            // Database driver name
$option['host']     = 'localhost';    // Database host name
$option['user']     = 'admin';       // User for database authentication
$option['password'] = '230751';   // Password for database authentication
$option['database'] = 'test2';      // Database name
$option['prefix']   = 'qo7sn_';             // Database prefix (may be empty)

$db = JDatabaseDriver::getInstance( $option );



// $db = JFactory::getDBO();
// $conf = new JConfig();
// $database = $conf->db;
// $hash = $conf->dbprefix;
// $mode = 'R';
// $regnskapsar = "2010";

$sql = 'select * from #__regn_hist order by buntnr desc limit 1;';
$db->setQuery((string) $sql);
$messages = $db->loadObject();

$buntnr = $messages->Buntnr + 1;
echo 'Neste bunt: ' . $buntnr . '<br>';
?>
