<?php
require("\libraries\src\Factory.php");
//defined('_JEXEC') or die('Restricted access');

//$user = Factory::getUser();
//echo 'user: '.$user.'<br>';

$db    = Factory::getDBO();
	$query = $db->getQuery(true);
$query='select * from #__regn_firma;';
$db->setQuery((string) $query);
$mes=$db->loadObject();
$regnskapsar=$mes->regnskapsar;
echo 'regnskapsar: '.$regnskapsar.'<br>';
?>