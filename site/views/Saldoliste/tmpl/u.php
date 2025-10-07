<?php
$db    = JFactory::getDBO();
$query = 'select * from qo7sn_regn_firma;';
$db->setQuery((string) $query);
$message = $db->loadObject();
$gg = json_encode($message->konfig);
echo json_encode($message ).'<br>';
//echo $message->Firmanavn.'<br>';
//echo $message->konfig.'<br>';
?>