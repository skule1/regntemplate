<?php
use Joomla\CMS\Factory;
$id=0;
echo 'test<br>';
	$db    = JFactory::getDBO();
	$query = $db->getQuery(true);
$query='select * from #__regn_firma;';
$db->setQuery((string) $query);
$mes=$db->loadObject();
$regnskapsar=$mes->regnskapsar;
echo 'Regnskapsår: '.$regnskapsar.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
?>