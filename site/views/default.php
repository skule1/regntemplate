<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
 
// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<h1><?php echo $this->msg; ?></h1>


<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">
function neste(i) {
    document.getElementById(i + 1).focus();
}
</script>

<?php    
	$db    = JFactory::getDBO();
	$query = $db->getQuery(true);
	$query->select('Dato,debet,kredit,belop');
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


$conf = new JConfig();
$database=$conf->db;
$hash= $conf->dbprefix;

 function databaseconnect()
{
$conf= new JConfig();
$servername = "localhost";
$username = "admin";
$password = "230751";
$database=$conf->db;
$conn = new mysqli($servername, $username, $password,$database);
if ($conn->connect_error) {die("Connection failed: " . $conn->connect_error);}

if (!$conn->set_charset("latin1")) {
printf("Error loading character set latin1: %s\n", $conn->error);
exit();
 };
//else {printf("Current character set: %s\n", $conn->character_set_name());}
return $conn;
}


if(isset($_GET['Send'])){ //check if form was submitted
  $input = $_GET['1']; //get input text
echo "Success! You entered: ".$input.'<br>';
}   

$link=databaseconnect();
$sql = 'SELECT * FROM  '.$hash.'regn_reg';

?>

<form action="" method="get" name="reg">
    <table id="e" border="1" cellspacing="1" cellpadding="1">
        <tr>
            <th scope="col" width="20">
                Dato
            </th>
            <th scope="col" width="20">
                Debet
            </th>
            <th scope="col" width="20">
                Kredit
            </th>
            <th scope="col" width="20">
                Beløp
            </th>
            <th scope="col" width="20">
                Tekst
            </th>
            <th scope="col">&nbsp;</th>
        </tr>
        <?php
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['debet'] . "</td>";
            echo "<td>" . $row['kredit'] . "</td>";
            echo "<td>" . $row['belop'] . "</td>";
            echo "</tr>";
        }
    }
}
?>
        <td> <input type="text" align="left" name="1" id="1" style="height:13px; width:50px;" onchange="neste(1)" />
        </td>
        <td> <input type="text" name="2" id="2" style="height:13px; width:100px;" onchange="neste(2)" /></td>
        <td><input type="text" id="3" style="height:13px; width:100px;" onchange="neste(3)"> </td>
        <td><input type="text" id="4" style="height:13px; width:100px;" onchange="neste(4)"> </td>
        <td><input type="text" id="5" style="height:13px; width:100px;"> </td>
        </tr>
        <tr>
            <td colspan="5" align="right"><input type="Submit" name="Send" id="ok" value="Submit" style="width:100px;"
                    onclick="this.disabled=0" ; />
            </td>
        </tr>
    </table>
</form>