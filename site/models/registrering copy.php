<?php

$r=5;
 $t=3;
// defined('_JEXEC') or die;

// use Joomla\CMS\MVC\Model\ListModel;
//   use Joomla\CMS\Factory;
// use Joomla\CMS\Response\JModelLegacy;

// global $model;
//$model = $this->getModel('registrering');
//$model = JModelLegacy::getInstance('registrering', 'RegnModelRegistrering');



// function get_database()
// {
//     global $model;
//     $user = JFactory::getUser();
//     $username = $user->username;
//     $database = $user->authProvider;
//     if ($database) {
//         if (($database[0] == "X") || ($database[0] == "$"))
//             $database = substr($database, 1);
//         $database = $database . '.';
//     }
//     oppdater_user($user);
//     return $database;
// }


// function oppdater_user($user)
// {
//     $db = Factory::getDbo();
//     $sql = $db->getQuery(true);
//      $sql = 'update qo7sn_users qo7sn_users set authProvider="' . $user->authProvider . '" where username="' . $user->username . '";';
//     $db->setQuery((string) $sql);
//     try {
//         $ret = $db->execute(true);
//     } catch (Exception $e) {
//         echo 'Error fetching row: ' . $e->getMessage() . '<br>';
//     }
// }
// class RegnModelRegistrering extends ListModel
// {

    //     /*
    // loadResult() : single value from one resourcebundle_get_error_code
    // loadRow() : Single record use index id   (returns an indexed array from a single record in the table:)
    // loadAssoc() : Single record  use fieldname      (returns an associated array from a single record in the table:)
    // loadObject() : php object (loadObject returns a PHP object from a single record in the table:)
    // loadColumn() : all records from a singel coloumn (returns an indexed array from a single column in the table:)
    // loadColumn($index)  : all records from multiple records (returns an indexed array from a single column in the table:)
    // loadRowList() : (returns an indexed array of indexed arrays from the table records returned by the query:)
    // loadAssocList()  :  ( returns an indexed array of associated arrays from the table records returned by the query:)
    // loadAssocList($key) :  (returns an associated array - indexed on 'key' - of associated arrays from the table records returned by the query:)
    // loadAssocList($key, $column) :  ( returns an associative array, indexed on 'key', of values from the column named 'column' returned by the query:)
    // loadObjectList()  :  (returns an indexed array of PHP objects from the table records returned by the query:)
    // loadObjectList($key) :  (returns an associated array - indexed on 'key' - of objects from the table records returned by the query:)
    // https://docs.joomla.org/Special:MyLanguage/Selecting_data_using_JDatabase 
    // */


        // function oppdater_saldo($ar)
        // {

            // $user = JFactory::getUser();
            // $username = $user->username;
            //  $database = $user->authProvider;

            //finner buntnummer rukt fra tidliger
            // $db = Factory::getDbo();
            //  $sql = $db->getQuery(true);
            // $sql = 'seect buntnr from qo7sn_regn_hist WHERE bilagsart=0 AND Dato="' . $ar . '01-01";';
            // $db->setQuery((string) $sql);
            // try {
            //     $buntnr $db->loadAssoc();
            // } catch (Exception $e) {
            //     echo 'Error buntnrfra historikk: ' . $e->getMessage() . '<br>';
            // }


    //         // sletter gamle saldoposter i i historikken for regnskapsåe

    //         $db = Factory::getDbo();
    //         $sql = $db->getQuery(true);
    //         $sql = 'delete FROM ' . $database . 'qo7sn_regn_hist WHERE bilagsart=0 AND Dato="' . $ar . '01-01";';
    //         $db->setQuery((string) $sql);
    //         try {
    //             $res = $db->execue();
    //         } catch (Exception $e) {
    //             echo 'Error delete balansesaldo hist: ' . $e->getMessage() . '<br>';
    //         }

    //         //Finner neste ref, bilagsnr og buntnr fra trans eller hist

    //         $db = Factory::getDbo();
    //         $sql = $db->getQuery(true);
    //         $sql = 'select Ref from ' . $database . 'qo7sn_regn_trans WHERE buntnr=0 and bilagsart=0 AND Dato="' . $ar . '-01-01" order by Ref desc limt 1;';
    //         $db->setQuery((string) $sql);
    //         try {
    //             $ref = $db->loadAssoc();
    //         } catch (Exception $e) {
    //             echo 'Error list transref: ' . $e->getMessage() . '<br>';
    //         }

    //         //Hvis ike funnet på trans (tom) hentes ref fra hustirujjeb

    //         if ($ref) {
    //             $db = Factory::getDbo();
    //             $sql = $db->getQuery(true);
    //             $sql = 'select * from ' . $database . 'qo7sn_regn_hist order by ref desc limit 1;';
    //             $db->setQuery((string) $sql);
    //             try {
    //                 $ref = $db->loadAssoc();
    //             } catch (Exception $e) {
    //                 echo 'Error list transref: ' . $e->getMessage() . '<br>';
    //             }
    //         }

    //         $ref++;

    //              // sletter gamle saldoposter i i   $db = Factory::getDbo();
    //             $sql = $db->getQuery(true);
    //               $sql = 'select * from ' . $database . 'qo7sn_regn_hist order by ref desc limit 1;';
    //             $db->setQuery((string) $sql);
    //             try {
    //                 $ref = $db->loadAssoc();
    //             } catch (Exception $e) {
    //                 echo 'Error list transref: ' . $e->getMessage() . '<br>';
    //             }
            //  }



    //         foreach ($transer as $trans) {


    //              // sletter gamle saldoposter i i   $db = Factory::getDbo();
    //             $sql = $db->getQuery(true);
    //             $sql = 'insert into ' . $database . 'qo7sn_regn_hist (Ref,buntnr,Dato,debet,kredit,belop,Tekst) value('
    //             .'('.$ref.','.$buntnr.',"'.$ar.'-01-01",'.$trans["debet"].','.$trans["kredit"].','.$trans["belop"].','.$trans["Tekst"].')';
    //             $db->setQuery((string) $sql);

    //             try {
    //                 $ref = $db->execute(true);
    //             } catch (Exception $e) {
    //                 echo 'Error opdater hist med saldoposter: ' . $e->getMessage() . '<br>';
    // }


    // //sletter balansesadoposter i trans

    //         $db = Factory::getDbo();
    //         $sql = $db->getQuery(true);
    //          $sql = 'delete FROM ' . $database . 'qo7sn_regn_trans WHERE buntnr=0 and bilagsart=0 AND Dato="' . $ar . '01-01";';
    //         $db->setQuery((string) $sql);
    //         try {
    //             $res = $db->execue();
    //         } catch (Exception $e) {
    //             echo 'Error delete balansesaldo hist: ' . $e->getMessage() . '<br>';
    //         }


    }



    function hent_database($user)
    {
        $user = JFactory::getUser();
         $username = $user->username;
        $database = $user->authProvider;
        if (($database[0] == "X") || ($database[0] == "$"))
            $database = substr($database, 1);

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select authProvider from qo7sn_users where Name="' . $user . '";';
        $db->setQuery((string) $sql);
        try {
            return $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }
    }


    //  function firma()
    // {
    //     $database = get_database();
    //      $db = $this->getDbo();
    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_firma;';
    //     $db->setQuery((string) $query);
    //     try {
    //         return $db->loadObject(); // Returns 
    //     } catch (RuntimeException $e) {
    //         return []; // Handle database errors gracefully
    //     }
    // }




    // function startvariable($ar)
    // {
    //     $database = get_database();
    //     $db = Factory::getDbo();
    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_hist order by ref desc limit 1;';
    //     $db->setQuery((string) $query);
    //     $messages = $db->loadObject();
    //     if ($messages)
    //         $histref = $messages->ref;
    //     else
    //         $histref = 0;

    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_hist order by Buntnr desc limit 1;';
    //     $db->setQuery((string) $query);
    //     //    $sql = 'select * from qo7sn_regn_hist order by Buntnr desc limit 1;';
    //     $messages = $db->loadObject();
    //     if ($messages)
    //         $histbuntnr = $messages->Buntnr;
    //     else
    //         $histbuntnr = 0;
    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_hist where YEAR(Dato)=' . $ar . ' order by Bilag desc limit 1;';
    //     $db->setQuery((string) $query);
    //     $messages = $db->loadObject();
    //     if ($messages)
    //         $histbilag = $messages->Bilag;
    //     else
    //         $histbilag = 0;

    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_trans order by Ref desc limit 1;';
    //     $db->setQuery((string) $query);
    //     $messages = $db->loadObject();
    //     if ($messages)
    //         $transref = $messages->Ref;
    //     else
    //         $transref = 0;

    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_trans order by Ref desc limit 1;';
    //     $db->setQuery((string) $query);
    //     $messages = $db->loadObject();
    //     if ($messages)
    //         $transbilag = $messages->bilag;
    //     else
    //         $transbilag = 0;

    //     $query = $db->getQuery(true);
    //     $query = 'select * from ' . $database . 'qo7sn_regn_trans order by Buntnr desc limit 1;';
    //     $db->setQuery((string) $query);
    //     $messages = $db->loadObject();
    //     if ($messages)
    //         $transbuntnr = $messages->Buntnr;
    //     else
    //         $transbuntnr = 0;

    //     if ($transbuntnr > $histbuntnr)
    //         $buntnr = $transbuntnr;
    //     else
    //         $buntnr = $histbuntnr;

    //     if ($transbilag > $histbilag)
    //         $bilag = $transbilag;
    //     else
    //         $bilag = $histbilag;

    //     if ($histref > $transref)
    //         $ref = $histref;
    //     else
    //         $ref = $transref;

    //     // Neste sett med varable:
    //     $obj = [];
    //     //    $obj = new stdClass();
    //     $obj['buntnr'] = $buntnr + 1;
    //     $obj['bilagnr'] = $bilag + 1;
    //     $obj['ref'] = $ref + 1;

    //     return $obj;

    //     //      return json_encode($obj);

    // }




    //     public function __construct($config = array())
    //     {
    //            parent::__construct($config);

    //         //     // Set the default sorting order and column
    //         //     $this->setState('list.ordering', 'id');
    //         //     $this->setState('list.direction', 'ASC');
    //     }
    //     function sistepost()
    //     {

    //           $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $query = 'select * from ' . $database . 'qo7sn_regn_trans order by Ref desc limit 1;';
    //         $db->setQuery((string) $query);
    //         $message1 = $db->loadObject();
    //         return json_encode($message1);
    //         // return $message1;
    //     }

    //     // function regnskapsar()
    //     // {
    //     //     $db = $this->getDbo();
    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_firma;';
    //     //     $db->setQuery((string) $query);
    //     //     $message = $db->loadObject();
    //     //     // return 'GGGGGGGGGGGGG';//$message->Ref;
    //     //     // echo 'GGGGGGGGGGGGG';//$message->Ref;
    //     //     // //      return json_encode($message);
    //     //    return $message;
    //     // }
    //     // function oppstartvar()
    //     // {
    //     //     $obj = [];

    //     //     $db = $this->getDbo();

    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_trans order by bilag desc limit 1;';
    //     //     $db->setQuery((string) $query);
    //     //     $res = $db->loadObject();
    //     //     if ($res)
    //     //         $transbilag = $db->loadObject()->bilag;
    //     //     else
    //     //         $transbilag = 0;

    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_hist order by Bilag desc limit 1;';
    //     //     $db->setQuery((string) $query);
    //     //     $res = $db->loadObject();
    //     //     if ($res)
    //     //         $histbilag = $db->loadObject()->Bilag;
    //     //     else
    //     //         $histbilag = 0;

    //     //     if ($transbilag > $histbilag)
    //     //         $sistebilag = $transbilag;
    //     //     else
    //     //         $sistebilag = $transbilag;


    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_trans order by Ref desc limit 1;';  //Buntnr
    //     //     $db->setQuery((string) $query);
    //     //     $res = $db->loadObject()->Ref;
    //     //     if ($res)
    //     //         $transref = $db->loadObject()->Ref;
    //     //     else
    //     //         $transref = 0;

    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_hist order by ref desc limit 1;';//Buntnr
    //     //     $db->setQuery((string) $query);
    //     //     $res = $db->loadObject();
    //     //     if ($res)
    //     //         $histref = $db->loadObject()->ref;
    //     //     else
    //     //         $histref = 0;

    //     //     if ($transref > $histref)
    //     //         $sisteref = $transref;
    //     //     else
    //     //         $sisteref = $histref;

    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_trans order by Buntnr desc limit 1;';
    //     //     $db->setQuery((string) $query);
    //     //     $res = $db->loadObject();
    //     //     if ($res)
    //     //         $transbuntnr = $db->loadObject()->Buntnr;
    //     //     else
    //     //         $transbuntnr = 0;

    //     //     $query = $db->getQuery(true);
    //     //     $query = 'select *  from qo7sn_regn_hist order by Buntnr desc limit 1;';
    //     //     $db->setQuery((string) $query);
    //     //     $res = $db->loadObject();
    //     //     if ($res)
    //     //         $histbuntnr = $db->loadObject()->Buntnr;
    //     //     else
    //     //         $histbuntnr = 0;

    //     //     if ($transbuntnr > $histbuntnr)
    //     //         $sistebunt = $transbuntnr;
    //     //     else
    //     //         $sistebunt = $transbuntnr;

    //     //     $obj['bilag'] = $sistebilag;
    //     //     $obj['bunt'] = $sistebunt;
    //     //     $obj['ref'] = $sisteref;

    //     //     return $obj;
    //     //     //    return json_encode($obj);
    //     // }




    //     function transer($regnskapsar)
    //     {
    //         $database = get_database();
    //          $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $query = 'select * from ' . $database . 'qo7sn_regn_trans order by Ref;';
    //         $db->setQuery((string) $query);
    //         try {
    //             return $db->loadObjectList(); // Returns 
    //         } catch (RuntimeException $e) {
    //             return []; // Handle database errors gracefully
    //         }
    //     }

    //     function regnskapsarliste()
    //     {
    //         $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $query = 'select * from ' . $database . 'qo7sn_regn_regnskapsar order by regnskapsar desc;';
    //         $db->setQuery((string) $query);
    //         try {
    //             $retur = $db->loadAssocList(); // Returns 
    //             return $retur;
    //         } catch (RuntimeException $e) {
    //             return []; // Handle database errors gracefully
    //         }
    //     }

    //     function kontoer()
    //     {
    //         $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $query = 'select * from ' . $database . 'qo7sn_regn_kto order by Ktonr;';
    //         $db->setQuery((string) $query);
    //         try {
    //             return $db->loadAssocList(); // Returns 
    //         } catch (RuntimeException $e) {
    //             return []; // Handle database errors gracefully
    //         }
    //     }


    //     function oppdater_regnskapsar($ar)
    //     {
    //         $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $query = 'select * from ' . $database . 'qo7sn_regn_firma set regnskapsar="' . $ar . '";';
    //         $db->setQuery((string) $query);

    //         //       $query = 'update qo7sn_regn_firma set regnskapsar="' . $ar . '";';

    //         // Return the result
    //         try {
    //             return $db->execute(); // Returns 
    //         } catch (RuntimeException $e) {
    //             return []; // Handle database errors gracefully
    //         }
    //     }

    //     function regnskapsar()
    //     {
    //         $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         if ($database > '')
    //             $db->setQuery((string) $query);
    //         try {
    //             return $db->loadObject(); // Returns 
    //         } catch (RuntimeException $e) {
    //             return []; // Handle database errors gracefully
    //         }
    //     }
    //     public function getListQuery1($h)
    //     {
    //         $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $query = 'select * from ' . $database . 'qo7sn_regn_hist where belop=' . $h . ' limit 10;';
    //         $db->setQuery((string) $query);
    //         $message1 = $db->loadObjectList();
    //         return $message1;
    //     }

    //     function f_ktoinfo()
    //     {
    //         $database = get_database();
    //         $db = $this->getDbo();
    //         $query = $db->getQuery(true);
    //         $kto = $_POST['kto'];
    //         $dato = $_POST['dato'];
    //         if (!$dato == '') {
    //             $i = strpos($dato, '-',);
    //             $j = strpos($dato, '-', $i + 1);
    //             $periode = substr($dato, $i + 1, $j - $i - 1);
    //             //	echo 'periode1: '.$periode.'<br>';
    //             //echo 'feil';
    //             //	else

    //             //	echo 'kto: '.$kto.'  dato: '.$dato.'<br>';
    //             $i = strpos($dato, "-");
    //             $j = strpos($dato, "-", $i + 1);
    //             //		echo '$i: '.$i.' $j: '.$j.'<br>';
    //             if ($i == 4) {
    //                 $periode = substr($dato, $i + 1, 2);
    //                 $arstall = substr($dato, 0, 4);
    //             } else {
    //                 $periode = substr($dato, $i + 1, $j - $i - 1);
    //                 $arstall = substr($dato, $j + 1, 4);
    //             };
    //             //echo 'periode2: '.$periode.'<br>';

    //             $query = 'select * from ' . $database . 'qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ' AND kto=' . $kto . ';';
    //             //$sql = 'SELECT * FROM qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ' AND kto=' . $kto . ';';
    //             $result = $db->loadAssocList();

    //             if ($result->num_rows != 0) {
    //                 //	echo 'dato: '.$dato.'  kto: '.$kto.' Årstall: '.$arstall.' Periode: '.$periode.' $i: '.$i.' $j: '.$j.'<br>';
    //                 $sql = 'SELECT SUM(a.belop) as hittil,SUM(a.budsjett) as sumbudsj,c.Ktonr,b.budsjett,c.Navn,b.belop,a.resbal,a.periode, proc_periode(a.periode) ' .
    //                     'FROM ' . $hash . 'regn_saldo AS a INNER JOIN ' . $hash . 'regn_saldo AS b,' . $hash . 'regn_kto AS c ' .
    //                     ' WHERE c.Ktonr=' . $kto . ' and a.ar=' . $arstall . ' AND a.kto=' . $kto . ' AND a.periode<=' . $periode . ' and b.ar=' . $arstall . ' AND b.kto=' . $kto . ' AND b.periode=' . $periode . ';';
    //                 $result = $db->loadAssocList();
    //             } else {
    //                 $query = 'select * from ' . $value . 'qo7sn_regn_kto AS info  where info.Ktonr=' . $kto . ';';
    //                 $result = $db->loadAssoc();
    //             }
    //         } else {
    //             $query = 'select * from ' . $value . 'qo7sn_regn_kto AS info  where info.Ktonr=' . $kto . ';';
    //             $result = $db->loadAssoc();
    //         }
    //         $row = $result->fetch_array(MYSQLI_ASSOC);
    //         echo json_encode($row);
    //         //$result->free_result();
    //     }
// }
