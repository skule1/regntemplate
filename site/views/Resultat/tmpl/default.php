<style>
input[type="text"] {

border-width: 0px;
text-align: right;
width: 100px;
/* font-size: 12px;
/* text size
font-family: Arial, sans-serif;*/
}

input4[type="text"] {
width: 250px;
/* set input width */
height: 40px;
/* set input height */
padding: 8px 12px;
/* inner spacing */
font-size: 16px;
/* text size */
font-family: Arial, sans-serif;
/* font style */
border: 2px solid #ccc;
/* border color & size */
border-radius: 8px;
/* rounded corners */
outline: none;
/* remove default outline */
box-sizing: border-box;
/* include padding in size */
transition: border-color 0.3s, box-shadow 0.3s;
/* smooth effects */
}

.input1 {
height: 25px;
border-width: 1px;
text-align: right;
width: 150px;
}

th {
text-align: right;
}

label {
font-size: 18px;
margin: 15px 15px 15px 15px;
padding: 5px 5px 5px 5px;
}

select {
height: 25px;
text-align: center;
width: 100px;
/* padding: 0px 0px 0px 0px;
margin: 2px 2px 2px 2px; */
height: 30px;
text-align: center;

}

td {
text-align: right;
/* padding: 5px;
/* width: 200px;*/
border-width: 0px;
}


button {
background-color: #e8dcdcff;
/* Green */
border: 1px;
border-radius: 8px;
color: black;
border-color: black;
padding: 2px 2px;
margin: 2px 2px;
text-align: center;
font-size: 18px;
border-radius: 4px;
cursor: pointer;
}
</style>

<?php
/*
loadResult() : single value from one resourcebundle_get_error_code
loadRow() : Single record use index id (returns an indexed array from a single record in the table:)
loadAssoc() : Single record use fieldname (returns an associated array from a single record in the table:)
loadObject() : php object (loadObject returns a PHP object from a single record in the table:)
loadColumn() : all records from a singel coloumn (returns an indexed array from a single column in the table:)
loadColumn($index) : all records from multiple records (returns an indexed array from a single column in the table:)
loadRowList() : (returns an indexed array of indexed arrays from the table records returned by the query:)
loadAssocList() : ( returns an indexed array of associated arrays from the table records returned by the query:)
loadAssocList($key) : (returns an associated array - indexed on 'key' - of associated arrays from the table records
returned by the query:)
loadAssocList($key, $column) : ( returns an associative array, indexed on 'key', of values from the column named
'column' returned by the query:)
loadObjectList() : (returns an indexed array of PHP objects from the table records returned by the query:)
loadObjectList($key) : (returns an associated array - indexed on 'key' - of objects from the table records returned by
the query:)
https://docs.joomla.org/Special:MyLanguage/Selecting_data_using_JDatabase
*/
?>


<style>
    gg {

        color: red;
        border-width: 0px;
        background-color: blue;
    }

    h1 {
        color: red;
    }



    select1 {
        border: none;
        /* Remove border */
        font-weight: normal;
        /* Remove bold text */
        background: transparent;
        /* Optional: makes background blend in */
        appearance: none;
        /* Removes default styling in some browsers */
        -webkit-appearance: none;
        -moz-appearance: none;
        padding: 5px;
        /* Optional padding */
        font-size: 30px;
        /* Optional font size */
    }

    .select-custom {
        border: none;
        font-weight: bold;
        background-color: transparent;
        /* optional */
        appearance: none;
        /* optional: removes default OS styling */
        font-size: 30px;
        /* Optional font size */

    }
</style>

<div id="mySection">


    <?php

    defined('_JEXEC') or die;

    // $msg='Resultat';
    // if (isset($_GET["velg"])) {
    // 	if ($_GET["velg"] == 'Resultat') {
    // 	//	$resmal = $model->hentmal("R");
    // 		$msg = 'Resultatrapport';
    // 	} else if ($_GET["velg"] == 'Balanse') {
    // 		//$resmal = $model->hentmal("B");
    // 		$msg = 'Balanse';
    // 	} else if ($_GET["velg"] == 'Lilkviditet') {
    // 	//	$resmal = $model->hentmal("L");
    // 		$msg = 'Lilkviditet';
    // 	}
    // } else {
    ?>
    <!-- <form action="" method="GET">
        <table>
            <td>
                <select id="id_sort" name="mode" style="height:25px;" onchange="offs('next')">
                    <option>Resultat</option>
                    <option>Balanse</option>
                    <option>Lilkviditet</option>
                </select>
            <td><input type="submit" value="Velg" name="velg></td>
                </td>
            </table>
        </form> -->

    <?php

    // }
    

    ?>


    <!-- <form action="" method="GET">
        <table>
            <td>
                <select id="id_sort" name="mode" style="height:25px;" onchange="offs('next')">
                    <option>Resultat</option>
                    <option>Balanse</option>
                    <option>Lilkviditet</option>
                </select>
            <td><input type="submit" value="Velg" name="velg></td>
                </td>
            </table>
        </form> -->









    <h1>
        <?php echo $this->msg; ?>
    </h1>

    <?php
    $user = JFactory::getUser();
    $name = $user->name;
    if ($name)
        echo '<h5>Klient: ' . $user->name . '<br></h5>';



    include 'fc.php';
    include 'style.css';

    use Joomla\CMS\Factory;
    use Joomla\CMS\MVC\Controller\BaseController;
    use Joomla\CMS\Response\JsonResponse;

    $model = $this->getModel('resultat');



    //            echo '<h5>Klient: ' . $value . '</h5><br>';
    //  echo '<h5>Klient: ' . $klient["firma"] . '</h5><br>';
    //$hist = $model->historikk(2023);
    
    //$startvariable = $model->startvariable();
    
    $mode = 'R';

    if (isset($_GET['valg'])) {

        if ($_GET['valg'] == "Resultat") {
            //             echo '<h1><b>Resultat</b></h1>';
            $resmal = $model->hentmal("R");
            $mode = 'R';
        } else if ($_GET['valg'] == "Balanse") {
            //           echo '<h1><b>Balanse</b></h1>';
            $resmal = $model->hentmal("B");
            $mode = 'B';
        } else if ($_GET['valg'] == "Lilkviditet") {
            //         echo '<h1><b>Lilkviditet</b></h1>';
            $resmal = $model->hentmal("L");
            $mode = 'L';
        }
    } else {
        //    echo '<h1><b>Resultat</b></h1>';
        $resmal = $model->hentmal("R");
    }



    // if ($msg == "Resultat")
    //   $resmal = $model->hentmal("R");
    // else if ($msg == "Balanse")
    //     $resmal = $model->hentmal("B");
    // else if ($msg == "Lilkviditet")
    //     $resmal = $model->hentmal("L");
    
    $regnskapsarliste = $model->regnskapsar();
    $perioder = $model->perioder(0);
    $firma = $model->firma();



    //$saldoliste = $model->saldoliste("R", $firma->regnskapsar, $firma->periode);
    $i = 0;
    $regnskapsar = $firma->regnskapsar;

    if (isset($_GET['arstall'])) {
        $regnskapsar = $_GET['arstall'];
        $periode = $_GET['periodenavn'];
        $avvik = $_GET['avvik'];
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $query = 'update #__regn_firma set periode="' . $periode . '", regnskapsar="' . $regnskapsar . '", res_sortering="' . $avvik . '";';
        $db->setQuery((string) $query);
        $message = $db->execute();
    } else {
        $regnskapsar = $firma->regnskapsar;
        $periode = $firma->periode;
        $avvik = $firma->res_sortering;
    }
    $periodenr = $model->perioder($periode)[0]->nr;
    if ($mode == 'R')
        $saldoliste = $model->saldoliste("R", $regnskapsar, $periodenr);
    else if ($mode == 'B')
        $saldoliste = $model->saldoliste("B", $regnskapsar, $periodenr);
    else if ($mode == 'L')
        $saldoliste = $model->saldoliste("L", $regnskapsar, $periodenr);




    // $searchValue=1;
    // $result = array_filter($saldoliste, function ($saldo) use ($searchValue) {
    //     return $saldo->raplinje === $searchValue;
    // });
    



    // print_r($result);
    



    ?>

    <form id="myForm" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">



        <h1><b>
                <td>
                    <select class="select-custom" id="id_sort" name="mode" onchange="offsi()">
                        <!-- <option <?php if ($mode == "R")
                            echo "selected" ?>><h1> Resultat</h1>
                            </option>
                            <option <?php if ($mode == "B")
                            echo "selected" ?>></option>
                            <h1>Balanse</h1>
                            </option>
                            <option <?php if ($mode == "L")
                            echo "selected" ?>></option>
                            <h1>Likviditet</h1>
                            </option> -->
                            <option <?php if ($mode == "R")
                            echo "selected" ?>>
                                <h1> Resultat</h1>
                            </option>
                            <option <?php if ($mode == "B")
                            echo "selected" ?>>
                                <h1>Balanse</h1>
                            </option>
                            <option <?php if ($mode == "L")
                            echo "selected" ?>>
                                <h1>Likviditet</h1>
                            </option>


                        </select><br>
                    </td>
                    <!-- <td><input type="submit" value="Velg" name="velg></td> -->



                </b></h1>







            Regnskapsår:
            <!--select name="valgt_ar"-->
            <select  id="id_valg_ar"  Name="arstall"
                Size="Number_of_options" onchange="f_valg_ar()" value="<?php echo $arstall ?>" <?php
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

            Periode: <select style="height: 30px; text-align: center;" id="id_valg_periode" Name="periodenavn"
                Size="Number_of_options" onchange="f_valg_periode()">
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

            Avvik fra: <select id="id_avvik" style="height: 30px; text-align: center;" Name="avvik"
                Size="Number_of_options" onchange="f_valg()">





                <?php

                $nr = 0;
                echo '<option value="budsjett" <';
                if ($avvik == "budsjett")
                    echo " selected";
                echo '>Budsjett </option>'
                    . '<option value="forrige" <';
                if ($avvik == "forrige")
                    echo " selected";
                echo '>Fjorår </option>'
                    . '<option value="hittil" <';
                if ($avvik == "hittil")
                    echo " selected";
                echo '>Hittil </option>';
                echo '</select>';
                echo '&nbsp;&nbsp;';
                echo '<a href="http://localhost/index.php/resultatmal?view=Resmal"><button>Endre mal</button></a>';
                echo '&nbsp;&nbsp;<button type="button">Utskrift</button> <button>
                <submit>Oppdater</submit>
            </button></form>';




                class Nivasum
                {
                    public $nr;
                    public $niva;
                    public $belop;
                    public $hittil;
                    public $budsjett;
                    public $fjorar;
                    public $hittil_fjorar;
                    public $kontoer;

                    public function __construct($niva)
                    {
                        $this->niva = $niva;
                        $this->nr = 0;
                        $this->belop = 0;
                        $this->hittil = 0;
                        $this->budsjett = 0;
                        $this->kontoer = '';
                        $this->hittil_fjorar = 0;
                        $this->fjorar = 0;
                    }
                }
                // public function __construct($nr, $niva, $belop1)
                // {
                //     $this->nr = $nr;
                //     $this->niva = $niva;
                //     $this->belop1 = $belop1;
                // }
                //}
                
                // for ($i = 0; $i < 10; $i++) {
                //     $rapport[] = new Nivasum($i);
                // }
                
                // $rapport[1] = new Nivasum(1);
                // $rapport[1]->belop=300;
                // $rapport[3] = new Nivasum(5);
                // $rapport[3]->belop=500;
                
                // $rapport[0]->belop = 0;
                // $rapport[1]->hittil = 50;
                
                if ($saldoliste != null)
                    if (count($saldoliste) > 0) {
                        ?>
                        <table width="110px"> 
                            <tr height="20px"> </tr>
                            <tr>

                                <!-- <th style="text-align:right" width="450">
            Linje
        </th> -->

                                <th style="text-align:right" width="50">
                                    Linje
                                </th>
                                <th scope="col" width="180" style="text-align:left">
                                    Navn
                                </th>
                                <th style="text-align:right" scope="col" style="text-align:right" width="100">
                                    Nivå
                                </th>
                                <th style="text-align:right" scope="col" style="text-align:right" width="100">
                                    Beløp
                                </th>
                                <th style="text-align:right" scope="col" style="text-align:right" width="100">
                                    Budsjett
                                </th>
                                <th style="text-align:right" scope="col" style="text-align:right" width="100">
                                    Fjorårstall
                                </th>
                                <th style="text-align:right" scope="col" width="100">
                                    Hittil
                                </th>
                                <th style="text-align:right" scope="col" width="100">
                                    Hittil fjor
                                </th>
                                <th style="text-align:right" scope="col" width="100">
                                    Avvik
                                </th>
                                <th style="text-align:right" scope="col" width="100">
                                    %
                                </th>
                                <!-- <th style="text-align:right" scope="col" width="100">
            År
        </th> -->
                                <th style="text-align:left; padding-left: 20px;" scope="col" width="120">
                                    Kontoer
                                </th>
                                <!--th style="text-align:right"scope="col" width="100" >
                Periode
            </th>
            <th style="text-align:right"scope="col" width="100" >
                Periodenr
            </th-->
                                <!--th style="text-align:right"scope="col" style="text-align:right" width="50" >
                År
            </th-->

                            </tr>
                            <?php

                            $sum1 = 0;
                            $sumbudsjett = 0;
                            $sumfjorar = 0;
                            $sumhittil = 0;
                            $sumhittilfjorar = 0;

                            $tsum = 0;
                            $tsumbudsjett = 0;
                            $tsumfjorar = 0;
                            $tsumhittil = 0;
                            $tsumhittilfjorar = 0;

                            $strek = false;
                            $sum = 0;
                            $budsjett = 0;
                            $fjorar = 0;
                            $hittil = 0;
                            $avvik_budsjett = 0;
                            $avvik_fjorar = 0;
                            $avvik_hittil = 0;
                            $fjorar_hittil = 0;

                            $j = 0;
                            $belop = 0;
                            $prevniva = 0;
                            $sum = 0;
                            //      $rapport = [];
                    
                            $sum1 = 0;
                            //    echo '<table>';
                            $r = 0;
                            $prosent_budsjett = 0;
                            $prosent_fjorar = 0;
                            $prosent_hittil = 0;

                            foreach ($resmal as $mal) {
                                $t = 0;
                                if ($mal->niva > 1) {
                                    $resultat[] = new Nivasum($mal->niva);
                                    $lastKey = array_key_last($resultat);
                                    $resultat[$lastKey]->belop = $tsum;   // hent inn linje 1
                                    $resultat[$lastKey]->hittil = $tsumhittil;   // hent inn linje 1
                                    $resultat[$lastKey]->budsjett = $tsumbudsjett;   // hent inn linje 1
                                    $resultat[$lastKey]->fjorar = $tsumfjorar;   // hent inn linje 1
                                    $resultat[$lastKey]->hittil_fjorar = $tsumhittilfjorar;   // hent inn linje 1
                    
                                    $tsum = 0;
                                    $tsumbudsjett = 0;
                                    $tsumfjorar = 0;
                                    $tsumhittil = 0;
                                    $tsumhittilfjorar = 0;


                                    //                            $resultat[$lastKey]->kontoer = $sumko;   // hent inn linje 1
                                    for ($i = 0; $i < $lastKey; $i++) {
                                        if (isset($resultat[$i])) {
                                            if ($resultat[$i]->niva < $mal->niva) {
                                                $resultat[$lastKey]->belop = $resultat[$lastKey]->belop + $resultat[$i]->belop;
                                                $resultat[$lastKey]->hittil = $resultat[$lastKey]->hittil + $resultat[$i]->hittil;
                                                $resultat[$lastKey]->budsjett = $resultat[$lastKey]->budsjett + $resultat[$i]->budsjett;
                                                $resultat[$lastKey]->fjorar = $resultat[$lastKey]->fjorar + $resultat[$i]->fjorar;
                                                $resultat[$lastKey]->hittil_fjorar = $resultat[$lastKey]->hittil_fjorar + $resultat[$i]->hittil_fjorar;
                                                unset($resultat[$i]);
                                            }
                                        }
                                    }
                                    //      echo '<tr><td>' . $mal->nr . '</td><td>' . $mal->niva . '</td><td>' . $mal->tekst  . '</td><td>' . $resultat[$lastKey]->belop . '</td></tr>';
                    
                                    $sum = 0;
                                    // echo 'mal: '.$mal->nr.'|'.$mal->tekst.'<br>';
                    
                                    //   if ($resmal[$lastKey]->niva > 1)
                                    // if ($mal->niva < 4)      
                                    // if (!$strek) {
                                    //  echo '<tr><td colspan="15">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>';
                                    //     $strek = false;
                                    // }
                    
                                    if ($resultat[$lastKey]->budsjett != 0)
                                        $prosent_budsjett = ($resultat[$lastKey]->budsjett - $resultat[$lastKey]->belop) / $resultat[$lastKey]->budsjett;
                                    else
                                        $resultat[$lastKey]->budsjett = 0;

                                    if ($resultat[$lastKey]->fjorar != 0)
                                        $prosent_fjorar = ($resultat[$lastKey]->belop - $resultat[$lastKey]->fjorar) / $resultat[$lastKey]->fjorar;
                                    else
                                        $resultat[$lastKey]->fjorar = 0;

                                    if ($resultat[$lastKey]->hittil_fjorar != 0)
                                        $prosent_hittil = ($resultat[$lastKey]->hittil - $resultat[$lastKey]->hittil_fjorar) / $resultat[$lastKey]->hittil_fjorar;
                                    else
                                        $resultat[$lastKey]->hittil_fjorar = 0;

                                    if (($resultat[$lastKey]->belop != 0) || ($resultat[$lastKey]->hittil != 0)) {
                                        if (($mal->niva > 1) && !$strek)
                                            echo '<tr><td colspan="12">-------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>';
                                        $strek = false;
                                        echo '<tr>';
                                        echo '<td align ="right" style=" padding-right: 20px;">' . $mal->nr . "</td>";
                                        echo '<td style="text-align:left">' . $mal->tekst . "</td>";
                                        echo '<td align ="right">' . $mal->niva . "</td>";
                                        echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->belop, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->budsjett, "NOK") . "</td>";
                                        // echo '<td align ="right">' . $message->prosent . "</td>";
                                        // echo '<td align ="right">' . formatcurrency($message->prosent, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->fjorar, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->hittil, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->hittil_fjorar, "NOK") . "</td>";
                                        if ($avvik == "budsjett") {
                                            echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->budsjett - $resultat[$lastKey]->belop, "NOK") . "</td>";
                                            echo '<td align ="right">' . number_format($prosent_budsjett * 100, 0, ',', '.') . '%' . "</td>";
                                        } elseif ($avvik == "forrige") {
                                            echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->belop - $resultat[$lastKey]->fjorar, "NOK") . "</td>";
                                            echo '<td align ="right">' . number_format($prosent_fjorar * 100, 0, ',', '.') . '%' . "</td>";
                                        } elseif ($avvik == "hittil") {
                                            echo '<td align ="right">' . formatcurrency($resultat[$lastKey]->hittil - $resultat[$lastKey]->hittil_fjorar, "NOK") . "</td>";
                                            echo '<td align ="right">' . number_format($prosent_hittil * 100, 0, ',', '.') . '%' . "</td>";
                                        }
                                        if ($mal->niva > 1) {
                                            echo '<tr><td colspan="15">══════════════════════════════════════════════════════════════════════════════════════════════</td></tr>';
                                            $strek = true;
                                        }
                                        //                             // echo '<td align ="center">' . $message->ar . "</td>";
                                        //                             //     echo '<td align ="left" style=" padding-left: 20px;"><input type="text" style=" border-width:0px;" name="kontoer" id="id_kontoer" onclick="f_kontoer()" value="' . $saldo->kontoer . '"></td>';
                                        //                             //  echo '<td align ="right">' .$message->periode. "</td>";
                                        //                             //   echo '<td align ="right">' .$message->periodenr. "</td>";
                                        //                             //        echo '<td align ="right">' .$message->ar . "</td>";
                                        //                             echo "</tr>";
                                        //                             if ($resmal[$lastKey]->niva > 1)
                                        //                                 echo '<tr><td colspan="15">══════════════════════════════════════════════════════════════════════════════════════════════</td></tr>';
                    
                                        //   //                          $prevniva = $resmal[$k]->niva;
                    
                                        echo '</tr>';
                                    }



                                    //           echo '<tr><td>' . $mal->nr . '</td><td>' . $mal->niva . '</td><td>' . $mal->tekst  . '</td><td>' .  $resultat[$lastKey]->belop . '</td></tr>';
                                } //else
                                //  $strek = false;
                                $linksum = '';
                                $sum1 = 0;
                                $sumbudsjett = 0;
                                $sumfjorar = 0;
                                $sumhittil = 0;
                                $sumhittilfjorar = 0;
                                $sumkontoer = [];
                                // summerer alle konti på samme linjenummer gitt i malen
                    
                                foreach ($saldoliste as $saldo) {
                                    if ($mal->nr < $saldo->raplinje)
                                        break;

                                    if ($mal->nr == $saldo->raplinje) {
                                        $sum = $sum + $saldo->belop;
                                        $sumbudsjett = $sumbudsjett + $saldo->budsjett;
                                        $sumfjorar = $sumfjorar + $saldo->fjorar;
                                        $sumhittil = $sumhittil + $saldo->hittil;
                                        $sumhittilfjorar = $sumhittilfjorar + $saldo->fjorar_hittil;
                                        $sum1 = $sum1 + $saldo->belop;
                                        $s = $saldo->kontoer;
                                        $t = json_decode($s, true);
                                        //    $t = trim($s, '[]"');
                                        $sumkontoer[] = $t[0];
                                        // }
                                    }
                                }
                                // oppdaterer for lagring i sum
                    
                                $tsum = $tsum + $sum1;
                                $tsumbudsjett = $tsumbudsjett + $sumbudsjett;
                                $tsumfjorar = $tsumfjorar + $sumfjorar;
                                $tsumhittil = $tsumhittil + $sumhittil;
                                $tsumhittilfjorar = $tsumhittilfjorar + $sumhittilfjorar;


                                //    if ($sum1 <> 0) {  echo '<tr><td>' . $mal->nr . '</td><td>'  . $mal->tekst  . '</td><td>' . $mal->niva . '</td><td>'. $sum1 . '</td></tr>';
                                {
                                    // $r = 0;
                    
                                    // Viser data for linjen på nivå 1
                                    if ($sumbudsjett != 0)
                                        $prosent_budsjett = ($sumbudsjett - $sum1) / $sumbudsjett;
                                    else
                                        $prosent_budsjett = 0;
                                    if ($sumfjorar != 0)
                                        $prosent_fjorar = ($sum1 - $sumfjorar) / $sumfjorar;
                                    else
                                        $sumfjorar = 0;
                                    if ($sumhittilfjorar)
                                        $prosent_hittil = ($sumhittil - $sumhittilfjorar) / $sumhittilfjorar;
                                    else
                                        $sumhittilfjorar = 0;
                                    echo '<tr>';
                                    //      $strek = false;
                                    // if (($mal->niva > 1)) //&&  !$strek)
                                    //     echo '<tr><td colspan="15">--------------------------BB-----------------------------------------------------------------------------------------------------------------------------------------------------------------------------</td></tr>';
                                    //    $strek = false;
                                    if (($mal->niva == 1) && ($sum1 != 0) || ($sumhittil != 0)) {
                                        $strek = false;
                                        echo '<td align ="right" style=" padding-right: 20px;">' . $mal->nr . "</td>";
                                        echo '<td style="text-align:left">' . $mal->tekst . "</td>";
                                        echo '<td align ="right">' . $mal->niva . "</td>";
                                        echo '<td align ="right">' . formatcurrency($sum1, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($sumbudsjett, "NOK") . "</td>";

                                        //   echo '<td align ="right">' .$message->prosent . "</td>";
                                        //echo '<td align ="right">' . formatcurrency($message->prosent, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($sumfjorar, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($sumhittil, "NOK") . "</td>";
                                        echo '<td align ="right">' . formatcurrency($sumhittilfjorar, "NOK") . "</td>";
                                        if ($avvik == "budsjett") {
                                            echo '<td align ="right">' . formatcurrency($sumbudsjett - $sum1, "NOK") . "</td>";
                                            echo '<td align ="right">' . number_format($prosent_budsjett * 100, 0, ',', '.') . '%' . "</td>";
                                        } elseif ($avvik == "forrige") {
                                            echo '<td align ="right">' . formatcurrency($sum1 - $sumfjorar, "NOK") . "</td>";
                                            echo '<td align ="right">' . number_format($prosent_fjorar * 100, 0, ',', '.') . '%' . "</td>";
                                        } elseif ($avvik == "hittil") {
                                            echo '<td align ="right">' . formatcurrency($sumhittil - $sumhittilfjorar, "NOK") . "</td>";
                                            echo '<td align ="right">' . number_format($prosent_hittil * 100, 0, ',', '.') . '%' . "</td>";
                                        }


                                        $k = 0;
                                        $link = '';
                                        foreach ($sumkontoer as $konto) {
                                            //       $kkto = $model->sumkto($konto, $saldo->periode, $saldo->ar, $mode);
                                            if ($saldo->belop != 0) {
                                                //   $link = '<a href="#mySection">' . $konto . '</a>';
                                                $hrf = 'http://localhost/components/com_regn/views/Resultat/tmpl/kontosok.php?ar=' . $saldo->ar . '&kto=' . $konto . '&periode=' . $saldo->periode;
                                                $link = '<a href="' . $hrf . '">' . $konto . '</a>';
                                                if ($linksum == '')
                                                    $linksum = $link;
                                                else
                                                    $linksum = $linksum . ' , ' . $link;
                                            }
                                        }
                                        echo '<td  style="text-align:left; padding-left: 20px;">' . $linksum . '</td>';
                                        $linksum = '';
                                        echo "</tr>";
                                    }
                                    echo "</tr>";
                                }
                            }


                            //      if ($saldo) {
                            if ($saldo->fjorar == null)
                                $saldo->fjorar = 0;
                            if ($saldo->fjorar_hittil == null)
                                $saldo->fjorar_hittil = 0;
                            if ($saldo->hittil == null)
                                $saldo->hittil = 0;

                            $saldo->avvik_budsjett = $saldo->budsjett - $saldo->belop;
                            $saldo->avvik_fjorar = $saldo->belop - $saldo->fjorar;
                            $saldo->avvik_hittil = $saldo->hittil - $saldo->fjorar_hittil;

                            $prosent_budsjett = 0;
                            $prosent_fjorar = 0;
                            $prosent_hittil = 0;

                            if ($saldo->budsjett > 0)
                                $prosent_budsjett = $saldo->avvik_budsjett * 100 / $saldo->budsjett;
                            else
                                $prosent_budsjett = 0;

                            if ($saldo->belop > 0)
                                $prosent_fjorar = $saldo->avvik_fjorar * 100 / $saldo->belop;
                            else
                                $prosent_budsjett = 0;

                            if ($saldo->hittil > 0)
                                $prosent_hittil = $saldo->avvik_hittil * 100 / $saldo->hittil;
                            else
                                $prosent_hittil = 0;
                    }
                ?>


                    <!-- <div id="myLabel">This is the target label</div> -->
                    <!-- <div id="myLabel">This is the target label</div> -->




                    <script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
                    <script type="text/javascript">
                        // Function to get query parameters from URL
                        function getQueryParam(name) {
                            console.log('getQueryParam');
                            const urlParams = new URLSearchParams(window.location.search);
                            return urlParams.get(name);
                        }

                        // Get the 'value' parameter
                        const value = getQueryParam('value');
                        console.log('value', value);
                        // Update the label if 'value' exists
                        if (value) {
                            document.getElementById("myLabel").innerText = value;
                        }


                        function f_valg() {
                            console.log("f_valg");
                            const avvik = document.getElementById("id_avvik").value;
                            console.log("f_valg :" + avvik);
                            // document.forms["myForm"].submit();
                            document.getElementById('myForm').submit();
                            //          location.reload();
                            //  alert("reload");
                        }


                        function f_valg_ar() {
                            console.log("f_valg_ar");
                            const avvik = document.getElementById("id_valg_ar").value;
                            console.log("f_valg_ar :" + avvik);
                            //   document.forms["myForm"].submit();
                            document.getElementById('myForm').submit();
                            // location.reload();
                            //    alert("reload");
                        }

                        function f_valg_periode() {
                            console.log("f_valg_periode");
                            const avvik = document.getElementById("id_valg_periode").value;
                            console.log("f_valg_periode :" + avvik);
                            // document.forms["myForm"].submit();
                            document.getElementById('myForm').submit();
                            //          location.reload();
                            //  alert("reload");
                        }


                        function f_kontoer(per, ar) {
                            //  console.log("f_kontoer",per,ar);
                            const kto = document.getElementById("id_kontoer").value;
                            console.log("f_kontoer :", kto, per, ar);
                            $.ajax({
                                //          jQuery.ajax({
                                type: "POST",
                                url: "index.php?option=com_regn&task=resultat.kontorer",
                                //arguments url: "/components/com_regn/views/Registrering/tmpl/update.php",
                                //     url: "/components/com_regn/views/Bilagsart/tmpl/update.php",
                                data: ({
                                    kto: kto,
                                    per: per,
                                    ar: ar
                                }),
                                cache: false,
                                success: function (tekst) {


                                }
                            })
                        }








                        function offsi() {

                            //function updateAndReloadParam(name, value) {
                            const valg = document.getElementById("id_sort").value;
                            const url = new URL(window.location.href);
                            console.log('valg', valg);
                            console.log('url1', url);
                            url.searchParams.set("valg", valg);
                            console.log('url2', url);
                            window.location.href = url.toString();
                            //  location.reload();
                        }
                    </script>