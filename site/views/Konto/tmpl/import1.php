<?php
$db = JFactory::getDBO();
$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;
$mode = 'R';
$regnskapsar = "2010";


$sql = 'select * from qo7sn_regn_hist order by buntnr desc limit 1;';
$db->setQuery((string) $sql);
$messages = $db->loadObject();
if ($messages) {
    foreach ($messages as $message) {
        echo 'bunt: ' . $message->Buntnr . '<br>';
    }
}


$sql = 'select * from qo7sn_regn_hist  WHERE Regnskapsar=2022 order by bilag desc limit 1;';
$db->setQuery((string) $sql);
$messages = $db->loadObjectList();
if ($messages) {
    foreach ($messages as $message) {
        echo 'bilag: ' . $message->Bilag . '<br>';
    }
}
?>