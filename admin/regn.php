<style>
body {
    font-family: Arial;
}

/* Style the tab */
.tab {
    overflow: hidden;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
}

/* Style the buttons inside the tab */
.tab button {
    background-color: inherit;
    float: left;
    border: none;
    outline: none;
    cursor: pointer;
    padding: 14px 16px;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    display: none;
    padding: 1px 1px;
    border: 1px solid #ccc;
    border-top: 10px solid #fff;
    /* background-color: #ddd;*/
}
</style>
<!--?php
<!--?php include './administrator/com_regn/firma.inc';?-->
<!--?php include './administrator/com_regn/kto.inc';?-->
<!--?php include 'firma.inc';?>
<!--?php include 'kto.inc';?-->
<!--

    $db    = JFactory::getDBO();
	$query = $db->getQuery(true);
	$query1='select * from #__regn_firmadata';
	$db->setQuery((string) $query1);
	$messages = $db->loadObjectList();
 	$options  = array();
     if ($messages) {
        foreach ($messages as $message) {
            $firmanavn = $message->firmanavn;
            $fepost = $message->fepost;
            $adresse=$message->adresse;
           // echo $firmanavn.'\t'.$fepost.'\t'.$adresse.'<br>';
        }
    }

?-->

<?php 
if(isset($_GET['a'])) {
  $vv=$_GET['a'];
  echo 'a: '.$vv.'<br>';   
//  openCity(event, 'Konto');          
kto();
};
?>

<h2>Tabs</h2>
<p>Click on the buttons inside the tabbed menu:</p>

<div class="tab">
    <button class="tablinks" onclick="openCity(event, 'Firmaopplysninger')">Firmaopplysninger</button>
    <button class="tablinks" onclick="openCity(event, 'Database')">Database</button>
    <button class="tablinks" onclick="openCity(event, 'Konto')">Konto</button>
    <button class="tablinks" onclick="openCity(event, 'Sporring')">Sporring</button>
    <button class="tablinks" onclick="openCity(event, 'Rapporter')">Rapporter</button>
    <button class="tablinks" onclick="openCity(event, 'Fakturering')">Fakturering</button>
</div>


<?php
class Registry
{
  private static $store = [];

  public static function set($key, $value)
  {
    self::$store[$key] = $value;
  }

  public static function get($key)
  {
    return self::$store[$key] ?? null;
  }

  public static function has($key)
  {
    return isset(self::$store[$key]);
  }
}
Registry::set('username', 'skule');
echo Registry::get('username'); // outputs: skule


if(isset($_GET['a'])) {
  $vv=$_GET['a'];
  echo 'a: '.$vv.'<br>';   
//  openCity(event, 'Konto');          
Konto();
}
else
{
?>


<div id="Firmaopplysninger" class="tabcontent">
    <br>
    <h3>Firmaopplysninger</h3>
    <?php firma(); ?>
</div>

<div id="Database" class="tabcontent">
    <br>
    <h3>Database</h3>
    <?php  Database(); ?>
</div>


<div id="Konto" class="tabcontent">
    <br>
    <h3>Konto</h3>
    <?php konto(); ?>
  
</div>

<div id="Sporring" class="tabcontent">
    <h3>Spørrring</h3>
    <p>Tokyo is the capital of Japan.</p>
</div>


<div id="Rapporter" class="tabcontent">
    <h3>Rapporter</h3>
    <p>Tokyo is the capital of Japan.</p>
</div>

<div id="Rapporter" class="tabcontent">
    <h3>Rapporter</h3>
    <p>Faktueringsrutine.</p>
</div>
<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}
</script>
<?php
}

function firma()
{?>
<form action="" method="get">
    <table border="0" cellspacing="10" cellpadding="2">
        <tr>
            <th style="text-align:right; padding-right: 10px;" width="150" scope="row">Navn:</th>
            <td><input name="a" type="text" value="a" size="20" maxlength="20" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="text-align:right; padding-right: 10px;" scope="row">Adresse:</th>
            <td><input name="a" type="text" value="a" size="50" maxlength="50" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="text-align:right; padding-right: 10px;" scope="row">Kontaktperson:</th>
            <td><input name="a" type="text" value="a" size="20" maxlength="20" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="text-align:right; padding-right: 10px;" scope="row">Telefon:</th>
            <td><input name="a" type="text" value="a" size="20" maxlength="20" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="text-align:right; padding-right: 10px;" scope="row">E-post:</th>
            <td><input name="a" type="text" value="a" size="20" maxlength="20" /></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <th style="text-align:right; padding-right: 10px;" scope="row">Lisens:</th>
            <td><input name="a" type="text" value="a" size="20" maxlength="20" />;</td>
            <td>&nbsp;</td>
        </tr>

    </table>
</form>
<?php
}

   
   function Database()
{?><form action="upload.php" method="post" enctype="multipart/form-data">
    Velg hvilken backupfil som skal lastes opp:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
  </form>


    <form id="form1" name="form1" method="post" action="">
      <table width="800" border="1" cellspacing="2" cellpadding="2">
      <tr>
          <th scope="row">Sikkerhetskopiering</th>
          <td>Arkiv:
          <input type="text" name="textfield" id="textfield" />  <input type="submit" name="button" id="button" value="Lagre" /></td>
        </tr>
        <tr>
          <th scope="row">Arkivplass</th>
          <td>Arkiv:
          <input type="text" name="textfield" id="textfield" />  <input type="submit" name="button" id="button" value="Lagre" /></td>
        </tr>
        <tr>
          <th scope="row">Tilbakelegging </th>
          <td>Arkiv:
          <select name="pets" id="pet-select">
    <option value="">--Velg backup--</option>
    <option value="dog">Dog</option>
    <option value="cat">Cat</option>
    <option value="hamster">Hamster</option>
    <option value="parrot">Parrot</option>
    <option value="spider">Spider</option>
    <option value="goldfish">Goldfish</option>
</select>
 <input type="submit" width="200" name="2" id="2" value="  Hent sikkerhetskopi" />
        </td>
        </tr>
      </table>
    
    </form>


    <?php
$target_dir = "/backup/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
echo 'target_file:  '.$target_file.'<br>';
echo 'fileToUpload:  '.$target_file.'<br>';
echo 'target_file:  '.$target_file.'<br>';
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
  $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
  if($check !== false) {
    echo "File is an image - " . $check["mime"] . ".";
    $uploadOk = 1;
  } else {
    echo "File is not an image.";
    $uploadOk = 0;
  }
}

// Check if file already exists
if (file_exists($target_file)) {
  echo "Sorry, file already exists.";
  $uploadOk = 0;
}

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
  echo "Sorry, your file is too large.";
  $uploadOk = 0;
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
    echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
  } else {
    echo "Sorry, there was an error uploading your file.";
  }
}
?>
<?php
}

function konto(){
    echo 'konto..';
}

?>