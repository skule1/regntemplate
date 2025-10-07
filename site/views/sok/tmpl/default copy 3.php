<h1><?php echo $this->msg; ?></h1>
<?php
defined('_JEXEC') or die('Restricted access');

//  $db = JFactory::getDBO();
$db = JFactory::getDBO();

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

$regnskapsar = $messages4->regnskapsar;
?>
<table>
	<tr>
		<td>
			Søk:&nbsp;&nbsp;</td>
		<td>
			<input type="hidden" id="id_sok1" onkeypress="subm('id_sok1')" onchange="oppdat_sok('id_sok1')">
		</td>
		<td>
			<input type="text" id="id_sok2" placeholder='Enter text' onkeypress="subm('id_sok2')" onchange="oppdat_sok('id_sok2')">
		</td>
		<td>
			<input type="hidden" id="id_sok3" placeholder='Stoppunkt' onchange="oppdat_sok('id_sok3')">
		</td>
		<td>
			<select name=" kat" id="id_valg1" width="200" height="48" onchange="oppdat_sok1('id_valg1')">
				<option value="fritekst">Fritekst</option>
				<option value="kto">Konto</option>
				<option value="belop">Beløp</option>
				<option value="bunt">Bunt</option>
				<option value="belomrade">Beløp område</option>
				<option value="dato">Dato</option>
				<option value="datoomrade">Dato område</option>
				<option value="sql">SQL</option>
			</select>
		</td>
		<td>
			<input type="button" id="id_utf" value="Oppdater" onclick="oppdat_sok()">
		</td>
	</tr>
</table>
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

<div id="id_htmlsok"></div>

<!-- 
<input type="button" value="<<" id="id_prev" onclick="offs_prev1()">
<input type="button" value=">>" id="id_next" onclick="offs_next1()"> -->

<!-- <button onclick="toggleInput('id_date')">Toggle Input</button>
<button onclick="toggleInput('id_sok1')">Toggle Input</button>
<input type='text' id='input_1' style='display: " . ($isVisible ? ' block' : 'none' ) . ";' placeholder='Enter text'> -->





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

	function subm(i) {

		var ent = event.key;
		//	console.log('submit  ', i, ' eventkey: ', ent);
		if (ent == 'Enter') {
			//			console.log("skifte");
			document.getElementById("id_sok1").focus();

		}

		// if (ent == 'Enter') {
		// 	if (i == 'id_date') {
		// 		console.log('focus to id_sok1 ');
		// 		document.getElementById('id_sok1').focus;
		// 	} else if (i == 'id_sok1')
		// 		document.getElementById('id_sok2').focus
		// }



	}

	function oppdat_sok1() {
		document.getElementById('id_sok1').value = '';
		document.getElementById('id_sok2').value = '';
		document.getElementById('id_sok3').value = '';
		document.getElementById('id_htmlsok').html = '';
		oppdat_sok();
	}

	// function toggleInput(id) {
	// 	const inputElement = document.getElementById(id);
	// 	inputElement.style.display = inputElement.style.display === 'none' ? 'block' : 'none';
	// }

	function toggleInput(rowId, mode, place) {
		const inputElement = document.getElementById(rowId);
		inputElement.type = mode;
		//	document.getElementById(rowId).value = ''; 
		document.getElementById(rowId).placeholder = place;
		// if (document.getElementById('valg1').value == 'sql')
		// 	document.getElementById('sok2').width = "300";
		//console.log('toggle ', document.getElementById('valg1').value);
	}



	//*************** summerer debet-konto ************************* */

	async function debet_oppdat_sok(sok1, sok2, ar1, per1, valg1) {
		//	console.log('debet_oppdat_sok   sok1: ' + sok1 + ' sok2: ' + sok2 + '  ar1: ' + ar1 + ' per1: ' + per1 + '  valg1: ' + valg1);

		return new Promise((resolve, reject) => {
			jQuery.ajax({
				type: "POST",
				url: "index.php?option=com_regn&task=sok.debet_oppdat_sok",
				data: ({
					sok1: sok1,
					sok2: sok2,
					ar: ar1,
					per: per1,
					valg: valg1
				}),
				cache: false,
				error: function(error) {
					reject(error);
				},
				success: function(tekst) {
					console.log('debet_oppdat_sok tekst: ', tekst, 'BB');
					//let obj = JSON.parse(tekst);
					//  console.log('debet obj.ss: ', obj);
					// //     resolve"333");
					resolve(tekst);
				}
			})
		})
	}

	//*****************    Oppdatering *******************/

	async function oppdat_sok(ii) {
		var ent = event.key;
		//	console.log('sok glob_offset ', glob_offset, '  Enter ', ent, '  i: ', ii);
		const sok1 = document.getElementById('id_sok1').value;
		const sok2 = document.getElementById('id_sok2').value;
		const sok3 = document.getElementById('id_sok3').value;
		const valg1 = document.getElementById('id_valg1').value;
		const per1 = document.getElementById('id_per1').value;
		const ar1 = document.getElementById('id_ar1').value;
		const sort1 = document.getElementById('id_sort1').value;
		const rekke1 = document.getElementById('id_rekke1').value;
		const ant = document.getElementById('id_tekst1').value;
		const offset1 = glob_offset;
		console.log('1oppdat_sok: sok1:', sok1, ' sok2:', sok2, 'sok3:', sok3, '|ar1: ', ar1, '|per1: ', per1, '|valg1: |', valg1, '|');
		console.log('pass1');

		// if (valg1 == 'dato') sok1 = '"' + sok1 + '"';
		// else if (valg1 == 'datoomrade') {
		// 	sok1 = '"' + sok1 + '"';
		// 	sok2 = '"' + sok2 + '"';
		// }
		// else if (valg1 == 'sql')
		// 	sok2 = '"' + sok2 + '"';
		//	console.log('oppdat_sok2: sok1:', sok1, ' sok2:', sok2, 'sok3:', sok3, '|ar1: ', ar1, '|per1: ', per1, '|valg1: |', valg1, '|');

		// const obj = '[]';
		// const bel = obj.ss;
		// const ant = obj.cnt;

		if (valg1 == 'sql')
			document.getElementById('id_sok2').style = " width:600px";
		else
			document.getElementById('id_sok2').style = " width:200px";

console.log('valg1: ',valg1);
		if (valg1 == 'dato') {
			toggleInput('id_sok1', 'date', '');
			toggleInput('id_sok2', 'hidden', '');
			toggleInput('id_sok3', 'hidden', '');
			//	toggleInput('id_per1','hidden', '');
			document.getElementById("id_htmlsok").innerHTML = ' ';
			document.getElementById("id_sok1").focus();
		} else if (valg1 == 'datoomrade') {
			toggleInput('id_sok1', 'date', '');
			toggleInput('id_sok2', 'date', '');
			toggleInput('id_sok3', 'hidden');
			document.getElementById("id_htmlsok").innerHTML = ' ';
			document.getElementById("id_sok1").focus();
		} else if (valg1 == 'kto') {
			toggleInput('id_sok1', 'hidden', '');
			toggleInput('id_sok2', 'text', 'Oppgi konto');
			toggleInput('id_sok3', 'hidden', '');
			document.getElementById("id_htmlsok").innerHTML = ' ';
			document.getElementById("id_sok2").focus();
		} else if (valg1 == 'belomrade') {
			toggleInput('id_sok1', 'text', 'Oppgi minste beløp');
			toggleInput('id_sok2', 'text', 'Oppgi største beløp');
			toggleInput('id_sok3', 'hidden', '');
			document.getElementById("id_htmlsok").innerHTML = ' ';
			if (document.getElementById("id_sok1").value != '')
				document.getElementById("id_sok2").focus();
			else
				document.getElementById("id_sok1").focus();
		} else {
			toggleInput('id_sok1', 'hidden', '');
			toggleInput('id_sok2', 'text', 'Oppgi verdi');
			toggleInput('id_sok3', 'hidden', '');
			document.getElementById("id_htmlsok").innerHTML = ' ';
			document.getElementById("id_sok2").focus();
		}
		console.log('pass2');

		if ((sok1 == '') && (sok2 == '') && (sok3 == '')) return;
		if (((sok1 == '') || (sok2 == '')) && ((valg1 == 'datoomrade') || (valg1 == 'belomrade'))) return;
		console.log('pass3');

		//** dette teller opp sum og antall posteringer: */
		console.log('oppdat_sok2: sok1:', sok1, ' sok2:', sok2, 'sok3:', sok3, '|ar1: ', ar1, '|per1: ', per1, '|valg1: |', valg1, '|');
		const dd2 = await debet_oppdat_sok(sok1, sok2, ar1, per1, valg1);
		// if (valg1 == 'dato')
		// 	sok2 = sok1;
		console.log('dd2', dd2);

		const obj2 = JSON.parse(dd2);
		console.log(' obj2.ant1: ', obj2.ant1);
		console.log(' obj2.bel1: ', obj2.bel1);
		console.log(' obj2.ant2: ', obj2.ant2);
		console.log(' obj2.bel2: ', obj2.bel2);
		const bel1 = obj2.bel1;
		const bel2 = obj2.bel2;
		const ant1 = obj2.ant1;
		const ant2 = obj2.ant2;

		// console.log('obj2; ', obj2[1]);
		// const bel = obj2[0].bel;
		// const ant = obj2[0].ant;
		//console.log('obj2->ant1: ', obj2.ant1);
		//console.log('oppdat_sok: sok1:', sok1, ' sok2:', sok2, 'sok3:', sok3, '|ar1: ', ar1, '|per1: ', per1, '|valg1: |', valg1, '|');
		//const dd1 = await debet_oppdat_sok(sok1, sok2, ar1, per1, valg1);
		//console.log("oppdat_sok from dd1: " + dd1)
		//	return;
		// const obj1 = [];
		// const bel = 10;
		// const ant = 3;
		//console.log('bel: ', bel, '  ant: ', ant);
		// if (valg1 == 'dato') sok1 = '"' + sok1 + '"';
		// else if (valg1 == 'datoomrade') {
		// 	sok1 = '"' + sok1 + '"';
		// 	sok2 = '"' + sok2 + '"';
		// };

		//	console.log('toggle ', valg1);
		// if (valg1 == 'sql')
		// 	document.getElementById('id_sok2').style = " width:600px";
		// else
		// 	document.getElementById('id_sok2').style = " width:200px";
		// toggleInput('id_sok1', 'hidden');
		// toggleInput('id_date', 'hidden');
		$pass = true;
		if (valg1 == "dato") {
			if (((sok1 == '""') && (sok2 == '') && (sok3 == ''))) { // || (obj.cnt == 0)) {
				document.getElementById("id_htmlsok").innerHTML = 'ingen poster';
				//			console.log("ingen poster");
				return;
			}
		} else if ((valg1 == "datoomrade")) { // || (valg1 == "sql")) {
			if (((sok2 == '""') && (sok3 == ''))) { // || (obj.cnt == 0)) {
				document.getElementById("id_htmlsok").innerHTML = 'ingen poster';
				console.log("ingen poster");
				if (sok1 != '""') document.getElementById("id_sok2").focus();
				return;
			}
		} else if (valg1 == "belomrade") {
			if (((sok2 == '') && (sok3 == ''))) { // || (obj.cnt == 0)) {
				document.getElementById("id_htmlsok").innerHTML = 'ingen poster';
				console.log("ingen poster");
				if (sok1 != '') document.getElementById("id_sok2").focus();
				return;
			}
		} else {
			if (((sok1 == '') && (sok2 == '') && (sok3 == ''))) { // || (obj.cnt == 0)) {
				document.getElementById("id_htmlsok").innerHTML = 'ingen poster';
				console.log("ingen poster");
				return;
			}
		}
		console.log('pass2');
		if ((ii == 'id_sok1') && ((valg1 == 'datoomrade') || (valg1 == 'belomrade'))) {
			document.getElementById("id_sok2").focus();
			console.log('pass3');

			return;
		}

		// console.log('pass1a');
		// if (valg1 == 'sok')
		// 	document.getElementById('id_sok2').style = " width:600px";
		// else
		// 	document.getElementById('id_sok2').style = " width:200px";
		// console.log('pass1b');

		//beløpelse
		// {
		// if ((((sok1 == '""') || sok1 == '') && ((sok2 == '""') || sok2 == '') && (sok3 == ''))) { // || (obj.cnt == 0)) {
		// 	//(((sok1 == '') && (sok2 == '') && (sok3 == '')))  // || (obj.cnt == 0))
		// 	//  {
		// 	document.getElementById("id_htmlsok").innerHTML = '';
		// 	console.log("ingen poster");
		// 	return;

		// } else
		console.log('valg1: ', valg1);
		console.log('pass til ajax');
		// return;
		jQuery.ajax({
			//	url: 'index.php?option=com_helloworld&task=get&format=csv',

			url: "/index.php?option=com_regn&task=sok.oppdat_sok",
			method: "POST", // or "GET"
			data: {
				sok1: sok1,
				sok2: sok2,
				sok3: sok3,
				valg: valg1,
				ar: ar1,
				per: per1,
				sort: sort1,
				rekke: rekke1,
				ant: ant,
				offset: offset1
			},
			success: function(response) {
				//console.log('response: ', response);
				//	document.getElementById("id_htmlsok").innerHTML = response;


				if ((valg1 == 'sql') || (valg1 == 'kto')) {
					//		if (valg1 == 'kto') {

					let formatter = new Intl.NumberFormat('nb-NO', {
						minimumFractionDigits: 2, // Ensure two decimal places
						maximumFractionDigits: 2, // Ensure no more than two decimal places
						useGrouping: true // Adds grouping separators (e.g., commas)
					});
					let diff = obj2.bel1 - obj2.bel2;
					let formbel1 = new Intl.NumberFormat('nb-NO', {
						style: 'currency',
						currency: 'NOK'
					}).format(obj2.bel1);
					let formbel2 = new Intl.NumberFormat('nb-NO', {
						style: 'currency',
						currency: 'NOK'
					}).format(obj2.bel2);
					let formdiff = new Intl.NumberFormat('nb-NO', {
						style: 'currency',
						currency: 'NOK'
					}).format(diff);

					if (valg1 == 'sql') document.getElementById("id_htmlsok").innerHTML=response;
					else
						document.getElementById("id_htmlsok").innerHTML = response +
						'<table border="0">' +
						'<tr><td width="200">' +
						'</td><td width="200" style="text-align:right;border-width:0px;">Ant debet:' +
						'</td><td width="30" style="text-align:right;border-width:0px;">' + obj2.ant1 +
						'</td><td width="100" style="text-align:right;border-width:0px;"> Sum debet:  ' +
						'</td><td width="150" style="text-align:right;border-width:0px;">' + formatter.format(obj2.bel1) +
						'</tr><tr><td >' +
						'</td><td  style="text-align:right;border-width:0px;">Ant kredit:' +
						'</td><td  style="text-align:right;border-width:0px;">' + obj2.ant2 +
						'</td><td style="text-align:right;border-width:0px;"> Sum kredit: ' +
						'</td><td style="text-align:right;border-width:0px;">' + formatter.format(obj2.bel2) +
						'</tr><tr><td colspan="3">' +
						'</td><td  style="text-align:right;border-width:0px;"> Diff: ' +
						'</td><td style="text-align:right;border-width:0px;">' + formatter.format(diff) +
						'</td></tr></table>';
					//console.log(response);
				} else {
					//	 console.log(response);
					// document.getElementById("id_htmlsok").innerHTML = response;
					// document.getElementById("id_sok1").focus();
					//	const obj = JSON.parse(response);
					//	console.log(obj);
					// console.log('cnt ', obj.cnt);
					// console.log('ant ', obj.ant);
					console.log('pass4');
					const obj = JSON.parse(response);
					console.log(obj);

					console.log(' obj2.ant1: ', obj2.ant1);
					console.log(' obj2.bel1: ', obj2.bel1);
					console.log(' obj2.ant2: ', obj2.ant2);
					console.log(' obj2.bel2: ', obj2.bel2);
					console.log('valg: ', valg1);

					//		document.getElementById("id_htmlsok").innerHTML = 'hei';
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
					//			console.log(msg1 + '/table></form>');
					//	console.log(msg1);
					if (obj.length > 0) {
						for (j = 0; j < obj.length; j++) {
							let info = obj[j]["kontoinfo"];
							if (obj[j]["kontoinfo"] > '')
								if (obj[j]["kontoinfo"].length > 60)
									info = obj[j]["kontoinfo"].substring(0, 57) + '...';

							let tekst = obj[j]["Tekst"];
							if (obj[j]["Tekst"] > '')
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
							'<tr><td colspan="10">----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>' +
							' <tr><td><td></td></td><td></td><td align ="right">Sum:</td><td border-width:0px;"><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel2).substring(0, formatter.format(bel2).length - 3) + '" </td>' +
							'<td></td><td> Antall: ' + obj2.ant2 + '</td></tr>';
						//           '<tr><td>aaa'+bel+'</td></tr></table></form>';
						' <tr><td><td></td></td><td></td><td >Sum :</td><td border-width:0px;"><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet" value="' + formatter.format(bel2) + '" </td>';
						//      +   ' <tr><td><td></td></td><td></td><td >Sum :</td><td ><input  style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_debet"  </td></tr></table></form>';
						//      +  '<td>antall<input style="border-width:0px;  text-align:right;" type="text" size="8" id="id_sum_kredit"  value="567" ></td></tr></table></form>';
						//	console.log(msg1 + msg2);
						// 	// // console.log(formatter.format(dd1));
						console.log('VVVVVVVVVVVVVVVValg: ', valg1);
						// if (valg1 == 'sql')
						// 	document.getElementById("id_htmlsok").innerHTML = msg2 + '</table></form>';
						// else
						document.getElementById("id_htmlsok").innerHTML = msg1 + msg2 + '</table></form>';
						//				document.getElementById("id_htmlsok").innerHTML = msg1 + '</table></form>';


						//console.log(msg1+ msg2 + '</table></form>');
					}
				}
			}
		})

	}
</script>