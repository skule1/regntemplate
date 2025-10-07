<style>
    .input {
        border: 1px solid #ccc;
        padding: 5px;
        border-radius: 4px;
        width: 100%;
        box-sizing: border-box;
    }

    .input:focus {
        border-color: #66afe9;
        outline: none;
        box-shadow: 0 0 5px rgba(102, 175, 233, .6);
    }
</style>


<!-- <table id='my-table-id'><tr><td>aaaaaaaaaaaaa</td><tr><td>bbbbbbbbbbbbbb</td></tr></table> -->





<?php
defined('_JEXEC') or die('Restricted access');
include 'fc.php';
?>



<h1><?php echo $this->msg; ?></h1>
<?php
$user = JFactory::getUser();
$username = $user->username;
if ($username)
    echo '<h5>Klient: ' . $user->name . '<br></h5>';
?>
<?php
use Joomla\CMS\Factory;

$model = $this->getModel('bilagsart');

// Fetch the record
$bilagsarter = $model->bilagsarter();



if (!empty($_GET["id"])) {
    $db = Factory::getDbo();
    $sql = $db->getQuery(true);
    $sql = 'insert into #__regn_bilagsarter set  id="' . $_GET["id"] . '"';
    if ($_GET["beskrivelse"] != '')
        $sql = $sql . ', beskrivelse="' . $_GET["beskrivelse"] . '"';
    if ($_GET["dato"] != '')
        $sql = $sql . ', dato="' . $_GET["dato"] . '"';
    if ($_GET["debet"] != '')
        $sql = $sql . ', debet="' . $_GET["debet"] . '"';
    if ($_GET["kredit"] != '')
        $sql = $sql . ', kredit="' . $_GET["kredit"] . '"';
    if ($_GET["belop"] != '')
        $sql = $sql . ', belop="' . $_GET["belop"] . '"';
    if ($_GET["tekst"] != '')
        $sql = $sql . ', tekst="' . $_GET["tekst"] . '"';
    $sql = $sql . ';';
    //   echo 'sql: ' . $sql . '<br>';
    // $db->setQuery((string) $sql);
    // $mes = $db->execute();


    $db->setQuery($sql);
    try {
        $res = $db->execute();
    } catch (Exception $e) {
        echo 'Error inserting row: ' . $e->getMessage();
    }

}



echo '<form action="" method="get"><table><tr>
<th   size="5" style="text-align:right;border-width:0px;">id</th>
<th  size="30"" style="text-align:left;border-width:0px;">Beskrivelse</th>
<th size="10" style="text-align:right;border-width:0px;">Dato</th>
<th size="15" style="text-align:right;border-width:0px;">Debet</th>
<th  size="15" style="text-align:right;border-width:0px;">Kredit</th>
<th  size="15" style="text-align:right;border-width:0px;">Beløp</th>
<th  size="25" style="text-align:left;border-width:0px;">Tekst</th>
</tr>';



//echo $mes[1]->dato;
foreach ($bilagsarter as $line1) {
    echo
        '<tr><td><input size="5" onchange="endre(' . $line1->id . ')" value="' . $line1->id . '" id="' . $line1->id . '_id" style=" text-align:right;border-width:0px;"></td>
        <td><input  type="text" onchange="endre(' . $line1->id . ')"id="' . $line1->id . '_beskrivelse" size="30" value="' . $line1->beskrivelse . '"  style="text-align:left;border-width:0px;"></td>
        <td><input type="text" onchange="endre(' . $line1->id . ')"id="' . $line1->id . '_dato" value="' . $line1->dato . '" size="10" style="text-align:right;border-width:0px;"></td>
        <td><input type="text" onchange="endre(' . $line1->id . ')"id="' . $line1->id . '_debet"value="' . $line1->debet . '" size="15" style="text-align:right;border-width:0px;"></td>
        <td><input type="text" onchange="endre(' . $line1->id . ')"id="' . $line1->id . '_kredit"value="' . $line1->kredit . '" size="15" style="text-align:right;border-width:0px;"></td>
        <td><input type="text" onchange="endre(' . $line1->id . ')"id="' . $line1->id . '_belop"value="' . $line1->belop . '" size="15" style="text-align:right;border-width:0px;"></td>
        <td><input type="text" onchange="endre(' . $line1->id . ')" id="' . $line1->id . '_tekst"value="' . $line1->tekst . '" size="25" style="text-align:left;border-width:0px;"></td>
        <td><input type="button" onclick="slett(' . $line1->id . ')" value="X" size="5" style="text-align:left;border-width:0px;"></td></tr>';
}
echo '<tr><td><input type="text" name="id"  onkeypress="neste(1)" id="id" size="5" class="input"></td>
        <td><input type="text" name="beskrivelse"  size="25"onkeypress="neste(2)" id="beskrivelse" class="input"></td>
        <td><input type="text" name="dato"  size="10" onkeypress="neste(3)" id="dato" class="input"></td>
        <td><input type="text" name="debet" size="15" onkeypress="neste(4)" id="debet" class="input"></td>
        <td><input type="text" name="kredit" size="15" onkeypress="neste(5)" id="kredit" class="input"></td>
        <td><input type="text" name="belop" size="15" onkeypress="neste(6)" id="belop" class="input"></td>
        <td><input type="text" name="tekst" size="25" onkeypress="neste(7)" id="tekst" class="input"></td>
        <td><input type="button"  onkeydown="neste(8)" id="oppdater" value="Oppdater"</td></tr>';
//   <td><input type="button" onkeydown="neste(8)" id="oppdater" value="Oppdater" size="25" class="input"></td></tr>';






echo '</table></form>';
?>

<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">


    function neste(v) {
        var id = document.getElementById("id").value;
        var beskrivelse = document.getElementById("beskrivelse").value;
        var dato = document.getElementById("dato").value;
        var debet = document.getElementById("debet").value;
        var kredit = document.getElementById("kredit").value;
        var belop = document.getElementById("belop").value;
        var tekst = document.getElementById("tekst").value;
        console.log('neste', v, event.key, id, beskrivelse, dato, debet, kredit, belop, tekst);
        if (event.key == "Enter")
            //    console.log('Enter key pressed');
            if (v == 1)
                document.getElementById("beskrivelse").focus();
            else if (v == 2)
                document.getElementById("dato").focus();
            else if (v == 3)
                document.getElementById("debet").focus();
            else if (v == 4)
                document.getElementById("kredit").focus();
            else if (v == 5)
                document.getElementById("belop").focus();
            else if (v == 6)
                document.getElementById("tekst").focus();
            else if (v == 7)
                document.getElementById("oppdater").focus();
            else if (v == 8) {

                jQuery.ajax({
                    method: "POST",
                    //url: "index.php?option=com_regn&task=registrering.hentart",
                    url: "index.php?option=com_regn&task=bilagsart.neste",
                    data: ({
                        id: id,
                        beskrivelse: beskrivelse,
                        dato: dato,
                        debet: debet,
                        kredit: kredit,
                        belop: belop,
                        tekst: tekst
                    }),
                    cache: false,
                    success: function (tekst) {
                        console.log(tekst);
                        location.reload();
                    }
                })
            }

    }


    function oppdat() {

        console.log('oppdat', event.key);
        if (event.key == Enter)
            console.log('Enter key pressed');
        jQuery.ajax({
            type: "POST",
            url: "index.php?option=com_regn&task=bilagsart.endre",
            // data: ({
            //     sok1: sok1,
            //     sok2: sok2,
            //     ar: ar1,
            //     per: per1,
            //     valg: valg1
            // }),
            cache: false,
            error: function (error) {
                reject(error);
            },
            success: function (tekst) {

            }
        })
    }

    function slett(i) {
        //  alert('slett  '+i+'?');
        console.log('slett', i);
        jQuery.ajax({
            method: "POST",
            url: "index.php?option=com_regn&task=bilagsart.slett",
            data: ({
                id: i
            }),
            cache: false,
            error: function (error) {
                reject(error);
            },
            success: function (tekst) {
                console.log(tekst);
                location.reload();
            }
        })
    }



    function endre(i) {
        //  alert('slett  '+i+'?');
        console.log('endre', i);
        // const id = document.getElementById("i").value;
        // console.log('id', id);
        const beskrivelse = document.getElementById(i + "_beskrivelse").value;
        console.log('beskrivelse', beskrivelse);
        const dato = document.getElementById(i + "_dato").value;
        console.log('dato', dato);
        // const debet = document.getElementById(i + "_debet").value;
        const debet = document.getElementById(i + "_debet").value;
        console.log('debet', debet);
        const kredit = document.getElementById(i + "_kredit").value;
        console.log('kredit', kredit);
        const belop = document.getElementById(i + "_belop").value;
        console.log('belop', belop);
        const tekst = document.getElementById(i + "_tekst").value;
        console.log('tekst', tekst);

        jQuery.ajax({
            method: "POST",
            url: "index.php?option=com_regn&task=bilagsart.endre",
            data: ({
                id: i,
                beskrivelse: beskrivelse,
                dato: dato,
                debet: debet,
                kredit: kredit,
                belop: belop,
                tekst: tekst
            }),
            cache: false,
            error: function (error) {
                reject(error);
            },
            success: function (tekst) {
                console.log(tekst);
                location.reload();
            }
        })
    }
</script>