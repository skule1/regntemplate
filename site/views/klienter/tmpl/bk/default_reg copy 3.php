<style>
    button2 {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
    }

    button1 {
        background-color: #2925a5ff;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;

    }

    /* Disabled button */
    button1:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
        opacity: 0.9;
    }

    body.waiting {
        cursor: wait;
    }

    .checkbox-spacing {
        margin-right: 25px;
    }

    .big-checkbox {
        width: 15px;
        height: 15px;
        accent-color: green;
        /* modern browsers */
        margin-right: 10px;
    }

    button:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
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


    .btn:disabled {
        background-color: #ccc;
        color: #666;
        cursor: not-allowed;
        opacity: 0.7;
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



if (isset($_GET["oppd"])) {
     //   $base = $model->hent_mal($klient1, $_POST['malfil']);
        echo 'base<br>';
}
else{

$user = JFactory::getUser();
echo 'user: ' . $user->username . '<br>';
echo 'database: ' . $user->authProvider . '<br>';

$dir = "c:/sql/klientmaler";
$files = scandir($dir);
$list = [];
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $list[] = $file;
    }
}
?>
    <form method="GET" action="">

    <table>
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
            <td><input  type="submit" name="oppd" value="Opprett" ></td>
        </tr>
    </table>
</form>
<?php
                    



// $model = $this->getModel('klienter');
// $kontoer=$model->kontoer();
// foreach ($kontoer as $konto)
// echo $konto->Ktonr.' '.$konto->Navn.'<br>';

// // $model->scann_klienter();
// $session = Factory::getSession();
}