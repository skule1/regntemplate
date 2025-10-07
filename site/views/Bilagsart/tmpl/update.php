<?php
//defined('_JEXEC') or die('Restricted access');

require  $_SERVER['DOCUMENT_ROOT'] . '/configuration.php';
echo 'start3<br>';
$conf = new JConfig();
$database=$conf->db;
$hash= $conf->dbprefix;
$now = date_create()->format('Y-m-d');
$servername = "localhost";
$username = "admin";
$password = "230751";
/*$servername = $conf->host;
$username = $conf->user;
$password = $conf->password;
	/* Create connection */
	
	$conn = mysqli_connect($servername, $username, $password,$database);

	if (isset($_POST['mode']) && $_POST['mode']=="konto")
	f_konto();
	 elseif (isset($_POST['mode']) && $_POST['mode']=="oppdater")
	f_oppdater();
		 elseif (isset($_POST['mode']) && $_POST['mode']=="konto")
	f_konto();
	/* else{
	$Ref=$_POST['Ref'];
	$bilag=$_POST['bilag'];
	$Dato=$_POST['Dato'];
	$debet=$_POST['debet'];
	$kredit=$_POST['kredit'];
	$belop=$_POST['belop'];
	if ($belop==0) $belop='(NULL)';
	$tekst=$_POST['tekst'];
	$buntnr=$_POST['buntnr'];
	$bilagsart=$_POST['Bilagsart'];
	$periode=FManed( $Dato);
	
	//$Dato='2020-02-03';
	   // $sql = 'INSERT INTO fb8c8_regn_trans  (Dato)  VALUES ("'.$Dato.'")';
//   $sql = 'INSERT INTO fb8c8_regn_trans  (Dato,debet,kredit,belop,tekst)  
 //  VALUES ("'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'",'.$belop.'","'.$tekst.'")';

if ($_GET["kommando"]=="slett"){
	$sql = "DELETE FROM fb8c8_regn_trans ORDER BY Ref DESC LIMIT 1;";
}
else

$sql = 'INSERT INTO '.$hash.'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,tekst,Buntnr,Regdato,Bilagsart,periode)
VALUES ("'.$Ref.'","'.$bilag.'","'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'","'.$tekst.'","'.$buntnr.'","'.$now.'","'.$bilagsart.'","'.$periode.'")';
 /* $sql = 'INSERT INTO '.$hash.'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,tekst,Buntnr,Regdato,Bilagsart)
  VALUES ('.$Ref.','.$bilag.',"'.$Dato.'","'.$debet.'","'.$kredit.'",'.$belop.',"'.$tekst.'",'.$buntnr.',"'.$now.'","'.$bilagsart.'")';
*/
/*	$sql = "UPDATE `crud` 
	SET `name`='$name',
	`email`='$email',
	`phone`='$phone',
	`city`='$city' WHERE id=$id";
    echo 'sql: '.$sql.'<br>';
 

};

$result=mysqli_query($conn, $sql);
//echo $sql;
//$result1=$buntnr;
//echo json_encode($result1);
//echo $buntnr;
/*
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    * /


	mysqli_close($conn);
    
*/


	function FManed( $now1)
	{
	  // $manded='test'; 
		$month = date("m",strtotime($now1));
	switch ($month) {
		case 1: $manded='Januar';break;
		case 2: $manded='Februar';break;
		case 3: $manded='Mars';break;
		case 4: $manded='April';break;
		case 5: $manded='Mai';break;
		case 6: $manded='Juni';break;
		case 7: $manded='Juli';break;
		case 8: $manded='August';break;
		case 9: $manded='September';break;
		case 10: $manded='Oktober';break;
		case 11: $manded='November';break;
		case 12: $manded='Desember';break;
	}
	return $manded;
	}
	function 	f_konto()
	{
		global $conn,$hash;

	$sql = 'select * from '.$hash.'regn_kto where Ktonr='.$_POST['konto'];
	$result = $conn -> query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
	echo json_encode($row);
	$result -> free_result();
      }


	  function f_oppdater()
	  {
		echo 'f_oppdater<br>';
	global $conn,$hash;
		$mode= "art";
		$art=$_POST["art"];
	$beskrivelse=$_POST['beskrivelse']; 
	$dato=$_POST['dato']; 
	$debet=$_POST['debet']; 
	$kredit=$_POST['kredit']; 
	//echo 'f_art '.$debet.' : '.$kredit.'<br>';
	$belop=$_POST['belop']; 
		$tekst=$_POST['tekst'];
		$sql='select * from ' . $hash . 'regn_bilagsarter where art="'.$art.'";';
		$result = $conn -> query($sql);
		echo 'antall: '.$result->num_rows;
		if ($dato=='') $dato='(NULL)';
		if ($belop=='') $belop='(NULL)';
		if ($result->num_rows==0)
	{
			if ($belop==0)
	    $sql = 'insert into ' . $hash . 'regn_bilagsarter  (art, beskrivelse, dato,debet,kredit,belop,tekst) 
		value ('.$art.',"'.$beskrivelse.'",'.$dato.',"'. $debet.'","'. $kredit.'",'. $belop.',"'. $tekst.'");';
		else
		$sql = 'insert into ' . $hash . 'regn_bilagsarter  (art, beskrivelse, dato,debet,kredit,belop,tekst) 
		value ('.$art.',"'.$beskrivelse.'",'.$dato.',"'. $debet.'","'. $kredit.'",'. $belop.',"'. $tekst.'");';
	echo 'sql: '.$sql.'<br>';
		$result = $conn -> query($sql);
		$row = $result -> fetch_array(MYSQLI_ASSOC);
		echo json_encode($row);
		$result -> free_result();
		  }
		  else		  
		  {	 

			$sql = 'update ' . $hash . 'regn_bilagsarter  set beskrivelse="' . $beskrivelse . '",dato='
			. $dato . ',debet="' . $debet . '",kredit="' . $kredit . '",belop=' . $belop . ',tekst="' . $tekst.'" where art='.$art.';';
			echo 'sql: '.$sql.'<br>';
		$result = $conn -> query($sql);
			$row = $result -> fetch_array(MYSQLI_ASSOC);
			echo json_encode($row);
			$result -> free_result();
	 }
	
		}
/*
		function  f_oppdater()
		{
			global $conn,$hash;
			 $sql = '	INSERT INTO '.$hash.'regn_hist (ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,Bilag,Bilagsart,Periode)
			 SELECT Ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,bilag,Bilagsart,periode
			 FROM '.$hash.'regn_trans;';
	 //		echo 'sql: '.$sql.'<br>';
			 $result=mysqli_query($conn, $sql);
			 $sql= ' delete from '.$hash.'regn_trans';
		 }
/*
		 function f_oppdater()
		 {
  
		  $sql = '	INSERT INTO '.$hash.'regn_hist (ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,Bilag,Bilagsart,Periode)
		  SELECT Ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,bilag,Bilagsart,periode
		  FROM '.$hash.'regn_trans;';
		  $result=mysqli_query($conn, $sql);
		  $sql= ' delete from '.$hash.'regn_trans';
	  ///	echo 'sql: '.$sql.'<br>';
	  }
 */