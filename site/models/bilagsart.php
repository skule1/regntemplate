<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;

class RegnModelBilagsart extends ListModel
{

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

    public function __construct($config = array())
    {
        parent::__construct($config);

        //     // Set the default sorting order and column
        //     $this->setState('list.ordering', 'id');
        //     $this->setState('list.direction', 'ASC');
    }
    function sistepost()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select all fields from your table
        // $query->select('*')
        //     ->from($db->quoteName('csv'));
        $query = 'select * from ' . $database . '#__regn_trans ORDER BY Ref DESC limit 1;';

        $db->setQuery((string) $query);
        $message1 = $db->loadObject();
        return json_encode($message1);
        //  return $message1;

    }

    function regnskapsar()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_firma;';
        $db->setQuery((string) $query);
        $message = $db->loadObject();
        // return 'GGGGGGGGGGGGG';//$message->Ref;
        // echo 'GGGGGGGGGGGGG';//$message->Ref;
        // //      return json_encode($message);
        return $message;
    }
    function transer()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_bilagsarter;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
        return $message;
    }


    function endre()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $session = Factory::getSession();
        $value = $session->get('klient');
        $query = $db->getQuery(true);
        $query = 'update *  from ' . $database . '#__regn_bilagsarter set ;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
        return $message;
    }

    // function neste()
    // {
    //     $session = Factory::getSession();
    //     $value = $session->get('klient');
    //     $id = $session->get("id");
    //     $beskrivelse = $session->get("beskrivelse");
    //     $dato = $session->get("dato");
    //     $debet = $session->get("debet");
    //     $kredit = $session->get("kredit");
    //     $belop = $session->get("belop");
    //     $tekst = $session->get("tekst");
    //     // $db = $this->getDbo();
    //     // $query = $db->getQuery(true);
    //     // $query = 'insert into qo7sn_regn_bilagsarter set id=' . $id 
    //     // . ', beskrivelse='. $db->quote($beskrivelse) 
    //     // . ', dato=' . $db->quote($dato) 
    //     // . ', debet=' . $db->quote($debet) 
    //     // . ', kredit=' . $db->quote($kredit) 
    //     // . ', belop=' . $db->quote($belop) 
    //     // . ', tekst=' . $db->quote($tekst) . '  ;';

    //     // $db->setQuery((string) $query);
    //     // try {
    //     //     return $db->execute(); // Returns 
    //     // } catch (RuntimeException $e) {
    //     //     return []; // Handle database errors gracefully
    //     // }
    // }

    function kontoliste()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from #__regn_kto order by Ktonr;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
        return $message;
    }
    function bilagsarter()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_bilagsarter order by id;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
        return $message;
    }


    function regnskasar()
    {
        $database = $this->get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'SELECT regnskapsar FROM ' . $database . '#__regn_firma ;;';
        $db->setQuery((string) $query);
        $message = $db->loadObject();
        //   return json_encode($message1);
        return $message;
    }
    public function getListQuery1($h)
    {
        $database = $this->get_database();
        // Get the database object
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select all fields from your table
        // $query->select('*')
        //     ->from($db->quoteName('csv'));
        $query = 'select * from #__regn_hist where belop=' . $h . ' limit 10;';

        $db->setQuery((string) $query);
        $message1 = $db->loadObjectList();
        //  echo $message1[0]['Dato'];
        // if ($message1) {
        //     foreach ($message1 as $message) {
        //         echo $message->Dato. '<br>';}}
        // if ($message1)
        // $debet = $message1->debet;
        // else
        //     $debet = "ukjent";
        //echo $query.'<br>';

        return $message1;
    }
}
