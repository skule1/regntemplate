<style>
    th {

        margin-right: 10px;
        margin-left: 10px;
        padding: 2px 2px;
    }

    /* 
    td {

        margin-right: 10px;
        margin-left: 10px;
        padding: 2px 2px;
    } */

    .td1 {
        width: 60px;
        text-align: right;
        padding: 0 px 10px;
    }

    input {
        text-align: right;
        border-width: 0px;
    }

    .btn {
        background-color: #2925a5ff;
        color: white;
        padding: 7px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #1f0a54ff;
        color: #b4eb0fff;
        font-weight: bold;
    }

   /* Resize handle */
      .resizer {
         position: absolute;
         right: 0;
         top: 0;
         width: 5px;
         height: 100%;
         cursor: col-resize;
         user-select: none;
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
defined('_JEXEC') or die('Restricted access');
include 'fc.php';


?>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
    function f_valg() {
        console.log("f_valg");

    }
</script>


<?php
function Saldoliste($arstall)
{

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
    //   $arstall = 2015;

    if ((($_SERVER["REQUEST_METHOD"]) == "GET")) {
        if (isset($_GET['arstall']))
            $arstall = $_GET["arstall"];
    }
    /*   $sql = 'CALL proc_saldoliste(' . $arstall . ');';
       $db->setQuery((string) $sql);
      $db->loadObject();
  */
    //$sql = 'update qo7sn_regn_saldoliste s set konfig='.'{"oppdatert":"'. $arstall .'"} ;';
    // $sql = 'update qo7sn_regn_saldoliste set konfig="'.'{"oppdatert":"'. date('Y-m-d H:i:s').'"}'.'   where ar="' . $arstall .'";';
    $sql = 'update qo7sn_regn_saldoliste set konfig="{\"oppdatert\":\"' . date('Y-m-d H:i:s') . '\"}" where ar="' . $arstall . '"; ';
    $db->setQuery((string) $sql);
    // echo 'sql '.$sql.'<br>';
    $db->loadObject();
    $sql = 'select konfig from qo7sn_regn_saldoliste  where ar="' . $arstall . '" limit 1;';
    $db->setQuery((string) $sql);
    $db->loadObject();
    $mes = $db->loadColumn();
    // echo 'konfig: ' . $mes["konfig"] . '<br>';

    $query = 'SELECT * from qo7sn_regn_saldoliste where ar="' . $arstall . '" order by kto';
    //   echo ' sql saldoliste: ' . $sql . '<br>';
    //   echo ' $query: ' . $query . '<br>';
    $db->setQuery((string) $query);
    $db->loadObject();
    $mes = $db->loadColumn();


    /*$db->setQuery((string) $query);
    $mes = $db->loadColumn();
    */
    //  $db->setQuery((string) $query);
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
        Regnskapsår:
        <!--select name="valgt_ar"-->
        <tr>
            <td>
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
                <input type="submit" name="submit" value="Oppdater">
                <input type="submit" name="imp" onclick="importer_budsjett(2011)" value="Importer budsjett">
                <input type="submit" name="submit" value="Eksporter budsjett">
            </td>
        </tr>

        <?php
        //echo 'årstall1: '.$arstall.'<br>';
    
        if ($arstall == 'Alle')
            $arstall = '';
        //echo 'årstall2: '.$arstall.'<br>';
    
        $tt = 'DNB 5361,63,45601';
        //         //echo 'copy: '.substr($tt,0,10).'<br>';
// //$query = 'SELECT * from qo7sn_regn_saldoliste where ar='.$arstall.' order by kto';
//         $query = 'SELECT * from qo7sn_regn_saldoliste AS a inner JOIN qo7sn_regn_kto AS b on a.kto=b.Ktonr  where a.ar=' . $arstall . ' order by a.kto';
    
        //         $db->setQuery((string) $query);
//         //echo 'sql: '.$query.'<br>';
        //         $messages = $db->loadObjectList();
    
        $model = new RegnModelKonto;
        $messages = $model->saldoliste();
        echo '<form><table width=1400>';
        ?>
        <tr>
            <!--th width="50" scope="col">ar</th-->
            <th width="50" style="text-align:right" scope="col">kto <div class="resizer"></div></th>
            <th width="100" style="text-align:left" scope="col">Navn<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Jan<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Feb<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Mar<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Apr<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Mai<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Jun<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Jul<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Aug<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Sep<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Okt<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Nov<div class="resizer"></div></th>
            <th width="100" style="text-align:right" scope="col">Des<div class="resizer"></div></th>
            <th width="120" style="text-align:right" scope="col">Konf</th>
        </tr>
        <?php
        $options = array();
        //echo '<table id="e" border="0" cellspacing="1" cellpadding="1">';
        if ($messages) {

            $i = 1;
            foreach ($messages as $message)
                if ($arstall == $message->ar) {
                    // foreach ($message->ar as $ar)
                    //     echo '</tr><tr><td>' . $message->ar . '</td><br><br>';
                    {
                        if (($message->periode == 1) || ($message->periode < $i))
                            $i = 1;
                        if ($i == 1)
                            echo '</tr><tr><td style="width: 100px;  text-align: right;">' . $message->kto . '</td><td style="width: 300px; padding-left:10px;  text-align:left;">' .substr( $message->navn ,0,20). ' <div class="resizer"></div></td>';
                        //  foreach ($message->kto as $kto) 
                        //     echo '</tr><tr>'.$kto;
                        //     foreach ($message->periode as $periode) {
    
                        // $obj4 = json_decode($message->konfig);
                        // if ($obj4 > '')
                        //     $h = 'v';
                        // else
                        //     $h = 'x';
                        //     echo '<td align ="right" style=" padding-right: 20px;">' . $message->nr . "</td>";
                        //<td  align ="right">'. $message->ar.'</td>
                        if ($i == $message->periode) {
                            echo '<td  align ="right" style=" padding-right: 10px;">' . $message->belop . '</td>';//<td align ="right"> '.$message->periode.'</td>';
                            $i++;
                        } else {
                            while ($i++ < $message->periode)
                                echo '<td></td>';
                            echo '<td  align ="right" style=" padding-right: 10px;">' . $message->belop . '</td>';//<td align ="right"> '.$message->periode.'</td>';
                        }
                    }
                    // echo '<td  align ="left">' . substr($message->Navn, 0, 11) . '</td>' //<td align ="right"> '.$message->periode.'</td>'
                    // . '<td  align ="right">' . $nf->format($message->belop) . '</td>'
                    // . '<td  align ="right">' . substr($message->konfig, 14, 10) . '</td>'
                    // . '</td></tr>';
    
                    //     }
                    // }
                }
        }
        ?>
          <script>
      const resizers = document.querySelectorAll(".resizer");
      let currentResizer;

      for (let resizer of resizers) {
         resizer.addEventListener("mousedown", function (e) {
            currentResizer = resizer;
            document.addEventListener("mousemove", resizeColumn);
            document.addEventListener("mouseup", stopResize);
         });
      }

      function resizeColumn(e) {
         const td = currentResizer.parentElement;
         td.style.width = e.pageX - td.getBoundingClientRect().left + "px";
      }

      function stopResize() {
         document.removeEventListener("mousemove", resizeColumn);
         document.removeEventListener("mouseup", stopResize);
      }
   </script>
   <?php

        echo '</table></form>';



}


?>