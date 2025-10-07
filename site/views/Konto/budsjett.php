<?php
echo 'test1<br>';
include 'test.php';
  
/*
$fh = fopen('budsjett.csv', 'r');
while ($line = fgets($fh)) {
    // <... Do your work with the line ...>
   echo($line[0]);
 //   echo ($line[1]);
}
fclose($fh);

*/
$regnskapsar=2011;
f_importer_budsjett(2012);
echo 'start<br>';
function f_importer_budsjett($regnskapsar){
if ($file = fopen("budsjett.csv", "r")) {
    while (!feof($file)) {
        $line = fgets($file);
         echo $line.'<br>';
        $i = strpos($line, ';');
        $kto=substr($line,0,$i);
        echo 'pos: '.$i,'  substr: '.substr($line,0,$i).'<br>';  // les ktonr
        $j=0;
       $i=$i-1;
       for ($k=1;$k<13;$k++){
      /*  $j= strpos($line, ';',$i+1);
        echo 'pos1: ' . $i, '  substr: ' . substr($line, $i+1, $j-$i-1) . '<br>';
      */  $i=$j+1;
        $j = strpos($line, ';', $i + 1);
        echo 'pos'.$k.': ' . $i, '  substr: ' . substr($line, $i , $j - $i) . '<br>';
        $sql='update qo7sn_regn_saldo set budsjett='.substr($line, $i , $j - $i).' where ar='.$regnskapsar.' and kto='.$kto.' and periode='.$k.';';
        echo 'sql: '.$sql.'<br>';
        }
        
        
        $i = $j + 1;
        $j = strpos($line, ';', $i + 1);
        echo 'pos3: ' . $i, '  substr: ' . substr($line, $i, $j - $i) . '<br>';
        # do same stuff with the $line
    }
    fclose($file);
}
}
?>