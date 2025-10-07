<?php
header('Content-Type: text/html; charset=utf8mb4');
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
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">



  //   console.log('start');

  //   function doAjax() {
  //     //100px console.log('doajax');
  //     return new Promise((resolve, reject)=> {
  //       $.ajax({
  //         type: "POST",
  //         url: "/components/com_regn/views/Registrering/tmpl/update.php",
  //         //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
  //         data: ({
  //           mode: "perioder_hent",
  //           kto: 4010,
  //           ar: 2015
  //         }),
  //         success: function (data) {
  //           resolve(data);
  //  //         console.log(data);
  //         },
  //         error: function (error) {
  //           reject(error)
  //         }
  //       })
  //     })
  //   }


  //   doAjax()
  //   .then((data)=>{
  //     console.log(data);
  //   })
  //   .catch((error)=>{
  //     console.log(error)
  //   })



  // const d = doAjax();
  // console.log('d ' + d);
  // alert(' ajax '+ d);


  //       success: function (tekst) {
  //    console.log('hent_perioder: ' + tekst);



















  function f_valg() {
    console.log("f_valg");
    var ar  = document.getElementById("ar").value;
    console.log('ar: ' + ar);
     document.getElementById('myForm').submit();
             //     location.reload();
       //         window.location.reload();  
        //        const currentUrl = window.location.href;
        //             console.log('url: ' + currentUrl );
 
        // let pos = currentUrl.indexOf("&regnskapsar");
        // if (pos == -1) {
        //              console.log('url: ' + currentUrl + "&regnskapsar=" + ar);
        //    location.replace(currentUrl + "&regnskapsar=" + ar)
        // } else {
        //              console.log(currentUrl.substring(0, pos));
        //     location.replace(currentUrl.substring(0, pos) + "&regnskapsar=" + ar)
        // }





           //        location.replace(currentUrl + "&arstall=" + ar)           
  }
</script>

<h1><?php echo $this->msg; ?></h1>

<?php

$db = JFactory::getDBO();
$query = $db->getQuery(true);
$query = 'SELECT * FROM  #__regn_hist order by ref desc limit 20';
// $query='SELECT * FROM  #__regn_hist where Regnskapsar="'.$ar.'" order by ref desc limit 20';
/*
$myObj = new stdClass();
$myObj->ar = $arstall;
$myObj->periode = $periodenavn;
$myObj->ant_post = $limit;
$myObj->sort = $sort;
$myJSON = json_encode($myObj);
*/


//if (isset ($_GET["ref"])){
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 // var_dump($_POST);

  // echo 'request<br>';
  //echo ' collect value of input field <br>';
  $arstall = $_REQUEST['arstall'];
  $periodenavn = $_REQUEST['periodenavn'];
  $limit = $_REQUEST['limit'];
  $sort = $_REQUEST['sort'];
  $retn = $_REQUEST['retn'];
  //echo  $arstall.' : '.$periodenavn.' : '.$limit.' : '.$sort.'<br>';
  if ($sort == 'ref')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by ref ' . $retn . ' limit ' . $limit;
  if ($sort == 'dato')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by Dato ' . $retn . ' limit ' . $limit;
  if ($sort == 'belop')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by belop ' . $retn . ' limit ' . $limit;
  if ($sort == 'bilag')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by Bilag ' . $retn . ' limit ' . $limit;
  //echo 'query: '.$query.'<br>';
  $myJSON = '{"ar":"' . $arstall . '","periode":"' . $periodenavn . '","ant_post":"' . $limit . '","sort":"' . $sort . '","retn":"' . $retn . '"}';
  $q = 'update #__regn_firma set konfig=\'' . $myJSON . '\'';
  //echo 'query1: '.$q.'<br>';
  $db->setQuery((string) $q);
  $mes = $db->loadObject();
} else {
  //echo 'konfigz<br>';
  $query = 'select * from #__regn_firma;';

  $db->setQuery((string) $query);
  // $message=  $db->loadObject();
  $message = json_encode($db->loadObject());


  //cho 'message: '.$message.'<br>';

  $obj3 = json_decode($message);
  if (($obj3->konfig) == '')
    $obj3->konfig = '{"ar":"2020","periode":"Mars","ant_post":"40","sort":"dato","retn":"desc"}';
  //echo ' res1: '.$obj3->konfig.'<br>';
  $obj4 = json_decode($obj3->konfig);

  //echo 'obj4: '.$obj4->ar.'<br>';
//echo 'res3: '.$obj4->ar.' : '.$obj4->periode.' : '.$obj4->ant_post.'<br>';
  $arstall = $obj4->ar;
  $periodenavn = $obj4->periode;
  // $periodenr = $obj4->periodenr;
  $limit = $obj4->ant_post;
  $sort = $obj4->sort;
  $retn = $obj4->retn;
  // echo  $arstall.' : '.$periodenavn.' : '.$limit.' : '.$sort.'<br>';
  if ($sort == 'ref')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by ref ' . $retn . ' limit ' . $limit;
  if ($sort == 'dato')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by Dato ' . $retn . ' limit ' . $limit;
  if ($sort == 'belop')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by belop ' . $retn . ' limit ' . $limit;
  if ($sort == 'bilag')
    $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by Bilag ' . $retn . ' limit ' . $limit;
  //echo 'query: '.$query.'<br>';
  if ($limit == '')
    $limit = 10;
  $query = 'SELECT * FROM  #__regn_hist where regnskapsar="' . $arstall . '" and Periode="' . $periodenavn . '" order by ref desc limit ' . $limit;
  //  echo $query;
  $db->setQuery((string) $query);
  $mes = $db->loadObject();
}
;

$db->setQuery((string) $query);
$messages = $db->loadObjectList();
$options = array();

//echo 'retnig '.$retn.'<br>';

?>

<form method="post" id="myForm" action="<?php echo $_SERVER['PHP_SELF']; ?>">

  År: <select id="ar" Name="arstall" Size="Number_of_options" onchange="f_valg()" value="<?php echo $arstall ?>">
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
    </select>
    Periode: <select id="periode" Name="periodenavn" Size="Number_of_options" onchange="f_valg()" >
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
    Antall: <input type="text" size="2" id="limit" Name="limit" onchange="f_valg()" value="<?php echo $limit ?>">

  Sortering: <select id="sort" Name="sort" Size="Number_of_options" onchange="f_valg()" value="<?php echo $sortering ?>"
    onchange="valg()">
    <option value="bilag"<?php if ($sort == "bilag")
      echo " selected" ?>> Bilagsnr </option>
    <option value="dato"<?php if ($sort == "dato")
      echo " selected" ?>> Dato </option>
    <option value="belop"<?php if ($sort == "belop")
      echo " selected" ?>> Beløp </option>
    <option value="ref"<?php if ($sort == "ref")
      echo " selected" ?>> Ref </option>
  </select>
  retn: <select id="retn" Name="retn" Size="Number_of_options" onchange="f_valg()" value="<?php echo $retn ?>">
    <option value=""<?php if ($retn == "stigende")
      echo " selected" ?>> Stigende </option>
    <option value="desc"<?php if ($retn == "desc")
      echo " selected" ?>> Fallende </option>
  </select>
  <!--input type="submit" value="Oppdater"-->
</form>

<br>
<table id="e" border="0" cellspacing="1" cellpadding="1">
  <?php if ($messages) {
    foreach ($messages as $message) {
      $date = date_create($message->Dato);
      ?>
      <tr>
        <td style="text-align:right; width:50px;"> <?php echo $message->ref ?></td>
        <td style="text-align:right; width:30px;"> <?php echo $message->Bilagsart ?> </td>
        <td style="text-align:right; width:50px;"> <?php echo $message->Bilag ?></td>
        <td style="text-align:right; width:100px;"> <?php echo date_format($date, "d:m:Y"); ?></td>
        <td style="text-align:right; width:50px;"> <?php echo $message->debet ?></td>
        <td style="text-align:right; width:50px;"> <?php echo $message->kredit ?></td>
        <td style="text-align:right; width:100px;"> <?php echo formatcurrency($message->belop, "NOK") ?></td>
        <td style=" width:300px; padding-left: 20px;"> <?php echo $message->Tekst ?></td>
        <!--td style=" width:400px; padding-left: 20px;"> < ?php echo $message->kontoinfo ?></td-->
        <td style=" width:500px; padding-left: 20px;"> <?php $t = $message->kontoinfo;
        echo substr($t, 0, 30) ?></td>

      </tr>
      <?php
    }
  }
  ?>
</table>