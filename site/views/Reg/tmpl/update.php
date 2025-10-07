<?php
//defined('_JEXEC') or die('Restricted access');

require  $_SERVER['DOCUMENT_ROOT'] . '/configuration.php';

$conf = new JConfig();
$database=$conf->db;
$hash= $conf->dbprefix;


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
	
	$conn = mysqli_connect($servername, $username, $password,$database);
/*
if (isset($_POST['mode']))  {
		echo 'mode: ';
	};
*/



	if (isset($_POST['mode']) && $_POST['mode']=="artcheck") 
		f_artcheck();
	elseif (isset($_POST['mode']) && $_POST['mode']=="art")
		f_art();
	elseif(isset($_POST['mode']) && $_POST['mode']=="oppdater4")
		f_oppdater4();
		elseif (isset($_POST['mode']) && $_POST['mode']=="konto") 
		f_konto();
		elseif (isset($_POST['mode']) && $_POST['mode']=="ktosok") 
		f_ktosok();
	elseif(isset($_POST['mode']) && $_POST['mode']=="oppdater")
		f_oppdater();
	elseif(isset($_POST['mode']) && $_POST['mode']=="sart")
		f_sart();





	function f_oppdater()
	{
		global $hash,$conn;

	$Ref=$_POST['ref'];
	$bilag=$_POST['bilagsnr'];
	$dato=$_POST['dato'];
	$debet=$_POST['debet'];
	$kredit=$_POST['kredit'];
	$belop=$_POST['belop'];
	$tekst=$_POST['tekst'];
	$buntnr=$_POST['buntnr'];
	$bilagsart=$_POST['art'];
	$periode=FManed( $dato);
	//echo 'dato1 '.$dato;

	$i=strpos($dato,'-');
	if ($i==1)   $dato="0".$dato;
	$i=strpos($dato,'-');
	$j=strpos($dato,'-',++$i);
	if ($j==4) $dato=substr($dato,0,--$j).'0'.substr($dato,$j);
	$dato=substr($dato,6,4).'-'.substr($dato,3,2).'-'.substr($dato,0,2);
//	echo 'dato2 '.$dato;
 if ($belop==0) $belop='(NULL)';
/*if ($_POST["kommando"]=="slett")
	$sql = "DELETE FROM fb8c8_regn_trans ORDER BY Ref DESC LIMIT 1;";
else
*/
$sql = 'INSERT INTO '.$hash.'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,tekst,Buntnr,Regdato,Bilagsart,periode)
VALUES ("'.$Ref.'","'.$bilag.'","'.$dato.'","'.$debet.'","'.$kredit.'","'.$belop.'","'.$tekst.'","'.$buntnr.'","'.date("Y-m-d").'","'.$bilagsart.'","'.$periode.'")';
//echo $sql;

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

$result=mysqli_query($conn, $sql);

//$result1=$buntnr;


$sql='select * from '.$hash.'regn_trans order by Ref desc limit 1';

$result=mysqli_query($conn, $sql);


echo json_encode($result);
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
		global $hash,$conn;

	$sql = 'select * from '.$hash.'regn_kto where Ktonr='.$_POST['konto'];
	//echo 'sql: ' . $sql . '<br>';
	


	$result = $conn -> query($sql);
    $row = $result -> fetch_array(MYSQLI_ASSOC);
	if ($result->num_rows==0)
	   echo 'ukjent';
	else 
	echo json_encode($row);
	$result -> free_result();
      }

	  function f_ktosok()
	  {
	//	echo 'ktosok';
		global $hash,$conn,$database;

      $sql='SELECT * FROM  '.$hash.'regn_kto WHERE Ktonr LIKE "'.$_POST["ktosok"].'%"';
	  //echo $sql;
	  //$result = $conn -> query($sql);
	 //$row = $result -> fetch_array(MYSQLI_ASSOC);
	  //$row = $result -> fetch_array($result);
	  /*if ($result->num_rows==0)
		 echo 'ukjent';
	  else */

	  //$result -> free_result();


/*
	  $result = mysqli_query($conn,$sql);
	  $row = mysqli_fetch_array($result);
	  echo json_encode($row);

	$db    = JFactory::getDBO();
	$query = $db->getQuery(true);
 */
	  $query = 'SELECT * FROM  prmk2_regn_kto WHERE Ktonr LIKE "4%"';
	  $database->setQuery((string) $query);
	  $messages = $database->loadObjectList();//          Column();//            loadObjectList();
	  echo json_encode($messages->Ktonr);
		/*  foreach ($messages as $message)
		  {
	   echo $message->Ktonr . "</br>";}
	   */







	  }


	  function f_oppdater4()
	{
		global $hash,$conn;

		$sql = '	INSERT INTO '.$hash.'regn_hist (ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,Bilag,Bilagsart,Periode)
		SELECT Ref,Dato,debet, kredit,belop,Tekst,Buntnr,Regdato,bilag,Bilagsart,periode
		FROM '.$hash.'regn_trans;';
		echo 'sql: '.$sql.'<br>';
	//	$result=mysqli_query($conn, $sql);
	//	$sql= ' delete from '.$hash.'regn_trans';
	}

	function f_sart(){
		global $hash,$conn;
		$art=$_POST["art"];
	//	echo 'update sart: '.$art.'<br>';
	$sql='select * from ' . $hash . 'regn_bilagsarter where art="'.$art.'";';
	//echo 'sql: '.$sql;
	//$result=mysqli_query($conn, $sql);
	$result = $conn -> query($sql);
	//echo $result->fetch_object
	$row = $result -> fetch_array(MYSQLI_ASSOC);
	echo json_encode($row);
	//$result -> loadResult()
	}


	function f_art()
	{
		global $hash,$conn;
  $mode= "art";
  $art=$_POST["art"];
  $beskrivelse=$_POST['beskrivelse']; 
  $dato=$_POST['dato']; 
  $debet=$_POST['debet']; 
  $kredit=$_POST['kredit']; 
  $belop=$_POST['belop']; 
  $tekst=$_POST['tekst'];

  $sql='select * from ' . $hash . 'regn_bilagsarter where art="'.$art.'";';
  $result = $conn -> query($sql);
  echo '$result: '.$result->num_rows;
if ($result->num_rows>1)
{	   $sql = 'update ' . $hash . 'regn_bilagsarter  set art="' . $art . '",beskrivelse="' . $beskrivelse . '",dato="'
  . $dato . '",debet="' . $debet . '",kredit="' . $kredit . '",belop="' . $belop . '",tekst="' . $tekst.'";';
  echo 'sql: '.$sql.'<br>';
  $result = $conn -> query($sql);
  $row = $result -> fetch_array(MYSQLI_ASSOC);
  echo json_encode($row);
  $result -> free_result();
}
else
{
  $sql = 'update ' . $hash . 'regn_bilagsarter  set art=' . $art . ',beskrivelse="' . $beskrivelse . '",dato='
  . $dato . ',debet=' . $debet . ',kredit=' . $kredit . ',belop=' . $belop . ',tekst="' . $tekst.'";';
  echo 'sql: '.$sql.'<br>';
  $result = $conn -> query($sql);
  $row = $result -> fetch_array(MYSQLI_ASSOC);
  echo json_encode($row);
  $result -> free_result();
	}

  }



	function 	f_artcheck(){	
		global $hash,$conn;
		$mode= "art";
		$art=$_POST['art']; 
		 $sql = 'select * from  ' . $hash . 'regn_bilagsarter  where art='.$art.';';  
		// echo 'sql: '.$sql;
			$result = $conn -> query($sql);
		if ($result->num_rows>0) {
			$row = $result -> fetch_array(MYSQLI_ASSOC);
		echo json_encode($row);
			$result -> free_result();
				}
				else
				echo '{"art":"0"}';
			  }

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
	?>