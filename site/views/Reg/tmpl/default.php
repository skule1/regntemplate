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
$msg = '';
$mod = new RegnModelReg;
$messages = $mod->transer();
$bilagsarter = $mod->bilagsarter();
$modus = 'vanlig';
$nr1 = 1;
$ref = 0;
$bilag = 0;
$regnskapsar = '2020';
$buntnr = 33;
include 'fc.php';
?>

<h1><?php echo $this->msg; ?></h1>

<form action="" method="get" name="reg">
    <table style=" margin-left: 10px;" id="e" border="0" cellspacing="1" cellpadding="1">
        <tr>
            <th scope="col" width="10" height="48">
                Nr
            </th>
            <th scope="col" width="20" height="48">
                Ref
            </th>
            <th scope="col" width="50" height="48" class="text-center">
                Bilagnr
            </th>
            <th scope="col" width="70">
                Skannet
            </th>
            <th scope="col" width="10" height="48" class="text-center">
                Art
            </th>
            <th scope="col" width="100" height="48" class="text-center">
                Dato
            </th>
            <th scope="col" width="50">
                Debet
            </th>
            <th scope="col" width="50">
                Kredit
            </th>
            <?php

            if ($modus == 'valuta')
                $msg = $msg . ' <th class="text-center" scope="col" width="200">
                Valuta
            </th>';
            $msg = $msg . ' <th class="text-center" scope="col" width="50">
            Beløp
        </th>
        <th   scope="col" width="200" >
                Tekst
            </th>

            <th scope="col">&nbsp;</th>
        </tr>';

            $debetsum = 0;
            $kreditsum = 0;
            $buntsum = 0;
            $nr = 0;
            if ($messages) {
                foreach ($messages as $message) {
                    $nr++;
                    if ($nr == 30)
                        break;

                    //        echo $message->belop.'<br>';
                    $buntsum = $buntsum + $message->belop;
                    if ($message->debet > 0)
                        $debetsum = $debetsum + $message->belop;
                    if ($message->kredit > 0)
                        $kreditsum = $kreditsum + $message->belop;

                    //    echo "<td>" .$message->Dato . "</td>";
                    /*
        if ($result = mysqli_query($link, $sql)) {
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_array($result)) {
             */
                    //<input type="date" id="birthday" name="birthday">
                    // echo 'dato1: ' . $message->Dato . '<br>';
                    $message->Dato = date("d.m.Y", strtotime($message->Dato));
                    // echo 'dato2: ' . $message->Dato . '<br>';
                    $k = strpos($message->kontoinfo, ' ');
                    $debet = "2" . $message->Ref;
                    $msg = $msg . '<tr>'
                        . '<td style="text-align:right;width:20px;  padding-right: 10px;">' . $nr1++ . "</td>"
                        . '<td style="text-align:right; width:50px; id=$message->Ref" onclick="f_ref(' . $message->Ref . ')"   >' . $message->Ref . "</td>"
                        . '<td  style="text-align:right;"> ' . $message->bilag . "</td>"
                        . '<td  style="text-align:right;width:10px;"> ' . $message->Skannet . "</td>"
                        . '<td  style="text-align:right;"> <input type="text" id="bilagsart' . $message->Ref . '"  onchange="updatefield(' . $message->Ref . ')" style=" width:30px; border-width:0px; direction: rtl;" value="' . $message->Bilagsart . '"></td>'
                        . '<td  style="text-align:right;"> <input type="text" id="dato' . $message->Ref . '"  onchange="updatefield(' . $message->Ref . ')" style=" width:115px; border-width:0px; direction: rtl;"  value="' . $message->Dato . '"></td>'
                        . '<td  style="text-align:right;"> <input type="text" id="debet' . $message->Ref . '"  onchange="updatefield(' . $message->Ref . ')" style=" width:50px; border-width:0px; direction: rtl;"   value="' . $message->debet . '"></td>'
                        . '<td  style="text-align:right;"> <input type="text" id="kredit' . $message->Ref . '"  onchange="updatefield(' . $message->Ref . ')" style=" width:50px; border-width:0px; direction: rtl;"  value="' . $message->kredit . '"></td>';
                    /*       ?>
                            <tr></tr><td > <input type="text" id="debet10" onchange="updatefield1(44)" value="445"></td> </tr>
                           <?php
               */
                    if ($modus == 'valuta') {
                        if ($message->currency_amount == 0)
                            $msg = $msg . '<td></td>';
                        else
                            $msg = $msg . '<td  width="200"; style="text-align:right; "> ' . number_format($message->currency_amount, 2, ',', '.') . ' ' . $message->currency . "</td>";
                    }
                    //           $msg = $msg .'<td  width="100"; style="text-align:right; "> ' . formatcurrency($message->currency_amount,"INR").' '.$message->currency. "</td>";
            
                    $msg = $msg
                        //               . '<td  > <input type="text" id="belop' . $message->Ref . '"   style=" width:100px; border-width:0px; align:right"  onchange="updatefield(' . $message->Ref . ')"  value="' . formatcurrency($message->belop, "NOK")  . '"></td>'
                        //             . '<td  > <input type="text" id="belop' . $message->Ref . '"   style=" width:100px; border-width:0px; align:right"  onchange="updatefield(' . $message->Ref . ')"  value="' . formatcurrency($message->belop, "NOK")  . '"></td>'
                        . '<td  > <input type="text" id="belop' . $message->Ref . '"   style=" width:120px; text-align:right; border-width:0px; " onchange="updatefield(' . $message->Ref . ')"  value="' . formatcurrency($message->belop, "NOK") . '"></td>'
                        . '<td  > <input type="text" id="tekst' . $message->Ref . '"  style="width:200px;padding-left: 10px; border-width:0px;" onchange="updatefield(' . $message->Ref . ')"  value="' . $message->tekst . '"></td>'
                        . '<td  > <input type="text" id="kontoinfo' . $message->Ref . '"  style="width:100px;padding-left: 10px; border-width:0px;" onchange="updatefield(' . $message->Ref . ')"  value="' . substr($message->kontoinfo, 0, $k) . '"></td>'
                        . '<td  > <input type="text" id="reskontro' . $message->Ref . '"  style="width:500px;padding-left: 10px; border-width:0px;" onchange="updatefield(' . $message->Ref . ')"  value="' . $message->reskontro . '"></td>'
                        . "</tr>";
                }
                echo $msg . '<br>';
            }


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

                    <td><input type="text" id=3 name="debet" style=" width:50px;" onclick="finn_kto(0)"
                            onkeydown="finn_kto(1)" onchange="finn_kto(2)">
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
<form>
    <table style=" margin-left: 20px;">
        <tr height="20px"></tr>
        <tr>
            <td width="100" align="right">Buntsum:</td>
            <td align="left">
                <?php echo number_format($buntsum, 2, ',', '.'); ?>
            </td>
            <td width="100" align="right">Debet sum:</td>
            <td align="left">
                <?php echo number_format($debetsum, 2, ',', '.'); ?>
            </td>
            <td width="100" align="right">Kredit sum:</td>
            <td align="left">
                <?php echo number_format($kreditsum, 2, ',', '.'); ?>
            </td>
            <td width="100" align="right">Diff: sum:</td>
            <td align="left">
                <?php echo number_format($debetsum - $kreditsum, 2, ',', '.'); ?>
            </td>
        </tr>
    </table>
</form>


<table border="0" width="800">
    <td width="400">
        <div id="debet"></div>
    </td>
    <td>
        <div id="kredit"></div>
    </td>
</table>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

    const id_dato = 2;
    const id_debet = 3;
    const id_kredit = 4;
    const id_belop = 5;
    const id_tekst = 6;





    function list_art() {

        console.log('list_art');
        jQuery.ajax({
            method: "POST",
            //             //   let a=document.getElementById(55).value;
            url: "index.php?option=com_regn&task=reg.bilagsarter",

            //             data: ({
            //                 mode: "bilagsarter"
            //             }),
            //             cache: false,
            success: function (tekst) {

                obj2 = JSON.parse(tekst); console.log(tekst);
                console.log(obj2);
                // const bilagsarter =
                //     [{ "id": 1, "beskrivelse": "ssssssssssss", "Column 3": null, "dato": null, "debet": "4010", "kredit": "2011", "belop": null, "tekst": null }, { "id": 2, "beskrivelse": "eeeeeeee", "Column 3": null, "dato": "2024-09-27", "debet": null, "kredit": null, "belop": null, "tekst": null }, { "id": 3, "beskrivelse": "ssssssssssss", "Column 3": null, "dato": null, "debet": "4010", "kredit": "2011", "belop": null, "tekst": null }, { "id": 4, "beskrivelse": "eeeeeeee", "Column 3": null, "dato": "2024-09-27", "debet": null, "kredit": null, "belop": null, "tekst": null }]
                //     obj2.forEach((item) => {
                //     console.log(`ID: ${item.id}, Name: ${item.beskrivelse}`);
                //            });
img='<table><tr><th>Id</th><th>Beskrivelse</th></tr>';
obj2.forEach((item) => {
    img +='<tr><td>'+item.id+'</td><td>'+item.beskrivelse+'</td></tr>';})
    img +='</table>';


        //         // console.log(obj2);
        //         let gg =
        //             '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; padding: 0px 10px 0px 0px;" >Kunde</th><th width="600">Navn</th></tr><tr>';
        //         //      onkeydown = "hent_kto(id)"
        //         for (let i = 0; i < obj2.length; i++) {
        //             //               for (let i = 1; i < 5; i++) {
        //             gg = gg +
        //                 '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" id="' +
        //                 i + 'oo" value="' + obj2[i].id + '"  onclick="hent_art(' + obj2[i].id +
        //                 ')">' +
        //                 ' <td > <input type="text"  style="text-align:left; border-width:0px; width:200px; padding: 0px 10px 0px 0px;"  id="' +
        //                 i + 'kk" value="' + obj2[i].beskrivelse + '" onclick="hent_art(' + obj2[
        //                     i].id +
        //                 ')" ></td></tr>';
        //             if (obj2.length == 1) {
        //                 hent_kto1(obj2[0].id, 3);

        //                 /*       gg = gg +
        //                            '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
        //                            obj2[0].id + '</td></td>' +
        //                            '<tr><td style="text-align:right; border-width:0px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
        //                            obj2[0].id + '</td></td>' +
        //                            '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
        //                            '<td >' + obj2[0].id + '</td></td>';*/
        //             }
        //         }
        //         gg = gg + '</table>';
        //         // document.getElementById("333").innerHTML = gg;
                document.getElementById("debet").innerHTML = img;
                // document.getElementById("kr").innerHTML = gg;
    }
        })
    }





    function finn_kto() {

        console.log('finn_kto');
        jQuery.ajax({
            method: "POST",
            //   let a=document.getElementById(55).value;
            url: "index.php?option=com_regn&task=reg.kontoliste",

            data: ({
                mode: "bilagsarter"
            }),
            cache: false,
            success: function (tekst) {
                //   console.log(tekst);
                document.getElementById("debet").innerHTML = tekst;
            }
        })
    }



    function finn_kkto() {

        console.log('finn_kkto');
        jQuery.ajax({
            method: "POST",
            //   let a=document.getElementById(55).value;
            url: "index.php?option=com_regn&task=reg.kontoliste",

            data: ({
                mode: "bilagsarter"
            }),
            cache: false,
            success: function (tekst) {
                //   console.log(tekst);
                document.getElementById("kredit").innerHTML = tekst;
            }
        })
    }





    // function kto() {

    //     console.log('kto..');
    // }



</script>