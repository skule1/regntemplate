<!--http://localhost/components/com_regn/views/Resultat/tmpl/kontosok.php?kto=4010&periode=3&ar=2023 -->



<?php

require $_SERVER['DOCUMENT_ROOT'] . '/configuration.php';
$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;
$now = date_create()->format('Y-m-d');
$servername = "localhost";
$username = "admin";
$password = "230751";
$conn = mysqli_connect($servername, $username, $password, $database);

// if (isset($_GET['kto'])) {
//     echo $_GET['kto'].'<br>';
//     echo $_GET['ar'].'<br>';
//     echo $_GET['periode'].'<br>';
// }
// ?>

<h2>Kontoutskrift </h2>
<h4> Konto <?php echo $_GET['kto'] ?> År <?php echo $_GET['ar'] ?> Periode <?php echo $_GET['periode'] ?></h4>
<form action="">
    <table>
        <tr>
            <th>Ref</th>
            <th>Bilagsart</th>
            <th>Bilag</th>
            <th>Dato</th>
            <th>Dato</th>
            <th>Debet</th>
            <th>Kredit</th>
            <th>Belop</th>
            <th>Tekst</th>
            <th>Info</th>
        </tr>
        <?php

        $sql = 'SELECT * FROM ' . $hash . 'regn_hist where (debet=' . $_GET["kto"] . ' or kredit=' . $_GET["kto"]
            . ')  and year(Dato)=' . $_GET["ar"] . ' and month(Dato)=' . $_GET['periode']
            . ' order by Dato;';// and periode=month(Dato)='.$_GET["periode"].' order by ref ;'; //order by ResMal, Ktonr;';
//		echo $sql;
        $result = $conn->query($sql);


        foreach ($result as $hist) {


            echo '
        <tr>
             <td>' . $hist["ref"] . '</td>
            <td>' . $hist["bilagsart"] . '</td>
            <td>' . $hist["Bilag"] . '</td>
            <td>' . date("d-m-Y", strtotime($hist['Dato'])), '</td>
            <td>' . $hist["debet"] . '</td>
            <td>' . $hist["kredit"] . '</td>
            <td>' . $hist["belop"] . '</td>
            <td>' . $hist["Tekst"] . '</td>
            <td>' . $hist["kontoinfo"] . '</td>
        </tr>';

        }
        ?>

    </table>
</form>

</body>

</html>


<table>
    <th>
    <td><input type="text" name="" id=""></td>
    </th>
</table>