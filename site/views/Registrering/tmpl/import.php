

<?php
$db = JFactory::getDBO();
$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;
$mode = 'R';
$regnskapsar = "2010";


$sql = 'select * from import1;';
$db->setQuery((string) $sql);
$messages3 = $db->loadObjectList();

if ($messages1) {
    foreach ($messages1 as $message1) {
        echo '<option value="' . $message1->dato . '">' . $message1->belop . '  ' . $message1->tekst . '</option>';
    }
}