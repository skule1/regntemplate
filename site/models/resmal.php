<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
function get_database()
{
    $user = JFactory::getUser();
    $username = $user->username;
    $database = $user->authProvider;
    if ($database) {
        if (($database[0] == "X") || ($database[0] == "$"))
            $database = substr($database, 1);
        $database = $database . '.';
    }
    return $database;
}
//use Joomla\CMS\Response\JsonResponse;

class RegnModelResmal extends ListModel
{
    public function __construct($config = array())
    {
        parent::__construct($config);

        //     // Set the default sorting order and column
        //     $this->setState('list.ordering', 'id');
        //     $this->setState('list.direction', 'ASC');
    }


    public function hentmal()
    {

        $database = get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_resmal order by nr;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function hentkto()
    {
        $database = get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_kto order by Ktonr;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function getListQuery1($h)
    {
        $database = get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select * from ' . $value . 'qo7sn_regn_hist where belop=' . $h . ' limit 10;';
        $db->setQuery((string) $query);
        $message1 = $db->loadObjectList();
        return $message1;
    }
}
