
reg

<style>
    body.waiting {
    cursor: wait;
}
    th {
        text-align: right;
        padding: 8px;
        background-color: #ffffff;
    }

    td {
        padding: 8px;
        background-color: #ffffff;
    }

    .btn {
        background-color: #2925a5ff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #1f0a54ff;
        color: #b4eb0fff;
        font-weight: bold;
    }
</style>
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
use Joomla\CMS\Factory;

$model = $this->getModel('klienter');

// $model->scann_klienter();

if (isset($_POST["oppd"])) {
    echo $_POST['brukernavn'] . '<br>';
    $klient = $model->hent_klient($_POST['brukernavn'], $_POST['passord']);
    if ($klient) {
        echo 'Feil brukernavn eller passord<br>';
        echo 'Gå tilbake og prøv igjen<br>';
        echo $this->loadTemplate('reg');
    } else {

        echo 'ny bruker';
        $array = [
            'brukernavn' => $_POST['brukernavn'],
            'passord' => $_POST['passord'],
            'navn' => $_POST['navn'],
            'epost' => $_POST['epost'],
            'tlf' => $_POST['tlf'],
            'mal' => $_POST['malfil']
        ];
        echo 'oppretter klient, Vent...<br>';

        $klient1 = $model->opprett_klient($array);
        $base = $model->hent_mal($klient1,$_POST['malfil']);
        $session = Factory::getSession();
        $session->set('klient', $klient1["folder_name"]);
        echo $this->loadTemplate('firma');

    }
} else {
    $dir = "e:/sql/klientmaler";

    $files = scandir($dir);
    $list = [];

    ?>

    <form action="" method="POST">
        <table border="0" cellpadding="4" cellspacing="4" class="adminform"  onsubmit="showWaitCursor()">

            <th>Brukernavn:</th>
            <td><input type="text" name="brukernavn"></td>
            </tr>

            <tr>
                <th>Passord:</th>
                <td><input type="text" name="passord"></td>
            </tr>
            <tr>
                <th>Navn:</th>
                <td><input type="text" name="navn"></td>
            </tr>

            <tr>
                <th>Epost:</th>
                <td><input type="text" name="epost"></td>
            </tr>

            <tr>

            <tr>
                <th>Tlf:</th>
                <td><input type="text" name="tlf"></td>
            </tr>

   
                  <tr>
            <th>Mal:</th>
            <td>
                <select id="malfil" Name="malfil" style=" width:200px;" value>
                    <?php foreach ($files as $file)
                                if ($file != '.' && $file != '..') {
                                    echo "<option value='" . $file . "'>" . $file . "</option>";
                                } ?>
                        </select>
                    </td>
                </tr>

         <tr>
                <th></th>
                <td><input class="btn" type="submit" name="oppd" value="Opprett"></td>
            </tr>

        </table>
    </form>
    <?php
}
?>

    <script>
        function showWaitCursor() {
            document.body.classList.add('waiting');
        }
    </script>   