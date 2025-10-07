<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerResmal extends BaseController
{
    function oppdat_kto()
    {
        $session = Factory::getSession();
        $value = $session->get('klient');

        $input = Factory::getApplication()->input;
        $rap = $input->getString('rap', '');
        $kto = $input->getString('kto', '');
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        if ($value > '')
            $query = 'update ' . $value . '.qo7sn_regn_kto set rapportlinje=' . $rap . ' where Ktonr=' . $kto . ';';
        else
            $query = 'update qo7sn_regn_kto set rapportlinje=' . $rap . ' where Ktonr=' . $kto . ';';
        $db->setQuery($query);
        try {
            $result = $db->execute();
            // echo json_encode($result);
            // echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        $query = $db->getQuery(true);
        if ($value > '')
            $query = 'update ' . $value . '.qo7sn_regn_saldo set raplinje=' . $rap . ' where kto=' . $kto . ';';
        else
            $query = 'update qo7sn_regn_saldo set raplinje=' . $rap . ' where kto=' . $kto . ';';
        $db->setQuery($query);
        try {
            $result = $db->execute();
            // echo json_encode($result);
            // echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();
    }





    function oppdat_mal()
    {
        $session = Factory::getSession();
        $value = $session->get('klient');

        $input = Factory::getApplication()->input;
        $nr = $input->getString('nr', '');
        $tekst = $input->getString('tekst', '');
        $niva = $input->getString('niva', '');
        $mode = $input->getString('mode', '');
        $br = $input->getString('br', '');
        $br = $input->getString('br', '');
        $db = Factory::getDbo();
        $nr1 = $nr + 1;
        //  $sql = 'update #__regn_kto set rapportlinje="'.$rap.'",Rapport1="'.$rap1.'",Likvid="'.$likv.'" where Ktonr='.$kto.';';
        if ($value > '') {
            if ($mode == "Insert")
                $sql = 'insert into  ' . $value . '.qo7sn_regn_resmal (nr,BR,niva) VALUE (' . $nr1 . ',"' . $br . '",' . $niva . ');';
            else if ($mode == "Delete")
                $sql = 'DELETE FROM ' . $value . '.#__regn_resmal WHERE nr=' . $nr . ' and BR="' . $br . '";';
            else
                $sql = 'update ' . $value . '.#__regn_resmal set  tekst="' . $tekst . '", niva="' . $niva . '" where nr=' . $nr . ' and BR="' . $br . '";';
        } else {
            if ($mode == "Insert")
                $sql = 'insert into  qo7sn_regn_resmal (nr,BR,niva) VALUE (' . $nr1 . ',"' . $br . '",' . $niva . ');';
            else if ($mode == "Delete")
                $sql = 'DELETE FROM #__regn_resmal WHERE nr=' . $nr . ' and BR="' . $br . '";';
            else
                $sql = 'update #__regn_resmal set  tekst="' . $tekst . '", niva="' . $niva . '" where nr=' . $nr . ' and BR="' . $br . '";';
        }
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

    function insertmal()
    {
        $session = Factory::getSession();
        $value = $session->get('klient');

        $input = Factory::getApplication()->input;
        $nr = $input->getString('nr', '');
        $tekst = $input->getString('tekst', '');
        $niva = $input->getString('niva', '');
        $mode = $input->getString('mode', '');
        $br = $input->getString('br', '');
        $db = Factory::getDbo();
        $nr1 = $nr + 1;
        //  $sql = 'update #__regn_kto set rapportlinje="'.$rap.'",Rapport1="'.$rap1.'",Likvid="'.$likv.'" where Ktonr='.$kto.';';

        if ($value > '') {
            if ($mode == "Insert")
                $sql = 'insert into  ' . $value . '.qo7sn_regn_resmal (nr,tekst,BR,niva) VALUE (' . $nr . ',"' . $tekst . '","' . $br . '",' . $niva . ');';
            else if ($mode == "Delete")
                $sql = 'DELETE FROM ' . $value . '.#__regn_resmal WHERE nr=' . $nr . ' and BR="' . $br . '";';
            else
                $sql = 'update ' . $value . '.#__regn_resmal set  tekst="' . $tekst . '", niva="' . $niva . '" where nr=' . $nr . ' and BR="' . $br . '";';
        } else {

            if ($mode == "Insert")
                $sql = 'insert into  qo7sn_regn_resmal (nr,tekst,BR,niva) VALUE (' . $nr . ',"' . $tekst . '","' . $br . '",' . $niva . ');';
            else if ($mode == "Delete")
                $sql = 'DELETE FROM #__regn_resmal WHERE nr=' . $nr . ' and BR="' . $br . '";';
            else
                $sql = 'update #__regn_resmal set  tekst="' . $tekst . '", niva="' . $niva . '" where nr=' . $nr . ' and BR="' . $br . '";';
        }

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


    function oppdat_func()
    {
        $session = Factory::getSession();
        $value = $session->get('klient');

        $input = Factory::getApplication()->input;
        $nr = $input->getString('nr', '');
        $key = $input->getString('key', '');
        $mode = $input->getString('mode', '');
        $db = Factory::getDbo();
        $br = $input->getString('br', '');
        $query = $db->getQuery(true);

        if ($value > '') {
            if ($key == 'Insert')
                $sql = 'insert into  ' . $value . '.qo7sn_regn_resmal  (nr,BR,niva) VALUE (' . $nr + 1 . ',"' . $br . '",1);';
            elseif ($key == 'Delete')
                $sql = 'delete from  ' . $value . '.qo7sn_regn_resmal where nr=' . $nr . ';';
        } else {

            if ($key == 'Insert')
                $sql = 'insert into qo7sn_regn_resmal  (nr,BR,niva) VALUE (' . $nr + 1 . ',"' . $br . '",1);';
            elseif ($key == 'Delete')
                $sql = 'delete from qo7sn_regn_resmal where nr=' . $nr . ';';
        }
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
