<?php
defined('_JEXEC') or die;

use Joomla\CMS\MVC\Model\ListModel;

class RegnModelKonto extends ListModel
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



    public function kontoer()
    {

        $db = JFactory::getDBO();
        $query = $db->getQuery(true);
        //       $query = 'select * from qo7sn_regn_kto where Ktonr=' . $_GET["ktonr"] . ' order by Ktonr';
        $query = 'select * from qo7sn_regn_kto  order by Ktonr';
        $db->setQuery((string) $query);
        try {
            $res = $db->loadObjectList();
        } catch (Exception $e) {
            echo 'Error insert trans i historikk: ' . $e->getMessage() . '<br>';
        }

    }


    public function saldoliste()
    {
        $db = JFactory::getDBO();

        $query = $db->getQuery(true);
        $query = 'select ar,periode,kto,belop,navn from qo7sn_regn_saldo a '
            . ' INNER join qo7sn_regn_regnskapsar b '
            . ' INNER JOIN qo7sn_regn_kto c  '
            . ' INNER JOIN  qo7sn_regn_perioder d '
            . ' ON a.periode=d.nr and  a.ar=b.regnskapsar AND   a.kto =c.Ktonr '
            . ' ORDER BY b.regnskapsar,c.Ktonr,d.nr ;';

        $db->setQuery((string) $query);
        try {
            return $db->loadObjectList();
        } catch (Exception $e) {
            echo 'Error generer saldoliste ' . $e->getMessage() . '<br>';
        }




    }

    public function arliste()
    {
        $db = JFactory::getDBO();

        $query = $db->getQuery(true);
        $query = 'select * from qo7sn_regn_saldo WHERE ar=' . $ar . ' AND kto=' . $kto . ' ORDER BY periode;';
        $message = $db->loadObjectlist();
        try {
            return $db->loadObjectList();
        } catch (Exception $e) {
            echo 'Error insert trans i historikk: ' . $e->getMessage() . '<br>';
        }

    }




}
