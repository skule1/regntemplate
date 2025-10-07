<?php
defined('_JEXEC') or die;

use Dom\Element;
use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

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

function perioder1($mode)
{

    $database = get_database();

    // $db = $this->getDbo();
    $db = JFactory::getDBO();
    $query = $db->getQuery(true);

    if ($database > '') {
        if ($mode == '0')
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder order by nr ';
        else if ($mode == '1')
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder order by Periodenavn ';
        else
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder where Periodenavn="' . $mode . '";';
    } else {
        if ($mode == '0')
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder order by nr ';
        else if ($mode == '1')
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder order by Periodenavn ';
        else
            $query = ' SELECT * FROM ' . $database . 'qo7sn_regn_perioder where Periodenavn="' . $mode . '";';
    }

    $db->setQuery((string) $query);
    $messages = $db->loadObject();
    return $messages;
}



class RegnModelResultat extends ListModel
{
    public function __construct($config = array())
    {
        parent::__construct($config);

        //     // Set the default sorting order and column
        //     $this->setState('list.ordering', 'id');
        //     $this->setState('list.direction', 'ASC');
    }



    function startvariable()
    {

        $database = get_database();

        $db = Factory::getDbo();
        $query = 'select *  from ' . $database . '#__regn_hist order by ref desc limit 1;';
        $query = $db->getQuery(true);
        $db->setQuery((string) $sql);
        $messages = $db->loadObject();
        if ($messages)
            $histref = $messages->ref;
        else
            $histref = 0;

        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_hist order by Buntnr desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $histbuntnr = $messages->Buntnr;
        else
            $histbuntnr = 0;

        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_hist order by bilag desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $histbilag = $messages->Bilag;
        else
            $histbilag = 0;


        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_trans order by Ref desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $transref = $messages->Ref;
        else
            $transref = 0;


        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_trans order by bilag desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $transbilag = $messages->bilag;
        else
            $transbilag = 0;

        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_trans order by Buntnr desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $transbuntnr = $messages->Buntnr;
        else
            $transbuntnr = 0;

        if ($transbuntnr > $histbuntnr)
            $buntnr = $transbuntnr;
        else
            $buntnr = $histbuntnr;

        if ($transbilag > $histbilag)
            $bilag = $transbilag;
        else
            $bilag = $histbilag;

        if ($histref > $transref)
            $ref = $histref;
        else
            $ref = $transref;

        // Neste sett med varable:
        $obj = [];
        //    $obj = new stdClass();
        $obj['buntnr'] = $buntnr + 1;
        $obj['bilagnr'] = $bilag + 1;
        $obj['ref'] = $ref + 1;

        return $obj;

        //      return json_encode($obj);
    }
    public function hentmal($mode)
    {
        $database = get_database();
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_resmal where BR="' . $mode . '" order by nr;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function sumkto($kto, $per, $ar, $mode)
    {
        $database = get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *   from ' . $database . 'qo7sn_regn_saldo where  kto=' . $kto . ' and periode=' . $per . ' and  ar=' . $ar . '  LIMIT 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadAssoc();
        return $messages;
    }

    public function saldoliste($mode, $ar, $periode)
    {

        $database = get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_saldo WHERE ar="' . $ar
            . '"  and periode="' . $periode . '"    and resbal="' . $mode . '" order by raplinje;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }


    public function firma()
    {
        $database = get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_firma;';
        $db->setQuery((string) $query);
        $message = $db->loadObject();
        return $message;
    }

    public function historikk($ar)
    {
        $database = get_database();

        //   $db = $this->getDbo();
        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_hist WHERE YEAR(Dato)=' . $ar;
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function regnskapsar()
    {
        $database = get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . 'qo7sn_regn_regnskapsar order by regnskapsar desc';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }
    public function perioder($mode)
    {
        $database = get_database();

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

    public function hentkto()
    {

        $database = get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_kto order by Ktonr;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function getListQuery1($h)
    {
        $database = get_database();

        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from ' . $database . '#__regn_hist where belop=' . $h . ' limit 10;';
        $db->setQuery((string) $query);
        $message1 = $db->loadObjectList();
        return $message1;
    }
}
