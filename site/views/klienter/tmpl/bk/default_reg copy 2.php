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
$user = JFactory::getUser();
echo 'user: '.$user->username.'<br>';
$model = $this->getModel('klienter');

// $model->scann_klienter();
$session = Factory::getSession();
if (isset($_POST["oppd"])) {
    echo $_POST['navn'] . '<br>';
    $klient = $model->hent_klient($_POST['navn'], $_POST['passord']);
    if ($klient) {
        echo 'Feil brukernavn eller passord<br>';
        echo 'Gå tilbake og prøv igjen<br>';
        $session->clear('klient');
        echo $this->loadTemplate('reg');
    } else {

        echo 'ny bruker';
        $array = [
            'brukernavn' => $_POST['navn'],
            'passord' => $_POST['passord'],
            'navn' => $_POST['navn'],
            'epost' => $_POST['epost'],
            'tlf' => $_POST['tlf'],
            'mal' => $_POST['malfil']
        ];
        echo 'oppretter klient, Vent...<br>';

        $klient1 = $model->opprett_klient1($array);
        $base = $model->hent_mal($klient1, $_POST['malfil']);

        $session->set('klient', $klient1["folder_name"]);
        // $kj=$session->get('klient');
        // echo '$kj: '.$kj.'<br>';
        echo $this->loadTemplate('firma');
    }
} else {
    $dir = "c:/sql/klientmaler";

    $files = scandir($dir);
    $list = [];

?>
    <form action="" method="post">
        <table>
            <td>
                <table border="0" cellpadding="4" cellspacing="4" class="adminform" onsubmit="showWaitCursor()">
                    <tr>
                        <th>Brukernavn:</th>
                        <td><input type="text" name="bruker" onfocus="info('bruker')" onchange="bruker1('bruker')" id="bruker" value="">
                            <label for="bruker" id="brukerl"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Passord:</th>
                        <td><input type="text" name="passord" onfocus="info('passord')" onchange="passordf('passord')" id="passord" value="">
                            <label for="passord" id="passordl" value="a"></label>
                        </td>
                    </tr>
                    <tr>
                        <th>Virksomhetsnavn:</th>
                        <td><input type="text" name="navn" onfocus="info('navn')" onchange="bruker1('navn')" id="navn" value="">
                            <label for="navn" id="navnl" value="a"></label>
                    </tr>

                    <tr>
                        <th>Epost:</th>
                        <td><input type="text" name="epost" onfocus="info('epost')" onchange="epostf('epost')" id="epost" value="">
                            <label for="epost" id="epostl" value="a"></label>
                        </td>
                    </tr>

                    <tr>

                    <tr>
                        <th>Tlf:</th>
                        <td><input type="text" name="tlf" onfocus="info('tlf')" onchange="tlff('tlf')" id="tlf" value="">
                            <label for="tlf" id="tlfl" value="a"></label>
                        </td>
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
                        <td><input class="btn" disabled type="submit" name="oppd" value="Opprett" id="pass"></td>
                    </tr>

                </table>
            </td>

            <td>
                <!-- <table > -->

                <table id="myTable" hidden border="0" aria-disabled="true">
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="1">Privatregnskap</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="2">Enmannsforetak med avgiftsoppgjør</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="3">Fakturering</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="4">Lønn</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="5">Produksjonsbedrift</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="6">Handelsbedrift</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="big-checkbox" name="" id="7">Tjenesteyting</td>
                    </tr>
                </table>
            </td>

        </table>
    </form>
<?php
}
?>


<!-- <button onclick="document.getElementById('myTable').style.display='none'">Hide Table</button>
<button onclick="document.getElementById('myTable').style.display='table'">Show Table</button> -->






<script>
    function showWaitCursor() {
        document.body.classList.add('waiting');
    }
</script>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    function bruker1(mode) {
        var bruker = document.getElementById(mode).value;
        console.log("bruker", bruker);
        jQuery.ajax({
            type: "POST",
            url: ".index.php?option=com_regn&task=klienter.bruker",
            data: ({
                mode: mode,
                bruker: bruker
            }),
            cache: false,
            success: function(tekst) {
                console.log(tekst);
                if (tekst == 'ny')
                    document.getElementById(mode + 'l').innerText = 'Ok';
                else {
                    document.getElementById(mode + 'l').innerText = 'Brukernavnet er i bruk. Velg nytt brukernavn';
                    setTimeout(() => {
                        document.getElementById(mode).focus();
                    }, 2000);

                }
                // let obj4 = JSON.parse(tekst);
                // console.log(tekst);

            }
        })
        //     sjekk_ok();

    }

    function info(mode) {
        console.log("info", mode);
        var bruker = document.getElementById(mode).value;
        console.log("info", bruker);
        if (mode == "bruker")
            document.getElementById(mode + "l").innerText = 'Oppgi et nytt brukernavn';

        else if (mode == "passord")
            document.getElementById(mode + "l").innerText = 'Oppgi et passord på 8 bokstaver med minst en stor bokstav og et tall';
        else if (mode == "navn")
            document.getElementById(mode + "l").innerText = 'Oppgi et virksomhetsnavn';
        else if (mode == "epost")
            document.getElementById(mode + "l").innerText = 'Oppgi en gyldig epostadresse. Bekreftes på e-post';
        else if (mode == "tlf")
            document.getElementById(mode + "l").innerText = 'Oppgi et gyldig telefonnummer';




    }



    function passordf(mode) {
        console.log("info", mode);
        var bruker = document.getElementById(mode).value;
        document.getElementById(mode + "l").innerText = 'Ok';
        //  sjekk_ok();
    }


    function epostf(mode) {
        console.log("info", mode);
        var bruker = document.getElementById(mode).value;
        document.getElementById(mode + "l").innerText = 'Ok';
        //   sjekk_ok();
    }


    function tlff(mode) {
        console.log("info", mode);
        var bruker = document.getElementById(mode).value;
        document.getElementById(mode + "l").innerText = 'Ok';

        sjekk_ok();
    }

    function sjekk_ok() {
        let bruker = document.getElementById("brukerl").innerText;
        let passord = document.getElementById("passordl").innerText;
        let navn = document.getElementById("navnl").innerText;
        let epost = document.getElementById("epostl").innerText;
        let tlf = document.getElementById("tlfl").innerText;

        console.log("sjekk_ok: ", bruker, passord, navn, epost, tlf);

        if ((bruker == 'Ok') && (passord == 'Ok') && (navn == 'Ok') && (epost == 'Ok') && (tlf = 'Ok'))
            document.getElementById("pass").disabled = false;
    }
</script>s