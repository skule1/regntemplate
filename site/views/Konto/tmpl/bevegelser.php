<head>
    <script src="js/jquery.js"></script>
    <script src="js/colResizable.min.js"></script>
</head>

<?php
$db = JFactory::getDBO();
$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;
$mode = 'R';
$regnskapsar = "2010";



function bevegelser4()
{
    echo 'bevegelser<br>';
    ?>
    <form>
        <table>
            <tr>
                <td>

                    <button type="button" id="btn" onclick="test66()">Click Me!</button>

                </td>
            </tr>
        </table>
    </form>
    <?php
}





function bevegelser()
{

    ?>

    <!-- <form action="" method="get">
    <table border="0" cellspacing="2" cellpadding="2">  
        <tr> 
            <th style="text-align:right;border-width:5px;" width="100" scope="col">Bilagsart</th>
            <th style="text-align:right;border-width:1px;" width="100" scope="col">Bilag</th> 
            <th style="text-align:center;border-width:1px;" width="100" scope="col">Dato</th>  
            <th style="text-align:right;border-width:1px;" width="100"scope="col">Debet</th>  
            <th style="text-align:right;border-width:1px;" width="100"scope="col">Kredit</th>  
            <th style="text-align:right;border-width:1px;" align="right" width="100" scope="col">Beløp</th>  
            <th scope="col">Tekst</th>  <th scope="col">Kontoinfo</th> -->



    <?php





    global $hash, $db; // <-- Add this line

    // echo $_SERVER['REQUEST_URI'];
    //  if (isset($_GET["mode"]))
    //  if ($_GET["mode"])
    //  echo "<script>window.location = 'http://localhost/index.php/k1?view=Konto'</script>";

    $db = JFactory::getDBO();
    $sql = 'select Bilagsart,Bilag,Dato,debet,kredit,belop,Tekst,kontoinfo from qo7sn_regn_hist where debet=4010;';// and regnskapsar=2022 and Periode="februar" order by dato;';

    $db->setQuery((string) $sql);
    $messages = $db->loadObjectList();

    $sql = 'select * from qo7sn_regn_kto order by Ktonr;';
    $db->setQuery((string) $sql);
    $messages1 = $db->loadObjectList();

    $sql = 'select * from qo7sn_regn_perioder order by nr;';
    $db->setQuery((string) $sql);
    $messages2 = $db->loadObjectList();

    $sql = 'select * from qo7sn_regn_regnskapsar order by regnskapsar desc;';
    $db->setQuery((string) $sql);
    $messages3 = $db->loadObjectList();

    $sql = 'select * from qo7sn_regn_firma;';
    $db->setQuery((string) $sql);
    $messages4 = $db->loadObject();





    //                             // if ($messages1) {
    //                             // foreach ($messages1 as $message1) {
    //                             //     echo '<option>' . $message1->Ktonr . '  ' . $message1->Navn . '</option>';
    //                           //  }
    $regnskapsar = $messages4->regnskapsar;

    ?>

    Konto:
    <select id="id_kto" style="height:25px; width: 120px !important; min-width: 50px; max-width: 150px;" name="mode"
        onchange="offs('')">
        <?php
        //$messages1 = $db->loadObjectList();
        // echo '<option value="hh">Velg kto</option>';
        if ($messages1) {
            foreach ($messages1 as $message1) {
                echo '<option value="' . $message1->Ktonr . '">' . $message1->Ktonr . '  ' . $message1->Navn . '</option>';
            }
        }
        ?>
    </select> Periode:
    <select style="height:25px; width: 120px " id="id_per" name="mode" onchange="offs('next')">
        <?php
        //$messages1 = $db->loadObjectList();
        //    echo '<option value="Alle perioder">Alle perioder</option>';
        if ($messages2) {
            foreach ($messages2 as $message2) {
                echo '<option value="' . $message2->Periodenavn . '">' . $message2->Periodenavn . '</option>';
            }
        }
        ?>
    </select> År:
    <select style="height:25px;" id="id_ar" name="mode" onchange="offs('next')">
        <?php
        //$messages1 = $db->loadObjectList();
        if ($messages3) {
            foreach ($messages3 as $message3) {
                //    echo '<option>' . $message3->regnskapsar . '</option>';
                echo '<option';
                if ($message3->regnskapsar == $regnskapsar)
                    echo ' selected >';
                else
                    echo '>';
                echo $message3->regnskapsar;
                echo '</option>';
            }
        }
        ?>
    </select> Sortering:
    <select id="id_sort" name="mode" style="height:25px;" onchange="offs('next')">
        <option>Bilag</option>
        <option>Dato</option>
        <option>Beløp</option>
    </select>
    </select> Rekkefølge:
    <select id="id_rekke" name="mode" style="height:25px;" onchange="offs('next')">
        <option>Opp </option>
        <option>Ned</option>

    </select>
    Antall poster: <input type="text" value="25" style=" width: 50px" id="id_tekst" onchange="offs('next')">
    <!-- <input type="button" value="!<" id="id_prev" onclick="offs_forst()">
    <input type="button" value="<<" id="id_prev" onclick="offs_prev()">
    <input type="button" value=">>" id="id_next" onclick="offs_next()">
    <input type="button" value=">!" id="id_prev" onclick="offs_sist()">     -->
    <input type="button" value="!<" id="id_prev" onclick="offs('forst')">
    <input type="button" value="<<" id="id_prev" onclick="offs('prev')">
    <input type="button" value=">>" id="id_next" onclick="offs('next')">
    <input type="button" value=">!" id="id_prev" onclick="offs('sist')">
    <!-- <input type=" submit" id="33" value="Submit"></input> -->
    <div id="rr2"></div>

    <?php
}
?>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">



    var glob_offset =25;

    console.log('glob_offset', glob_offset);


    const formatter = new Intl.NumberFormat('nb-NO', {
        style: 'currency',
        currency: 'NOK'
    })

    async function offs(m) {

        const kto1 = document.getElementById('id_kto').value;
        const per1 = document.getElementById('id_per').value;
        const ar1 = document.getElementById('id_ar').value;
        const sort1 = document.getElementById('id_sort').value;
        const rekke1 = document.getElementById('id_rekke').value;
        const ant1 = document.getElementById('id_tekst').value;
      //  const offset1 = glob_offset;

        const dd1 = await debet_oppdat_bev(kto1, ar1, per1);
        const bel = dd1.ss;
        const cnt = dd1.cnt;
        const dd2 = await kredit_oppdat_bev(kto1, ar1, per1);
        const bel1 = dd2.ss;
        const cnt1 = dd2.cnt;
        console.log('dd1: ', dd1,'bel:',bel,cnt);
        console.log('dd2: ', dd2,'bel1:', bel1,cnt1);

        console.log('glob_offset start',glob_offset,m)
        if (m == "next") glob_offset = glob_offset + 25;
        else if (m == "prev") glob_offset = glob_offset - 25;
        console.log('glob_offset',glob_offset,m)

        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=konto.offs1()",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                //         mode: "oppdat_bev",
                kto: kto1,
                ar: ar1,
                per: per1,
                sort: sort1,
                rekke: rekke1,
                ant: ant1,
                offset: glob_offset
            }),
            cache: false,
            success: function (tekst) {
                console.log('tekst oppfset: ',  glob_offset);
                //     //   console.log('tekst: ' + tekst);
                //     //    return;
                let obj = JSON.parse(tekst);
       
                console.log(obj);
                // console.log(obj[1]);
                console.log(" obj.length;" + obj.length);
                // for (let j=0;j<obj.length;j++)
                // console.log('obj '+j+' : '+obj[j]["Dato"]);
                // let msg = "<table><tr><td>ref</td></tr></table";
                // //   let msg1 = "";
                let msg2 = "";
                let j = 0;
                let msg1 =
                    '<form action="" method="get"><table border="0" cellspacing="2" cellpadding="2">  <tr  style="height:15px;"></tr><tr>' +
                    '  <th style="text-align:right;border-width:0px;" width="10" scope="col">Ref</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="3" scope="col">Art</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="10" scope="col">Bilag</th>' +
                    '  <th style="text-align:center;border-width:0px;" width="100" scope="col">Dato</th>' +
                    '  <th style="text-align:right;border-width:0px;"  width="100"scope="col"> Debet</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="100"scope="col">Kredit</th>' +
                    '  <th style="text-align:right;border-width:0px;" align="right" width="100" scope="col">Beløp</th>' +
                    '  <th scope="col"  align="left" width="250" scope="col">Tekst</th>' +
                    '  <th scope="col"  align="left" width="600" scope="col">Kontoinfo</th></tr>';
                if (obj.length > 0) {
                    for (j = 0; j < obj.length; j++) {
                        let info = obj[j]["kontoinfo"];
                        if (obj[j]["kontoinfo"].length > 60)
                            info = obj[j]["kontoinfo"].substring(0, 57) + '...';

                        let tekst = obj[j]["Tekst"];
                        if (obj[j]["Tekst"].length > 25)
                            tekst = obj[j]["Tekst"].substring(0, 22) + '...';

                        let dato = obj[j]["Dato"];
                        dato = dato.substring(8, 10) + '.' + dato.substring(5, 7) + '.' + dato.substring(0,
                            4);

                        msg2 += '<tr>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["ref"] + '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["bilagsart"] +
                            '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["Bilag"] + '</td>' +
                            ' <td style="text-align:center;border-width:0px;">' + dato + '</td>' +
                            ' <td style="text-align:right;border-width:0px;"><input type="text" id="debet' + obj[j]["ref"] + '" onchange="debet1(' + obj[j]["ref"] + ')" style=" width:115px; border-width:0px; direction: rtl;"  value='+ obj[j]["debet"] + '></td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["kredit"] +
                            '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["belop"] + '</td>' +
                            ' <td style="text-align:left;border-width:0px; padding-left: 10px;">' + tekst +
                            '</td>' +
                            ' <td style="text-align:left;border-width:0px;">' + info + '</td></tr>';
                        //     + ' <tr><td>Sum debet:</td><td>1111</td><td>Sum kredit:</td><td>22222</td></tr></table></form>';
                    };
                    console.log('bel',bel,formatter.format(bel));
                    msg2 +=
                        '<tr><td colspan="10">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>' +
                        // ' <tr><td><td></td></td><td></td><td align ="right">Sum :</td><td ><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel).substring(0, formatter.format(bel).length - 3) + '" </td>' +
                        // '<td style="border-width:0px; text-align:right;"><input style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_kredit" value="' + formatter.format(bel1).substring(0, formatter.format(bel1).length - 3) + '" ></td><td></td><td>Antall: ' + cnt + '  /  ' + cnt1 + '</td></tr>';
                       ' <tr><td><td></td></td><td></td><td align ="right">Sum :</td><td >' + formatter.format(bel) + ' </td>' +
                        '<td style="border-width:0px; text-align:right;">' + formatter.format(bel1) + '</td><td></td><td>Antall: ' + cnt + '  /  ' + cnt1 + '</td></tr>';

                };
                console.log(formatter.format(dd1));
                document.getElementById("rr2").innerHTML = msg1 + msg2 + '</table></form>';
                document.getElementById("id_sum_debet").value = formatter.format(dd1).substring(0, formatter.format(bel).length - 3);
                document.getElementById("id_sum_kredit").value = formatter.format(dd2).substring(0, formatter.format(dd2).length - 3);
        console.log('glob_offset slutt',glob_offset,m)
            }
        })
        // const p = await sjekk_trans();      


    }

    function debet1(d){
          const deb = document.getElementById("debet"+d).value;
        console.log('debet',d,deb);
    }

    
    function offs_prev() {
        const ant1 = document.getElementById('id_tekst').value;
        glob_offset = +glob_offset - +ant1;
        if (glob_offset < 0) glob_offset = 0;
        console.log("global offset: " + glob_offset);
        oppdat_bev();

    }

    function offs_forst() {
        const ant1 = document.getElementById('id_tekst').value;
        glob_offset = 0;
        if (glob_offset < 0) glob_offset = 0;
        console.log("global offs_forst: " + glob_offset);
        oppdat_bev();

    }

    function offs_sist() {
        const ant1 = document.getElementById('id_tekst').value;
        glob_offset = +glob_offset - +ant1;
        if (glob_offset < 0) glob_offset = 0;
        console.log("global offs_sist: " + glob_offset);
        oppdat_bev();

    }


    async function debet_oppdat_bev(kto1, ar1, per1) {
        console.log('debet_oppdat_bev');
        let tekst = [];
        let obj = '';
        let bb = 8266.05;
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                data: ({
                    mode: "debet_oppdat_bev",
                    kto: kto1,
                    ar: ar1,
                    per: per1
                }),
                cache: false,
                error: function (error) {
                    reject(error);
                },
                success: function (tekst) {
                    console.log('debet tekst: ' + tekst);
                    let obj = JSON.parse(tekst);
                    console.log(obj);
                    console.log('debet obj.ss: ' + obj.ss + '  ' + obj.cnt);
                    resolve(obj);
                }
            })
        })
    }




    async function kredit_oppdat_bev(kto1, ar1, per1) {
        console.log('debet_oppdat_bev');
        let tekst = [];
        let obj = '';
        let bb = 8266.05;
        return new Promise((resolve, reject) => {
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                data: ({
                    mode: "kredit_oppdat_bev",
                    kto: kto1,
                    ar: ar1,
                    per: per1
                }),
                cache: false,
                error: function (error) {
                    reject(error);
                },
                success: function (tekst) {
                    console.log('kredit tekst: ' + tekst);
                    let obj = JSON.parse(tekst);
                    console.log('kredit obj.ss: ' + obj.ss);
                    resolve(obj);
                }
            })
        })
    }





    async function oppdat_bev() {

        const kto1 = document.getElementById('id_kto').value;
        const per1 = document.getElementById('id_per').value;
        const ar1 = document.getElementById('id_ar').value;
        const sort1 = document.getElementById('id_sort').value;
        const rekke1 = document.getElementById('id_rekke').value;
        const ant1 = document.getElementById('id_tekst').value;
        const offset1 = glob_offset;

        const dd1 = await debet_oppdat_bev(kto1, ar1, per1);
        const bel = dd1.ss;
        const cnt = dd1.cnt;
        const dd2 = await kredit_oppdat_bev(kto1, ar1, per1);
        console.log('dd2: ', dd2, offset1);
        const bel1 = dd2.ss;
        const cnt1 = dd2.cnt;

        console.log('await: ', dd1, bel, cnt, dd2);

        //         console.log('kto ' + kto1 + ' per ' + per1 + ' ar ' + ar1 + ' sort ' + sort1 + ' rekke ' + rekke1);

        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "oppdat_bev",
                kto: kto1,
                ar: ar1,
                per: per1,
                sort: sort1,
                rekke: rekke1,
                ant: ant1,
                offset: offset1
            }),
            cache: false,
            success: function (tekst) {
                console.log('tekst oppfset: ', offset1, glob_offset);
                //   console.log('tekst: ' + tekst);
                //    return;
                let obj = JSON.parse(tekst);
                console.log(obj);
                // console.log(obj[1]);
                console.log(" obj.length;" + obj.length);
                // for (let j=0;j<obj.length;j++)
                // console.log('obj '+j+' : '+obj[j]["Dato"]);
                // let msg = "<table><tr><td>ref</td></tr></table";
                // //   let msg1 = "";
                let msg2 = "";
                let j = 0;
                let msg1 =
                    '<form action="" method="get"><table border="0" cellspacing="2" cellpadding="2">  <tr  style="height:15px;"></tr><tr>' +
                    '  <th style="text-align:right;border-width:0px;" width="10" scope="col">Ref</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="3" scope="col">Art</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="10" scope="col">Bilag</th>' +
                    '  <th style="text-align:center;border-width:0px;" width="100" scope="col">Dato</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="100"scope="col">Debet</th>' +
                    '  <th style="text-align:right;border-width:0px;" width="100"scope="col">Kredit</th>' +
                    '  <th style="text-align:right;border-width:0px;" align="right" width="100" scope="col">Beløp</th>' +
                    '  <th scope="col"  align="left" width="250" scope="col">Tekst</th>' +
                    '  <th scope="col"  align="left" width="600" scope="col">Kontoinfo</th></tr>';
                if (obj.length > 0) {
                    for (j = 0; j < obj.length; j++) {
                        let info = obj[j]["kontoinfo"];
                        if (obj[j]["kontoinfo"].length > 60)
                            info = obj[j]["kontoinfo"].substring(0, 57) + '...';

                        let tekst = obj[j]["Tekst"];
                        if (obj[j]["Tekst"].length > 25)
                            tekst = obj[j]["Tekst"].substring(0, 22) + '...';

                        let dato = obj[j]["Dato"];
                        dato = dato.substring(8, 10) + '.' + dato.substring(5, 7) + '.' + dato.substring(0,
                            4);

                        msg2 += '<tr>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["ref"] + '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["bilagsart"] +
                            '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["Bilag"] + '</td>' +
                            ' <td style="text-align:center;border-width:0px;">' + dato + '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["debet"] + '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["kredit"] +
                            '</td>' +
                            ' <td style="text-align:right;border-width:0px;">' + obj[j]["belop"] + '</td>' +
                            ' <td style="text-align:left;border-width:0px; padding-left: 10px;">' + tekst +
                            '</td>' +
                            ' <td style="text-align:left;border-width:0px;">' + info + '</td></tr>';
                        //     + ' <tr><td>Sum debet:</td><td>1111</td><td>Sum kredit:</td><td>22222</td></tr></table></form>';
                    };
                    msg2 +=
                        '<tr><td colspan="10">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>' +
                        ' <tr><td><td></td></td><td></td><td align ="right">Sum :</td><td ><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel).substring(0, formatter.format(bel).length - 3) + '" </td>' +
                        '<td style="border-width:0px; text-align:right;"><input style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_kredit" value="' + formatter.format(bel1).substring(0, formatter.format(bel1).length - 3) + '" ></td><td></td><td>Antall: ' + cnt + '  /  ' + cnt1 + '</td></tr>';
                };
                console.log(formatter.format(dd1));
                document.getElementById("rr2").innerHTML = msg1 + msg2 + '</table></form>';
                // document.getElementById("id_sum_debet").value = formatter.format(dd1).substring(0, formatter.format(bel).length - 3);
                // document.getElementById("id_sum_kredit").value = formatter.format(dd2).substring(0, formatter.format(dd2).length - 3);
            }
        })
        // const p = await sjekk_trans();

    }

    function offs_next() {
        const ant1 = document.getElementById('id_tekst').value;
        glob_offset = +glob_offset + ant1;
        var offs_bk = glob_offset;
        console.log("global offset: ", glob_offset, ant1);
        oppdat_bev();
        console.log("global offset: ", glob_offset, ant1, offs_bk);
        glob_offset = offs_bk;
    }

    function test666() {
        //     jQuery.ajax({
        //         type: "GET",
        //         url: "/components/com_regn/views/ajax/ajax.php",
        //         url: "http://localhost/index.php/konto?view=Konto&task=ajax",
        //       //  url: "index.php?option=com_regnt&task=controller.ajax",
        //         //            url: '"modules/com_regn/ajax.php",               //option=com_regn&view=ajax',
        //         data: { action: 'gesamt' },
        //         cache: false,
        //         success:{ }

        //     })
        // }
        var id = "kk";
        var name = "fff";
        var similar_id = "kkl";
        console.log("teset");

        $.ajax({
            type: "POST",
            //   url: "/components/com_regn/views/ajax/ajax.php",
            url: "index.php/?option=com_regn&task=abc",
            data: {
                mode: "oppdat_bev",
                id: id,
                name: name,
                similar_id: similar_id,
            },
            cache: false,
            success: function (tekst) {
                console.log("result");
                console.log(tekst);
            }
        })
    };

    //     $(".close").click(function () {
    //         $("#votebox").slideUp("slow");
    //     });

    // });





    function test66() {
        console.log('test66');

        // $(document).ready(function () {
        //   $('#myButton').click(function () {
        $.ajax({
            url: 'components/com_regn/ajax.php',
            type: 'POST',
            dataType: 'json',
            data: {
                action: 'getData'
            },
            success: function (response) {

                console.log("response");
                console.log(response);
                //     if (response.status === 'success') {
                //       $('#result').html('<p>Data: ' + JSON.stringify(response.data) + '</p>');
                //     } else {
                //       $('#result').html('<p>Error: ' + response.message + '</p>');
                //     }
                //   },
                //   error: function () {
                //     $('#result').html('<p>An error occurred</p>');


            }
        });
        //   });
        //   });
    }
</script>