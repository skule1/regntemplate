<h1><?php echo $this->msg; ?></h1>
<?php

// defined('_JEXEC') or die('Restricted access');
// $sok2 = new	RegnModelsok;
// $b="50";
// $message1 = $sok2->getListQuery1($b);
// if ($message1) {
// 	foreach ($message1 as $message) {
// 		echo $message->Dato . '|'. $message->belop.'<br>';
// 	}
// }


// $db = JFactory::getDbo();
// $sql = $db->getQuery(true); 
// $sok='coop';
// $sql = 'select * from #__regn_hist where (tekst LIKE "%' . $sok . '%" or kontoinfo LIKE "%' . $sok . '%") limit 10 ';
// //$db->setQuery($sql);
// 	//try {
// 		$db->setQuery((string) $sql);
// 		$result = $db->loadObjectList();
//        if ($result) 
//           foreach ($result as $message) 
// 			echo $message->Dato.'<br>';
// 	//}
















?>

<style>
	select {
		width: 100px;
		height: 30px;

	}
</style>

<?php
$db = JFactory::getDBO();
$regnskapsar = "2010";



// function Sok()
// {

//  $db = JFactory::getDBO();
$sql = 'select Bilagsart,Bilag,Dato,debet,kredit,belop,Tekst,kontoinfo from qo7sn_regn_hist where debet=4010;'; // and regnskapsar=2022 and Periode="februar" order by dato;';

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

Søk:
<input type="text" id="id_sok1" onchange="oppdat_sok()">

<select name="kat" id="id_valg1" width="200" height="48">
	<option value="fritekst">Fritekst</option>
	<option value="belop">Beløp</option>
	<option value="belomrade">Beløp område</option>
	<option value="dato">Dato</option>
	<option value="sql">SQL</option>
</select>
<input type="button" id="id_utf" value="Oppdater" onclick="oppdat_sok()">

<br><br>

<!-- Konto1:
    <select id="id_kto" style="height:25px; width: 100px !important; min-width: 150px; max-width: 50px;" name="mode"
        onchange="oppdat_bev()">
        <?php
		//$messages1 = $db->loadObjectList();
		if ($messages1) {
			foreach ($messages1 as $message1) {
				echo '<option value="' . $message1->Ktonr . '">' . $message1->Ktonr . '  ' . $message1->Navn . '</option>';
			}
		}
		?>
    </select> -->
Periode:
<select style="height:25px; width: 120px " id="id_per1" name="mode" onchange="oppdat_sok()">
	<?php
	//$messages1 = $db->loadObjectList();
	if ($messages2) {
		foreach ($messages2 as $message2) {
			echo '<option value="' . $message2->Periodenavn . '">' . $message2->Periodenavn . '</option>';
		}
	}
	?>
</select> År:
<select style="height:25px;" id="id_ar1" name="mode" onchange="oppdat_sok()">
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
<select id="id_sort1" name="mode" style="height:25px;" onchange="oppdat_sok()">
	<option>Bilag</option>
	<option>Dato</option>
	<option>Beløp</option>
</select>
</select> Rekkefølge:
<select id="id_rekke1" name="mode" style="height:25px;" onchange="oppdat_sok()">
	<option>Opp </option>
	<option>Ned</option>

</select>
Antall poster: <input type="text" value="25" style=" width: 50px" id="id_tekst1" onchange="oppdat_sok()">

<input type="button" value="<<" id="id_prev" onclick="offs_prev1()">
<input type="button" value=">>" id="id_next" onclick="offs_next1()">

<div id="id_htmlsok"></div>

<?php

//}
?>



<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
	var glob_offset = 0;
	const formatter = new Intl.NumberFormat('nb-NO', {
		style: 'currency',
		currency: 'NOK'
	})



	function offs_prev1() {
		const ant1 = document.getElementById('id_tekst').value;
		glob_offset = +glob_offset - +ant1;
		if (glob_offset < 0) glob_offset = 0;
		console.log("global offset: " + glob_offset);
		oppdat_sok();

	}

	function offs_next1() {
		const ant1 = document.getElementById('id_tekst').value;
		glob_offset = +glob_offset + +ant1;
		console.log("global offset: " + glob_offset);
		oppdat_sok();
	}



	async function debet_oppdat_sok(sok1, ar1, per1, valg1) {
		console.log('debet_oppdat_sok  valg1: ' + valg1 + ' per1: ' + per1 + ' ar1: ' + ar1 + ' sok1: ' + sok1);

		return new Promise((resolve, reject) => {
				jQuery.ajax({
						type: "POST",
						url: "/index.php?option=com_regn&task=sok.debet_oppdat_sok",
						//url: "/components/com_regn/views/Registrering/tmpl/update.php",
						data: ({
							mode: "debet_oppdat_sok",
							sok: sok1,
							ar: ar1,
							per: per1,
							valg: valg1
						}),
						cache: false,
						error: function(error) {
							reject(error);
						},
						success: function(tekst) {
							console.log('debet_oppdat_sok tekst: ' + tekst);
							let obj = JSON.parse(tekst);
							console.log('debet obj.ss: ' + obj);
							resolve ("333");
						//	resolve(tekst);
					}
				})
		})
	}




	//  async   async function kredit_oppdat_sok(sok1, ar1, per1) {
	//         console.log('debet_oppdat_bev');
	//         let tekst = [];
	//         let obj = '';
	//         let bb = 8266.05;
	//         return new Promise((resolve, reject) => {
	//             jQuery.ajax({
	//                 type: "POST",
	//                 url: "/components/com_regn/views/Registrering/tmpl/update.php",
	//                 data: ({
	//                     mode: "kredit_oppdat_sok",
	//                     sok: sok1,
	//                     ar: ar1,
	//                     per: per1
	//                 }),
	//                 cache: false,
	//                 error: function (error) {
	//                     reject(error);
	//                 },
	//                 success: function (tekst) {
	//                     console.log('kredit tekst: ' + tekst);
	//                     let obj = JSON.parse(tekst);
	//                     console.log('kredit obj.ss: ' + obj.ss);
	//                     resolve(obj.ss);
	//                 }
	//             })
	//         })
	//     }

	async function oppdat_sok() {
		console.log('sok glob_offset ', glob_offset);
		const sok1 = document.getElementById('id_sok1').value;
		const valg1 = document.getElementById('id_valg1').value;
		const per1 = document.getElementById('id_per1').value;
		const ar1 = document.getElementById('id_ar1').value;
		const sort1 = document.getElementById('id_sort1').value;
		const rekke1 = document.getElementById('id_rekke1').value;
		const ant1 = document.getElementById('id_tekst1').value;
		const offset1 = glob_offset;
		console.log('oppdat_sok: sok1:', sok1, '|ar1: ', ar1, '|per1: ', per1, '|valg1: |', valg1, '|');

		// const dd1 = await debet_oppdat_sok(sok1, ar1, per1, valg1);
		// console.log("oppdat_sok from dd1: " + dd1)
		// const obj = JSON.parse(dd1);
		// console.log(obj);

		// console.log(obj.ss);
		// console.log(obj.cnt);
		const bel = obj.ss;
		const ant = obj.cnt;
		const obj ='[]';


			console.log('oppdat_sok |', sok1, '|', valg1, '|');

		jQuery.ajax({
				//	url: 'index.php?option=com_helloworld&task=get&format=csv',

				url: "/index.php?option=com_regn&task=sok.oppdat_sok",
				method: "POST", // or "GET"
				data: {
					sok: sok1,
					valg: valg1,
					ar: ar1,
					per: per1,
					sort: sort1,
					rekke: rekke1,
					ant: ant1,
					offset: offset1
				},
				success: function(response) {
					// // // const jsonString = '[{"id":1,"name":"John"},{"id":2,"name":"Jane"}]';
					// const jsonArray = JSON.parse(response);

					// // // Access the data
					// console.log('response: ');
					// console.log(jsonArray); // Outputs: [ { id: 1, name: 'John' }, { id: 2, name: 'Jane' } ]

					const obj = JSON.parse(response);
					const size = Object.keys(obj).length;

					// console.log('size', size); // Outputs: 3
					// //const obj = JSON_decode(response);
					// console.log(response);
					//	console.log(response);
					//	obj = json_decode(response);
					// console.log(obj);
					//JFactory::getApplication() -> close();
					// let msg = '';
					// for (let i = 0; i < 5; i++)
					// 	//		msg = msg +i + '<br>';
					// 	msg = msg + obj[i]['Dato'] + '<br>';
					// // msg= msg + obj[0]['Dato'] + '<br>';
					// // msg = msg+ obj[1]['Dato'] + '<br>';

					// console.log('Dato: ', msg);
					// document.getElementById("id_htmlsok").innerHTML = msg;
					//	JFactory::getApplication() - > close();

					//console.log("Response:", response);
					// 	if (response.status === "success") {
					// 		alert(response.message);
					// 	} else {
					// 		alert("Error: " + response.message);
					// 	}
					//
					//  },
					// error: function(xhr, status, error) {
					// 	console.error("AJAX Error:", status, error);

					// 	console.log(response);
					// let obj = JSON.parse(tekst);
					// console.log(obj);

					// // console.log(obj[1]);
					// console.log(" obj.length;" + obj.length);
					// for (let j=0;j<obj.length;j++)
					// console.log('obj '+j+' : '+obj[j]["Dato"]);
					// let msg = "<table><tr><td>ref</td></tr></table";
					// //   let msg1 = "";
					let msg2 = "";
					let j = 0;
					let msg1 = '<form action="" method="get"><table border="0" cellspacing="2" cellpadding="2">  <tr  style="height:15px;"></tr><tr>' +
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
							dato = dato.substring(8, 10) + '.' + dato.substring(5, 7) + '.' + dato.substring(0, 4);

							msg2 += '<tr>' +
								' <td style="text-align:right;border-width:0px;">' + obj[j]["ref"] + '</td>' +
								' <td style="text-align:right;border-width:0px;">' + obj[j]["Bilagsart"] + '</td>' +
								' <td style="text-align:right;border-width:0px;">' + obj[j]["Bilag"] + '</td>' +
								' <td style="text-align:center;border-width:0px;">' + dato + '</td>' +
								' <td style="text-align:right;border-width:0px;">' + obj[j]["debet"] + '</td>' +
								' <td style="text-align:right;border-width:0px;">' + obj[j]["kredit"] + '</td>' +
								' <td style="text-align:right;border-width:0px;">' + obj[j]["belop"] + '</td>' +
								' <td style="text-align:left;border-width:0px; padding-left: 10px;">' + tekst + '</td>' +
								' <td style="text-align:left;border-width:0px;">' + info + '</td></tr>';
							//      console.log(j + ' ' + msg2);
						};

						msg2 +=
							'<tr><td colspan="10">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>' +
							' <tr><td><td></td></td><td></td><td align ="right">Sum:</td><td border-width:0px;"><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel).substring(0, formatter.format(bel).length - 3) + '" </td>' +
							'<td></td><td> Antall: ' + ant + '</td></tr>';
						// //           '<tr><td>aaa'+bel+'</td></tr></table></form>';
						//   ' <tr><td><td></td></td><td></td><td >Sum :</td><td border-width:0px;"><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel) + '" </td>';
						// //      +   ' <tr><td><td></td></td><td></td><td >Sum :</td><td ><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet"  </td></tr></table></form>';
						// //      +  '<td>antall<input style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_kredit"  value="567" ></td></tr></table></form>';

						// // console.log(formatter.format(dd1));
						document.getElementById("id_htmlsok").innerHTML = msg1 + msg2 + '</table></form>';

						// msg2 += '<tr><td>' + bel + '</td></tr></table></form>';
						//   document.getElementById("rr2").innerHTML = msg1 + msg2;

						//  document.getElementById("id_sum_debet").value =100; //obj[0].ss; 
						//     document.getElementById("id_sum_kredit").value = 12; //obj[0].cnt;

						// //       console.log(msg1);
						// //     console.log(msg2);

						//obj[0].ss; //formatter.format(obj[0].ss).substring(0, formatter.format(obj[0].ss).length - 3);

					}
				}
			}

		)

	}
















	// 		type: "POST",
	// 		url: "index.php?option=com_regn&task=sok.getAjaxResponse&format=json",
	// 		//	url: "index?option=com_regn&task=sok.oppdat_sok",
	// 		success: function(tekst) {
	// 			console.log(tekst);
	// 		}

	// 	})
	// }
	async function oppdat_sok8() {
		const sok1 = document.getElementById('id_sok1').value;
		const valg1 = document.getElementById('id_valg1').value;
		console.log("oppdat_sok søk: |", sok1, '| valg: |', valg1, '|');
		//       const kto1 = document.getElementById('id_kto1').value;
		const per1 = document.getElementById('id_per1').value;
		const ar1 = document.getElementById('id_ar1').value;
		const sort1 = document.getElementById('id_sort1').value;
		const rekke1 = document.getElementById('id_rekke1').value;
		const ant1 = document.getElementById('id_tekst1').value;
		const offset1 = glob_offset;


		const dd1 = await debet_oppdat_sok(sok1, ar1, per1, valg1);
		// console.log("oppdat_sok from dd1: " + dd1)
		const obj = JSON.parse(dd1);
		// console.log(obj);

		// console.log(obj.ss);
		// console.log(obj.cnt);
		const bel = obj.ss;
		const ant = obj.cnt;
		// //  console.log("dd1: "+[dd1]);
		// //     const dd2 = await kredit_oppdat_bev(sok1, ar1, per1);
		// //    console.log('kto ' + kto1 + ' per ' + per1 + ' ar ' + ar1 + ' sort ' + sort1 + ' rekke ' + rekke1);
		// console.log("sokAAAAAAA/cnt: " + (sok1 == '') + '   ' + (obj.cnt == 0));
		if ((sok1 == '') || (obj.cnt == 0)) {
			document.getElementById("id_htmlsok").innerHTML = '';
			console.log("ingen poster");
			return;

		} else
			jQuery.ajax({
					type: "POST",
					url: "/index?option=com_regn&task=sok.oppdat_sok",
					//	url: "/components/com_regn/views/Registrering/tmpl/update.php",
					//     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
					data: ({
						mode: "oppdat_sok",
						//      mode: "ktosok",
						sok: sok1,
						valg: valg1,
						//         kto: kto1,
						ar: ar1,
						per: per1,
						sort: sort1,
						rekke: rekke1,
						ant: ant1,
						offset: offset1
					}),
					cache: false,
					success: function(tekst) {

						console.log(tekst);
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
						let msg1 = '<form action="" method="get"><table border="0" cellspacing="2" cellpadding="2">  <tr  style="height:15px;"></tr><tr>' +
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
								dato = dato.substring(8, 10) + '.' + dato.substring(5, 7) + '.' + dato.substring(0, 4);

								msg2 += '<tr>' +
									' <td style="text-align:right;border-width:0px;">' + obj[j]["ref"] + '</td>' +
									' <td style="text-align:right;border-width:0px;">' + obj[j]["Bilagsart"] + '</td>' +
									' <td style="text-align:right;border-width:0px;">' + obj[j]["Bilag"] + '</td>' +
									' <td style="text-align:center;border-width:0px;">' + dato + '</td>' +
									' <td style="text-align:right;border-width:0px;">' + obj[j]["debet"] + '</td>' +
									' <td style="text-align:right;border-width:0px;">' + obj[j]["kredit"] + '</td>' +
									' <td style="text-align:right;border-width:0px;">' + obj[j]["belop"] + '</td>' +
									' <td style="text-align:left;border-width:0px; padding-left: 10px;">' + tekst + '</td>' +
									' <td style="text-align:left;border-width:0px;">' + info + '</td></tr>';
								//      console.log(j + ' ' + msg2);
							};


							msg2 +=
								'<tr><td colspan="10">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>' +
								' <tr><td><td></td></td><td></td><td align ="right">Sum:</td><td border-width:0px;"><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel).substring(0, formatter.format(bel).length - 3) + '" </td>' +
								'<td></td><td> Antall: ' + ant + '</td></tr>';
							// //           '<tr><td>aaa'+bel+'</td></tr></table></form>';
							//   ' <tr><td><td></td></td><td></td><td >Sum :</td><td border-width:0px;"><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel) + '" </td>';
							// //      +   ' <tr><td><td></td></td><td></td><td >Sum :</td><td ><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet"  </td></tr></table></form>';
							// //      +  '<td>antall<input style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_kredit"  value="567" ></td></tr></table></form>';

							// // console.log(formatter.format(dd1));
							document.getElementById("id_htmlsok").innerHTML = msg1 + msg2 + '</table></form>';

							// msg2 += '<tr><td>' + bel + '</td></tr></table></form>';
							//   document.getElementById("rr2").innerHTML = msg1 + msg2;

							//  document.getElementById("id_sum_debet").value =100; //obj[0].ss; 
							//     document.getElementById("id_sum_kredit").value = 12; //obj[0].cnt;







							// //       console.log(msg1);
							// //     console.log(msg2);

							//obj[0].ss; //formatter.format(obj[0].ss).substring(0, formatter.format(obj[0].ss).length - 3);








						}
					}
				}

			)
	}
</script>