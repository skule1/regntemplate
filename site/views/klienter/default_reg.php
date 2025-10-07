<h1>
    <?php echo $this->msg; ?>
</h1>


<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


// $db    = JFactory::getDBO();
// $query = $db->getQuery(true);
// $query1='select * from #__trans_firmadata';
// $db->setQuery((string) $query1);
// $messages = $db->loadObjectList();
// $options  = array();
// if ($messages) {
//     foreach ($messages as $message) {        
//         $firmanavn = $message->firmanavn;
//         $fepost = $message->fepost;
//         $adresse=$message->adresse;
//         echo $firmanavn.'<br>'.$fepost.'<br>'.$adresse.'<br>';
//     }
// }


$model = $this->getModel('klienter');
$klientliste = $model->klientliste();
$lastElement = end($klientliste);
$lastEl = (string) $lastElement->ID + 1;
$element = 'reg' . str_repeat('0', 3) . $lastEl;

if (isset($_GET['idref'])) {
    $element = $_GET['idref'];
    $array = ["idref" => $_GET['id'], "ID" => $lastElement->ID + 1, "fornavn" => $_GET['fornavn']];
    $result = $model->opprett_klient($array);
    $fornavn = $_GET['fornavn'];
} else {
    $element = 'reg' . str_repeat('0', 3) . $lastEl;
    $fornavn = '';
}

?>

<!-- 
<script type="text/javascript">
function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=900,height=750');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();

}
</script>

 -->




<form action="">
    <table border="0 cellpadding=" 4" cellspacing="4" class="adminform">

        <tr>
            <td>Navn</td>
            <td><input type="text" name="fornavn" value="<?php echo $fornavn ?>"></td>
        </tr>

        <tr>
            <td>Epost</td>
            <td><input type="text" name="fornavn" value="<?php echo $fornavn ?></td>
                </tr>
                
                <tr>
                <td>Brukernavn</td>
                <td><input type=" text" name="brukernavn" value="<?php echo $brukernavn ?></td>
                </tr>
  
               
                <tr>
                <td>Passord</td>
                <td><input type=" text" name="passord" value="<?php echo $passord ?></td>
                </tr>
  
            <tr>
                <td>Tlf</td>
                <td><input type=" text" name="tlf" value="<?php echo $tlf ?></td>
                </tr>
 
            <tr>
                <td>Id</td>
                <td><input type=" text" name="idref" value="<?php echo $idref ?>"></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" value="Opprett"></td>
        </tr>

    </table>
</form>