<style>
    th {
        text-align: right;
        padding: 8px;
        background-color: #ffffff;
    }

    h1 {
        color: red;
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

use Joomla\CMS\Factory;

$model = new RegnModelKlienter;
$user = JFactory::getUser();
$username = $user->username;
$database = $user->authProvider;
// echo 'username: ' . $username . '<br>';
// echo 'database: ' . $database . '<br>';

if (isset($_POST["klient"]))
    echo 'klient<br>';
else if (isset($_POST["firma"])) {

    new stdClass();
    $firmarec = new stdClass();
    $firmarec->firmanavn = $_POST["firmanavn"];
    $firmarec->adresse = $_POST["adresse"];
    $firmarec->regnskapsar = $_POST["regnskapsar"];
    $firmarec->kontaktperson = $_POST["kontaktperson"];
    $firmarec->telefon = $_POST["telefon"];
    $firmarec->postnr = $_POST["postnr"];
    $firmarec->poststed = $_POST["poststed"];
    $firmarec->epost = $_POST["epost"];
    $firmarec->brukernavn = $_POST["brukernavn"];
    $model->oppdater_firma($firmarec);

} else if (isset($_POST["saldo1"])) {
    $user = JFactory::getUser();
    $database = $user->authProvider;
    if ($database[0] == "r")
        $user->authProvider = '$' . $user->authProvider;
    $model->oppdater_user($user);
    $firma = $model->hent_firma();
    $ar = $firma["regnskapsar"];
    $model->lag_balansesaldo($ar);
    echo $this->loadTemplate('balanse');
    return;
}


function oppdater_user($user)
{
    $db = Factory::getDbo();
    $sql = $db->getQuery(true);
    $sql = 'update qo7sn_users qo7sn_users set authProvider="' . $user->authProvider . '" where username="' . $user->username . '";';
    $db->setQuery((string) $sql);
    try {
        $ret = $db->execute(true);
    } catch (Exception $e) {
        echo 'Error fetching row: ' . $e->getMessage() . '<br>';
    }
}


$database = $model->get_database();


echo '<h1>Profildata</h2>';
// $session = Factory::getSession();
//$database = $session->get('klient');
//echo 'database: ' . $database . '<br>';

$firma = $model->hent_firma();
//$klient = $model->hent_klient1($database);
$user = JFactory::getUser();
if ($database)
    echo '<h5>Klient: ' . $user->name . '</h5><br>';







$dir = "c:/sql/klientmaler";
$files = scandir($dir);
$list = [];
foreach ($files as $file) {
    if ($file != '.' && $file != '..') {
        $list[] = $file;
    }
}


?>
<form action="" method="POST">
    <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td colspan="3">
                <input class="btn" type="submit" name="firma" value="Oppdater firmaregister" id="">
                <input class="btn" type="submit" name="saldo1" value="Endring på balansesaldo" id="">
                <input class="btn" type="submit" name="mal" value="Ny registermal" id="">
            </td>
            <td></td>
        </tr>

        <tr>

            <th>Virksomhet:</th>
            <td> <input id="Firmanavn" name="firmanavn" value="<?php echo $firma['Firmanavn']; ?>"></td>
        </tr>
        <tr>

            <th>Adresse:</th>
            <td> <input id="adresse" name="adresse" value="<?php echo $firma['Adresse']; ?>"></td>
        </tr>
        <tr>

            <th>Postnr:</th>
            <td> <input id="postnr" name="postnr" onchange="postg()" value="<?php echo $firma['Postnr']; ?>"></td>
            <td> <input id="poststed" name="poststed" tabindex="-1"></td>
            <td><label for="folder_name"></label></td>
        </tr>
        <tr>

            <th>Telefon:</th>
            <td> <input id="telefon" name="telefon" value="<?php echo $firma['telefon']; ?>"></td>
        </tr>
        <tr>

            <th>E-post:</th>
            <td> <input id="epost" onchange="postg()" name="epost" value="<?php echo $firma['epost']; ?>"></td>
        </tr>
        <tr>
            <th>Kontaktperson:</th>
            <td> <input id="kontaktperson" name="kontaktperson" value="<?php echo $firma['kontaktperson']; ?>"></td>
        </tr>
        <tr>
            <th>Debitor kto:</th>
            <td> <input id="debitor" name="debitor" value="<?php echo $firma['debitorkto']; ?>"></td>
        </tr>
        <tr>
            <th>Kreditorkto:</th>
            <td> <input id="kreditor" name="kreditor" value="<?php echo $firma['kreditorkto']; ?>"></td>
        </tr>
        <tr>
            <th>Neste bilagsnr:</th>
            <td> <input id="bilagsnr1" name="bilagsnr1" value="<?php echo $firma['neste_bilagsnr']; ?>"></td>
        </tr>
        <tr>
            <th>Neste buntnr:</th>
            <td> <input id="buntnr" name="buntnr" value="<?php echo $firma['buntnr']; ?>"></td>
        </tr>
        <tr>
            <th>Valgt periode:</th>
            <td> <input id="periode" name="periode" value="<?php echo $firma['periode']; ?>"></td>
        </tr>
        <tr>
            <th>Neste bilagsnr:</th>
            <td> <input id="bilagsnr" name="bilagsnr" value="<?php echo $firma['bilagref']; ?>"></td>
        </tr>
        <tr>
            <th>Regnskapsår:</th>
            <td> <input id="regnskapsar" name="regnskapsar" value="<?php echo $firma['regnskapsar']; ?>"></td>
        </tr>
        <tr>
            <th>Regnskapsmodus:</th>
            <td> <input id="regnskapsmodus" name="regnskapsmodus" value="<?php echo $firma['regnskapsmodus']; ?>"></td>
        </tr>
        <tr>
            <th>Skannet lagringsmappe:</th>
            <td> <input id="lagringsmappe" name="lagringsmappe" value="<?php echo $firma['Skannet_lagringsmappe']; ?>">
            </td>
        </tr>
        <tr>
            <th>Konfig:</th>
            <td> <input id="konfig" name="konfig" value="<?php echo $firma['konfig']; ?>"></td>
        </tr>
        <tr>
            <th>Brukernavn:</th>
            <td> <input id="brukernavn1" name="brukernavn" value="<?php echo $user->username; ?>"></td>
        </tr>
        <tr>
            <th>Bruker:</th>
            <td> <input id="brukernavn1" name="name" value="<?php echo $user->name; ?>"></td>
        </tr>
        <tr>
            <th>Passord:</th>
            <td> <input id="passord1" name="passord1" value="<?php echo $firma['passord']; ?>"></td>
        </tr>
        <tr>

            <th>database:</th>
            <td> <input id="psw1" name="psw1" value="<?php echo $user->authProvider; ?>"></td>
        </tr>
    </table>

</form>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    function bruker1() {
        var bruker = document.getElementById('bruker').value;
        console.log("bruker", bruker);
        jQuery.ajax({
            type: "POST",
            url: ".index.php?option=com_regn&task=klienter.bruker",
            data: ({
                bruker: bruker
            }),
            cache: false,
            success: function (tekst) {
                console.log(tekst);
                if (tekst == 'ny')
                    document.getElementById('label').innerText = 'ny';
                else {
                    document.getElementById('label').innerText = 'gammel';
                    document.getElementById('bruker').focus();
                }
                // let obj4 = JSON.parse(tekst);
                // console.log(tekst);

            }
        })
    }

    function postg() {
        var postnr = document.getElementById('postnr').value;
        console.log("postg", postnr);
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=klienter.postnummer",
            data: ({
                postnr: postnr
            }),
            cache: false,
            success: function (tekst) {
                console.log("tekst", tekst);
                document.getElementById('poststed').value = tekst;
                document.getElementById('telefon').focus();

            }
        })


    }
</script>