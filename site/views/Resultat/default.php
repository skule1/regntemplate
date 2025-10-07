<style>
    input {
        height: 48;
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
?>
<h1><?php echo $this->msg; ?></h1>
<?php


$session = Factory::getSession();
$value = $session->get('klient');
if ($value != null)
    echo '<h5>Klient: ' . $value . '</h5><br>';

$model = $this->getModel('resultat');

// Fetch the record
$perioder = $model->perioder();
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

    $obj3 = json_decode($message);
    if (($obj3->konfig) == '')
        $obj3->konfig = '{"ar":"2020","periode":"Mars","ant_post":"40","sort":"dato","retn":"desc"}';
    //echo ' res1: '.$obj3->konfig.'<br>';
    $obj4 = json_decode($obj3->konfig);
    //echo 'obj4: '.$obj4->ar.'<br>';
    //echo 'res3: '.$obj4->ar.' : '.$obj4->periode.' : '.$obj4->periodenr.' : '.f_periodenr($obj4->periodenr).'<br>';
    $_GET["regnar"] = $obj4->ar;
    $_GET["pernr"] = f_periodenr($obj4->periode);

    //echo 'konfig: '.$_GET["regnar"].' : '.$_GET["pernr"].' : '.$obj4->ar.' : '.$obj4->periode.'<br>';

    $query = 'CALL gruppesum(' . $_GET["regnar"] . ',' . $_GET["pernr"] . ');';
    $db->setQuery((string) $query);
    $messages = $db->loadObjectList();

    $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar=' . $_GET["regnar"] . ' AND periodenr=' . $_GET["pernr"] . ' order by nr;';
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
    $arstall = $konf1->ar;
    $periodenavn = $konf1->periode;
    //   echo $arstall . ' : ' . $periodenavn . '<br>';
    /* $myJSON = json_encode($konf1);
    $myJSON = json_decode($konf1);
    echo 'konfig: ' . $konf1 . '<br>';
    $arstall = $myJSON->ar;
    $periodenavn = $myJSON->periode;

    exit;*/
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
//echo 'ant '.$ant.'<br>';

?>

<!--form action="" method="GET"-->
<!--form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>"-->
<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Regnskapsår:
    <!--select name="valgt_ar"-->
    <select id="ar" Name="arstall" Size="Number_of_options" onchange="f_valg" value="<?php echo $arstall ?>"
        onchange="f_valg()">
        <?php
        while ($nr < count($mes)): {
                //echo $mes[$nr++].'<br>';
                if ($mes[$nr] == $regnskapsar)
                    echo '<option value=' . $mes[$nr] . ' selected>' . $mes[$nr++] . '</option>';
                else
                    echo '<option value=' . $mes[$nr] . '>' . $mes[$nr++] . '</option>';
            }
        endwhile;
        ?>

    </select>

    <!--/form-->
    <!--form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

År:  <select id="ar" Name="arstall" Size="Number_of_options" onchange="f_valg()" value="<?php echo $arstall ?>" onchange="f_valg()">
  <option value="2022"> 2022 </option>
  <option value="2021" <?php if ($arstall == "2021")
      echo " selected" ?>> 2021 </option>
  <option value="2020" <?php if ($arstall == "2020")
      echo " selected" ?>> 2020 </option>
  <option value="2019" <?php if ($arstall == "2019")
      echo " selected" ?>> 2019 </option>
  <option value="2018" <?php if ($arstall == "2018")
      echo " selected" ?>> 2018 </option>
  <option value="2017" <?php if ($arstall == "2017")
      echo " selected" ?>> 2017 </option>
  <option value="2016" <?php if ($arstall == "2016")
      echo " selected" ?>> 2016 </option>
  <option value="2015" <?php if ($arstall == "2015")
      echo " selected" ?>> 2015 </option>
  <option value="2014" <?php if ($arstall == "2014")
      echo " selected" ?>> 2014</option>
  <option value="2013" <?php if ($arstall == "2013")
      echo " selected" ?>> 2013 </option>
  <option value="2012" <?php if ($arstall == "2012")
      echo " selected" ?>> 2012 </option>
</select-->
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

        <!--input type="submit" value="Oppdater"-->
        <input type="submit" name="submit" value="Oppdater">
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
            Avvik
        </th>
        <th style="text-align:right" scope="col" width="100">
            År
        </th>
        <th style="text-align:right" scope="col" width="100">
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
    //echo $query.'<br>';
    //echo 'f_periodenr '.f_periodenr("April").'<br>';
    //echo 'periode: '.$obj4->periode.'  : '.f_periodenr($obj4->periode).'<br>';
    //$query = 'CALL gruppesum1('.$_GET["regnar"].','.f_periodenr($obj4->periode).');SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar='.$_GET["regnar"].' AND periode="'.$obj4->periode.'" ;';
    
    $query = 'CALL gruppesum(' . $_GET["regnar"] . ',' . f_periodenr($obj4->periode) . ');';
    $db->setQuery((string) $query);
    //echo 'sql: ' . $query . '<br>';
    
    $messages = $db->loadObjectList();

    //      $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar=' . $_GET["regnar"] . ' AND periode="' . $obj4->periode . '" order by nr ;';
    //$query = 'SELECT * FROM qo7sn_regn_resrapport WHERE regnskapsar=' . $arstall. ' AND periode="' . $periodenavn. '" order by nr ;';
    //  $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=2015  AND periode="' . $periodenavn. '"ORDER BY nr,periodenr;'; 
    $query = 'SELECT * FROM qo7sn_regn_resrapport WHERE Regnskapsar=' . $_GET["regnar"] . '  AND periode="' . $periodenavn . '" ORDER BY nr,periodenr;';
    $db->setQuery((string) $query);
    //echo 'sql: '.$query.'<br>';
    
    $messages = $db->loadObjectList();

    $options = array();
    //echo '<table id="e" border="0" cellspacing="1" cellpadding="1">';
    if ($messages) {
        foreach ($messages as $message) {

            if ($message->niva > 1)
                echo '<tr><td colspan="8">-------------------------------------------------------------------------------------------------------------------------------------</td></tr>';
            echo '<td align ="right" style=" padding-right: 20px;">' . $message->nr . "</td>";
            echo '<td align ="left">' . $message->tekst . "</td>";
            echo '<td align ="right">' . $message->niva . "</td>";
            echo '<td align ="right">' . formatcurrency($message->belop, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->budsjett, "NOK") . "</td>";
            //   echo '<td align ="right">' .$message->prosent . "</td>";
            //echo '<td align ="right">' . formatcurrency($message->prosent, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->fjorarstall, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->hittil, "NOK") . "</td>";
            echo '<td align ="right">' . formatcurrency($message->avvik, "NOK") . "</td>";
            echo '<td align ="right">' . $message->ar . "</td>";
            echo '<td align ="right">' . $message->kontoer . "</td>";
            //  echo '<td align ="right">' .$message->periode. "</td>";
            //   echo '<td align ="right">' .$message->periodenr. "</td>";
            //        echo '<td align ="right">' .$message->ar . "</td>";
            echo "</tr>";
            if ($message->niva > 1)
                echo '<tr><td colspan="8">===============================================================================</td></tr>';
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

            location.reload();
            //  alert("reload");
        }
    </script>