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
include 'fc.php';


?>
<h1><?php echo $this->msg; ?></h1>

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

}*/
</style>


<h1><?php echo $this->msg; ?></h1>



<?php
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
defined('_JEXEC') or die('Restricted access');
include 'fc.php';



$sql='SELECT * FROM  #_regn_kto WHERE Ktonr LIKE "4%"';
//echo $sql;
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


$dato='20-11-2023';
$i=strpos($dato,'-');
if ($i==1)   $dato="0".$dato;
$i=strpos($dato,'-');
$j=strpos($dato,'-',++$i);
if ($j==4) $dato=substr($dato,0,--$j).'0'.substr($dato,$j);
//echo 'dato: '.$dato.'<br>';











$now = date_create()->format('Y-m-d');
//echo $now.'<br>';
$month = date("m",strtotime($now));
switch ($month) {
    case 1: $manded='Januar';break;
    case 2: $manded='Februar';break;
    case 3: $manded='Mars';break;
    case 4: $manded='April';break;
    case 5: $manded='Mai';break;
    case 6: $manded='Juni';break;
    case 7: $manded='Juli';break;
    case 8: $manded='August';break;
    case 9: $manded='September';break;
    case 10: $manded='Oktober';break;
    case 11: $manded='November';break;
    case 12: $manded='Desember';break;
}
//echo 'måned: '.$month.' : '.$manded.'<br>';
//echo 'function måned: '.FManed($now).'<br>';
$id=0;
	$db    = JFactory::getDBO();
	$query = $db->getQuery(true);
$query='select * from #__regn_firma;';
$db->setQuery((string) $query);
$mes=$db->loadObject();
$regnskapsar=$mes->regnskapsar;
//echo 'Regnskapsår: '.$regnskapsar.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp';
?>
<!--form action="" method="get"><table width="500" border="1" cellspacing="10" cellpadding="2">
  <tr>
    <td> Skriv regnskapsår: <input type="text" name="ar" id="ar" /><input name="" type="submit" value="Oppdater" /></td>
  </tr>
</table>
</form-->

<?php
// prmk2_regn_kto






$query='select * from #__regn_regnskapsar order by regnskapsar desc;';
$db->setQuery((string) $query);
$mes=$db->loadColumn() ;
//echo $mes[2];
$nr=0;
$ant=$db->getCount();
//echo 'ant '.$ant.'<br>';


?>

<?php 




if (isset($_GET['valgt_ar'])){
//echo 'aa '.$_GET['valgt_ar'].'<br>'; 
$valgt=$_GET['valgt_ar'];

$query='update #__regn_firma set regnskapsar='.$valgt.';';
$db->setQuery((string) $query);
//echo 'oppdatert '.$query.'<br>';
$http_response_header=$db->loadObject();
}
else
 $valgt=$regnskapsar;
$i=0;
$v=0;

while ($i <= $ant):
if ($mes[$i++]==$valgt)
   $v=$i-1;
endwhile;

?>




























<!--div class="container mt-5"-->
 <form action="" method="GET" >
 Regnskapsår:
<select name="valgt_ar">
    <?php
while ($nr<count($mes)):
{
//echo $mes[$nr++].'<br>';
if ($mes[$nr]==$regnskapsar) 
echo '<option value='.$mes[$nr].' selected>'.$mes[$nr++].'</option>';
else
echo '<option value='.$mes[$nr].'>'.$mes[$nr++].'</option>';
}
endwhile;
?>

</select>
    <input type="submit" name="submit" value="Oppdater">
</form>

<?php /*
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







	$query = 'select * from #__regn_kto where Ktonr=4010';
    $db->setQuery((string) $query);
//$messages = $db->loadObjectList();
$mes=$db->loadObject();
/*
if (!is_null($mes))
    echo 'finnes<br>';
else
    echo 'IKKE <br>';*/
//echo 'mes ' . $mes. '<br>';
	//$result=mysqli_query($conn, $sql);
	//$db->setQuery((string) $query);
	// $mes=$db->loadRow();
 //   echo 'kto: ' . $mes->Ktonr . '<br>';
  //   echo 'kto: ' . $mes->Navn . '<br>';

	//$query->select('Dato,debet,kredit,belop');
	//$query->from('#__regn_trans');
    $query='select Buntnr from #__regn_hist order by Buntnr desc limit 1;';
	//$query = 'select * from #_regn_kto;';
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
 //     echo 'mes: '.$mes.' : '.isset($mes).'<br>';
   if (isset($mes)){
    $bilag1=intval($mes->Bilag);
   // echo 'bilag: '.$bilag .' : '.$bilag1.'<br>';
      }
     else $bilag1='0';
  $query='select ref from #__regn_hist order by ref desc limit 1;';
	$db->setQuery((string) $query);
	  $mes=$db->loadObject();
    $ref=intval($mes->ref);
    $query='select Ref from #__regn_trans order by Ref desc limit 1;';
	$db->setQuery((string) $query);
	  $mes=$db->loadObject();
     if (isset($mes))
    $ref1=intval($mes->Ref);
    else
   $ref1='0';

   if ((intval($ref))<(intval($ref1)))
    $ref=$ref1;
    if ((intval($bilag))<(intval($bilag1)))
    $bilag=$bilag1;

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
            <th scope="col" width="15"  height="48" class="text-center">
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
            .'<td>' . $message->Ref. "</td>"
            . '<td  style="text-align:right;"> ' .$message->bilag.  "</td>"
            . '<td  style="text-align:right;"> ' .$message->Bilagsart.  "</td>"
            . '<td  style="text-align:center;"> ' .datokonv( $message->Dato). "</td>"
            . '<td  style="text-align:right;"> ' .$message->debet .  "</td>"
            . '<td  style="text-align:right;"> '. $message->kredit. "</td>"
            . '<td  style="text-align:right;"> '. formatcurrency($message->belop, "NOK") . "</td>"
            . '<td style="padding-left: 10px;" > '. $message->tekst . "</td>"
            . "</tr>";
        }
    }



echo $msg;
$msg=$msg.'</tr></table></form>';
// onkeydown="finn_kto"
//$boxsize=$_REQUEST["hiddencontainer"];
//echo $boxsize;
?>
<td align="right"><?php echo ($ref+1)?> </td>
<td align="right" style="padding-right: 10px;"><?php echo ' '.($bilag+1)?> </td>
<td><input type="text" id=1 style=" width:30px;" onkeydown="fart()"> </td>
<td> <input type="text" align="left" name="Dato" id=2 style=" width:100px;" onchange="datokonv2(3,<?php echo $regnskapsar ?>)" /> </td>
<td><input type="text" id=3 style=" width:50px;" onchange="neste(3)" onkeydown="finn_kto()"> </td>
<td><input type="text" id=4 style=" width:50px;" onchange="neste( 4)"> </td>
<td><input type="text" id=5 class="no-outline" style=" width:100px;" onchange="neste( 5)"> </td>
<td><input type="text" id=6 style=" width:200px;"
        onkeydown="UpdateRecord(<?php echo ++$ref ?>,<?php echo ++$bilag ?>,<?php echo $buntnr ?>)"> </td>
<td><input type="hidden" id="buntnr" name="buntnr" value="<?php echo $buntnr?>" s /></td>
</tr>
<tr>
    <td>&nbsp</td>
</tr>
<tr>
    <td colspan="9" align="middle">
        <input type="button" onclick="slett()" value="Slett siste post" id="jsonobj"
            style=" width:120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" onclick="PrintDiv()" value="Utskrift" style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" value="Endre" onclick="console.log(ff)"
            style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="button" style=" width:100px;" value="Oppdater" onclick="oppdater_hist()">
    </td>
    <!--td colspan="5" align="right"><input < ?php if( $id==5) echo 'type="Submit"' ?> name="Send" id="ok" value="Submit" style="width:100px;"
                    onclick="this.disabled=0" ; />
            </td-->
</tr>
<tr height="20px"></tr>
<tr border="1">
    <td colspan="5">
        <input type="text" id="1infokto" style="text-align:right; border-width:0px; width:50px;">
        <input type="text" id="1info" style="text-align:left; border-width:0px; width:200px;">
    </td>
    <td colspan="5">

        <input type="text" id="2infokto" style="text-align:right; border-width:0px; width:50px;">
        <input type="text" id="2info" style="text-align:left; border-width:0px; width:200px;">
    </td>
</tr border="1">
<tr>
    <td colspan="5">
        <p id="p1"></p>
    </td>
    <td colspan="5">
        <p id="p20"></p>
    </td>
</tr>
</table>
</form>

<?php
echo ' <div id="divToPrint" style="display:none;"> '.$msg.'</div>'; ?>






<?php



function datokonv($inn){
  $ut=substr($inn,8,2).".".substr($inn,5,2).".".substr($inn,0,4);
  
  return $ut;
 // document.getElementById("debet").focus();
}



function FManed( $now1)
{
	$month = date("m",strtotime($now1));
switch ($month) {
    case 1: $manded='Januar';break;
    case 2: $manded='Februar';break;
    case 3: $manded='Mars';break;
    case 4: $manded='April';break;
    case 5: $manded='Mai';break;
    case 6: $manded='Juni';break;
    case 7: $manded='Juli';break;
    case 8: $manded='August';break;
    case 9: $manded='September';break;
    case 10: $manded='Oktober';break;
    case 11: $manded='November';break;
    case 12: $manded='Desember';break;
};
return $manded;
}



?>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
//var WshShell = new ActiveXObject("WScript.Shell");
//var value = WshShell.RegRead("HKEY_CURRENT_USER\\SOFTWARE\\Skule Sormo\\regnIV\\regnskapsar");

//alert("regnskapsar " + value);


document.getElementById(1).focus();
//  document.getElementById("p1").innerHTML = "New text!";

//    const element = document.getElementById("jsonobj");
//  element.innerHTML = "The New JavaScript Heading";

function tt() {
    console.log("tt");
    console.log(event.key);
}

function UpdateRecord(ref, bilagsnr, buntnr) {
    console.log("updateRecord " + ref + " :");
    console.log(event.key);

    var art = document.getElementById(1).value;
    var dato = document.getElementById(2).value;
    var debet = document.getElementById(3).value;
    var kredit = document.getElementById(4).value;
    var belop = document.getElementById(5).value;
    var tekst = document.getElementById(6).value;

    if ((dato[2] == "-") && (dato[5] == "-")) {
        //     alert("ggg " + dato[2] + " : " + dato[5]);
        var dato = dato.substring(6, 10) + "-" + dato.substring(3, 5) + "-" + dato.substring(0, 2);
    };
    // alert("før oppdatering " + dato);
    if (event.key == 'Enter') {
        console.log("prossess..");

        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "oppdater",
                ref: ref,
                bilagsnr: bilagsnr,
                buntnr: buntnr,
                art: art,
                dato: dato,
                debet: debet,
                kredit: kredit,
                belop: belop,
                tekst: tekst
            }),
            cache: false,
            success: function(tekst) {
                console.log("Record successfully updated " + tekst);
              //  location.reload();
              var  obj2 = JSON.parse(tekst);
              console.log(obj2);
              console.log(tekst);

                // alert("Record successfully updated" + tekst);
            }
        });
         location.reload();

    }

    // document.getElementById(1).focus();
    //   alert("ferdig");

}


/*
function displayCommits() {
    console.log("Start displayCommits..");
            try {
                const fart = await fart();
                console.log(fart);
            } catch (err) {
                console.log('Error', err.message);
            }
            console.log("End displayCommits..");
        }

        displayCommits();

obj1={};

*/
function oppdater_hist() {
    //   alert('oppdater hist');
    var art = document.getElementById("art").value;
    console.log('art: ' + art);


}


function finn_kto()
{
    var kto=document.getElementById(3).value;
  if  (event.key != 'Enter')
kto=kto+  event.key;
    jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "ktosok",
              ktosok:kto
            }),
            cache: false,
            success: function(tekst) {
                console.log(tekst);
              //  var  obj2 = JSON.parse(tekst);
              //  console.log(obj2);

           //     location.reload();
/*
    $query='SELECT * FROM #_regn_kto WHERE Ktonr LIKE '+302%';
    $db->setQuery((string) $query);
    $mes=$db->loadObject();*/
}

})
}



function neste(gg) {
    console.log('lart ' + gg);
    gg_bk = gg;
    if ((gg == 4) || (gg == 3)) {
        console.log("gg1: " + gg);

        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "konto",
                konto: document.getElementById(gg).value
            }),
            cache: false,
            error:  console.log("errorr"),
            success: function(tekst) {
                console.log(tekst);  
              if (tekst!="ukjent") {
                  var  obj2 = JSON.parse(tekst);
                console.log(obj2);
                 console.log("gg_bk: " + gg_bk+" |"+ obj2.Ktonr+"|");
                }
                if (gg_bk == 3) {
                    document.getElementById("1infokto").value = 'Debet: ' + document.getElementById(3).value
                    if (tekst == "ukjent") {
                        document.getElementById("1info").value =  document.getElementById(3).value+' finnes ikke'
                        document.getElementById("p1").innerHTML = "";
                    } else {
                        document.getElementById("1info").value = obj2.Navn;
                        document.getElementById("p1").innerHTML = "Budsjett<br>Resultat";
                    }
                } else {
                    document.getElementById("2infokto").value = 'Kredit: ' + document.getElementById(4).value
                    if (tekst == "ukjent") {
                        document.getElementById("2info").value =  document.getElementById(4).value+' finnes ikke'
                        document.getElementById("p20").innerHTML = "";
                    } else {
                        document.getElementById("2info").value = obj2.Navn;
                        document.getElementById("p20").innerHTML = "Tilgjengelig<br>Resultat";
                    }
                }
    
                //   console.log('kto: '+)
            }
        })
    }

    gg = gg + 1;
    console.log(document.getElementById(gg).value ? true : false);

    while ((document.getElementById(gg).value ? true : false) && (gg < 6)) {
        gg = gg + 1;
        console.log(document.getElementById(gg).value);
    }
    document.getElementById(gg).focus();
    console.log("neste: " + gg);

}





function datokonv2(dt,regnskapar) {
    console.log("datakonv2: " + dt);
    let vv = document.getElementById(2).value;
    var i=0;
    var r=0;
    while (i<vv.length)
    {
        if (vv[i++]==',') r++;
    }
    console.log(" vv " + vv+" : "+vv.length+" : "+r);
    let text = vv;
    console.log(" text " + text);
    console.log('komma: '+vv.indexOf(",",2)) ;
    //alert("dato " + dt);
    if ((vv.indexOf(",") != -1) || (vv.indexOf(".") != -1)) {
        if (vv.indexOf(",") != -1) {
            var result = text.indexOf(",");
            var dag = vv.substring(0, result);
            console.log('min '+dag);
            if ((dag > 24) || (dag < 0)) alert("feil dag " + dag);
            var result1 = text.indexOf(",", result);
        } else {
            var result = text.indexOf(".");
            var dag = vv.substring(0, result);
            if ((dag > 24) || (dag < 0)) alert("feil dag " + dag);
            var result1 = text.indexOf(".", result );
        };
     var maned = vv.substring(result+1);
        console.log('dag: '+dag);
        console.log('maned: '+maned);

       // if ((time > 24) || (time < 0)) alert("feil time " + time);
        var ar = vv.substring(result1 + 1);
        console.log('ar: '+ar);
        if (r<2)         arstr=regnskapar;
        else
        {
        var arstr = "19" + ar.toString();
        if (ar < 24) arstr = "20" + ar.toString();
        else arstr = "19" + ar.toString();
        }
   //     var y = arstr + "-" + maned.toString() + "-" + dag.toString();
        var y = dag.toString() + "-" + maned.toString()+"-" +arstr;
        console.log('resultat: '+y);
        document.getElementById(2).value = y;
    }
    /*
    // alert("dato1 " + y);
    console.log("!"+document.getElementById(3).value+"!");
    if (document.getElementById(3).value=="")
    document.getElementById(3).focus();
     else
     document.getElementById(4).focus();
    */
    var gg = 3;

    console.log(document.getElementById(gg).value ? true : false);

    while ((document.getElementById(gg).value ? true : false) && (gg < 6)) {
        gg = gg + 1;
        console.log(document.getElementById(gg).value);
    }
    document.getElementById(gg).focus();
    console.log("neste: " + gg);




    //return y;
}





async function fart() {
    console.log("fart1");

    //   let fart2 = new Promise((resolve, reject) => {                    }
    const lart = document.getElementById(1).value;
    console.log('lart ' + lart);
    if (event.key == 'Enter') {
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "artcheck",
                art: lart
            }),
            cache: false,
            success: function(tekst) {
                console.log('tekst: ' + tekst);
                const obj1 = JSON.parse(tekst);
                //   console.log('art: ' + obj1.art);
                if (obj1.belop == 0) obj1.belop = '';
                //   console.log('belop ' + document.getElementById(5).value);
                if (obj1.art == 0) {
                    document.getElementById(2).value = ""; // debet=3
                    document.getElementById(3).value = ""; // debet=3
                    document.getElementById(4).value = "";
                    document.getElementById(5).value = "";
                    document.getElementById(6).value = "";
                } else {
                    document.getElementById(2).value = obj1.dato;
                    document.getElementById(3).value = obj1.debet;
                    document.getElementById(4).value = obj1.kredit;
                    document.getElementById(5).value = obj1.belop;
                    document.getElementById(6).value = obj1.tekst;
                    /*  document.getElementById("1infokto").value= obj1.debet;
                document.getElementById("2infokto").value= obj1.kredit;
                document.getElementById("p1").innerHTML="Budsjett<br>Resultat";
                document.getElementById("p20").innerHTML="Tilgjengelig<br>Resultat";
*/



                    jQuery.ajax({
                        type: "POST",
                        url: "/components/com_regn/views/Registrering/tmpl/update.php",
                        data: ({
                            mode: "konto",
                            konto: obj1.debet
                        }),
                        cache: false,
                        success: function(tekst) {
                            console.log(tekst);
                            const obj2 = JSON.parse(tekst);
                            document.getElementById("1infokto").value = obj2.Ktonr;
                            document.getElementById("1info").value = obj2.Navn;
                            document.getElementById("p1").innerHTML =
                                "Budsjett<br>Resultat";
                        }
                    });
                    jQuery.ajax({
                        type: "POST",
                        url: "/components/com_regn/views/Registrering/tmpl/update.php",
                        data: ({
                            mode: "konto",
                            konto: obj1.kredit
                        }),
                        cache: false,
                        success: function(tekst) {
                            console.log(tekst);
                            const obj2 = JSON.parse(tekst);
                            document.getElementById("2infokto").value = obj2.Ktonr;
                            document.getElementById("2info").value = obj2.Navn;
                            document.getElementById("p20").innerHTML =
                                "Tilgjengelig<br>Resultat";
                        }
                    });





                }
                if (document.getElementById(2).value == "0000-00-00 00:00:00") document.getElementById(
                    2).value = '';
                console.log('dato obj1: ' + obj1.dato);
            }
        });




        console.log('fart: ' + document.getElementById(2).value + ' gg ' + (document.getElementById(2).value ?
            true : false));

        if (!(document.getElementById(2).value ? true : false)) document.getElementById(2).value = '';


        var gg = 2;
        while ((document.getElementById(gg).value ? true : false) && (gg < 6)) {
            gg = gg + 1;
            console.log(document.getElementById(gg).value);
        }
        document.getElementById(gg).focus();
    } else {
        console.log("sart: " + event.key);
        var art = document.getElementById(1).value;
        art = art + event.key;
        if (event.key != 'Backspace')
            console.log("sart: " + art);
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "sart",
                art: art
            }),
            cache: false,
            success: function(tekst) {
                console.log(tekst);
                const obbj5 = JSON.parse(tekst);
                document.getElementById("1info").value = 'Artbeskrivelse: ' + obbj5.beskrivelse;

            }
        });

    }
}




/*
var promise1 = new Promise(function(resolve, reject) {
    resolve('foo');
});
let myval="a";
promise1.then(function(value) {
 myval=value;
  console.log(value); // this logs "foo"
});

setTimeout(() => console.log(myval), 0); // logs "foo"




*/
</script>