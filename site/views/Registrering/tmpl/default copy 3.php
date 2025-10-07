<?php
defined('_JEXEC') or die('Restricted access');
include 'fc.php';
?>



<h1><?php echo $this->msg; ?></h1>

<?php
$model = $this->getModel('registrering');
$firma = $model->firma();
$transer = $model->transer();


// Fetch the record
$sistepost = $model->sistepost();
//echo 'siste post: ' . $sistepost . '<br>';

//$firma = $model->regnskapsar();
$regnskapsar = $firma->regnskapsar;



 foreach($transer as $trans){
    echo $trans->Ref.'    '.$trans->Dato.'<br>';

 }
$modus='vanlig';
$nr1='';
$bilag='';
$ref='';

?>

 <form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
 <!--table style=" margin-left: 20px;"  -->
 <table style=" margin-left: 5px;" id="e" border="0" cellspacing="1" cellpadding="1">
     <td align="right" style="text-align:right;width:10px; border-width:0px;  padding-right: 10px;">
         <?php echo $nr1 ?>
     </td>
     <td align="right"><input type="hidden" style=" width:150px;  border-width:0px; align:left" id="ref"
             value=" <?php echo ($ref + 1) ?>"></td>

     <td align="right" style="text-align:right;width:20px; border-width:0px;  padding-right: 10px;">
         <?php echo ($ref + 1) ?>
     </td>
     <td style="text-align:right;width:45px; border-width:0px;">
         <?php echo ' ' . ($bilag + 1) ?>
     </td>
     <td align="right" style="padding-right: 10px; width:63px;">

     </td>
     <!--td><input type="text" id=1 style=" width:30px;" onkeydown="fart()"   > </td-->

     <td><input type="text" id=1 style=" width:30px;" onkeydown="list_art()" onclick="list_art()"
             onchange="list_art()"> </td>
     <!--td><input type="text" id=1 style=" width:30px;" onkeydown="finn_kto()"   > </td-->
     <td><input type="text" placeholder="DD.MM.YYYY" name="Dato" id=2 style=" width:115px;"
             onchange="datokonv4(<?php echo $regnskapsar ?>)" </td>

     <td><input type="text" id=3 name="debet" style=" width:50px;" onclick="finn_kto(0)" onkeydown="finn_kto(1)"
             onchange="finn_kto(2)">
     </td>

     <!-- <td><input type="text" id=3 name="debet" style=" width:50px;" onmousedown="finn_kto(0)" 
             onkeydown="finn_kto(1)" onchange="finn_kto(2)">
     </td>             -->
     <td><input type="text" id=4 style=" width:50px;" class="no-outline" onclick="finn_kkto(0)"
             onkeydown="finn_kkto_sok(1)"> </td>
     <?php if ($modus == 'valuta') {
         ?>
         <td><input type="text" id="val" disabled class="no-outline" style=" width:150px;"
                 onkeydown="belop(<?php echo $modus ?>)">
         </td>
         <?php
     } else {
         echo ' <input type="hidden" id="val" class="no-outline" style=" width:100px;">';
     }
     ?>
     <td><input type=" text" id=5 class="no-outline" style=" width:100px;"
             onkeydown="belop('<?php echo $modus ?>')">
     </td>
     <td><input type="text" id=6 style=" width:200px;"
             onkeydown="UpdateRecord(<?php echo ++$ref ?>,<?php echo ++$bilag ?>,<?php echo $buntnr ?>,'<?php echo $modus ?>')">
     </td>
     <td><input type="hidden" id="buntnr" name="buntnr" value="<?php echo $buntnr ?>" /></td>
     </tr>
     <tr>
         <td>&nbsp</td>
     </tr>
     <tr>
         <td colspan="9" align="middle">
             <input type="button" onclick="slett()" disabled value="Slett post" id="btn_slett"
                 style=" width:120px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="button" onclick="PrintDiv()" value="Utskrift"
                 style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <input type="button" value="Endre" onclick="console.log(ff)"
                 style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <?php if ($modus == 'valuta') {
                 ?>

                 <input type="button" name="valuta" value="DKK" style=" width:100px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <?php } ?>
             <!--input type="button" style=" width:100px;" value="Oppdater" onclick="oppdater_hist()" /-->


         </td>

         </td>
         <!--td colspan="5" align="right"><input < ?php if( $id==5) echo 'type="Submit"' ?> name="Send" id="ok" value="Submit" style="width:100px;"
             onclick="this.disabled=0" ; />
     </td-->
     </tr>

     <!--tr height="20px"></tr-->

     <!--?php setlocale(LC_MONETARY, 'en_US'); ?-->


 </table>
</form>
