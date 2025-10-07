<?php

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
//global $db;$db = Factory::getDbo();

// use Joomla\CMS\Factory;
// use Joomla\CMS\MVC\Controller\BaseController;
// use Joomla\CMS\Response\JsonResponse;

class RegnModelHist extends ListModel
{

    function get_database()
    {
        //  $model = new RegnModelHist;
        $user = JFactory::getUser();
        $username = $user->username;
        $database = $user->authProvider;
        if ($database) {
            if (($database[0] == "X") || ($database[0] == "$"))
                $database = substr($database, 1);
            $database = $database . '.';
        }
        //  $model->oppdater_user($user);
        return $database;
    } 


    function hist($regnskapsar, $periode, $sort, $desc, $count)
    {
        $database = $this->get_database();
        $pernr = $this->periode($periode);
        if ($desc!="desc") $desc="";
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_hist where year(Dato)="' . $regnskapsar .
            '" and MONTH(Dato)="' . $pernr["nr"] . '" order by ' . $sort . ' ' . $desc . ' ;';
        $db->setQuery((string) $sql);
        try {
            return $db->loadObjectList();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }
    }

    function firma()
    {
        $database = $this->get_database();
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_firma;';
        $db->setQuery((string) $sql);
        try {
            return $db->loadObject();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }
    }


    public function regnskapsar()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_regnskapsar order by regnskapsar desc';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function regnskapsa1r()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_regnskapsar order by regnskapsar desc';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function perioder($mode)
    {
        $database = $this->get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($mode == '0')
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder order by nr ';
        else if ($mode == '1')
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder order by Periodenavn ';
        else
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder where Periodenavn="' . $mode . '";';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectList();
        return $messages;
    }
    function periode($periodenavn)
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder where Periodenavn="' . $periodenavn . '";';
        $db->setQuery((string) $query);
        $messages = $db->loadAssoc();
        return $messages;
    }
}
?>