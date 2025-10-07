<?php
//defined('_JEXEC') or die('Restricted access');
echo '
start
';
//include './components/com_regn/views/Registrering/tmpl/configuration.php';
require  './configuration.php';
$conf = new JConfig();
$database=$conf->db;
$hash= $conf->dbprefix;

echo 'hash:'.$hash.'<br>';
?>