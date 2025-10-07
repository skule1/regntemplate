

function datokonv4(regnskapsar, forrigedato) {
    //    document.getElementById(3).focus;
    let obj4 = JSON.parse(forrigedato);
    console.log('datokonv4 regnskapsar ', regnskapsar, forrigedato, obj4);
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



    let firma_regnskapsar = "<?php echo $regnskapsar ?>";
   // let forrigedato ="<?php echo $sistepost ?>";

    console.log('firma_regnskapsar', firma_regnskapsar);
    //console.log('forrigedato', forrigedato);

}