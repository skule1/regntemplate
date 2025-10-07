<style>
    input {

        border-width: 0px;
        text-align: right;
    }

    .input1 {
        height: 25px;
        border-width: 1px;
        text-align: right;
        width: 50px;
    }

    th {
        text-align: right;


    }

    select {
        height: 25px;
        text-align: center;
    }
</style>


<h1>
    <?php echo $this->msg; ?>
</h1>
<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript">

    function f_valg_ar() {
        let ar = document.getElementById("id_valg_ar").value;
        console.log("f_valg_ar", ar);
        //  window.location.reload(true);
        document.getElementById("myForm").submit();
    }

    function f_valg_periode() {
        console.log("f_valg_periode");
        document.getElementById("myForm").submit();
    }

</script>
<?php

// class Registry
// {
//     private static $store = [];

//     public static function set($key, $value)
//     {
//         self::$store[$key] = $value;
//     }

//     public static function get($key)
//     {
//         return self::$store[$key] ?? null;
//     }

//     public static function has($key)
//     {
//         return isset(self::$store[$key]);
//     }
// }
// // Registry::set('username', 'skule');
// echo Registry::get('username'); // outputs: skule
$model = $this->getModel('hist');
$desc = "desc";
$sort = "Bilag";

$regnskapsarliste = $model->regnskapsar();
$perioder = $model->perioder(0);
$firma = $model->firma();
$regnskapsar = $firma->regnskapsar;
$count = 20;
$periode = "Januar";

if (isset($_POST["arstall"])) {
    $regnskapsar = $_POST["arstall"];
    $periode = $_POST["periodenavn"];
    $sort = $_POST["sort"];
    $desc = $_POST["desc"];
    $count = $_POST["count"];
}
$histliste = $model->hist($regnskapsar, $periode, $sort, $desc, $count);

?>
<form id="myForm" action="" method="POST">
    <table>
        Regnskapsår:

        <select id="id_valg_ar" Name="arstall" Size="Number_of_options" onchange="f_valg_ar()"
            value="<?php echo $arstall ?>" <?php
               $nr = 0;
               while ($nr < count($regnskapsarliste)): {
                       //echo $mes[$nr++].'<br>';
                       if ($regnskapsarliste[$nr]->regnskapsar == $regnskapsar)
                           echo '<option value=' . $regnskapsarliste[$nr]->regnskapsar . ' selected>' . $regnskapsarliste[$nr++]->regnskapsar . '</option>';
                       else
                           echo '<option value=' . $regnskapsarliste[$nr]->regnskapsar . '>' . $regnskapsarliste[$nr++]->regnskapsar . '</option>';
                   }
               endwhile;
               //   $avvik = "budsjett";
               ?> </select>

            Periode: <select id="id_periode" Name="periodenavn" Size="Number_of_options" onchange="f_valg_periode()">
                <?php

                $nr = 0;
                while ($nr < count($perioder)): {
                        //echo $mes[$nr++].'<br>';
                        if ($perioder[$nr]->Periodenavn != "Alle perioder")
                            if ($perioder[$nr]->Periodenavn == $periode)
                                echo '<option value=' . $perioder[$nr]->Periodenavn . ' selected>' . $perioder[$nr]->Periodenavn . '</option>';
                            else
                                echo '<option value=' . $perioder[$nr]->Periodenavn . '>' . $perioder[$nr]->Periodenavn . '</option>';
                        $nr++;
                    }
                endwhile;
                //   $avvik = "budsjett";
                ?> </select>

            <label for="sort">Sortert etter:</label>
            <select id="sort" name="sort" onchange="f_valg_ar()" value="<?php echo $sort ?>">

                <option value="dato" <?php if ($sort == "dato")
                    echo 'selected'; ?>>Dato</option>
                <option value="bilag" <?php if ($sort == "bilag")
                    echo 'selected'; ?>>Bilag</option>
                <option value="belop" <?php if ($sort == "belop")
                    echo 'selected'; ?>>Beløp</option>

            </select>

            <label for="desc">Sortert etter:</label>
            <select id="desc" name="desc" onchange="f_valg_ar()" value="<?php echo $desc ?>">
                <option value="incr" <?php if ($desc == "incr")
                    echo 'selected'; ?>>Økende</option>
                <option value="desc" <?php if ($desc == "desc")
                    echo 'selected'; ?>>Minkende</option>
            </select>

            <label for="name">Antall:</label>
            <input class="input1" value="<?php echo $count ?>" type="text" id="count" name="count"
                onchange="f_valg_ar()">
            <button type="button">|<< /button> <button type="button">
                        <<< /button><button type="button">>></button><button type="button">>|</button>

                            <tr>
                                <th style="width: 20px;">Ref</th>
                                <th style="width: 20px;">Art</th>
                                <th style="width: 20px;">Bilag</th>
                                <th style="width: 20px;">Dato</th>
                                <th style="width: 20px;">Debet</th>
                                <th style="width: 20px;">Kredit</th>
                                <th style="width: 20px;">Beløp</th>
                                <th style=" text-align: left;padding-left: 10px;">Tekst</th>
                            </tr>

                            <?php
                            $nr = 0;
                            foreach ($histliste as $hist) {
                                $year = date("Y", strtotime($hist->Dato));
                                if (($year == $regnskapsar) && ($nr++ < $count))
                                    {
                                
                                    ?>

                                    <tr>
                                        <td>
                                            <input type="text" size="3" value="<?php echo $hist->ref ?>"></input>
                                        </td>
                                        <td style="width=50">
                                            <input type="text" size="3" value="<?php echo $hist->bilagsart ?>"></input>
                                        </td>
                                        <td>
                                            <input type="text" size="5" value="<?php echo $hist->Bilag ?>"></input>
                                        </td>
                                        <td>
                                            <input type="text" size="10" value="<?php echo $hist->Dato ?>"></input>
                                        </td>
                                        <td>
                                            <input type="text" size="8  " value="<?php echo $hist->debet ?>"></input>
                                        </td>
                                        <td>
                                            <input type="text" size="8" value="<?php echo $hist->kredit ?>"></input>
                                        </td>
                                        <td>



                                            <input type="text" size="12"
                                                value="<?php echo formatcurrency($hist->belop, "NOK") ?>"></input>
                                        </td>
                                        <td>
                                            <input type="text" style=" text-align: left;  padding-left: 10px;"
                                                value="<?php echo $hist->Tekst ?>"></input>
                                        </td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
    </table>
</form>
<?php
function formatCurrency($amount, $currency = 'NOK', $locale = 'nb_NO')
{
    $formatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
    return $formatter->formatCurrency($amount, $currency);
}
?>