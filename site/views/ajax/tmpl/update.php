<?php
//defined('_JEXEC') or die('Restricted access');
//echo 'test';
require $_SERVER['DOCUMENT_ROOT'] . '/configuration.php';

/*
// Initialize Joomla framework 
define( '_JEXEC', 1 );
define('JPATH_BASE', dirname(__FILE__) );
define( 'DS', DIRECTORY_SEPARATOR );

// Required Files 
// require_once ( JPATH_BASE .DS.'includes'.DS.'defines.php' );
// require_once ( JPATH_BASE .DS.'includes'.DS.'framework.php' );
require_once( JPATH_BASE .DS.'configuration.php' );

// Load configuration
$conf =& JFactory::getConfig();
$config = new JConfig();
$conf->loadObject($config);

$host = $conf->getValue('config.host');
$user = $conf->getValue('config.user');
$password = $conf->getValue('config.password');
$database = $conf->getValue('config.db');

echo $host.' : '.$user.' : '.$password.' : '.$database .'<br>';


*/


$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;


$now = date_create()->format('Y-m-d');
//echo $now.'<br>';

//echo 'hash:'.$hash.'<br>';
$servername = "localhost";
$username = "admin";
$password = "230751";
/*$servername = $conf->host;
$username = $conf->user;
$password = $conf->password;
	/* Create connection */

$conn = mysqli_connect($servername, $username, $password, $database);

/*
if (isset($_POST['mode']))  {
		echo 'mode: ';
	};
*/




if (isset($_POST['mode']) && $_POST['mode'] == "artcheck")
	f_artcheck();
elseif (isset($_POST['mode']) && $_POST['mode'] == "oppdat_bev")
	f_oppdat_bev();
elseif (isset($_POST['mode']) && $_POST['mode'] == "oppdat_sok")
	f_oppdat_sok();
elseif (isset($_POST['mode']) && $_POST['mode'] == "hentforrige")
	f_hentforrige();
elseif (isset($_POST['mode']) && $_POST['mode'] == "aa")
	f_aa();
elseif (isset($_POST['mode']) && $_POST['mode'] == "resmal")
	f_resmal();
elseif (isset($_POST['mode']) && $_POST['mode'] == "sjekk_trans")
	f_sjekk_trans();
elseif (isset($_POST['mode']) && $_POST['mode'] == "sjekk_hist")
	f_sjekk_hist();
elseif (isset($_POST['mode']) && $_POST['mode'] == "importer_budsjett")
	f_importer_budsjett();
elseif (isset($_POST['mode']) && $_POST['mode'] == "oppd_kto")
	oppd_kto();
elseif (isset($_POST['mode']) && $_POST['mode'] == "updatefield")
	f_updatefield();
elseif (isset($_POST['mode']) && $_POST['mode'] == "perioder_oppdat")
	perioder_oppdat();
elseif (isset($_POST['mode']) && $_POST['mode'] == "perioder_hent")
	perioder_hent();
elseif (isset($_POST['mode']) && $_POST['mode'] == "konto_hent")
	konto_hent();
elseif (isset($_POST['mode']) && $_POST['mode'] == "konto_oppdat")
	f_konto_oppdat();
elseif (isset($_POST['mode']) && $_POST['mode'] == "currency")
	f_currency();
elseif (isset($_POST['mode']) && $_POST['mode'] == "debitorer")
	f_debitorer();
elseif (isset($_POST['mode']) && $_POST['mode'] == "art")
	f_art();
elseif (isset($_POST['mode']) && $_POST['mode'] == "hentart")
	f_hentart();
elseif (isset($_POST['mode']) && $_POST['mode'] == "sistetrans")
	f_sistetrans();
elseif (isset($_POST['mode']) && $_POST['mode'] == "oppdater4")
	f_oppdater4();
elseif (isset($_POST['mode']) && $_POST['mode'] == "listart")
	f_listart();
elseif (isset($_POST['mode']) && $_POST['mode'] == "konto")
	f_konto();
elseif (isset($_POST['mode']) && $_POST['mode'] == "ktosok")
	//		elseif (isset($_GET['mode']) && $_GET['mode']=="ktosok") 
	f_ktosok();
elseif (isset($_POST['mode']) && $_POST['mode'] == "oppdater")
	f_oppdater();
elseif (isset($_POST['mode']) && $_POST['mode'] == "sart")
	f_sart();
elseif (isset($_POST['mode']) && $_POST['mode'] == "ktoinfo")
	//		elseif(isset($_GET['mode']) && $_GET['mode']=="ktoinfo")
	f_ktoinfo();
//test();
elseif (isset($_POST['mode']) && $_POST['mode'] == "oppdater_hist")
	f_oppdater_hist();

//include 'budsjett.php';

function f_oppdat_sok()
{

	//	echo 'f_oppdat_sok<br>';
	global $hash, $conn;

	$sok = $_POST['sok'];
	$valg = $_POST['valg'];
	//	$kto = $_POST['kto'];
	$ar = $_POST['ar'];
	$per = $_POST['per'];
	$sort = $_POST['sort'];
	$rekke = $_POST['rekke'];
	$ant = $_POST['ant'];
	$offset = $_POST['offset'];

	//echo 'f_oppdat_sok  '. $sok.'  '. $valg;

	if ($valg == 'fritekst') {

		if ($ar == "Alle år" && $per == "Alle perioder")
			$sql = 'select * from ' . $hash . 'regn_hist where (tekst LIKE "%' . $sok . '%" or kontoinfo LIKE "%' . $sok . '%") ';
		elseif ($per == "Alle perioder")
			$sql = 'select * from ' . $hash . 'regn_hist where  (tekst LIKE "%' . $sok . '%" or kontoinfo LIKE "%' . $sok . '%") and Regnskapsar=' . $ar;
		elseif ($ar == "Alle år")
			$sql = 'select * from ' . $hash . 'regn_hist where  (tekst LIKE "%' . $sok . '%" or kontoinfo LIKE "%' . $sok . '%")  and Periode="' . $per;
		else
			$sql = 'select * from ' . $hash . 'regn_hist where  (tekst LIKE "%' . $sok . '%" or kontoinfo LIKE "%' . $sok . '%") and Periode="' . $per . '" and Regnskapsar=' . $ar;

		if ($sort == "Dato")
			$sql = $sql . ' order by Dato ';
		elseif ($sort == "Beløp")
			$sql = $sql . ' order by belop ';
		else
			$sql = $sql . ' order by ref ';

		if ($rekke == "Ned")
			$sql = $sql . ' desc ';

		$sql = $sql . ' limit ' . $ant . ' offset ' . $offset;













		// if ($ar == "Alle år")
		// 	$sql = 'select * from qo7sn_regn_hist where (tekst LIKE "%' . $sok . '%" or kontoinfo LIKE "%' . $sok . '%");';
		// else
		// 	$sql = 'select * from qo7sn_regn_hist where tekst LIKE "%' . $sok . '%" and Regnskapsar="' . $ar . '";';
		//	echo $sql;
		$result = $conn->query($sql);
		$temparray1 = array();
		while ($row = mysqli_fetch_assoc($result))
			$temparray1[] = $row;
		echo json_encode($temparray1);


	}

	//	echo $kto.'  '.	$ar.'  '. $per.'  '. $sort.'  '. $rekke.'  '. $ant;
	// if ($per == "Alle perioder")
	// 	$sql = 'select * from ' . $hash . 'regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ') and Regnskapsar=' . $ar . '  order by ref;';
	// else
	// 	$sql = 'select * from ' . $hash . 'regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ') and Periode="' . $per . '" and Regnskapsar=' . $ar . '  order by ref;';//
	// //echo $sql;
	// $result = $conn->query($sql);
	// $temparray1 = array();
	// while ($row = mysqli_fetch_assoc($result))
	// 	$temparray1[] = $row;
	// echo json_encode($temparray1);

}





function f_oppdat_bev()
{

	//echo 'f_oppdat_bev<br>';
	global $hash, $conn;

	$kto = $_POST['kto'];
	$ar = $_POST['ar'];
	$per = $_POST['per'];
	$sort = $_POST['sort'];
	$rekke = $_POST['rekke'];
	$ant = $_POST['ant'];
	$offset = $_POST['offset'];

	//	echo $kto.'  '.	$ar.'  '. $per.'  '. $sort.'  '. $rekke.'  '. $ant;
	if ($ar == "Alle år" && $per == "Alle perioder")
		$sql = 'select * from ' . $hash . 'regn_hist where (debet=' . $kto . ' or kredit=' . $kto.')'; 

	elseif ($per == "Alle perioder")
		$sql = 'select * from ' . $hash . 'regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ') and Regnskapsar=' . $ar;
	elseif ($ar == "Alle år")
		$sql = 'select * from ' . $hash . 'regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ')  and Periode="' . $per ;
	else
		$sql = 'select * from ' . $hash . 'regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ') and Periode="' . $per . '" and Regnskapsar=' . $ar;

	if ($sort == "Dato")
		$sql = $sql . ' order by Dato ';
	elseif ($sort == "Beløp")
		$sql = $sql . ' order by belop ';
	else
		$sql = $sql . ' order by ref ';

	if ($rekke == "Ned")
		$sql = $sql . ' desc ';

	$sql = $sql . ' limit ' . $ant . ' offset '.$offset;


//	echo $sql;


	$result = $conn->query($sql);
	$temparray1 = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray1[] = $row;
	echo json_encode($temparray1);

}


// function periodekonv(dato)
// {
// 	if (!$dato == '') {
// 		$i = strpos($dato, '-', );
// 		$j = strpos($dato, '-', $i + 1);
// 		$periode = substr($dato, $i + 1, $j - $i - 1);

// 		//echo 'feil';
// 		//	else

// 		//	echo 'kto: '.$kto.'  dato: '.$dato.'<br>';
// 		$i = strpos($dato, "-");
// 		$j = strpos($dato, "-", $i + 1);
// 		//	echo '$i: '.$i.' $j: '.$j.'<br>';
// 		if ($i == 4) {
// 			$periode = substr($dato, $i + 1, 2);
// 			$arstall = substr($dato, 0, 4);

// 		} else {
// 			$periode = substr($dato, $i + 1, $j - $i - 1);
// 			$arstall = substr($dato, $j + 1, 4);
// 		}


// 	}
// return $periode;

// }







function f_aa()
{
	echo 'aaa<br>';
}

function f_hentforrige()
{
	global $hash, $conn;

	$sql = 'SELECT * FROM ' . $hash . 'regn_trans order by ref desc limit 1 ;';//order by ResMal, Ktonr;';
//		echo $sql;
	$result = $conn->query($sql);
	$temparray1 = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray1[] = $row;
	echo json_encode($temparray1);
}


function f_resmal()
{
	global $hash, $conn;
	$sql = 'SELECT * FROM ' . $hash . 'regn_resmal ;';//order by ResMal, Ktonr;';
//		echo $sql;
	$result = $conn->query($sql);
	$temparray1 = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray1[] = $row;
	echo json_encode($temparray1);
}



function f_updatefield()
{
	echo 'f_oppdater<br>';
	global $hash, $conn;

	$Ref = $_POST['ref'];
	$bilagart = $_POST['bilagsart'];
	$dato = $_POST['dato'];
	$debet = $_POST['debet'];
	$kredit = $_POST['kredit'];
	$belop = $_POST['belop'];
	/*
							 $valuta = $_POST['valuta'];
							 if ($valuta != 0) {
								 $currency = substr($valuta, 4);
								 $valuta = substr($valuta, 0, 3);
								 $rate = fdiv($belop, $currency);
							 } else {
								 $currency = 0;
								 $valuta = 'NOK';
								 $rate = 0; //(NULL);
							 }*/
	$tekst = $_POST['tekst'];
	//	$buntnr = $_POST['buntnr'];
	$bilagsart = $_POST['bilagsart'];
	//	$periode = FManed($dato);
	//echo $belop . ' : ' . $valuta . ' : ' . $currency . ' : ' . $rate . '<br>';

	$i = strpos($dato, '-');
	if ($i == 1)
		$dato = "0" . $dato;
	$i = strpos($dato, '-');
	$j = strpos($dato, '-', ++$i);
	if ($j == 4)
		$dato = substr($dato, 0, --$j) . '0' . substr($dato, $j);
	$dato = substr($dato, 6, 4) . '-' . substr($dato, 3, 2) . '-' . substr($dato, 0, 2);
	//	echo 'dato2 '.$dato;
	if ($belop == 0)
		$belop = '(NULL)';
	$sql = 'Update ' . $hash . 'regn_trans set dato="' . $dato . '",debet=' . $debet . ',kredit=' . $kredit
		. ',belop=' . $belop . ',tekst="' . $tekst . '" where ref=' . $Ref;
	echo $sql;
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	//printf("%s (%s)\n", $row[0], $row[1]);
	if ($result->num_rows == 0)
		echo 'ukjent';
	else
		echo json_encode($row);
	$result->free_result();
}








function f_importer_budsjett()
{
	echo "f_importer_budsjett<br>";
}

function oppd_kto()
{
	global $hash, $conn;
	$kto = $_POST['kto'];
	$ar = $_POST['ar'];
	$per = $_POST['per'] + 1;
	$budsj = $_POST['budsj'];
	$sql = 'update  ' . $hash . 'regn_saldo set budsjett=' . $budsj . ' where ar=' . $ar . ' and kto=' . $kto . ' and periode=' . $per . ';';
	$result = $conn->query($sql);
}


function perioder_oppdat()
{
	//echo 'perioder_oppdat<br>';
	global $hash, $conn;
	$kto = $_POST['kto'];
	$ar = $_POST['ar'];
	$valg = $_POST['valg'];
	$far = $ar - 1;
	$arsbudsj = $_POST['arsbudsj'];
	//	echo "perioder_oppdat .$arsbudsj: " . $arsbudsj . ' $kto: ' . $kto . ' $ar: ' . $ar . ' $valg: ' . $valg . ' $far: ' . $far . ' $arsbudsj: ' . $arsbudsj . '<br>';

	/*	$sql = 'DROP table if EXISTS qo7sn_regn_saldo_copy; ';
								$result = $conn->query($sql);
							//	echo "2<br>";
								$sql = 'create table qo7sn_regn_saldo_copy select * from qo7sn_regn_saldo;';
								$result = $conn->query($sql);
							//	echo "3<br>";
								$sql = 'Update qo7sn_regn_saldo  a INNER JOIN qo7sn_regn_saldo_copy AS b ON (a.periode=b.periode)'
									. ' SET a.fjorarstall=b.belop   WHERE a.ar=' . $ar . ' AND b.ar=' . $far . ' AND a.kto=' . $kto . ' AND b.kto=' . $kto . ';';
								$result = $conn->query($sql);
							//	echo "4<br>";
							*/
	if ($valg == "fjor") {

		$bel = 0;
		for ($i = 1; $i < 13; $i++) {

			$sql = 'select * from ' . $hash . 'regn_saldo WHERE ar=' . $ar - 1 . ' AND kto=' . $kto . ' AND periode=' . $i . ';';
			//			echo 'sql1: '. $sql;

			$result = $conn->query($sql);
			$r = $result->num_rows;
			if ($r == 0) {
				$sql = 'INSERT INTO ' . $hash . 'regn_saldo (ar,periode,kto,belop) VALUES (' . $ar - 1 . ',' . $i . ',' . $kto . ',' . $bel . ');';
				///			echo 'sql2: ' . $sql;
				$result = $conn->query($sql);
			}



			//$sql=' Update qo7sn_regn_saldo AS a INNER JOIN  qo7sn_regn_saldo AS b SET a.fjorarstall = b.belop WHERE a.ar=2012 AND b.ar=2011 and a.kto=4033 and b.kto=4033 AND a.periode=b.periode;';

			//	$sql = 'Update ' . $hash . 'regn_saldo  set budsjett=fjorarstall WHERE ar=' . $ar . ' AND kto=' . $kto . ';';
			//		echo $sql;
			//	$result = $conn->query($sql);
			//			echo "5<br>";

		}
		$sql = ' Update ' . $hash . 'regn_saldo AS a INNER JOIN  ' . $hash . 'regn_saldo AS b SET a.fjorar = b.belop WHERE a.ar=' . $ar . ' AND b.ar=' . $ar - 1 . ' and a.kto=' . $kto . ' and b.kto=' . $kto . ' AND a.periode=b.periode;';
		//	echo 'sql3: ' . $sql;
		$result = $conn->query($sql);
	} else if ($valg == "budsj") {
		//	$arsbudsj = $arsbudsj;
		$bel = 0;
		for ($i = 1; $i < 13; $i++) {
			$sql = 'select * from  ' . $hash . 'regn_saldo  WHERE ar=' . $ar . ' AND kto=' . $kto . ' AND periode=' . $i . ';';
			$result = $conn->query($sql);
			//	echo 'sql4: ' . $sql;
			$r = $result->num_rows;
			//	echo '$r: '.$r;
			if ($r == 0)
				$sql = 'INSERT INTO ' . $hash . 'regn_saldo (ar,periode,kto,belop,budsjett) VALUES (' . $ar . ',' . $i . ',' . $kto . ',' . $bel . ',' . $arsbudsj . ');';
			else
				$sql = 'Update ' . $hash . 'regn_saldo  set budsjett=' . $arsbudsj . ' WHERE ar=' . $ar . ' AND kto=' . $kto . ' AND periode=' . $i . ';';
			//	echo 'sql5: ' . $sql;
			$result = $conn->query($sql);
			//			echo "6<br>";

		}
	}
	// echo "7<br>";
	$sql = 'select * from  ' . $hash . 'regn_saldo  WHERE ar=' . $ar . ' AND kto=' . $kto . ';';
	//	echo 'sql6: ' . $sql;
	$result = $conn->query($sql);
	//	echo "7<br>";

	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	//	echo "8<br>";

	echo json_encode($emparray);
}




function perioder_hent()
{
	global $hash, $conn;
	$kto = $_POST['kto'];
	$ar = $_POST['ar'];
	//   echo 'perioder_hent ar: '.$ar.'  kto: '.$kto.'<br>';
	$sql = 'SELECT * FROM ' . $hash . 'regn_firma';
	$result = $conn->query($sql);
	$temparray = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray = $row;
	//	 $obj=json_encode($emparray);
	$obj = json_decode(json_encode($temparray));
	$regnskapsar = $obj->regnskapsar;
	//	$ar = $regnskapsar;

	// $obj->regnskapsar.'<br>';
	//echo ' hentet regnskapsar: '.$emparray[0].regnskapsar.'<br>';

	//	$sql = 'SELECT * FROM ' . $hash . 'regn_saldo AS a INNER JOIN ' . $hash . 'regn_perioder AS b ON a.periode=b.nr WHERE (a.ar=' . $ar . ' or a.ar=' . $ar - 1 . ') AND a.kto=' . $kto . ' ORDER BY b.nr, a.ar';
	$sql = 'SELECT * FROM ' . $hash . 'regn_saldo AS a INNER JOIN ' . $hash . 'regn_perioder AS b ON a.periode=b.nr WHERE (a.ar=' . $ar . ') AND a.kto=' . $kto . ' ORDER BY b.nr, a.ar';
	//	echo $sql;
	$result = $conn->query($sql);
	$temparray1 = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray1[] = $row;
	echo json_encode($temparray1);
}


function konto_hent()
{
	//	echo 'konto_hent()';
	global $hash, $conn;
	$kto = $_POST['kto'];
	$sql = 'select * from  ' . $hash . 'regn_kto   where Ktonr=' . $kto . ';';
	//	echo $sql;
	$result = $conn->query($sql);
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray = $row;
	}
	echo json_encode($emparray);
}


function f_konto_oppdat()
{
	//	echo 'f_konto_oppdat()';

	global $hash, $conn;

	$kto = $_POST['kto'];
	$navn = $_POST['navn'];
	$rapportlinje = $_POST['rapportlinje'];

	$sql = 'update ' . $hash . 'regn_kto  set Navn="' . $navn . '", rapportlinje="' . $rapportlinje . '"  where Ktonr=' . $kto . ';';
	//echo $sql;
	$result = $conn->query($sql);
}

function f_debitorer()
{
	global $hash, $conn;

	$sql = 'SELECT * FROM ' . $hash . 'regn_debitorer';
	//	echo 'f_debitorer: '.$sql.'<br>';
	$result = $conn->query($sql);
	//$row = $result->fetch_array(MYSQLI_ASSOC);
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	echo json_encode($emparray);
}

function f_currency()
{
	$inn = $_POST['inn'];
	$ut = $_POST['ut'];
	$belop = $_POST['belop'];
	//echo $inn.' : '.$ut.' : '.$belop;
	global $hash, $conn;
	$key = '0e47c9534f62f4c54b2ef46b';
	$from_currency = $inn; //'DKK';
	//$my_var = file_get_contents('https://v6.exchangerate-api.com/v6/'.$key.'/latest/'.$from_currency.');
	//$url='https://v6.exchangerate-api.com/v6/'.$key.'/latest/'.$from_currency;
	//echo $url.'<br>';
	$my_var = file_get_contents('https://v6.exchangerate-api.com/v6/' . $key . '/latest/' . $from_currency);
	//echo $my_var;
	$gg = json_decode($my_var);
	//echo '<br><bt>'.$gg;
	$tt = $gg->conversion_rates;
	$hh = $tt->NOK;
	echo $hh * $belop;
}
function f_sistetrans()
{
	global $hash, $conn;

	$sql = 'SELECT * FROM ' . $hash . 'regn_trans order by Ref DESC LIMIT 1;';
	$result = mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	$ant = $result->num_rows;
	// echo '<br>Antall: '.$result->num_rows.'<br>';   
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	echo json_encode($emparray);
}


function f_listart()
{
	//echo 'teset<br>';

	global $hash, $conn;

	//echo 'f_listart<br>';
	$sql = 'select * from 	' . $hash . 'regn_bilagsarter order by id;';
	$result = mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	$ant = $result->num_rows;
	// echo '<br>Antall: '.$result->num_rows.'<br>';   
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	echo json_encode($emparray);
}

function f_sjekk_hist()
{
	//echo 'f_hentart';
	global $hash, $conn;

	//  $kto=$_GET['kto'];
	//	$dato=$_GET['dato'];
	$dato = $_POST['dato'];
	$belop = $_POST['belop'];

	$sql = 'select * from 	' . $hash . 'regn_hist where belop=' . $belop . ' and dato="' . $dato . '";';
	//   echo 'sql: '.$sql;



	$result = mysqli_query($conn, $sql);
	//$result = $conn->query($sql);
	$ant = $result->num_rows;
	// echo '<br>Antall: '.$result->num_rows.'<br>';   
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	echo json_encode($emparray);


}










// 	$result = $conn->query($sql);
// 	$row = $result->fetch_array(MYSQLI_ASSOC);
// 	//printf("%s (%s)\n", $row[0], $row[1]);
// 	if ($result->num_rows == 0)
// 		echo 'ukjent';
// 	else
// 		echo json_encode($row);
// 	$result->free_result();
// }

function f_sjekk_trans()
{
	//echo 'f_hentart';
	global $hash, $conn;

	//  $kto=$_GET['kto'];
	//	$dato=$_GET['dato'];
	$dato = $_POST['dato'];
	$belop = $_POST['belop'];

	$sql = 'select * from 	' . $hash . 'regn_trans where belop=' . $belop . ' and dato="' . $dato . '";';
	//  echo 'sql: '.$sql;


	$result = mysqli_query($conn, $sql);
	//$result = $conn->query($sql);
	$ant = $result->num_rows;
	// echo '<br>Antall: '.$result->num_rows.'<br>';   
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	echo json_encode($emparray);















	// $result = $conn->query($sql);
	// $row = $result->fetch_array(MYSQLI_ASSOC);

	// if ($result->num_rows == 0)
	// 	echo 'ukjent';
	// else
	// 	echo json_encode($row);
	// $result->free_result();
}


function f_hentart()
{
	//echo 'f_hentart';
	global $hash, $conn;

	//  $kto=$_GET['kto'];
	//	$dato=$_GET['dato'];
	$art = $_POST['art'];
	$sql = 'select * from 	' . $hash . 'regn_bilagsarter where id=' . $art;
	//   echo 'sql: '.$sql;
	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	//printf("%s (%s)\n", $row[0], $row[1]);
	if ($result->num_rows == 0)
		echo 'ukjent';
	else
		echo json_encode($row);
	$result->free_result();
}


function test()
{
	echo 'test<br>';
}



function f_ktoinfo()
{
	//		echo 'f_ktoinfo<br>';
	global $hash, $conn;

	//  $kto=$_GET['kto'];
	//	$dato=$_GET['dato'];
	$kto = $_POST['kto'];
	$dato = $_POST['dato'];
	//	echo 'kto ' . $kto . '  dato ' . $dato . '<br>';
	/*
											  //   echo $kto.'  '.$dato.'  '.$periode.'<br>';;
												 if ($dato=='' and $kto=='')
												 exit("Ugyldig dato og konto");
												 if ($dato=='')
												 exit("Ugyldig dato");
												 if ($kto=='')
												 exit("Ugyldig  konto");     
												 */

	if (!$dato == '') {
		$i = strpos($dato, '-', );
		$j = strpos($dato, '-', $i + 1);
		$periode = substr($dato, $i + 1, $j - $i - 1);

		//echo 'feil';
		//	else

		//	echo 'kto: '.$kto.'  dato: '.$dato.'<br>';
		$i = strpos($dato, "-");
		$j = strpos($dato, "-", $i + 1);
		//	echo '$i: '.$i.' $j: '.$j.'<br>';
		if ($i == 4) {
			$periode = substr($dato, $i + 1, 2);
			$arstall = substr($dato, 0, 4);

		} else {
			$periode = substr($dato, $i + 1, $j - $i - 1);
			$arstall = substr($dato, $j + 1, 4);
		}
		;
		$sql = 'SELECT * FROM qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ' AND kto=' . $kto . ';';
		//	echo 'sql1: ' . $sql . '<br>';
		$result = $conn->query($sql);
		//	 echo 'result: '.$result->num_rows.'<br>';
		if ($result->num_rows != 0) {
			//		echo 'dato: '.$dato.'  kto: '.$kto.' Årstall: '.$arstall.' Periode: '.$periode.' $i: '.$i.' $j: '.$j.'<br>';
			$sql = 'SELECT SUM(a.belop) as hittil,SUM(a.budsjett) as sumbudsj,c.Ktonr,b.budsjett,c.Navn,b.belop,a.resbal,a.periode, proc_periode(a.periode) ' .
				'FROM ' . $hash . 'regn_saldo AS a INNER JOIN ' . $hash . 'regn_saldo AS b,' . $hash . 'regn_kto AS c ' .
				' WHERE c.Ktonr=' . $kto . ' and a.ar=' . $arstall . ' AND a.kto=' . $kto . ' AND a.periode<=' . $periode . ' and b.ar=' . $arstall . ' AND b.kto=' . $kto . ' AND a.periode=' . $periode . ';';
			//$sql = 'SELECT SUM(belop) as a FROM ' . $hash . 'regn_saldo WHERE ar='.$arstall.' AND kto='.$kto.' AND periode<'.$periode.';';
			//		echo 'sql2: ' . $sql . '<br>';
			// }}
			// function dddf()
			// {		{	
			/*
																					  $sql = 'select * from 	' . $hash . 'regn_kto_hittil_budsjett AS info INNER JOIN ' . $hash . 'regn_kto AS kto ON kto.Ktonr=info.Ktonr  where info.Ktonr=' . $kto . ' and info.arstall=' . substr($dato, $j + 1, 4) . ' and info.periode=' . $periode . ';';
																					  //$sql= 'select * from 	'.$hash.'regn_kto_hittil_budsjett AS info INNER JOIN '.$hash.'regn_kto AS kto ON kto.Ktonr=info.Ktonr  where info.Ktonr='.$kto.' and info.arstall=2015 and info.periode='.$periode.';';
																					  //	echo 'sql1: '.$sql.'<br>';
																			  echo '*****************'.$sql.'<br>';
																			  */
			$result = $conn->query($sql);
			/*	if ($result->num_rows == 0) {
																									 $sql = 'select * from 	' . $hash . 'regn_kto AS info  where info.Ktonr=' . $kto . ';';
																									 $result = $conn->query($sql);

																									 //	echo '    sql: '.$sql.'<br>';
																								 }
																								 ;
																							 */
		} else {
			$sql = 'select Ktonr,Navn from 	' . $hash . 'regn_kto AS info  where info.Ktonr=' . $kto . ';';
			//			echo 'sql3: ' . $sql . '<br>';
			$result = $conn->query($sql);
		}
	} else {
		$sql = 'select Ktonr,Navn from 	' . $hash . 'regn_kto AS info  where info.Ktonr=' . $kto . ';';
		//		echo 'sql4: ' . $sql . '<br>';
		$result = $conn->query($sql);
	}
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo json_encode($row);
	//$result->free_result();
}



function f_oppdater()
{
	echo 'f_oppdater<br>';
	global $hash, $conn;
	//} function dddd(){
	$Ref = $_POST['ref'];
	$bilag = $_POST['bilagsnr'];
	$dato = $_POST['dato'];
	$debet = $_POST['debet'];
	$kredit = $_POST['kredit'];
	$belop = $_POST['belop'];
	$valuta = $_POST['valuta'];
	if ($valuta != 0) {
		$currency = substr($valuta, 4);
		$valuta = substr($valuta, 0, 3);
		$rate = fdiv($belop, $currency);
	} else {
		$currency = 0;
		$valuta = 'NOK';
		$rate = 0; //(NULL);
	}
	$tekst = $_POST['tekst'];
	$buntnr = $_POST['buntnr'];
	$bilagsart = $_POST['art'];
	$periode = FManed($dato);
	echo $belop . ' : ' . $valuta . ' : ' . $currency . ' : ' . $rate . '<br>';
	if (($dato[4] == '-') && ($dato[7] == '-')) {

	} else {
		$i = strpos($dato, '-');
		if ($i == 1)
			$dato = "0" . $dato;
		$i = strpos($dato, '-');
		$j = strpos($dato, '-', ++$i);
		if ($j == 4)
			$dato = substr($dato, 0, --$j) . '0' . substr($dato, $j);
		$dato = substr($dato, 6, 4) . '-' . substr($dato, 3, 2) . '-' . substr($dato, 0, 2);

		//	echo 'dato2 '.$dato;
	}
	if ($belop == 0)
		$belop = '(NULL)';
	/*if ($_POST["kommando"]=="slett")
												 $sql = "DELETE FROM fb8c8_regn_trans ORDER BY Ref DESC LIMIT 1;";
											 else
											 */
	$sql = 'INSERT INTO ' . $hash . 'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,currency_amount,currency,currency_rate,tekst,Buntnr,Regdato,Bilagsart,periode)
VALUES ("' . $Ref . '","' . $bilag . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","' . $currency . '","' . $valuta . '","' . $rate . '","' . $tekst . '","' . $buntnr . '","' . date("Y-m-d") . '","' . $bilagsart . '","' . $periode . '")';
	//	echo $sql;

	/* $sql = 'INSERT INTO '.$hash.'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,tekst,Buntnr,Regdato,Bilagsart)
											   VALUES ('.$Ref.','.$bilag.',"'.$Dato.'","'.$debet.'","'.$kredit.'",'.$belop.',"'.$tekst.'",'.$buntnr.',"'.$now.'","'.$bilagsart.'")';
											 */
	/*	$sql = "UPDATE `crud` 
												 SET `name`='$name',
												 `email`='$email',
												 `phone`='$phone',
												 `city`='$city' WHERE id=$id";
												 echo 'sql: '.$sql.'<br>';
												*/
	//$sql='insert into prmk2_regn_trans  (Ref,bilag) values (5,6);';
	//  $result -> free_result();

	//  $result = $conn -> query($sql);
	//$result = $conn -> query($sql);

	$result = mysqli_query($conn, $sql);

	//$result1=$buntnr;


	$sql = 'select * from ' . $hash . 'regn_trans order by Ref desc limit 1';
	$result = mysqli_query($conn, $sql);
	//echo json_encode($result);
	//echo $buntnr;
	/*
												 if (mysqli_query($conn, $sql)) {
													 echo json_encode(array("statusCode"=>200));
												 } 
												 else {
													 echo json_encode(array("statusCode"=>201));
												 }
												 */
	mysqli_close($conn);
}


function f_konto()
{
	global $hash, $conn;

	$sql = 'select * from ' . $hash . 'regn_kto where Ktonr=' . $_POST['konto'];
	//echo 'sql: ' . $sql . '<br>';



	$result = $conn->query($sql);
	$row = $result->fetch_array(MYSQLI_ASSOC);
	//printf("%s (%s)\n", $row[0], $row[1]);
	if ($result->num_rows == 0)
		echo 'ukjent';
	else
		echo json_encode($row);
	$result->free_result();
}


function f_ktosok()
{
	global $hash, $conn, $database;

	$ktosok = $_POST["ktosok1"];

	// echo 'f_ktosok: |'.$ktosok.'|';

	if (($ktosok == 0) || ($ktosok == '')) {
		$sql = 'SELECT * FROM  ' . $hash . 'regn_kto order by Ktonr;';//}
// 	//	$sql = 'SELECT Ktonr,Navn,rapportlinje,B.tekst,ResBal FROM qo7sn_regn_kto AS A INNER JOIN qo7sn_regn_resmal AS B WHERE A.ResBal=B.BR AND A.rapportlinje=B.nr AND B.BR="R" ORDER BY Ktonr;';

	} else {
		//	$ktosok=$_GET["ktosok1"];
		//echo 'ktosok '.$ktosok.' : '.$ktosok[0].'<br>';
		if (($ktosok[0] >= '0') && ($ktosok[0] <= '9'))
			$sql = 'SELECT * FROM  ' . $hash . 'regn_kto WHERE Ktonr LIKE "' . $ktosok . '%"';
		else
			$sql = 'SELECT * FROM  ' . $hash . 'regn_kto WHERE Navn LIKE "%' . strtolower($ktosok) . '%" order by Navn';
	}
	//	echo 'sql: '.$sql.'<br>';
	//echo 'sqk: '.$sql.'<br>';
	$result = mysqli_query($conn, $sql);
	//$result = $conn->query($sql);
	$ant = $result->num_rows;
	// echo '<br>Antall: '.$result->num_rows.'<br>';   
	$emparray = array();
	while ($row = mysqli_fetch_assoc($result))
	//for ($i=1;$i<=$ant;$i++)
	{
		$emparray[] = $row;
	}
	echo json_encode($emparray);
}
//  $result = $conn -> query($sql);
//  $row = $result -> fetch_array(MYSQLI_ASSOC);
//  $row = $result -> fetch_array($result);
/*echo '<br>'.$result->num_rows;

	  if ($result->num_rows==0)
		 echo 'ukjent';
	  else 
    //$result -> free_result();


    /*
          $result = mysqli_query($conn,$sql);
          $row = mysqli_fetch_array($result);
          echo json_encode($row);

        $db    = JFactory::getDBO();
        $query = $db->getQuery(true);
     * /
    // $query = 'SELECT * FROM  prmk2_regn_kto WHERE Ktonr LIKE "4%"';
      echo 'query: '.$sql.'<br>';
* /   $database->setQuery($sql);
    $messages = $database->loadObjectList();//          Column();//            loadObjectList();
    echo json_encode($messages->Ktonr);
}
		/*  foreach ($messages as $message)
		  {
	   echo $message->Ktonr . "</br>";}
	   * /







	  }*/


function f_oppdater_hist()
{
	global $hash, $conn;



	//	$conn = new PDO("mysql:host=localhost;dbname=database", "username", "password");
//	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	// Prepare the stored procedure call
	$stmt = $conn->prepare("CALL proc_oppdater_trans1()");

	// Set the parameters
	// $param1 = 'value1';
	// $param2 = 'value2';

	// Execute the stored procedure
//	$stmt->execute([$param1, $param2]);
	$stmt->execute();

	// Fetch result if the procedure returns a result set
	// $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
	// foreach ($result as $row) {
	// 	print_r($row);













	/*





					   //$result = mysqli_query($conn, "'CALL proc_oppdater_trans");


					   //    try {
							 //  $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
							   // execute the stored procedure
							   $sql = 'CALL proc_oppdater_trans1();';
							   // call the stored procedure
							   $result = $conn->query($sql);
							//   $q = $pdo->query($sql);
							//   $result->setFetchMode(PDO::FETCH_ASSOC);

					   //	}

				   */




	//$sql= 'call proc_oppdater_trans();';
//'TRUNCATE TABLE qo7sn_regn_trans;';
	// $sql = '	INSERT INTO ' . $hash . 'regn_hist (ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,Bilag,Bilagsart,Periode)
	// 	SELECT Ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,bilag,Bilagsart,periode
	// 	FROM ' . $hash . 'regn_trans;';
//	echo 'sql: ' . $sql . '<br>';
	// $result = mysqli_query($conn, $sql);
	//$result = $conn->query($sql);
	//echo 'result: '.$result->num_rows.'<br>';
	/*
					  $sql = ' delete from ' . $hash . 'regn_trans';
					  $result = mysqli_query($conn, $sql);

					  $sql = '	update ' . $hash . 'regn_trans set debet=debet+ (ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,Bilag,Bilagsart,Periode)
						  SELECT Ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,bilag,Bilagsart,periode
						  FROM ' . $hash . 'regn_trans;';
					  echo 'sql: ' . $sql . '<br>';
					  $result = mysqli_query($conn, $sql);
					  $sql = ' delete from ' . $hash . 'regn_trans';
					  $result = mysqli_query($conn, $sql);*/

}

function f_sart()
{
	global $hash, $conn;
	$art = $_POST["art"];
	//	echo 'update sart: '.$art.'<br>';
	$sql = 'select * from ' . $hash . 'regn_bilagsarter where art="' . $art . '";';
	//echo 'sql: '.$sql;
	//$result=mysqli_query($conn, $sql);
	$result = $conn->query($sql);
	//echo $result->fetch_object
	$row = $result->fetch_array(MYSQLI_ASSOC);
	echo json_encode($row);
	//$result -> loadResult()
}


function f_art()
{
	global $hash, $conn;
	$mode = "art";
	$art = $_POST["art"];
	$beskrivelse = $_POST['beskrivelse'];
	$dato = $_POST['dato'];
	$debet = $_POST['debet'];
	$kredit = $_POST['kredit'];
	$belop = $_POST['belop'];
	$tekst = $_POST['tekst'];

	$sql = 'select * from ' . $hash . 'regn_bilagsarter where art="' . $art . '";';
	$result = $conn->query($sql);
	echo '$result: ' . $result->num_rows;
	if ($result->num_rows > 1) {
		$sql = 'update ' . $hash . 'regn_bilagsarter  set art="' . $art . '",beskrivelse="' . $beskrivelse . '",dato="'
			. $dato . '",debet="' . $debet . '",kredit="' . $kredit . '",belop="' . $belop . '",tekst="' . $tekst . '";';
		echo 'sql: ' . $sql . '<br>';
		$result = $conn->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo json_encode($row);
		$result->free_result();
	} else {
		$sql = 'update ' . $hash . 'regn_bilagsarter  set art=' . $art . ',beskrivelse="' . $beskrivelse . '",dato='
			. $dato . ',debet=' . $debet . ',kredit=' . $kredit . ',belop=' . $belop . ',tekst="' . $tekst . '";';
		echo 'sql: ' . $sql . '<br>';
		$result = $conn->query($sql);
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo json_encode($row);
		$result->free_result();
	}
}



function f_artcheck()
{
	global $hash, $conn;
	$mode = "art";
	$art = $_POST['art'];
	$sql = 'select * from  ' . $hash . 'regn_bilagsarter  where art=' . $art . ';';
	// echo 'sql: '.$sql;
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
		$row = $result->fetch_array(MYSQLI_ASSOC);
		echo json_encode($row);
		$result->free_result();
	} else
		echo '{"art":"0"}';
}

function FManed($now1)
{
	// $manded='test'; 
	$month = date("m", strtotime($now1));
	switch ($month) {
		case 1:
			$manded = 'Januar';
			break;
		case 2:
			$manded = 'Februar';
			break;
		case 3:
			$manded = 'Mars';
			break;
		case 4:
			$manded = 'April';
			break;
		case 5:
			$manded = 'Mai';
			break;
		case 6:
			$manded = 'Juni';
			break;
		case 7:
			$manded = 'Juli';
			break;
		case 8:
			$manded = 'August';
			break;
		case 9:
			$manded = 'September';
			break;
		case 10:
			$manded = 'Oktober';
			break;
		case 11:
			$manded = 'November';
			break;
		case 12:
			$manded = 'Desember';
			break;
	}
	return $manded;
}