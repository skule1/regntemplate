<!-- <table id='my-table-id'>
  <tr>
    <td>aaaaaaaaaaaaa</td>
  <tr>
    <td>bbbbbbbbbbbbbb</td>
  </tr>
</table> -->

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

/*
loadResult() : single value from one resourcebundle_get_error_code
loadRow() : Single record use index id   (returns an indexed array from a single record in the table:)
loadAssoc() : Single record  use fieldname      (returns an associated array from a single record in the table:)
loadObject() : php object (loadObject returns a PHP object from a single record in the table:)
loadColumn() : all records from a singel coloumn (returns an indexed array from a single column in the table:)
loadColumn($index)  : all records from multiple records (returns an indexed array from a single column in the table:)
loadRowList() :     (returns an indexed array of indexed arrays from the table records returned by the query:)
loadAssocList()  :  (returns an indexed array of associated arrays from the table records returned by the query:)
loadAssocList($key) :  (returns an associated array - indexed on 'key' - of associated arrays from the table records returned by the query:)
loadAssocList($key, $column) :  ( returns an associative array, indexed on 'key', of values from the column named 'column' returned by the query:)
loadObjectList()  :  (returns an indexed array of PHP objects from the table records returned by the query:)
loadObjectList($key) :  (returns an associated array - indexed on 'key' - of objects from the table records returned by the query:)
https://docs.joomla.org/Special:MyLanguage/Selecting_data_using_JDatabase 
*/

?>
<h1>
  <?php echo $this->msg; ?>
</h1>

<?php
$user = JFactory::getUser();
$username = $user->username;
if ($username) 
  echo '<h5>Klient: ' . $user->name . '<br></h5>';
?>


<?php

use Joomla\CMS\Factory;

$session = Factory::getSession();
//include 'fc.php';
$value = $session->get('klient');

include 'bevegelser.php';
include 'sok.php';
include 'saldoliste.php';
include 'kontoliste.php';
include 'style.css';


//include 'import.php';

/*
$arr = array('a' => 1, 'b' => 2, 'c' => 3, 'd' => 4, 'e' => 5);
$json = '{"a":1,"b":2,"c":3,"d":4,"e":5}';
echo json_encode($arr).'<br>';
var_dump(json_decode($json));
*/





?>
<!-- <p id="result"></p> -->
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'bevegelser')">Bevegelser</button>
  <button class="tablinks" onclick="openCity(event, 'sok')">Søk</button>
  <button class="tablinks" onclick="openCity(event, 'Kontoliste')">Rapportlinjer</button>
  <button class="tablinks" onclick="openCity(event, 'Kontoinfo')">Kontoinfo</button>
  <button class="tablinks" onclick="openCity(event, 'Saldoliste')">Saldoliste</button>
  <button class="tablinks" onclick="openCity(event, 'Sporring')">Kunder</button>
  <button class="tablinks" onclick="openCity(event, 'Rapporter')">Leverandører</button>
  <!-- <button class="tablinks" onclick="openCity(event, 'import1')">Import/eksport</button> -->
</div>


<?php

/*
echo $_SERVER['REQUEST_URI'];
if (isset($_GET["mode"]))
if ($_GET["mode"])
echo "<script>window.location = 'http://localhost/index.php/k1?view=Konto'</script>";
*/

//if(isset($_GET['mode'])) {
//$vv=$_GET['a'];
//echo 'a: '.$vv.'<br>';   
//  openCity(event, 'Konto');          
//Kontoliste($_GET['mode']);
//};

?>


<div id="Kontoliste" class="tabcontent">
  <h3>Kontoliste</h3>
  <?php
  kontoliste5("ikke valgt")
    ?>
</div>



<div id="sok" class="tabcontent">
  <h3>Søk</h3>
  <?php
  Sok()
    ?>
</div>

<div id="Kontoinfo" class="tabcontent">
  <h3>Kontoinfo</h3>
  <?php
  Kontoinfo()
    ?>
</div>

<div id="Saldoliste" class="tabcontent">
  <h3>Saldoliste</h3>
  <?php
  saldoliste('2015');
  // echo 'Saldoliste()'; 
  ?>
</div>

<div id="Sporring" class="tabcontent">
  <h3>Spørrring</h3>
  <p>Tokyo is the capital of Japan.</p>
</div>


<div id="bevegelser" class="tabcontent">
  <h3>Bevegelser </h3>
  <?php
  bevegelser()
    ?>
</div>
<!-- 
<div id="import1" class="tabcontent">
  <h3>Import</h3>
   <?php
   // import1()
   ?>
</div> -->

<div id="rr"></div>




<?php


// $db = JFactory::getDBO();
// $conf = new JConfig();
// $database = $conf->db;
// $hash = $conf->dbprefix;
// $mode = 'R';
// $regnskapsar = "2010";


// $sql = 'select * from qo7sn_regn_hist order by buntnr desc limit 1;';
// $db->setQuery((string) $sql);
// $messages = $db->loadObject();
// // if ($messages) {
// //     foreach ($messages as $message) {
//         echo 'bunt: ' . $messages->Buntnr . '<br>';
//     // }
// // }


// $sql = 'select * from qo7sn_regn_hist  WHERE Regnskapsar=2022 order by bilag desc limit 1;';
// $db->setQuery((string) $sql);
// $messages = $db->loadObject();
// // if ($messages) {
// //     foreach ($messages as $message) {
//         echo 'bilag: ' . $messages->Bilag . '<br>';
// //     }
// // }













$gg = '<form><table   width="500" border="0" cellspacing="0" cellpadding="2"><tr>' .
  '<th  width="20" scope="col">Periode</th>' .
  '<th width="250" scope="col">Periodenavn</th>' .
  '<th align ="right" width="150" scope="col">Saldo</th>' .
  '<th align ="right" width="150"scope="col">Fjorår</th>' .
  '<th align ="right" width="150"scope="col">Budsjett</th>';
$gg = $gg . '<tr><td  >År:</td><td><input type="text" name="ar" id="ar1" onchange="endre_ar()"></td></tr>';
$gg = $gg . '<tr><td>Månedsbudsjett:</td><td><input type="text" name="budsj" id="buds"></td></tr>';
//gg = gg + '<tr><td>Fjorårstall:</td><td><input  class="text-right" type="text" name="fjor" value='
//   + parseFloat(parseFloat(fjorarsum).toFixed(0)).toLocaleString("nb-NO") + ' id="fjor"></td></tr>';
/*
$gg = $gg . '<tr><th scope="row">Fordel på\nperioder: </th><td>' .
  '<form id="test">' .
  '<label><input type="radio" name="test" value="budsj" checked> Fordel månedsbudsjett</label>' .
  '<label><input type="radio" name="test" value="fjor"> Fordel fjorårstall</label>'
  .'</form>';
*/
/*
      $query = $db->getQuery(true);
      $query = 'select * from #__regn_firma';
      $db->setQuery((string) $query);
      $row = $db->loadAssoc();;
      $regnskapsar = $row['regnskapsar'];
     // $regnskapsar='øøøøø';
  /*
     $query = 'select * from #__regn_kto where ResBal="R" order by Ktonr;';
     //echo '$query1: '.$query.'<br>';
     $db->setQuery((string) $query);
     $messages = $db->loadObjectList ();
     $query = 'select * from qo7sn_regn_resmal where BR="' . $mode1 . '" order by nr;';
      //   $query = 'select * from qo7sn_regn_resmal where BR="R" order by nr;';
      //  echo '$query2: ' . $query . '<br>';

     $db->setQuery((string) $query);  
     $messages1 = $db->loadObjectList ();
     $gg1=$gg1.'<table id="e" border="0" cellspacing="0" cellpadding="0">';
      if ($messages) {
        foreach ($messages as $message) { 
          $gg1=$gg1.
          '<tr>'
           .' <td align="right"><input type="text" onmousedown="logg('.$message->Ktonr.','.$regnskapsar.')" name="<?php echo $message->Ktonr ?>" id="<?php echo $message->Ktonr ?>" style="width:50px; border-width:0px;" value="<?php echo $message->Ktonr ?>" </td>'
           .'<td align="left" style="padding: 0px 0px 0px 10px;"><input type="text" onchange="oppdater_kto('.$message->Ktonr.')" id="2<?php echo $message->Ktonr ?>" name=<?php echo $message->Navn ?>" style="width:300px; border-width:0px;" value="<?php echo $message->Navn ?>"></td>'
           .' <td class="dropdown">'
            .'  <select style=" border-width:0px; background-color:white" name="nr" id="3<?php echo $message->Ktonr ?>" onchange="oppdater_kto('.$message->Ktonr.')" value="'.$message->rapportlinje.')">';
           if ($messages1)
                  foreach ($messages1 as $message1) {
                    $gg1=$gg1.' <option value="' . $message1->nr . '"';
                    if ($message1->nr == $message->rapportlinje)
                    $gg1=$gg1.' selected';  //and $messages1->BR==$message->ResBal
                    $gg1=$gg1. '>' . $message1->nr . ' ' . $message1->tekst . '</option>';
                  };
                ?>;
                $gg1=$gg1.'</select>
            </td>';


            <!--td >
                     <select style=" border-width:0px;" name="kat" >
                     <option value="B">Balanse</option>  
                     <option value="R">Resultat</option>
                     <option value="L">Likviditet</option>
                          </select>
             </td>

       <!--td align ="right" style="padding: 0px 0px 0px 10px;"><input type="text" name="3" id="3" style="width:30px; border-width:0px;" onmousedown = "selectOption()" value="<?php echo $message->rapportlinje ?>"</td>
        <td align ="center" style="padding: 0px 0px 0px 10px;"><input type="text" name="4" id="4" style="width:30x; border-width:0px;" onmousedown ="test()" value="<?php echo $message->ResBal ?>"</td-->

      <?php
        }
      }
      /*
          $gg1=$gg1.' </tr> </table></form';
* /











//     $query = 'select * from #__regn_kto where ResBal="' . $mode1 . '" order by Ktonr;';
     $query = 'select * from #__regn_kto where ResBal="R" order by Ktonr;';
      //echo '$query1: '.$query.'<br>';
      $db->setQuery((string) $query);

      $messages = $db->loadObjectList ();
      $gg=$gg. '<table id="e" border="0" cellspacing="0" cellpadding="0">';
      if ($messages) {
        foreach ($messages as $message) 
    //      $gg=$gg.'<tr><td>'.$message->Ktonr.'</td><br>'
    //    .'<td><input 

        $gg1='
        <tr>
          <td align="right"><input type="text" onmousedown="logg('.$message->Ktonr.','.$regnskapsar.')" name="<?php echo $message->Ktonr ?>" id="<?php echo $message->Ktonr ?>" style="width:50px; border-width:0px;" value="<?php echo $message->Ktonr ?>" </td>
          <td align="left" style="padding: 0px 0px 0px 10px;"><input type="text" onchange="oppdater_kto('.$message->Ktonr.')" id="2<?php echo $message->Ktonr ?>" name=<?php echo $message->Navn ?>" style="width:300px; border-width:0px;" value="<?php echo $message->Navn ?>"></td>
          <td class="dropdown">
            <select style=" border-width:0px; background-color:white" name="nr" id="3<?php echo $message->Ktonr ?>" onchange="oppdater_kto('.$message->Ktonr.')" value="'.$message->rapportlinje.')">';
         if ($messages1)
                foreach ($messages1 as $message1) {
                  $gg1=$gg1.' <option value="' . $message1->nr . '"';
                  if ($message1->nr == $message->rapportlinje)
                  $gg1=$gg1.' selected';  //and $messages1->BR==$message->ResBal
                  $gg1=$gg1. '>' . $message1->nr . ' ' . $message1->tekst . '</option>';
                };
              ?>;
              $gg1=$gg1.'</select>
          </td>';


          <!--td >
                   <select style=" border-width:0px;" name="kat" >
                   <option value="B">Balanse</option>  
                   <option value="R">Resultat</option>
                   <option value="L">Likviditet</option>
                        </select>
           </td>

     <!--td align ="right" style="padding: 0px 0px 0px 10px;"><input type="text" name="3" id="3" style="width:30px; border-width:0px;" onmousedown = "selectOption()" value="<?php echo $message->rapportlinje ?>"</td>
      <td align ="center" style="padding: 0px 0px 0px 10px;"><input type="text" name="4" id="4" style="width:30x; border-width:0px;" onmousedown ="test()" value="<?php echo $message->ResBal ?>"</td-->

    <?php
      }
    }
    /*
        $gg1=$gg1.' </tr> </table></form';





/*



      $messages = $db->loadObjectList();
      $query = 'select * from qo7sn_regn_resmal where BR="' . $mode1 . '" order by nr;';
      //   $query = 'select * from qo7sn_regn_resmal where BR="R" order by nr;';
      //  echo '$query2: ' . $query . '<br>';

      $db->setQuery((string) $query);
     $messages1 = $db->loadObjectList ();
      echo '<table id="e" border="0" cellspacing="0" cellpadding="0">';
      if ($messages) {
        foreach ($messages as $message) { 
          $gg1='
          <tr>
            <td align="right"><input type="text" onmousedown="logg('.$message->Ktonr.','.$regnskapsar.')" name="<?php echo $message->Ktonr ?>" id="<?php echo $message->Ktonr ?>" style="width:50px; border-width:0px;" value="<?php echo $message->Ktonr ?>" </td>
            <td align="left" style="padding: 0px 0px 0px 10px;"><input type="text" onchange="oppdater_kto('.$message->Ktonr.')" id="2<?php echo $message->Ktonr ?>" name=<?php echo $message->Navn ?>" style="width:300px; border-width:0px;" value="<?php echo $message->Navn ?>"></td>
            <td class="dropdown">
              <select style=" border-width:0px; background-color:white" name="nr" id="3<?php echo $message->Ktonr ?>" onchange="oppdater_kto('.$message->Ktonr.')" value="'.$message->rapportlinje.')">';
           if ($messages1)
                  foreach ($messages1 as $message1) {
                    $gg1=$gg1.' <option value="' . $message1->nr . '"';
                    if ($message1->nr == $message->rapportlinje)
                    $gg1=$gg1.' selected';  //and $messages1->BR==$message->ResBal
                    $gg1=$gg1. '>' . $message1->nr . ' ' . $message1->tekst . '</option>';
                  };
                ?>;
                $gg1=$gg1.'</select>
            </td>';


            <!--td >
                     <select style=" border-width:0px;" name="kat" >
                     <option value="B">Balanse</option>  
                     <option value="R">Resultat</option>
                     <option value="L">Likviditet</option>
                          </select>
             </td>

       <!--td align ="right" style="padding: 0px 0px 0px 10px;"><input type="text" name="3" id="3" style="width:30px; border-width:0px;" onmousedown = "selectOption()" value="<?php echo $message->rapportlinje ?>"</td>
        <td align ="center" style="padding: 0px 0px 0px 10px;"><input type="text" name="4" id="4" style="width:30x; border-width:0px;" onmousedown ="test()" value="<?php echo $message->ResBal ?>"</td-->

      <?php
        }
      }
      /*
          $gg1=$gg1.' </tr> </table></form';
*/

//$gg=$gg.$resultat;



?>






<script>
  function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
  }





</script>



<?php

function kontoliste3($t)
{

  return 'ssssssssss';
}


function kontoliste2($t)
{
  echo 'kontoliste2';
  /* $m="echo Kontoliste2";?>
  <script>

             var gg = '<table style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right;width:200px; padding: 0px 10px 0px 0px;"  >Debet</th><th style="text-align:left;width:150px; padding: 0px 0px 0px 0px;">Navn</th></tr><tr>';
                        gg = gg +
                            '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">' +
                            3030 + '</td><td>' + 'navn' + '</td></tr>';
                        gg = gg + '</table>'; 
                         document.getElementById("rr").innerHTML = 'gg';








  // document.getElementById("main1").innerHTML = "eee";
 // console.log( document.getElementById("main1").value);
  </script>
  <?php
}
/*  
//$mode = 'Resultat';
if (isset($_GET["mode"])) {
  $mode = $_GET["mode"];
  echo '<br><h3>Kontoliste ' . $mode . '</h3>';
  Kontoliste($mode);*/
}

$ggg = 'kkkkkkkkkkkkkkkkkk';

function kontoliste1($r)
{

  //$mode = 'Resultat';
  if (isset($_GET["mode"])) {
    $mode = $_GET["mode"];
    //  echo '<br><h3>Kontoliste ' . $mode . '</h3>';
    Kontoliste($mode);
  } else
    kontoliste($r);
}
$aa = 'ggggggggggggggggggggggggggg';

function kontoliste($mode1)
{

  $db = JFactory::getDBO();
  $conf = new JConfig();
  $database = $conf->db;
  $hash = $conf->dbprefix;
  echo '<br><h3>Kontoliste ' . $mode1 . '</h3>';
  //echo 'kontoliste startet<br>';

  //if ($_SERVER["REQUEST_METHOD"] == "POST") {


  // if (isset($_GET['mode']))
  //  $mode1 = $_GET['mode'];
  //echo 'mode1: '.$mode1.'<br>';

  //   if ($mode == 'Resultat')
  //  Kontoliste($mode) ;


  //$mode1='';

  ?>

  <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
    Rapport:

    <select id="dropdown2" name="mode" style="height:30px;" onchange="selectOption()">
      <!--option value="Resultat">Resultat</option>
    <option value="Balanse">Balanse</option>
    <option value="Kontantflyt">Kontantflyt</option-->
      <?php
      echo
        //'<option>Velg rapport</option>
    

        '<option  value="">Velg rapport</option>


    <option  value="Resultat"';
      if ($mode1 == "Resultat")
        echo ' selected';
      echo '>Resultat</option>

    <option  value="Balanse"';
      if ($mode1 == "Balanse")
        echo ' selected';
      echo '>Balanse</option>
 
    <option  values="Kontantflyt"';
      if ($mode1 == "Kontantflyt")
        echo ' selected';
      echo '>Kontantflyt</option>

    <option values="Dekningsbidrag"';
      if ($mode1 == "Dekningsbidrag")
        echo ' selected';
      echo '>Dekningsbidrag</option>

    <option values="Driftsresultatet"';
      if ($mode1 == "Driftsresultatet")
        echo ' selected';
      echo '>Driftsresultatet</option>

    <option values="Avanse"';
      if ($mode1 == "Avanse")
        echo ' selected';
      echo '>Avanse</option>
    
     </select>
   
     <br><br>
       </form>';


      ?>

      <div id="rr"></div>

      <?php
      //   function tt()
//{ 
      /*
          if (isset($_GET['Send'])) { //check if form was submitted
            $input = $_GET['1']; //get input text
            //echo "Success! You entered: " . $input . '<br>';
          }
    */
      //$link=databaseconnect();
      //$sql = 'SELECT * FROM  '.$hash.'regn_hist limit 10';
      //$sql = 'SELECT * FROM  #__regn_hist limit 10';
    
      $query = $db->getQuery(true);
      $query = 'select * from #__regn_firma';
      $db->setQuery((string) $query);
      $row = $db->loadAssoc();
      ;
      $regnskapsar = $row['regnskapsar'];

      //echo 'loadobjct: '.$row['regnskapsar'].'<br>';
      // const myObj = JSON.parse($row['konfig']);
      //$myJSON = json_decode($myObj);  
      //echo 'Regnskapsar: '.$myJSON.'<br>';
    
      $query = $db->getQuery(true);
      $query
        ->select('*')
        ->from('#__regn_kto')
        ->setLimit('20');
      $query = 'select * from #__regn_kto where ResBal="' . $mode1 . '" order by Ktonr;';
      //echo '$query1: '.$query.'<br>';
      $db->setQuery((string) $query);







      $hh = $GLOBALS["aa"];
      $GLOBALS["aa"] = 'aaaaaaaaaaaaaaaaaaaa';

      $regnskap = '
      <form action="" method="get" name="reg">
        <table id="e" border="0" cellspacing="1" cellpadding="1">
          <tr>
            <th style="text-align:right ; border-width:0px;" width="100">
              Ktonr
            </th>
            <th scope="col" style="text-align:right;  border-width:0px;" width="260">
              Navn
            </th>
            <th width="10" style="text-align:right; border-width:0px;">
              Linje
            </th>
            <th width="10" style="text-align:right; border-width:0px;">
              ResBal
            </th>';


      $messages = $db->loadObjectList();
      $query = 'select * from qo7sn_regn_resmal where BR="' . $mode1 . '" order by nr;';
      //   $query = 'select * from qo7sn_regn_resmal where BR="R" order by nr;';
      //  echo '$query2: ' . $query . '<br>';
    
      $db->setQuery((string) $query);
      $messages1 = $db->loadObjectList();
      echo '<table id="e" border="0" cellspacing="0" cellpadding="0">';
      if ($messages) {
        foreach ($messages as $message) {
          $gg1 = '
          <tr>
            <td align="right"><input type="text" onmousedown="logg(' . $message->Ktonr . ',' . $regnskapsar . ')" name="<?php echo $message->Ktonr ?>" id="<?php echo $message->Ktonr ?>" style="width:50px; border-width:0px;" value="<?php echo $message->Ktonr ?>" </td>
            <td align="left" style="padding: 0px 0px 0px 10px;"><input type="text" onchange="oppdater_kto(' . $message->Ktonr . ')" id="2<?php echo $message->Ktonr ?>" name=<?php echo $message->Navn ?>" style="width:300px; border-width:0px;" value="<?php echo $message->Navn ?>"></td>
            <td class="dropdown">
              <select style=" border-width:0px; background-color:white" name="nr" id="3<?php echo $message->Ktonr ?>" onchange="oppdater_kto(' . $message->Ktonr . ')" value="' . $message->rapportlinje . ')">';
          if ($messages1)
            foreach ($messages1 as $message1) {
              $gg1 = $gg1 . ' <option value="' . $message1->nr . '"';
              if ($message1->nr == $message->rapportlinje)
                $gg1 = $gg1 . ' selected';  //and $messages1->BR==$message->ResBal
              $gg1 = $gg1 . '>' . $message1->nr . ' ' . $message1->tekst . '</option>';
            }
          ;
          ?>;
          $gg1=$gg1.'</select')">
          </td>';

          echo $gg.$gg1;
          <!--td >
                     <select style=" border-width:0px;" name="kat" >
                     <option value="B">Balanse</option>  
                     <option value="R">Resultat</option>
                     <option value="L">Likviditet</option>
                          </select>
             </td>
               
       <!--td align ="right" style="padding: 0px 0px 0px 10px;"><input type="text" name="3" id="3" style="width:30px; border-width:0px;" onmousedown = "selectOption()" value="<?php echo $message->rapportlinje ?>"</td>
        <td align ="center" style="padding: 0px 0px 0px 10px;"><input type="text" name="4" id="4" style="width:30x; border-width:0px;" onmousedown ="test()" value="<?php echo $message->ResBal ?>"</td-->
          </tr>
          <?php
        }
      }
      /*
          echo '</table></form';








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
  }
  */
      ?>
      <td> <input type="text" align="left" name="1" id="1" style=" width:50px;" onchange="neste(1)" />
      </td>
      <td> <input type="text" name="2" id="2" style="width:100px;" onchange="neste(2)" /></td>
      <td><input type="text" id="3" style=" width:100px;" onchange="neste(3)"> </td>
      <td><input type="text" id="4" style=" width:100px;" onchange="neste(4)"> </td>
      <td><input type="text" id="5" style=" width:100px;"> </td>
      </tr>
      <tr>
        <td colspan="5" align="right"><input type="Submit" name="Send" id="ok" value="Submit" style="width:100px;"
            onclick="this.disabled=0" ; />
        </td>
      </tr>
      </table>
  </form>
  <?php
}
?>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

  //let output = document.getElementById('output');

  function endre_ar() {
    let ar = document.getElementById('ar').value;
    let kto = document.getElementById('kt11').value;
    //    var kto1 = document.getElementById('kt11').value;   
    console.log("endre ar " + ar) + '  ' + kto;
    tt44(4, ar);
    //      hent_perioder1(ar, kto);

  }

  function importer_budsjett(ar) {
    console.log("importer_budsjett");
    jQuery.ajax({
      type: "POST",
      url: "/components/com_regn/views/Registrering/tmpl/update.php",
      //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
      data: ({
        mode: "importer_budsjett",
        ar: ar
      }),
      cache: false,
      error: console.log("error"),
      success: function (tekst) {
        console.log('importer_budsjett tekst: ' + tekst);
        //    alert("stop");
      }
    })
  }

  function selectOption() {
    console.log("selectOption");
    let dropdown = document.getElementById('dropdown2').value;
    console.log("dropdown " + dropdown);


    var gg = '<form><table   width="500" border="0" cellspacing="0" cellpadding="2"><tr>' +
      '<th  width="20" scope="col">Periode</th>' +
      '<th width="250" scope="col">Periodenavn</th>' +
      '<th align ="right" width="150" scope="col">Saldo1</th>' +
      '<th align ="right" width="150"scope="col">Fjorår1</th>' +
      '<th align ="right" width="150"scope="col">Budsjett1</th>';
    gg = gg + '<tr><td  >År:</td><td><input type="text" name="ar" id="ar"></td></tr>';
    gg = gg + '<tr><td>Månedsbudsjett:</td><td><input type="text" name="budsj" id="buds"></td></tr>';
    //gg = gg + '<tr><td>Fjorårstall:</td><td><input  class="text-right" type="text" name="fjor" value='
    //   + parseFloat(parseFloat(fjorarsum).toFixed(0)).toLocaleString("nb-NO") + ' id="fjor"></td></tr>';

    gg = gg + '<tr><th scope="row">Fordel på\nperioder: </th><td>' +
      '<form id="test">' +
      '<label><input type="radio" name="test" value="budsj" checked> Fordel månedsbudsjett</label>' +
      '<label><input type="radio" name="test" value="fjor"> Fordel fjorårstall</label>'
    //    + '<label><input type="radio" name="test" value="imp1"> Importer budsjett</label></form>';
    //$("#gg").load(" #gg > *");
    $("#gg").load(window.location.href + " #gg");
    var js = '<?php echo $gg ?>';
    var js1 = '<?php echo $aa ?>';

    console.log(js);

    if (dropdown == "Resultat")
      document.getElementById("rr").innerHTML = js;
    else if (dropdown == "Balanse")
      document.getElementById("rr").innerHTML = gg;
    else if (dropdown == "Kontantflyt")
      document.getElementById("rr").innerHTML = js1;
    else
      document.getElementById("rr").innerHTML = 'ukjent';

    //window.location.reload();



  }

  function tull() {

    // get the index of the selected option
    //  let selectedIndex = dropdown.selectedIndex;
    // console.log('selectedIndex: ' + selectedIndex);
    // get a selected option and text value using the text property
    let selectedValue = dropdown; //.options[selectedIndex].text;
    console.log('selectedValue: ' + selectedValue);

    // return selectedValue;


    console.log("endre_ar ");
    //     let ar = document.getElementById("valg_ar").value;
    //    document.cookie = "regnskapsar=" + ar;
    const currentUrl = window.location.href;
    console.log("currentUrl: " + currentUrl);
    let pos = currentUrl.indexOf("mode");
    let pos2 = currentUrl.indexOf("&", pos);
    console.log(pos + "  " + pos2);
    console.log('url: ' + currentUrl + "&mode=" + selectedValue);

    if (pos == -1) {
      console.log('url: ' + currentUrl + "&mode=" + dropdown);
      nyurl = location.replace(currentUrl + "&mode=" + selectedValue);
      //     location.replace(currentUrl + "&mode=" + selectedValue)selectedValue
    } else {
      console.log('A');
      console.log(currentUrl.substring(0, pos));
      console.log(currentUrl.substring(pos2));
      if (pos2 == -1) {
        nyurl = currentUrl.substring(0, pos) + "mode=" + dropdown;
        console.log('A1');
        console.log('nyurl: ' + nyurl);
      } else {
        nyurl = currentUrl.substring(0, pos) + "mode=" + dropdown + currentUrl.substring(pos2);
        console.log('A2');
      }
      console.log("Nyurl: " + nyurl);
      // alert("selectOption");
      location.replace(nyurl);
      /*
             var gg = '<table   width="500" border="0" cellspacing="0" cellpadding="2"><tr>' +
                '<th  width="20" scope="col">Periode</th>' +
                '<th width="250" scope="col">Periodenavn</th>' +
                '<th align ="right" width="150" scope="col">Saldo</th>' +
                '<th align ="right" width="150"scope="col">Fjorår</th>' +
                '<th align ="right" width="150"scope="col">Budsjett</th>';

              let fjorarsum = 0.0;
              for (let i = 0; i < 12; i++) {
                //    console.log(obj[i].belop.toLocaleString("nb-NO"));
                gg = gg + '<tr>' +
                  '<td align ="right" width="20">' + obj[2 * i + 1].nr + '</td>' +
                  '<td width="150" align ="left">' + obj[2 * i + 1].Periodenavn + '</td>' +
                  '<td align ="right" width="150">' + parseFloat(parseFloat(obj[2 * i + 1].belop).toFixed(0)).toLocaleString("nb-NO") + '</td>' +
                  '<td align ="right" width="150">' + parseFloat(parseFloat(obj[2 * i].belop).toFixed(0)).toLocaleString("nb-NO") + '</td>' +
                  '<td align ="right" width="10" style="padding-right: 10px;">' +
                  '<input type="text" onchange="ddd(' + i + ',' + kto1 + ',' + ar1 + ')" id="' + i + 'bud"  size="10" style="  text-align:right; border-width:0px;" value="' +
                  parseFloat(parseFloat(obj[2 * i + 1].budsjett).toFixed(0)).toLocaleString("nb-NO") + '"></td>';
                /*      if (i==2 ) gg=gg+'<td>År:</td><td><input type="text" name="ar" id="ar"></td></tr>';
                else if (i==3 ) gg=gg+'<td>Årsbudsjett:</td><td><input type="text" name="budsj" id="buds"></td></tr>';
                else if (i==4 ) gg=gg+'<td>div:</td><td><input type="text" name="div1" id="div1"></td></tr>';
                else gg=gg+'</tr>';
  
              }

              for (let i = 0; i < 12; i++) {
                fjorarsum = fjorarsum + parseFloat(obj[2 * i].belop);
                //       console.log('Fjorarsum: ' + fjorarsum + '  ' + obj[2 * i].belop + '  ' + i);
              }

              gg = gg + '</tr></table>';
              document.getElementById("kr1").innerHTML = gg;

              var gg = '<div style="margin-left:20px"><table width="300" border="0" cellspacing="10" cellpadding="2"><tr><td>&nbsp;</td></tr>';

              gg = gg + '<tr><td  >År:</td><td><input type="text" name="ar" id="ar"></td></tr>';
              gg = gg + '<tr><td>Månedsbudsjett:</td><td><input type="text" name="budsj" id="buds"></td></tr>';
              //gg = gg + '<tr><td>Fjorårstall:</td><td><input  class="text-right" type="text" name="fjor" value='
              //   + parseFloat(parseFloat(fjorarsum).toFixed(0)).toLocaleString("nb-NO") + ' id="fjor"></td></tr>';

              gg = gg + '<tr><th scope="row">Fordel på\nperioder: </th><td>' +
                '<form id="test">' +
                '<label><input type="radio" name="test" value="budsj" checked> Fordel månedsbudsjett</label>' +
                '<label><input type="radio" name="test" value="fjor"> Fordel fjorårstall</label>'
                //    + '<label><input type="radio" name="test" value="imp1"> Importer budsjett</label>'
                +
                '</form>' ;*/
    }

  }




  function tt44(i, rar) {
    console.log('tt44');
    var kto1 = document.getElementById('kt11').value;
    document.getElementById("ar").value = "444";
    // document.getElementById('ar1').value='ar1';
    document.getElementById('ar').value = 'ar';
    console.log("tt44 " + i + ' kto: ' + kto1 + ' år: ' + rar);
    //} function ddd(i){
    jQuery.ajax({


      type: "POST",
      url: "index.php?option=com_regn&task=konto.hent_kto",
      data: ({
        kto: kto1
      }),
      cache: false,
      success: function (tekst) {
        console.log('tekst',tekst);

  //     }
  //   })
  // }





  //     type: "POST",
  //     url: "/components/com_regn/views/Registrering/tmpl/update.php",
  //     //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
  //     data: ({
  //       mode: "konto_hent",
  //       kto: kto1
  //     }),
  //     cache: false,
  //     success: function (tekst) {
  //       //  console.log('tt44 tekstD: ' + tekst);
        const obj4 = JSON.parse(tekst);
        console.log(obj4);
        //   console.log(obj4.Navn);
        document.getElementById('ar').value = rar;
        document.getElementById('navn').value = obj4.Navn;
        document.getElementById('raplinje').value = obj4.rapportlinje;
      }
    });
    //var gg='<table width="200" border="0" cellspacing="2" cellpadding="2"><tr><th scope="row">AAAA</th><td>ss;</td></tr><tr><th scope="row">&nbsp;</th><td>sss;</td></tr></table>';
    var gg = '<table width="300" border="0" cellspacing="5" cellpadding="5"><tr><th scope="col">Periode</th><th scope="col">Saldo</th><th scope="col">Fjorår</th><th scope="col">Budsjett</th></tr><tr><td>aa;</td><td>bb;</td></tr></table>';
    //   document.getElementById("kr").innerHTML = gg;
    // document.getElementById("kr1").innerHTML = gg;
    hent_perioder(rar, kto1);

  }














  function logg(i, ar) {
    var id = '2' + i;
    //#3498DB var kto1 = document.getElementById(i);
    console.log('logg :' + i + ' id:' + id);
    var kto1 = document.getElementById(i).id;
    var navn = document.getElementById(i).name;
    var val = document.getElementById(i).value;
    //   console.log('logg :' + i + ' id:' + id + ' ktonr:' + kto1 + ' navn:' + navn + ' val:' + val);
    var id = i;
    var kto = document.getElementById(id).id;
    //  console.log('id :' + id);
    var navn = document.getElementById('2' + id).value;
    //   console.log('navn :' + navn);
    var rapportlinje = document.getElementById('3' + id).value;
    // console.log('rapportlinje :' + rapportlinje);
    var resbal = document.getElementById('3' + id).value;
    // console.log('idB :' + id + ' kto:' + kto + ' navn:' + navn + ' rapportlinje:' + rapportlinje + ' resbal:' + resbal);
    document.getElementById('kt11').value = kto1;
    document.getElementById('navn').value = navn;
    console.log('Kaller tt44');
    //    tt44(4,<?php echo $regnskapsar; ?>);
    tt44(4, ar);
  }

  function sc() {


    console.log('sc ' + document.getElementById("dr2").value);
  }

  // function oppdater_kto(id) {
  //   console.log('oppdater_kto id :' + id);
  //   var kto1 = document.getElementById(id).id;
  //   //    console.log('id :' + id);
  //   var navn1 = document.getElementById('2' + id).value;
  //   //   console.log('navn :' + navn1);
  //   var rapportlinje1 = document.getElementById('3' + id).value;
  //   //   console.log('rapportlinje :' + rapportlinje1);
  //   var resbal1 = document.getElementById('3' + id).value;
  //   //  console.log('idA :' + id + ' kto:' + kto1 + ' navn:' + navn1 + ' rapportlinje:' + rapportlinje1 + ' resbal:' + resbal1);



  //   jQuery.ajax({
  //     type: "POST",
  //     url: "/components/com_regn/views/Registrering/tmpl/update.php",
  //     //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
  //     data: ({
  //       mode: "konto_oppdat",
  //       kto: kto1,
  //       navn: navn1,
  //       rapportlinje: rapportlinje1
  //     }),
  //     cache: false,
  //     success: function(tekst) {
  //       console.log(tekst);
  //     }
  //   });
  // }
  /*
      function tt44(i, rar) {
        var kto1 = document.getElementById('kt11').value;
        console.log("tt44 " + i + ' kto: ' + kto1);
        //} function ddd(i){
        jQuery.ajax({
          type: "POST",
          url: "/components/com_regn/views/Registrering/tmpl/update.php",
          //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
          data: ({
            mode: "konto_hent",
            kto: kto1
          }),
          cache: false,
          success: function (tekst) {
            //    console.log('tt44 tekst: ' + tekst);
            let obj4 = JSON.parse(tekst);
            console.log(obj4);
            console.log(obj4.Navn);
            document.getElementById('navn').value = obj4.Navn;
          }
        });
        //var gg='<table width="200" border="0" cellspacing="2" cellpadding="2"><tr><th scope="row">AAAA</th><td>ss;</td></tr><tr><th scope="row">&nbsp;</th><td>sss;</td></tr></table>';
        var gg = '<table width="300" border="0" cellspacing="5" cellpadding="5"><tr><th scope="col">Periode</th><th scope="col">Saldo</th><th scope="col">Fjorår</th><th scope="col">Budsjett</th></tr><tr><td>aa;</td><td>bb;</td></tr></table>';
        // document.getElementById("kr").innerHTML = gg;
        // document.getElementById("kr1").innerHTML = gg;
        hent_perioder(rar, kto1);

      }

  */



</script>

<?php


function Kontoinfo()
{

  if (isset($_GET["oppdat"])) {
    if ($_GET["oppdat"] == "Søk") {

      echo 'søk ktonr: ' . $_GET["ktonr"] . '<br>';
      $db = JFactory::getDBO();
      $query = $db->getQuery(true);
      $query = 'select * from #__regn_kto where Ktonr=' . $_GET["ktonr"] . ' order by Ktonr';
      $db->setQuery((string) $query);
      $message = $db->loadObject();
      $ktonr = $message->Ktonr;
      $navn = $message->Navn;
      $raplinje = $message->rapportlinje;
      $avd = $message->Avdeling;
      $prosjekt = $message->Prosjekt;
      $likvid = $message->Likvid;
      $option_dir = $message->Option_directory;
      $option_dll = $message->Option_dll;
      $nettbank = $message->Nettbank;
      $synlig = $message->synlig;
      $skannet = $message->skannet;
      if ($message->ResBal == "R") {
        $res = "	checked";
        $bal = "";
      } else if ($message->ResBal == "B") {
        $bal = "checked";
        $res = "";
      } else {
        $res = "	checked";
        $bal = "";
      }
      ;
    }
    if ($_GET["oppdat"] == "Oppdater") {
      $res = '';
      $bal = '';
      $ktonr = $_GET["ktonr"];
      $navn = $_GET["navn"];
      $raplinje = $_GET["raplinje"];
      if (isset($_GET["res"]))
        $res = $_GET["res"];
      if (isset($_GET["bal"]))
        $bal = $_GET["bal"];
      $avd = $_GET["avd"];
      $prosjekt = $_GET["prosjekt"];
      $likvid = $_GET["likvid"];
      $option_dir = $_GET["option_dir"];
      $option_fll = $_GET["option_dll"];
      $nettbank = $_GET["nettbank"];
      if (isset($_GET["synlig"]))
        $synlig = $_GET["synlig"];
      $skannet = $_GET["skannet"];
      echo 'ktonr ' . $ktonr, '<br>';
    }

    echo 'Ktonr1:  ' . $message->Ktonr . "<br>";
    echo 'Navn:  ' . $message->Navn . "<br>";
    echo 'ResBal:  ' . $message->ResBal . "  : " . $res . '  :  ' . $bal . '<br>';
    if ($res == 'on')
      $res = 'checked';
    if ($bal == 'on')
      $bal = 'checked';
    //$res='checked';
  } else {
    $ktonr = "";
    $navn = "";
    $raplinje = "";
    $res = "";
    $bal = "";
    $avd = "";
    $prosjekt = "";
    $likvid = "";
    $option_dir = "";
    $option_dll = "";
    $nettbank = "";
    $synlig = "";
    $skannet = "";
  }

  /*
    $query = 'select * from #__regn_firma';
    $db->setQuery((string) $query);
    $mes = $db->loadObject();
  */

  // $query = $db->getQuery(true);
  // $query = 'select * from #__regn_firma';
  // $db->setQuery((string) $query);
  // $row = $db->loadAssoc();
  // ;
  // $regnskapsar = $row['regnskapsar'];



  $regnskapsar = "2010";
  //  $sql = 'SELECT * FROM ' . $hash . 'regn_firma';
  // $result = $conn->query($sql);
  // $temparray = array();
  // while ($row = mysqli_fetch_assoc($result))
  //   $temparray = $row;
  // //	 $obj=json_encode($emparray);
  // $obj = json_decode(json_encode($temparray));
  // $regnskapsar = $obj->regnskapsar;

  // $query = $db->getQuery(true);
  // $query = 'select * from #__regn_firma';
  // $db->setQuery((string) $query);
  // $row = $db->loadAssoc();
  // ;
  // $regnskapsar = $row['regnskapsar'];

  $id = 0;
  $db = JFactory::getDBO();
  $query = $db->getQuery(true);
  if (isset($_GET["regnskapsar"])) {
    $regnskapsar = $_GET["regnskapsar"];
  } else {
    $query = 'select * from #__regn_firma;';
    //echo $query.'<br>';
    $db->setQuery((string) $query);
    $mes = $db->loadObject();
    if (!is_null($mes)) {
      $regnskapsar = $mes->regnskapsar;
    }
  }

  echo 'år: ' . $regnskapsar;

  ?>


  <table class="table1" cellspacing="0" cellpadding="0" border="0">
    <tr>
      <td style="vertical-align:top" colspan="5">
        <div id="db">

          <form action="" method="get">
            <table width="420" border="0" cellspacing="10" cellpadding="2">
              <tr>
                <th style="text-align:right; padding-right:15px;" width="200">Kontonr:</th>
                <td><input type="text" name="ktonr" id="kt11" onchange="tt44(4,<?php echo $regnskapsar; ?>)" /></td>
                <!--td align="left"><input size="50" maxlength="50" align="left" style="padding-left: 10px; border: 0ch; " onchange="tt44(4)" type="text" name="avd" id="k1" /></td-->
              </tr>
              <tr>
                <th style="text-align:right; padding-right:15px;">Navn:</th>
                <td><input type="text" onmousedown="valg(" <?php echo $ktonr ?>") name="navn" id="navn"
                    value="<?php echo $navn ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Rapportlinje:</th>
                <td><input type="text" name="raplinje" id="raplinje" value="<?php echo $raplinje ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Res/Bal:</th>
                <td> <!--p>
      <label>
        <input type="radio" name="resbal" value="checkbox" id="resbal_0" che />
        Resultat</label>
   
      <label>
        <input type="radio" name="resbal" value="checkbox" id="resbal_1" />
        Balanse</label>
      <br />
    </p></td-->

                  <p>
                    <label>
                      <?php if ($res == "checked")
                        echo '<input type="radio"  name="res" id="res"  checked />';
                      else
                        echo '<input type="radio"   name="res" id="res"  />';
                      ?>
                      Resultat
                    </label>

                    <label>
                      <?php if ($bal == "checked")
                        echo '<input type="radio"  name="bal" id="bal"  checked />';
                      else
                        echo '<input type="radio" name="bal" id="bal"/>';
                      ?>
                      Balanse
                    </label>

                  </p>

                </td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Avdeling:</th>
                <td><input type="text" name="avd" id="avd" value="<?php echo $avd ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Prosjekt:</th>
                <td><input type="text" name="prosjekt" id="prosjekt" onchange="prosj()" online="none"
                    value="<?php echo $prosjekt ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Likvid:</th>
                <td><input type="text" name="likvid" id="likvid" value="<?php echo $likvid ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Option_dir:</th>
                <td><input type="text" name="option_dir" id="option_dir" value="<?php echo $option_dir ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Option_dll</th>
                <td><input type="text" name="option_dll" id="option_dll" value="<?php echo $option_dll ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Nettbank:</th>
                <td><input type="text" name="nettbank" id="nettbank" value="<?php echo $nettbank ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Synlig:</th>
                <td><input type="checkbox" name="synlig" id="synlig" value="<?php echo $synlig ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">Bilag skannet:</th>
                <td><input type="text" name="skannet" id="skannet" value="<?php echo $skannet ?>" /></td>
              </tr>
              <tr>
                <th scope="row" style="text-align:right; padding-right:15px;">&nbsp;</th>
                <td>
                  <!--input type="submit" name="avbryt" id="avbryt" value="Avbryt" />
                <!--input type="submit" name="oppdat" id="oppdat" value="Oppdater" />
                <input type="submit" name="oppdat" id="sok" value="Søk" /-->
                </td>
              </tr>
            </table>




      </td>
      <td style="vertical-align:top" colspan="5">
        <div id="kr">
      </td>
      <td style="vertical-align:top" colspan="5">
        <div id="kr1">
      <td style="vertical-align:top" colspan="5">
        <div id="kr2">

  </table>


  </table>
  </form>
  <p id="result"></p>
  <script>


  </script>
  <?php
}
?>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

  function prosj() {
    console.log("prosj");
    let a = document.getElementById("ar").value;
    console.log("ar " + a);
  }



  function change() {
    var kto = document.getElementById('ktonr').value;
    if (kto < 2000 && kto > 1000) document.getElementById('k1').value = "Balanse: Eiendeler";
    else if (kto < 3000 && kto > 2000) document.getElementById('k1').value = "Balanse: Egenkapital og gjeld";
    else if (kto < 4000 && kto > 3000) document.getElementById('k1').value = "Resultat: Salgs- og driftsinntekter";
    else if (kto < 5000 && kto > 4000) document.getElementById('k1').value = "Resultat: Varekostnader";
    else if (kto < 6000 && kto > 5000) document.getElementById('k1').value = "Resultat: Personal- og lønnskostnader";
    else if (kto < 7000 && kto > 6000) document.getElementById('k1').value = "Resultat: Driftsutgifter, av- og nedskrivinger";
    else if (kto < 8000 && kto > 7000) document.getElementById('k1').value = "Resultat: Annen driftskostnad, av- og nedskrivinger";
    else if (kto < 9000 && kto > 8000) document.getElementById('k1').value = "Resultat: Finansinntekter og -kostnader";
    document.getElementById('navn').focus();
    //   alert(kto);

  }


  function hent_perioder(ar1, kto1) {
    var i = 1;
    console.log("hent_perioder1 " + ar1 + '  ' + kto1);


    // } function ddww() {
    const number = 12345.6789;
    const formattedNumber = number.toLocaleString("nb-NO");
    console.log(formattedNumber);

    jQuery.ajax({
      type: "POST",
      url: "/components/com_regn/views/Registrering/tmpl/update.php",
      //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
      data: ({
        mode: "perioder_hent",
        kto: kto1,
        ar: ar1
      }),
      cache: false,
      success: function (tekst) {
        // console.log('counts: '+Object.keys(tekst).length);
        //  console.log('hent_perioder: ' + tekst);
        let obj = JSON.parse(tekst);
        var count1 = Object.keys(obj).length;
        console.log('count: ' + count);
        // console.log('obj '+obj.ar);
        // console.log('nr '+obj.nr);
        console.log(obj);

        //    formatcurrency($message -> budsjett, "NOK")
        if (count1 == 0) {
          var gg = '';
          var gg1 = '';
        }
        else {
          var gg = '<table   width="500" border="0" cellspacing="0" cellpadding="2"><tr>' +
            '<th  width="20" scope="col">Periode</th>' +
            '<th width="250" scope="col">Periodenavn</th>' +
            '<th align ="right" width="150" scope="col">Saldo</th>' +
            '<th align ="right" width="150"scope="col">Fjorår</th>' +
            '<th align ="right" width="150"scope="col">Budsjett</th>';

          // let fjorarsum = 0.0;
          var count = Object.keys(obj).length;
          console.log('count: ' + count);


          for (let i = 0; i < count; i++) {

            // console.log('kto: '+i+' : '+obj[1,1].nr);
            // //      console.log(obj[i].belop.toLocaleString("nb-NO"));
            gg = gg + '<tr>' +
              '<td align ="right" width="20">' + obj[1, i].nr + '</td>' +
              '<td width="150" align ="left">' + obj[1, i].Periodenavn + '</td>' +
              '<td align ="right" width="150">' + parseFloat(parseFloat(obj[1, i].belop).toFixed(0)).toLocaleString("nb-NO") + '</td>' +
              '<td align ="right" width="150">' + parseFloat(parseFloat(obj[1, i].fjorar).toFixed(0)).toLocaleString("nb-NO") + '</td>' +
              '<td align ="right" width="10" style="padding-right: 10px;">' +
              '<input type="text" onchange="ddd(' + i + ',' + kto1 + ',' + ar1 + ')" id="' + i + 'bud"  size="10" style="  text-align:right; border-width:0px;" value="' +
              parseFloat(parseFloat(obj[1, i].budsjett).toFixed(0)).toLocaleString("nb-NO") + '"></td>';
            //   if (i==2 ) gg=gg+'<td>År:</td><td><input type="text" name="ar" id="ar"></td></tr>';
            // else if (i==3 ) gg=gg+'<td>Årsbudsjett:</td><td><input type="text" name="budsj" id="buds"></td></tr>';
            // else if (i==4 ) gg=gg+'<td>div:</td><td><input type="text" name="div1" id="div1"></td></tr>';
            // else gg=gg+'</tr>';

          }

          // for (let i = 0; i < 12; i++) {
          //   fjorarsum = fjorarsum + parseFloat(obj[2 * i].belop);
          //   //       console.log('Fjorarsum: ' + fjorarsum + '  ' + obj[2 * i].belop + '  ' + i);
          // }

          gg = gg + '</tr></table>';
          document.getElementById("kr1").innerHTML = gg;

          var gg1 = '<div style="margin-left:20px"><table width="300" border="0" cellspacing="10" cellpadding="2"><tr><td>&nbsp;</td></tr>';

          gg1 = gg1 + '<tr><td  >År:</td><td><input type="text" name="ar" id="ar" onchange="endre_ar()" value="99"></td></tr>';
          gg1 = gg1 + '<tr><td>Månedsbudsjett:</td><td><input type="text" name="budsj" id="buds"></td></tr>';
          //gg = gg + '<tr><td>Fjorårstall:</td><td><input  class="text-right" type="text" name="fjor" value='
          //   + parseFloat(parseFloat(fjorarsum).toFixed(0)).toLocaleString("nb-NO") + ' id="fjor"></td></tr>';

          gg1 = gg1 + '<tr><th scope="row">Fordel på\nperioder: </th><td>'

            + '       <form id="myForm">'
            + '         <label>'
            + '            <input type="radio" name="option" value="budsj">Fordel budsjettdata'
            + '         </label><br>'
            + '         <label>'
            + '             <input type="radio" name="option" value="fjor"> Hente fjorårsdata'
            + '         </label><br>'
            + '         <label>'
            + '             <input type="radio" name="option" value="import"> Import'
            + '         </label><br>'
            //  + '        <button type="button" onclick="fordel(' + kto1 + ',' + ar1 + ')">Submit</button>'
            // + '     <button type="button" onclick="getSelectedValue()">Submit</button> '
            + '     </form>';








          // gg1 = gg1 + '<tr><th scope="row">Fordel på\nperioder: </th><td>' +
          //   '<form id="test1">' +
          //   '<label><input type="radio" name="test" id="fordel" value="budsj" checked> Fordel månedsbudsjett</label>'
          //   // '<label><input type="radio" name="test" value="fjor"> Fordel fjorårstallA</label>'
          //   + '<label><input type="radio" name="test"  id="fjor" value="imp1"> Hente fjorårsverdier</label>'
          //   +
          //   '</form>' +
          gg1 = gg1 + '</td></tr><tr> <th scope="row"></th><td> <input name="Oppdater"  value="Oppdater" type="submit"  onclick="fordel(' + kto1 + ',' + ar1 + ')"    /></td>  </tr>' +
            '</tr> </table></div>';



          // gg1 = gg1 + '<tr><th scope="row">Fordel på\nperioder: </th><td>'
          //   + '<form  id="form" value="budsj">'
          //   + '<tr><td><input type="radio" name="budsj" id="fordel" value="fordel">Fordel månedsbudsjett</td></tr>'
          //   + '<tr><td><input type="radio" name="budsj" id="fjor" value="fjor">Importer budsjett</td></tr>'
          //   + '</td></tr><tr> <th scope="row"></th><td> <input name="Oppdater"  value="Oppdater" type="submit"  onclick="fordel(' + kto1 + ',' + ar1 + ')"    /></td>  </tr>'
          //   + '</tr></form></td>';
          // gg1 = gg1 + '</table></div>';
          console.log('ar1: ' + ar1);
          document.getElementById("ar").value = ar1;
        }
        document.getElementById("kr1").innerHTML = gg;
        document.getElementById("kr2").innerHTML = gg1;
        document.getElementById("ar").value = ar1;



        //       document.getElementById("ar").value = ar1;

        //   document.getElementById('navn').value=obj4[0].Navn
      }
    });

  }
  /*
    function tt44(i, rar) {
      /*  var kto1 = document.getElementById('kt11').value;
        console.log("tt44_A " + i + ' kto: ' + kto1);
        //} function ddd(i){
        jQuery.ajax({
          type: "POST",
          url: "/components/com_regn/views/Registrering/tmpl/update.php",
          //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
          data: ({
            mode: "konto_hent",
            kto: kto1
          }),
          cache: false,
          success: function (tekst) {
            console.log('tt44 tekstE: ' + tekst );
          //  const oj6 = "{\"Ktonr\":\"4010\",\"Navn\":\"Kosthold\"}";
          //  console.log(oj6);
            const obj5 = JSON.parse(tekst);
            console.log(obj5);
            console.log(obj5.Ktonr);
            console.log(obj5.Navn);
            document.getElementById('navn').value = obj5.Navn;
            document.getElementById('raplinje').value = obj5.rapportlinje;
             document.getElementById('avd').value = obj5.Avdeling;
            //    document.getElementById('prosjekt').value = obj4;
          }
        });
        //var gg='<table width="200" border="0" cellspacing="2" cellpadding="2"><tr><th scope="row">AAAA</th><td>ss;</td></tr><tr><th scope="row">&nbsp;</th><td>sss;</td></tr></table>';
        var gg = '<table width="300" border="0" cellspacing="5" cellpadding="5"><tr><th scope="col">Periode</th><th scope="col">Saldo</th><th scope="col">Fjorår</th><th scope="col">Budsjett</th></tr><tr><td>aa;</td><td>bb;</td></tr></table>';
       //  document.getElementById("kr").innerHTML = gg;
         document.getElementById("kr1").innerHTML = gg;
      hent_perioder1(rar, kto1);
  
    }
  */
  /*
    function fordel(kto1, ar1) {
      console.log("fordel "+kto1+"  "+ar1);
      var buds1 = document.getElementById("buds").value;
     // var fjor1 = document.getElementById("fjor").value;
      var bud1 = document.getElementById("buds").value;
        console.log("hentet  budsjett 1: " + bud1);
      var jj = "123 456";
      //let jj1 = fjor1.substring(0, 3) + fjor1.substring(4, 7);
      // let jj=fjor1;
      // console.log("jj1: " + fjor1 + '  ' + jj1);
      //#2980B9  let jj = jj.split(' ').join('');
     // let jj2 = fjor1.replace(' ', '');
      // console.log("jj2: " + fjor1 + '  ' + jj2);
      //  var imp1 = document.getElementById("imp1").value;
      let jj3 = fjor1.split(' ').join('');
      // console.log("jj3: " + fjor1 + '  ' + jj3);
      var form = document.getElementById("test");
      var valg = form.elements["test"].value;
      var sent = '';
       if (valg == 'budsj') sent = buds1;
      else if (valg == 'fjor') sent = jj1;
      else sent = imp1;
      console.log("fordel budsjett "+bud1+"  "+sent);
     // console.log('valg1: ' + buds1 + '  |' + fjor1 + '|  ' + valg + '  ' + sent);
      fjor1.replaceAll(/\s/g, '');
      // sent.replaceAll(/\s/g, '');
      // console.log('valg2: ' + buds1 + '  |' + fjor1 + '  ' | + valg + '  ' + sent);
      //  console.log(' a b    c d e   f g   '.replaceAll(' ', ''));
      jQuery.ajax({
        type: "POST",
        url: "/components/com_regn/views/Registrering/tmpl/update.php",
        //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
        data: ({
          mode: "perioder_oppdat",
          kto: kto1,
          ar: ar1,
          valg: valg,
          arsbudsj: sent
        }),
        cache: false,
        success: function (tekst) {
             console.log(tekst);
          let obj = JSON.parse(tekst);
          //  document.getElementById("2bud").value = 444;//  obj[1].budsjett;
          for (i = 0; i < 12; i++) {
            //         console.log(i+"bud"+"  "+obj[i].budsjett);
            document.getElementById(i + "bud").value = parseFloat(parseFloat(obj[i].budsjett).toFixed(0)).toLocaleString("nb-NO");
          }
        } //window.location.reload(); //location.
      // reload() ;
     //  window.location.reload();
      hent_perioder(ar1, kto1);
      })
    }
  */


  function getSelectedValue() {
    const radios = document.getElementsByName('option');
    let selectedValue;
    console.log("getSelectedValue " + radios)
    for (const radio of radios) {
      if (radio.checked) {
        selectedValue = radio.value;
        break;
      }
    }

    document.getElementById('result').innerText = 'Selected Value: ' + selectedValue;
  }







  function ddd(per, kto, ar) {

    var id1 = per + "bud";
    var budsj = document.getElementById(id1).value;
    var nper = per + 1;
    console.log('ddd ' + per + "  " + kto + "  " + ar + "  " + per + 'bud' + "  " + budsj + "  nper:" + nper);
    jQuery.ajax({
      type: "POST",
      url: "/components/com_regn/views/Registrering/tmpl/update.php",
      //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
      data: ({
        mode: "oppd_kto",
        kto: kto,
        ar: ar,
        per: per,
        budsj: budsj
      }),
      cache: false,
      success: function (tekst) { }
    })

    document.getElementById(nper + "bud").focus();
  }

  function abcd() {
    alert("abcd");
  }

  function fordel(kto1, ar1) {
    var buds1 = document.getElementById("buds").value;
    var ar = document.getElementById("ar").value;
    var result = document.getElementById("result").value;

    console.log("fordel  kto1: " + kto1 + " ar1: " + ar1 + " buds1: " + buds1 + " result: " + result);
    // var fjor1 = document.getElementById("fjor").value;
    var bud1 = document.getElementById("buds").value;
    console.log("hentet  budsjett 1: " + bud1 + ' ar: ' + ar);
    var jj = "123 456";
    //let jj1 = fjor1.substring(0, 3) + fjor1.substring(4, 7);
    // let jj=fjor1;
    // console.log("jj1: " + fjor1 + '  ' + jj1);
    //#2980B9  let jj = jj.split(' ').join('');
    // let jj2 = fjor1.replace(' ', '');
    // console.log("jj2: " + fjor1 + '  ' + jj2);
    //  var imp1 = document.getElementById("imp1").value;
    // let jj3 = fjor1.split(' ').join('');
    // console.log("jj3: " + fjor1 + '  ' + jj3);
    // var form = document.getElementById("fordel");
    // var valg0 = document.getElementById("test1").value;
    // var valg = document.getElementById("fordel").value;
    // var valg4 = document.getElementById("fjor").value;


    const radios = document.getElementsByName('option');
    let selectedValue;

    for (const radio of radios) {
      if (radio.checked) {
        selectedValue = radio.value;
        break;
      }
    }

    document.getElementById('result').innerText = 'Selected Value: ' + selectedValue;
    //fordel,fjorar,import
    //      if (selectedValue=='fordel') fordel();
    //      else if  (selectedValue=='fjorar') fjorar();
    //    else if  (selectedValue=='import') import();
    //   }
    //  function fordel(){
    var sent = '';
    valg = selectedValue;
    if (valg == 'budsj') sent = buds1;
    // else if (valg == 'fjor') sent = jj1;
    // else sent = imp1;
    // console.log("fordel budsjett "+bud1+"  "+sent);
    // console.log('valg1: ' + buds1 + '  |' + fjor1 + '|  ' + valg + '  ' + sent);
    //fjor1.replaceAll(/\s/g, '');
    // sent.replaceAll(/\s/g, '');
    // console.log('valg2: ' + buds1 + '  |' + fjor1 + '  ' | + valg + '  ' + sent);
    //  console.log(' a b    c d e   f g   '.replaceAll(' ', ''));
    jQuery.ajax({
      type: "POST",
      url: "/components/com_regn/views/Registrering/tmpl/update.php",
      //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
      data: ({
        mode: "perioder_oppdat",
        kto: kto1,
        ar: ar,
        valg: valg,
        arsbudsj: sent
      }),
      cache: false,
      success: function (tekst) {
        //  console.log("perioder_oppdat: " + tekst);
        let obj = JSON.parse(tekst);
        console.log(obj);
        //  document.getElementById("2bud").value = 444;//  obj[1].budsjett;
        for (i = 0; i < 12; i++) {
          //         console.log(i+"bud"+"  "+obj[i].budsjett);
          document.getElementById(i + "bud").value = parseFloat(parseFloat(obj[i].budsjett).toFixed(0)).toLocaleString("nb-NO");
        }
      } //window.location.reload(); //location.
      // reload() ;
      //  window.location.reload();
      //  hent_perioder(ar1, kto1);
    })
    // hent_perioder(ar1, kto1);
  }




  /*
     var name = 'nname';//document.getElementsByName("4020") ; //                getElementsByid(id).value;
   var kto = document.getElementById(i);//.value; //                getElementsByid(id).value;
   // var navn = document.getElementsByid('24021').value ; //                getElementsByid(id).value;
    console.log('kto :'+kto+'name :'+name);
   // console.log('logg2 :'+navn);
  */


  function valg(kto) {
    console.log('valg: ' + kto);

  }

  function gg() {
    console.log('gg');
    var kto = document.getElementsByid('2').value;
    console.log(kto);

  }

  function resbl(i, j) {
    console.log('resbal: ' + i + ' : ' + j);
    var kto = document.getElementsByid(i).value;

  }

  function test() {
    console.log('test');

    var input, filter, ul, li, a, i;
    input = document.getElementById("3");
    // console.log(input);

    filter = input.value.toUpperCase();
    console.log(filter);
    div = document.getElementById("myInput");
    a = div.getElementsByTagName("a");
    for (i = 0; i < a.length; i++) {
      txtValue = a[i].textContent || a[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        a[i].style.display = "";
      } else {
        a[i].style.display = "none";
      }
    }
  }
</script>