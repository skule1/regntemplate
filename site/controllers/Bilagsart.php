<?php
defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerBilagsart extends BaseController
{

    public function slett()
    {
        echo 'f_slett subcontroller bilagsart     ';
        //           JFactory::getApplication()->close();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $id = $input->getString('id', '');
        echo '  id: ' . $id;
        echo '  a: ' . $a;
        $id = $input->getString('id', '');
        $sql = 'DELETE FROM #__regn_bilagsarter WHERE id=' . $id . ';';
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
    public function endre()
    {
        echo 'endre subcontroller bilagsart     ';
        //           JFactory::getApplication()->close();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $id = $input->getString('id', '');
        $beskrivelse = $input->getString('beskrivelse', '');
        $dato = $input->getString('dato', '');
        $debet = $input->getString('debet', '');
        $kredit = $input->getString('kredit', '');
        $belop = $input->getString('belop', '');
        $tekst = $input->getString('tekst', '');
echo 'belop: '.$belop.'<br>';
        $sql = 'UPDATE #__regn_bilagsarter set 
             beskrivelse="' . $beskrivelse . '",
              debet="' . $debet . '",
               kredit="' . $kredit . '",
               tekst="' . $tekst . '"' ;
        if ($dato > "") $sql = $sql . ' dato="' . $dato . '"';
        if ($belop > "") $sql = $sql . ' belop="' . $belop . '"';
        $sql = $sql . '  WHERE id=' . $id . ';';
        echo 'sql: ' . $sql . '<br>';
        $db->setQuery($sql);
        try {
            $result = $db->execute();
            echo json_encode($result);
            echo 'Row chaged successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();
    }

    //               
    //           dato="'. $dato. '",
    //  belop="' . $belop . '",

    function neste()
    {
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $value = $input->get('klient');
        $id = $input->get("id");
        $beskrivelse = $input->get("beskrivelse");
        $dato = $input->get("dato");
     //   if ($dato == '') $dato =  "0000-00-00"; // date('Y-m-d');
        $debet = $input->get("debet");
        $kredit = $input->get("kredit");
        $belop = $input->get("belop");
     //   if ($belop == '') $belop = 0;
        $tekst = $input->get("tekst");

        $query = $db->getQuery(true);
        $query = 'insert into qo7sn_regn_bilagsarter set id=' . $id 
        . ', beskrivelse='. $db->quote($beskrivelse) 
        . ', dato=' . $db->quote($dato) 
        . ', debet=' . $db->quote($debet) 
        . ', kredit=' . $db->quote($kredit) 
        . ', belop=' . $db->quote($belop) 
        . ', tekst=' . $db->quote($tekst) . '  ;';

        $db->setQuery((string) $query);
        try {
            return $db->execute(); // Returns 
       } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();









}
}
