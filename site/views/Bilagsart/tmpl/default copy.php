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

    /* table, th, td {
  border: 1px solid black;
  */
</style>

<?php

$slettknapp_id = 0;

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
defined('_JEXEC') or die('Restricted access');
include 'fc.php';
?>



<h1><?php echo $this->msg; ?></h1>
<?php

$now = date_create()->format('Y-m-d');
//echo $now.'<br>';
$month = date("m", strtotime($now));
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
//echo 'måned: '.$month.' : '.$manded.'<br>';
//echo 'function måned: '.FManed($now).'<br>';
$id = 0;
$db    = JFactory::getDBO();
$query = $db->getQuery(true);

$query = 'select * from #__regn_kto where Ktonr=4010';
$db->setQuery((string) $query);
//$messages = $db->loadObjectList();
$mes = $db->loadObject();

if (!is_null($mes))
    echo 'finnes<br>';
else
    echo 'IKKE <br>';
//echo 'mes ' . $mes. '<br>';
//$result=mysqli_query($conn, $sql);
//$db->setQuery((string) $query);
// $mes=$db->loadRow();
//   echo 'kto: ' . $mes->Ktonr . '<br>';
//   echo 'kto: ' . $mes->Navn . '<br>';

//$query->select('Dato,debet,kredit,belop');
//$query->from('#__regn_trans');
$query = 'select Buntnr from #__regn_hist order by Buntnr desc limit 1;';
//$query = 'select * from #_regn_kto;';
$db->setQuery((string) $query);
$messages = $db->loadObjectList();
$mes = $db->loadObject();
$options  = array();
$buntnr = intval($mes->Buntnr) + 1;
echo 'Buntnr: ' . $buntnr . '<br>';
$query = 'select Bilag from #__regn_hist order by Bilag desc limit 1;';
$db->setQuery((string) $query);
$mes = $db->loadObject();
$bilag = intval($mes->Bilag);
$query = 'select Bilag from #__regn_trans order by Bilag desc limit 1;';
$db->setQuery((string) $query);
$mes = $db->loadObject();
//     echo 'mes: '.$mes.' : '.isset($mes).'<br>';
if (isset($mes)) {
    $bilag1 = intval($mes->Bilag);
    // echo 'bilag: '.$bilag .' : '.$bilag1.'<br>';
} else $bilag1 = '0';
$query = 'select ref from #__regn_hist order by ref desc limit 1;';
$db->setQuery((string) $query);
$mes = $db->loadObject();
$ref = intval($mes->ref);
$query = 'select Ref from #__regn_trans order by Ref desc limit 1;';
$db->setQuery((string) $query);
$mes = $db->loadObject();
if (isset($mes))
    $ref1 = intval($mes->Ref);
else
    $ref1 = '0';

if ((intval($ref)) < (intval($ref1)))
    $ref = $ref1;
if ((intval($bilag)) < (intval($bilag1)))
    $bilag = $bilag1;

//  echo 'Ref: '.$ref .' : '.$ref1.'<br>';
/* echo '<table id="e" border="1" cellspacing="1" cellpadding="1">';
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
$conn = new mysqli($servername, $username, $password,$database);
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

//$link=databaseconnect();
$query = 'SELECT * FROM  #__regn_bilagsarter';
$db->setQuery((string) $query);
$messages = $db->loadObjectList();

?>
<form action="" method="get" name="reg">
    <table id="e" border="0" cellspacing="1" cellpadding="1">
        <tr>
            <th scope="col" width="15" height="48" class="text-center">
                Art
            <th scope="col" width="80" height="48" class="text-center">
                Beskrivelse
            </th>
            </th>
            <th scope="col" width="100" height="48" class="text-center">
                Dato
            </th>
            <th class="text-center" scope="col" width="50">
                Debet
            </th>
            <th class="text-center" scope="col" width="50">
                Kredit
            </th>
            <th class="text-center" scope="col" width="50">
                Beløp
            </th>
            <th class="text-center" scope="col" width="200">
                Tekst
            </th>
            <th scope="col">&nbsp;</th>
        </tr>';
        <?php
        if ($messages) {
            foreach ($messages as $message) {
                //    echo "<td>" .$message->Dato . "</td>";
                /*
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
     */
                /*          .'<td style="text-align:right;"> ' . $message->id . "</td>"
            . '<td  style="text-align:left; padding-left: 5px;"> ' .$message->beskrivelse.  "</td>"
            . '<td  style="text-align:center;padding-left: 5px;"> ' .datokonv( $message->dato). "</td>"
            . '<td  style="text-align:right;padding-left: 5px;"> ' .$message->debet .  "</td>"
            .'<td    style="text-align:right;padding-left: 5px;">'. $message->kredit.'</td>'  
            . '<td  style="text-align:right;padding-left: 5px;"> '. formatcurrency($message->belop, "NOK") . "</td>"
            . '<td style=" padding-left: 5px;" > '. $message->tekst . "</td>"
            . "</tr>";
*/

        ?>
                <tr>
                <tr>
                    <td><input type="text" align="right" style="width:50px;text-align:right;border-width:0px;" id="<?php echo  $message->id ?>_id"
                            value="<?php echo  $message->id ?>" onclick="idclick( <?php echo  $message->id ?>)" onchange=pos(<?php echo  $message->id ?>+"_id") </td>
                    <td><input type="text" align="left" onchange=pos(<?php echo  $message->id ?>+"_beskrivelse") id="<?php echo  $message->id ?>_beskrivelse"
                            value="<?php echo  $message->beskrivelse ?>" style="border-width:0px;width:200px;"> </td>
                    <td> <input type="text" align="left" id="<?php echo  $message->id ?>_dato" name="Dato" value="<?php echo  $message->dato ?>"
                            style="border-width:0px; width:100px;" onchange=pos(<?php echo  $message->id ?>+"_dato") /> </td>
                    <td><input type="text" id="<?php echo  $message->id ?>_debet" style="border-width:0px;width:50px;"
                            value="<?php echo   $message->debet ?>" onchange=pos(<?php echo  $message->id ?>+"_debet")> </td>
                    <td><input type="text" id="<?php echo  $message->id ?>_kredit" style="border-width:0px; width:50px;"
                            value="<?php echo  $message->kredit ?>" onchange=pos(<?php echo  $message->id ?>+"_kredit")> </td>
                    <td><input type="text" id="<?php echo  $message->id ?>_belop" style="width:100px;border-width:0px;"
                            value="<?php echo  $message->belop ?>" onchange=pos(<?php echo  $message->id ?>+"_belop")> </td>
                    <td><input type="tekst" onchange=pos(<?php echo  $message->id ?>+"_tekst") id="<?php echo  $message->id ?>_tekst" style="width:200px;border-width:0px;"
                            value="<?php echo  $message->tekst ?>"> </td>
                </tr>
        <?php

            }
        }

        ?>


        <tr>
            <td><input type="text" align="right" onmousedown="valg(3)" id="1art" style=" width:50px;" onchange="neste('art')"> </td>
            <td><input type="text" align="left" id="1beskrivelse" style=" width:200px;" onchange="neste('beskrivelse')">
            </td>
            <td> <input type="text" align="left" name="Dato" id="1dato" style=" width:100px;"
                    onchange="datokonv2('dato')" /> </td>
            <td><input type="text" id="1debet" style=" width:50px;" onchange="neste('debet')"> </td>
            <td><input type="text" id="1kredit" style=" width:50px;" onchange="nestekred( 'kredit')"> </td>
            <td><input type="text" id="1belop" class="no-outline" style=" width:100px;" onchange="neste( 'belop')">
            </td>
            <td><input type="text" id="1tekst" style=" width:200px;"> </td>
        </tr>
        <tr>
            <td>&nbsp</td>
        </tr>
        <tr></tr>

        <tr>
            <td colspan="9" align="middle">
                <input type="button" id="btn_slett" disabled value="Slett post" onclick="slett()"
                    style=" width:120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="button" onclick="PrintDiv()" value="Utskrift"
                    style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <!--input type="button" value="Endre" style=" width:100px;" -->
                <input type="button" style="width:100px;" value="Oppdater" onclick="UpdateRecord()">
            </td>
        </tr>
        <tr height="20px"></tr>
        <tr></tr>
        <tr>
            <td colspan="8">Debet:
                <input type="text" id="1infokto" style="text-align:right; border-width:0px; width:50px;">
                <input type="text" id="1info" style="text-align:left; border-width:0px; width:200px;">
                Kredit:
                <input type="text" id="2infokto" style="text-align:right; border-width:0px; width:50px;">
                <input type="text" id="2info" style="text-align:left; border-width:0px; width:200px;">
            </td>
        </tr>
    </table>
</form>

<?php
//echo ' <div id="divToPrint" style="display:none;"> '.$msg.'</div>'; 
?>
<script>
    document.getElementById("1art").focus();
</script>

<?php



function datokonv($inn)
{
    $ut = substr($inn, 8, 2) . "." . substr($inn, 5, 2) . "." . substr($inn, 0, 4);
    return $ut;
}
function FManed($now1)
{
    // $manded='test'; 
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
    return $manded;
}


?>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

    var slettknapp_id = 0;
  
    function valg(i) {
        console.log('valg ' + i);
    }


    function datokonv2(dt) {

        let vv = document.getElementById('1dato').value;
        let text = vv;
        //alert("dato " + dt);
        if ((vv.indexOf(",") != -1) || (vv.indexOf(".") != -1)) {
            if (vv.indexOf(",") != -1) {
                var result = text.indexOf(",");
                var min = vv.substring(0, result);
                if ((min > 24) || (min < 0)) alert("feil minutt " + min);
                var result1 = text.indexOf(",", result + 1);
            } else {
                var result = text.indexOf(".");
                var min = vv.substring(0, result);
                if ((min > 24) || (min < 0)) alert("feil minutt " + min);
                var result1 = text.indexOf(".", result + 1);
            };
            var time = vv.substring(result + 1, result1);


            if ((time > 24) || (time < 0)) alert("feil time " + time);
            var ar = vv.substring(result1 + 1);
            var arstr = "19" + ar.toString();
            if (ar < 24) arstr = "20" + ar.toString();
            else arstr = "19" + ar.toString();
            var y = arstr + "-" + time.toString() + "-" + min.toString();
            document.getElementById('1dato').value = y;
        }
        // alert("dato1 " + y);
        document.getElementById("1debet").focus();
        //return y;
    }

    function idclick(v) {


        document.getElementById("btn_slett").disabled = false;
        console.log('id ' + v);
        slettknapp_id = v;
        //    const p= new Promise(resolve)=>{ resolve(v);}
    }

    function slett() {
        //    const id = await idclick();
        console.log("slett1 " + slettknapp_id);

        // #__regn_bilagsarter?  return;
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=bilagsart.slett",
            data: ({
                a: 'aa',
                id: slettknapp_id
            }),
            cache: false,
            success: function(response) {
                console.log(response);
                document.getElementById("btn_slett").disabled = true;
                location.reload();
                //      alert("Siste post ble slettet.");
            }
        });

    }

    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=900,height=750');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }

    function pos(i) {

        console.log('pos: ' + i);
        var val = document.getElementById(i).value;
        let j = i.indexOf('_');
        let id = i.substring(0, j);
        let f = i.substring(j + 1);

        console.log('id: ' + id + ' f:' + f + ' val: ' + val);

        jQuery.ajax({
            type: "POST",
            url: 'index.php?option=com_regn&task=bilagsart.oppd',
            data: ({
                val: val,
                id: id,
                navn: f
            }),
            cache: false,
            success: function(tekst) {
                console.log("tekst: " + tekst);
                //  const obj = JSON.parse(tekst);
            }
            //return tekst;

        })
    }

    function neste(i) {
        return;
        //alert("input " + i);
        var ii = i;
        if (i == "debet") {
            var konto = document.getElementById("1debet").value;
        } else if (i == "kredit") {
            var konto = document.getElementById("1kredit").value;
        }
        //  alert("neste id: " + konto);
        //  alert("ret10: " + i);
        if ((i == "debet") || (i == "kredit")) {
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                data: ({
                    mode: "konto",
                    konto: konto
                }),
                cache: false,
                success: function(tekst) {
                    //      alert("tekst: "+tekst);
                    const obj = JSON.parse(tekst);
                    //       alert("RET ");
                    //       alert("RET: " + obj.Navn);
                    if (ii == "debet") {
                        //       alert("pass");
                        //         alert("debet " + obj.Navn);
                        document.getElementById("1info").value = obj.Navn;
                        document.getElementById("1infokto").value = obj.Ktonr;
                    } else if (ii == "kredit") {
                        //       alert("kredit " + obj.Navn);
                        document.getElementById("2info").value = obj.Navn;
                        document.getElementById("2infokto").value = obj.Ktonr;
                    }
                    /*     if (ii = "debet") {
                             document.getElementById("kredit").focus();
                         } else if (ii = "kredit") {
                             document.getElementById("belop").focus();
                         }
                         */
                }
                //return tekst;

            });
        };
        // alert("ret: " + ii + " : " + i);
        if (ii == "art") {
            //     alert("focus kredit "+ii);
            document.getElementById("1beskrivelse").focus();
        } else if (ii == "beskrivelse") {
            //     alert("focus "+ii);
            document.getElementById("1dato").focus();
        } else if (ii == "dato") {
            //     alert("focus "+ii);
            document.getElementById("1debet").focus();
        } else if (ii == "debet") {
            //     alert("focus "+ii);
            document.getElementById("1kredit").focus();
        } else if (ii == "kredit") {
            //     alert("focus "+ii);
            document.getElementById("1belop").focus();
        } else if (ii == "belop") {
            //     alert("focus "+ii);
            document.getElementById("1tekst").focus();
        };


    }


    function neste1(i) {
        console.log('neste ' + i);
        var ii = i;
        if (i == "debet") {
            var konto = document.getElementById("1debet").value;
        } else if (i == "kredit") {
            var konto = document.getElementById("1kredit").value;
        }
        if ((i == "debet") || (i == "kredit")) {
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                data: ({
                    mode: "konto",
                    konto: konto
                }),
                cache: false,
                success: function(tekst) {
                    //      alert("tekst: "+tekst);
                    const obj = JSON.parse(tekst);
                    //       alert("RET ");
                    //       alert("RET: " + obj.Navn);
                    if (ii == "debet") {
                        //       alert("pass");
                        //         alert("debet " + obj.Navn);
                        document.getElementById("1info").value = obj.Navn;
                        document.getElementById("1infokto").value = obj.Ktonr;
                    } else if (ii == "kredit") {
                        //       alert("kredit " + obj.Navn);
                        document.getElementById("2info").value = obj.Navn;
                        document.getElementById("2infokto").value = obj.Ktonr;
                    }
                    /*     if (ii = "debet") {
                             document.getElementById("kredit").focus();
                         } else if (ii = "kredit") {
                             document.getElementById("belop").focus();
                         }
                         */
                }
                //return tekst;

            });
        };
        //  alert("ret: " + ii + " : " + i);
        if (ii == "art") {
            //     alert("focus kredit "+ii);
            document.getElementById("beskrivelse").focus();
        } else if (ii == "beskrivelse") {
            //    alert("focus "+ii);
            document.getElementById("dato").focus();
        } else if (ii == "dato") {
            //     alert("focus "+ii);
            document.getElementById("debet").focus();
        } else if (ii == "debet") {
            //     alert("focus "+ii);
            document.getElementById("kredit").focus();
        } else if (ii == "kredit") {
            //     alert("focus "+ii);
            document.getElementById("belop").focus();
        } else if (ii == "belop") {
            //     alert("focus "+ii);
            document.getElementById("tekst").focus();
        };


    }







    function nestekred(i) {
        //  alert("input " + i);
        var ii = i;
        return;
        var konto = document.getElementById("1kredit").value;

        //   alert("neste id: "+konto);
        //  alert("ret1: " + ii);
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "konto",
                konto: konto
            }),
            cache: false,
            success: function(tekst) {
                //      alert("ret: " + ii + " : " + tekst);
                const obj = JSON.parse(tekst);
                //    alert("pass: "+obj.Navn);
                document.getElementById("2info").value = obj.Navn;
                document.getElementById("2infokto").value = obj.Ktonr;

            }
            //return tekst;

        });
        //   alert("ret2: " + ii);
        document.getElementById("1belop").focus();



    }

    function hidden(i) {
        //  var myhidden = document.getElementById("5");
        // alert("hidden ");
        //  myhidden.value=boxHeight;
    }

    function UpdateRecord(vv) {

        console.log("updaterec art  " + vv);

        var art = document.getElementById("1art").value;
        var beskrivelse = document.getElementById("1beskrivelse").value;
        var dato = document.getElementById("1dato").value;
        var debet = document.getElementById("1debet").value;
        var kredit = document.getElementById("1kredit").value;
        var belop = document.getElementById("1belop").value;
        var tekst = document.getElementById("1tekst").value;
        //if (belop == 0) belop = (NULL);

        console.log("art :" + art + " beskrivelse :" + beskrivelse + " dato :" + dato + " debet :" + debet + " kredit :" + kredit + " belop :" + belop + " tekst :" + tekst);

        // if ((dato[2] == "-") && (dato[5] == "-")) {
        //     var dato = dato.substring(6, 10) + "-" + dato.substring(3, 5) + "-" + dato.substring(0, 2);
        // };

        jQuery.ajax({
            type: "POST",
            //    url: 'index.php?option=com_regn&task=abc.getData',
            url: 'index.php?option=com_regn&task=bilagsart.oppdater',
            data: ({
                art: art,
                beskrivelse: beskrivelse,
                dato: dato,
                debet: debet,
                kredit: kredit,
                belop: belop,
                tekst: tekst
            }),
            cache: false,
            success: function(tekst) {
                console.log(tekst);
                location.reload();
                // let obj=JSON.parse(tekst);
                // console.log(obj);
                //      alert("stopp");
            }
        });
        // location.reload();
        //  document.getElementById("Dato").focus();
        //  alert("ferdig");

    }
    //oppdater_base

    function oppdater_hist(id) {
        // alert("oppdat");
        jQuery.ajax({
            type: "GET",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "oppdater"
            }),
            cache: false,
            success: function(response) {
                //        alert("Record successfully updated  " + response);
            }
        });
        location.reload();
        document.getElementById("tekst").innerHTML = response;
        //   document.getElementById("Dato").focus();
        ///   alert("ferdig");

    }

    function test1(id) {
        jQuery.ajax({
            type: "GET",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({}),
            cache: false,
            success: function(response) {
                return (response)
            }
        });
        document.getElementById("tekst").innerHTML = response;


    }


    function test() {

        alert(test1());

    }


    function selectChar(uname, cname) {
        // alert("electChar");
        /*   var data = {
        username : uname,
        charname : cname
    };
  */
        jQuery.ajax({
            type: 'GET',
            //      url: "/components/com_regn/views/Registrering/tmpl/start.php",
            url: "/start.php",
            data: ({}), //datastring,
            cache: false,
            success: function(data) {
                // alert(data);
                //    return (response);
            }
            /*
                          var data_character = JSON.parse(result);
                        /*  var cnamediv = document.getElementById('belop');
                          cnamediv.innerHTML = "";
                          cnamediv.innerHTML = data_character[0].name;*/


        });

        // alert("selectChar ferdig: "); // +response);
    }
</script>