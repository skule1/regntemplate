<?php
echo 'start<br>';

	$servername = "localhost";
	$username = "admin";
	$password = "230751";
	$db="joomla_db";
	/* Create connection */
	$conn = mysqli_connect($servername, $username, $password,$db);
	$Dato=$_POST['Dato'];
	$debet=$_POST['debet'];
	$kredit=$_POST['kredit'];
	$belop=$_POST['belop'];
	$tekst=$_POST['tekst'];
	//$belop='200';
	//$Dato='2020-02-03';
	   // $sql = 'INSERT INTO fb8c8_regn_trans  (Dato)  VALUES ("'.$Dato.'")';
//   $sql = 'INSERT INTO fb8c8_regn_trans  (Dato,debet,kredit,belop,tekst)  
 //  VALUES ("'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'",'.$belop.'","'.$tekst.'")';

if ($_GET["kommando"]=="slett"){
	$sql = "DELETE FROM fb8c8_regn_trans ORDER BY Ref DESC LIMIT 1;";
}
else

    $sql = 'INSERT INTO fb8c8_regn_trans  (Dato,debet,kredit,belop,tekst)  
	VALUES ("'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'","'.$tekst.'")';
/*	$sql = "UPDATE `crud` 
	SET `name`='$name',
	`email`='$email',
	`phone`='$phone',
	`city`='$city' WHERE id=$id";
    echo 'sql: '.$sql.'<br>';
   */
	if (mysqli_query($conn, $sql)) {
		echo json_encode(array("statusCode"=>200));
	} 
	else {
		echo json_encode(array("statusCode"=>201));
	}
    
	mysqli_close($conn);
    
?>