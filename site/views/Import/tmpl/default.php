<style>
    #log {
        width: 100%;
        height: 800px;
        border: 1px solid #ccc;
        overflow-y: scroll;
        Enables vertical scrolling 
        background-color: #f9f9f9;
        padding: 10px;
    }
</style>
<?php

echo 'importAAAAr<br>';
//  ddd();
// }function ddd(){

set_time_limit(0);
ob_implicit_flush(true);
ob_end_flush();

// use Joomla\CMS\Factory;

$db = JFactory::getDbo();
$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;
$mode = 'R';
$regnskapsar = "2010";

$sql = 'select * from #__regn_hist order by ref desc limit 1;';
$db->setQuery((string) $sql);
$messages = $db->loadObject();

$buntnr = $messages->Buntnr + 1;
echo 'Neste bunt: ' . $buntnr . '<br>';
$bilagnr = $messages->Bilag + 1;
echo 'Neste bilag: ' . $bilagnr . '<br>';
$ref = $messages->ref + 1;
echo 'Neste ref: ' . $ref . '<br>';


$sql = 'select * from #__regn_trans order by ref desc limit 1;';
$db->setQuery((string) $sql);
$messages2 = $db->loadObject();
if ($messages2) {
if ($messages2->Buntnr == null)
    $messages2->Buntnr = 0;

echo 'Neste tbunt: ' . $messages2->Buntnr . '<br>';
echo 'Neste tbilag: ' . $messages2->bilag . '<br>';
echo 'Neste tref: ' . $messages2->Ref . '<br>';
;

if ($messages2->Buntnr==null) $messages2->Buntnr =0;
$tbuntnr = $messages2->Buntnr ;
echo 'Neste tbunt: ' . $tbuntnr . '<br>';
if ($messages2->bilag == null)
    $messages2->bilag = 0;
$tbilagnr = $messages2->bilag + 1;
echo 'Neste tbilag: ' . $tbilagnr . '<br>';
if ($messages2->Ref == null)
    $messages2->Ref = 0;
$tref = $messages2->Ref + 1;
echo 'Neste tref: ' . $tref . '<br>';



if ($tbuntnr > $buntnr)
    $buntnr = $tbuntnr;
if ($tbilagnr > $bilagnr)
    $bilagnr = $tbilagnr+1;
if ($tref > $ref)
    $ref = $tref+1;
}

//exit;
// $sql = 'select * from #__regn_hist  WHERE Regnskapsar=2024 order by bilag desc limit 1;';
// $db->setQuery((string) $sql);
// $messages = $db->loadObject();
// $bilagnr = $messages->Bilag + 1;
// echo 'Neste bilag: ' . $bilagnr . ' | '. $messages->Bilag.'<br>';

// $sql = 'select * from #__regn_hist  WHERE Regnskapsar=2024 order by ref desc limit 1;';
// $db->setQuery((string) $sql);
// $messages = $db->loadObject();
// $ref = $messages->ref + 1;
// echo 'Neste ref: ' . $ref . ' | '.$messages->ref.'<br>';
// // }
// function ddd()
// {
$nr = 1;
$sql = 'select * from import4;';
$db->setQuery((string) $sql);
$messages = $db->loadObjectList();

// $p = "PRIMA";
// $sql1 = 'select * from qo7sn_regn_hist where kontoinfo like "%' . $p . '%"';
// $sql1 = 'select * from qo7sn_regn_hist where kontoinfo like "%PRIMA%"';
// echo $sql1 . '<br>';
// $db->setQuery((string) $sql1);
// $messages1 = $db->loadObjectList();
// echo 'ferdig<br>';
// foreach ($messages1 as $message1) {
//     echo $message1->Dato . '   |  ' . $message1->belop . '  |   ' . $message1->Tekst . '<br>';

// }
//     $st='PRIMA ARENA AS Notanr 74570004243824334634661';
// $i = strpos($st, ' ');
// $p = substr($st, 0, $i);
// echo '$st: '.$st.' $i: '.$i.' $p: '.$p.'<br>';


// if ($p == "Varekjøp ")
//     $r = substr($st, $i);
// elseif ($p == 'Avtalegiro til ')
//     $r = substr($st, $i);
// else
// if ($p == 'Notanr ')
//     $r = substr($st, $i);
// else
//     $r = $st;
// echo '$r: '.$r.' <br> substr($st, $i): '.substr($st, $i).'<br>';

// $i = strpos($st, 'Notanr');
// echo 'rev $r: '.substr($st,0,$i).'<br>';


echo '   <div id="log">';
//  if (4 > 5) {
if ($messages) {
    foreach ($messages as $message) {
 //       echo '<br><br>' . $message->dato . '   ||  ' . $message->belop . '  ||   ' . $message->tekst . '<br>';
        $i = strpos($message->tekst, ' ');
        $k = strpos($message->tekst, '*');
        //   echo '$i: ' . $i . ' $k: ' . $k;
        if ($k != '')
            $i = $k;
        $p = substr($message->tekst, 0, $i + 1);
        //    echo '$p: |' . $p . '|<br>';
        //    echo '$i: ' . $i . '<br>';
        if ($p == "Varekjøp ")
            $r = substr($message->tekst, $i + 1);
        elseif ($p == 'Avtalegiro til ')
            $r = substr($message->tekst, $i + 1);
        elseif ($p == 'kontaktløs ')
            $r = substr($message->tekst, $i + 1);
        elseif ($p == 'Notanr ')
            $r = substr($message->tekst, $i + 1);
        elseif ($p == 'Straksbetaling ')
            $r = substr($message->tekst, $i + 4);
        elseif ($p == 'Avtalegiro ')
            $r = substr($message->tekst, $i + 4);
        elseif ($p == 'Giro ')
            $r = substr($message->tekst, $i + 3);
        elseif ($p == 'Vipps*') {
            $r = substr($message->tekst, $i + 1);
   //         echo '****Vipps**** $r:<br>';
        } elseif ($p == 'VISA ') {
            $r = substr($message->tekst, $i + 29);
   //         echo '***VISA*** ' . $r . '<br>';
        } else
            $r = $message->tekst;

        $j = strpos($r, 'Notanr');
        //  echo '$j: |' . $j . '|<br>';
        if ($j != '')
            $r = substr($r, 0, $j);

        $j = strpos($r, 'betal');
        if ($j != '')
            $r = substr($r, 0, $j);

        $j = strpos($r, 'Betalingsdato ');
        if ($j != '')
            $r = substr($r, 0, $j);

        //   echo $r . 'pass****<br>';



        if ($i == 0)
            $r = $message->tekst;



        //    echo ' $r: ' . $r . ' $i: ' . $i . ' <br>';
        //     echo ' $p: ' . $p . '<br>';


        //  $p = "PRIMA";
        //   $sql='select count(debet),debet,kredit,tekst,kontoinfo from hist  where kontoinfo like "%' . $p . '%" GROUP BY debet ORDER BY COUNT(debet) desc LIMIT 1;';
        // $sql1 = 'select * from hist where kontoinfo like "%' . $p . '%" limit 1';
        $sql1 = 'select count(debet) as cnt,debet ,kredit,belop,kontoinfo,tekst  from hist where kontoinfo like "%' . $p . '%" group by debet ORDER BY COUNT(debet) desc LIMIT 1';
        //$sql1 = 'select * from qo7sn_regn_hist where kontoinfo like "%PRIMA%" limit 1';
        //$sql1 = 'select * from import4 limit 3';
        // echo $sql1 . '<br>';

        $db->setQuery((string) $sql1);
        $message1 = $db->loadObject();
        if ($message1)
            $debet=$message1->debet;
            else
            $debet="ukjent";
        // if (!isset($message1->cnt))  $message1->cnt=0;
        //        echo 'ferdig<br>';
        //       foreach ($messages1 as $message1) {
      //   echo $message1->cnt . '   |  ' . $message1->debet . '   |  ' . $message1->kredit . '  |   ' . $message1->tekst . '  |   ' . $r . '<br>';
        // flush();
        // ob_flush();

        $sql = 'select * from qo7sn_regn_hist where Dato="' . $message->dato . '" and belop=abs(' . -$message->belop . ') and Regnskapsar=year("' . $message->dato . '");';
           echo 'sql: ' . $sql . '<br>';

        $db->setQuery($sql);
        $db->execute();
        //     get the count 
        $my_count = $db->getNumRows();
     //   echo 'nr: ' . $nr++ . '  count ' . $my_count.'   ';
        flush();
        ob_flush();
        if ($my_count == 0) {
            //  //       echo 'insert trans    ' . $bilagnr . '     ' . $message1->debet . '     ' . $message->dato . '     ' . $message->belop . '<br>';
            //         //     $sql='insert into qo7sn_regn_trans (debet,kredit,belop,tekst,kontoinfo,reskontro)'
            //         // .' values ("'.$message1->debet.'","2011","'.$message->belop.'","'.$message->tekst.'","'.$message->tekst.'","'.$r.'");';
            //         if ($message->belop > 0)
            //             $sql = 'insert into #__regn_trans (ref,periode,bilagsart,bilag,Buntnr,dato,debet,kredit,belop,tekst,kontoinfo,reskontro,bank_saldo,bank_ver_dato,reskontronr,Regdato)'
            //                 . ' values (' . $ref . ',proc_periode(MONTH("' . $message->dato . '")),6,' . $bilagnr . ',' . $buntnr . ',"' . $message->dato . '","2011","' . $message1->debet . '",' . $message->belop . ',"Fra Storebrand bank","' . $message->tekst . '","' . $r . '","' . $message->saldo
            //                 . '",NOW(),' . $message1->debet . ' ,NOW());';
            //         else
            //             $sql = 'insert into #__regn_trans (ref,periode,bilagsart,bilag,Buntnr,dato,debet,kredit,belop,tekst,kontoinfo,reskontro,bank_saldo,bank_ver_dato,reskontronr,Regdato)'
            //                 . ' values (' . $ref . ',proc_periode(MONTH("' . $message->dato . '")),6,' . $bilagnr . ',' . $buntnr . ',"' . $message->dato . '","' . $message1->debet . '","2011",' . -$message->belop . ',"Fra Storebrand bank","' . $message->tekst . '","' . $r . '","' . $message->saldo
            //                 . '",NOW(),' . $message1->debet . ',NOW());';
            //         $bilagnr = $bilagnr + 1;
            //         $ref = $ref + 1;
            //         $db->setQuery((string) $sql);
            //         // retrieve the data 
            //         $db->execute();
            //     }

            //       echo 'insert trans    ' . $bilagnr . '     ' . $message1->debet . '     ' . $message->dato . '     ' . $message->belop . '<br>';
            //     $sql='insert into qo7sn_regn_trans (debet,kredit,belop,tekst,kontoinfo,reskontro)'
            // .' values ("'.$message1->debet.'","2011","'.$message->belop.'","'.$message->tekst.'","'.$message->tekst.'","'.$r.'");';
       //     if (!isset($message1->debet)) $message1->debet="ukjent";
            if ($message->belop > 0)
                $sql = 'insert into #__regn_trans (ref,periode,bilagsart,bilag,Buntnr,dato,debet,kredit,belop,tekst,kontoinfo,reskontro,bank_saldo,reskontronr,Regdato)'
                    . ' values (' . $ref . ',proc_periode(MONTH("' . $message->dato . '")),6,' . $bilagnr . ',' . $buntnr . ',"' . $message->dato . '","2011","' . $debet . '",'
                    . $message->belop . ',"Fra Storebrand bank","' . $message->tekst . '","' . $r . '","' . $message->saldo . '","' . $debet . '",now());';
            else
                $sql = 'insert into #__regn_trans (ref,periode,bilagsart,bilag,Buntnr,dato,debet,kredit,belop,tekst,kontoinfo,reskontro,bank_saldo,reskontronr,Regdato)'
                    . ' values (' . $ref . ',proc_periode(MONTH("' . $message->dato . '")),6,' . $bilagnr . ',' . $buntnr . ',"' . $message->dato . '","' . $debet . '","2011",'
                    . -$message->belop . ',"Fra Storebrand bank","' . $message->tekst . '","' . $r . '","' . $message->saldo . '","' . $debet . '",now())';
            //    $sql = 'insert into #__regn_trans (ref,periode,bilagsart,bilag,Buntnr,dato,debet,kredit,belop)'
            //         . ' values (' . $ref . ',proc_periode(MONTH("' . $message->dato . '")),6,' . $bilagnr . ',' . $buntnr . ',"2011","' . $message1->debet . '",'
            //         . $message->belop . ');';
            // else
            //     $sql = 'insert into #__regn_trans (ref,periode,bilagsart,bilag,Buntnr,dato,debet,kredit,belop)'
            //         . ' values (' . $ref . ',proc_periode(MONTH("' . $message->dato . '")),6,' . $bilagnr . ',' . $buntnr . ',"' . $message->dato . '","' . $message1->debet . '","2011",'
            //         . -$message->belop . ')';
            $bilagnr = $bilagnr + 1;
            $ref = $ref + 1;
            // $db->setQuery((string) $sql);
            // // // retrieve the data 
            // $db->execute();
  //          echo 'Insert   trans  ' . $debet. '     ' . $message->dato . '     ' . $message->belop . '     '.$message->tekst .'<br>';
   //         echo 'Insert   trans  ' . $debet . '     ' . $message->dato . '     ' . $message->belop . '     ' . $message->tekst . '<br>';
            echo 'Insert   trans  ' . $debet . '     ' . $message->dato . '     ' . $message->belop . '<br>';

        } else {
      //      echo 'Oppdater hist   ' . $debet . '     ' . $message->dato . '     ' . $message->belop . '     ' . $message->tekst . '<br>';
            echo 'Oppdater hist   ' . $debet . '     ' . $message->dato . '     ' . $message->belop .'<br>';

            //  echo 'oppdater hist...<br>';
            $sql = 'update #__regn_hist set kontoinfo="' . $message->tekst . '", reskontro="' . $r . '",dato_verif=NOW(),reskontronr="' . $debet. '",  Saldo_ktoutskr=' . $message->saldo . ' where dato="' . $message->dato . '" and belop=' . -$message->belop . ' and  Regnskapsar=year("' . $message->dato . '");';
            // echo $sql.'<br>';
        }
    
        // $sql = 'insert into qo7sn_regn_trans (debet,kredit,tekst,kontoinfo,reskontro)'
        //     . ' values ("' . $message1->debet . '","2011","' . $message->tekst . '","' . $message->tekst . '","' . $r . '",");';
        //   echo $sql . '<br><br>';
        // ob_flush();
        // flush();
        // sleep(2);
       $db->setQuery((string) $sql);
        // // retrieve the data 
        $db->execute();
    }

}
echo 'ferdig';

echo '</div>';
//      //   $sql1 = 'select * from qo7sn_regn_hist where kontoinfo like "%' . $p . '%"';
//           $sql1='select * from  hist limit';
//     //    $sql1 = 'select * from qo7sn_regn_hist where kontoinfo like "%PRIMA%"';
//         echo $sql1 . '<br>';
//         $db->setQuery((string) $sql1);
//         $messages1 = $db->loadObjectList();
//         echo 'ferdig<br>';
//         foreach ($messages1 as $message1) {
//             echo $messages1[1]->Dato . '   |  ' . $messages1[1]->belop . '  |   ' . $messages1[1]->Tekst . '<br>';

//         }
//     }
//         echo 'ferdig2<br>';



// $sql1 = 'select * from qo7sn_regn_hist where kontoinfo like "%' . $p . '%"';
// // echo $sql . '<br>';
// $db->setQuery((string) $sql1);
// $messages1 = $db->loadObjectList();
// //     echo $r . '<br>';
// foreach ($messages1 as $message1) {
//     echo $message1->dato . '   |  ' . $message1->belop . '  |   ' . $message1->tekst . '<br>';
//         }
// }



