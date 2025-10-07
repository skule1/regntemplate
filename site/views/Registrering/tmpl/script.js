{/* <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript"> */}


    var slettknapp_id = 0;


    //var WshShell = new ActiveXObject("WScript.Shell");
    //var value = WshShell.RegRead("HKEY_CURRENT_USER\\SOFTWARE\\Skule Sormo\\regnIV\\regnskapsar");
    //alert("regnskapsar " + value);
    //alert(1);
    list_art1();
    // alert(2);
    document.getElementById(1).focus();
    //  alert(3);
    //console.log("start list_art");

    //f_hent_siste_trans();
    //  document.getElementById("p1").innerHTML = "New text!";

    //    const element = document.getElementById("jsonobj");
    //  element.innerHTML = "The New JavaScript Heading";


    function f_ref(v) {

        document.getElementById("btn_slett").disabled = false;
        //     console.log('f_ref ref ' + v);
        slettknapp_id = v;
    }

    function slett() {
        //    const id = await idclick();
        //console.log("slett1 " + slettknapp_id);

        // #__regn_bilagsarter?  return;
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=registrering.slett",
            data: ({
                id: slettknapp_id
            }),
            cache: false,
            success: function (response) {
                //                    console.log(response);
                document.getElementById("btn_slett").disabled = true;
                location.reload();
                //      alert("Siste post ble slettet.");
            }
        });

    }


    function sjekk_bokstaver(inp) {
        var b = true;
        if (inp.length < 3)
            return false;
        b = inp[0].toLowerCase() != inp[0].toUpperCase();
        b = inp[1].toLowerCase() != inp[1].toUpperCase();
        b = inp[2].toLowerCase() != inp[2].toUpperCase();

        return b;
    }

    function endre_ar() {
        //        console.log("endre_ar ");
        let ar = document.getElementById("valg_ar").value;
        document.cookie = "regnskapsar=" + ar;
        const currentUrl = window.location.href;
        let pos = currentUrl.indexOf("&regnskapsar");
        if (pos == -1) {
            //           console.log('url: ' + currentUrl + "&regnskapsar=" + ar);
            location.replace(currentUrl + "&regnskapsar=" + ar)
        } else {
            //           console.log(currentUrl.substring(0, i));
            location.replace(currentUrl + "&regnskapsar=" + ar)
        }
    }

    function f_modus(i) {
        const currentUrl = window.location.href;
        //    console.log(currentUrl + "  modus: " + i);
        let pos = currentUrl.indexOf("&modus");
        let modus = document.getElementById("modus").value;
        //   console.log('pos: ' + pos + '  modus: ' + modus);
        if (pos == -1) {
            //      console.log('url: ' + currentUrl + "&modus=" + modus);
            location.replace(currentUrl + "&modus=" + modus);
        } else {
            //      console.log(currentUrl.substring(0, i));
            location.replace(currentUrl + "&modus=" + modus)
        }



    }

    function updatefield1(id1) {
        console.log("updatefield1 " + id1);
    }

    function updatefield(id1) {
        console.log("updatefield: ", id1);
        //  document.getElementById("button"+id1).style.display =  "none"  ;//      "inline-block";
        document.getElementById("button" + id1).style.display = "none";
        ref = id1;
        //     var ref = document.getElementById(id1).value;
        var bilagsart = document.getElementById('bilagsart' + id1).value;
        //   var bilag = document.getElementById('bilag' + id1).value;
        var dato = document.getElementById('dato' + id1).value;
        var debet = document.getElementById('debet' + id1).value;
        var kredit = document.getElementById('kredit' + id1).value;
        var belop = document.getElementById('belop' + id1).value;
        var tekst1 = document.getElementById('tekst' + id1).value;
        console.log(bilagsart);
        console.log(dato);
        console.log(debet);
        console.log(kredit);

        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "updatefield",
                ref: ref,
                //           bilag: bilag,
                bilagsart: bilagsart,
                dato: dato,
                debet: debet,
                kredit: kredit,
                belop: belop.replace(',', '.'),
                tekst: tekst1
            }),
            cache: false,
            success: function (tekst) {
                //                  console.log('updatefield tekst: ' + tekst);
                //   location.reload();
            }
        })
        window.location.reload();
    }

    function belop(mode) {

        var kto = document.getElementById(5).value;
        var dato = document.getElementById(id_dato).value;
        var ent = event.key;
        var b = false;
        console.log("belop: " + kto + ' ent: ' + ent + ' dato: ' + dato + ' modus: ' + mode);

        //  kto = kto + ent;
        //       console.log('belop1: ' + kto + ' substring: ' + kto.substring(0, 3));
        if (sjekk_bokstaver(kto.substring(0, 3))) mode = 'valuta';
        else mode = 'standard';
        //if (ent == 'Enter')
        //       console.log('belop2: ' + kto+ ' (kto.length == 3): '+(kto.length == 3)+' sjekk_bokstaver(kto):'+sjekk_bokstaver(kto)
        //      +' ((kto.length == 3) &&  sjekk_bokstaver(kto)): '+((kto.length == 3) &&  sjekk_bokstaver(kto)));
        b = ((kto.length == 3) && sjekk_bokstaver(kto.substring(0, 3)))
        if (b == true) {
            //          console.log('belop3: ' + kto.substring(0, 3).toUpperCase());
            kto = kto.substring(0, 3).toUpperCase(); // + kto.substring(5);
            fra = kto.substring(0, 3).toUpperCase(); // + kto.substring(5);
            //           console.log('fra ' + fra);
            document.getElementById(5).value = kto + ' ';

        }

        if (ent != 'Enter')
            kto = kto + ent;
        var bel1 = kto.substring(4);
        var bel = 100;
        /*
              var bel= <?php $fra = '+fra+';
              echo currency($fra, 'NOK'); ?>;//kto.substring(4);
        //    console.log('belop3a: ' + bel + ' : ' + bel1);
        bel = bel * bel1;
        //   console.log('belop3b: ' + bel);
        */
        //   console.log(kto + ' ent: ' + ent + ' mode: ' + mode);
        if (ent == 'Enter') {
            if (mode == 'valuta') {
            //       console.log('retur videre..');
            //bel1=bel1.replace(',','.');
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                data: ({
                    mode: "currency",
                    inn: fra,
                    ut: 'NOK',
                    belop: bel1.replace(',', '.')
                }),
                cache: false,
                success: function (tekst) {
                    //    console.log('tekst currency: ' + tekst + " kto: " + kto);
                    bel = tekst;
                    document.getElementById(5).value = bel; //.replace('.',',');
                    //    console.log('enter');
                    //    console.log('belop7: '+bel);
                    //  document.getElementById(5).value=bel;
                    //  document.getElementById(5).value=kto.substring(4);
                    document.getElementById("val").value = kto;
                    document.getElementById("val").style.textAlign = "right";
                }
            });

            }
        document.getElementById(5).style.textAlign = "right";
        document.getElementById(id_tekst).focus();
            //console.log(document.getElementById(5).value);
        }

    }

        function f_hent_siste_trans(diff) {
            //      console.log("f_hent_siste_trans");
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                data: ({
                    mode: "sistetrans"
                }),
                cache: false,
                success: function (tekst) {
                    //console.log(tekst);
                    let obj4 = JSON.parse(tekst);
                    // console.log(tekst);
                    // console.log(obj4[0]);
                    // console.log(obj4[0].debet);
                    document.getElementById("2").value = obj4[0].Dato;
                    //document.getElementById("3").value=obj4[0].debet;
                    document.getElementById("4").value = obj4[0].kredit;
                    document.getElementById("5").value = obj4[0].belop;
                    document.getElementById("6").value = obj4[0].tekst;
                    document.getElementById("4").focus();
                }
            })
        }

    // f_hent_siste_trans();

        async function hent_kto1(kto, i) { // henter ktoinfo ved  å klikke på liste
            console.log('hent_kto1');
        var dato = document.getElementById(id_dato).value;
        console.log('dato1 |', dato, '|');
        dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);
        const date = new Date(dato);
        const year = date.getFullYear();
        const month = date.getMonth() + 1;

        if (dato > '')
        dato = dato.substring(6, 10) + '-' + dato.substring(3, 5) + '-' + dato.substring(0, 2);
        console.log('dato2 ', dato, month, date);
        var eventkey = event.key;
        let nokpenger = new Intl.NumberFormat('no-NB', {
            style: 'currency',
        currency: 'NOK',
        });
        // console.log("debet hent_kto1  " + i + ' : ' + kto + ' : ' + dato + ' enterkey: ' + eventkey);
        return new Promise((resolve, reject) => {
            $.ajax({
                //      jQuery.ajax({
                type: "POST",
                url: "index.php?option=com_regn&task=registrering.finn_kto",
                //               url: "/components/com_regn/views/Registrering/tmpl/update.php",
                //                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                data: ({
                    mode: "ktoinfo",
                    kto: kto,
                    ar: year,
                    per: month
                    ///   dato: dato
                }),
                cache: false,
                success: function (tekst) {
                    console.log('tekst hent_kto1: ' + tekst);

                }
            })

        })
    }

        function hent_kkto1(kto, i) {
        //         console.log("kredit hent_kkto1  " + kto + '  ' + i);
        var dato = document.getElementById("2").value;
        var dato = document.getElementById(id_dato).value;
        // console.log('dato1 ', dato);
        dato = dato.substring(6, 10) + '-' + dato.substring(3, 5) + '-' + dato.substring(0, 2);
        // console.log('dato2 ', dato);

        let nokpenger = new Intl.NumberFormat('no-NB', {
            style: 'currency',
        currency: 'NOK',
        });



        return new Promise((resolve, reject) => {
            $.ajax({
                //     jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                data: ({
                    mode: "ktoinfo",
                    kto: kto,
                    dato: dato
                }),
                cache: false,
                success: function (tekst) {


                }
            })
        })
    }

        function hent_kto(arg) {

            console.log('start hent_kto');

        var dato = document.getElementById(2).value;
        dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);
        const date = new Date(dato);
        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        let nokpenger = new Intl.NumberFormat('no-NB', {
            style: 'currency',
        currency: 'NOK',
        });
        console.log('dato: ', dato, year, month);
        kto = arg;
        jQuery.ajax({
            type: "POST",
        url: "index.php?option=com_regn&task=registrering.finn_kto",
        data: ({
            kto: kto,
        per: month,
        ar: year
            }),
        cache: false,
        success: function (tekst) {
            console.log('retur: |', tekst, '!');
        let gg =
        '<table style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Tekst</th><th style="text-align:left; width:150px; ">Info</th></tr><tr>';
            if (tekst) {
                obj2 = JSON.parse(tekst);
            if (isJsonArray(tekst)) {
                gg = gg +
                '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>';
                    } else {
                let disp = obj2.budsjett - obj2.belop;
            //          document.getElementById("id_debet").value=obj2.Ktonr;

            console.log(1, obj2.Ktonr);
            disp = new Intl.NumberFormat('nb-NO', {
                style: 'currency',
            currency: 'NOK'
                        }).format(disp);
            const budsjett = new Intl.NumberFormat('nb-NO', {
                style: 'currency',
            currency: 'NOK'
                        }).format(obj2.budsjett);
            const hittil = new Intl.NumberFormat('nb-NO', {
                style: 'currency',
            currency: 'NOK'
                        }).format(obj2.hittil);

                        // gg = gg + '<tr><td style="text-align:right; border-width:0px; width:100px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td style="text-align:right;">' +
                        //     budsjett + '</td></tr>' +
                        //     '<td style="text-align:right; border-width:0px; width:100px; padding: 0px 10px 0px 0px;">Hittil: </td><td style="text-align:right; ">' +
                        //     hittil + '</td></td>' +
                        //     '<tr><td style="text-align:right; border-width:0px;  width:100px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                        //     '<td style="text-align:right;">' + disp + '</td></tr></table>';

        if (obj2.belop)
        gg = gg +
        '<tr> <td > A <input type="text" style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                                'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
            ' <td > <input type="text" style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                                'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>' +
        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Brukt periode: </td>' +
            '<td style="text-align:right;" >' + nokpenger.format(obj2.belop) +
                '</td></tr>' +
                                //`(new Intl.NumberFormat('no-NB').format(obj3.belop))+  '</td></tr > ' + //+ obj3.belop.toLocaleString('no - NB', { style: 'currency', currency: 'NOK',})+ '</td ></tr > ' +
'<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett periode: </td>' +
    '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett) +
    '</td></tr>' +
    '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Hittil Budsjett: </td>' +
    '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett_hittil) +
    '</td></tr>' +
    '<tr><td style="text-align:right; border-width:00px; padding: 0px 10px 0px 0px;">Hittil brukt: </td>' +
    '<td style="text-align:right;">' + nokpenger.format(obj2.hittil) +
    '</td></tr>' +
    '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
    '<td style="text-align:right;">' + nokpenger.format((obj2.budsjett_hittil) - (obj2.hittil)) + '</td></tr></table>';
                        else
gg = gg +
    '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
    'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
    'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>';

                    }
gg = gg + '</table>';
document.getElementById("db").innerHTML = gg;
                }
            }
        })

console.log('start2 hent_kto');
//       ElementById(4).value;
//   console.log('kredit: ', k);
if (document.getElementById(id_kredit).value == '')
    finn_kkto(0);
console.log('start3 hent_kto');
document.getElementById(id_debet).value = kto;
document.getElementById(id_kredit).focus();
    }




function hent_kkto(kto) {
    //   var art = document.getElementById(1).value;
    let nokpenger = new Intl.NumberFormat('no-NB', {
        style: 'currency',
        currency: 'NOK',
    });
    //  let kto = document.getElementById(id_kredit).value;
    console.log('hent_kkto ', kto,);
    var dato = document.getElementById(2).value;


    let date = 0;
    let year = 0;
    let month = 0;

    // if ((dato > '') && (dato != '..')) {
    //     dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);
    //     date = new Date(dato);
    //     year = date.getFullYear();
    //     month = date.getMonth() + 1;
    // }
    day = dato.substring(0, 2);
    month = dato.substring(3, 5);
    year = dato.substring(6.9);

    // const date = 0;
    // const year = 0;
    // const month = 0;

    // if ((dato > '') && (dato != '..')) {
    //     if (dato[2] == ".")
    //         dato = dato.substring(6, 10) + '-' + dato.substring(3, 5) + '-' + dato.substring(0, 2);
    //         const  date2 = new Date(dato); // YYYY-MM-DD format
    //     const year2 = date2.getFullYear(); // Get the year
    //     const month2 = date2.getMonth() + 1; // Get the month (0-based, so add 1)
    //     const day2 = date2.getDate(); // Get the day
    // }

    // year=year2;
    // month=month2;

    console.log('dato: ', dato, year, month);
    // console.log('hent_kto: ' + arg);
    //  kto = arg;
    jQuery.ajax({
        type: "POST",
        url: "index.php?option=com_regn&task=registrering.finn_kto",
        data: ({
            kto: kto,
            per: month,
            ar: year
        }),
        cache: false,
        success: function (tekst) {
            console.log(tekst);
            obj2 = JSON.parse(tekst);

            if (isJsonArray(tekst)) {
                gg = gg +
                    '<tr> <td ><input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                    'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                    'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>';
            } else {

                //   console.log('tekst', tekst);
                obj2 = JSON.parse(tekst);
                let disp = obj2.belop - obj2.budsjett;
                disp = new Intl.NumberFormat('nb-NO', {
                    style: 'currency',
                    currency: 'NOK'
                }).format(disp);
                const budsjett = new Intl.NumberFormat('nb-NO', {
                    style: 'currency',
                    currency: 'NOK'
                }).format(obj2.budsjett);
                const hittil = new Intl.NumberFormat('nb-NO', {
                    style: 'currency',
                    currency: 'NOK'
                }).format(obj2.hittil);

                var gg = '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Kredit</th><th style="text-align:left; width:100px; ">Navn</th></tr><tr>';
                //  onkeydown = "hent_kto(id)"

                if (obj2.belop)
                    gg = gg + '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                        'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                        'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Brukt periode: </td>' +
                        '<td  style="text-align:right;" >' + nokpenger.format(obj2.belop) +
                        '</td></tr>' +
                        //`(new Intl.NumberFormat('no-NB').format(obj3.belop))+  '</td></tr>' + //+ obj3.belop.toLocaleString('no-NB', { style: 'currency', currency: 'NOK',})+ '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett periode: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett) +
                        '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Hittil Budsjett: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett_hittil) +
                        '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:00px; padding: 0px 10px 0px 0px;">Hittil brukt: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format(obj2.hittil) +
                        '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format((obj2.budsjett_hittil) - (obj2.hittil)) + '</td></tr></table>';
                else
                    gg = gg +
                        '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                        'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px; padding: 0px 10px 0px 0px;" ' +
                        'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>';
            }
            gg = gg + '</table>';
            console.log('KKTO RET: ', gg);
            //   console.log(gg);
            document.getElementById("kr").innerHTML = gg;
            console.log('kreditkto: ', document.getElementById(id_kredit).value);
            document.getElementById(id_kredit).value = obj2.Ktonr;
        }
    })

    document.getElementById(id_belop).focus();
}


function hent_kkto_bk($i) {
    //   var art = document.getElementById(1).value;
    //          console.log('hent_kkto: ' + $i);
    document.getElementById(id_kredit).value = $i;
    //       document.getElementById("333").innerHTML = "";
    //  document.getElementById("2infokto").value = obj2.Navn;
    //  document.getElementById("2info").value = obj2.Navn;
    document.getElementById("kbudsjett").innerHTML = "Budsjett:";
    document.getElementById("khittil").innerHTML = "Hittil i år:";
    document.getElementById("kisponibekt").innerHTML = "Disponibelt";

    document.getElementById(id_tekst).focus();
}

function sjekk_trans(id) {
    //                                     function selectOption1() {
    //           console.log('sjekk_trans');
    var dato = document.getElementById(2).value;
    var belop = document.getElementById(5).value;
    //    console.log('sjekk_trans '+dato+'   '+belop );

    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "sjekk_trans",
                dato: dato,
                belop: belop
            }),
            cache: false,
            error: function (error) {
                reject(error);
            },
            success: function (tekst) {
                //          console.log('sjekk_trans tekst1: '+tekst);
                if (tekst == 'ukjent')
                    resolve(tekst)
                else {
                    const obj5 = JSON.parse(tekst);
                    //     console.log('trans obj '+obj5.length);
                    //           console.log(obj5);
                    resolve(obj5);
                }
            }

        })
    })
}

function sjekk_hist(id) {
    //                                     function selectOption1() {
    //             console.log('sjekk_trans');
    var dato = document.getElementById(2).value;
    var belop = document.getElementById(5).value;
    //  console.log('sjekk_trans '+dato+'   '+belop );

    return new Promise((resolve, reject) => {
        $.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "sjekk_hist",
                dato: dato,
                belop: belop
            }),
            cache: false,
            error: function (error) {
                reject(error);
            },
            success: function (tekst) {
                //            console.log('sjekk_hist tekst: '+tekst);
                if (tekst == 'ukjent')
                    resolve(tekst)
                else {
                    obj5 = JSON.parse(tekst);
                    resolve(obj5);
                }


            }

        })
    })
}

async function UpdateRecord2(ref, bilagsnr, buntnr, mode) {
    //        async function resultat() {
    //             console.log('UpdateRecord: ');



    const p = await sjekk_trans();
    //           console.log('p: '+p);
    const v = await sjekk_hist();
    //     console.log('v: '+v);
    //    console.log('resultat ' + v);
    if (p == 'ukjent' && v == 'ukjent') {
        // console.log('kaller updatrecord ' + ref + ' ' + bilagsnr + '  ' + buntnr + '  ' + mode);
        //              const u= await UpdateRecord1(ref, bilagsnr, buntnr, mode);
    }
}

function getMessage(p) {
    //              console.log('getMessage '+p[1].Ref);
    var text = "Here your great content of myArray:\n";
    for (var i = 0; i < p.length; i++) {
        text += p[i].Ref + "\n";
    }
}

async function UpdateRecord(ref, bilagsnr, buntnr, mode) {
    console.log("updateRecord " + ref + " :" + bilagsnr + " :" + buntnr + " :" + mode);
    // console.log("envent key: " + event.key);
    if (event.key != 'Enter')


        var ref = document.getElementById("ref").value
    let vv = document.getElementById(id_tekst).value;
    const eventkey = event.key;
    // console.log("UpdateRecord |" + vv + "| event key:|" + event.key + "| ref:|" + ref + "|");

    // if ((vv == '') && (event.key == 'Enter')) {
    //     const f = await hent_forrige(ref - 1);
    //     console.log('f');
    //     console.log(f);
    //     console.log(f[0].tekst);
    //     document.getElementById(6).value = f[0].tekst;
    //     //     document.getElementById(5).focus();
    //     //    return;
    // }

    var dato = document.getElementById(id_dato).value;
    // console.log('updaterecord dato: ', dato);
    var art = document.getElementById(1).value;

    var debet = document.getElementById(3).value;
    var kredit = document.getElementById(4).value;
    var belop = document.getElementById(5).value;
    // if (mode == 'valuta')
    var valuta = document.getElementById("val").value;
    //    else var valuta = 0;
    var tekst = document.getElementById(6).value;

    var v1 = event.key == 'Enter';
    // console.log('før dato: ', dato[0], dato[2], dato[4]);
    if (dato[2] == '-')
        dato = dato.substring(6, 10) + '-' + dato.substring(3, 5) + '-' + dato.substring(0, 2);
    // console.log('updaterecord dato: ', dato);


    if (event.key == 'Enter') {
        // console.log(tekst + '  ' + event.key + '   ' + v1);

        if (valuta == '') valuta = 0;
        //       console.log('val: ' + valuta);
        if (dato == '') {
            alert('feil i dato');
            document.getElementById(2).focus();
            return; //exit;
        }
        if (debet == '' && kredit == '') {
            alert('feil i konto');
            if (debet == '')
                document.getElementById(3).focus();
            else if (kredit == '')
                document.getElementById(4).focus();
            return;
        }
        if (belop == 0) {
            alert('feil i belop');
            document.getElementById(5).focus();
            return;
        }
        //console.log('dato1 '+dato);
        if ((dato[2] == "-") && (dato[5] == "-")) {
            var dato = dato.substring(6, 10) + "-" + dato.substring(3, 5) + "-" + dato.substring(0, 2);
        };
        //onsole.log('dato2 '+dato);
        //               alert("ggg " + dato[2] + " : " + dato[5]);
        //    alert("før oppdatering " + dato+ 'event.key: '+event.key);
        if (eventkey == 'Enter') {
            //              console.log("prossess..");


            const p = await sjekk_trans();
            //   console.log('p: '+p.length);
            const v = await sjekk_hist();
            //   console.log('v: ');
            //         console.log(v);

            //     console.log('# trans: '+p.length);
            //    console.log('# hist: '+v.length);
            //console.log('datopos: '+dato[4]+'  '+dato[7]);

            var text = '';
            if (p.length != 0) {
                text = p.length + ' poster finnes i transreg fra før \n';
                for (var i = 0; i < p.length; i++) {
                    text += p[i].Ref + '  ' + p[i].Dato + '  ' + p[i].belop + '  ' + p[i].bilag + "\n";
                };
            }

            if (v.length != 0) {
                text += v.length + ' poster finnes  i hist fra før \n';
                for (var i = 0; i < v.length; i++) {
                    text += v[i].ref + '  ' + v[i].Dato + '  ' + v[i].belop + '  ' + v[i].Bilag + "\n";
                };
            }

            if (v.length != 0 || p.length != 0)
                alert(text);

            //alert(+p.length+' poster finnes fra før \n'; for (let i=0;i<p.length;i++) {p[i].Ref+' Bilag: '+p[i].bilag+' Beløp: '+p.belop+' Dato: '+p.dato);




            jQuery.ajax({
                //                return new Promise((resolve, reject) => {
                //                 $.ajax({
                type: "POST",
                url: "index.php?option=com_regn&task=registrering.f_oppdater",
                //           url: "/components/com_regn/views/Registrering/tmpl/update.php",
                //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                data: ({
                    //        mode: "oppdater",
                    ref: ref,
                    bilagsnr: bilagsnr,
                    buntnr: buntnr,
                    art: art,
                    dato: dato,
                    debet: debet,
                    kredit: kredit,
                    belop: belop,
                    valuta: valuta,
                    tekst: tekst
                }),
                cache: false,
                success: function (tekst) {
                    //console.log('dato3: '+dato);
                    //    console.log('valuta: ' + valuta);
                    // console.log(tekst)
                    //               alert("stop");
                    //                  console.log("Record successfully updated ");
                    //  location.reload();
                    //   var obj2 = JSON.parse(tekst);
                    //     console.log(obj2);
                    //             console.log(tekst);
                    //             resolve(tekst);
                    //             alert("Record successfully updated" + tekst);
                }
            });


            location.reload();
        }
        //#__regn_kto?
        list_art();

        //     }

        document.getElementById(1).focus();
        //   alert("ferdig");

    }

}
/*
function displayCommits() {
    console.log("Start displayCommits..");
            try {
                const fart = await fart();
                console.log(fart);
            } catch (err) {
                console.log('Error', err.message);
            }
            console.log("End displayCommits..");
        }

        displayCommits();

obj1={};

*/

function oppdater_hist() {
    console.log('oppdater hist');
    jQuery.ajax({
        type: "POST",
        //    url: "/components/com_regn/views/Registrering/tmpl/update.php",
        url: "index.php?option=com_regn&task=registrering.oppdater_hist",
        data: ({
            mode: "oppdater_hist"
        }),
        cache: false,
        success: function (tekst) {
            //         console.log(tekst);
            //window.
            location.reload();
        }
    })
}





function isJsonString(str) {
    try {
        JSON.parse(str);
        return true;
    } catch (e) {
        return false;
    }
}


function isJsonArray(str) {
    try {
        const parsed = JSON.parse(str);
        return Array.isArray(parsed);
    } catch (e) {
        return false;
    }
}






async function finn_kto(i) { //i=0: onclick, i=1: onchange

    let gg = '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:100px; padding: 0px 10px 0px 0px;" >Debet</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';

    console.log("finn_kto " + i, event.key);
    if (event.key == "Enter") {
        // if (i==1) {
        if (document.getElementById(id_kredit).value == '')
            finn_kkto(1);
        document.getElementById(id_kredit).focus();
        return;
        //  }
    }
    var kto = document.getElementById(3).value;
    var dato = document.getElementById(2).value;
    console.log('hentet dato: |', dato, '|');


    var d = '0';
    var month = '0';
    var year = '0';
    var day = '0';

    // if (dato > '') {
    //     d = new Date();
    //     console.log(d,dato);
    //     d=dato;
    //     dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);
    day = dato.substring(0, 2);
    month = dato.substring(3, 5);
    year = dato.substring(6.9);
    //     console.log('dato5: ',dato);
    //     month = d.getMonth() + 1;
    //     day = d.getDate();
    //     year = d.getFullYear();
    //     if (month < 10) month = '0' + month;
    //     if (day < 10) day = '0' + day;
    //     dato = day + '.' + month + '.' + year;
    //     document.getElementById(2).value = dato;
    //     console.log('hentet dato: |', dato, '|');
    // }
    console.log('konv dato:|', dato, '|', year, '|', month, '|', day, '|');

    // dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);
    // const date = new Date(dato);
    // const year = date.getFullYear();
    // const month = date.getMonth() + 1;
    let nokpenger = new Intl.NumberFormat('no-NB', {
        style: 'currency',
        currency: 'NOK',
    });
    console.log('kto: |', kto, '|');
    if (event.key != undefined)
        kto = kto + event.key;
    var eventkey = event.key;
    // console.log('kto: ', kto);

    let sistepost = <? php echo $sistepost ?>;
    console.log('siste post: ', sistepost);


    if (((kto == '0') || (kto == ' ')) && (kto.length == 1)) {
        kto = sistepost['debet'];
        document.getElementById(3).value = kto;
    }

    console.log('dato: ', dato, year, month);
    if (i == 0) {
        document.getElementById(3).value = '';
        kto = '';
    }
    // if (kto === undefined)
    //     kto = '';
    // if (event.key === undefined)
    //     event.key = '';

    console.log('kto: ', kto, event.key);
    //    if (event.key == 'Enter')
    {
        console.log('kto enter: ', kto);

        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=registrering.finn_kto",
            data: ({
                kto: kto,
                per: month,
                ar: year
            }),
            cache: false,
            success: function (tekst) {
                //                        console.log('retur: |', tekst, '|');
                let gg =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Debet</th><th style="text-align:left; width:100px; ">Navn</th></tr><tr>';
                //    console.log(gg);
                if (tekst) {
                    const obj2 = JSON.parse(tekst);
                    console.log(obj2);
                    // gg = gg +
                    //     '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                    //     'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                    //     ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px; padding: 0px 10px 0px 0px;" ' +
                    //     'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>';

                    //      console.log(gg);
                    // if (!(obj2.budsjett == null)) {
                    if (isJsonArray(tekst)) {

                        for (let i = 0; i < obj2.length; i++) {
                            gg = gg +
                                '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                                'id="' + i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kto(' + obj2[i].Ktonr + ',' + i + ')"></td>' +
                                ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                                'id="' + i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kto(' + obj2[i].Ktonr + ')" ></td></tr>';

                        }
                    } else {
                        const obj2 = JSON.parse(tekst);
                        let disp = obj2.budsjett - obj2.belop;
                        console.log('disp: ', 'disp');
                        disp = new Intl.NumberFormat('nb-NO', {
                            style: 'currency',
                            currency: 'NOK'
                        }).format(disp);
                        const budsjett = new Intl.NumberFormat('nb-NO', {
                            style: 'currency',
                            currency: 'NOK'
                        }).format(obj2.budsjett);
                        const hittil = new Intl.NumberFormat('nb-NO', {
                            style: 'currency',
                            currency: 'NOK'
                        }).format(obj2.hittil);

                        console.log('obj2 single: ', obj2, obj2.belop);
                        if (obj2.belop)
                            gg = gg +
                                '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                                'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                                ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                                'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>' +
                                '<tr><td style="text-align:right; border-width:0px;width:100px  padding: 0px 10px 0px 0px;">Brukt periode: </td>' +
                                '<td  style="text-align:right;" >' + nokpenger.format(obj2.belop) +
                                '</td></tr>' +
                                //`(new Intl.NumberFormat('no-NB').format(obj3.belop))+  '</td></tr>' + //+ obj3.belop.toLocaleString('no-NB', { style: 'currency', currency: 'NOK',})+ '</td></tr>' +
                                '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett periode: </td>' +
                                '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett) +
                                '</td></tr>' +
                                '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Hittil Budsjett: </td>' +
                                '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett_hittil) +
                                '</td></tr>' +
                                '<tr><td style="text-align:right; border-width:00px; padding: 0px 10px 0px 0px;">Hittil brukt: </td>' +
                                '<td style="text-align:right;">' + nokpenger.format(obj2.hittil) +
                                '</td></tr>' +
                                '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                '<td style="text-align:right;">' + nokpenger.format((obj2.budsjett_hittil) - (obj2.hittil)) + '</td></tr></table>';
                        else
                            gg = gg +
                                '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                                'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kto(' + obj2.Ktonr + ')"></td>' +
                                ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px; padding: 0px 10px 0px 0px;" ' +
                                'id="kk" value="' + obj2.Navn + '" onclick="hent_kto(' + obj2.Ktonr + ')" ></td></tr>';


                        // gg = gg + '<tr><td style="text-align:right; border-width:0px; width:100px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td  style="text-align:right;">' +
                        //     budsjett + '</td></tr>' +
                        //     '<td style="text-align:right; border-width:0px; width:100px; padding: 0px 10px 0px 0px;">Hittil: </td><td  style="text-align:right; ">' +
                        //     hittil + '</td></td>' +
                        //     '<tr><td style="text-align:right; border-width:0px;  width:100px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                        //     '<td  style="text-align:right;">' + disp + '</td></tr></table>';

                        // }
                        // console.log('gg:', gg);

                        //        document.getElementById("db").innerHTML = gg;
                        // const amount = 1234567.89;
                        // const
                        //     //  formatted = new Intl.NumberFormat('en-US', {
                        //     //     style: 'currency',
                        //     //     currency: 'USD'
                        //     // }).format(amount);
                        //     formatted = new Intl.NumberFormat('nb-NO', {
                        //         style: 'currency',
                        //         currency: 'NOK'
                        //     }).format(amount);
                        // console.log(formatted); // Output: $1,234,567.89



                    }
                    gg = gg + '</table>';
                    //        document.getElementById("db").innerHTML = gg;
                    //      console.log(gg);
                    document.getElementById("db").innerHTML = gg;
                }
            }
        })
    }
}




async function finn_kkto(arg) { //i=0: onclick, i=1: onchange
    if (event.key == 'Enter') {
        document.getElementById(id_belop).focus();
        return;
    }
    console.log('start finn_kkto');
    if (arg == 0)
        document.getElementById(id_kredit).value = '';;
    var kto = document.getElementById(id_kredit).value;
    var dato = document.getElementById(2).value;
    //    dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);

    var d = '0';
    var month = '0';
    var year = '0';
    var day = '0';

    // if ((dato > '') && (dato != '..')) {
    //     d = new Date();
    //     dato = dato.substring(3, 5) + '.' + dato.substring(0, 2) + '.' + dato.substring(6.9);
    //     month = d.getMonth() + 1;
    //     day = d.getDate();
    //     year = d.getFullYear();
    //     if (month < 10) month = '0' + month;
    //     if (day < 10) day = '0' + day;
    //     dato = day + '.' + month + '.' + year;
    //     document.getElementById(2).value = dato;
    //     console.log('hentet dato: |', dato, '|');
    // }


    month = dato.substring(3, 5)
    day = dato.substring(0, 2)
    year = dato.substring(6.9)

    console.log('dato: ', dato, year, month, kto);
    let nokpenger = new Intl.NumberFormat('no-NB', {
        style: 'currency',
        currency: 'NOK',
    });

    console.log('kto: |', kto, '|');
    if (event.key != undefined)
        kto = kto + event.key;
    var eventkey = event.key;
    // console.log('kto: ', kto);

    let sistepost = <? php echo $sistepost ?>;
    console.log('siste post: ', sistepost);


    if (((kto == '0') || (kto == ' ')) && (kto.length == 1)) {
        kto = sistepost['debet'];
        document.getElementById(4).value = kto;
    }

    jQuery.ajax({
        type: "POST",
        url: "index.php?option=com_regn&task=registrering.finn_kto",
        data: ({
            kto: kto,
            per: month,
            ar: year
        }),
        cache: false,
        success: function (tekst) {

            //   console.log('tekst finn_kkto: |', tekst), '|';
            obj2 = JSON.parse(tekst);
            let gg =
                '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Kredit</th><th style="text-align:left; width:100px; ">Navn</th></tr><tr>';

            if (isJsonArray(tekst)) {

                console.log(obj2);
                for (let i = 0; i < obj2.length; i++) {
                    //  console.log(obj2[i].Ktonr);
                    gg = gg + '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                        'id="oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto(' + obj2[i].Ktonr + ')"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px; padding: 0px 10px 0px 0px;" ' +
                        'id="kk" value="' + obj2[i].Navn + '" onclick="hent_kkto(' + obj2[i].Ktonr + ')" ></td></tr>';
                }
            } else {
                let disp = obj2.budsjett - obj2.belop;
                disp = new Intl.NumberFormat('nb-NO', {
                    style: 'currency',
                    currency: 'NOK'
                }).format(disp);
                const budsjett = new Intl.NumberFormat('nb-NO', {
                    style: 'currency',
                    currency: 'NOK'
                }).format(obj2.budsjett);
                const hittil = new Intl.NumberFormat('nb-NO', {
                    style: 'currency',
                    currency: 'NOK'
                }).format(obj2.hittil);

                if (obj2.belop)
                    gg = gg + '<tr> <td ><input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                        'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kkto(' + obj2.Ktonr + ')"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                        'id="kk" value="' + obj2.Navn + '" onclick="hent_kkto(' + obj2.Ktonr + ')" ></td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Brukt periode: </td>' +
                        '<td  style="text-align:right;" >' + nokpenger.format(obj2.belop) +
                        '</td></tr>' +
                        //`(new Intl.NumberFormat('no-NB').format(obj3.belop))+  '</td></tr>' + //+ obj3.belop.toLocaleString('no-NB', { style: 'currency', currency: 'NOK',})+ '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett periode: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett) +
                        '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Hittil Budsjett: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett_hittil) +
                        '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:00px; padding: 0px 10px 0px 0px;">Hittil brukt: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format(obj2.hittil) +
                        '</td></tr>' +
                        '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                        '<td style="text-align:right;">' + nokpenger.format((obj2.budsjett_hittil) - (obj2.hittil)) + '</td></tr></table>';
                else
                    gg = gg + '<tr> <td ><input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                        'id="oo" value="' + obj2.Ktonr + '"  onclick="hent_kkto(' + obj2.Ktonr + ')"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px; padding: 0px 10px 0px 0px;" ' +
                        'id="kk" value="' + obj2.Navn + '" onclick="hent_kkto(' + obj2.Ktonr + ')" ></td></tr>';


            }
            gg = gg + '</table>';





            // sjekker innholdet for debet-kollonnen. Dersom artlisten vises, skiftes den ut. Dersom debetliste vises, droppes debet
            if (document.getElementById("db").innerHTML.includes("Kunde")) {
                console.log('fant Kunde');
                document.getElementById("db").innerHTML = '<table width="320"></table>';
            }
            document.getElementById("kr").innerHTML = gg;
            if (event.key == 'Enter')
                document.getElementById(id_belop).focus();
        }
    })
}




async function finn_kto1(i) { //i=0: onclick, i=1: onchange
    console.log("finn_kto " + i);
    //            if (event.key=="Enter") {
    // if (i==1) {
    //     document.getElementById(id_kredit).focus;
    //     return;
    // }
    var kto = document.getElementById(3).value;
    console.log('kto: |', kto, '|');
    kto = kto + event.key;
    var eventkey = event.key;
    // console.log('kto: ', kto);

    let sistepost = <? php echo $sistepost ?>;
    console.log('siste post: ', sistepost);
    //    console.log('siste post: ', sistepost['debet'], ' kto ', kto, ' kto.length ', kto.length)
    if (((kto == '0') || (kto == ' ')) && (kto.length == 1)) {
        kto = sistepost['debet'];
        document.getElementById(3).value = kto;
    }
    //      console.log('siste post: ', sistepost['debet'], ' kto ', kto, ' kto.length ', kto.length)
    var ref = document.getElementById("ref").value
    let vv = document.getElementById(3).value;
    // console.log("finn_kto :|" + kto + "| vv:|" + vv + "| event key:|" + event.key + "| ref:|" + ref + "|", ' length: ', kto.length);
    //       if ((vv == '') && (event.key == 'Enter')) {
    if ((event.key == 'Enter')) {
        // const f = await hent_forrige(ref - 1);
        // console.log('f');
        // console.log(f);
        // console.log(f[0].debet);
        // document.getElementById(3).value = f[0].debet;
        // const h = await hent_kto1(f[0].debet);
        // console.log("h");
        // console.log(h);
        // console.log("avsluttet return");
        // // document.getElementById(4).focus();

        if (document.getElementById(4).value == '') {
            document.getElementById(4).focus();
        } else {
            document.getElementById(5).focus();
        };
        return;
    }




    //     console.log('finn_kto: ' + kto + '  ' + i);
    if (i == 0) {
        //    if (kto==undefined)
        kto = 0;
        //   else
        document.getElementById(3).value = "";
    } else if ((kto.substring(0, 4) == '1020') || (kto.substring(0, 5) == 'kunde') || (kto
        .substring(0, 7) == 'debitor')) {
        //        console.log('reskontro debet');
        // console.log("jQuery");
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=registrering.f_oppdater",
            //        url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "debitorer"
            }),
            cache: false,
            success: function (tekst) {
                //    console.log(tekst);
                obj2 = JSON.parse(tekst);
                // console.log(obj2); // array of objects
                // console.log(obj2[0]); // object

                let gg =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:100px; padding: 0px 10px 0px 0px;" >Debet1</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
                //      onkeydown = "hent_kto(id)"
                for (let i = 0; i < obj2.length; i++) {
                    //               for (let i = 1; i < 5; i++) {
                    gg = gg +
                        '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;"' +
                        'id="' + i + 'oo" value="' + obj2[i].reskontronr + '"  onclick="hent_kto1(' + obj2[i].reskontronr + ',' + i + ')"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                        'id="' + i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kto(' + obj2[i].reskontronr + ')" ></td></tr>';
                    if (obj2.length == 1) {
                        hent_kto1(obj2[0].reskontronr, i);

                        gg = gg + '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Brukt periode: </td>' +
                            '<td  style="text-align:right;" >' + nokpenger.format(obj2.belop) +
                            '</td></tr>' +
                            //`(new Intl.NumberFormat('no-NB').format(obj3.belop))+  '</td></tr>' + //+ obj3.belop.toLocaleString('no-NB', { style: 'currency', currency: 'NOK',})+ '</td></tr>' +
                            '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett periode: </td>' +
                            '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett) +
                            '</td></tr>' +
                            '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Hittil Budsjett: </td>' +
                            '<td style="text-align:right;">' + nokpenger.format(obj2.budsjett_hittil) +
                            '</td></tr>' +
                            '<tr><td style="text-align:right; border-width:00px; padding: 0px 10px 0px 0px;">Hittil brukt: </td>' +
                            '<td style="text-align:right;">' + nokpenger.format(obj2.hittil) +
                            '</td></tr>' +
                            '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                            '<td style="text-align:right;">' + nokpenger.format((obj2.budsjett_hittil) - (obj2.hittil)) + '</td></tr></table>';


                        // gg = gg +
                        //     '<tr><td style="text-align:right; border-width:0px; width:150px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                        //     obj2[0].reskontronr + '</td></td>' +
                        //     '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                        //     obj2[0].reskontronr + '</td></td>' +
                        //     '<tr><td style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                        //     '<td >' + obj2[0].reskontronr + '</td></td>';
                    }
                }
                gg = gg + '</table>';
                /*         // document.getElementById("333").innerHTML = gg;*/
                document.getElementById("db").innerHTML = gg;

            }
        });


    }; // else {
    //        console.log(" null " + kto);

    /*  if (event.key != 'Enter')
            kto = kto + event.key;
        else {
            console.log('finn_kto_subm');
            document.getElementById("333").innerHTML = '';
            /*            document.getElementById("dbudsjett").innerHTML = "Budsjett1";
            document.getElementById("dhittil").innerHTML = "Hittil";
            document.getElementById("ddisponibelt").innerHTML = "Disponibelt";
         * /   console.log('ferdig enter finn:kto_sum');
          */
    if (eventkey == 'Enter') {
        //         console.log("debet ut: "+document.getElementById(3).value);
        // if (document.getElementById(4).value == '1020') {
        //     console.log('reskontro debet');
        // }

        if (document.getElementById(4).value == '') {
            document.getElementById(4).focus();
        } else {
            document.getElementById(5).focus();
        }
    } else {
        //}
        //  kto = 0;
        // console.log("søk alle kto " + kto);
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=registrering.ktosok",
            //  url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "ktosok",
                ktosok1: kto
            }),
            cache: false,
            success: function (tekst) {
                //     console.log("tekst: " + tekst);
                obj2 = JSON.parse(tekst);
                // console.log(obj2);
                // console.log(obj2.length);
                /*       if (obj2.length == 1) {
                            document.getElementById("dbudsjett").innerHTML = "Budsjett";
                            document.getElementById("dhittil").innerHTML = "Hittil";
                            document.getElementById("ddisponibelt").innerHTML = "Disponibelt";
                        }
                */
                let gg =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:100px; padding: 0px 10px 0px 0px;" >Debet</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
                //      onkeydown = "hent_kto(id)"
                for (let i = 0; i < obj2.length; i++) {
                    //               for (let i = 1; i < 5; i++) {
                    gg = gg +
                        '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;" id="' +
                        i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kto1(' +
                        obj2[i]
                            .Ktonr + ',0)">' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;"  id="' +
                        i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kto1(' +
                        obj2[i].Ktonr +
                        ')" ></td></tr>';
                    if (obj2.length == 1) {
                        hent_kto1(obj2[0].Ktonr);

                        /*    gg = gg +
                                '<tr><td style="text-align:right; border-width:0px; width:150px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                obj2[0].Ktonr + '</td></td>' +
                                '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                obj2[0].Ktonr + '</td></td>' +
                                '<tr><td style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                '<td >' + obj2[0].Ktonr + '</td></td>';
                        */
                    }
                }
                gg = gg + '</table>';
                /*  // document.getElementById("333").innerHTML = gg;*/
                document.getElementById("db").innerHTML = gg;
                // document.getElementById("kr").innerHTML = gg;
                //                  console.log("ferdig ajax");
            }

        })
    }
    // console.log("ferdig finn_kto");
}

async function finn_kkto_sok() {
    if (event.key == 'Enter') {
        document.getElementById(id_belop).focus();
        return;
    }
    var kto = document.getElementById(4).value;
    kto = kto + event.key;
    console.log("finn_kkto_sok", kto, event.key);

    let sistepost = <? php echo $sistepost ?>;
    console.log('siste post: ', sistepost['kredit'], ' kto ', kto, ' kto.length ', kto.length)
    if (((kto == '0') || (kto == ' ')) && (kto.length == 1)) {
        kto = sistepost['kredit'];
        document.getElementById(4).value = kto;
    }
    console.log('siste post: ', sistepost['kredit'], ' kto ', kto, ' kto.length ', kto.length)





    console.log(kto);
    jQuery.ajax({
        type: "POST",
        url: "index.php?option=com_regn&task=registrering.ktosok",
        data: ({
            mode: "ktosok",
            kto: kto
        }),
        cache: false,
        success: function (tekst) {
            console.log('finn_kkto_sok ret: ', tekst);
            obj2 = JSON.parse(tekst);
            console.log(obj2);
            console.log(obj2.length);
            /*        if (obj2.length == 1) {
                        document.getElementById("dbudsjett").innerHTML = "Budsjett";
                        document.getElementById("dhittil").innerHTML = "Hittil";
                        document.getElementById("ddisponibelt").innerHTML = "Disponibelt";
                    }
            */




            let gg =
                '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Kredit</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
            //      onkeydown = "hent_kto(id)"
            for (let i = 0; i < obj2.length; i++) {
                //               for (let i = 1; i < 5; i++) {
                gg = gg +
                    '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;" id="' +
                    i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto1(' + obj2[i].Ktonr + ',1)"></td>' +
                    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                    ' id = "' + i + 'kk" value = "' + obj2[i].Navn + '" onclick = "hent_kkto1(' + obj2[i].Ktonr + ',1)" ></td ></tr > ';

                if (obj2.length == 1) {
                    hent_kkto1(obj2[0].Ktonr, 1);
                    /*
                                                gg = gg +
                                                    '<tr><td style="text-align:right; border-width:0px; width:150px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                                    obj2[0].Ktonr + '</td></td>' +
                                                    '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                                    obj2[0].Ktonr + '</td></td>' +
                                                    '<tr><td style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                                    '<td >' + obj2[0].Ktonr + '</td></td>';
                                                    */
                }
            }
            gg = gg + '</table>';


            $sub = document.getElementById("kr").innerHTML;
            const aa = document.getElementById("db").innerHTML;
            const bb = 'Kunde';
            if (aa.includes(bb))
                console.log("Fant kunde");
            else console.log("fant ikke kunde");
            document.getElementById("db").innerHTML = '<table style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr>' +
                '<th style="text-align:right;width:100px; padding: 0px 10px 0px 0px;"  >Debet</th><th style="text-align:left;width:150px; padding: 0px 0px 0px 0px;">Navn</th></tr><tr>';
            document.getElementById("kr").innerHTML = gg;

            if ($sub.substring(0, 6) != '<table') {
                g1 =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:100px; padding: 0px 10px 0px 0px;"' +
                    ' >Debet1</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
                document.getElementById("kr").innerHTML = g1;
            };
            document.getElementById("kr").innerHTML = gg;

        }
    })
}

async function finn_kkto_bk(i) {

    // console.log('finn_kkto A: ' + i);
    var kto = document.getElementById(4).value;
    kto = 0; //kto + event.key;
    if (kto == 'undefined') kto = 0;
    // console.log("kto: |" + kto + '|  event.key: |' + event.key + '|  |' + kto + event.key + '|');
    var ref = document.getElementById("ref").value;
    let vv1 = document.getElementById(id_belop).value;
    // console.log("finn_kkto |" + i + "| beløp:|" + vv1 + "| event key:|" + event.key + "| ref:|" + ref + "|");
    if (event.key == ' ') {
        if (vv1 == ' ') {
            // console.log("hent forrige");
            const f = await hent_forrige(ref - 1);
            // console.log('f');
            // console.log(f);
            // console.log(f[0].kredit);
            document.getElementById(4).value = f[0].kredit;
            // console.log("await hent_kkto1 " + i);
            const h = await hent_kkto1(f[0].kredit, 5);
            // console.log("ferdig await hent_kkto1 " + i);
            document.getElementById(4).focus();
            return;
        } else {
            // console("back");
            document.getElementById(4).focus();
        }
        return;
    }
    gg = '';

    // console.log("gg  : |" + gg + '|');


    // console.log("iB  : " + i + '  ' + kto);
    jQuery.ajax({
        type: "POST",
        url: "/components/com_regn/views/Registrering/tmpl/update.php",
        //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
        data: ({
            mode: "ktosok",
            ktosok1: kto
        }),
        cache: false,
        success: function (tekst) {
            //    console.log(tekst);
            obj2 = JSON.parse(tekst);
            // console.log(obj2);
            // console.log(obj2.length);
            /*        if (obj2.length == 1) {
                        document.getElementById("dbudsjett").innerHTML = "Budsjett";
                        document.getElementById("dhittil").innerHTML = "Hittil";
                        document.getElementById("ddisponibelt").innerHTML = "Disponibelt";
                    }
            */



            let gg =
                '<table  style=" margin-left: 20px;" border="2" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Kredit</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
            //      onkeydown = "hent_kto(id)"
            for (let i = 0; i < obj2.length; i++) {
                //               for (let i = 1; i < 5; i++) {
                gg = gg +
                    '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;" id="' +
                    i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto1(' + obj2[i].Ktonr + ',0)"></td>' +
                    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" ' +
                    ' id = "' + i + 'kk" value = "' + obj2[i].Navn + '" onclick = "hent_kkto1(' + obj2[i].Ktonr + ',0)" ></td ></tr > ';

                if (obj2.length == 1) {
                    hent_kkto1(obj2[0].Ktonr, i);
                    /*
                                                gg = gg +
                                                    '<tr><td style="text-align:right; border-width:0px; width:150px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                                    obj2[0].Ktonr + '</td></td>' +
                                                    '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                                    obj2[0].Ktonr + '</td></td>' +
                                                    '<tr><td style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                                    '<td >' + obj2[0].Ktonr + '</td></td>';
                                                    */
                }
            }
            gg = gg + '</table>';


            $sub = document.getElementById("kr").innerHTML;
            const aa = document.getElementById("kr").innerHTML;
            const bb = 'Kunde';
            if (aa.includes(bb)) // console.log("Fant kunde");
                //        else console.log("fant ikke kunde");
                document.getElementById("db").innerHTML = '<table style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr>' +
                    '<th style="text-align:right;width:100px; padding: 0px 10px 0px 0px;"  >Debet</th><th style="text-align:left;width:150px; padding: 0px 0px 0px 0px;">Navn</th></tr><tr>';
            document.getElementById("kr").innerHTML = gg;

            if ($sub.substring(0, 6) != '<table') {
                g1 =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:100px; padding: 0px 10px 0px 0px;"' +
                    ' >Debet1</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
                document.getElementById("kr").innerHTML = g1;
            };
            document.getElementById("kr").innerHTML = gg;


        }

    });

};

async function finn() {


    //    console.log("pass |" + i + "| event.key: |" + event.key + "|");


    // var ref = document.getElementById("ref").value
    // let vv = document.getElementById(3).value;
    // console.log("finn_kto |" + vv + "| event key:|" + event.key + "| ref:|" + ref + "|");
    // if ((vv == '') && (event.key == 'Enter')) {
    //     const f = await hent_forrige(ref - 1);
    //     console.log('f');
    //     console.log(f);
    //     console.log(f[0].debet);
    //     document.getElementById(3).value = f[0].debet;
    //     const h = await hent_kto1(f[0].debet);
    //     document.getElementById(5).focus();
    //     return;
    // }




    //   console.log('finn_kkto B: ' + kto + " " + i);

    //  if (i == 0) kto = 0;

    if (i == 0) {
        //    if (kto==undefined)
        kto = 0;
        //   else
        document.getElementById(4).value = "";
    }



    /*  if (event.key != 'Enter')
          kto = kto + event.key;
      else {
          console.log('finn_kto_subm');
          document.getElementById("333").innerHTML = '';
          /*            document.getElementById("dbudsjett").innerHTML = "Budsjett1";
          document.getElementById("dhittil").innerHTML = "Hittil";
          document.getElementById("ddisponibelt").innerHTML = "Disponibelt";
       * /   console.log('ferdig enter finn:kto_sum');
        */
    if (event.key == 'Enter') {
        if (document.getElementById(5).value == '') {

            document.getElementById(5).focus();
        } else {
            document.getElementById(6).focus();
        }
    } else {
        //}
        //    console.log("enter ajax");
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "ktosok",
                ktosok1: kto
            }),
            cache: false,
            success: function (tekst) {
                //       console.log(tekst);
                var obj2 = JSON.parse(tekst);
                // console.log(obj2);
                // console.log(obj2.length);
                /*        if (obj2.length == 1) {
                            document.getElementById("dbudsjett").innerHTML = "Budsjett";
                            document.getElementById("dhittil").innerHTML = "Hittil";
                            document.getElementById("ddisponibelt").innerHTML = "Disponibelt";
                        }
                */




                let gg =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:150px; padding: 0px 10px 0px 0px;" >Kredit</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
                //      onkeydown = "hent_kto(id)"
                for (let i = 0; i < obj2.length; i++) {
                    //               for (let i = 1; i < 5; i++) {
                    gg = gg +
                        '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;" id="' +
                        i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto1(' +
                        obj2[i]
                            .Ktonr +
                        ',4)">' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;"  id="' +
                        i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kkto(' +
                        obj2[i].Ktonr +
                        ',4)" ></td></tr>';
                    if (obj2.length == 1) {

                        hent_kkto1(obj2[0].Ktonr, i);
                        /*
                                                    gg = gg +
                                                        '<tr><td style="text-align:right; border-width:0px; width:150px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                                        obj2[0].Ktonr + '</td></td>' +
                                                        '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                                        obj2[0].Ktonr + '</td></td>' +
                                                        '<tr><td style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                                        '<td >' + obj2[0].Ktonr + '</td></td>';
                                                        */
                    }
                }
                gg = gg + '</table>';


                /*

                                    let gg =
                                        '<table  border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; padding: 0px 10px 0px 0px;" width="150" >Kredit</th><th width="150">Navn</th></tr><tr>';
                                    //      onkeydown = "hent_kkto1(id)"
                                    for (let i = 0; i < obj2.length; i++) {

                /*
                                gg = gg +
                                            '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;" id="' +
                                            i + 'oo" value="' + obj2[i].reskontronr + '"  onclick="hent_kto1(' + obj2[i].reskontronr +
                                            ')">' +
                                            ' <td > <input type="text"  style="text-align:left; border-width:0px; width:200px; padding: 0px 10px 0px 0px;"  id="' +
                                            i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kto(' + obj2[i].reskontronr +
                                            ')" ></td></tr>';
                                        if (obj2.length == 1) {
                                            hent_kto1(obj2[0].reskontronr);

                                            gg = gg +
                                                '<tr><td style="text-align:right; border-width:0px; width:150px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                                obj2[0].reskontronr + '</td></td>' +
                                                '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                                obj2[0].reskontronr + '</td></td>' +
                                                '<tr><td style="text-align:right; border-width:0px;  width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                                '<td >' + obj2[0].reskontronr + '</td></td>';
                                        }

                * /


                                        //               for (let i = 1; i < 5; i++) {
                                        gg = gg +
                                            '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;" id="' +
                                            i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto1(' + obj2[i].Ktonr + ')">' +
                                            ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px; padding: 0px 10px 0px 0px;"  id="' +
                                            i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kkto1(' + obj2[i].Ktonr + ')" ></td></tr>';
                                        if (obj2.length == 1) {
                                            gg = gg +
                                                '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                                obj2[0].Ktonr + '</td></td>' ;
                                      /*          '<tr><td style="text-align:right; border-width:0px; width:150px;padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                                obj2[0].Ktonr + '</td></td>' +
                                                '<tr><td style="text-align:right; border-width:0px; width:150px; padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                                '<td >' + obj2[0].Ktonr + '</td></td>';* /
                                        }

                                    }
                                    gg = gg + '</table>';
                                    */
                $sub = document.getElementById("kr").innerHTML;
                const aa = document.getElementById("db").innerHTML;
                const bb = 'Kunde';
                if (aa.includes(bb)) // console.log("Fant kunde");
                    //        else console.log("fant ikke kunde");
                    document.getElementById("db").innerHTML = '<table style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr>' +
                        '<th style="text-align:right;width:100px; padding: 0px 10px 0px 0px;"  >Debet</th><th style="text-align:left;width:150px; padding: 0px 0px 0px 0px;">Navn</th></tr><tr>';

                //                    document.getElementById("db").innerHTML = gg;
                document.getElementById("kr").innerHTML = gg;
                //   console.log(string.includes(substring));


                if ($sub.substring(0, 6) != '<table') {
                    // console.log("DDDDDDDDDDDD");
                    //             console.log("g1: |" + document.getElementById("kr").innerHTML + "|");;
                    /*  // document.getElementById("333").innerHTML = gg;*/
                    g1 =
                        '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; width:100px; padding: 0px 10px 0px 0px;"' +
                        ' >Debet1</th><th style="text-align:left; width:150px; ">Navn</th></tr><tr>';
                    document.getElementById("kr").innerHTML = g1;
                };
                document.getElementById("kr").innerHTML = gg;
                //                       const aa=document.getElementById("db").innerHTML;
                // const bb='Kunde';
                //    if (aa.includes(bb))
                //      document.getElementById("db").innerHTML='';
                //                  document.getElementById("db").innerHTML = gg;
                // document.getElementById("kr").innerHTML = gg;

            }

        })
    }
    // console.log("ferdig finn_kkto |" + i + '|' + event.key + '|');
    // if (event.key == 'Enter') {
    if (i == 1) {
        // console.log("focus til id_kredit")
        if (event.key == 'Enter')
            document.getElementById(id_belop).focus();
        else
            document.getElementById(id_kredit).focus();
    } else if ((i == 4) && !(event.key == 'Enter'))
        document.getElementById(id_belop).focus();

    //     else if ((i == 1) &&( event.key == 'Enter')
    //         document.getElementById(5).focus();
    //     else
    //      document.getElementById(4).focus();
    // }

}

function finn_kkto1(i) {
    var kto = document.getElementById(4).value;
    // console.log('finn_kkto: ' + kto + '  ' + i);
    if (event.key != 'Enter')
        kto = kto + event.key;
    else {
        //         console.log('Enter');
        //      document.getElementById("333").innerHTML = 'aa';
        document.getElementById("dbudsjett").innerHTML = "bb";
        document.getElementById("dhittil").innerHTML = "cc";
        document.getElementById("ddisponibelt").innerHTML = "dd";

        document.getElementById(5).focus();
    }
    jQuery.ajax({
        type: "POST",
        url: "/components/com_regn/views/Registrering/tmpl/update.php",
        //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
        data: ({
            mode: "ktosok",
            ktosok1: kto
        }),
        cache: false,
        success: function (tekst) {

            //  console.log(tekst);
            var obj2 = JSON.parse(tekst);
            // console.log(obj2);
            // console.log(obj2.length);
            //       document.getElementById("333").innerHTML = '';
            // document.getElementById("dbudsjett").innerHTML = "";
            // document.getElementById("dhittil").innerHTML = "";
            // document.getElementById("ddisponibelt").innerHTML = "";

            let gg =
                '<table style=" margin-left: 20px;"  border="0" cellspacing="2" cellpadding="2"><tr><th width="150" >Kredit kto</th><th width="150">Navn</th></tr><tr>';
            onkeydown = "hent_kto(id)"
            for (let i = 0; i < obj2.length; i++) {
                //               for (let i = 1; i < 5; i++) {
                if (i == 0) {
                    gg = gg +
                        ' <td >  <input type="text"  style="text-align:right; border-width:0px; width:150px;" id="' +
                        i + 'oo" value="4010"></td>' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px;" id="' +
                        i + 'kk" value="Kost" ></td>';
                } else
                    gg = gg + '<tr><td width="100"></td><td width="333"></td>';

                /*                    gg = gg +
                                    ' <td >  <input type="text"  style="text-align:right; border-width:10px; width:50px;" id="' +
                                    i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto1(' + obj2[i].Ktonr +
                                    ')">' +
                                    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:200px;" id="' +
                                    i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kkto1(' + obj2[i].Ktonr +
                                    ')" ></td></tr>';
                    */
                gg = gg +
                    ' <td >  <input type="text"  style="text-align:right; border-width:0px; width:150px;" id="' +
                    i + 'oo" value="' + obj2[i].Ktonr + '"  onclick="hent_kkto1(' + obj2[i]
                        .Ktonr +
                    ',1)">' +
                    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:150px;" id="' +
                    i + 'kk" value="' + obj2[i].Navn + '" onclick="hent_kkto1(' + obj2[i]
                        .Ktonr +
                    ',1)" ></td></tr>';
            }
            gg = gg + '</table>';
            document.getElementById("kr").innerHTML = gg;
        }

    })
}

function ggg(ii) {
    // alert(ii);
}

function neste(gg) {
    var kto = document.getElementById(4).value;
    //       console.log('neste ' + kto);
    if (event.key == 'Enter')
        document.getElementById("6").focus();
    gg_bk = gg;
    if ((gg == 4) || (gg == 3)) {
        //          console.log("gg1: " + gg);

        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "konto",
                konto: document.getElementById(gg).value
            }),
            cache: false,
            error: console.log("error"),
            success: function (tekst) {
                //                console.log(tekst);
                if (tekst != "ukjent") {
                    var obj2 = JSON.parse(tekst);
                    // console.log(obj2);
                    // console.log("gg_bk: " + gg_bk + " |" + obj2.Ktonr + "|");
                }
                /*       if (gg_bk == 3) {
                        document.getElementById("1infokto").value = 'Debet: ' + document.getElementById(
                            3).value
                        if (tekst == "ukjent") {
                            document.getElementById("1info").value = document.getElementById(3).value +
                                ' finnes ikke'
                            document.getElementById("p1").innerHTML = "";
                        } else {
                            document.getElementById("1info").value = obj2.Navn;
                            document.getElementById("dbudsjett").innerHTML = "Budsjett:";
                            document.getElementById("dhittil").innerHTML = "Hittil i år:";
                            document.getElementById("disponibekt").innerHTML = "DIsponibelt";
                          }
                    } else {
                        document.getElementById("2infokto").value = 'Kredit: ' + document
                            .getElementById(4)
                            .value
                        if (tekst == "ukjent") {
                            document.getElementById("2info").value = document.getElementById(4).value +
                                ' finnes ikke'
                            document.getElementById("p20").innerHTML = "";
                        } else {
                            document.getElementById("2info").value = obj2.Navn;
                            document.getElementById("p20").innerHTML = "Tilgjengelig<br>Resultat";
                            document.getElementById("budsjett").innerHTML = "Budsjett:";
                            document.getElementById("khittil").innerHTML = "Hittil i år:";
                            document.getElementById("kdisponibekt").innerHTML = "DIsponibelt";
                        }
                    }
                          */
                //   console.log('kto: '+)
            }
        })
    }
}
//    gg = gg + 1;
// console.log(document.getElementById(gg).value ? true : false);

// while ((document.getElementById(gg).value ? true : false) && (gg < 6)) {
//     gg = gg + 1;
//     console.log(document.getElementById(gg).value);
// }
// //    document.getElementById(gg).focus();
// if (document.getElementById(4).value == '')
//     document.getElementById(4).focus();
// else
//     document.getElementById(5).focus();
// console.log("neste: " + gg);

function showErrorAndFocus(message, elementId) {
    // Display the error modal
    const modal = document.getElementById("errorModal");
    const errorMessage = document.getElementById("errorMessage");
    const closeModal = document.getElementById("closeModal");

    if (modal && errorMessage) {
        errorMessage.textContent = message;
        modal.style.display = "block";

        // Close the modal on button click
        closeModal.addEventListener("click", () => {
            modal.style.display = "none";

            // Focus on the specified element
            const element = document.getElementById(elementId);
            if (element) {
                element.focus();
            } else {
                console.error(`Element with id "${elementId}" not found.`);
            }
        });
    } else {
        console.error("Error modal or message element not found.");
    }
}

function datokonv4(regnskapsar) {
    //    document.getElementById(3).focus;
    console.log('datokonv4');



    let firma_regnskapsar = "<?php echo $regnskapsar ?>";
    let forrigedato = "<?php echo $sistepost ?>";
    console.log('forrigedato', forrigedato);
    console.log('forrigedato dato', forrigedato['Dato']);






    if (event.key === 'Enter') {
        finn_kto(0);
        document.getElementById(id_debet).focus();
    }
    const today1 = new Date();
    let today = today1.toLocaleDateString("nb-NO")
    //     today = '1.1.2020';
    console.log('datokonv4: ', today);
    let pos1 = today.indexOf(".");
    let pos2 = today.lastIndexOf(".");


    // console.log(today, '  ', pos1, '  ', pos2);
    if (pos1 == 1) today = '0' + today;
    pos1 = today.indexOf(".");
    pos2 = today.lastIndexOf(".");
    // console.log(today, '  ', pos1, '  ', pos2);
    if (pos2 == 4) today = today.substring(0, 3) + '0' + today.substring(3);
    pos1 = today.indexOf(".");
    pos2 = today.lastIndexOf(".");
    // console.log(today, '  ', pos1, '  ', pos2);





    if (forrigedato == null) {
        fdag = today.substring(0, 2);
        fmnd = today.substring(3, 5);
        far = today.substring(6, 10);
        console.log('fdag: ', fdag, ' fmnd: ', fmnd, ' far: ', far);
    } else {
        // console.log('forrigedato: ', forrigedato, ' firma_regnskapsar: ', firma_regnskapsar, ' dagen: ', today);
        fdag = forrigedato['Dato'].substring(8, 10);
        fmnd = forrigedato['Dato'].substring(5, 7);
        far = forrigedato['Dato'].substring(0, 4);
        console.log('fdag: ', fdag, ' fmnd: ', fmnd, ' far: ', far);
    }
    //const obj1 = JSON.parse(forrigepost);
    //  console.log(obj1);
    let dato = document.getElementById(id_dato).value;
    if ((dato == ' ') || (dato == '0')) dato = fdag + ',' + fmnd + ',' + far;
    //           if ((dato == ' ') || (dato == '0')) dato = fdag + '.' + fmnd + '.' + far;
    //         if ((dato == ' ') || (dato == '0')) dato = far + ',' + fmnd + ',' + fdag;
    let debet = document.getElementById(id_debet).value;
    let kredit = document.getElementById(id_kredit).value;
    let belop = document.getElementById(id_belop).value;
    console.log('debet |', debet, '| debet |', debet, '| belop |', belop, '| regnskapsar ', firma_regnskapsar);
    //   console.log('forrige ', forrigedato['Dato']);
    let mnd = '';
    let dag = '';
    let ar = '';

    // console.log('dato: ', dato);
    let p = dato.indexOf(',');
    let q = dato.indexOf(',', p + 1);
    if (p == -1) {
        p = dato.indexOf('.');
        q = dato.indexOf('.', p + 1);
    }


    dag = dato.substring(0, p);
    // console.log(p, ' ', q, ' dag: ', dag, ' dato: ', dato, ' ar: ', ar);
    if (dag.length < 2) dag = '0' + dag;
    if (q == -1) {
        if (p == -1) {
            if ((dato == '0') || (dato == '0')) {
                mnd = fmnd;
                ar = far;
                dag = fdag;
            } else {
                mnd = fmnd;
                ar = far;
                dag = dato;
                dato = dag + '.' + mnd + '.' + ar;
                // console.log('dato etter retting', dato);
            }
        } else {
            mnd = dato.substring(p + 1);
            ar = far
        } //firma_regnskapsar}
        if (dag.length == 1)
            dag = '0' + dag;
        console.log('dagA: ', dag);
    } else
        mnd = dato.substring(p + 1, q);
    if (mnd.length < 2) mnd = '0' + mnd;
    // console.log('ar |', dato.substring(q + 1), '|');
    if (ar == '') ar = dato.substring(q + 1);
    //    ar = dato.substring(q + 1);
    // if (dato.substring(q + 1) == '') {
    //     ar = far; //firma_regnskapsar;
    //     console.log('ar er null');
    // }
    //      if ((ar > 0) && (ar < 40)) ar = '20' + ar;
    //    ar = firma_regnskapsar;

    // console.log(p, ' ', q, ' dag: ', dag, ' mnd: ', mnd, ' ar: ', ar);

    dato = dag + '.' + mnd + '.' + ar;
    //      dato = ar + '-' + mnd + '-' + dag;
    dato = dato.replace(/,/g, "");
    document.getElementById(id_dato).value = dato;
    // co
    //
    // nsole.log(p, ' ', q, ' ', dag, ' ', mnd, ' ', ar, ' ', dato);;

    console.log('debet: ', debet, ' kredit: ', kredit, ' belop: ', belop);
    if (debet != '') hent_kto1(debet, 4);
    if (kredit != '') hent_kkto1(kredit, 4);



    if (debet == '') {
        finn_kto(0);
        document.getElementById(id_debet).focus();
    } else if (kredit == '') {
        finn_kkto(0);
        document.getElementById(id_kredit).focus();
    } else if (belop == '')
        document.getElementById(id_belop).focus();
    else document.getElementById(id_tekst).focus();



}

async function datokonv3(dt, regnskapar) {
    // console.log("datakonv3: " + dt);
    var ref = document.getElementById("ref").value
    let vv = document.getElementById(2).value; // + event.key;
    let debet1 = document.getElementById(id_debet).value;
    let kredit1 = document.getElementById(id_kredit).value;
    var i = 0;
    var r = 0;
    // console.log("datakonv2 |" + vv + "| event key:|" + event.key + "| ref:|" + ref + "| vv" + vv + "|");
    //   if ((vv == '') && (event.key == 'Enter')) {
    if (vv == '') {
        const f = await hent_forrige(ref - 1);
        // console.log('f');
        // console.log(f);
        // console.log(f[0].Dato);
        document.getElementById(2).value = f[0].Dato;
        document.getElementById(3).focus();
        return;
    }
    if (event.key == 'Enter') {
        document.getElementById(3).focus();
    }
    const vis_debet = await hent_kto1(debet1, 4);
    const vis_kredit = await hent_kkto1(kredit1, 4);
}

async function datokonv2(dt, regnskapar) {
    // console.log("datakonv2: " + dt);
    var ref = document.getElementById("ref").value
    let vv = document.getElementById(2).value; // + event.key;
    var i = 0;
    var r = 0;
    // console.log("datakonv2 |" + vv + "| event key:|" + event.key + "| ref:|" + ref + "| vv" + vv + "|");
    // if ((vv == '') && (event.key == 'Enter')) {
    //     const f = await hent_forrige(ref - 1);
    //     console.log('f');
    //     console.log(f);
    //     console.log(f[0].Dato);
    //     document.getElementById(2).value = f[0].Dato;
    //     document.getElementById(3).focus();
    //     return;
    // }
    // while (i < vv.length) {
    //     if (vv[i++] == ',') r++;
    // }
    // console.log(" vv " + vv + " : " + vv.length + " : " + r);
    let text = vv;
    // console.log(" text " + text);
    // console.log('komma: ' + vv.indexOf(","));
    //  alert("dato " + dt);
    if ((vv.indexOf(",") != -1) || (vv.indexOf(".") != -1)) {
        if (vv.indexOf(",") != -1) {
            var result = text.indexOf(",");
            var dag = vv.substring(0, result);
            // console.log('min ' + dag);
            if ((dag > 24) || (dag < 0)) alert("feil dag " + dag);
            var result1 = text.indexOf(",", result);
        } else {
            var result = text.indexOf(".");
            var dag = vv.substring(0, result);
            //      if ((dag > 24) || (dag < 0)) alert("feil dag " + dag);
            var result1 = text.indexOf(".", result);
        };
        var maned = vv.substring(result + 1);
        // console.log('dag: ' + dag);
        // console.log('maned: ' + maned);

        // if ((time > 24) || (time < 0)) alert("feil time " + time);
        var ar = vv.substring(result1 + 1);
        //             console.log('ar: ' + ar);
        if (r < 2) arstr = regnskapar;
        else {
            var arstr = "19" + ar.toString();
            if (ar < 24) arstr = "20" + ar.toString();
            else arstr = "19" + ar.toString();
        }
        //     var y = arstr + "-" + maned.toString() + "-" + dag.toString();
        var y = dag.toString() + "-" + maned.toString() + "-" + arstr;

        if (maned > 12) {
            alert("feil i dato, måned");
            document.getElementById(2).focus();
            exit;
        }

        if (((dag > 30) && ((maned == 4) || (maned == 6) || (maned == 9) || (maned == 11))) ||
            ((dag > 31) && ((maned == 1) || (maned == 3) || (maned == 5) || (maned == 7)) || (
                maned == 8) | (
                    maned == 10) || (maned == 12)) ||
            ((dag > 28) && ((maned == 2)))) {
            alert("feil i dato, dag");

            document.getElementById(2).focus();
            exit;
        }
        // console.log('resultat: ' + y);
        document.getElementById(2).value = y;
    }
    /*
    // alert("dato1 " + y);
    console.log("!"+document.getElementById(3).value+"!");
    if (document.getElementById(3).value=="")
    document.getElementById(3).focus();
     else
     document.getElementById(4).focus();
    */
    // var gg = 3;

    // console.log(document.getElementById(gg).value ? true : false);

    // while ((document.getElementById(gg).value ? true : false) && (gg < 6)) {
    //     gg = gg + 1;
    //     console.log(document.getElementById(gg).value);
    // }
    // document.getElementById(gg).focus();
    //           console.log("neste: " + gg);
    //return y;
}

async function fart() {
    console.log("fart1");

    //   let fart2 = new Promise((resolve, reject) => {                    }
    const lart = document.getElementById(1).value;
    //     console.log('lart ' + lart);
    if (event.key == 'Enter') {
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            data: ({
                mode: "artcheck",
                art: lart
            }),
            cache: false,
            success: function (tekst) {
                //            console.log('tekst: ' + tekst);
                const obj1 = JSON.parse(tekst);
                //   console.log('art: ' + obj1.art);
                if (obj1.belop == 0) obj1.belop = '';
                //   console.log('belop ' + document.getElementById(5).value);
                if (obj1.art == 0) {
                    document.getElementById(2).value = ""; // debet=3
                    document.getElementById(3).value = ""; // debet=3
                    document.getElementById(4).value = "";
                    document.getElementById(5).value = "";
                    document.getElementById(6).value = "";
                } else {
                    document.getElementById(2).value = obj1.dato;
                    document.getElementById(3).value = obj1.debet;
                    document.getElementById(4).value = obj1.kredit;
                    document.getElementById(5).value = obj1.belop;
                    document.getElementById(6).value = obj1.tekst;
                    // hent_kto(0);
                    // hent_kkto(0);
                    //          document.getElementById("1infokto").value= obj1.debet;
                    // document.getElementById("2infokto").value= obj1.kredit;
                    // document.getElementById("p1").innerHTML="Budsjett<br>Resultat";
                    // document.getElementById("p20").innerHTML="Tilgjengelig<br>Resultat";

                    jQuery.ajax({
                        type: "POST",
                        url: "/components/com_regn/views/Registrering/tmpl/update.php",
                        data: ({
                            mode: "konto",
                            konto: obj1.debet
                        }),
                        cache: false,
                        success: function (tekst) {
                            //       console.log(tekst);
                            const obj2 = JSON.parse(tekst);
                            document.getElementById("1infokto").value = obj2
                                .Ktonr;
                            document.getElementById("1info").value = obj2
                                .Navn;
                            document.getElementById("p1").innerHTML =
                                "Budsjett<br>Resultat";
                        }
                    });
                    jQuery.ajax({
                        type: "POST",
                        url: "/components/com_regn/views/Registrering/tmpl/update.php",
                        data: ({
                            mode: "konto",
                            konto: obj1.kredit
                        }),
                        cache: false,
                        success: function (tekst) {
                            //             console.log(tekst);
                            const obj2 = JSON.parse(tekst);
                            document.getElementById("2infokto").value = obj2
                                .Ktonr;
                            document.getElementById("2info").value = obj2
                                .Navn;
                            document.getElementById("p20").innerHTML =
                                "Tilgjengelig<br>Resultat";
                        }
                    });
                }
                if (document.getElementById(id_dato).value == "0000-00-00 00:00:00") document
                    .getElementById(
                        2).value = '';
                //                 console.log('dato obj1: ' + obj1.dato);
            }
        });




        // console.log('fart: ' + document.getElementById(2).value + ' gg ' + (document.getElementById(2)
        //     .value ?
        //     true : false));

        if (!(document.getElementById(2).value ? true : false)) document.getElementById(2).value =
            '';


        var gg = 2;
        while ((document.getElementById(gg).value ? true : false) && (gg < 6)) {
            gg = gg + 1;
            //       console.log(document.getElementById(gg).value);
        }
        document.getElementById(gg).focus();
    } else {
        //  console.log("sart: " + event.key);
        var art = document.getElementById(1).value;
        art = art + event.key;
        if (event.key != 'Backspace')
            //             console.log("sart: " + art);
            jQuery.ajax({
                type: "POST",
                url: "/components/com_regn/views/Registrering/tmpl/update.php",
                data: ({
                    mode: "sart",
                    art: art
                }),
                cache: false,
                success: function (tekst) {
                    //             console.log(tekst);
                    const obbj5 = JSON.parse(tekst);
                    document.getElementById("1info").value = 'Artbeskrivelse: ' + obbj5
                        .beskrivelse;

                }
            });

    }
}

function btn(a) {
    console.log('btn ', a)
    document.getElementById("button" + a).style.display = "inline-block";


    // Save value


    // Get value
    let xbtn = sessionStorage.getItem('xbtn');
    console.log('xbtn', xbtn); // "JohnDoe"

    if (xbtn != 'NULL') {
        console.log('xbtn', xbtn); // "JohnDoe"
        document.getElementById("button" + xbtn).style.display = "none";
    }

    sessionStorage.setItem('xbtn', a);

}

function btn1(a) {
    console.log('btn1', a)



    jQuery.ajax({
        type: "POST",

        url: "index.php?option=com_regn&task=registrering.slettpost",
        //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
        data: ({
            nr: a
        }),
        cache: false,
        success: function (tekst) {
            console.log(tekst);
            window.location.reload();

        }
    })
}

function list_art1(i) {
    var art = document.getElementById(1).value;
    var ref = document.getElementById("ref").value;
    console.log('list_art1 art: |' + art + '| ref: |' + ref + '|');

    // console.log('kr: ');
    //      console.log(document.getElementById("kr").innerHTML); //.substring(0,15);
    jQuery.ajax({
        type: "POST",
        url: "/components/com_regn/views/Registrering/tmpl/update.php",
        //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
        data: ({
            mode: "listart",
        }),
        cache: false,
        success: function (tekst) {
            console.log(tekst);
            obj2 = JSON.parse(tekst);
            console.log('obj2: ', obj2);
            // console.log(obj2);
            let gg =
                '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; padding: 0px 10px 0px 0px;" >Kunde</th><th width="600">Navn</th></tr><tr>';
            //      onkeydown = "hent_kto(id)"
            for (let i = 0; i < obj2.length; i++) {
                //               for (let i = 1; i < 5; i++) {
                gg = gg +
                    '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" id="' +
                    i + 'oo" value="' + obj2[i].id + '"  onclick="hent_art(' + obj2[i].id +
                    ')">' +
                    ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;"  id="' +
                    i + 'kk" value="' + obj2[i].beskrivelse + '" onclick="hent_art(' + obj2[
                        i].id +
                    ')" ></td></tr>';
                if (obj2.length == 1) {
                    hent_kto1(obj2[0].id, 3);

                    /*       gg = gg +
                               '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                               obj2[0].id + '</td></td>' +
                               '<tr><td style="text-align:right; border-width:0px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                               obj2[0].id + '</td></td>' +
                               '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                               '<td >' + obj2[0].id + '</td></td>';*/
                }
            }
            gg = gg + '</table>';
            /*          // document.getElementById("333").innerHTML = gg;*/
            document.getElementById("db").innerHTML = gg;
            document.getElementById("kr").innerHTML = '';
        }
    })
}

function hent_forrige(ref) {
    // console.log('hent_forrige');
    return new Promise((resolve, reject) => {
        $.ajax({

            //  jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "hentforrige",
                ref: ref,
            }),
            cache: false,
            success: function (tekst) {
                // console.log(tekst);
                const obj1 = JSON.parse(tekst);
                // console.log(obj1[0].Bilagsart);
                resolve(obj1);
            }
        })


    })
}

async function list_art(i) {
    var b = document.getElementById('1').value;
    var art = document.getElementById(1).value;
    var ref = document.getElementById("ref").value;

    console.log("list_art |" + b + "| event key:|" + event.key + "| art|" + art + "| ref:|" + ref + "|");
    // console.log(document.getElementById("kr").innerHTML.substring(0, 8));
    document.getElementById("kr").innerHTML = '';
    //    var kto = document.getElementById(3).value;
    /*     if (b!=null){*/

    if ((b == '') && (event.key == 'Enter')) {
        // console.log('starter rutine...');
        const f = await hent_forrige(ref - 1);
        // console.log('f');
        // console.log(f);
        //   console.log('f[0].Bilagsart', f[0].Bilagsart);
        //  const b = await hent_art(f[0].Bilagsart);
        // document.getElementById(1).value = f[0].Bilagsart;
        // document.getElementById(2).value = f[0].Dato;
        // document.getElementById(3).value = f[0].debet;
        // document.getElementById(4).value = f[0].kredit;
        // document.getElementById(5).value = f[0].belop;
        if (document.getElementById(2).value == '')
            document.getElementById(2).focus();
        else if (document.getElementById(3).valu == '')
            document.getElementById(3).focus();
        else if (document.getElementById(3).valu == '')
            document.getElementById(4).focus();
        else if (document.getElementById(4).valu == '')
            document.getElementById(5).focus();
        else
            document.getElementById(6).focus();


    }
    b = b + event.key;
    //   console.log('list_art: ' + b);}*/
    if (event.key == 'Enter') {

        // console.log('starter rutine 2');
        document.getElementById(2).focus();
        hent_art(document.getElementById('1').value);
        /*
                   if (document.getElementById(2).value == '') {

                       document.getElementById(2).focus();
                   } else {
                       document.getElementById(3).focus();
                   } */
    } else {
        // console.log('starter ajax');
        jQuery.ajax({
            type: "POST",
            url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "listart",
            }),
            cache: false,
            success: function (tekst) {
                //                    console.log(tekst);
                obj2 = JSON.parse(tekst);
                // console.log(obj2);
                // console.log(obj2);
                let gg =
                    '<table  style=" margin-left: 20px;" border="0" cellspacing="0" cellpadding="0"><tr><th style="text-align:right; padding: 0px 10px 0px 0px;" >Kunde</th><th width="600">Navn</th></tr><tr>';
                //      onkeydown = "hent_kto(id)"
                for (let i = 0; i < obj2.length; i++) {
                    //               for (let i = 1; i < 5; i++) {
                    gg = gg +
                        '<tr> <td >  <input type="text"  style="text-align:right; border-width:0px; width:100px; padding: 0px 10px 0px 0px;" id="' +
                        i + 'oo" value="' + obj2[i].id + '"  onclick="hent_art(' + obj2[
                            i].id +
                        ')">' +
                        ' <td > <input type="text"  style="text-align:left; border-width:0px; width:100px; padding: 0px 10px 0px 0px;"  id="' +
                        i + 'kk" value="' + obj2[i].beskrivelse +
                        '" onclick="hent_art(' + obj2[i]
                            .id +
                        ')" ></td></tr>';
                    if (obj2.length == 1) {
                        hent_kto1(obj2[0].id, 3);

                        /*       gg = gg +
                                   '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Budsjett: </td><td>' +
                                   obj2[0].id + '</td></td>' +
                                   '<tr><td style="text-align:right; border-width:0px; padding: 0px 10px 0px 0px;">Hittil: </td><td >' +
                                   obj2[0].id + '</td></td>' +
                                   '<tr><td style="text-align:right; border-width:0px;  padding: 0px 10px 0px 0px;">Disponibelt: </td>' +
                                   '<td >' + obj2[0].id + '</td></td>';*/
                    }
                }
                gg = gg + '</table>';
                /*      // document.getElementById("333").innerHTML = gg;*/
                document.getElementById("db").innerHTML = gg;
                // document.getElementById("kr").innerHTML = gg;
            }
        })
    }
    const lart = document.getElementById(1).value;
    //   console.log('list_art1 ' + lart);

}

function sjekk_dato(dato) {
    if (dato == null) return '';
    console.log('datosj: ', dato[4], dato);
    if (dato[4] == '-')
        dato = dato.substr(8, 2) + '.' + dato.substr(5, 2) + '.' + dato.substr(0, 4);
    else
        dato = "Feil";
    console.log('slutt dato: ', dato);
    return dato;
}

function hent_art(art) {
    console.log("hent art " + art);
    //    var art = document.getElementById(1).value;

    // console.log('art: |' + art + '|');
    if (art == '')
        console.log('ingen');
    else {
        // console.log('hent_art fortsett');
        //        return new Promise((resolve, reject) => {
        $.ajax({
            //          jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=registrering.hentart",
            //arguments url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                art: art
            }),
            cache: true,
            success: function (tekst) {
                console.log('hentart: ', tekst);
                obj2 = JSON.parse(tekst);
                console.log('obj2: ', obj2);
                // // console.log('hentart id: ' + obj2.id);
                // // console.log('hentart dato: |' + obj2.dato + '| ' + (obj2.dato == null));
                // // console.log('hentart debet: ' + obj2.debet);
                ///    console.log('dato: ', sjekk_dato(obj2.dato));
                document.getElementById(1).value = obj2.id;
                document.getElementById(2).value = sjekk_dato(obj2.dato);
                document.getElementById(3).value = obj2.debet;
                document.getElementById(4).value = obj2.kredit;
                document.getElementById(5).value = obj2.belop;
                document.getElementById(6).value = obj2.tekst;

                finn_kto(2);
                finn_kkto(2);
                // hent_kto(obj2.debet, 4);
                // hent_kkto(obj2.kredit, 4);
                // // // document.getElementById(id_dato).focus();
                // //     alert("ferdig  hent_artAA");
                // // console.log('dato ' + obj2.dato);
                // // console.log("ferdig: dato:  " + obj2.dato + " debet: " + obj2.debet + " kredit: " + obj2.kredit + " beløp: " + obj2.belop);
                // //      document.getElementById("5").focus();
                if (obj2.dato == null) document.getElementById(id_dato).focus();
                else if (obj2.debet == null) document.getElementById(id_debet).focus();
                else if (obj2.kredit == null) document.getElementById("4").focus();
                else if (obj2.belop == null) document.getElementById("5").focus();
                else document.getElementById("6").focus();

            }
        })
        //    })
    }
    console.log("hent art  2 " + art);

}

function hent_art2(art) {
    console.log("hent art2 " + art);
    //    var art = document.getElementById(1).value;

    // console.log('art: |' + art + '|');
    if (art == '')
        console.log('ingen');
    else {
        // console.log('hent_art fortsett');
        // return new Promise((resolve, reject) => {
        $.ajax({
            //          jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=registrering.hentart",
            //arguments url: "/components/com_regn/views/Registrering/tmpl/update.php",
            //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
            data: ({
                mode: "hentart",
                art: art
            }),
            cache: false,
            success: function (tekst) {
                console.log('hentart: ', tekst);
                //     obj2 = JSON.parse(tekst);
                console.log('obj2: ', obj2);
                // console.log('hentart id: ' + obj2.id);
                // console.log('hentart dato: |' + obj2.dato + '| ' + (obj2.dato == null));
                // console.log('hentart debet: ' + obj2.debet);
                console.log('dato: ', sjekk_dato(obj2.dato));
                document.getElementById(1).value = obj2.id;
                document.getElementById(2).value = sjekk_dato(obj2.dato);
                document.getElementById(3).value = obj2.debet;
                document.getElementById(4).value = obj2.kredit;
                document.getElementById(5).value = obj2.belop;
                document.getElementById(6).value = obj2.tekst;

                console.log('velger fokus');
                hent_kto(obj2.debet, 4);
                hent_kkto(obj2.kredit, 4);
                // document.getElementById(id_dato).focus();
                //     alert("ferdig  hent_artAA");
                // console.log('dato ' + obj2.dato);
                // console.log("ferdig: dato:  " + obj2.dato + " debet: " + obj2.debet + " kredit: " + obj2.kredit + " beløp: " + obj2.belop);
                //      document.getElementById("5").focus();

                console.log('velger fokus');

                if (obj2.dato == null) document.getElementById(id_dato).focus();
                else if (obj2.debet == null) document.getElementById(id_debet).focus();
                else if (obj2.kredit == null) document.getElementById(id_kredit).focus();
                else if (obj2.belop == null) document.getElementById(id_belop).focus();
                else document.getElementById(id_tekst).focus();

            }
        })
        // })
    }
    console.log("hent art  2 " + art);

}

/*
var promise1 = new Promise(function(resolve, reject) {
    resolve('foo');
});
let myval="a";
promise1.then(function(value) {
 myval=value;
  console.log(value); // this logs "foo"
});

setTimeout(() => console.log(myval), 0); // logs "foo"




