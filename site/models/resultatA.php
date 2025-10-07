<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;

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
         $session = Factory::getSession();
        $value = $session->get('klient');
        $db = Factory::getDbo();

        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_hist order by ref desc limit 1;';
        } else {
            $query = 'select *  from #__regn_hist order by ref desc limit 1;';
        }
        // $query = 'select *  from #__regn_hist order by ref desc limit 1;';
        $sql = 'select * from #__regn_hist order by ref desc limit 1;';
        $db->setQuery((string) $sql);
        $messages = $db->loadObject();
        if ($messages)
            $histref = $messages->ref;
        else
            $histref = 0;

        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_hist order by bilag desc limit 1;';
        } else {
            $query = 'select *  from #__regn_hist order by bilag desc limit 1;';
        }
    
        $db->setQuery((string) $sql);
        $messages = $db->loadObject();
        if ($messages)
            $histbuntnr = $messages->Buntnr;
        else
            $histbuntnr = 0;

        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_hist order by bilag desc limit 1;';
        } else {
            $query = 'select *  from #__regn_hist order by bilag desc limit 1;';
        }
        // $query = 'select *  from #__regn_hist order by bilag desc limit 1;'; 
        $query = 'select * from #__regn_hist order by Bilag desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $histbilag = $messages->Bilag;
        else
            $histbilag = 0;


        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_trans order by Ref desc limit 1;';
        } else {
            $query = 'select *  from #__regn_trans order by Ref desc limit 1;';
         $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $transref = $messages->Ref;
        else
            $transref = 0;


        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_trans order by bilag desc limit 1;';
        } else {
            $query = 'select *  from #__regn_trans order by bilag desc limit 1;';
        $db->setQuery((string) $query);
        $messages = $db->loadObject();
        if ($messages)
            $transbilag = $messages->bilag;
        else
            $transbilag = 0;


        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_trans order by Buntnr desc limit 1;';
        } else {
            $query = 'select *  from #__regn_trans order by Buntnr desc limit 1;';
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
        $session = Factory::getSession();
        $value = $session->get('klient');
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_resmal where BR="' . $mode . '" order by nr;';
        } else {
            $query = 'select *  from #__regn_resmal where BR="' . $mode . '" order by nr;';
        }
        // $query = 'select *  from #__regn_resmal where BR="' . $mode . '" order by nr;';
        $query = 'select *  from #__regn_resmal where BR="' . $mode . '" order by nr;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function saldoliste($mode, $ar, $periode)
    {
        
        //     $per = perioder($periode);
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        // $query = 'select *  from #__regn_saldo  where resbal="' . $mode . '"  and ar="' . $ar
        //     . '"  and periode="' . $periode . '"  order by raplinje;';


        $query = ' SELECT * FROM qo7sn_regn_saldo WHERE ar="' . $ar
            . '" AND periode="' . $periode . '" AND resbal="R" AND  hittil<>0 ORDER BY raplinje,kto;';




        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }


    public function firma()
    {
        $session = Factory::getSession();
        $value = $session->get('klient');
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_firma;';
        } else {
            $query = 'select *  from #__regn_firma;';
        }
        // $query = 'select *  from #__regn_firma where id=1;';
        $query = 'select *  from #__regn_firma;';
        $db->setQuery((string) $query);
        $message = $db->loadObject();
        return $message;
    }


    public function historikk($ar)
    {
        $session = Factory::getSession();
        $value = $session->get('klient');
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_hist where YEAR(Dato)=' . $ar;
        } else {
            $query = 'select *  from #__regn_hist where YEAR(Dato)=' . $ar;
        }
        // $query = 'select *  from #__regn_hist where YEAR(Dato)=' . $ar;  
        $query = ' SELECT * FROM qo7sn_regn_hist WHERE YEAR(Dato)=' . $ar;
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function regnskapsar()
    {
        $session = Factory::getSession();
        $value = $session->get('klient');
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($value > '') {
            $query = 'select *  from ' . $value . '.#__regn_regnskapsar order by regnskapsar desc;';
        } else {
            $query = 'select *  from #__regn_regnskapsar order by regnskapsar desc;';
        }
        $query = ' SELECT * FROM qo7sn_regn_regnskapsar order by regnskapsar desc';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }

    public function perioder($mode)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($mode == '0')
            $query = ' SELECT * FROM qo7sn_regn_perioder order by nr ';
        else if ($mode == '1')
            $query = ' SELECT * FROM qo7sn_regn_perioder order by Periodenavn ';
        else
            $query = ' SELECT * FROM qo7sn_regn_perioder where Periodenavn="' . $mode . '";';

        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        return $messages;
    }




    public function hentkto()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select *  from #__regn_kto order by Ktonr;';
        $db->setQuery((string) $query);
        $messages = $db->loadObjectlist();
        // return 'GGGGGGGGGGGGG';//$message->Ref;
        // echo 'GGGGGGGGGGGGG';//$message->Ref;
        // //      return json_encode($message);
        return $messages;
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
