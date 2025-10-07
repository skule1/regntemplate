<?php



defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;
use Joomla\CMS\Response\JModelLegacy;
// global $model;
// $model = $this->getModel('registrering');
//$model = JModelLegacy::getInstance('registrering', 'RegnModelRegistrering');

// function get_database()
// {
//     $user = JFactory::getUser();
//     $username = $user->username;
//     $database = $user->authProvider;
//     if (($database[0] == "X") || ($database[0] == "$"))
//         $database = substr($database, 1);

//     return $database;
// }

function get_database()
{
    global $model;
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





class RegnControllerRegistrering extends BaseController
{
    function get_database()
    {
        //   global $model;
        $model = $this->getModel('registrering');
        $user = JFactory::getUser();
        $username = $user->username;
        $database = $user->authProvider;
        if ($database) {
            if (($database[0] == "X") || ($database[0] == "$"))
                $database = substr($database, 1);
            $database = $database . '.';
        }
        $model->oppdater_user($user);
        return $database;
    }
    function hentart()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $art = $input->get('art', 0);
        $sql = $db->getQuery(true);
        if ($database > '')
            $sql = 'select * from 	' . $database . '#__regn_bilagsarter where id=' . $art;
        else
            $sql = 'select * from 	' . $database . '#__regn_bilagsarter where id=' . $art;
        $db->setQuery((string) $sql);
        try {
            $result = $db->loadObject();
            echo json_encode($result);
            // echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();
    }
    function slettpost()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $nr = $input->get('nr', 0);
        $sql = $db->getQuery(true);
        if ($database > '')
            $sql = 'delete from ' . $database . '#__regn_trans where Ref=' . $nr;
        else
            $sql = 'delete from ' . $database . '#__regn_trans where Ref=' . $nr;
        echo $sql;
        $db->setQuery((string) $sql);
        try {
            $result = $db->Execute();
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();
    }

    function list_kto()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $kto = $input->get('kto', 0);
        $sql = $db->getQuery(true);
        if ($database > '')
            $sql = 'select * from 	' . $database . '#__regn_kto order by Ktonr;';
        else
            $sql = 'select * ' . $database . 'from #__regn_kto order by Ktonr;';

        $db->setQuery((string) $sql);
        $res = $db->loadObjectlist();
        echo json_encode($res);
        JFactory::getApplication()->close();
        // try {
        //     return $db->loadObjectlist(); // Returns 
        // } catch (RuntimeException $e) {
        //     return []; // Handle database errors gracefully
        // }
    }

    function finn_kto()
    {
        // let nokpenger = new Intl.NumberFormat('no-NB', {
        //     style: 'currency',
        //     currency: 'NOK',
        // });
        $database = get_database();
        $res = [];

        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $kto = $input->get('kto', 0);
        $ar = $input->get('ar', 0);
        $per = $input->get('per', 0);

        // if ($kto==' '){
        //     $sql = $db->getQuery(true);
        //     $sql='select* from qo7sn_regn_trans order by ref desc limit  1;';
        //     $db->setQuery((string) $sql);
        //     try {
        //         $result = $db->loadObjectList();
        //         return json_encode($result);
        //         JFactory::getApplication()->close();
        //     } catch (Exception $e) {
        //         echo 'Error inserting row: ' . $e->getMessage();
        //     }
        // }

        if ($kto == 'undefined')
            $kto = '';
        $sql = $db->getQuery(true);
        //     $sql = 'SELECT * FROM  qo7sn_regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;;';
        $intVar = (int) $kto;
        if (($intVar != 0) || ($kto == '0') || ($kto == '')) {  //integer-søk

            $sql = 'SELECT count(*) as ct FROM  ' . $database . 'qo7sn_regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;';
            //     $sql = 'SELECT * FROM  qo7sn_regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;;';
            //     $sql = 'SELECT * FROM  qo7sn_regn_kto k INNER JOIN qo7sn_regn_saldo s ON k.Ktonr=s.kto WHERE k.Ktonr LIKE "' . $kto . '%" ORDER BY k.Ktonr;';
            $db->setQuery((string) $sql);
            $res1 = $db->loadObject();
            if ($res1->ct > 1) {
                $sql = 'select * from ' . $database . 'qo7sn_regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;';
                $db->setQuery((string) $sql);
                try {
                    $result = $db->loadObjectList();
                    echo json_encode($result);
                    //   JFactory::getApplication()->close();
                } catch (Exception $e) {
                    echo 'Error inserting row: ' . $e->getMessage();
                }
                //   JFactory::getApplication()->close();
            } else {
                $sql = $db->getQuery(true);
                $a = ($ar);
                if (($ar == 'NaN') || ($per == 'NaN') || ($ar == '') || ($per == '')) {
                    $sql = 'select * from   ' . $database . 'qo7sn_regn_kto where Ktonr="' . $kto . '";';
                    $db->setQuery((string) $sql);

                    try {
                        $res = $db->loadObject();
                        echo json_encode($res);
                        //          JFactory::getApplication()->close();
                    } catch (Exception $e) {
                        echo 'Error upate row: ' . $e->getMessage();
                    }
                }
                //       $sql = 'SELECT * FROM  qo7sn_regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;';
                else {
                    $sql = 'SELECT count(*) as cnt FROM     ' . $database . 'qo7sn_regn_kto k INNER JOIN qo7sn_regn_saldo s ON k.Ktonr=s.kto WHERE Ktonr LIKE "' . $kto
                        . '" and s.ar=' . $ar . ' and periode=' . $per . ';';
                    // $sql = ' SELECT SUM(budsjett) as r  FROM qo7sn_regn_saldo WHERE kto=' . $kto . ' AND ar=' . $ar . ' AND periode<=' . $per . ';';
                    $db->setQuery((string) $sql);
                    // $res = $db->loadObject();
                    // $sql = $db->getQuery(true);
                    // $sql = ' update  qo7sn_regn_saldo set budsjett_hittil=' . $res->r . ' WHERE kto=' . $kto . ' AND ar=' . $ar . ' AND periode=' . $per . ';';

                    //      $db->setQuery((string) $sql);

                    try {
                        $res = $db->loadObject();
                        //    echo json_encode($res);
                        //          JFactory::getApplication()->close();
                    } catch (Exception $e) {
                        echo 'Error upate row: ' . $e->getMessage();
                    }
                    ;

                    if ($res->cnt == 1)
                        $sql = 'SELECT * FROM   ' . $database . 'qo7sn_regn_kto k INNER JOIN qo7sn_regn_saldo s ON k.Ktonr=s.kto WHERE Ktonr LIKE "' . $kto
                            . '" and s.ar=' . $ar . ' and periode=' . $per . ';';
                    else
                        $sql = 'select * from ' . $database . 'qo7sn_regn_kto where Ktonr="' . $kto . '";';

                    $db->setQuery((string) $sql);

                    try {
                        $res = $db->loadObject();
                        echo json_encode($res);
                        //          JFactory::getApplication()->close();
                    } catch (Exception $e) {
                        echo 'Error upate row: ' . $e->getMessage();
                    }
                }


                //   $sql = 'select * from #__regn_kto where Ktonr=' . $kto . ';';
                //     $sql = 'SELECT * FROM  qo7sn_regn_kto where Ktonr LIKE "' . $kto . '" ORDER BY Ktonr;';
                // if (($ar == 'NaN') ||  ($per == 'NaN'))
                //     $sql = 'select * from qo7sn_regn_kto where Ktonr="' . $kto . '";';
                // else
                //     $sql = 'SELECT * FROM  qo7sn_regn_kto k INNER JOIN qo7sn_regn_saldo s ON k.Ktonr=s.kto WHERE Ktonr LIKE "' . $kto
                //         . '" and s.ar=' . $ar . ' and periode=' . $per . ';';
                // $db->setQuery((string) $sql);
                // $res = $db->loadObject();
                // if (!$res) {
                //     $sql = 'select * from #__regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;';
                //     $db->setQuery((string) $sql);
                //     $res = $db->loadObject();
                // }
            }
        } else { // bokstavsøk
            $sql = 'SELECT count(*) as ct FROM  ' . $database . 'qo7sn_regn_kto where Navn LIKE "' . $kto . '%" ORDER BY Ktonr;';
            $db->setQuery((string) $sql);
            $res1 = $db->loadObject();
            if ($res1->ct > 1) {
                $sql = 'select * from ' . $database . 'qo7sn_regn_kto where Navn LIKE "%' . $kto . '%" ORDER BY Ktonr;';
                $db->setQuery((string) $sql);
                //     $res = $db->loadObjectList();
                try {
                    $result = $db->loadObjectList();
                    echo json_encode($result);
                    JFactory::getApplication()->close();
                    // echo 'Row inserted successfully!';
                } catch (Exception $e) {
                    echo 'Error inserting row: ' . $e->getMessage();
                }
                JFactory::getApplication()->close();
            } else {
                if (($ar == 'NaN') || ($per == 'NaN'))
                    $sql = 'select * from   ' . $database . 'qo7sn_regn_kto where Ktonr="' . $kto . '";';
                else
                    //   $sql = 'select * from #__regn_kto where Ktonr=' . $kto . ';';
                    //     $sql = 'SELECT * FROM  qo7sn_regn_kto where Ktonr LIKE "' . $kto . '" ORDER BY Ktonr;';
                    $sql = 'SELECT * FROM  ' . $database . 'qo7sn_regn_kto k INNER JOIN ' . $database . 'qo7sn_regn_saldo s ON k.Ktonr=s.kto WHERE Ktonr LIKE "' . $kto
                        . '" and s.ar=' . $ar . ' and periode=' . $per . ';';
                $db->setQuery((string) $sql);
                $res = $db->loadObject();
                if (!$res) {
                    $sql = 'select * from ' . $database . 'qo7sn_regn_kto where Ktonr LIKE "' . $kto . '%" ORDER BY Ktonr;';
                    $db->setQuery((string) $sql);
                    $res = $db->loadObject();
                }
            }
        }



        // $sql = 'select * from #__regn_kto order by Ktonr;';
        // $db->setQuery((string) $sql);    
        // $res = $db->loadObjectList();
        //     echo json_encode($res);
        //  return $res;
        JFactory::getApplication()->close();
        // try {
        //     return $db->loadObjectlist(); // Returns 
        // } catch (RuntimeException $e) {
        //     return []; // Handle database errors gracefully
        // }



    }
    // $query = $db->getQuery(true);
    // $query = 'select *  from #__regn_firma;';
    // $db->setQuery((string) $query);










    function oppdater_hist()
    {
        $database = get_database();
        $model = $this->getModel('registrering');
        $firma = $model->firma();
        //   $regnskapsar = $firma->regnskapsar;
        // Fetch the record

        // $config = '{"oppdatert":"ff"}';
        // $configobj = json_decode($config, true);
        // $configobj={};
        // $configobj['oppdatert'] = "2022-02-02";
        // $config = json_encode($configobj, JSON_PRETTY_PRINT);
        // $configobj['oppdatert'] = date("Y-m-d-H:i:s");
        // $config = json_encode($configobj, JSON_PRETTY_PRINT);
        $config = '{"oppdatert":"' . date('Y-m-d') . '"}';
        //   $regnskapsar = 2023;
        $transer = $model->transer($regnskapsar);
        $regnskapsar = date("Y", strtotime($transer[0]->Dato));
        //        $model = $this->getModel('registrering');
        //      $transer = $model->transer();
        $startvariable = $model->startvariable($regnskapsar);
        $b = $startvariable->buntnr;
        //     $regnskapsar = $model->regnskapsar;
        //      $regnskapsar = $firma->regnskapsar;
        $db = Factory::getDbo();
        // $query = $db->getQuery(true);
        // $input = Factory::getApplication()->input;
        // $id = $input->get('id', 0);
        $nr = 0;
        if ($transer) {
            foreach ($transer as $trans) {
                $year = date("Y", strtotime($trans->Dato));
                $month = date("m", strtotime($trans->Dato));
                if ($trans->bank_saldo == null)
                    $trans->bank_saldo = 0;
                // oppdatere hist:
                $query = $db->getQuery(true);

                if ($trans->bank_saldo == null)
                    $trans->bank_saldo = 0;

                $query = 'insert into ' . $database . 'qo7sn_regn_hist (ref, Bilagsart,Bilag,Dato,debet,kredit,belop, tekst,kontoinfo,currency,Saldo_ktoutskr,Regdato,reskontro,Buntnr,Regnskapsar,Forfallsdato,Endret_dato,Periode) values'
                    . ' (' . $trans->Ref . ',6,' . $trans->bilag . ',"' . $trans->Dato . '","' . $trans->debet . '","' . $trans->kredit . '",' . $trans->belop . ',"' . $trans->tekst . '","' . $trans->kontoinfo . '","'
                    . $trans->currency . '","' . $trans->bank_saldo . '",now(),"' . $trans->reskontro . '",' . $startvariable["buntnr"] . ',' . $year . ',"0000-00-00","0000-00-00","' . $trans->periode . '");';

                $db->setQuery((string) $query);
                try {
                    $result = $db->execute();
                } catch (Exception $e) {
                    $gg = 'Errorinsert hist: ' . $e->getMessage();
                }

                //debet
                $query = $db->getQuery(true);
                $query = 'select count(*) from  ' . $database . 'qo7sn_regn_saldo where kto=' . $trans->debet . ' and ar=' . $year . ' and periode=' . $month . ';';
                $db->setQuery((string) $query);
                try {
                    $count = $db->loadResult();
                } catch (Exception $e) {
                    $gg = 'Error select saldo: ' . $e->getMessage();
                }
                if ($count == 0) {
                    $query = $db->getQuery(true);
                    $query = 'select * from ' . $database . 'qo7sn_regn_kto where Ktonr=' . $trans->debet . ';';
                    $kto = $db->loadObject();
                    $ResBal = $kto->ResBal;

                    $query = $db->getQuery(true);
                    $query = 'insert into ' . $database . 'qo7sn_regn_saldo (ar,periode,kto,belop,hittil, budsjett,avvik_budsjett,fjorar,avvik_fjorar,hittil_fjor,resbal,raplinje,kontoer,konfig,avvik_hittil,fjorar_hittil,avvik_hittil_fjor) values ('
                        . $year . ',' . $month . ',' . $trans->debet . ',' . $trans->belop . ',' . $trans->belop . ',0,' . -$trans->belop . ',0,0,0,"' . $ResBal
                        . '",' . $kto->rapportlinje . ',\' ["' . $trans->debet . '"]\',\'' . $config . '\',0,0,0);';
                    $db->setQuery((string) $query);
                    try {
                        $result = $db->execute();
                    } catch (Exception $e) {
                        $gg = 'Errorinsert saldo: ' . $e->getMessage();
                    }
                } else {
                    $query = $db->getQuery(true);
                    $query = 'select kontoer from ' . $database . 'qo7sn_regn_saldo where kto=' . $trans->debet . ' and ar=' . $year . ' and periode=' . $month . ';';
                    $db->setQuery((string) $query);
                    $kto = $db->loadObject();

                    $array = json_decode($kto->kontoer, true);

                    if ($array != null) {
                        if (!(in_array($trans->debet, $array)))
                            $array[] = $trans->debet;
                    } else
                        $array[] = $trans->debet;
                    $kto->kontoer = json_encode($array);

                    $query = $db->getQuery(true);
                    $query = 'update  ' . $database . 'qo7sn_regn_saldo  set belop=belop+' . $trans->belop . ',hittil=hittil+' . $trans->belop . ', konfig=\'' . $config
                        . '\', kontoer=\'' . $kto->kontoer . '\'    
                            , avvik_budsjett=avvik_budsjett-' . $trans->belop . ' where kto=' . $trans->debet . ' and ar=' . $year . ' and periode=' . $month . ';';
                    $db->setQuery((string) $query);
                    try {
                        $result = $db->execute();
                    } catch (Exception $e) {
                        $gg = 'error update saldo: ' . $e->getMessage();
                    }
                }

                // kredit

                $query = $db->getQuery(true);
                $query = 'select count(*) from  ' . $database . 'qo7sn_regn_saldo where kto=' . $trans->kredit . ' and ar=' . $year . ' and periode=' . $month . ';';
                $db->setQuery((string) $query);
                try {
                    $count = $db->loadResult();
                } catch (Exception $e) {
                    $gg = 'Error select saldo: ' . $e->getMessage();
                }
                if ($count == 0) {
                    $query = $db->getQuery(true);
                    $query = 'select * from ' . $database . 'qo7sn_regn_kto where Ktonr=' . $trans->kredit . ';';
                    $db->setQuery((string) $query);
                    $kto = $db->loadObject();
                    $ResBal = $kto->ResBal;

                    $query = $db->getQuery(true);
                    $query = 'insert into ' . $database . 'qo7sn_regn_saldo (ar,periode,kto,belop,hittil, budsjett,avvik_budsjett,fjorar,avvik_fjorar,hittil_fjor,resbal,raplinje,kontoer,konfig,avvik_hittil,fjorar_hittil,avvik_hittil_fjor) values ('
                        . $year . ',' . $month . ',' . $trans->kredit . ',' . -$trans->belop . ',' . -$trans->belop . ',0,' . $trans->belop . ',0,0,0,"' . $ResBal
                        . '",' . $kto->rapportlinje . ',\' ["' . $trans->kredit . '"]\',\'' . $config . '\',0,0,0);';
                    // $query = 'insert into qo7sn_regn_saldo (ar,periode,kto,belop,hittil, budsjett,avvik_budsjett,fjorar,avvik_fjorar,hittil_fjor,resbal,raplinje,kontoer,konfig,avvik_hittil,fjorar_hittil,avvik_hittil_fjor) values ('
                    //     . $year . ',' . $month . ',' . $trans->kredit . ',' . -$trans->belop . ',' . -$trans->belop . ',0,' . $trans->belop . ',0,0,0,"' . $ResBal
                    //     . '",' . $kto->rapportlinje . ',\' ["' . $trans->kredit . '"]\',\'' . $config . '\',0,0,0);';

                    $db->setQuery((string) $query);
                    try {
                        $result = $db->execute();
                    } catch (Exception $e) {
                        $gg = 'Errorinsert saldo: ' . $e->getMessage();
                    }
                } else {
                    $query = $db->getQuery(true);
                    $query = 'select kontoer from ' . $database . 'qo7sn_regn_saldo where kto=' . $trans->kredit . ' and ar=' . $year . ' and periode=' . $month . ';';
                    $kto = $db->loadObject();

                    $array = json_decode($kto->kontoer, true);

                    if ($array != null) {
                        if (!(in_array($trans->kredit, $array)))
                            $array[] = $trans->kredit;
                    } else
                        $array[] = $trans->kredit;
                    $kto->kontoer = json_encode($array);

                    $query = $db->getQuery(true);
                    $query = 'update  ' . $database . 'qo7sn_regn_saldo  set belop=belop-' . $trans->belop . ',hittil=hittil-' . $trans->belop . ', konfig=\'' . $config
                        . '\', kontoer=\'' . $kto->kontoer . '\'
                        , avvik_budsjett=avvik_budsjett+' . $trans->belop . ' where kto=' . ($trans->kredit) . ' and ar=' . $year . ' and periode=' . $month . ';';

                    // $query = 'update  qo7sn_regn_saldo  set belop=belop-' . $trans->belop . ',hittil=hittil-' . $trans->belop . ', konfig=\'' . $config


                    // $query = 'update  qo7sn_regn_saldo  set belop=belop-' . $trans->belop . ',hittil=hittil-' . $trans->belop . ', konfig=\'' . $config
                    //     . '\', kontoer=\'' . $kto->kontoer  . '\'
                    // , avvik_budsjett=avvik_budsjett+' . $trans->belop . ' where kto=' . ($trans->kredit) . ' and ar=' . $year . ' and periode=' . $month . ';';

                    $db->setQuery((string) $query);
                    try {
                        $result = $db->execute();
                    } catch (Exception $e) {
                        $gg = 'error update saldo: ' . $e->getMessage();
                    }
                }


                $query = $db->getQuery(true);
                $query = 'delete from ' . $database . 'qo7sn_regn_trans where Ref=' . $trans->Ref . ';';
                $db->setQuery((string) $query);
                try {
                    $result = $db->execute();
                } catch (Exception $e) {
                    $gg = 'error update saldo: ' . $e->getMessage();
                }


                // $query = $db->getQuery(true);
                // $query = 'select count(*) from qo7sn_regn_saldo where kto=' . $trans->kredit . ' and ar=' . $year . ' and periode=' . $month . ';';
                // $db->setQuery((string) $query);
                // try {
                //     $count = $db->loadResult();
                // } catch (Exception $e) {
                //     $gg = 'Error select saldo: ' . $e->getMessage();
                // }
                // if ($count == 0) {
                //     $query = $db->getQuery(true);
                //     $query = 'select * from qo7sn_regn_kto where Ktonr=' . $trans->kredit . ';';
                //     $db->setQuery((string) $query);
                //     $kto = $db->loadObject();
                //     $ResBal = $kto->ResBal;
                //     $query = $db->getQuery(true);
                //     $query = 'insert into qo7sn_regn_saldo (ar,periode,kto,belop,hittil, budsjett,avvik_budsjett,fjorar,avvik_fjorar,hittil_fjor,resbal,raplinje,konfig) values ('
                //         . $year . ',' . $month . ',' . $trans->kredit . ',' . -$trans->belop . ',' . -$trans->belop . ',' . $trans->belop . ',' . $trans->belop . ',0,0,0,"' . $ResBal . '",' . $kto->rapportlinje . ',\'' . $config . '\');';
                //     $db->setQuery((string) $query);
                //     try {
                //         $result = $db->execute();
                //     } catch (Exception $e) {
                //         $gg = 'Errorinsert saldo: ' . $e->getMessage();
                //     }
                // } else {
                //     $query = $db->getQuery(true);
                //     $query = 'update  qo7sn_regn_saldo  set belop=belop-' . $trans->belop . ',hittil=hittil-' . $trans->belop . ', budsjett=budsjett+' . $trans->belop . ', konfig=\'' . $config
                //         . '\', avvik_budsjett=avvik_budsjett-' . -$trans->belop . ' where kto=' . $trans->kredit . ' and ar=' . $year . ' and periode=' . $month . ';';
                //     $db->setQuery((string) $query);
                //     try {
                //         $result = $db->execute();
                //     } catch (Exception $e) {
                //         $gg = 'error update saldo: ' . $e->getMessage();
                //     }
                // }
            }
        }
    }


    function endre_ar()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $ar = $input->get('ar', 0);
        $query = $db->getQuery(true);
        $query = 'update ' . $database . 'qo7sn_regn_firma  set regnskapsar=' . $ar . ';';
        $db->setQuery((string) $query);
        try {
            $result = $db->execute();
        } catch (Exception $e) {
            $gg = 'error update saldo: ' . $e->getMessage();
        }
    }


    function listart()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'SELECT * FROM ' . $database . 'qo7sn_regn_bilagsarter order by id;';
        $db->setQuery((string) $sql);
        try {
            $result = $db->loadObjectList();
            echo json_encode($result);
            JFactory::getApplication()->close();
            // echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
    }

    function f_sjekk_hist()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $dato = $_POST['dato'];
        $belop = $_POST['belop'];
        $sql = 'select * from 	' . $database . 'regn_hist where belop=' . $belop . ' and dato="' . $dato . '";';
        $db->setQuery((string) $sql);
        $result = $db->loadAssocList();

        //$result = $conn->query($sql);
        $ant = $result->num_rows;
        // echo '<br>Antall: '.$result->num_rows.'<br>';   
        $emparray = array();
        while ($row = mysqli_fetch_assoc($result))
        //for ($i=1;$i<=$ant;$i++)
        {
            $emparray[] = $row;
        }
        echo json_encode($emparray);
    }






    function ktoinfo()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $kto = $input->get('kto', 0);
        $dato = $input->get('dato', 0);
        // echo 'kto ' . $kto . '  dato ' . $dato . '<br>';
        /*
                                                                 //   echo $kto.'  '.$dato.'  '.$periode.'<br>';;
                                                                    if ($dato=='' and $kto=='')
                                                                    exit("Ugyldig dato og konto");
                                                                    if ($dato=='')
                                                                    exit("Ugyldig dato");
                                                                    if ($kto=='')
                                                                    exit("Ugyldig  konto");     
                                                                    */
        // echo 'dato ' . $dato . '<br>';
        if (!$dato == '') {
            $i = strpos($dato, '-', );
            $j = strpos($dato, '-', $i + 1);
            $periode = substr($dato, $i + 1, $j - $i - 1);
            //	echo 'periode1: '.$periode.'<br>';
            //echo 'feil';
            //	else

            //	echo 'kto: '.$kto.'  dato: '.$dato.'<br>';
            $i = strpos($dato, "-");
            $j = strpos($dato, "-", $i + 1);
            //		echo '$i: '.$i.' $j: '.$j.'<br>';
            if ($i == 4) {
                $periode = substr($dato, $i + 1, 2);
                $arstall = substr($dato, 0, 4);
            } else {
                $periode = substr($dato, $i + 1, $j - $i - 1);
                $arstall = substr($dato, $j + 1, 4);
            }
            ;
            //echo 'periode2: '.$periode.'<br>';

            $sql = $db->getQuery(true);
            $sql = 'SELECT * FROM ' . $database . 'qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ' AND kto=' . $kto . ';';
            $db->setQuery($query);

            // $sql = 'SELECT * FROM  qo7sn_regn_kto where Ktonr LIKE "' . $kto . '" ORDER BY Ktonr;';

            // $sql = 'SELECT * FROM qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ' AND kto=' . $kto . ';';
            $result = $db->query($sql);
            //  echo 'result: '.$result->num_rows.'<br>';
            if ($result->num_rows != 0) {
                //	echo 'dato: '.$dato.'  kto: '.$kto.' Årstall: '.$arstall.' Periode: '.$periode.' $i: '.$i.' $j: '.$j.'<br>';

                $sql = 'SELECT SUM(a.belop) as hittil,SUM(a.budsjett) as sumbudsj,c.Ktonr,b.budsjett,c.Navn,b.belop,a.resbal,a.periode, proc_periode(a.periode) ' .
                    'FROM ' . $database . '#__regn_saldo AS a INNER JOIN ' . $hash . 'regn_saldo AS b,' . $hash . 'regn_kto AS c ' .
                    ' WHERE c.Ktonr=' . $kto . ' and a.ar=' . $arstall . ' AND a.kto=' . $kto . ' AND a.periode<=' . $periode . ' and b.ar=' . $arstall . ' AND b.kto=' . $kto . ' AND b.periode=' . $periode . ';';
                $db->setQuery($query);
                $result = $db->query($sql);


                // $sql = 'SELECT SUM(a.belop) as hittil,SUM(a.budsjett) as sumbudsj,c.Ktonr,b.budsjett,c.Navn,b.belop,a.resbal,a.periode, proc_periode(a.periode) ' .
                //     'FROM ' . $hash . 'regn_saldo AS a INNER JOIN ' . $hash . 'regn_saldo AS b,' . $hash . 'regn_kto AS c ' .
                //     ' WHERE c.Ktonr=' . $kto . ' and a.ar=' . $arstall . ' AND a.kto=' . $kto . ' AND a.periode<=' . $periode . ' and b.ar=' . $arstall . ' AND b.kto=' . $kto . ' AND b.periode=' . $periode . ';';
                //$sql = 'SELECT SUM(belop) as a FROM ' . $hash . 'regn_saldo WHERE ar='.$arstall.' AND kto='.$kto.' AND periode<'.$periode.';';
                //	echo 'sql2: ' . $sql . '<br>';
                // }}
                // function dddf()
                // {		{	
                /*
                                                                                                                                       $sql = 'select * from 	' . $hash . 'regn_kto_hittil_budsjett AS info INNER JOIN ' . $hash . 'regn_kto AS kto ON kto.Ktonr=info.Ktonr  where info.Ktonr=' . $kto . ' and info.arstall=' . substr($dato, $j + 1, 4) . ' and info.periode=' . $periode . ';';
                                                                                                                                       //$sql= 'select * from 	'.$hash.'regn_kto_hittil_budsjett AS info INNER JOIN '.$hash.'regn_kto AS kto ON kto.Ktonr=info.Ktonr  where info.Ktonr='.$kto.' and info.arstall=2015 and info.periode='.$periode.';';
                                                                                                                                       //	echo 'sql1: '.$sql.'<br>';

                /*	if ($result->num_rows == 0) {
                                                                                                                                                      $sql = 'select * from 	' . $hash . 'regn_kto AS info  where info.Ktonr=' . $kto . ';';
                                                                                                                                                      $result = $conn->query($sql);

                                                                                                                                                      //	echo '    sql: '.$sql.'<br>';
                                                                                                                                                  }
                                                                                                                                                  ;
                                                                                                                                              */
            } else {
                if ($database > '')
                    $sql = 'select Ktonr,Navn from 	 ' . $database . 'qo7sn_regn_kto AS info  where info.Ktonr=' . $kto . ';';
                else
                    $sql = 'select Ktonr,Navn from 	 ' . $database . 'qo7sn_regn_kto AS info  where info.Ktonr=' . $kto . ';';
                //			echo 'sql3: ' . $sql . '<br>';
                $result = $db->query($sql);
            }
        } else {
            if ($database > '')
                $sql = 'select Ktonr,Navn from ' . $database . 'qo7snregn_kto AS info  where info.Ktonr=' . $kto . ';';
            else
                $sql = 'select Ktonr,Navn from 	.' . $database . 'qo7snregn_kto AS info  where info.Ktonr=' . $kto . ';';
            //	echo 'sql4: ' . $sql . '<br>';
            $db->setQuery($sql);
            $result = $db->query($sql);
        }
        $row = $result->fetch_array(MYSQLI_ASSOC);
        echo json_encode($row);
        //$result->free_result();
    }


    public function oppd()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $input = Factory::getApplication()->input;
        $id = $input->get('id', 0);
        $navn = $input->get('navn', 0);
        $val = $input->get('val', 0);

        $query = 'update ' . $database . 'qo7sn_regn_bilagsarter set ' . $navn . '="' . $val . '" where id=' . $id . ';';
        // $query = 'update #__regn_bilagsarter set ' . $navn . '="' . $val . '" where id=' . $id . ';';

        echo $query;
        $db->setQuery($query);
        try {
            $result = $db->execute();
            echo json_encode($result);
            echo 'Row inserted successfully!';
            JFactory::getApplication()->close();
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }
        JFactory::getApplication()->close();
    }

    public function slett()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $id = $input->getString('id', '');
        $id = $input->getString('id', '');
        $sql = 'DELETE FROM ' . $database . 'qo7sn_regn_bilagsarter WHERE id=' . $id . ';';
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


    public function oppdater3()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $input = Factory::getApplication()->input;
        $art = $input->getString('art', '');
        $beskrivelse = $input->getString('beskrivelse', '');
        $dato = $input->getString('dato', '');
        $debet = $input->getString('debet', '');
        $kredit = $input->getString('kredit', '');
        $belop = $input->getString('belop', '');
        $tekst = $input->getString('tekst', '');

        $query = $db->getQuery(true);
        $query = 'insert into ' . $database . 'qo7sn_regn_bilagsarter ( id,beskrivelse,dato,debet,kredit,belop,tekst) ' .
            ' value ("' . $art . '","' . $beskrivelse . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","' . $tekst . '");';
        $db->setQuery($query);
        try {
            $result = $db->execute();
            return 'Row inserted successfully!';
        } catch (Exception $e) {
            return 'Error inserting row: ' . $e->getMessage();
        }

        // echo 'query: ' . $query . '<br>';
        // $db->setQuery($query);
        // $db->execute();
        //     $db->setQuery($query);
        //     $messages = $db->execute(); //loadObjectList();
        // //    echo json_encode($messages);
        // Check for errors
        // if ($db->getErrorNum()) {
        //     echo 'Error: ' . $db->getErrorMsg();
        // } else {
        //     echo 'Record inserted successfully';
        // }

        // echo 'count: '.$count.'<br>';
        // Set the view format to JSON
        // $this->input->set('view', 'example');
        // $this->input->set('format', 'json');

        // // Call the parent display method to render the view
        // parent::display();
        //      return 'test';

        //    JFactory::getApplication()->close();
    }

    public function add()
    {
        // Logic to add an item
        echo 'add   subcontroller bilagsart ';
        Factory::getApplication()->close();
        //   $this->setRedirect('index.php?option=com_regn&view=abc&layout=edit');
    }


    public function oppdater1()
    {
        echo '       bilagsart oppdater i subcontroller   ';
        Factory::getApplication()->close();
    }


    function f_ktoinfo()
    {
        $database = get_database();
        $input = Factory::getApplication()->input;

        $kto = $input->getString('kto');
        $dato = $input->getString('dato');
        // echo 'kto ' . $kto . '  dato ' . $dato . '<br>';
        /*
                                                                 //   echo $kto.'  '.$dato.'  '.$periode.'<br>';;
                                                                    if ($dato=='' and $kto=='')
                                                                    exit("Ugyldig dato og konto");
                                                                    if ($dato=='')
                                                                    exit("Ugyldig dato");
                                                                    if ($kto=='')
                                                                    exit("Ugyldig  konto");     
                                                                    */
        // echo 'dato ' . $dato . '<br>';
        if (!$dato == '') {
            $i = strpos($dato, '-', );
            $j = strpos($dato, '-', $i + 1);
            $periode = substr($dato, $i + 1, $j - $i - 1);
            //	echo 'periode1: '.$periode.'<br>';
            //echo 'feil';
            //	else

            //	echo 'kto: '.$kto.'  dato: '.$dato.'<br>';
            $i = strpos($dato, "-");
            $j = strpos($dato, "-", $i + 1);
            //		echo '$i: '.$i.' $j: '.$j.'<br>';
            if ($i == 4) {
                $periode = substr($dato, $i + 1, 2);
                $arstall = substr($dato, 0, 4);
            } else {
                $periode = substr($dato, $i + 1, $j - $i - 1);
                $arstall = substr($dato, $j + 1, 4);
            }
            ;
            //echo 'periode2: '.$periode.'<br>';

            $db = $this->getDbo();
            $sql = $db->getQuery(true);


            $sql = 'SELECT * FROM ' . $database . 'qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ';';

            // $sql = 'SELECT * FROM qo7sn_regn_saldo WHERE ar=' . $arstall . ' AND periode=' . $periode . ' AND kto=' . $kto . ';';

            $db->setQuery((string) $sql);
            try {
                return $db->loadObjectlist(); // Returns 
            } catch (RuntimeException $e) {
                return []; // Handle database errors gracefully
            }
        }
    }



    function ktosok()
    {
        $database = get_database();
        $input = Factory::getApplication()->input;
        $kto = $input->getString('kto');
        $db = Factory::getDbo();

        // $db = $this->getDbo();
        $query = $db->getQuery(true);

        if ($kto == 0) {
            $kto = $input->getString('ktosok1');
        } else {
            $kto = $input->getString('ktosok');
        }
        // echo 'kto ' . $kto . '  dato ' . $dato . '<br>';



        $query = 'SELECT * FROM ' . $database . 'qo7sn_regn_kto order by Ktonr;'; //}

        if (($kto == 0) || ($kto == '')) {
            $query = 'SELECT * FROM  ' . $database . 'qo7sn_regn_kto order by Ktonr;'; //}
        } else {
            //	$ktosok=$_GET["ktosok1"];
            //echo 'ktosok '.$ktosok.' : '.$ktosok[0].'<br>';



            if ($database > '') {
                if (($kto[0] >= '0') && ($kto[0] <= '9'))
                    $query = 'SELECT * FROM ' . $database . 'qo7sn_regn_kto WHERE Ktonr LIKE "%' . $kto . '%";';
                else
                    $query = 'SELECT * FROM  ' . $database . 'qo7sn_regn_kto WHERE Navn LIKE "%' . strtolower($kto) . '%" order by Navn;';
            } else {
                if (($kto[0] >= '0') && ($kto[0] <= '9'))
                    $query = 'SELECT * FROM ' . $database . 'qo7sn_regn_kto WHERE Ktonr LIKE "%' . $kto . '%";';
                else
                    $query = 'SELECT * FROM  ' . $database . 'qo7sn_regn_kto WHERE Navn LIKE "%' . strtolower($kto) . '%" order by Navn;';
            }
        }
        $db->setQuery((string) $query);
        try {
            $retur = $db->loadObjectlist(); // Returns 
            echo $retur;
        } catch (RuntimeException $e) {
            return []; // Handle database errors gracefully
        }
    }







    function f_oppdater()
    {
        $database = get_database();
        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $input = Factory::getApplication()->input;

        $art = $input->getString('art', '');
        if ($art == '')
            $art = '1';
        $ref = $input->getString('ref');
        $bilag = $input->getString('bilagsnr');
        $buntnr = $input->getString('buntnr');
        $dato = $input->getString('dato');
        $debet = $input->getString('debet');
        $kredit = $input->getString('kredit');
        $belop = $input->getString('belop');
        $valuta = $input->getString('valuta');
        $tekst = $input->getString('tekst');

        if (!(($valuta == 0) || ($valuta == ''))) {
            $currency = substr($valuta, 4);
            echo '$currency: ' . $currency . '  $valuta: ' . $valuta . '  $rate: ' . $rate . '<br>';
            $valuta = substr($valuta, 0, 3);
            $currency = str_replace(",", ".", $currency);
            $rate = fdiv($belop, $currency);
            echo '$currency: ' . $currency . '  $valuta: ' . $valuta . '  $rate: ' . $rate . '<br>';
        } else {
            $currency = 0;
            $valuta = 'NOK';
            $rate = 0; //(NULL);
        }

        $periode = FManed($dato);
        echo $belop . ' : ' . $valuta . ' : ' . $currency . ' : ' . $rate . '<br>';
        if (($dato[4] == '-') && ($dato[7] == '-')) {
        } else {
            $i = strpos($dato, '-');
            if ($i == 1)
                $dato = "0" . $dato;
            $i = strpos($dato, '-');
            $j = strpos($dato, '-', ++$i);
            if ($j == 4)
                $dato = substr($dato, 0, --$j) . '0' . substr($dato, $j);
            $dato = substr($dato, 6, 4) . '-' . substr($dato, 3, 2) . '-' . substr($dato, 0, 2);

            //	echo 'dato2 '.$dato;
        }
        if ($belop == 0)
            $belop = '(NULL)';
        /*if ($_POST["kommando"]=="slett")
                                                                    $sql = "DELETE FROM fb8c8_regn_trans ORDER BY Ref DESC LIMIT 1;";
                                                                else
                                                                */
        $query = $db->getQuery(true);
        $query = 'INSERT INTO ' . $database . '#__regn_trans  (Ref,bilag,Dato,debet,kredit,belop,currency_amount,currency,currency_rate,tekst,Buntnr,Regdato,Bilagsart,periode)'
            . ' VALUES ("' . $ref . '","' . $bilag . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","'
            . $currency . '","' . $valuta . '","' . $rate . '","' . $tekst . '","' . $buntnr . '","' . date("Y-m-d") . '","' . $art . '","' . $periode . '");';
        $db->setQuery((string) $query);
        try {
            return $db->Execute(); // Returns 
        } catch (RuntimeException $e) {
            return []; // Handle database errors gracefully
        }
    }
}



function FManed($now1)
{

    // $manded='test'; 
    $month = date("m", strtotime($now1));
    switch ($month) {
        case 1:
            $manded = 'Januar';
            break;
        case 2:
            $manded = 'Februar';
            break;
        case 3:
            $manded = 'Mars';
            break;
        case 4:
            $manded = 'April';
            break;
        case 5:
            $manded = 'Mai';
            break;
        case 6:
            $manded = 'Juni';
            break;
        case 7:
            $manded = 'Juli';
            break;
        case 8:
            $manded = 'August';
            break;
        case 9:
            $manded = 'September';
            break;
        case 10:
            $manded = 'Oktober';
            break;
        case 11:
            $manded = 'November';
            break;
        case 12:
            $manded = 'Desember';
            break;
    }
    return $manded;
}
