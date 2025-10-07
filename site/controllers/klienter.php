<?php
defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;





class RegnControllerKlienter extends BaseController
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

    function postnummer()
    {
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $postnr = $input->getString('postnr', '');
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_postnummer where postnummer="' . $postnr . '";';
        $db->setQuery((string) $sql);
        try {
            $sv = $db->loadObject();
            if ($sv)
                echo $sv->poststed;
            else
                echo 'ukjent';
            JFactory::getApplication()->close();
        } catch (Exception $e) {
            echo 'Error postnmmer: ' . $e->getMessage() . '<br>';
        }
    }

    public function bruker()
    {
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $bruker = $input->getString('bruker', '');
        $sql = $db->getQuery(true);
        $sql = 'select * from klienter where brukernavn="' . $bruker . '";';
        $db->setQuery($sql);
        $svar = '';
        $result = $db->loadObject();
        if ($result)
            $svar = 'gammel';
        else
            $svar = 'ny';
        echo $svar;
        JFactory::getApplication()->close();
    }

    public function reg()
    {
        //    echo 'f_reg subcontroller klienter     ';
        //           JFactory::getApplication()->close();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $bruker = $input->getString('bruker', '');
        $passw = $input->getString('passwd', '');
        //      echo '  bruker: ' . $bruker;
        //      echo '  passw: ' . $passw;

        $sql = "select count(*) as cnt from klienter where brukernavn='" . $bruker . "' and passord='" . $passw . "'";
        $db->setQuery($sql);
        try {
            $result = $db->loadObject();
            // echo json_encode($result);
            // echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
        }

        if ($result->cnt > 0) {
            echo 'Bruker finnes allerede';
            JFactory::getApplication()->close();
            // User exists, redirect to the main page
            // return new JsonResponse(['status' => 'success', 'message' => 'User exists, redirecting...']);
            // // $app = Factory::getApplication();
            // $app->redirect('index.php?option=com_klient&view=klienter&layout=default');
            // $app->close();
        }
        // User does not exist, create a new user
        $model = $this->getModel('klienter');

        // Fetch the record
        // $klientliste = $model->klientliste();
        // if (!$klientliste) {
        //     $lastEl = 1;
        // } else {
        //     $feil = false;
        //     $lastElement = end($klientliste);
        //     // $lastEl = (string) $lastElement->ID + 1;
        // }

        // Fetch the record
        $klientliste = $model->klientliste();
        if ($klientliste) {
            //  $feil = false;
            $siste_klient = end($klientliste);
            //   $lastEl = (string) $lastElement->ID + 1;

            // $array = ["idref" => "reg100001", "ID" => 1, "firma" => "test", "brukernavn" => "test", "telefon" => "123456780", "epost" => "test@test.com", "passord" => "test"];

            $siste_klient->brukernavn = $bruker;
            $siste_klient->passord = $passw;
            $ny_klient = $model->opprett_klient($siste_klient);

            //    $sv=   json_encode($ny_klient->idref)    ;
            $sv = $ny_klient->idref;
            echo $sv;
            JFactory::getApplication()->close();
        }

        // Insert  ny klient into the database
        // $sql = 'INSERT INTO klienter (brukernavn, passord) VALUES (' . $bruker . ', ' . $passw . ');';
        // //    echo 'sql: ' . $sql . '<br>';
        // $db->setQuery($sql);
        // try {
        //     $result = $db->execute();
        //     echo 'kode: ' . $array['idref'];
        //     JFactory::getApplication()->close();
        //     // echo json_encode($result);
        //     // echo 'Row inserted successfully!';
        // } catch (Exception $e) {
        //     echo 'Error inserting row: ' . $e->getMessage();
        // }
        // JFactory::getApplication()->close();
    }

    public function egenkap()
    {

        $model = $this->getModel('klienter');

        $user = JFactory::getUser();
        $username = $user->username;
        $database = $user->authProvider;
        if (($database[0] == "X") || ($database[0] == "$"))
            $database = substr($database, 1);

        // $database = $model->hent_database($value);
        // if ($database[0] == "X")
        //     $value = substr($database, 1);
        // else
        //     $value = $database;
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $kto = $input->getString('id', '');
        $belop = $input->getString('saldo', '');
        $regnskapsar = $input->getString('regnskapsar', '');
        $dato = $regnskapsar . '-01-01';

        // Finne ref-nummer fra transaksjonstegisteret:

        $sql = $db->getQuery(true);
        $sql = 'select Ref from ' . $database . '.qo7sn_regn_trans order by Ref desc limit 1;';
        $db->setQuery((string) $sql);
        try {
            $ref = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }

        // Oppdatere ktosaldo:

        $sql = $db->getQuery(true);
        $sql = 'select belop,debet,kredit from ' . $database . '.qo7sn_regn_trans where debet=' . $kto . ' or kredit=' . $kto . ';';
        $db->setQuery((string) $sql);
        try {
            $result = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }

        if ($result) {
            $sql = $db->getQuery(true);
            if ($belop > 0)
                $sql = 'update ' . $database . '.qo7sn_regn_trans  set belop=' . abs($belop) . ' where debet=' . $kto . ';';
            else
                $sql = 'update ' . $database . '.qo7sn_regn_trans  set belop=' . abs($belop) . ' where kredit=' . $kto . ';';

            $db->setQuery((string) $sql);
            try {
                $belop = $db->loadResult();
            } catch (Exception $e) {
                echo 'Error fetching database: ' . $e->getMessage() . '<br>';
            }
        } else {
            $ref++;
            $sql = $db->getQuery(true);
            $belop = str_replace(",", ".", $belop);
            if ($belop > 0)
                $sql = 'insert into ' . $database . '.qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop,Tekst) values ('
                    . $ref . ',0,0,"' . $dato . '",' . $kto . ',0,' . abs((float) $belop) . ',"Balansesaldo 2025");';
            else
                $sql = 'insert into  ' . $database . '.qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop,Tekst) values ('
                    . $ref . ',0,0,"' . $dato . '",0,' . $kto . ',' . abs((float) $belop) . ',"Balansesaldo 2025);';
            $db->setQuery((string) $sql);
            try {
                $db->execute(true);
            } catch (Exception $e) {
                echo 'Error fetching database: ' . $e->getMessage() . '<br>';
            }
        }

        // Oppdatere egenkapitalsaldo:


        $sql = $db->getQuery(true);
        $sql = 'SELECT sum(belop) FROM  ' . $database . '.qo7sn_regn_trans WHERE Buntnr=0 AND debet<9000 AND kredit<9000;';
        //  //     $sql = 'select belop from ' . $value . '.qo7sn_regn_trans where debet=9000 or kredit=9000';
        $db->setQuery((string) $sql);
        try {
            $egenkap = $db->loadResult();
            $egenkap = -$egenkap;
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }

        $sql = $db->getQuery(true);
        $sql = 'select belop from ' . $database . '.qo7sn_regn_trans where debet=9000 or kredit=9000';
        $db->setQuery((string) $sql);
        try {
            $result = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }
        if ($result) {
            $sql = $db->getQuery(true);
            if ($egenkap > 0)
                $sql = 'update ' . $database . '.qo7sn_regn_trans  set belop=' . abs($egenkap) . ' where debet=9000;';
            else
                $sql = 'update ' . $database . '.qo7sn_regn_trans  set belop=' . abs($egenkap) . ' where kredit=9000;';

            $db->setQuery((string) $sql);
            try {
                $svar = $db->execute(true);
                echo 'update egenkap';
            } catch (Exception $e) {
                echo 'Error fetching database: ' . $e->getMessage() . '<br>';
            }
        } else {
            $ref++;
            $sql = $db->getQuery(true);
            if ($egenkap > 0)
                $sql = 'insert into ' . $database . '.qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop,Tekst) values (' 
            . $ref . ',0,0,"' . $dato . '",9000,0,' . abs($egenkap) . ',"Balansesaldo 2025");';
            else
                $sql = 'insert into  ' . $database . '.qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop,Tekst) values (' 
            . $ref . ',0,0,"' . $dato . '",0,9000,' . abs($egenkap) . ',"Balansesaldo 2025");';
            $db->setQuery((string) $sql);
            try {
                $svar = $db->execute(true);
                echo 'insert egenkap';
            } catch (Exception $e) {
                echo 'Error fetching database: ' . $e->getMessage() . '<br>';
            }
        }
        echo 'ferdig';
    }

    function lag_balansesaldo($ar)
    {
        $database = $this->get_database();
        $model = new getModel('klienter');
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'SELECT sum(belop) FROM  ' . $database . '.qo7sn_regn_trans WHERE Buntnr=0 AND debet<9000 AND kredit<9000;';
        $db->setQuery((string) $sql);
        try {
            $egenkap = $db->loadResult();
            $egenkap = -$egenkap;
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }

        $sql = $db->getQuery(true);
        $sql = 'select belop from ' . $database . '.qo7sn_regn_trans where debet=9000 or kredit=9000';
        $db->setQuery((string) $sql);
        try {
            $result = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching database: ' . $e->getMessage() . '<br>';
        }
        if ($result) {
            $sql = $db->getQuery(true);
            if ($egenkap > 0)
                $sql = 'update ' . $database . '.qo7sn_regn_trans  set belop=' . abs($egenkap) . ' where debet=9000;';
            else
                $sql = 'update ' . $database . '.qo7sn_regn_trans  set belop=' . abs($egenkap) . ' where kredit=9000;';

            $db->setQuery((string) $sql);
            try {
                $svar = $db->execute(true);
                echo 'update egenkap';
            } catch (Exception $e) {
                echo 'Error fetching database: ' . $e->getMessage() . '<br>';
            }
        } else {
            $ref++;
            $sql = $db->getQuery(true);
            if ($egenkap > 0)
                $sql = 'insert into ' . $database . '.qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop) values (' . $ref . ',0,0,"' . $dato . '",9000,0,' . abs($egenkap) . ');';
            else
                $sql = 'insert into  ' . $database . '.qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop) values (' . $ref . ',0,0,"' . $dato . '",0,9000,' . abs($egenkap) . ');';
            $db->setQuery((string) $sql);
            try {
                $svar = $db->execute(true);
                echo 'insert egenkap';
            } catch (Exception $e) {
                echo 'Error fetching database: ' . $e->getMessage() . '<br>';
            }
        }
        echo 'ferdig';
    }

}
