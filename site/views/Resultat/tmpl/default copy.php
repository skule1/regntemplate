

<style>
    input {
        height: 48;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4);
        /* Black w/ opacity */
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        /* Could be more or less, depending on screen size */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights location.reload()served.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
include 'fc.php';
include 'style.css';
//include '.\components\com_regn\views\h.php';
// header('Content-Type: text/html; charset=utf8mb4');
?>

<h1><?php echo $this->msg; ?></h1>

<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'bevegelser')">Resultat</button>
  <button class="tablinks" onclick="openCity(event, 'sok')">Rapportmal</button>

  <!-- <button class="tablinks" onclick="openCity(event, 'import1')">Import/eksport</button> -->
</div>




















<!-- <canvas id="myCanvas" width="800" height="300" style="border:1px solid #000000;"></canvas> -->
<script>
    // window.onload = function () {
    //     var canvas = document.getElementById("myCanvas");
    //     var context = canvas.getContext("2d");
    //     //       var label=document.getElementById("id_label").value;
    //     let label = "Linje   Navn                                Nivå       Beløp     Budsjett       Fjorår            Hittil  Avvik";
    //     var gg = document.getElementById("id_kontoer").value;
    //     const colors = document.getElementById("id_color").value;             //["red", "yellow", "blue"]
    //     var ctx = canvas.getContext("2d");
    //     ctx.font = "14px Arial";
    //     for (let i = 0; i < 3; i++) {
    //         //   ctx.fillText(label, 10, 80+10);
    //         ctx.fillText(colors[i], 10, 40 + 18 * i);
    //         //    ctx.fillText(label, 10, 40+18*i);
    //         //    ctx.fillText(label, 10, 40+15*3);
    //         //    ctx.fillText(label, 10, 40+15*4);
    //         //     ctx.fillText(label, 10, 80);
    //         //   ctx.fillText(label, 10, 10*i);
    //     }
    //     // context.moveTo(10, 100);
    //     // context.lineTo(250, 100);
    //     // context.stroke();


    // };


</script>
<?php
echo '<br>';
$avvik = "hittil";

$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;

$db = JFactory::getDBO();
$query = $db->getQuery(true);

/*
if (isset($_GET["Send"])){
echo 'skjema<br>';
    $query = 'CALL gruppesum1('.$_GET["regnar"].','.$_GET["pernr"].');SELECT * FROM #__regn_resrapport WHERE regnskapsar='.$_GET["regnar"].' AND periode='.$_GET["pernavn"].' ;';
    $db->setQuery((string) $query);
    $messages = $db->loadObjectList();

$query = 'SELECT * FROM qo7sn_regn_resrapport WHERe Regnskapsar='.$_GET["regnar"].' AND periodenr='.$_GET["pernr"].' ORDER BY nr;';
echo $uery.'<br>';
}/
else*/ {
    //  echo 'konfig<br>';
    $query = 'select * from qo7sn_regn_firma;';
    $db->setQuery((string) $query);
    $message = json_encode($db->loadObject());


    //echo 'message: '.$message.'<br>';

    $obj3 = json_decode($message);
    if (($obj3->konfig) == '')
        $obj3->konfig = '{"ar":"2020","periode":"Mars","ant_post":"40","sort":"dato","retn":"desc"}';
    // echo ' res1: ' . $obj3->konfig . '<br>';
    $obj4 = json_decode($obj3->konfig);
    //  echo 'år konfig: ' . $obj4->ar . '<br>';
    //   echo 'år felt: ' . $obj3->regnskapsar . '<br>';
    //  echo 'res3: '.$obj4->ar.' : '.$obj4->periode.' : '.$obj4->periodenr.' : '.f_periodenr($obj4->periodenr).'<br>';
    $_GET["regnar"] = $obj3->regnskapsar; // $obj4->ar;
    $_GET["pernr"] = f_periodenr($obj4->periode);


    //echo 'konfig: ' . $_GET["regnar"] . ' : ' . $_GET["pernr"] . ' : ' . $obj4->ar . ' : ' . $obj4->periode . '<br>';
/*

    $query = 'CALL gruppesum(' . $_GET["regnar"] . ',' . $_GET["pernr"] . ');';
    $db->setQuery((string) $query);
    $messages = $db->loadObjectList();
*/
    $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar=' . $_GET["regnar"] . ' AND periodenr=' . $_GET["pernr"] . ' order by nr;';
    //      $RR='SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=2020 AND periode="Januar" ORDER BY nr,periodenr;'
    // echo 'sql: ' . $query . '<br>';
    $db->setQuery((string) $query);
    //$messages = $db->loadObjectList();
    $_GET["Send"] = 'Submit';
}

if (isset($_GET["view"])) {


    // echo 'initial<br>';
    $q = 'select * from  #__regn_firma';
    //  echo '$q: ' . $q . '<br>';
    $db->setQuery((string) $q);
    $myJSON = $db->loadObject();
    //   echo 'mes: ' . $myJSON->konfig . '<br>';
    $konf1 = json_decode($myJSON->konfig);
    // echo '$konf1: ' . $konf1 . '<br>';
    $arstall = $myJSON->regnskapsar;//   $konf1->ar;
    $periodenavn = $konf1->periode;
    //echo $arstall . ' : ' . $periodenavn . '<br>';
    /* $myJSON = json_encode($konf1);
    $myJSON = json_decode($konf1);
    echo 'konfig: ' . $konf1 . '<br>';
    $arstall = $myJSON->ar;
    $periodenavn = $myJSON->periode;

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo 'request POST <br>';
    echo ' collect value of input field <br>';
    $arstall = $_REQUEST['arstall'];
    $periodenavn = $_REQUEST['periodenavn'];
    echo 'view ' . $_POST["view"] . '<br>';
    /*
    $q = 'select * from  #__regn_firma';
    echo '$q: ' . $q . '<br>';
    $db->setQuery((string) $q);
    $myJSON = $db->loadObject();
    //  echo 'mes: '.$myJSON->konfig.'<br>';
    $konf1 = json_decode($myJSON->konfig);
    echo '$konf1: ' . $konf1 . '<br>';
    $konf1->ar =   $arstall;
    $konf1->periode =   $periodenavn;
    $myJSON = json_encode($konf1);
    $myJSON=json_decode($konf1);
    echo 'konfig: ' . $konf1 . '<br>';

    //  $myJSON ='{"ar":"'.$arstall.'","periode":"'.$periodenavn.'","ant_post":"'.$limit.'","sort":"'.$sort.'","retn":"'.$retn.'"}';
    $q = 'update #__regn_firma set konfig=\'' . $myJSON . '\'';
    echo '$q: ' . $q . '<br>';
    $db->setQuery((string) $q);
    $mes = $db->loadObject();
    */
} else if ((($_SERVER["REQUEST_METHOD"]) == "GET")) {
    // echo 'konfigz<br>';
    //  echo 'request GET <br>';
    //  echo 'view ' . $_GET["view"] . '<br>';
    // echo 'submit ' . $_GET["submit"] . '<br>';
    //echo 'arstall ' . $_GET["arstall"] . '<br>';
    // echo 'Periodenavn ' . $_GET["periodenavn"] . '<br>';

    $arstall = $_GET["arstall"];
    $periodenavn = $_GET["periodenavn"];
    $avvik = $_GET["avvik"];
    //  echo 'get avvik: '.$avvik.'<br>';
    $query = 'select * from #__regn_firma;';
    $db->setQuery((string) $query);
    // $message=  $db->loadObject();
    $message = json_encode($db->loadObject());
    $obj3 = json_decode($message);
    // echo '$message: ' . $message . '<br>';
    //echo 'periode: ' . $obj3->periode . '<br>';


    // echo 'Årstall ' . $arstall . '<br>';
    //  if (($obj3->konfig) == '') $obj3->konfig = '{"ar":"2020","periode":"Mars","ant_post":"40","sort":"dato","retn":"desc"}';
    //   echo ' konfig: ' . $obj3->konfig . '<br>';
    $obj4 = json_decode($obj3->konfig);
    $obj4->ar = $arstall;
    $obj4->periode = $periodenavn;
    $obj3->konfig = $obj4;
    // echo 'periode/ar: ' . $obj4->periode . ' : ' . $obj4->ar . '<br>';
    //  echo 'konfig2: '.$obj3->konfig.'<br>';
    //   echo ' konfig1: ' . json_encode($obj3->konfig) . '<br>';
    $konf2 = json_encode($obj3->konfig);
    $query = 'update  #__regn_firma set periode="' . $periodenavn . '", regnskapsar=' . $arstall . ', konfig=\'' . $konf2 . '\'';
    // echo '$query: ' . $query . '<br>';
    //  $mes = $db->loadObject();

    // $obj4 = $obj3->konfig;
    /*  $obj4->ar= $arstall;
    $obj4->periode=$periodenavn;
 //   echo 'encode: ' . json_encode($obj4);
    // echo 'decode: '.json_decode($obj3->konfig );
    $q = 'update #__regn_firma set konfig=\'' . json_encode($obj4) . '\'';
    echo '$q: ' . $q . '<br>';
 //  $db->setQuery((string) $q);
 //     $mes = $db->loadObject();
    //   echo 'Årstall ' . $arstall . '<br>';¨
*/
}

//echo 'query: '.$query.'<br>';
$db->setQuery((string) $query);
$messages = $db->loadObjectList();
$options = array();

$query = 'select * from #__regn_regnskapsar order by regnskapsar desc;';
//echo ' $query: ' . $query . '<br>';
$db->setQuery((string) $query);
$mes = $db->loadColumn();
//echo $mes[2];
$nr = 0;
$ant = $db->getCount();
$regnskapsar = $arstall;
//echo 'Årstall, periodenavn: ' . $arstall . ' : ' . $periodenavn . ' : ' . $regnskapsar . '<br>';
//echo 'ant ' . $ant . '<br>';

if ($arstall == 'Alle')
    $arstall = '2015';
if ($_GET["regnar"] == 'Alle')
    $arstall = '2015';
?>

<!--form action="" method="GET"-->
<!--form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"-->
<!-- <form  id="myForm" action="/submit"   method="post"> -->
<form id="myForm" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Regnskapsår:
    <!--select name="valgt_ar"-->
    <select id="ar" Name="arstall" Size="Number_of_options" onchange="f_valg()" value="<?php echo $arstall ?>" <?php
       while ($nr < count($mes)): {
               //echo $mes[$nr++].'<br>';
               if ($mes[$nr] == $regnskapsar)
                   echo '<option value=' . $mes[$nr] . ' selected>' . $mes[$nr++] . '</option>';
               else
                   echo '<option value=' . $mes[$nr] . '>' . $mes[$nr++] . '</option>';
           }
       endwhile;
       //   $avvik = "budsjett";
       ?> </select>


        Periode: <select id="periode" Name="periodenavn" Size="Number_of_options" onchange="f_valg()">
            <option value="Januar" <?php if ($periodenavn == "Januar")
                echo " selected" ?>> Januar </option>
                <option value="Februar" <?php if ($periodenavn == "Februar")
                echo " selected" ?>>Februar</option>
                <option value="Mars" <?php if ($periodenavn == "Mars")
                echo " selected" ?>>Mars </option>
                <option value="April" <?php if ($periodenavn == "April")
                echo " selected" ?>>April </option>
                <option value="Mai" <?php if ($periodenavn == "Mai")
                echo " selected" ?>>Mai </option>
                <option value="Juni" <?php if ($periodenavn == "Juni")
                echo " selected" ?>>Juni </option>
                <option value="Juli" <?php if ($periodenavn == "Juli")
                echo " selected" ?>>Juli </option>
                <option value="August" <?php if ($periodenavn == "August")
                echo " selected" ?>>August </option>
                <option value="September" <?php if ($periodenavn == "September")
                echo " selected" ?>>September </option>
                <option value="Oktober" <?php if ($periodenavn == "Oktober")
                echo " selected" ?>>Oktober </option>
                <option value="November" <?php if ($periodenavn == "November")
                echo " selected" ?>>November </option>
                <option value="Desember" <?php if ($periodenavn == "Desember")
                echo " selected" ?>>Desember </option>
            </select>

            Avvik fra: <select id="id_avvik" Name="avvik" Size="Number_of_options" onchange="f_valg()">
                <option value="budsjett" <?php if ($avvik == "budsjett")
                echo " selected" ?>> Budsjett </option>
                <option value="forrige" <?php if ($avvik == "forrige")
                echo " selected" ?>> Forrige år </option>
                <option value="hittil" <?php if ($avvik == "hittil")
                echo " selected" ?>> Hittil i år</option>
            </select>
            <!--input type="submit" value="Oppdater"-->
            <!-- <input type="submit" name="submit" value="Oppdater"> -->
    </form>

    <!--form action="" method="get" name="reg"-->
    <table id="e" border="0" cellspacing="1" cellpadding="1">
    <?php if (isset($_GET["Send"])) {
                ?>
        <!--td colspan="5" align="right">Regnskapsår: <input type="text" value="<?php echo $_GET["regnar"] ?>" id="regnar" name="regnar"style=" width:100px;">
             Periodenr: <input type="text" id="pernr" value="<?php echo $_GET["pernr"] ?>" name="pernr" style=" width:100px;"   width:100px;"> 
             <?php } else { ?>
             <td colspan="5" align="right">Regnskapsår: <input type="text" id="regnar" name="regnar"style=" width:100px;">
             Periodenr: <input type="text" id="pernr"  name="pernr" style=" width:100px;"   width:100px;"> 
             <?php } ?>
            <input type="Submit" name="Send" id="ok" value="Submit" style="width:100px;">
            </td-->
    </tr>
    <tr height="20px"> </tr>
    <tr>

        <!-- <th style="text-align:right" width="450">
            Linje
        </th> -->

        <th style="text-align:right" width="50">
            Linje
        </th>
        <th scope="col" width="200">
            Navn
        </th>
        <th style="text-align:right" scope="col" style="text-align:right" width="100">
            Nivå
        </th>
        <th style="text-align:right" scope="col" style="text-align:right" width="100">
            Beløp
        </th>
        <th style="text-align:right" scope="col" style="text-align:right" width="100">
            Budsjett
        </th>
        <th style="text-align:right" scope="col" style="text-align:right" width="100">
            Fjorårstall
        </th>
        <th style="text-align:right" scope="col" width="100">
            Hittil
        </th>
        <th style="text-align:right" scope="col" width="100">
            Hittil fjor
        </th>
        <th style="text-align:right" scope="col" width="100">
            Avvik
        </th>
        <!-- <th style="text-align:right" scope="col" width="100">
            År
        </th> -->
        <th style="text-align:left" scope="col" width="300">
            Kontoer
        </th>
        <!--th style="text-align:right"scope="col" width="100" >
                Periode
            </th>
            <th style="text-align:right"scope="col" width="100" >
                Periodenr
            </th-->
        <!--th style="text-align:right"scope="col" style="text-align:right" width="50" >
                År
            </th-->

    </tr>
    <?php
    if ($arstall == 'Alle')
        $arstall = '2015';
    if ($_GET["regnar"] == 'Alle')
        $arstall = '2015';

    //$stmt = $db->getCount()         ->prepare($query);
    

    //    $sql='select count(*) from qo7sn_regn_saldoliste WHERE ar=2003;';
//     $result = mysqli_query($db,$sql) or die("feil");
//     echo 'ant: '.$result->num_rows;
    //   echo $ant . '<br>';
    

    // Sjekker om saldobeløp for akutelt år er oppdatert
    
    // $query = $db->getQuery(true);
    // $query = 'select count(*) from qo7sn_regn_saldo WHERE ar=' . $_GET["regnar"] . ';';
    // $db->setQuery($query);
    // $db->execute();
    // $rows = $db->loadObjectList();
    // $my_count = count($rows);
    //echo 'saldo: ' . $my_count . '<br>';
    // if ($my_count == 0) {
    //     // echo 'oppdaterer saldo for ' . $_GET["regnar"] . '<br>';
    //     $query = 'CALL proc_saldo3(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
    //     //    $db->setQuery((string) $query);
    //     //$db->loadObject();    
    //     // echo $query.'<br>';
    // }
    
    // Sjekker om saldoliste er oppdatert for aktuelt år
    
    // $query = 'select count(*) from qo7sn_regn_saldoliste WHERE ar=' . $_GET["regnar"] . ';';
    // $db->setQuery($query);
    // $db->execute();
    // $rows = $db->loadObjectList();
    // $my_count = count($rows);
    //echo 'ant saldoliste: ' . $my_count . '<br>';
    // if ($my_count == 0) {
    //     //echo 'oppdaterer saldoliste for ' . $_GET["regnar"] . '<br>';
    //     $query = 'CALL proc_saldoliste(' . $_GET["regnar"] . ');';
    //     // $db->setQuery((string) $query);
    //     // $db->loadObject();
    //     //echo $query . '<br>';
    // }
    
    // Generer rapporter:
    
    $query = 'CALL proc_resrapport(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
    $db->setQuery((string) $query);
    // $db->loadObject();
    
    $query = 'CALL proc_update_resrapport(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
    $db->setQuery((string) $query);
    // $db->loadObject();
    


    //   echo $query . '<br>';
    
    //     $query = 'CALL proc_fjorarstall(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
//     $db->setQuery((string) $query);
//     $db->loadObject();
//   //  echo $query . '<br>';
    
    //     $query = ' CALL proc_hittil1(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
//     $db->setQuery((string) $query);
//     $db->loadObject();
//   //  echo $query . '<br>';
    
    //     $query = 'CALL gruppesum(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
//     $db->setQuery((string) $query);
//     $db->loadObject();
    //  echo $query . '<br>';
    
    // $db->loadObject();
    //  echo 'sql1: ' . $query . '<br>';
    /*
    echo ' 2 ';
    $query = 'CALL proc_fjorarstall(' . $_GET["regnar"] . ');';
    $db->setQuery((string) $query);
    $db->loadObject();

    echo ' 3 ';
    $query = 'CALL proc_hittil(' . $_GET["regnar"] . ');';
    $db->setQuery((string) $query);
   $db->loadObject();


    echo ' 4 ';
    $query = ' CALL proc_budsjett(' . $_GET["regnar"] . ');';
    $db->setQuery((string) $query);
  $db->loadObject();

    echo ' 5';
    $query = 'CALL gruppesum(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
    $db->setQuery((string) $query);
   $db->loadObject();
*/


    //      $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar=' . $_GET["regnar"] . ' AND periode="' . $obj4->periode . '" order by nr ;';
    //$query = 'SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar=' . $arstall. ' AND periode="' . $periodenavn. '" order by nr ;';
    //  $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=2015  AND periode="' . $periodenavn. '"ORDER BY nr,periodenr;'; 
    $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
    //  echo $query;
    $db->setQuery((string) $query);
    $messages = $db->loadObjectList();

    //    echo 'sql: ' . $query . '<br>';
    // foreach ($messages as $message) {
    // echo 'message: |'.$messages[0]->fjorarstall.'|<br>';
// echo 'fjorarstallA: '.$messages[0]->fjorarstall.' hittil: '.$messages[0]->hittil.'<br>';
    















    if (!$messages) {
        //   echo 'Oppdaterer hist<br>';
        $query1 = 'call proc_totupdate_resrapport(' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ');';
        $db->setQuery($query1);
        $db->execute();
        $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
        //  echo $query;
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        //     $db->setQuery((string) $query);
        //      $messages = $db->loadObjectList();    
    }
    //echo $messages[5]->belop . '  ' . $messages[5]->avvik_fjorar . '   ' . $messages[5]->avvik_hittil . '   ' . $messages[5]->avvik_budsjett . '<br>';



    $query2 = 'SELECT SUM(belop) AS a, SUM(budsjett) AS budsj, SUM(fjorarstall) AS fjor, SUM(hittil) AS hit , SUM(hittil_fjorar) AS hit_fjor FROM qo7sn_regn_resrapport WHERE ar=' . $_GET["regnar"] . ' AND periode="' . $periodenavn . '" order BY nr;';

    // $db->setQuery((string) $query2);
    // $messages1 = $db->loadObject();
    $db->setQuery((string) $query2);
    $messages1 = $db->loadObjectList();
   // echo 'result: fjor: |' . $messages1[0]->fjor . '| hittil: |' . $messages1[0]->hit . '| hittil_fjor: |' . $messages1[0]->hit_fjor . '|<br>';









    // // //    if (!$messages) {
    if ($messages1[0]->fjor == 0) {
    //    echo 'Oppdaterer fjorårshistorikk (' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ')<br>';
        $query1 = 'CALL proc_fjorarstall(' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ');';
        $db->setQuery($query1);
        $db->execute();
        $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
        //  echo $query;
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
    }

    if ($messages1[0]->hit_fjor == 0) {
        echo 'Oppdaterer hittil fjorårshistorikk (' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ')<br>';
        $query1 = 'CALL proc_totupdate_resrapport(' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ');';
        $db->setQuery($query1);
        $db->execute();
        $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
        //  echo $query;
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
    }


    if (!$messages) {
        'Oppdaterer hist<br>';
        $query1 = 'call proc_totupdate_resrapport(' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ');';
        $db->setQuery($query1);
        $db->execute();
        $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
        //  echo $query;
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        //     $db->setQuery((string) $query);
        //      $messages = $db->loadObjectList();    
    }









    //     if ($messages[0]->hittil == 0) {
    //     echo 'Oppdaterer hittil ' . $messages[0]->hittil . '<br>';
    //     $query1 = 'call proc_totupdate_resrapport(' . $_GET["regnar"] . ',' . f_periodenr($periodenavn) . ');';
    //     $db->setQuery($query1);
    //     $db->execute();
    // }
    // echo 'fjorarstallB: ' . $messages[0]->fjorarstall . ' hittil: ' . $messages[0]->hittil . '<br>';
    // $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
    // //  echo $query;
    // $db->setQuery((string) $query);
    // $messages = $db->loadObjectList();
    
    // else
// return;
    /*

            //  $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE periodenr=2 AND regnskapsar=2020 group by nr ORDER BY nr;';


            $db->setQuery((string) $query);
            echo 'sql: ' . $query . '<br>';



            //     $messages = $db->loadObjectList();
            echo ' 7a <br> ';
            $db->loadObjectlist();*/
    $prevniva = 0;
    $options = array();


    if ($messages) {
        foreach ($messages as $message) {
            //       echo '<td wisth="100"> $prevniva: ' . $prevniva . '  nr: ' . $message->nr . '  niva: ' . $message->niva . ' </td> ';
            if (($message->niva > 1) and ($prevniva == 1))
                //         if (($message->niva > 1) )
                echo '<tr><td colspan="10">--------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>';
            echo '<td align ="right" style=" padding-right: 20px;">' . $message->nr . "</td>";
            echo '<td align ="left">' . $message->tekst . "</td>";
            echo '<td align ="right">' . $message->niva . "</td>";
            echo '<td align ="right">' . formatcurrency($message->belop, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->budsjett, "NOK") . "</td>";
            //   echo '<td align ="right">' .$message->prosent . "</td>";
            //echo '<td align ="right">' . formatcurrency($message->prosent, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->fjorarstall, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->hittil, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->hittil_fjorar, "NOK") . "</td>";
            if ($avvik == "budsjett")
                echo '<td align ="right">' . formatcurrency($message->avvik_budsjett, "NOK") . "</td>";
            elseif ($avvik == "forrige")
                echo '<td align ="right">' . formatcurrency($message->avvik_fjorar, "NOK") . "</td>";
            elseif ($avvik == "hittil")
                echo '<td align ="right">' . formatcurrency($message->avvik_hittil, "NOK") . "</td>";


            // echo '<td align ="center">' . $message->ar . "</td>";
            echo '<td align ="left" style=" padding-left: 20px;"><input type="text" style=" border-width:0px;" name="kontoer" id="id_kontoer" onclick="f_kontoer()" value="' . $message->kontoer . '"></td>';
            //  echo '<td align ="right">' .$message->periode. "</td>";
            //   echo '<td align ="right">' .$message->periodenr. "</td>";
            //        echo '<td align ="right">' .$message->ar . "</td>";
            echo "</tr>";
            if ($message->niva > 1)
                echo '<tr><td colspan="10">════════════════════════════════════════════════════════════════════════════════════════════════</td></tr>';
            // if ($message->niva > 1)
            // {
            //     echo '<tr><td colspan="8">';
            // for ($i=1;$i++;$i<80) echo '=';//chr(65);
            // echo '</td></tr>';
            // }
    

            $prevniva = $message->niva;
        }
    }
    echo '</table></form';




    /*


if ($result = mysqli_query($link, $sql)) {
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        echo "<tr>";
        echo "<td>" . $row['ref'] . "</td>";
        echo "<td>" . $row['Bilagsart'] . "</td>";
        echo "<td>" . $row['Bilag'] . "</td>";
        echo "<td>" . $row['Dato'] . "</td>";
        echo "<td>" . $row['debet'] . "</td>";
        echo "<td>" . $row['kredit'] . "</td>";
        echo "<td>" . $row['belop'] . "</td>";
        echo "<td>" . $row['Tekst'] . "</td>";
        echo "</tr>";
    }
}
}*/
    ?>
    <!--/table>
</form-->





    <!-- Trigger/Open The Modal -->
    <button id="myBtn">Open Modal</button>

    <!-- The Modal -->
    <div id="myModal" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span class="close">&times;</span>
            <p>Some text in the Modal..
            <div id="ttyy"></div>
            </p>
        </div>

    </div>















    <?php
    function f_periodenr($navn)
    {
        if ($navn == 'Januar')
            return '1';
        elseif ($navn == 'Februar')
            return '2';
        elseif ($navn == 'Mars')
            return '3';
        elseif ($navn == 'April')
            return '4';
        elseif ($navn == 'Mai')
            return '5';
        elseif ($navn == 'Juni')
            return '6';
        elseif ($navn == 'Juli')
            return '7';
        elseif ($navn == 'August')
            return '8';
        elseif ($navn == 'September')
            return '9';
        elseif ($navn == 'Oktober')
            return '10';
        elseif ($navn == 'November')
            return '11';
        elseif ($navn == 'Desember')
            return '12';
    }
    ?>

    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
    <script type="text/javascript">

        function f_valg() {
            console.log("f_valg");
            const avvik = document.getElementById("id_avvik").value;
            console.log("f_valg :" + avvik);
            // document.forms["myForm"].submit();
            document.getElementById('myForm').submit();
            //          location.reload();
            //  alert("reload");
        }

        function f_kontoer() {
            console.log("f_kontoer");
            let kto = document.getElementById("id_kontoer").value;
            console.log(kto);


            modal.style.display = "block";
            if (event.target == modal) {
                modal.style.display = "none";
            }


        }


        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function () {
            modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }


    </script>