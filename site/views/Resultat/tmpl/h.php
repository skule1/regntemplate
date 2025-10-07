<?php


function h(){
    echo 'fra tmpl<br>';

    $id = 0;
$db = JFactory::getDBO();
$query = $db->getQuery(true);

$query = 'select * from #__regn_regnskapsar order by regnskapsar desc;';
$db->setQuery((string) $query);
$mes = $db->loadColumn();
//echo $mes[2];
$nr = 0;
$ant = $db->getCount();
echo 'ant '.$ant.'<br>';
}
?>
