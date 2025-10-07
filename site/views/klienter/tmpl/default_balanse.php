<style>
    th {

        margin-right: 10px;
        margin-left: 10px;
        padding: 2px 2px;
    }

    td {

        margin-right: 10px;
        margin-left: 10px;
        padding: 2px 2px;
    }

    .td1 {
        width: 60px;
        text-align: right;
        padding: 0 px 10px;
    }

    input {
        text-align: right;
        border-width: 0px;
    }

    .btn {
        background-color: #2925a5ff;
        color: white;
        padding: 7px 20px;
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

/*
loadResult() : single value from one resourcebundle_get_error_code
loadRow() : Single record use index id   (returns an indexed array from a single record in the table:)
loadAssoc() : Single record  use fieldname      (returns an associated array from a single record in the table:)
loadObject() : php object (loadObject returns a PHP object from a single record in the table:)
loadColumn() : all records from a singel coloumn (returns an indexed array from a single column in the table:)
loadColumn($index)  : all records from multiple records (returns an indexed array from a single column in the table:)
loadRowList() : (returns an indexed array of indexed arrays from the table records returned by the query:)
loadAssocList()  :  ( returns an indexed array of associated arrays from the table records returned by the query:)
loadAssocList($key) :  (returns an associated array - indexed on 'key' - of associated arrays from the table records returned by the query:)
loadAssocList($key, $column) :  ( returns an associative array, indexed on 'key', of values from the column named 'column' returned by the query:)
loadObjectList()  :  (returns an indexed array of PHP objects from the table records returned by the query:)
loadObjectList($key) :  (returns an associated array - indexed on 'key' - of objects from the table records returned by the query:)
https://docs.joomla.org/Special:MyLanguage/Selecting_data_using_JDatabase
*/
defined('_JEXEC') or die('Restricted access');
global $model;
$model = $this->getModel('klienter');
$kontoer = $model->kontoer("B");
$firma = $model->hent_firma();
$model->hent_saldo($firma["regnskapsar"]);

// function get_database()
// {
//     global $model;
//     $user = JFactory::getUser();
//     $username = $user->username;
//     $database = $user->authProvider;
//     if ($database) {
//         if (($database[0] == "X") || ($database[0] == "$"))
//             $database = substr($database, 1);
//         $database = $database . '.';
//     }
//     $model->oppdater_user($user);
// }


if (isset($_POST["nymal"])) {
    // echo 'mmy mal<br>';s
    echo $this->loadTemplate('reg');
    return;
}
// else if (isset($_POST["trans"])) {
//     // echo 'mmy mal<br>';
//     header("Location: /bilagsregistrering?view=Registrering");
//     exit; // always call exit after header redirects
//     $app = Factory::getApplication();

//     // Redirect to a specific view of a component
//     $app->redirect(
//         Route::_('index.php/bilagsregistrering?view=Registrering', false)
//     );
// }
else if (isset($_POST["balansesaldo"])) {
    //   echo 'neste<br>';
    $user = JFactory::getUser();
    $username = $user->username;
    $database = $user->authProvider;
    $regnskapsar = $model->regnskapsar();
    //  $database=$model->get_database().'.';
    if (($database[0] == "X") || ($database[0] == "$"))
        $database = substr($database, 1);
    $user->authProvider = $database;
    $regnskapsar = $model->regnskapsar();
    $model->oppdater_user($user);
    $model->oppdater_saldo($regnskapsar);
    echo $this->loadTemplate('firma');
    return;
} else if (isset($_POST["hent"])) {
    //   echo 'neste<br>';
    unset($_POST["hent"]);
    $user = JFactory::getUser();
    $username = $user->username;
    $database = $user->authProvider;
    $regnskapsar = $model->regnskapsar();
    //  $database=$model->get_database().'.';
    if (($database[0] == "X") || ($database[0] == "$"))
        $database = substr($database, 1);
    $user->authProvider = $database;
    //  $firma=$model->hent_firma();
    $regnskapsar = $firma["regnskapsar"];
    $model->oppdater_user($user);
  //  $model->hent_saldo($regnskapsar);

    // echo $this->loadTemplate('balanse');
    // return;
}





// foreach($transer as $trans);
// {
//     echo $trans->Ktonr." ".$trans->Saldo."<br>";
// }   


?>
<!-- <p style="margin: 20px 0px 0px 130px;">Regnskapsår:<?php echo $firma["regnskapsar"]; ?></p> -->
<form action="" method="POST" style="margin: 0px 0px 0px 130px;">
    <table cellspacing="0" cellpadding="0" border="0">
        <tr>
            <td colspan="3">Regnskapsår:<?php echo $firma["regnskapsar"]; ?>&nbsp;&nbsp;&nbsp;
                <input type="submit" class="btn" name="balansesaldo" value="Oppdater balansesaldo">&nbsp;&nbsp;
                <input type="submit" onclick=utf() class="btn" name="hent" value="Hente postert saldoliste">
                <input type="submit" onclick=utf() class="btn" name="nymal" value="Ny mal">
            </td>
        </tr>
        <tr style="height: 20px;"> </tr>
        <?php
        foreach ($kontoer as $konto) {
            $belop = $model->hent_transer($konto["Ktonr"]);
            echo '<tr><td class="td1">' . $konto["Ktonr"] . '</td><td class="konto-navn">' . $konto["Navn"] . '</td>'
                . '<td ><input style="text-align: right;" type="text" onchange="oppdater_felt(' . $konto["Ktonr"] . ')" value="' . number_format($belop, 0, ',', '.') . '" id=' . $konto["Ktonr"] . ' name="' . $konto["Ktonr"] . '"></td>'
                . '<td><label for="' . $konto["Ktonr"] . '" id="l' . $konto["Ktonr"] . '"></label></td>
        </tr>';
        }
        ?>

    </table>
</form>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    function oppdater_felt(id) {
        var saldo = document.getElementById(id).value;
        var egenkap = document.getElementById(9000).value;
        console.log("oppdater_felt", id, saldo);
        document.getElementById("l" + id).innerText = "oppdatert";
        //     egenkap = Number(egenkap) - Number(saldo);
        document.getElementById(9000).value = egenkap;
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=klienter.egenkap",
            data: ({
                id: id,
                saldo: saldo,
                regnskapsar: <?php echo $firma["regnskapsar"]; ?>
                //          egenkap:egenkap
            }),
            cache: false,
            success: function (tekst) {
                console.log(tekst);
            }
        })
    }


    function utf() { }
</script>