<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerSok extends BaseController
{


    function debet_oppdat_sokUU()
    {

        echo 'BBBBBBBBBBBBB';
        // exit();
        // $db = Factory::getDbo();
        // $sql = $db->getQuery(true);
        // $input = JFactory::getApplication()->input;
        // $sok1 = $input->post->get('sok1', '', 'string'); // Adjust type as needed
        // $sok2 = $input->post->get('sok2', '', 'string'); // Adjust type as needed
        // $valg = $input->post->get('valg', '', 'string'); // Adjust type as needed
        // $ar = $input->post->get('ar', '', 'string'); // Adjust type as needed
        // $per = $input->post->get('per', '', 'string'); // Adjust type as needed

        //     echo 'f_debet_oppdat_sok  valg: ' . $valg . ' per1: ' . $per . ' ar1: ' . $ar . ' sok1: ' . $sok1 .  ' sok2: ' . $sok2 . '<br>';
        //        exit();
        JFactory::getApplication()->close();
    }


    function debet_oppdat_sok()
    {
        // echo 'AAdebet_oppdat_sok<br>';
        // exit();
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $input = JFactory::getApplication()->input;
        $sok1 = $input->post->get('sok1', '', 'string'); // Adjust type as needed
        $sok2 = $input->post->get('sok2', '', 'string'); // Adjust type as needed
        $valg = $input->post->get('valg', '', 'string'); // Adjust type as needed
        $ar = $input->post->get('ar', '', 'string'); // Adjust type as needed
        $per = $input->post->get('per', '', 'string'); // Adjust type as needed

        //   echo 'f_debet_oppdat_sok  valg: ' . $valg . ' per1: ' . $per . ' ar1: ' . $ar . ' sok1: ' . $sok1 .  ' sok2: ' . $sok2 . '<br>';
        //        exit();
        // JFactory::getApplication()->close();
        if ($valg == 'fritekst') {

            if ($ar == "Alle år" && $per == "Alle perioder")
                $sql = 'select sum(belop) as bel2,count(belop) as ant2 from #__regn_hist where (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%") ';
            elseif ($per == "Alle perioder")
                $sql = 'select sum(belop) as bel2 ,count(belop) as ant2 from #__regn_hist where  (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%") and Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = 'select sum(belop) as bel2 ,count(belop) as ant2  from #__regn_hist where  (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%")  and Periode="' . $per . '"';
            else
                $sql = 'select sum(belop) as bel2 ,count(belop) as ant2  from #__regn_hist where  (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%") and Periode="' . $per . '" and Regnskapsar=' . $ar;
            $sql = $sql . ';';
            // echo 'SQL: '.$sql,'<br>';
            // if ($sort == "Dato")
            // 	$sql = $sql . ' order by Dato ';
            // elseif ($sort == "Beløp")
            // 	$sql = $sql . ' order by belop ';
            // else
            // 	$sql = $sql . ' order by ref ';

            // if ($rekke == "Ned")
            // 	$sql = $sql . ' desc ';

            // $sql = $sql . ' limit ' . $ant . ' offset ' . $offset;
            //	echo $sql ;

            // $result = $conn->query($sql);
            // $temparray1 = array();
            // while ($row = mysqli_fetch_assoc($result))
            //     $temparray1 = $row;
            // echo json_encode($temparray1);
        } else if ($valg == 'sql' ) {
            $sql=$sok2;
        } else if ($valg == 'belomrade') {
            // if ($ar == "Alle år" && $per == "Alle perioder")
            $sql = 'select sum(belop) as bel2,count(belop) as ant2 from #__regn_hist where ((belop>=' . $sok1 . ') and   (belop<=' . $sok2 . '))';
            if ($per == "Alle perioder")
                $sql = $sql . ' and Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = $sql . ' and Periode="' . $per . '"';
            else
                $sql = $sql . ' and Periode="' . $per . '" and Regnskapsar=' . $ar;
        } else if ($valg == 'datoomrade') {
            $sql = 'select sum(belop) as bel2,count(belop) as ant2 from #__regn_hist where ((dato>="' . $sok1 . '") and   (dato <="' . $sok2 . '"));';
        } else if ($valg == 'belop') {
            if ($ar == "Alle år" && $per == "Alle perioder")
                $sql = 'select sum(belop) as bel2,count(belop) as ant2 from #__regn_hist where belop=' . $sok2;
            elseif ($per == "Alle perioder")
                $sql = 'select sum(belop) as bel2 ,count(belop) as ant2 from #__regn_hist where belop=' . $sok2 . ' and  Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = 'select sum(belop) as bel2 ,count(belop) as ant2  from #__regn_hist where belop=' . $sok2 . ' and Periode="' . $per . '"';
            else
                $sql = 'select sum(belop) as bel2 ,count(belop) as ant2  from #__regn_hist where belop=' . $sok2 . ' and Periode="' . $per . '" and Regnskapsar=' . $ar;
            $sql = $sql . ';';
        } else if ($valg == 'dato') {
            $sql = 'select sum(belop) as bel2,count(belop) as ant2 from #__regn_hist where dato="' . $sok1 . '"';
        } else if ($valg == 'kto') {
            $sql = 'select sum(belop) as bel,count(belop) as ant from #__regn_hist where debet="' . $sok2 . '" and dato="2022-02-02";';
            //   echo $sql.'<br>';
            $db->setQuery($sql);
            $result1 = $db->loadObject();
            $sql = 'select sum(belop) as bel,count(belop) as ant from #__regn_hist where kredit="' . $sok2 . '" and dato="2022-02-02";';
            // echo $sql . '<br>';
            $db->setQuery($sql);
            $result2 = $db->loadObject();
            $ddd = json_encode($result2);
            // echo 'ddd  ' . $ddd . '|';
            // echo 'bel2: ' . $result2->bel . '<br>';
            // echo   'bel1: ' . $result1->bel . '|ant1: ' . $result1->ant . '|bel2: ' . $result2->bel . '|ant2: ' . $result2->ant . '|';
            $jsn = '{}';
            $obj3 = []; // json_decode($jsn, true);
            // echo 'obj3: '.$obj3.'|';
            // $obj3 = json_decode($result1, true);
            $obj3['bel1'] = $result1->bel;
            $obj3['ant1'] = $result1->ant;
            $obj3['bel2'] = $result2->bel;
            $obj3['ant2'] = $result2->ant;
            // echo 'OOOOOOOOOOOOBJ:  '.$obj3.'<br>';
            //  echo   'bel1: ' . $obj3['bel1'] . '|ant1 ' . $obj3['ant1']  . '|bel2 ' . $obj3['bel2']  . '|ant2 ' . $obj3['ant2'] . '|';
            $json1 = json_encode($obj3);
            echo $json1;

            // $obj3["ant1"]= $result1[0]->ant;
            //  echo 'obj3: '. $obj3.'<br>';

        }
         // echo 'SQL: ' . $sql . '<br>';
        if ($valg != 'kto') {
            //  $sql = $sql . ';';
            $db->setQuery($sql);
            $result = $db->loadObject();
            echo json_encode($result);
            //   echo 'AAAAAAAAAAAAAAAA';
            JFactory::getApplication()->close();
        };
        JFactory::getApplication()->close();
        // echo json_encode($result);   

    }


    function oppdat_sok()
    {
        //     echo 'oppdat_sok controller<br>';
        // }
        // function oppdat_sok3()
        // {

        $input = JFactory::getApplication()->input;
        $sok1 = $input->post->get('sok1', '', 'string'); // Adjust type as needed
        $sok2 = $input->post->get('sok2', '', 'string'); // Adjust type as needed
        $sok3 = $input->post->get('sok3', '', 'string'); // Adjust type as needed
        $valg = $input->post->get('valg', '', 'string'); // Adjust type as needed
        $ar = $input->post->get('ar', '', 'string'); // Adjust type as needed
        $per = $input->post->get('per', '', 'string'); // Adjust type as needed
        $sort = $input->post->get('sort', '', 'string'); // Adjust type as needed
        $rekke = $input->post->get('rekke', '', 'string'); // Adjust type as needed
        $ant = $input->post->get('ant', '', 'string'); // Adjust type as needed
        $offset = $input->post->get('offset', '', 'string'); // Adjust type as needed

        //$sok1='"' + $sok1+'"';

        //        echo 'inngående variable:   $sok1: ' . $sok1 . ' $sok2: ' . $sok2 . ' $sok3: ' . $sok3 . '  $valg : ' . $valg . '  $sort : ' . $sort . '<br>';
        //        echo 'pass ' . $valg . '<br>';
        //  echo ' $valg ' . $valg.'<br>';
        //         // }
        // function oppdat_sok3()
        // {    
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        //echo 'pass2'.$valg.'<br>';
        // }
        // function oppdat_sok2()
        // {  else if ($valg=='sql')

        //    select * from csv limit 3; 

        // echo 'valg: ' . $valg . '|' .  $sok2 . '<br>';


        if ($valg == "sql") {   //   select * from csv limit 10

            //echo 'sok ' . $sok2 . '<br>';
            $sql = $sok2;
            $db->setQuery($sql);
            $result = $db->loadObjectList();

            $r = $result;
            $ret  = json_encode($result);
            $dataArray = json_decode($ret, true); // `true` converts to associative array

            // Decode JSON into a PHP object
            $dataObject = json_decode($ret); // Without `true`, it returns an object    
            $data = json_encode($dataObject[1]);

            $jsonString = $data;
            $dataArray = json_decode($jsonString, true);
            echo '<table><tr><<th>';
            // Function to recursively list keys
            function listKeys($array, $prefix = '')
            {
                foreach ($array as $key => $value) {
                    echo $prefix . $key . ' </th><th> ';
                }
                echo '</th></tr><tr>';
            }
            listKeys($dataArray);

            foreach ($dataObject as $object) {
                $data = json_encode($object);
                $ret = $data;
                $data1 = json_decode($ret, true); // Use true to get an associative array

                // Check if the decoding was successful
                if (json_last_error() === JSON_ERROR_NONE) {
                    // Loop through the values and display them
                    foreach ($data1 as $value) {
                        $g = strlen($value) * 10;
                        echo '</td><td width="' . $g . '">' . $value;
                    }
                } else {
                    echo "Invalid JSON!";
                }

                echo '</td></tr><tr>';
            }
        } else if ($valg == "kto") {

            //  echo 'konto er valgt<br>';

            $sql = 'select * from #__regn_hist where (debet="' . $sok2 . '" or kredit="' . $sok2 . '") ';
            if ($per == "Alle perioder")
                $sql = $sql . ' and Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = $sql . '  and Periode="' . $per . '"';
            else
                $sql = $sql . ' and Periode="' . $per . '" and Regnskapsar=' . $ar;
            if ($sort == "dato")
                $sql = $sql . ' order by Dato ';
            elseif ($sort == "Beløp")
                $sql = $sql . ' order by belop ';
            elseif ($sort == "Bilag")
                $sql = $sql . ' order by bilag ';
            else
                $sql = $sql . ' order by ref ';
            if ($rekke == "Ned")
                $sql = $sql . ' desc ';
            $sql = $sql . ' limit  ' . $ant;
            //  echo $sql . '<br><br>';

            $img = '<table>';
            $img = $img . '<tr><th width="100" style="text-align:right;border-width:0px;">Dato</th>';
            $img = $img . '<th width="100" style="text-align:right;border-width:0px;">Bilag </th>';
            $img = $img . '<th width="60" style="text-align:right;border-width:0px;">Debet </th>';
            $img = $img . '<th width="60" style="text-align:right;border-width:0px;">Kredit </th>';
            $img = $img . '<th width="120" style="text-align:right;border-width:0px;">Beløp </th>';
            $img = $img . '<th width="300" style="text-align:left;padding-left: 10px;border-width:0px; ">Tekst </th>';
            $img = $img . '<th width="500">Kontoinfo</th></tr>';

            $db->setQuery($sql);
            $r = [];
            $result = $db->loadObjectList();
            //   echo $result[1]['dato'];
            foreach ($result as $linje) {
                $img = $img . '<tr><td width="100" style="text-align:right;border-width:0px;">' .  date("d.m.Y", strtotime($linje->Dato)) . ' </td>';
                $img = $img . '<td width="100" style="text-align:right;border-width:0px;">' .  $linje->Bilag . ' </td>';
                $img = $img . '<td width="60" style="text-align:right;border-width:0px;">' .  $linje->debet . ' </td>';
                $img = $img . '<td width="60" style="text-align:right;border-width:0px;">' .  $linje->kredit . ' </td>';
                $img = $img . '<td width="120" style="text-align:right;border-width:0px;">' . number_format($linje->belop, 2, ',', '.')  . ' </td>';
                $img = $img . '<td width="200" style="text-align:left;padding-left: 10px;border-width:0px; ">' .   substr($linje->Tekst, 0, 30) . ' </td>';
                $img = $img . '<td width="500">' .  substr($linje->kontoinfo, 0, 50) . ' </td></tr>';
            }
            $img = $img . '</table>';
            echo $img . '<br>';

            // $r = $result;
            $ret  = json_encode($result);
            $dataArray = json_decode($ret, true); // `true` converts to associative array

            // Decode JSON into a PHP object
            $dataObject = json_decode($ret); // Without `true`, it returns an object    
            $data = json_encode($dataObject[1]);
            // echo $ret . '<br>';
            $jsonString = $data;
            $dataArray = json_decode($jsonString, true);
        } else if ($valg == "dato") {
            //  echo 'dato<br>';
            // if ($ar == "Alle år" && $per == "Alle perioder")
            $sql = 'select * from #__regn_hist where Dato="' . $sok1 . '"';
            // elseif ($per == "Alle perioder")
            // $sql =  'select * from #__regn_hist where Dato=' . $sok1 . ' and Regnskapsar=' . $ar;
            // elseif ($ar == "Alle år")
            //     $sql = 'select * from #__regn_hist where Dato=' . $sok1 . '  and Periode="' . $per . '"';
            // else
            //     $sql = 'select * from #__regn_hist where Dato=' . $sok1 . ' and Periode="' . $per . '" and Regnskapsar=' . $ar;
            //	echo $sql;
            if ($sort == "dato")
                $sql = $sql . ' order by Dato ';
            elseif ($sort == "Beløp")
                $sql = $sql . ' order by belop ';
            elseif ($sort == "Bilag")
                $sql = $sql . ' order by bilag ';
            else
                $sql = $sql . ' order by ref ';

            if ($rekke == "Ned")
                $sql = $sql . ' desc ';

            $sql = $sql . ' limit ' . $ant . ' offset ' . $offset . ';';
        } else if ($valg == 'datoomrade') {
            $sql = 'select * from #__regn_hist where ((dato>="' . $sok1 . '") and   (dato <="' . $sok2 . '"));';
        } else if ($valg == 'fritekst') {
            if ($ar == "Alle år" && $per == "Alle perioder")
                $sql = 'select * from #__regn_hist where (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%") ';
            elseif ($per == "Alle perioder")
                $sql = 'select * from #__regn_hist where  (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%") and Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = 'select * from #__regn_hist where  (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%")  and Periode="' . $per . '"';
            else
                $sql = 'select * from #__regn_hist where  (tekst LIKE "%' . $sok2 . '%" or kontoinfo LIKE "%' . $sok2 . '%") and Periode="' . $per . '" and Regnskapsar=' . $ar;
            //	echo $sql;
            if ($sort == "Dato")
                $sql = $sql . ' order by Dato ';
            elseif ($sort == "Beløp")
                $sql = $sql . ' order by belop ';
            else
                $sql = $sql . ' order by ref ';

            if ($rekke == "Ned")
                $sql = $sql . ' desc ';

            $sql = $sql . ' limit ' . $ant . ' offset ' . $offset . ';';


            //     echo $sql;
        } else if ($valg == "belop") {
            //    echo 'belop<br>';
            if ($ar == "Alle år" && $per == "Alle perioder")
                $sql = 'select * from #__regn_hist where belop=' . $sok2;
            elseif ($per == "Alle perioder")
                $sql =  'select * from #__regn_hist where belop=' . $sok2 . ' and Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = 'select * from #__regn_hist where belop=' . $sok2 . '  and Periode="' . $per . '"';
            else
                $sql = 'select * from #__regn_hist where belop=' . $sok2 . ' and Periode="' . $per . '" and Regnskapsar=' . $ar;
            //	echo $sql;
            if ($sort == "Dato")
                $sql = $sql . ' order by Dato ';
            elseif ($sort == "Beløp")
                $sql = $sql . ' order by belop ';
            else
                $sql = $sql . ' order by ref ';

            if ($rekke == "Ned")
                $sql = $sql . ' desc ';

            $sql = $sql . ' limit ' . $ant . ' offset ' . $offset . ';';
        } else if ($valg == "datoomrade") {
            // echo 'beomrade<br>';
            if (
                $ar == "Alle år" && $per == "Alle perioder"
            )
                $sql = 'select * from #__regn_hist where belop>=' . $sok1 . ' and belop<=' . $sok2;
        } else if ($valg == "belomrade") {
            // echo 'beomrade<br>';
            if ($ar == "Alle år" && $per == "Alle perioder")
                $sql = 'select * from #__regn_hist where belop>=' . $sok1 . ' and belop<=' . $sok2;
            elseif ($per == "Alle perioder")
                $sql =  'select * from #__regn_hist where belop>=' . $sok1 . ' and belop<=' . $sok2 . ' and Regnskapsar=' . $ar;
            elseif ($ar == "Alle år")
                $sql = 'select * from #__regn_hist where belop>=' . $sok1 . ' and belop<=' . $sok2 . '  and Periode="' . $per . '"';
            else
                $sql = 'select * from #__regn_hist where belop>=' . $sok1 . ' and belop<=' . $sok2 . ' and Periode="' . $per . '" and Regnskapsar=' . $ar;
            //	echo $sql;
            if ($sort == "Dato")
                $sql = $sql . ' order by Dato ';
            elseif ($sort == "Beløp")
                $sql = $sql . ' order by belop ';
            else
                $sql = $sql . ' order by ref ';

            if ($rekke == "Ned")
                $sql = $sql . ' desc ';

            $sql = $sql . ' limit ' . $ant . ' offset ' . $offset . ';';
        }
        //  echo 'SQL: '.$sql.'<br>';


        if (($valg != 'sql') && ($valg != 'kto')) {
            $db->setQuery($sql);
            $result = $db->loadObjectList();
            echo json_encode($result);
        }








        JFactory::getApplication()->close();
    }
}
