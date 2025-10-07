<?php
echo 'start<br>';
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
  function f_valg() {
    console.log("f_valg");

  }
</script>

<h1><?php echo $this->msg; ?></h1>

<?php
$ref = 53839;
$konfig = '{"ar":"' . date("Y-m-d H:i:s") . '","Ref":"' . $ref . '"}';
//echo ' $konfig: '.$konfig.'<br>';
$obj4 = json_decode($konfig);
//echo 'år: '.$obj4 ->ar. '  Ref: '.$obj4 ->Ref.'<br>';







$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;

$db = JFactory::getDBO();
$query = $db->getQuery(true);
$arstall = 2015;

if ((($_SERVER["REQUEST_METHOD"]) == "GET")) {
  if (isset($_GET['arstall']))
    $arstall = $_GET["arstall"];
}
$sql = 'CALL proc_saldoliste(' . $arstall . ');';
$db->setQuery((string) $query);
//$query = 'select * from #__regn_saldo order by ar ;';
$query = 'SELECT * from proc_saldoliste where ar=".order by kto';
//echo ' $query: ' . $query . '<br>';
/*$db->setQuery((string) $query);
$mes = $db->loadColumn();
*/
$db->setQuery((string) $query);
//echo 'sql: '.$query.'<br>';
/*
$nf = new \NumberFormatter('nb_NO', \NumberFormatter::CURRENCY);
$nf->setAttribute( \NumberFormatter::MIN_FRACTION_DIGITS, 0 );
$nf->formatCurrency(0, 'NOK');
*/


$nf = new \NumberFormatter('nb_NO', \NumberFormatter::CURRENCY);
$nf->setTextAttribute(\NumberFormatter::CURRENCY_CODE, 'NOK');
$nf->setSymbol(NumberFormatter::CURRENCY_SYMBOL, '');
$nf->setAttribute(\NumberFormatter::MAX_FRACTION_DIGITS, 0);
// echo $nf->format(1);


$query = 'select * from #__regn_regnskapsar order by regnskapsar desc;';
//echo ' $query: ' . $query . '<br>';
$db->setQuery((string) $query);
$mes = $db->loadColumn();
//echo $mes[2];
$nr = 0;
$ant = $db->getCount();
$regnskapsar = $arstall;
//echo 'årstall: '.$arstall.'<br>';
?>
<form method="GET" action="<?php echo $_SERVER['PHP_SELF']; ?>">
  Regnskapsår1:
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
  <input type="submit" name="submit" value="Oppdater1">
 <input type="submit" name="imp" onclick="importer_budsjett(2011)" value="Importer budsjett">
  <input type="submit" name="submit" value="Eksporter budsjett">

   <?php
  //echo 'årstall1: '.$arstall.'<br>';
  
  if ($arstall == 'Alle')
    $arstall = 2015;
  //echo 'årstall2: '.$arstall.'<br>';
  
  $tt = 'DNB 5361,63,45601';
  //echo 'copy: '.substr($tt,0,10).'<br>';
//$query = 'SELECT * from proc_saldoliste where ar='.$arstall.' order by kto';
  $query = 'SELECT * from proc_saldoliste AS a inner JOIN qo7sn_regn_kto AS b on a.kto=b.Ktonr  where a.ar=' . $arstall . ' order by a.kto';

  $db->setQuery((string) $query);
  //echo 'sql: '.$query.'<br>';
  

  $messages = $db->loadObjectList();
  echo '<form><table>'; ?>
  <tr>
    <!--th width="50" scope="col">ar</th-->
    <th width="50" style="text-align:right" scope="col">kto </th>
    <th width="100" style="text-align:left" scope="col">Navn</th>
    <th width="100" style="text-align:right" scope="col">Jan</th>
    <th width="100" style="text-align:right" scope="col">Feb</th>
    <th width="100" style="text-align:right" scope="col">Mar</th>
    <th width="100" style="text-align:right" scope="col">Apr</th>
    <th width="100" style="text-align:right" scope="col">Mai</th>
    <th width="100" style="text-align:right" scope="col">Jun</th>
    <th width="100" style="text-align:right" scope="col">Jul</th>
    <th width="100" style="text-align:right" scope="col">Aug</th>
    <th width="100" style="text-align:right" scope="col">Sep</th>
    <th width="100" style="text-align:right" scope="col">Okt</th>
    <th width="100" style="text-align:right" scope="col">Nov</th>
    <th width="100" style="text-align:right" scope="col">Des</th>
    <th width="20" style="text-align:right" scope="col">Konf</th>
  </tr>
  <?php
  $options = array();
  //echo '<table id="e" border="0" cellspacing="1" cellpadding="1">';
  if ($messages) {
    foreach ($messages as $message) {

      $obj4 = json_decode($message->konfig);
      if ($obj4 > '')
        $h = 'v';
      else
        $h = 'x';
      //     echo '<td align ="right" style=" padding-right: 20px;">' . $message->nr . "</td>";
      echo '<tr>'
        //<td  align ="right">'. $message->ar.'</td>
        . '<td  align ="right" style=" padding-right: 10px;">' . $message->kto . '</td>' //<td align ="right"> '.$message->periode.'</td>'
        . '<td  align ="left">' . substr($message->Navn, 0, 11) . '</td>' //<td align ="right"> '.$message->periode.'</td>'
        . '<td  align ="right">' . $nf->format($message->v1) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v2) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v3) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v4) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v5) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v6) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v7) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v8) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v9) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v10) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v11) . '</td>'
        . '<td  align ="right">' . $nf->format($message->v12) . '</td>'
        . '<td  align ="right">' . $h . '</td></tr>';

    }
  }
  echo '</table></form>';






  ?>