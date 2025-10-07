<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<?php 
require  './configuration.php';
$conf = new JConfig();
$database=$conf->db;
$hash= $conf->dbprefix;
$now = date_create()->format('Y-m-d');
echo $now.'<br>';
echo 'hash:'.$hash.'<br>';
$servername = "localhost";
$username = "admin";
$password = "230751";
/*$servername = $conf->host;
$username = $conf->user;
$password = $conf->password;
	/* Create connection */
	$conn = mysqli_connect($servername, $username, $password,$database);
if (isset($_GET["sok"])) {
    if ($_GET["sok"]=='Søk') {
      echo 'sql<br>';
        $sql='select * from '.$hash.'regn_kto where Ktonr='.$_GET["ktonr"];
   //     $result=mysqli_query($conn, $sql);
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
            echo "id: " . $row["Ktonr"]. " - Name: " . $row["Navn"].  "<br>";
           $ktonr= $row["Ktonr"];
           $navn=$row["Navn"];
          }
        } else {
          echo "0 results";
        }
        $conn->close();
        
    }
}
?>
<body><form action="" method="get"><table width="500" border="0" cellspacing="10" cellpadding="2">
  <tr>
    <th scope="row" align="right">Ktonr:</th>
    <td ><input name="ktonr" type="text" value=<?php echo $ktonr?> ></td>
  </tr>
  <tr>
    <th align="right" scope="row" >Navn:
    </th>
    <td><input name="navn" type="text" value=<?php echo $navn?>></td>
  </tr>
   <tr>
    <th align="right" scope="row" >Res/Bal:
    </th>
    <td>
      <label>
        <input type="radio" name="resbal" value="res" id="RadioGroup1_0"  <?php if (isset($_GET["resbal"])) if($_GET["resbal"]=='res') echo 'checked'?>/>
        Res</label>

      <label>
        <input type="radio" name="resbal" value="bal" id="RadioGroup1_1" <?php if (isset($_GET["resbal"])) if ($_GET["resbal"]=='bal') echo 'checked'?>/>

        Bal</label>
</td>
  </tr>
 <!-- value="< ?php echo $_GET["res"]?>"/-->
  <tr>
    <th align="right" scope="row">Rapportlinje:
    </th>
    <td><input name="rapl" type="text"  value=<?php echo $_GET["rapl"]?>></td>
  </tr>
 <tr>
    <th align="right" scope="row">Avdeling:
    </th>
    <td><input name="Avdeling" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Prosjekt:
    </th>
    <td><input name="Prosjekt" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Rapport 1:
    </th>
    <td><input name="Rapport1" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Rapport 2:
    </th>
    <td><input name="Rapport2" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Rapport 3:
    </th>
    <td><input name="Rapport3" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Likvid:
    </th>
    <td><input name="Likvid" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Option directory:
    </th>
    <td><input name="Optiondir" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Option DLL
    </th>
    <td><input name="Optiondll" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Imporformat
    </th>
    <td><input name="Imporformat" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Netttbank
    </th>
    <td><input name="Netttbank" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Synlig
    </th>
    <td><input name="Synlig" type="text" /></td>
  </tr>
  <tr>
    <th align="right" scope="row">Skannet
    </th>
    <td><input name="Skannet" type="text" /></td>
  </tr>
 <tr>
    <th align="right" scope="row">
    </th>
    <td><input name="sok" type="submit" value="Søk" /><input name="submit" type="submit" value="Oppdater" /></td>
  </tr>
</table>
</form>

</body>
</html>