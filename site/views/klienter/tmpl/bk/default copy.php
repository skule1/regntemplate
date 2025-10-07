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


    $db    = JFactory::getDBO();
	$query = $db->getQuery(true);
	$query1='select * from #__trans_firmadata';
	$db->setQuery((string) $query1);
	$messages = $db->loadObjectList();
	$options  = array();
    if ($messages) {
        foreach ($messages as $message) {        
            $firmanavn = $message->firmanavn;
            $fepost = $message->fepost;
            $adresse=$message->adresse;
            echo $firmanavn.'<br>'.$fepost.'<br>'.$adresse.'<br>';
        }
    }
?>


<script type="text/javascript">
function PrintDiv() {
    var divToPrint = document.getElementById('divToPrint');
    var popupWin = window.open('', '_blank', 'width=900,height=750');
    popupWin.document.open();
    popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
    popupWin.document.close();

}
</script>




<?php




// ************* Skjema ****************

function skjema()
{


//$conn=databaseconnect();


// ********************* oppdaterer kunderegister fra joomla: ***********************
/*
$sql='select * from hiy9j_users; ';
$result2 = mysqli_query($conn, $sql);
//echo 'no: '.mysqli_num_rows($result).'<br>';
while($row2 = mysqli_fetch_assoc($result2))
{

// echo 'variable '.$row["id"].'<br>';
$sql='select * from hiy9j_fields_values where item_id="'.$row2["id"].';';
$result3 = mysqli_query($conn, $sql);
$row1 = mysqli_fetch_assoc($result3);

$id=$row2["id"];
$navn=$row2["name"];
$sql='select * from hiy9j_fields_values where hiy9j_fields_values.item_id='.$id.' and hiy9j_fields_values.field_id=1;';
$result3=mysqli_query($conn,$sql);
$row3 = mysqli_fetch_assoc($result3);
$adresse=$row3["value"];

$sql='select * from hiy9j_users where id='.$id.';';
$result3=mysqli_query($conn,$sql);
$row3 = mysqli_fetch_assoc($result3);
$epost=$row3["email"];
//echo 'sql: '.$sql.'<br>';

$sql='select * from hiy9j_fields_values where hiy9j_fields_values.item_id='.$id.' and hiy9j_fields_values.field_id=3;';
$result3=mysqli_query($conn,$sql);
$row3 = mysqli_fetch_assoc($result3);
$telefon=$row3["value"];

$sql='select * from hiy9j_fields_values where hiy9j_fields_values.item_id='.$id.' and hiy9j_fields_values.field_id=4;';
$result3=mysqli_query($conn,$sql);
$row3 = mysqli_fetch_assoc($result3);
$refperson=$row3["value"];

$sql='select * from hiy9j_fields_values where hiy9j_fields_values.item_id='.$id.' and hiy9j_fields_values.field_id=5;';
$result3=mysqli_query($conn,$sql);
$row3 = mysqli_fetch_assoc($result3);
$postnr=$row3["value"];
*/

/*

$sql='select * from kunder where id='.$id.';';
//echo 'sql: '.$sql.'<br>';
$result=mysqli_query($conn,$sql);
//echo 'antall: '.mysqli_num_rows($result).'<br>';
if (mysqli_num_rows($result) == 0)
{
// echo 'variable '.$row["id"].'<br>';

//echo 'oppretter kunde <br>';
$sql='select * from kunder order by id desc limit 1;';
$result=mysqli_query($conn,$sql);
$row1 = mysqli_fetch_assoc($result);

// $id=$row1["id"]+1;
// echo 'ny id: '.$id1,'<br>';
$sql='insert into kunder (id,kundenavn,adresse,epost,telefon,refperson,postnr) values ("'.$id.'","'.$navn.'","'.$adresse.'","'.$epost.'","'.$telefon.'","'.$refperson.'","'.$postnr.'");';
//echo 'sql: '.$sql.'<br>';
//$result=mysqli_query($conn,$sql);
}
else
{
//echo 'oppdaterer kunder..<br>';
$sql='update kunder set kundenavn="'.$row2["name"].'", adresse="'.$adresse.'", epost="'.$epost.'", telefon="'.$telefon.'", refperson="'.$refperson.'", postnr="'.$postnr.'" where kunder.id='.$id.';';
//$result3=mysqli_query($conn,$sql);
//echo 'sql: '.$sql.'<br>';
}

//**********************************


/*

$sql='select * from kunder where id='.$id.';';
$result3=mysqli_query($conn,$sql);
$row1=mysqli_fetch_assoc($result3);

$user = JFactory::getUser();
$username=$user->username;
$userid=$user->id;
$email=$user->email;
$adresse=$user->adresse;

$varebeskrivelse=$_GET["Varebeskrivelse"];

/*
echo "user: ".$user."<br>";
echo "username: ".$username."<br>";
echo "userid: ".$userid."<br>";
echo "mail: ".$email."<br>";
echo "adresse: ".$adresse."<br>";
* /
$sql='select * from kunder where id='.$userid;
$result=mysqli_query($conn,$sql);
$row1 = mysqli_fetch_assoc($result);

//echo 'sql: '.$sql.'<br>';

*/
$userid=0;
echo '<br> <form action="http://omerservice.no/index.php/vare-tjenester/transport" method="get">
<table width="640" border="0" cellspacing="2" cellpadding="2">
<tr><td width="110"></td><td><h1>Transportforespørsel</h1></td></tr>
<tr><td height=15></td></tr>
<tr >

<td width="60"; align="right">Navn:<input name="id1" type="hidden" size="56" value="'.$userid.'" /></td>
<td colspan="3">';

//echo 'userid '.$userid.'<br>';

if ($userid==0) echo '<a href="http://omerservice.no/index.php/logg-inn?view=registration"> Registrer deg først</a> ... <a href="http://omerservice.no/index.php/logg-inn">eller logg deg inn dersom du allerede er registert </a>';
else echo '<input name="navn" type="text" size="56" value="'.$message->kundenavn.'" style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:500px; text-align:left;">';
echo '
</td>
</tr>
<tr>
<td width="113"; align="right">Adresse:</td>
<td colspan="3"><input name="adresse" type="text" size="56" value="'.$message->adresse.'"style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:500px; text-align:left;" /></td> <td></td>
</tr>
<tr>
<td width="113"; align="right">Telefon:</td>
<td colspan="3" width="140"><input width="100" type="text" name="telefon" id="telefon" value="'.$message->telefon.'"style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:100px; text-align:left;" />
E-post:
<input type="email" name="email" id="telefon" value="'.$message->adresseepost.'" placeholder="sophie@example.com" style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:350px; text-align:left;"/></td> <td></td>
</tr>
<tr>
<td width="113"; align="right">Varebeskrivelse:</td>
<td colspan="3"><input name="Varebeskrivelse" type="text" size="56" value="'.$message->varebeskrivelse.'" style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:500px; text-align:left;"/></td> <td></td>
</tr>
<tr>
<td width="113"; align="right">Henteadresse:</td>
<td colspan="3"><input name="henteadresse" type="text" size="56" value="'.$message->Henteadresse.'" style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:500px; text-align:left;"/></td>
</tr>
<tr>
<td width="113"; align="right">Leveringsadresse:</td>
<td colspan="3"><input name="leveringsadresse" type="text" size="56" value="'.$message->Leveringsadresse.'"style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:500px; text-align:left;" /></td> <td></td>
</tr> <tr>
<td width="113"; align="right">Kommentar:</td>
<td colspan="3"><textarea name="kommentar" rows="2" cols="56" style="text-indent: 5px; background-color:white; border: solid 1px #6E6E6E; font-size:10pt;height:10px;width:500px; text-align:left;"></textarea>
<td></td>
</tr> <tr style="height:15px;">
<td></td>
<td ></td></tr><tr><td></td>
<td align="right"><input name="send" type="submit" value="Send inn og be om tilbud"'; if ($userid==0) echo 'onclick="this.disabled = true"'; echo ' /></td>
</tr>

</table>
</form><br><a style="color: #000000; text-decoration: underline;" href="mailto:omer.service.as@gmail.com?subject=Transportforespørsel&amp;body=Ta gjerne kontakt med spørsmål om pris på transportoppdrag:%0A%0ANavn:%0A%0ATransport fra: %0A%0A Transport til:%0A%0A Gjenstander:%0A%0A Kommentarer:">ta også gjerne kontakt på epost</a>';
/*
$map='https://maps.googleapis.com/maps/api/distancematrix/json?origins='.$Henteadresse.'&destinations='.$Leveringsadresse.'&key=AIzaSyDZMBOsGMICC-8ZrzPb4lzw6uR4K7WBjlY';
echo $map;

echo '<br> <form action="'.$map.' method="get">
<table width="800" border="0" cellspacing="0" cellpadding="5">
<tr><td><input name="map" type="submit" value="Map" action="'.$map.'"></td></tr></table></form>';
*/

}
//**************** ferdig skjema *****************

//echo 'get metode:'.$_GET['metode'].'<br>';
//echo 'get email: !'.$_GET['email'].'!<br>';
/*
//if (isset($_GET['metode']))
//{
if ($_GET['metode']=="Lenke tilbud")
{ if ($_GET["email"]!="")aksept($_GET["ref"]);
else tilbud_sms();
}
elseif ($_GET['metode']=="Lenke ordre") aksept($_GET["ref"]);
elseif ($_GET['metode']=="aksept") aksept($_GET["ref"]);
elseif ($_GET['metode']=="Aksept") aksept($_GET["ref"]);
elseif ($_GET['metode']=="Lenke ordre") aksept($_GET["ref"]);

if (isset($_GET['send'])) foresporsel();
if ((!isset($_GET['metode'])) and (!isset($_GET['send'])))
*/ skjema();

//http://omerservice.no/index.php/vare-tjenester/transport?&metode=sms&tema=tilbud&ref='.$rf;



?>