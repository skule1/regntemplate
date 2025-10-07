
<table id='my-table-id'>
    <tr>
        <td>aaaaaaaaaaaaa</td>
    <tr>
        <td>bbbbbbbbbbbbbb</td>
    </tr>
</table>

<style>
    h1 {
        color: red;
    }

    p {
        color: blue;
    }

    input {
        height: 48;
    }

    tr {
        margin-top: 1px;
    }

    td {
        margin-right: 10px;
    }

    /* table, th, td {
  border: 1px solid black;

}*/

    .debet {
        vertical-align: text-top;

    }

    .table1 {
        vertical-align: text-top;
        border: 5px;

    }
</style>


<h1>
    <?php echo $this->msg; ?>
</h1>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    const id_dato = 2;
    const id_debet = 3;
    const id_kredit = 4;
    const id_belop = 5;
    const id_tekst = 6;



    function f_hent_siste_trans1(diff) {
        //     console.log("f_hent_siste_trans1 " + diff);
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "sistetrans"
            }),
            cache: false,
            success: function (tekst) {
                //     console.log(tekst);
                let obj4 = JSON.parse(tekst);
                // console.log(tekst);
                // console.log(obj4[0]);
                // console.log(obj4[0].debet);
                document.getElementById("2").value = obj4[0].Dato;
                //document.getElementById("3").value=obj4[0].debet;
                if (diff > 0) {
                    //   document.getElementById("4").value = obj4[0].kredit;
                    document.getElementById("5").value = diff;
                    document.getElementById("4").focus();
                } else {
                    //      document.getElementById("4").value = obj4[0].kredit;
                    document.getElementById("5").value = -diff;
                    document.getElementById("3").focus();

                }
                document.getElementById("6").value = obj4[0].tekst;
            }
        })
    }
</script>

<?php

use Joomla\CMS\Factory;
#include <time.h>
#include <locale.h>
#include <langinfo.h>


//$message = $this->params->get('custom_message', 'Hello, World!');
//$app->enqueueMessage($message);



if ($_SERVER["REQUEST_METHOD"] == "POST") {
}
if (isset($_GET['my_json'])) {
    echo $_GET['my_json'];/*
$my_json = $_GET['my_json'];
$my_json = json_decode($my_json);*/
}
//echo $my_jso . Navn;

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
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




// No direct access to this file
//defined('_JEXEC') or die('Restricted access');
include 'fc.php';

//echo currency('USD','NOK',100);

// $sql = 'SELECT * FROM  #_regn_kto WHERE Ktonr LIKE "4%"';
// echo $sql;
//$result = $conn -> query($sql);
//$row = $result -> fetch_array(MYSQLI_ASSOC);
//$row = $result -> fetch_array($result);
/*if ($result->num_rows==0)
   echo 'ukjent';
else */

//$result -> free_result();



//$result = mysqli_query($conn,$sql);
//$row = mysqli_fetch_array($result);
//echo json_encode($row);

?>

<?php



// $module = ModuleHelper::getModule('mod_Storebrand'); // Replace 'mod_custom' with your module name
// $moduleOutput = ModuleHelper::renderModule($module);

// // Output the module content
// echo $moduleOutput;
$session = Factory::getSession();
$value = $session->get('klient');
if ($value != null)
    echo '<h5>Klient: ' . $value . '</h5><br>';

$model = $this->getModel('registrering');

// Fetch the record
$sistepost = $model->sistepost();

$regnskapsarliste = $model->regnskapsarliste();
$kontoer = $model->kontoer();
$kontoer = json_decode(json_encode($model->kontoer()), true);
$regnskapsarliste = json_decode(json_encode($model->regnskapsarliste()), true);
$firma = $model->firma();
$regnskapsar = $firma->regnskapsar;
$oppstartvar = $model->startvariable();
$bilag = $oppstartvar['bilagnr'];
$buntnr = $oppstartvar['buntnr'];
$ref = $oppstartvar['ref'];
$transer = $model->transer($regnskapsar);
//echo 'siste post: ' . $firma->regnskapsar . '<br>';

// $modelReg = $this->getModel('registrering');

// // Fetch the record
// $sistepost = $modelReg->sistepost;
// echo 'siste post: ' . $sistepost . '<br>';
// $regnskapsar= $modelReg->regnskapsar;
// echo 'regnskapsar: ' . $regnskapsar . '<br>';



// $dato = '20-11-2023';
// $i = strpos($dato, '-');
// if ($i == 1)
//     $dato = "0" . $dato;
// $i = strpos($dato, '-');
// $j = strpos($dato, '-', ++$i);
// if ($j == 4)
//     $dato = substr($dato, 0, --$j) . '0' . substr($dato, $j);
// //echo 'dato: '.$dato.'<br>';

$nr1 = 1;





// $now = date_create()->format('Y-m-d');
// //echo $now.'<br>';
// $month = date("m", strtotime($now));
// switch ($month) {
//     case 1:
//         $manded = 'Januar';
//         break;
//     case 2:
//         $manded = 'Februar';
//         break;
//     case 3:
//         $manded = 'Mars';
//         break;
//     case 4:
//         $manded = 'April';
//         break;
//     case 5:
//         $manded = 'Mai';
//         break;
//     case 6:
//         $manded = 'Juni';
//         break;
//     case 7:
//         $manded = 'Juli';
//         break;
//     case 8:
//         $manded = 'August';
//         break;
//     case 9:
//         $manded = 'September';
//         break;
//     case 10:
//         $manded = 'Oktober';
//         break;
//     case 11:
//         $manded = 'November';
//         break;
//     case 12:
//         $manded = 'Desember';
//         break;
// }
//echo 'måned: '.$month.' : '.$manded.'<br>';
//echo 'function måned: '.FManed($now).'<br>';
// $id = 0;
// $db = JFactory::getDBO();
// $query = $db->getQuery(true);
if (isset($_GET["regnskapsar"])) {
    $regnskapsar = $_GET["regnskapsar"];
    $model->oppdater_regnskapsar($regnskapsar);
}
// $query = 'select * from #__regn_regnskapsar order by regnskapsar desc;';
// $db->setQuery($query);
// $count = $db->loadResult();
//echo 'count ' . $count . '<br>';




// $query = 'select * from #__regn_regnskapsar order by regnskapsar desc;';
// $db->setQuery((string) $query);
// $mes = $db->loadColumn();
// //echo $mes[2];
// $nr = 0;
// $ant = $db->getCount();
// // echo 'ant '.$ant.'<br>';

//
?>

<?php
$modus = 'standard';
if (isset($_GET['modus'])) {
    $modus = $_GET['modus'];
}
;

if (isset($_GET['valgt_ar'])) {
    $valgt = $_GET['valgt_ar'];
    $model->oppdater_regnskapsar($valgt);
} else if (isset($regnskapsar)) {
    $valgt = $regnskapsar;
}
;




// $i = 0;
// $v = 0;
// //echo '$i: '.$i.' $ant: '.$ant.' sizeof($mes): '.sizeof($mes).'<br>';
// if (sizeof($mes) > 0)
//     while (($i <= sizeof($mes)) && ($i <= $ant)):
//         if ($mes[$i++] == $valgt)
//             $v = $i - 1;
//     endwhile;

?>



<!--div class="container mt-5"-->
<form action="" method="GET" style=" margin-left: 20px;">
    Regnskapsår:
    <?php
    // $query = 'select  * from #__regn_trans;';
    // $db->setQuery((string) $query);
    // $mes3 = $db->loadObject();
    
    if (is_null($transer)) {

        //  echo 'resp: '.$res.'<br>';
        ?>
        valg <select id="valg_ar" Name="valg_ar" onchange="endre_ar()">

            <?php
            while ($nr < count($regnskapsarliste)): {
                    echo $regnskapsarliste[$nr++]["regnskapsar"] . '<br>';
                    if ($regnskapsarliste[$nr]["regnskapsar"] == $regnskapsar)
                        echo '<option value=' . $regnskapsarliste[$nr]["regnskapsar"] . ' selected>' . $regnskapsarliste[$nr++]["regnskapsar"] . '</option>';
                    else
                        echo '<option value=' . $regnskapsarliste[$nr]["regnskapsar"] . '>' . $regnskapsarliste[$nr++]["regnskapsar"] . '</option>';
                }
            endwhile;

            ?>
        </select>
        <?php
    } else
        echo $regnskapsar; ?>
    Modus: <select id="modus" Name="modus" Size="Number_of_options" onchange="f_modus()" value="<?php echo $modus ?>">
        <option value="standard" <?php if ($modus == 'standard')
            echo ' selected>Standard';
        else
            echo '>Standard' ?>
                </option>
            <option value="valuta" <?php if ($modus == 'valuta')
            echo ' selected>Valuta';
        else
            echo '>Valuta' ?> </option>
        </select>

        <?php
        //  $regnskapar =  $_COOKIE['regnskapsar'];
        
        // echo 'cookie regnskapsar: '.$regnskapar;
        
        /*
                    if(isset($_GET['ar'])){
                    if(!empty($_GET['ar'])) {
                    $selected=   $_GET['ar'];
                    //   foreach($_GET['ar'] as $selected){
                    // echo '  ' . $selected;
                    $query='update #__regn_firma set regnskapsar='.$selected.';';
                    $db->setQuery((string) $query);
                    //  $mes=$db->loadObject();

                    header("Refresh:0");
                    //     }
                    } else {
                    echo 'Please select the value.';
                    }
                    } */
        ?>
    </div-->

    <?php

    // $query = 'select * from #__regn_kto'; // where Ktonr=4010';
    // $db->setQuery((string) $query);
    // //$messages = $db->loadObjectList();
    // $mes = $db->loadObject();
    $mes = $kontoer;
    if (is_null($mes))
        echo 'finnes ikke<br>';
    else {
        //echo 'mes ' . $mes. '<br>';
        //$result=mysqli_query($conn, $sql);
        //$db->setQuery((string) $query);
        // $mes=$db->loadRow();
        //   echo 'kto: ' . $mes->Ktonr . '<br>';
        //   echo 'kto: ' . $mes->Navn . '<br>';
    
        //$query->select('Dato,debet,kredit,belop');
        //$query->from('#__regn_trans');
        // $query = 'select Buntnr from #__regn_hist order by Buntnr desc limit 1;';
        // //$query = 'select * from #_regn_kto;';
        // $db->setQuery((string) $query);
        // $messages = $db->loadObjectList();
        // $mes = $db->loadObject();
        // $options = array();
        // $buntnr = intval($mes->Buntnr) + 1;
    
        // $query = 'select Bilag from #__regn_hist order by Bilag desc limit 1;';
        // $db->setQuery((string) $query);
        // $mes = $db->loadObject();
        // $bilag = intval($mes->Bilag);
        // $query = 'select Bilag from #__regn_trans order by Bilag desc limit 1;';
        // $db->setQuery((string) $query);
        // $mes = $db->loadObject();
        // //     echo 'mes: '.$mes.' : '.isset($mes).'<br>';
        // if (isset($mes)) {
        //     $bilag1 = intval($mes->Bilag);
        //     // echo 'bilag: '.$bilag .' : '.$bilag1.'<br>';
        // } else
        //     $bilag1 = '0';
        // $query = 'select ref from #__regn_hist order by ref desc limit 1;';
        // $db->setQuery((string) $query);
        // $mes = $db->loadObject();
        // $ref = intval($mes->ref);
        // $query = 'select Ref from #__regn_trans order by Ref desc limit 1;';
        // $db->setQuery((string) $query);
        // $mes = $db->loadObject();
        // if (isset($mes))
        //     $ref1 = intval($mes->Ref);
        // else
        //     $ref1 = '0';
    
        // if ((intval($ref)) < (intval($ref1)))
        //     $ref = $ref1;
        // if ((intval($bilag)) < (intval($bilag1)))
        //     $bilag = $bilag1;
    }
    echo '  Buntnr: ' . $buntnr; // . '<br></form>';
    echo ' <input type="button" style=" width:100px;" value="Oppdater" onclick="oppdater_hist()" /></form><br>';

    //  echo 'Ref: '.$ref .' : '.$ref1.'<br>';
    /* echo '<table id="e" border="0" cellspacing="1" cellpadding="1">';
    if ($messages)
        {
            foreach ($messages as $message)
            {
                $buntnr=intval($message->Buntnr)+1;

            echo "<td>" .$message->Buntnr . "</td>";
           echo "<td>" .$buntnr. "</td>";
       //     echo "<td>" .$message->kredit . "</td>";
       //     echo "<td>" .$message->belop . "</td>";
            echo "</tr>";
            }
        }
    echo '</table>';
/*

$conf = new JConfig();
$database=$conf->db;
$hash= $conf->dbprefix;

//$fmt = new NumberFormatter( 'nb_NO', NumberFormatter::CURRENCY );

 function databaseconnect()
{
$conf= new JConfig();
$servername = "localhost";
$username = "admin";
$password = "230751";
$database=$conf->db;
$conn = new mysqli($servername, $username, $passwmodusord,$database);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if (!$conn->set_charset("latin1")) {
printf("Error loading character set latin1: %s\n", $conn->error);
exit();
 };
//else {printf("Current character set: %s\n", $conn->character_set_name());}
return $conn;
}

*/
    //echo $date();
    
    if (isset($_GET['Send'])) { //check if form was submitted
        $input = $_GET['1']; //get input text
        echo "Success! You entered: " . $input . '<br>';
    }
    //echo 'modus: '.$modus.'<br>';
    //$link=databaseconnect();
    // $query = 'SELECT * FROM  #__regn_trans order by ref ';
    // $db->setQuery((string) $query);
    // $messages = $db->loadObjectList();
    
    //echo 'ref: '.$ref.' bilagsnr  '.$bilag.'<br>';
    $messages = $transer;

    // if (isset($_GET["valuta"]))
    //     echo 'get:' . ($_GET["valuta"] == "NOK") . '<br>';
    $msg = '
<form action="" method="get" name="reg">
    <table id="my-table-id" style=" margin-left: 10px;" id="e" border="0"  cellspacing="1" cellpadding="1">
        <tr>
        <th scope="col" width="10"  height="48">
                Nr
            </th>       <th scope="col" width="20"  height="48">
                Ref
            </th>
            <th scope="col" width="50"  height="48" class="text-center">
                Bilagnr
            </th>
        <th   scope="col" width="70" >
                Skannet
            </th>           <th scope="col" width="10"  height="48" class="text-center">
            Art
        </th>
        <th scope="col" width="100"  height="48" class="text-center">
        Dato
    </th>
    <th scope="col" width="50">
                Debet
            </th>
            <th scope="col" width="50">
             Kredit
            </th>';

    if ($modus == 'valuta')
        $msg = $msg . ' <th class="text-center" scope="col" width="200">
                Valuta
            </th>';
    $msg = $msg . ' <th class="text-center" scope="col" width="50">
            Beløp
        </th>
        <th   scope="col" width="200" >
                Tekst
            </th>

            <th scope="col">&nbsp;</th>
        </tr>';

    $debetsum = 0;
    $kreditsum = 0;
    $buntsum = 0;
    $nr = 0;
    if ($messages) {
        foreach ($messages as $message) {
            $nr++;
            if ($nr == 30)
                break;

            //        echo $message->belop.'<br>';
            $buntsum = $buntsum + $message->belop;
            if ($message->debet > 0)
                $debetsum = $debetsum + $message->belop;
            if ($message->kredit > 0)
                $kreditsum = $kreditsum + $message->belop;

            //    echo "<td>" .$message->Dato . "</td>";
            /*
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
     */
            //<input type="date" id="birthday" name="birthday">
            // echo 'dato1: ' . $message->Dato . '<br>';
            $message->Dato = date("d.m.Y", strtotime($message->Dato));
            // echo 'dato2: ' . $message->Dato . '<br>';
            $k = strpos($message->kontoinfo, ' ');
            $debet = "2" . $message->Ref;
            $msg = $msg . '<tr>'
                . '<td style="text-align:right;width:20px;  padding-right: 10px;">' . $nr1++ . "</td>"
                . '<td style="text-align:right; width:50px; id=$message->Ref" onclick="f_ref(' . $message->Ref . ')"   >' . $message->Ref . "</td>"
                . '<td  style="text-align:right;"> ' . $message->bilag . "</td>"
                . '<td  style="text-align:right;width:10px;"> ' . $message->Skannet . "</td>"
                . '<td  style="text-align:right;"> <input type="text" id="bilagsart' . $message->Ref . '"  onclick="btn(' . $message->Ref . ')"  onchange="updatefield(' . $message->Ref . ')" style=" width:30px; border-width:0px; direction: rtl;" value="' . $message->Bilagsart . '"></td>'
                . '<td  style="text-align:right;"> <input type="text" id="dato' . $message->Ref . '"  onclick="btn(' . $message->Ref . ')"  onchange="updatefield(' . $message->Ref . ')" style=" width:115px; border-width:0px; direction: rtl;"  value="' . $message->Dato . '"></td>'
                . '<td  style="text-align:right;"> <input type="text" id="debet' . $message->Ref . '"   onclick="btn(' . $message->Ref . ')" onchange="updatefield(' . $message->Ref . ')" style=" width:50px; border-width:0px; direction: rtl;"   value="' . $message->debet . '"></td>'
                . '<td  style="text-align:right;"> <input type="text" id="kredit' . $message->Ref . '"  onclick="btn(' . $message->Ref . ')"  onchange="updatefield(' . $message->Ref . ')" style=" width:50px; border-width:0px; direction: rtl;"  value="' . $message->kredit . '"></td>';
            /*       ?>
                    <tr></tr><td > <input type="text" id="debet10" onchange="updatefield1(44)" value="445"></td> </tr>
                   <?php
       */
            if ($modus == 'valuta') {
                if ($message->currency_amount == 0)
                    $msg = $msg . '<td></td>';
                else
                    $msg = $msg . '<td  width="200"; style="text-align:right; "> ' . number_format($message->currency_amount, 2, ',', '.') . ' ' . $message->currency . "</td>";
            }
            //           $msg = $msg .'<td  width="100"; style="text-align:right; "> ' . formatcurrency($message->currency_amount,"INR").' '.$message->currency. "</td>";
    
            $msg = $msg
                //               . '<td  > <input type="text" id="belop' . $message->Ref . '"   style=" width:100px; border-width:0px; align:right" onclick="btn(' . $message->Ref . ')"  onchange="updatefield(' . $message->Ref . ')"  value="' . formatcurrency($message->belop, "NOK")  . '"></td>'
                //             . '<td  > <input type="text" id="belop' . $message->Ref . '"   style=" width:100px; border-width:0px; align:right"  onclick="btn(' . $message->Ref . ')"  onchange="updatefield(' . $message->Ref . ')"  value="' . formatcurrency($message->belop, "NOK")  . '"></td>'
                . '<td  > <input type="text" id="belop' . $message->Ref . '"   style=" width:120px; text-align:right; border-width:0px; " onclick="btn(' . $message->Ref . ')"   onchange="updatefield(' . $message->Ref . ')"  value="' . formatcurrency($message->belop, "NOK") . '"></td>'
                . '<td  > <input type="text" id="tekst' . $message->Ref . '"  style="width:200px;padding-left: 10px; border-width:0px;" onclick="btn(' . $message->Ref . ')"  onclick="btn(' . $message->Ref . ')"  onchange="updatefield(' . $message->Ref . ')"  value="' . $message->tekst . '"></td>'
                . '<td  > <input type="button" style="display:none;" id="button' . $message->Ref . '"  onclick="btn1(' . $message->Ref . ')"  value="X"></button></td>'
                . '<td  > <input type="text" id="kontoinfo' . $message->Ref . '"  style="width:100px;padding-left: 10px; border-width:0px;" onclick="btn(' . $message->Ref . ')" onchange="updatefield(' . $message->Ref . ')"  value="' . substr($message->kontoinfo, 0, $k) . '"></td>'
                . '<td  > <input type="text" id="reskontro' . $message->Ref . '"  style="width:500px;padding-left: 10px; border-width:0px;" onclick="btn(' . $message->Ref . ')" onchange="updatefield(' . $message->Ref . ')"  value="' . $message->reskontro . '"></td>'
                . "</tr>";
        }
    }

    //  border: 1px solid black;
    
    ?>



    <?php
    // Call a JS function "from" php
    
    if ($debetsum - $kreditsum <> 0) {   // This if() is to point out that you might
        // want to call JSFunction conditionally
        // An echo like this is how you implant the 'call' in a way
        // that it will be invoked in the client.
        echo '<script type="text/javascript">
    f_hent_siste_trans1(' . $debetsum - $kreditsum . ');
    </script>';
    }

    ?>

    <?php









    echo $msg;

    $msg = $msg . '</tr></table></form>';
    // onkeydown="finn_kto"
    //$boxsize=$_REQUEST["hiddencontainer"];             onsubmit="neste(3)"    onsubmit="neste(4)"   onkeydown="finn_kkto()"" onclick="finn_kto()"
    //echo $boxsize;
    

    //if (!is_null($mes)){
    ?>
    <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!--table style=" margin-left: 20px;"  -->
        <table style=" margin-left: 5px;" id="e" border="0" cellspacing="1" cellpadding="1">
            <td align="right" style="text-align:right;width:10px; border-width:0px;  padding-right: 10px;">
                <?php echo $nr1 ?>
            </td>
            <td align="right"><input type="hidden" style=" width:150px;  border-width:0px; align:left" id="ref"
                    value=" <?php echo ($ref + 1) ?>"></td>

            <td align="right" style="text-align:right;width:20px; border-width:0px;  padding-right: 10px;">
                <?php echo ($ref + 1) ?>
            </td>
            <td style="text-align:right;width:45px; border-width:0px;">
                <?php echo ' ' . ($bilag + 1) ?>
            </td>
            <td align="right" style="padding-right: 10px; width:63px;">

            </td>
            <!--td><input type="text" id=1 style=" width:30px;" onkeydown="fart()"   > </td-->

            <td><input type="text" id=1 style=" width:30px;" onkeydown="list_art()" onclick="list_art()"
                    onchange="list_art()"> </td>
            <!--td><input type="text" id=1 style=" width:30px;" onkeydown="finn_kto()"   > </td-->
            <td><input type="text" placeholder="DD.MM.YYYY" name="Dato" id=2 style=" width:115px;"
                  onchange="datokonv4(<?php echo $regnskapsar ?>,<?php echo $sistepost->Dato ?>)" </td>           

            <td><input type="text" id=3 name="debet" style=" width:50px;" onclick="finn_kto(0)" onkeydown="finn_kto(1)"
                    onchange="finn_kto(2)">
            </td>

            <!-- <td><input type="text" id=3 name="debet" style=" width:50px;" onmousedown="finn_kto(0)"
                    onkeydown="finn_kto(1)" onchange="finn_kto(2)">
            </td>             -->
            <td><input type="text" id=4 style=" width:50px;" class="no-outline" onclick="finn_kkto(0)"
                    onkeydown="finn_kkto(1)"> </td>
            <?php if ($modus == 'valuta') {
                ?>
                <td><input type="text" id="val" disabled class="no-outline" style=" width:150px;"
                        onkeydown="belop(<?php echo $modus ?>)">
                </td>
                <?php
            } else {
                echo ' <input type="hidden" id="val" class="no-outline" style=" width:100px;">';
            }
            ?>
            <td><input type=" text" id=5 class="no-outline" style=" width:100px;"
                    onkeydown="belop('<?php echo $modus ?>')">
            </td>
            <td><input type="text" id=6 style=" width:200px;"
                    onkeydown="UpdateRecord(<?php echo ++$ref ?>,<?php echo ++$bilag ?>,<?php echo $buntnr ?>,'<?php echo $modus ?>')">
            </td>
            <td><input type="hidden" id="buntnr" name="buntnr" value="<?php echo $buntnr ?>" /></td>
            </tr>
            <tr>
                <td>&nbsp</td>
            </tr>
            <tr>
                <td colspan="9" align="middle">
                    <input type="button" onclick="slett()" disabled value="Slett post" id="btn_slett"
                        style=" width:120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" onclick="PrintDiv()" value="Utskrift"
                        style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <input type="button" value="Endre" onclick="console.log(ff)"
                        style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php if ($modus == 'valuta') {
                        ?>

                        <input type="button" name="valuta" value="DKK" style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    <?php } ?>
                    <!--input type="button" style=" width:100px;" value="Oppdater" onclick="oppdater_hist()" /-->


                </td>

                </td>
                <!--td colspan="5" align="right"><input < ?php if( $id==5) echo 'type="Submit"' ?> name="Send" id="ok" value="Submit" style="width:100px;"
                    onclick="this.disabled=0" ; />
            </td-->
            </tr>

            <!--tr height="20px"></tr-->

            <!--?php setlocale(LC_MONETARY, 'en_US'); ?-->


        </table>
    </form>
    <form>
        <table style=" margin-left: 20px;">
            <tr height="20px"></tr>
            <tr>
                <td width="100" align="right">Buntsum:</td>
                <td align="left">
                    <?php echo number_format($buntsum, 2, ',', '.'); ?>
                </td>
                <td width="100" align="right">Debet sum:</td>
                <td align="left">
                    <?php echo number_format($debetsum, 2, ',', '.'); ?>
                </td>
                <td width="100" align="right">Kredit sum:</td>
                <td align="left">
                    <?php echo number_format($kreditsum, 2, ',', '.'); ?>
                </td>
                <td width="100" align="right">Diff: sum:</td>
                <td align="left">
                    <?php echo number_format($debetsum - $kreditsum, 2, ',', '.'); ?>
                </td>
            </tr>
            <tr>
                <td>.</td>
                </td>
            </tr>
        </table>
    </form>


    <table class="table1" cellspacing="0" style=" margin-left: 20px;" cellpadding="0" border="3">
        <tr>
            <td style="vertical-align:top" colspan="5">
                <div id="db">
            </td>
            <td style="vertical-align:top" colspan="5">
                <div id="kr">
            </td>
        </tr>
    </table>
    <?php
    //echo "<script> list_art(); </script>";
    
    //echo ' <div id="divToPrint" style="display:none;"> ' . $msg . '</div>';
    ?>


    <?php


    function datokonv($inn)
    {
        $ut = substr($inn, 8, 2) . "." . substr($inn, 5, 2) . "." . substr($inn, 0, 4);
        return $ut;
        // document.getElementById("debet").focus();
    }

    //function currency($from,$to,$belop){
    
    function currency($from, $to)
    {

        //  echo 'from '.$from.'<br>';
        // https://www.exchangerate-api.com/   -  for å få Free Key
        $key = '0e47c9534f62f4c54b2ef46b';
        $from_currency = $from;
        //$my_var = file_get_contents('https://v6.exchangerate-api.com/v6/'.$key.'/latest/'.$from_currency.');
        //$url='https://v6.exchangerate-api.com/v6/'.$key.'/latest/'.$from_currency;
        //echo $url.'<br>';
        $file = 'https://v6.exchangerate-api.com/v6/' . $key . '/latest/' . $from;
        //echo 'file: '.$file.'<br>';
        $my_var = file_get_contents($file);
        //$my_var = file_get_contents('https://v6.exchangerate-api.com/v6/0e47c9534f62f4c54b2ef46b/latest/DKK');
        //echo $my_var;
    

        $gg = json_decode($my_var);
        //echo '<br><bt>'.$gg;
        $tt = $gg->conversion_rates;
        $hh = $tt->NOK;
        //echo '<br><br>'.$hh;;
    
        /*
$gg=json_decode($belop);
//echo '<br><bt>'.$gg;
$tt=$gg->conversion_rates;
$hh=$tt->NOK;
echo '<br><br>'.$hh;;
*/
        //return $hh*$belop;
        return $hh;
    }


    function FManed($now1)
    {
        $month = date("m", strtotime($now1));
        switch ($month) {
            case 1:
                $manded = 'Januar';
                break;
            case 2:
                $manded = 'Februar';
                break;
            case 3:
                $manded = 'Mars';
                break;
            case 4:
                $manded = 'April';
                break;
            case 5:
                $manded = 'Mai';
                break;
            case 6:
                $manded = 'Juni';
                break;
            case 7:
                $manded = 'Juli';
                break;
            case 8:
                $manded = 'August';
                break;
            case 9:
                $manded = 'September';
                break;
            case 10:
                $manded = 'Oktober';
                break;
            case 11:
                $manded = 'November';
                break;
            case 12:
                $manded = 'Desember';
                break;
        }
        ;
        return $manded;
    }

?>
    <!-- <script type="text/javascript" src="\components\com_regn\views\Registrering\tmpl\script1.js"></script> -->
    <script type="text/javascript" src="./script1.js"></script>
