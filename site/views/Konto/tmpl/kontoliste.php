<?php



function kontoliste5($mode1)
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

        <select id="dropdown3" name="mode" style="height:30px;" onchange="selectOption1()">
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

            <div id="rr1"></div>
            <?php


}
?>
        <script>

            function resmal(id) {
                //                                     function selectOption1() {
                console.log('resmal');
                return new Promise((resolve, reject) => {
                    $.ajax({
                        type: "POST",
                        url: "/components/com_regn/views/Registrering/tmpl/update.php",
                        //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                        data: ({
                            mode: "resmal",
                            id: 'R'
                        }),
                        cache: false,
                        error: function (error) {
                            reject(error);
                        },
                        success: function (tekst) {
                            obj5 = JSON.parse(tekst);
                            resolve(obj5);
                        }

                    })
                })
            }

            async function resultat() {

                const p = await resmal("R");
                const v = await resultat1(p);
                console.log('resultat ' + v);

            }


            function oppdater_kto(id) {
                console.log('oppdater_kto1 id :' + id);
                var kto1 = id;
                console.log('id :' + id);
               console.log("navn"+id);
                var navn1 = document.getElementById("navn"+id).value;
                var rapportlinje = document.getElementById("rap"+id).value;
                console.log('navn :' + navn1);
               console.log('rapportlinje :' + rapportlinje);

                // document.getElementById('navn' + id).value = "hhhhhhhhhhh";

                // var rapportlinje1 = document.getElementById('3' + id).value;
                // console.log('rapportlinje :' + rapportlinje1);
                // var resbal1 = document.getElementById('3' + id).value;
                // console.log('idA :' + id + ' kto:' + kto1 + ' navn:' + navn1 + ' rapportlinje:' + rapportlinje1 + ' resbal:' + resbal1);



                jQuery.ajax({
                    type: "POST",
                    url: "/components/com_regn/views/Registrering/tmpl/update.php",
                    //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                    data: ({
                        mode: "konto_oppdat",
                        kto: kto1,
                        navn: navn1,
                        rapportlinje: rapportlinje
                    }),
                    cache: false,
                    success: function (tekst) {
                        console.log(tekst);
                    }
                });
            }

            function selectOption1() {
                console.log('selectOption1');
                var mode = document.getElementById('dropdown3').value;
                //         var  dd = document.getElementById("navn3010").value;
                //      console.log('Navn: '+dd);
                document.getElementById('rr1').innerHTML = mode;
                if (mode == 'Kontantflyt') kontant()
                else if (mode == 'Resultat') resultat();
            }

            // function resultat1() {
            //     console.log("resultat");
            //     document.getElementById('rr1').innerHTML = 'kontantflytttt';
            //     console.log('kontantflytttt');
            // }

            function resultat1(obj5) {
                document.getElementById('rr1').innerHTML = 'Resultat4';

                jQuery.ajax({
                    type: "POST",
                    url: "/components/com_regn/views/Registrering/tmpl/update.php",
                    //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                    data: ({
                        mode: "ktosok",
                        ktosok1: 0
                    }),
                    cache: false,
                    error: console.log("error"),
                    success: function (tekst) {
                        let obj4 = JSON.parse(tekst);
                        var h = '<form><table><tr><td><input type="text id="444" value="444"></td></tr>';

                        //console.log('navn: '+   "navn ' +  obj4[i].Ktonr +'"');
                        for (let i = 0; i < obj4.length; i++) {
                            h = h + '<tr><td><input type="text" value="' + obj4[i].Ktonr + '" style="text-align:right; border-width:0px;  width:100px; padding: 0px 10px 0px 0px;" id=""></td>';
                            h = h + '<td><input type="text"  onchange="oppdater_kto(' + obj4[i].Ktonr + ')"  id="navn' + obj4[i].Ktonr + '" value = "' + obj4[i].Navn + '" style = "text-align:left; border-width:0px;  width:250px; padding: 0px 10px 0px 0px;" id = "" ></td > ';
                            //      h = h + '<td><input type="text" value="' + obj4[i].rapportlinje + '" style="text-align:right; border-width:0px;  width:20px; padding: 0px 10px 0px 0px;" id=""></td>';

                            h = h + ' <td class="dropdown">' +
                                '  <select style=" border-width:0px; background-color:white" name="nr" id="rap' + obj4[i].Ktonr + '" onchange="oppdater_kto(' + obj4[i].Ktonr + ')" value="' + obj4[i].rapportlinje + ')">';
                            for (let j = 0; j < obj5.length; j++) {
                                h = h + ' <option value="' + obj5[j].nr + '"';
                                if (obj4[i].rapportlinje == obj5[j].nr)
                                    h = h + ' selected'; //and $messages1->BR==$message->ResBal
                                h = h + '>' + obj5[j].nr + ' ' + obj5[j].tekst + '</option>';
                            };
                            h = h + '</select></td>';

                            // h = h + '<td><input type="text" value="' + obj4[i].tekst + '" style="text-align:left; border-width:0px;  width:200px; padding: 0px 10px 0px 0px;" id=""></td>';
                            // h = h + '<td><input type="text" value="' + obj4[i].ResBal + '" style="text-align:right; border-width:0px;  width:20px; padding: 0px 10px 0px 0px;" id=""></td></tr>';
                        }
                        h = h + '</tr></table></form>';
                        document.getElementById('rr1').innerHTML = h;
                        //                console.log('value: ' + document.getElementById("444").value);   
                    }

                })

            }
        </script>