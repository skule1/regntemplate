<style>
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

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
$model = $this->getModel('klienter');
//$klientliste = $model->lagre_klient($res);
$session = Factory::getSession();
$base = $session->get('klient');
echo 'session: ' . $base . '<br>';
?>
<div id="10">

    <?php
    $klient = $model->hent_klient1($base);
    trinn4($klient);
    ?>


</div>


<!-- <h1>Login</h1> -->
<!-- <form action="" method="POST" enctype="multipart/form-data">
    <label for="sql_file">Last opp qsl-file: </label>
    <input type="file" name="sql_file" id="sql_file" accept=".sql">
    <button type="submit" name="upload">Last opp</button>
</form> -->
<?php
$model = $this->getModel('klienter');
//$klientliste = $model->lagre_klient($res);


echo '<div id=10>';
// if (isset($_COOKIE['jsVar'])) {
//     $phpVar = $_COOKIE['jsVar'];
//     echo "Cookie value: " . $phpVar . '<br>';
// }

// $t='<div id="EE">';
// echo 't:'.$t.'<br>';
// echo '<div AA id="EE"><br>';
// echo 'BB<div id="EE1">';

// if (isset($_POST['jsVar'])) {
//     $phpVar = $_POST['jsVar'];
//     echo "PHP received2: " . $phpVar;
//     trinn2();
// } else 
if (isset($_POST['logout'])) {
    $session->clear('klient');
    echo 'Du er logget ut<br>';
    //   echo '<a href="' . Route::_('index.php?option=com_regn&view=klienter') . '">Tilbake til innlogging </a>';

    $app = JFactory::getApplication();
    $app->redirect(JRoute::_('index.php?option=com_regn&view=klienter'));
} else if ($session->get('klient')) {
    // echo 'sessionWWWWW: ' . $session->get('klient') . '<br>';


} else if (isset($_POST['trinn0'])) {
    // echo 'upload: ';
    // echo $_POST['sql_file'] . '<br>';
    trinn1();
} else if (isset($_POST['trinn1'])) {
    $res = trinn2();
    // $model->oppdater_klient($res);
    // $model->hent_mal($res, 'e:\sql\klientmaler\\' . $res['malfil']);

    echo 'ferdig utført<br>';
    //  $model->hent_mal($folder_name, 'e:\sql\klientmaler\'.$fil);

    //   else if (isset($_POST['trinn2']))
    trinn3($res);
    // else if (isset($_POST['brukernavn']) && isset($_POST['passord']))
//     trinn1($_POST['sql_file']);
// // Kode for trinn 2
// else if (isset($_POST['valg'])) {

    //     if (isset($_POST['folder_name'])) {
//         $phpVar = $_POST['folder_name'];
//         echo "PHP received: " . $phpVar;

    // echo 'valg: <br>';
    // echo $_POST['valg'] . '<br>';
    // echo $_POST['brukernavn'] . '<br>';
    // echo $_POST['passord'] . '<br>';
    // echo $_POST['tlf'] . '<br>';
    // echo $_POST['epost'] . '<br>';
    // echo $_POST['idref'] . '<br>';
} else {
    // Her kan du legge til kode for å håndtere innlogging
//trinn1();
    ?>
                <!-- <form action="" method="POST" enctype="multipart/form-data">
                            <label for="sql_file">Last opp klientmal2: </label>
                            <input type="file" name="sql_file" id="sql_file" accept=".sql">
                            <button type="submit" name="trinn0">Last opp</button>
                        </form>'; -->

                <form action="" method="POST" enctype="multipart/form-data">
                    <table border="0" cellpadding="4" cellspacing="4" class="adminform">
                        <tr>
                            <td>Brukernavn</td>
                            <td><input type="text" name="brukernavn"></td>
                        </tr>
                        <tr>
                            <td>Passord</td>
                            <td><input type="text" name="passord"></td>
                        </tr>
                        <tr>
                            <td>
                            <td><br><input type="submit" name="trinn0" value="Neste" id="">

                            </td>
                        </tr>
                        <!-- <tr>
                                <td>
                                    <label for="sql_file">Last opp klientmal3: </label>
                                    <input type="file" name="sql_file" id="sql_file" accept=".sql">




                                </td>
                            </tr> -->
                    </table>
                </form>




    <?php
}
function trinn1()
{
    echo 'trinn1<br>';
    // if (isset($_POST['trinn0'])) {
    //     $phpVar = $_POST['jsVar'];
    //     echo "PHP received2: " . $phpVar;
    // }


    // ?>


    <!-- <form method="post" action="">
        <input type="hidden" id="jsVar" name="jsVar">
        <button type="submit" name="trinn1" value="Neste">aaaa</button>
    </form> -->

    <?php

    if (isset($_POST['brukernavn']) && isset($_POST['passord'])) {
        $brukernavn = $_POST['brukernavn'];
        $passord = $_POST['passord'];
        // echo "Brukernavn: " . $brukernavn . "<br>";
        // echo "Passord: " . $passord . "<br>";
        // Her kan du legge til kode for å håndtere innlogging
        //trinn1();

        $modKlient = new RegnModelKlienter;
        //$klient = $modKlient->opprett_klient($brukernavn, $passord);   
        // $sqlfil = $modKlient->hent_filnavn();
        //    echo 'sql-file: ' . $mal . '<br>';
        $g = 3;
        //  echo $sqlfil 
        $konf = [];
        $konf['brukernavn'] = $brukernavn;
        $konf['passord'] = $passord;
        $klient = $modKlient->opprett_klient($konf);
        $r = 2;
    }
    $dir = "e:/sql/klientmaler";

    $files = scandir($dir);
    $list = [];
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $list[] = $file;
        }
    }




    ?>



    <form action="" method="POST">
        <table>
            <tr>
                <th>Database:</th>
                <td> <input id="folder_name" name="database" value="<?php echo $klient['folder_name']; ?>"></td>


            </tr>
            <tr>
                <th>Firma:</th>
                <td>
                    <input type="text" name="firma">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>Brukernavn:</th>
                <td>
                    <input type="text" name="brukernavn" value="<?php echo $brukernavn; ?>">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>Passord:</th>
                <td>
                    <input type="text" name="passord" value="<?php echo $passord; ?>">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>Telefon:</th>
                <td>
                    <input type="text" name="telefon">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>E-post:</th>
                <td>
                    <input type="text" name="epost">
                </td>
                <td></td>
                </input>
                </td>
            </tr>


            <tr>
                <th>Mal:</th>
                <td>
                    <select id="malfil" Name="malfil" style=" width:200px;">
                        <?php foreach ($files as $file)
                            if ($file != '.' && $file != '..') {
                                echo "<option value='" . $file . "'>" . $file . "</option>";
                            } ?>
                    </select>
                </td>
            </tr>


            <td>
                <input type="submit" name="trinn1" value="Neste" id="">
            <td></td>
            </input>
            </td>
            </tr>
        </table>
    </form>

    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">
                            /*
                                    console.log("Brukernavn: " + "<?php echo $brukernavn; ?>");
        console.log("Passord: " + "<?php echo $passord; ?>");
        let bruker1 = "<?php echo $brukernavn; ?>";
        let passord1 = "<?php echo $passord; ?>";

        // function oppdater(bruker, passord) {
        //  console.log("Brukernavn oppdater: " , bruker);
        //         console.log("Passord oppdater: " , passord);
        //     $.ajax({
        //    document.getElementById("EE").value = 'test';
        jQuery.ajax({
            type: "POST",
            url: ".index.php?option=com_klient&task=klienter.reg",
            data: ({
                bruker: bruker1,
                passwd: passord1
            }),
            cache: false,
            success: function (tekst) {
                console.log("Response: " + tekst);

                document.getElementById("folder_name").value = tekst;

            }
        })
        // }
        // oppdater(bruker, passord);*/
    </script>
    <?php
    // echo 'ferdig<br>';
}





function trinn2()
{

    //$model = $this->getModel('klienter');
    // $klientliste = $model->lagre_klient($res);
    echo '<div style="cursor: wait;">Loading…</div>';
    $modKlient = new RegnModelKlienter();

    if (isset($_POST['folder_name'])) {
        $phpVar = $_POST['folder_name'];
        echo "PHP received2: " . $phpVar;
    }

    $brukernavn = $_POST['brukernavn'];
    $passord = $_POST['passord'];
    $folder_name = $_POST['database'];
    $firma = $_POST['firma'];
    $telefon = $_POST['telefon'];
    $epost = $_POST['epost'];
    $malid = $_POST['malfil'];
    echo "Brukernavn: " . $brukernavn . "<br>";
    echo "Passord: " . $passord . "<br>";
    echo "folder_name: " . $folder_name . "<br>";
    echo "Firma: " . $firma . "<br>";
    echo "Telefon:" . $telefon . '<br>';
    echo "E-post:" . $epost . '<br>';

    $res = array(
        'brukernavn' => $brukernavn,
        'passord' => $passord,
        'folder_name' => $folder_name,
        'firma' => $firma,
        'telefon' => $telefon,
        'epost' => $epost,
        'malfil' => $malid
    );




    $model = new RegnModelKlienter();
    $model->oppdater_klient($res);
    $model->hent_mal($res, 'c:\sql\klientmaler\\' . $res['malfil']);








    // $model = $this->getModel('klienter');
    //  $klientliste = $model->lagre_klient($res);
    ?>
    <!-- <form action="" method="post" enctype="multipart/form-data">
        <label>Select a file:</label>
        <input type="file" name="myfile">
        <button type="submit">Upload</button>
    </form> -->
    <?php
    // if (isset($_FILES['myfile'])) {
    //     $tmpName = $_FILES['myfile']['tmp_name'];
    // }

    // // $brukernavn = $_POST['brukernavn'];
    // // $passord = $_POST['passord'];
    // $folder_name = $_POST['folder_name'];

    // // echo "Brukernavn: " . $brukernavn . "<br>";
    // // echo "Passord: " . $passord . "<br>";
    // echo "folder_name: " . $folder_name . "<br>";
    // echo "A: " . $a . "<br>";
    // $fornavn = '';
    // $epost = '';
    // $brukernavn1 = '';
    // $passord1 = '';
    // $tlf = '';
    // $idref = '';
    // ?>
    <!-- <script>
        jQuery.ajax({
            type: "POST",
            url: ".index.php?option=com_klient&task=klienter.reg",
            data: ({
                bruker: bruker1,
                passwd: passord1
            }),
            cache: false,
            success: function (tekst) {
                console.log("Response: " + tekst);

                document.getElementById("folder_name").value = tekst;

            }
        }) -->

    <!-- </script> -->








    <!-- <br> -->

    <!-- <form action="" method="POST">
        <table border="0 cellpadding=" 4" cellspacing="4" class="adminform">

            <tr>
                <td><input id="folder_name" name="folder_name"></td>
                <td><input type="text" name="navn" value="<?php echo $fornavn ?>"></td>
            </tr>

            <tr>
                <td>Epost</td>
                <td><input type="text" name="epost" value="<?php echo $epost ?>"></td>
            </tr>

            <tr>
                <td>Brukernavn</td>
                <td><input type="text" name="brukernavn" value="<?php echo $brukernavn1 ?>"></td>
            </tr>

            <tr>
                <td>Passord</td>
                <td><input type="text" name="passord" value="<?php echo $passord1 ?>"></td>
            </tr>

            <tr>
                <td>Tlf</td>
                <td><input type="text" name="tlf" value="<?php echo $tlf ?>"></td>
            </tr>

            <!-- <tr>
            <td>Id</td>
            <td><input type="text" name="idref" value="<?php echo $idref ?>"> </td>
        </tr> -->

    <!-- <tr>
        <td></td>
        <td><input type="submit" name="trinn1" value="Neste"></td>
    </tr>

    </table>
    </form> -->
    <?php
    return $res;
}
function trinn3($res)
{
    echo 'trinn 3<br>';
    if (isset($_POST['folder_name'])) {
        $phpVar = $_POST['folder_name'];
        echo "PHP received3: " . $phpVar;
    }



    // use Joomla\CMS\Factory;

    $session = Factory::getSession();
    $session->set('klient', $res["folder_name"]);
    echo 'session: ' . $session->get('klient') . '<br>';
}
?>

<?php
//function hent_mal($tag,$fil)
//         $model = $this->getModel('klienter');
// $klientliste = $model->hent_mal('reg100004','e:\sql\mal1.sql');

function trinn4($klient)
{
    $model = new RegnModelKlienter;
    $firma = $model->hent_firma($klient['folder_name'])
        ?>
    <form action="" method="POST">
        <table>
            <td>

                <table>
                    <tr>
                        <th>Database:</th>
                        <td> <input id="folder_name" name="database" value="<?php echo $klient['folder_name']; ?>"></td>


                    </tr>
                    <tr>
                        <th>Firma:</th>
                        <td>
                            <input type="text" name="firma">
                        </td>
                        <td></td>
                        </input>
            </td>
            </tr>
            <tr>
                <th>Brukernavn:</th>
                <td>
                    <input type="text" name="brukernavn" value="<?php echo $klient['brukernavn']; ?>">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>Passord:</th>
                <td>
                    <input type="text" name="passord" value="<?php echo $klient['passord']; ?>">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>Telefon:</th>
                <td>
                    <input type="text" name="telefon" value="<?php echo $klient['telefon']; ?>">
                </td>
                <td></td>
                </input>
                </td>
            </tr>
            <tr>
                <th>E-post:</th>
                <td>
                    <input type="text" name="epost" value>
                </td>
                <td></td>
                </input>
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


            <td>
                <input type="submit" class="btn" name="klient" value="Oppdater klientdata" id="">
            <td></td>
            </input>
            </td>
            </tr>
        </table>
        </td>
        <td>
            <table>
                <tr>

                    <th>Database:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['Firmanavn']; ?>"></td>
                </tr>
                <tr>

                    <th>Adresse:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['Adresse']; ?>"></td>
                </tr>
                <tr>

                    <th>Postnr:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['Postnr']; ?>"></td>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['Postnr']; ?>"></td>
                    <td><label for="folder_name"></label></td>
                </tr>
                <tr>

                    <th>Telefon:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['telefon']; ?>"></td>
                </tr>
                <tr>

                    <th>E-post:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['epost']; ?>"></td>
                </tr>
                <tr>

                    <th>Kontaktperson:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['kontaktperson']; ?>"></td>
                </tr>
                <tr>

                    <th>Debitor kto:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['debitorkto']; ?>"></td>
                </tr>
                <tr>

                    <th>Kreditorkto:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['kreditorkto']; ?>"></td>
                </tr>
                <tr>

                    <th>Adresse:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['Adresse']; ?>"></td>
                </tr>
                <tr>

                    <th>Neste bilagsnr:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['neste_bilagsnr']; ?>"></td>
                </tr>
                <tr>

                    <th>Neste buntnr:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['buntnr']; ?>"></td>
                </tr>
                <tr>

                    <th>Valgt periode:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['periode']; ?>"></td>
                </tr>
                <tr>

                    <th>Neste bilagsnr:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['bilagref']; ?>"></td>
                </tr>
                <tr>

                    <th>Regnskapsår:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['regnskapsar']; ?>"></td>
                </tr>
                <tr>

                    <th>Regnskapsmodus:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['regnskapsmodus']; ?>"></td>
                </tr>
                <tr>

                    <th>Skannet lagringsmappe:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['Skannet_lagringsmappe']; ?>">
                    </td>
                </tr>
                <tr>

                    <th>Konfig:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['konfig']; ?>"></td>
                </tr>
                <tr>

                    <th>Brukernavn:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['brukernavn']; ?>"></td>
                </tr>
                <tr>

                    <th>Passord:</th>
                    <td> <input id="folder_name" name="database" value="<?php echo $firma['passord']; ?>"></td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input class="btn" type="submit" name="firma" value="Oppdater firmaregister" id="">
                    </td>
                    <td></td>
                </tr>
            </table>
        </td>
        <tr>
            <td colspan="2">
                <input class="btn" name="logout" value="Logg ut">
            </td>
        </tr>
        <table>
    </form>


    <?php


}