


<?php

defined('_JEXEC') or die('Restricted access');
use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

//  $model = $this->getModel('klienter');



$model = $this->getModel('klienter');
//$klientliste = $model->lagre_klient($res);
$session = Factory::getSession();

$session->clear("klient");
