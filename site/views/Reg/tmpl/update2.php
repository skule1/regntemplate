<?php
defined('_JEXEC') or die('Restricted access');
echo 'start<br>';

	$servername = "localhost";
	$username = "admin";
	$password = "230751";
	$db="joomla_db";
	/* Create connection * /
	$conn = mysqli_connect($servername, $username, $password,$db);
	$Dato=$_POST['Dato'];
	$debet=$_POST['debet'];
	$kredit=$_POST['kredit'];
	$belop=$_POST['belop'];
	$tekst=$_POST['tekst'];



	$db    = JFactory::getDBO();
	$sql = $db->getQuery(true);
/*	$query->select('Dato,debet,kredit,belop');
	$query->from('#__regn_trans');
	$db->setQuery((string) $query);
	$messages = $db->loadObjectList();
	$options  = array();
    echo '<table id="e" border="1" cellspacing="1" cellpadding="1">';
	if ($messages)
		{
			foreach ($messages as $message)
			{
            echo "<td>" .$message->Dato . "</td>";
            echo "<td>" .$message->debet . "</td>";
            echo "<td>" .$message->kredit . "</td>";
            echo "<td>" .$message->belop . "</td>";
            echo "</tr>";
	    	}
	    }
    echo '</table>';


*/












	//$belop='200';
	//$Dato='2020-02-03';
	   // $sql = 'INSERT INTO fb8c8_regn_trans  (Dato)  VALUES ("'.$Dato.'")';
//   $sql = 'INSERT INTO fb8c8_regn_trans  (Dato,debet,kredit,belop,tekst)  
 //  VALUES ("'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'",'.$belop.'","'.$tekst.'")';
    $sql = 'INSERT INTO fb8c8_regn_trans  (Dato,debet,kredit,belop,tekst) '. 
	'VALUES ("'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'","'.$tekst.'")';

	$db->setQuery((string) $query);
	$messages = $db->loadObjectList();
	$options  = array();

//	'VALUES ("2022-02-01","4010","1010","56","lllll")';
	/*
	//VALUES ("'.$Dato.'","'.$debet.'","'.$kredit.'","'.$belop.'","'.$tekst.'")';
	
	$sql = "UPDATE `crud` 
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