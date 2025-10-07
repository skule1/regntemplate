
  <?php
  echo '0<br>';
//defined('_JEXEC') or die;
echo '1<br>';
//$db = Factory::getContainer()->get('DatabaseDriver'); //J4 onwards, outside of the Model or Table  
echo '2<br>';
$db = $this->_db; //only works in the model or table classes, J4 onwards

echo '3<br>';
$query = $db->getQuery(true);
$query->select($db->quoteName('Ktonr') . ',' . $db->quoteName('Navn'));
$query->from($db->quoteName('#__regn_kto'));
$db->setQuery($query);
echo 'query: '.$query.'<br>';
$results = $db->loadObjectList();

foreach ($results as $result) {
    echo $result->Ktonr . ' - ' . $result->Navn . '<br>';
}