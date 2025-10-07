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
global $model;
$model = $this->getModel('klienter');
if (isset($_POST["oppd"])) {
    behandle_mal();
    echo $this->loadTemplate('balanse');
} else if (isset($_POST["neste"]))
    echo $this->loadTemplate('balanse');
else if (isset($_POST["balanse"]))
    balanse();
else
    start();

function start()
{
    $dir = "c:/sql/klientmaler";
    $files = scandir($dir);
    $list = [];
    foreach ($files as $file) {
        if ($file != '.' && $file != '..') {
            $list[] = $file;
        }
    }
    ?>
    <div style="margin: 20px 0px 0px 130px;">
        Det første du må gjøre, er å velge hvilken regnskapsmodell du ønsker å bruke<br>
        Velg fra listen av maler her:<br><br>


        <form action="" method="POST">
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
                <tr style="height: 20px;"> </tr>
                <tr></tr>
                <td colspan="2"><input type="submit" class="btn" name="oppd" value="Opprett ny mal">&nbsp;&nbsp; <input
                        type="submit" class="btn" disabled name="neste" value="Ingen endring, fortsett.."></td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}

function behandle_mal()
{
    global $model;
    $user = JFactory::getUser();
    $username = $user->username;

    $fil = $_POST["malfil"];
    if ($user->authProvider[0] == "X")
        $database = substr($user->authProvider, 1);
    else
        $database = $user->authProvider;

    $model->hent_mal($database, $fil);
    if ($user->authProvider[0] == "X")
        $user->authProvider[0] = "$";
    else if ($user->authProvider[0] == "r")
        $user->authProvider = "$" . $user->authProvider;
    $model->oppdater_user($user);
}
function balanse()
{
    ?>
    Nå må du sette saldo på balansekonti.
    Balansekontoene hentes inn gog du må sette saldo på de enkelte kontiene. <br>
    Forskjellen mellom aktiva og passiva vil bli oppsummert mot egenkapitalen.<br><br>
    <?php


    echo "balanse<br>";
}
