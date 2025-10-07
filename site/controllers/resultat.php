<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerResultat extends BaseController
{
    function oppdat_kto()
    {
        $input = Factory::getApplication()->input;
        $rap = $input->getString('rap', '');
        // $rap1 = $input->getString('rap1', '');
        // $likv = $input->getString('likv', '');
        $nr = $input->getString('nr', '');
        $tekst = $input->getString('tekst', '');
        $niva = $input->getString('niva', '');
        $mode = $input->getString('mode', '');
        $db = Factory::getDbo();
        $nr1=$nr+1;
        //  $sql = 'update #__regn_kto set rapportlinje="'.$rap.'",Rapport1="'.$rap1.'",Likvid="'.$likv.'" where Ktonr='.$kto.';';
        if ($mode == "Insert")
            $sql = 'insert into  qo7sn_regn_resmal (nr,BR,niva) VALUE ('.$nr1.',"R",1);';
        else if ($mode == "Delete")
            $sql = 'DELETE FROM #__regn_resmal WHERE nr='.$nr.';';
        else
            $sql = 'update #__regn_resmal set  tekst="'.$tekst.'", niva="'.$niva.'" where nr=' . $nr . ';';
        echo 'sql: ' . $sql . '<br>';
        $db->setQuery($sql);
        try {
            $result = $db->execute();
            echo json_encode($result);
            echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();
    }

}