<?php
$db = JFactory::getDBO();
$conf = new JConfig();
$database = $conf->db;
$hash = $conf->dbprefix;
$mode = 'R';
$regnskapsar = "2010";
function bevegelser()
{
    global $hash, $db; // <-- Add this line

    echo $_SERVER['REQUEST_URI'];
    //  if (isset($_GET["mode"]))
    //  if ($_GET["mode"])
    //  echo "<script>window.location = 'http://localhost/index.php/k1?view=Konto'</script>";





    $sql = 'select * from qo7sn_regn_kto order by Ktonr;';
    //   echo '<br>$sql1: ' . $sql1 . '<br>';
    //   echo '<tr><td colspan=8> Konto: <select  style="height:25px;"    id="dropdown" name="mode" onchange="selectOption()">';
    $db->setQuery((string) $sql);
    $messages1 = $db->loadObjectList();

    // if ($messages1) {
    //     foreach ($messages1 as $message1) {
    //         echo $message1->Ktonr.'<br>'     ;}}


    //  $messages = $db->loadObjectList();
    // if ($messages) {
    //     foreach ($messages as $message) {

    //         echo $message->Ktonr.'<br>';}}





    ?>
        <form action="" method="get">
            <table border="0" cellspacing="2" cellpadding="2">
                <tr>
                    <td colspan=8> Konto: <select style="height:25px;" id="dropdown" name="mode" onchange="selectOption()">
                            <?php
                            //$messages1 = $db->loadObjectList();
                            if ($messages1) {
                                foreach ($messages1 as $message1) {
                                    echo '<option>' . $message1->Ktonr . '  ' . $message1->Navn . '</option>';
                                }
                            }
                            ?>
                        </select> År:
                        <select id="dropdown" name="mode" style="height:25px;" onchange="selectOption()">
                            <option>Januar</option>
                            <option>Februar</option>
                            <option>Mars</option>
                            <option>April</option>
                            <option>Mai</option>
                            <option>Juni</option>
                            <option>Juli</option>
                            <option>August</option>
                            <option>September</option>
                            <option>Oktober</option>
                            <option>November</option>
                            <option>Desember</option>
                        </select> Periode:
                        <select id="dropdown" name="mode" style="height:25px;" onchange="selectOption()">
                            <option>4010</option>
                            <option>Februar</option>
                            <option>Mars</option>
                            <option>April</option>
                            <option>Mai</option>
                            <option>Juni</option>
                            <option>Juli</option>
                            <option>August</option>
                            <option>September</option>
                            <option>Oktober</option>
                            <option>November</option>
                            <option>Desember</option>
                        </select> Sortering:
                        <select id="dropdown" name="mode" style="height:25px;" onchange="selectOption()">
                            <option>Bilag</option>
                            <option>Dato</option>
                            <option>Beløp</option>
                        </select>
                        </select> Sorteringsrekkefølge:
                        <select id="dropdown" name="mode" style="height:25px;" onchange="selectOption()">
                            <option>Opp </option>
                            <option>Ned</option>

                        </select>
                    </td>
                </tr>
                <tr style="height:15px;"></tr>
                <tr>
                    <th style=" direction: rtl;" scope="col">Bilagsart</th>
                    <th style=" direction: rtl;" scope="col">Bilag</th>
                    <th style=" direction: rtl;" scope="col">Dato</th>
                    <th style=" direction: rtl;" scope="col">Debet</th>
                    <th style=" direction: rtl;" scope="col">Kredit</th>
                    <th style=" direction: rtl;" align="right" scope="col">Beløp</th>
                    <th scope="col">Tekst</th>
                    <th scope="col">Kontoinfo</th>

                </tr>
                <?php




                $sql3 = "select Bilagsart,Bilag,Dato,debet,kredit,belop,Tekst,kontoinfo from qo7sn_regn_hist where debet=4010;"; // and regnskapsar=2012 and Periode="februar" order by dato;';
//            $db->setQuery((string) $sql3);
            


                // $sql1 = 'select * from qo7sn_regn_kto order by Ktonr;';
                // echo '<br>$sql1: ' . $sql1 . '<br>';
                //   echo '<tr><td colspan=8> Konto: <select  style="height:25px;"    id="dropdown" name="mode" onchange="selectOption()">';
                //    $db->setQuery((string) $sql);
                //     $messages1 = $db->loadObjectList();
            
                //            $messages = $db->loadObjectList();
                if ($messages) {
                    foreach ($messages as $message) {
                        ?>
                                <!--tr>
                        <td align="right"><?php echo $message->Bilag ?></td>
                        <td align="right"><?php echo $message->Bilagsart ?></td>
                        <td><input type="text" size="10" style="border:none;  direction: rtl;" name="fdato"
                                value="<?php echo $message->Dato ?>" /></td>
                        <td><input type="text" size="7" style="border:1px; direction: rtl;" name="fdebet"
                                value="<?php echo $message->debet ?>" /></td>
                        <td><input type="text" size="7" style="border:none;  direction: rtl;" name="fkredit"
                                value="<?php echo $message->kredit ?>" /></td>
                        <td><input type="text" size="10" style="border:none;  direction: rtl; padding-right: 10px;" name="belop"
                                value="<?php echo number_format($message->belop, 2, ',', '.') ?>"" /></td>
                        <td><input type=" text" size="30" style="border:none;" name="tekst"
                                value="<?php echo $message->Tekst ?>" /></td>
                        <td><input type="text" size="30" style="border:none;" name="finfo"
                                value="<?php echo $message->kontoinfo ?>" /></td>

                </tr-->
                                <?php
                    }
                }
                ?>
            </table>
        </form>
        <?php
}
?>