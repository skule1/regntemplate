<?php
// Initialize Joomla framework 
define( '_JEXEC', 1 );
define('JPATH_BASE', 'e:\xampp\htdocs\' );


// Required Files 

require_once( JPATH_BASE .'/configuration.php' );

// Load configuration
$conf =& JFactory::getConfig();
$config = new JConfig();
$conf->loadObject($config);

$host = $conf->getValue('config.host');
$user = $conf->getValue('config.user');
$password = $conf->getValue('config.password');
$database = $conf->getValue('config.db');

echo $host.' : '.$user.' : '.$password.' : '.$database .'<br>';
?>