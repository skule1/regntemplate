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
//defined('_JEXEC') or die('Restricted access');
include 'fc.php';
?>

<h1>
    <?php 
    //echo $this->msg;
     ?>
</h1>


<?php    

$now = date_create()->format('Y-m-d');
echo $now.'<br>';

$id=0;
	$db    = JFactory::getDBO();
	$query = $db->getQuery(true);
	//$query->select('Dato,debet,kredit,belop');
	//$query->from('#__regn_trans');
    $query='select Buntnr from #__regn_hist order by Buntnr desc limit 1;';
	$db->setQuery((string) $query);
	$messages = $db->loadObjectList();
    $mes=$db->loadObject();
	$options  = array();
    $buntnr=intval($mes->Buntnr)+1;
    echo 'Buntnr: '.$buntnr .'<br>';
    $query='select Bilag from #__regn_hist order by Bilag desc limit 1;';
	$db->setQuery((string) $query);
	  $mes=$db->loadObject();
    $bilag=intval($mes->Bilag);
    $query='select Bilag from #__regn_trans order by Bilag desc limit 1;';
	$db->setQuery((string) $query);
	  $mes=$db->loadObject();
      echo 'mes: '.$mes.' : '.isset($mes).'<br>';
  /*    if (isset($mes)){
    $bilag1=intval($mes->Bilag);
    echo 'bilag: '.$bilag .' : '.$bilag1.'<br>';
      };
    //  else $bilag1='0';
   */ $query='select ref from #__regn_hist order by ref desc limit 1;';
	$db->setQuery((string) $query);
	  $mes=$db->loadObject();
    $ref=intval($mes->ref);
    $query='select Ref from #__regn_trans order by Ref desc limit 1;';
	$db->setQuery((string) $query);
	  $mes=$db->loadObject();
 /*     if (isset($mes))
    $ref1=intval($mes->Ref);
 //   else
 //   $ref1='0';

  */  if ((intval($ref))<(intval($ref1)))
    $ref=$ref1;
    if ((intval($bilag))<(intval($bilag1)))
    $bilag=$bilag1;

    echo 'Ref: '.$ref .' : '.$ref1.'<br>';
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
if(isset($_GET['Send'])){ //check if form was submitted
  $input = $_GET['1']; //get input text
echo "Success! You entered: ".$input.'<br>';
}   

//$link=databaseconnect();
$query = 'SELECT * FROM  #__regn_trans order by ref ';
$db->setQuery((string) $query);
$messages = $db->loadObjectList();


$msg='
<form action="" method="get" name="reg">
    <table id="e" border="0" cellspacing="1" cellpadding="1">
        <tr>
        <th scope="col" width="20"  height="48">
                Ref
            </th>
            <th scope="col" width="80"  height="48" class="text-center">
                Bilagnr
            </th>
            <th scope="col" width="120"  height="48" class="text-center">
            Dato
        </th>
        <th scope="col" width="50">
                Debet
            </th>
            <th scope="col" width="50">
                Kredit
            </th>
            <th class="text-center" scope="col" width="50">
                Beløp
            </th>
            <th   scope="col" width="200" >
                Tekst
            </th>
            <th scope="col">&nbsp;</th>
        </tr>';
  
        if ($messages)
		{
			foreach ($messages as $message)
			{
        //    echo "<td>" .$message->Dato . "</td>";
  /*
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
     */   $msg=$msg. '<tr>'
            .'<td>' . $message->Ref . "</td>"
            . '<td  style="text-align:right;"> ' .$message->bilag.  "</td>"
            . '<td  style="text-align:center;"> ' .datokonv( $message->Dato). "</td>"
            . '<td  style="text-align:right;"> ' .$message->debet .  "</td>"
            . '<td  style="text-align:right;"> '. $message->kredit. "</td>"
            . '<td  style="text-align:right;"> '. formatcurrency($message->kredit, "NOK") . "</td>"
            . '<td style="padding-left: 10px;" > '. $message->tekst . "</td>"
            . "</tr>";
        }
    }
    


echo $msg;
$msg=$msg.'</tr></table></form>';

//$boxsize=$_REQUEST["hiddencontainer"];
//echo $boxsize;
?>
<td align="right"><?php echo $ref?> </td>
<td align="right" style="padding-right: 10px;"><?php echo ' '.$bilag?> </td>
<td> <input type="text" align="left" name="Dato" id="Dato" style=" width:150px;" onchange="datokonv2('debet')" /> </td>
<td><input type="text" id="debet" style=" width:50px;" onchange="neste('kredit')"> </td>
<td><input type="text" id="kredit" style=" width:50px;" onchange="neste( 'belop')"> </td>
<td><input type="text" id="belop" class="no-outline" style=" width:100px;" onchange="neste( 'tekst')"> </td>
<td><input type="text" id="tekst"  style=" width:200px;" onchange="UpdateRecord(<?php echo ++$ref ?>,<?php echo ++$bilag ?>,)"> </td>
<td><input type="hidden" id="buntnr"  name="buntnr" value="<?php echo $buntnr?>" s /></td>
</tr>
<tr>
    <td>&nbsp</td>
</tr>
<tr>
    <td colspan="7" align="middle">
        <input type="button" onclick="slett()" value="Slett siste post"
            style=" width:120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" onclick="PrintDiv()" value="Utskrift" style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Endre" style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button"
            style=" width:100px;" value="Oppdater" onclick="oppdater_hist()">
    </td>
    <!--td colspan="5" align="right"><input < ?php if( $id==5) echo 'type="Submit"' ?> name="Send" id="ok" value="Submit" style="width:100px;"
                    onclick="this.disabled=0" ; />
            </td-->
</tr>
</table>
</form>

<?php
echo ' <div id="divToPrint" style="display:none;"> '.$msg.'</div>'; ?>
<script>
document.getElementById("Dato").focus();
</script>






<?php
function datokonv($inn){
  $ut=substr($inn,8,2).".".substr($inn,5,2).".".substr($inn,0,4);
  return $ut;
}
?>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
function datokonv2(dt) {
    let vv = document.getElementById('Dato').value;
    let text = vv;

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
        document.getElementById('Dato').value = y;
    }
    document.getElementById("debet").focus();
    //return y;
}


function slett() {
    //  alert("slett");
    jQuery.ajax({
        type: "GET",
        url: "/components/com_regn/views/Registrering/tmpl/update.php?kommando=slett",
        data: ({}),
        cache: false,
        success: function(response) {
            alert("Siste post ble slettet.");
        }
    });
    location.reload();
}

function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=900,height=750');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();
}



function neste3(t) {
    alert("aa " + t);
}

function neste(i) {
    //alert("aa "+i);
    if (i == 4) {
        // var hh= dokument.getElementById("3");
        // var jj=hh.value;
        //document.getElementById("3").style.color = "red";
        var oo = document.getElementById("3").value;
        alert("g1");
        alert("ggg " + oo);
        alert("g2");
    } else
        document.getElementById(i).focus();
    //   <?php $id?>=i;

}

function hidden(i) {
    //  var myhidden = document.getElementById("5");
    alert("hidden ");
    //  myhidden.value=boxHeight;
}

function UpdateRecord(ref,bilag) {
     alert(ref+" : "+bilag);
    var Dato = document.getElementById("Dato").value;
    var debet = document.getElementById("debet").value;
    var kredit = document.getElementById("kredit").value;
    var belop = document.getElementById("belop").value;
    var tekst = document.getElementById("tekst").value;
    var buntnr = document.getElementById("buntnr").value;
    var bilagsart="6";
    //   alert(Dato);
    if ((Dato[2] == "-") && (Dato[5] == "-")) {
        //alert("ggg "+Dato[2]+" : "+Dato[5]);
        var Dato = Dato.substring(6, 10) + "-" + Dato.substring(3, 5) + "-" + Dato.substring(0, 2);
        //alert(Dato);
    };
    jQuery.ajax({
        type: "POST",
        url: "/components/com_regn/views/Registrering/tmpl/update.php",
        data: ({
            Ref:ref,
            Bilagsart:bilagsart,
            bilag,bilag,
            Dato: Dato,
            debet: debet,
            kredit: kredit,
            belop: belop,
            tekst: tekst,
            buntnr: buntnr
        }),
        cache: false,
        success: function(tekst) {
            alert("Record successfully updated" + tekst);
        }
    });
    location.reload();
    //   document.getElementById("Dato").focus();
    ///   alert("ferdig");

}
//oppdater_base

function oppdater_hist(id) {
    alert("oppdat");
    jQuery.ajax({
        type: "GET",
        url: "/components/com_regn/views/Registrering/tmpl/update.php",
        data: ({
            mode: "oppdater"
        }),
        cache: false,
        success: function(response) {
            alert("Record successfully updated  " + response);
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
    alert("electChar");
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
            alert(data);
            //    return (response);
        }
        /*
                      var data_character = JSON.parse(result);
                    /*  var cnamediv = document.getElementById('belop');
                      cnamediv.innerHTML = "";
                      cnamediv.innerHTML = data_character[0].name;*/


    });

    alert("selectChar ferdig: "); // +response);
}
</script>