<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class RegnModelAbc extends ListModel
{
    public function __construct($config = array())
    {
        parent::__construct($config);

        //     // Set the default sorting order and column
        //     $this->setState('list.ordering', 'id');
        //     $this->setState('list.direction', 'ASC');
    }
    function sistepost()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);

        // Select all fields from your table
        // $query->select('*')
        //     ->from($db->quoteName('csv'));
        $query = 'select * from #__regn_trans ORDER BY Ref DESC limit 1;';

        $db->setQuery((string) $query);
        $message1 = $db->loadObject();
        return json_encode($message1);
      //  return $message1;

    }

    function regnskapsar()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from #__regn_firma;';
        $db->setQuery((string) $query);
        $message = $db->loadObject();
        // return 'GGGGGGGGGGGGG';//$message->Ref;
        // echo 'GGGGGGGGGGGGG';//$message->Ref;
        // //      return json_encode($message);
       return $message;
    }
    function transer()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from #__regn_trans;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
       return $message;
    }

    function kontoliste()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from #__regn_kto order by Ktonr;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
       return $message;
    }
    function bilagsarter()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from #__regn_bilagsarter order by id;';
        $db->setQuery((string) $query);
        $message = $db->loadObjectlist();
       return $message;
    }


    function regnskasar()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'SELECT regnskapsar FROM #__regn_firma ;;';
        $db->setQuery((string) $query);
        $message = $db->loadObject();
        //   return json_encode($message1);
        return $message;
    }
    public function getListQuery1($h)
    {
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
