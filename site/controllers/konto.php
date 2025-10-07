<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerKonto extends BaseController
{

    function f_debet_oppdat_bev()
{
	global $hash, $conn;
	$ar = $_POST['ar'];
	$per = $_POST['per'];
	$kto = $_POST['kto'];

	$sql = 'select sum(belop) as ss, count(belop) as cnt from ' . $hash . 'regn_hist where debet=' . $kto;
	if ($ar != 'Alle år')
		$sql = $sql . ' and Regnskapsar=' . $ar;
	if ($per != 'Alle perioder')
		$sql = $sql . ' and periode="' . $per . '"';
	$sql = $sql . ';';
	//echo $sql . '<br>';
	$result = $conn->query($sql);
	$temparray1 = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray1 = $row;

	echo json_encode($temparray1);
}



function f_kredit_oppdat_bev()
{
	global $hash, $conn;
	$ar = $_POST['ar'];
	$per = $_POST['per'];
	$kto = $_POST['kto'];

	$sql = 'select sum(belop) as ss, count(belop) as cnt from ' . $hash . 'regn_hist where kredit=' . $kto;
	if ($ar != 'Alle år')
		$sql = $sql . ' and Regnskapsar=' . $ar;
	if ($per != 'Alle perioder')
		$sql = $sql . ' and periode="' . $per . '"';
	$sql = $sql . ';';
	//echo $sql . '<br>';
	$result = $conn->query($sql);
	$temparray1 = array();
	while ($row = mysqli_fetch_assoc($result))
		$temparray1 = $row;

	echo json_encode($temparray1);
}

     function offs1()
    {
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $input = JFactory::getApplication()->input;
        $kto = $input->post->get('kto', '', 'string');
        $ar = $input->post->get('ar', '', 'string');
        $per = $input->post->get('per', '', 'string');
        $sort = $input->post->get('sort', '', 'string');
        $rekke = $input->post->get('rekke', '', 'string');
        $ant = $input->post->get('ant', '', 'string');
        $offset = $input->post->get('offset', '', 'string');


        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_kto   where Ktonr=' . $kto . ';';
        //	echo $kto.'  '.	$ar.'  '. $per.'  '. $sort.'  '. $rekke.'  '. $ant;
        if ($ar == "Alle år" && $per == "Alle perioder")
            $sql = 'select * from qo7sn_regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ')';
        elseif ($per == "Alle perioder")
            $sql = 'select * from qo7sn_regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ') and year(Dato)=' . $ar;
        elseif ($ar == "Alle år")
            $sql = 'select * from qo7sn_regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ')  and Periode="' . $per . '"';
        else
            $sql = 'select * from qo7sn_regn_hist where (debet=' . $kto . ' or kredit=' . $kto . ') and Periode="' . $per . '" and  year(Dato)=' . $ar;

        $sqld = 'select sum(belop) from qo7sn_regn_hist where (debet=' . $kto . ') and Periode="' . $per . '" and  year(Dato)=' . $ar;
        $sqlk = 'select sum(belop) from qo7sn_regn_hist where (kredit=' . $kto . ') and Periode="' . $per . '" and  year(Dato)=' . $ar;

        if ($sort == "Dato")
            $sql = $sql . ' order by Dato ';
        elseif ($sort == "Beløp")
            $sql = $sql . ' order by belop ';
        else
            $sql = $sql . ' order by ref ';

        if ($rekke == "Ned")
            $sql = $sql . ' desc ';

        $sql = $sql . ' limit ' . $ant . ' offset ' . $offset;

        $sql = $sql . ';';

        $db->setQuery($sql);
        // $result = $db->loadObject();
        // echo $result;
        // JFactory::getApplication()->close();

        try {
            $svar = $db->loadObjectlist(); // Returns an array of associative arrays
            ///echo $svar;
            $j=json_encode($svar);
            echo $j;
            JFactory::getApplication()->close();

        } catch (RuntimeException $e) {
            return []; // Handle database errors gracefully
        }




    }
    function hent_kto()
    {
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $input = JFactory::getApplication()->input;
        $kto = $input->post->get('kto', '', 'string'); // Adjust type as needed
        $sql = 'select * from qo7sn_regn_kto   where Ktonr=' . $kto . ';';
        $db->setQuery($sql);
        // $result = $db->loadObject();
        // echo $result;
        // JFactory::getApplication()->close();

        try {
            $svar = $db->loadObject(); // Returns an array of associative arrays
            ///echo $svar;
            echo json_encode($svar);
            JFactory::getApplication()->close();

        } catch (RuntimeException $e) {
            return []; // Handle database errors gracefully
        }




        // try {
        //     echo $db->loadObject(); // Returns 
        // } catch (RuntimeException $e) {
        //     echo 'Error inserting row: ' . $e->getMessage();
        // }
        //
        JFactory::getApplication()->close();
    }
}