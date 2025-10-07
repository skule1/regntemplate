<?php




use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;


$db = Factory::getDBO();
$query = $db->getQuery(true);
$query = 'select * from #__regn_kto where Ktonr=' . $_GET["ktonr"] . ' order by Ktonr';
$db->setQuery((string) $query);
$message = $db->loadObject();
$ktonr = $message->Ktonr;
$navn = $message->Navn;
?>