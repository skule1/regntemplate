<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class RegnModelsok extends ListModel
{
    public function __construct($config = array())
    {
        parent::__construct($config);

        //     // Set the default sorting order and column
        //     $this->setState('list.ordering', 'id');
        //     $this->setState('list.direction', 'ASC');
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


    public function bilagsarter()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select * from #__regn_bilagsarter;';
        $db->setQuery((string) $query);
        try {
            return  $db->loadObjectList();
        } catch (Exception $e) {
            $gg = 'Error s ' . $e->getMessage();
        }
    }
    public function ktoliste()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select * from #__regn_kto order by Ktonr;';
        $db->setQuery((string) $query);
        try {
            return  $db->loadObjectList();
        } catch (Exception $e) {
            $gg = 'Error s ' . $e->getMessage();
        }
    }


    public function periodeliste($mode)
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        if ($mode == '') {
            $query = 'select * from #__regn_perioder;';
            $db->setQuery((string) $query);
            try {
                return  $db->loadObjectList();
            } catch (Exception $e) {
                $gg = 'Error s ' . $e->getMessage();
            };
        } elseif (is_numeric($mode)) {
            $query = 'select Periodenavn from #__regn_perioder where nr=' . $mode . ';';
            $db->setQuery((string) $query);
            try {
                return  $db->loadResult();
            } catch (Exception $e) {
                $gg = 'Error s ' . $e->getMessage();
            };
        } else {
            $query = 'select nr from #__regn_perioder where Periodenavn="' . $mode . '";';
            $db->setQuery((string) $query);
            try {
                return  $db->loadResult();
            } catch (Exception $e) {
                $gg = 'Error s ' . $e->getMessage();
            };
        }
    }

    public function regnsasar()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select * from #__regn_regnskapsar;';
        $db->setQuery((string) $query);
        try {
            return  $db->loadObjectList();
        } catch (Exception $e) {
            $gg = 'Error s ' . $e->getMessage();
        }
    }

    public function firma()
    {
        $db = $this->getDbo();
        $query = $db->getQuery(true);
        $query = 'select * from #__regn_firma;';
        $db->setQuery((string) $query);
        try {
            return  $db->loadObject();
        } catch (Exception $e) {
            $gg = 'Error s ' . $e->getMessage();
        }
    }
}
