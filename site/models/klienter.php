<?php

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
//global $db;$db = Factory::getDbo();

// use Joomla\CMS\Factory;
// use Joomla\CMS\MVC\Controller\BaseController;
// use Joomla\CMS\Response\JsonResponse;


global $model;




class RegnModelKlienter extends ListModel
{

    /*
loadResult() : single value from one resourcebundle_get_error_code
loadRow() : Single record use index id   (returns an indexed array from a single record in the table:)
loadAssoc() : Single record  use fieldname      (returns an associated array from a single record in the table:)
loadObject() : php object (loadObject returns a PHP object from a single record in the table:)
loadColumn() : all records from a singel coloumn (returns an indexed array from a single column in the table:)
loadColumn($index)  : all records from multiple records (returns an indexed array from a single column in the table:)
loadRowList() : (returns an indexed array of indexed arrays from the table records returned by the query:)
loadAssocList()  :  ( returns an indexed array of associated arrays from the table records returned by the query:)
loadAssocList($key) :  (returns an associated array - indexed on 'key' - of associated arrays from the table records returned by the query:)
loadAssocList($key, $column) :  ( returns an associative array, indexed on 'key', of values from the column named 'column' returned by the query:)
loadObjectList()  :  (returns an indexed array of PHP objects from the table records returned by the query:)
loadObjectList($key) :  (returns an associated array - indexed on 'key' - of objects from the table records returned by the query:)
https://docs.joomla.org/Special:MyLanguage/Selecting_data_using_JDatabase 
*/

    //     public function firma()
    //     {


    // defined('_JEXEC') or die;


    // // use Joomla\CMS\Factory;
    // // use Joomla\CMS\MVC\Controller\BaseController;
    // // use Joomla\CMS\Response\JsonResponse;


    // use Joomla\CMS\MVC\Model\ListModel;
    // use Joomla\CMS\Factory;
    // use Joomla\CMS\MVC\Controller\BaseController;
    // use Joomla\CMS\MVC\Model\BaseDatabaseModel;



    // class KlientModelKlienter extends BaseController
    // {


    function get_database()
    {
        $model = new RegnModelKlienter;
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



    function regnskapsar()
    {

        $user = JFactory::getUser();
        $username = $user->username;
        $database = $user->authProvider;
        if (($database[0] == "X") || ($database[0] == "$"))
            $database = substr($database, 1);

        // finn buntnr som er brukt i hostorikken  for balansaldo for regnskapsåret

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select Regnskapsar from ' . $database . '.qo7sn_regn_firma;';
        $db->setQuery((string) $sql);
        try {
            return $db->loadAssoc()["Regnskapsar"];
        } catch (Exception $e) {
            echo 'Error fetching regnskapsar: ' . $e->getMessage() . '<br>';
        }





    }

    function hent_saldo($ar)
    {

        // henter inn saldoliste fra historikken og legger det i trans med buntnr 0 og bilagsart 0 og dat 2025-01-01

        $database = $this->get_database();
        $db = Factory::getDbo();
        // $sql = $db->getQuery(true);
        // $sql = 'select count(*) from ' . $database . 'qo7sn_regn_trans where bilagsart=0 and Dato="' . $ar . '-01-01" ;';
        // $db->setQuery((string) $sql);
        // try {
        //     $cnt = $db->loadAssoc();
        // } catch (Exception $e) {
        //     echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        // }
        // if ($cnt["count(*)"] > 0)
        //     return; // det er allerede saldoposter for dette regnskapsåret

        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_trans where bilagsart=0 and Dato="' . $ar . '-01-01" ;';
        $db->setQuery((string) $sql);
        try {
            $hitrans = $db->loadAssoclist();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }

        if (count($hitrans) > 0)
            return; // det er allerede saldoposter for dette regnskapsåret
        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_hist where bilagsart=0 and Dato="' . $ar . '-01-01" ;';
        $db->setQuery((string) $sql);
        try {
            $histtranser = $db->loadAssoclist();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }
        ;

        // Fjerner tidliger saldoposter i trans 



        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'delete from ' . $database . 'qo7sn_regn_trans where bilagsart=0 and Buntnr=0 and Dato="' . $ar . '-01-01" ;';
        $db->setQuery((string) $sql);
        try {
            $res = $db->execute();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }

        // henter ref fra trans


        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select Ref from ' . $database . 'qo7sn_regn_hist order by Ref desc limit 1;';
        $db->setQuery((string) $sql);
        try {
            $ref = $db->loadResult();
            if (!$ref)
                $ref = 0;

        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }


        //Oppdaterer trans med balanseposter fra regnskapsåret

        foreach ($histtranser as $hist) {

            $sql = $db->getQuery(true);
            $sql = 'insert into ' . $database . 'qo7sn_regn_trans (Ref,Buntnr,bilag,bilagsart,Dato,debet,kredit,belop,tekst) value '
                . '(' . $ref++ . ',0,' . $hist["Bilag"] . ',0,"' . $ar . '-01-01","' . $hist["debet"] . '","' . $hist["kredit"] . '","' . $hist["belop"] . '","' . $hist["Tekst"] . '");';
            $db->setQuery((string) $sql);
            try {
                $histrestranser = $db->execute();
            } catch (Exception $e) {
                echo 'Error fetching saldop fra hist: ' . $e->getMessage() . '<br>';
            }
        }






    }



    function oppdater_saldo($ar)
    {

        $user = JFactory::getUser();

        // $database = $user->authProvider . '.';
        // if (($database[0] == "X") || ($database[0] == "$"))
        //     $database = substr($database, 1);
        $model = new RegnModelKlienter;
        $database = $model->get_database();
        $buntnr = 0;
        $bilag = 0;
        // finn buntnr og bilagsnr som er brukt i historikken tidligere for balansaldo for regnskapsåret

        $db = Factory::getDbo();



        // $sql = $db->getQuery(true);
        // $sql = 'select Ref  from ' . $database . 'qo7sn_regn_hist where year(Dato)="' . $ar . '" order by ref desc limit 1;';
        // $db->setQuery((string) $sql);
        // try {
        //     $ref = $db->loadResult();
        // } catch (Exception $e) {
        //     echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        // }




        $sql = $db->getQuery(true);
        $sql = 'select Buntnr  from ' . $database . 'qo7sn_regn_hist where bilagsart!=0 or Dato="' . $ar . '-01-01" order by buntnr desc limit 1;';
        $db->setQuery((string) $sql);
        try {
            $buntnr = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }
        if (!$buntnr)
            $buntnr = 1;
        else
            $buntnr++;
        // Finne ref nr enten fra transaksjonsregisteret eller historikken

        // $db = Factory::getDbo();
        // $sql = $db->getQuery(true);
        // $sql = 'select Ref from ' . $database . 'qo7sn_regn_trans order by Ref desc limit 1;';
        // $db->setQuery((string) $sql);
        // try {
        //     $reftrans = $db->loadResult();
        // } catch (Exception $e) {
        //     echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        // }
        // if (!$reftrans)
        //     $reftrans = 0;

        // // Finne ref nr enten fra transaksjonsregisteret eller historikken

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);

        $sql = 'select Ref from ' . $database . 'qo7sn_regn_hist  WHERE ((bilagsart!=0) AND (Dato!="2025-01-01")) order by buntnr desc limit 1;';
        $db->setQuery((string) $sql);
        try {
            $ref = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }

        if (!$ref)
            $ref = 0;
        else
            $ref++;

        // slett balanseposter i historikken for regnskapsaret

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'delete from ' . $database . 'qo7sn_regn_hist where  bilagsart=0 and Dato="' . $ar . '-01-01";';
        $db->setQuery((string) $sql);
        try {
            $res = $db->execute();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }

        // // Hente alle transaksjoner:

        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_trans where Buntnr=0 and bilagsart=0 and Dato="' . $ar . '-01-01"  order by Ref;';
        $db->setQuery((string) $sql);
        try {
            $transer = $db->loadAssoclist();
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }

        // //Sette inn verdier for balansesald på samme buntnr

        $bilag = 0;
        foreach ($transer as $trans) {
            $db = Factory::getDbo();
            $sql = $db->getQuery(true);
            $sql = 'insert into  ' . $database . 'qo7sn_regn_hist (Ref,bilag,Bilagsart,Buntnr, Dato,debet,kredit,belop,Tekst,currency,kontoinfo,Regdato) value '
                . '(' . $ref . ',' . $bilag . ',0,' . $buntnr . ',"' . $ar . '-01-01",' . $trans["debet"] . ',' . $trans["kredit"] . ','
                . $trans["belop"] . ',"Balansesaldo ' . $ar . '","NOK","",NOW());';
            $db->setQuery((string) $sql);
            try {
                $res = $db->execute();
            } catch (Exception $e) {
                echo 'Error insert trans i historikk: ' . $e->getMessage() . '<br>';
            }

            // $sql = $db->getQuery(true);
            // $sql = 'delete from ' . $database . 'qo7sn_regn_trans where Ref=' . $trans["Ref"] . ';';
            // $db->setQuery((string) $sql);
            // try {
            //     $res = $db->execute();
            // } catch (Exception $e) {
            //     echo 'Error insert trans i historikk: ' . $e->getMessage() . '<br>';
            // }
            $ref++;
        }

        // // //Sletter bunten i transaksjonsregisteret

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'delete from ' . $database . 'qo7sn_regn_trans where Bilagsart=0  and Buntnr=0 and Dato="' . $ar . '-01-01"';
        $db->setQuery((string) $sql);
        try {
            $res = $db->execute();
        } catch (Exception $e) {
            echo 'Error insert trans i historikk: ' . $e->getMessage() . '<br>';
        }

    }



    function hent_transer($kto)
    {


        $user = JFactory::getUser();
        $username = $user->username;
        $database = $user->authProvider;
        if (($database[0] == "X") || ($database[0] == "$"))
            $database = substr($database, 1) . '.';

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select belop from ' . $database . 'qo7sn_regn_trans where debet = ' . $db->quote($kto) . ';';
        $db->setQuery((string) $sql);
        try {
            $debet = $db->loadResult();
            if (!$debet)
                $debet = 0;
            //   $debet = floatval($debet.'.0');
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }
        $sql = $db->getQuery(true);
        $sql = 'select belop from ' . $database . 'qo7sn_regn_trans where kredit = ' . $db->quote($kto) . ';';
        $db->setQuery((string) $sql);
        try {
            $kredit = $db->loadResult();
            if (!$kredit)
                $kredit = 0;
            //    $kredit = floatval($kredit.'.0');
        } catch (Exception $e) {
            echo 'Error fetching transactions: ' . $e->getMessage() . '<br>';
        }
        $svar = $debet - $kredit;
        return $svar;
    }

    function oppdater_klient($res)
    {
        if (!$res)
            return; // Check if the array is empty or not set

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'UPDATE qo7sn_regn_klienter SET ';
        $fields = array();

        foreach ($res as $key => $value) {
            $fields[] = $db->quoteName($key) . ' = ' . $db->quote($value);
        }

        $sql .= implode(', ', $fields);
        $sql .= ' WHERE folder_name = ' . $db->quote($res['folder_name']) . ';';

        $db->setQuery((string) $sql);
        try {
            $db->execute();
            return 'Bruker oppdatert';
        } catch (Exception $e) {
            echo 'Error updating row: ' . $e->getMessage() . '<br>';
        }
    }

    function postnummer($postnr)
    {
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from postnr;';
        $db->setQuery((string) $sql);
        try {
            return $db->loadAssoc;
        } catch (Exception $e) {
            echo 'Error postnmmer: ' . $e->getMessage() . '<br>';
        }
    }

    // function lagre_klient($res);
    // {
    //     if (!$res)
    //         return; // Check if the array is empty or not set
    //     $a = $res['ID'];
    //     $b = $res['ID'];
    //     $db = Factory::getDbo();
    //     $sql = $db->getQuery(true);
    //     $sql = 'select * from klienter order by idref desc limit 1';
    //     $db->setQuery((string) $sql);
    //     try {
    //         $res = $db->loadObject(); // Returns 
    //     } catch (Exception $e) {
    //         echo 'Error inserting row: ' . $e->getMessage() . '<br>';
    //     }
    //     $res->brukernavn = $res['brukernavn'];
    //     $res->passord = $res['passord'];

    //     $letters = preg_replace('/[^a-zA-Z]/', '', $res->folder_name); // "abcdef"

    //     // Extract only numbers
    //     $numbers = (int) preg_replace('/[^0-9]/', '', $res->folder_name); // "123456"
    //     $numbers++;
    //     $nyfolder = $letters . $numbers;
    //     $res->idref = $nyfolder;
    //     $res->folder_name = $nyfolder;
    //     //  $input = Factory::getApplication()->input;
    //     //  $nr = $input->get('nr', 0);
    //     //       $sql = insert into qo7sn_regn_klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
    //     $sql = 'insert into qo7sn_regn_klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
    //         . 'values ("' . $res->idref . '","' . $res->firma . '","' . $res->folder_name . '","' . $res->brukernavn . '","' . $res->telefon . '","' . $res->epost . '","' . $res->passord . '");';
    //     $db->setQuery((string) $sql);
    //     try {
    //         $db->execute(); // Returns 
    //         return 'Bruker opprettet';
    //     } catch (Exception $e) {
    //         echo 'Error inserting row: ' . $e->getMessage() . '<br>';
    // {
    //     $db = Factory::getDbo();
    //     $input = Factory::getApplication()->input;
    //     $bruker = $input->getString('bruker', '');
    //     $passw = $input->getString('passwd', '');
    //     $firma = $input->getString('firma', '');
    //     $telefon = $input->getString('telefon', '');
    //     $epost = $input->getString('epost', '');
    //     $base = $input->getString('jsVar', '');

    //     //      echo '  bruker: ' . $bruker;
    //     //      echo '  passw: ' . $passw;

    //     $sql = "update qo7sn_regn_klienter set firma='" . $firma . "', telefon='" . $telefon . "', epost='" . $epost . "' where brukernavn='" . $bruker . "' and passord='" . $passw . "'";
    //     $db->setQuery($sql);
    //     try {
    //         $result = $db->execute();
    //         echo 'Bruker oppdatert';
    //         // echo json_encode($result);
    //         // echo 'Row inserted successfully!';
    //     } catch (Exception $e) {
    //         echo 'Error inserting row: ' . $e->getMessage();
    //     }
    // }

    function hent_filnavn()
    {

        //         if (isset($_GET['csv_file'])) {
        //             echo $_GET['csv_file'] . '<br>';
        //             //exit();
        //      //     $f= new ModStorebrandHelper;
        //    //  echo    ModStorebrandHelper::read_csv($_GET['csv_file']);
        //      echo    ModStorebrandHelper::read_csv($_GET['csv_file']);

        //             $data = ModStorebrandHelper::getData();
        //             echo 'gg<br>';
        //             // Load the layout
        //             require ModuleHelper::getLayoutPath('mod_storebrand');
        //         }

        //   echo 'gg<br>';



        if (isset($_POST['trinn0'])) {
            //    echo ' Check if a file was uploaded <br>';
            if (isset($_FILES['sql_file']) && $_FILES['sql_file']['error'] === UPLOAD_ERR_OK) {
                // Get file details
                $fileTmpPath = $_FILES['sql_file']['tmp_name'];
                $fileName = $_FILES['sql_file']['name'];
                $fileSize = $_FILES['sql_file']['size'];
                $fileType = $_FILES['sql_file']['type'];
                $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                // echo "File is successfully uploaded. <br>";
                //     echo "Filnavn: $fileName <br>";
                //    echo "Fil størrelse: $fileSize bytes <br>";
                // echo "File Type: $fileType <br>";
                //    echo "File Path: $dest_path";
                // Check if the uploaded file is a CSV
                // if (
                //     $fileExtension === 'sql'
                // ) {
                //     // Specify the upload directory
                //     $uploadDir = './modules/mod_storebrand/uploads/';
                //     if (!is_dir($uploadDir)) {
                //         mkdir($uploadDir, 0755, true); // Create directory if it doesn't exist
                //     }

                //     $destination = $uploadDir . $fileName;

                //     // Move the file to the uploads directory
                //     if (move_uploaded_file($fileTmpPath, $destination)) {
                //         // echo "File uploaded successfully! <br>";
                //         // echo "File saved at: $destination <br>";
                //     }
                // }
                return $fileName;

                // $csvhent = new ModStorebrandHelper;
                // // $csvhent->read_csv($destination);
                // $data = $csvhent->getData();
                // foreach ($data as $line) {
                //     echo $line['dato'] . '<br>';
                // }
                // //     $t=json_decode($line);

                // $csvhent->getData($destination);

                // foreach ($csvhent as $line) {
                //     //     $t=json_decode($line);
                //     //       echo $t[0].'<br>';
                //     echo $line . '<br>';
                // }
                // require JModuleHelper::getLayoutPath(
                //     'mod_storebrand',
                //     'default'
                // );
            }
        } else
            echo '  
            <form action="" method="POST" enctype="multipart/form-data">
        <label for="sql_file">Last opp mal: </label>
        <input type="file" name="sql_file" id="sql_file" accept=".sql">
        <button type="submit" name="upload">Last opp1</button>
    </form>';
    }

    function hent_klient($bruker, $password)
    {
        //   return null;

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_klienter where brukernavn = ' . $db->quote($bruker) . ' and passord = ' . $db->quote($password);
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadAssoc();
            if ($ret)
                return $ret;
            else
                return null;
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }
    }

    function hent_klient1($base)
    {
        //   return null;

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_klienter where folder_name = ' . $db->quote($base);
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadAssoc();
            if ($ret)
                return $ret;
            else
                return null;
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }
    }

    function klientliste()
    {

        /* Første post innlegges i instalasjonsfasen, hvis ikke tabellen er tom.
        Dette er for å unngå at det ikke finnes noen klienter i tabellen.
        */

        $db = Factory::getDbo();
        //  $input = Factory::getApplication()->input;
        //  $nr = $input->get('nr', 0);
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_klienter';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadObjectlist();
            if ($ret)
                return $ret;
            // else { /*  Hvis ikke første post finnes, legges ny post i registeret. Egentlig skal dette gjøres i installasjonsprosedyren*/
            //     $sql = 'insert into qo7sn_regn_klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name) values (1,"test","test","test","regn100001","123456780","test@test.com","regn100001")';
            //     $db->setQuery((string) $sql);
            //     try {
            //         $db->execute(); // Returns
            //         $array = ["idref" => "reg100001", "ID" => 1, "firma" => "test", "brukernavn" => "regn100001", "telefon" => "123456780", "epost" => "test@test.com", "passord" => "test"];
            //         $this->opprett_klient($array);

            //     } catch (Exception $e) {
            //         echo 'Error inserting row: ' . $e->getMessage() . '<br>';
            //     }
            // }
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        }

        //        
    }
    function opprett_klient($username)
    {
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_users order by authProvider desc limit 1';
        $db->setQuery((string) $sql);
        $last = $db->loadAssoc();
        if ($last['authProvider']) {
            if (($last['authProvider'])[0] == "X")
                $last['authProvider'] = substr($last['authProvider'], 1);
            $letters = preg_replace('/[^a-zA-Z]/', '', $last['authProvider']); // "abcdef"

            // Extract only numbers
            $numbers = (int) preg_replace('/[^0-9]/', '', $last['authProvider']); // "123456"
            $numbers++;
            $nyfolder = $letters . $numbers;
        } else
            $nyfolder = 'reg100001';

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'SHOW DATABASES LIKE "' . $nyfolder . '";';
        $db->setQuery((string) $sql);
        $last = $db->loadAssoc();
        if ($last)
            return $nyfolder;






        // siden vilkårlig bruker er pålogget, må root-bruker brukes for å opprette ny database

        $servername1 = "localhost";
        $username1 = "root";
        $password1 = ""; // your MySQL password
        // Create connection
        $conn = new mysqli($servername1, $username1, $password1);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }


        // $sql = "DROP DATABASE IF EXISTS  " . $nyfolder . ";";
        // if ($conn->query($sql) === TRUE) {
        //     echo "Database created successfully<br>";
        // } else {
        //     echo "Error creating database: ".$conn->error . '<br>';
        // }


        $sql = "CREATE DATABASE " . $nyfolder . ";";
        if ($conn->query($sql) === TRUE) {
            echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }

        // Grant privileges to the new database
        $sql = 'GRANT ALL PRIVILEGES ON ' . $nyfolder . '.* TO "' . $username . '"@"%";';  //  IDENTIFIED BY "230751";';
        if ($conn->query($sql) === TRUE) {
            echo "grant successfull " . $nyfolder . "<br>";
        } else {
            echo "Error granting privileges " . $nyfolder . " " . $conn->error . '<br>';
        }

        return $nyfolder;  // returnerer ny klient, oppdatert klientliste og opprettet en tom database
    }
    function opprett_klient1($array)
    {
        if (!$array)
            return; // Check if the array is empty or not set
        //     $a = $array->ID;
        // $b = $array->ID;
        $array_bk = $array;
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_klienter order by idref desc limit 1';
        $db->setQuery((string) $sql);
        try {
            $array = $db->loadAssoc(); // Returns 
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        }
        if (!$array)  // $array er null dersom ingen poster finnes i klienter. Ellers lik oppsettarray
        {
            $brukernavn = $array_bk["brukernavn"];
            $passord = $array_bk["passord"];

            /*  Hvis ikke første post finnes, legges ny post i registeret. Egentlig skal dette gjøres i installasjonsprosedyren*/
            $sql = 'insert into qo7sn_regn_klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name,idref) values (1,"test","test","test","reg100001","123456780","test@test.com","reg100001","reg100001")';
            $db->setQuery((string) $sql);
            try {
                $db->execute(); // Returns
                $array = ["idref" => "reg100001", "ID" => 1, "firma" => "test", "brukernavn" => $brukernavn, "telefon" => "123456780", "epost" => "test@test.com", "passord" => $passord];
                //     $this->opprett_klient($array);

            } catch (Exception $e) {
                echo 'Error inserting row: ' . $e->getMessage() . '<br>';
            }
        }


        // $array->brukernavn = $array_bk->brukernavn;
        // $array->passord = $array_bk->passord;

        $letters = preg_replace('/[^a-zA-Z]/', '', $array["idref"]); // "abcdef"

        // Extract only numbers
        $numbers = (int) preg_replace('/[^0-9]/', '', $array["idref"]); // "123456"
        $numbers++;
        $nyfolder = $letters . $numbers;
        $array["idref"] = $nyfolder;
        $array["folder_name"] = $nyfolder;
        // echo 'nyfolder: |' . $nyfolder . '|<br>';   
        //  $input = Factory::getApplication()->input;
        //  $nr = $input->get('nr', 0);
        //       $sql = insert into qo7sn_regn_klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
        $sql = 'insert into qo7sn_regn_klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
            . 'values ("' . $array["idref"] . '","' . $array["firma"] . '","' . $array["folder_name"] . '","' . $array_bk["brukernavn"] . '","' . $array["telefon"] . '","' . $array["epost"] . '","' . $array_bk["passord"] . '");';

        $db->setQuery((string) $sql);
        try {
            $db->execute(); // Returns 
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        }

        $servername = "localhost";
        $username = "root";
        $password = ""; // your MySQL password


        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create database
        $sql = "CREATE DATABASE " . $array["idref"] . ";";
        if ($conn->query($sql) === TRUE) {
            //      echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }

        // Use the newly created database
        $sql = "USE " . $array["idref"] . ";";
        if ($conn->query($sql) === TRUE) {
            //            echo "use ". $array['idref']."<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }

        // Grant privileges to the new database
        $sql = "GRANT ALL PRIVILEGES ON " . $array["idref"] . ".* TO 'admin'@'%'";
        //  $sql = "GRANT ALL PRIVILEGES ON * TO 'admin'@'%' IDENTIFIED BY '230751';";
        if ($conn->query($sql) === TRUE) {
            //          echo "grant successfull " . $array['idref'] . "<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }


        // use the test database
        $sql = "USE test ;";
        if ($conn->query($sql) === TRUE) {
            //         echo "use  test <br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }


        //
        //  system('mysql -u root -p < e:\sql\mal.sql');
        // $output = shell_exec('cd e:\xampp');
        // $r="mysql\bin\mysqld -uadmin -p230751 " . $array['idref'] . " < e:\sql\mal.sql";
        // $output = shell_exec($r);
        // echo "<pre>$output</pre>";
        return $array;   // returnerer ny klient, oppdatert klientliste og opprettet en tom database
    }

    function opprett_klient_bk($array)
    {
        if (!$array)
            return; // Check if the array is empty or not set
        //     $a = $array->ID;
        // $b = $array->ID;
        $array_bk = $array;
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_regn_klienter order by idref desc limit 1';
        $db->setQuery((string) $sql);
        try {
            $array = $db->loadAssoc(); // Returns 
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        }
        if (!$array)  // $array er null dersom ingen poster finnes i klienter. Ellers lik oppsettarray
        {
            $brukernavn = $array_bk["brukernavn"];
            $passord = $array_bk["passord"];

            /*  Hvis ikke første post finnes, legges ny post i registeret. Egentlig skal dette gjøres i installasjonsprosedyren*/
            $sql = 'insert into qo7sn_regn_klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name,idref) values (1,"test","test","test","reg100001","123456780","test@test.com","reg100001","reg100001")';
            $db->setQuery((string) $sql);
            try {
                $db->execute(); // Returns
                $array = ["idref" => "reg100001", "ID" => 1, "firma" => "test", "brukernavn" => $brukernavn, "telefon" => "123456780", "epost" => "test@test.com", "passord" => $passord];
                //     $this->opprett_klient($array);

            } catch (Exception $e) {
                echo 'Error inserting row: ' . $e->getMessage() . '<br>';
            }
        }


        // $array->brukernavn = $array_bk->brukernavn;
        // $array->passord = $array_bk->passord;

        $letters = preg_replace('/[^a-zA-Z]/', '', $array["idref"]); // "abcdef"

        // Extract only numbers
        $numbers = (int) preg_replace('/[^0-9]/', '', $array["idref"]); // "123456"
        $numbers++;
        $nyfolder = $letters . $numbers;
        $array["idref"] = $nyfolder;
        $array["folder_name"] = $nyfolder;
        // echo 'nyfolder: |' . $nyfolder . '|<br>';   
        //  $input = Factory::getApplication()->input;
        //  $nr = $input->get('nr', 0);
        //       $sql = insert into qo7sn_regn_klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
        $sql = 'insert into qo7sn_regn_klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
            . 'values ("' . $array["idref"] . '","' . $array["firma"] . '","' . $array["folder_name"] . '","' . $array_bk["brukernavn"] . '","' . $array["telefon"] . '","' . $array["epost"] . '","' . $array_bk["passord"] . '");';

        $db->setQuery((string) $sql);
        try {
            $db->execute(); // Returns 
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        }

        $servername = "localhost";
        $username = "root";
        $password = ""; // your MySQL password


        // Create connection
        $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Create database
        $sql = "CREATE DATABASE " . $array["idref"] . ";";
        if ($conn->query($sql) === TRUE) {
            //      echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }

        // Use the newly created database
        $sql = "USE " . $array["idref"] . ";";
        if ($conn->query($sql) === TRUE) {
            //            echo "use ". $array['idref']."<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }

        // Grant privileges to the new database
        $sql = "GRANT ALL PRIVILEGES ON " . $array["idref"] . ".* TO 'admin'@'%'";
        //  $sql = "GRANT ALL PRIVILEGES ON * TO 'admin'@'%' IDENTIFIED BY '230751';";
        if ($conn->query($sql) === TRUE) {
            //          echo "grant successfull " . $array['idref'] . "<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }


        // use the test database
        $sql = "USE test ;";
        if ($conn->query($sql) === TRUE) {
            //         echo "use  test <br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }


        //
        //  system('mysql -u root -p < e:\sql\mal.sql');
        // $output = shell_exec('cd e:\xampp');
        // $r="mysql\bin\mysqld -uadmin -p230751 " . $array['idref'] . " < e:\sql\mal.sql";
        // $output = shell_exec($r);
        // echo "<pre>$output</pre>";
        return $array;   // returnerer ny klient, oppdatert klientliste og opprettet en tom database
    }

    function hent_mal($database, $fil)
    {
        $servername = "localhost";
        $username = "root";
        $password = ""; // your MySQL password

        // Create connection
        $conn = new mysqli($servername, $username, $password);
        // copy content of mal.sql to the new database
        $targetDbName = $database; //$array->idref; // The database you want to import into
        $dir = 'c:/sql/klientmaler/';
        echo 'dir: ' . $dir . '<br>';
        $sqlFilePath = $dir . $fil; //"e:\sql\mal1.sql"; // Path to your SQL file

        // Create connection
        //  $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Select the target database
        $conn->select_db($targetDbName);

        // Read the entire SQL file
        $sql = file_get_contents($sqlFilePath);
        if ($sql === false) {
            die("Error reading SQL file.");
        }

        // Execute the SQL commands
        if ($conn->multi_query($sql)) {
            do {
                // Store first result set
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());
            //  echo "SQL file imported successfully!";
        } else {
            echo "Error importing SQL file: " . $conn->error;
        }

        // $conn->close();




        // // use the test database
        // $sql = "USE test ;";
        // if ($conn->query($sql) === TRUE) {
        //     //       echo "use  test <br>";
        // } else {
        //     echo "Error creating database: " . $conn->error . '<br>';
        // }


        // // Update the firma name in the new database
        // $db = Factory::getDbo();
        // $sql = $db->getQuery(true);
        // $sql = "update " . $array['folder_name'] . ".qo7sn_regn_firma set Firmanavn='" . $array['firma'] . "',epost='"
        //     . $array['epost'] . "',brukernavn='" . $array['brukernavn'] . "',telefon='" . $array['telefon'] . "',passord='" . $array['passord'] . "';";
        // $db->setQuery((string) $sql);
        // try {
        //     $firma = $db->execute();
        //     return $array['folder_name'];
        // } catch (Exception $e) {
        //     echo "Error loading object list: " . $e->getMessage();
        // }




        //   echo 'Klient opprettet: ' . $array->idref . '      ' . $array->folder_name . '<br>';




        //  JFactory::getApplication()->close();
    }
    function hent_mal1($array, $fil)
    {
        $servername = "localhost";
        $username = "root";
        $password = ""; // your MySQL password

        // Create connection
        $conn = new mysqli($servername, $username, $password);
        // copy content of mal.sql to the new database
        // $targetDbName = $array['folder_name']; //$array->idref; // The database you want to import into
        // $sqlFilePath = $fil; //"e:\sql\mal1.sql"; // Path to your SQL file

        $targetDbName = $array['folder_name']; //$array->idref; // The database you want to import into
        $dir = 'e:/sql/klientmaler/';
        $sqlFilePath = $dir . $fil; //"e:\sql\mal1.sql"; // Path to your SQL file

        // Create connection
        //  $conn = new mysqli($servername, $username, $password);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Select the target database
        $conn->select_db($targetDbName);

        // Read the entire SQL file
        $sql = file_get_contents($sqlFilePath);
        if ($sql === false) {
            die("Error reading SQL file.");
        }

        // Execute the SQL commands
        if ($conn->multi_query($sql)) {
            do {
                // Store first result set
                if ($result = $conn->store_result()) {
                    $result->free();
                }
            } while ($conn->more_results() && $conn->next_result());
            //  echo "SQL file imported successfully!";
        } else {
            echo "Error importing SQL file: " . $conn->error;
        }

        // $conn->close();




        // use the test database
        $sql = "USE test ;";
        if ($conn->query($sql) === TRUE) {
            //       echo "use  test <br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }


        // Update the firma name in the new database
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = "update " . $array['folder_name'] . ".qo7sn_regn_firma set Firmanavn='" . $array['firma'] . "',epost='"
            . $array['epost'] . "',brukernavn='" . $array['brukernavn'] . "',telefon='" . $array['telefon'] . "',passord='" . $array['passord'] . "';";
        $db->setQuery((string) $sql);
        try {
            $firma = $db->execute();
        } catch (Exception $e) {
            echo "Error loading object list: " . $e->getMessage();
        }




        //   echo 'Klient opprettet: ' . $array->idref . '      ' . $array->folder_name . '<br>';




        //  JFactory::getApplication()->close();
    }

    function scann_klienter()
    {
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'TRUNCATE TABLE qo7sn_regn_klienter;';
        $db->setQuery((string) $sql);
        try {
            $firma = $db->execute();
        } catch (Exception $e) {
            echo "Error loading object list: " . $e->getMessage();
        }

        // Path to scan (change to your database folder path)
        $baseDir = "E:\\xampp\\mysql\\data";

        // Scan directory for subfolders starting with "reg"
        $folders = scandir($baseDir);
        foreach ($folders as $folder) {
            $fullPath = $baseDir . DIRECTORY_SEPARATOR . $folder;

            // Only directories, starting with "reg", and not "." or ".."
            if (is_dir($fullPath) && preg_match('/^reg/i', $folder) && $folder !== '.' && $folder !== '..') {

                // Prepare insert to avoid duplicates (optional)
                // $stmt = $conn->prepare("INSERT IGNORE INTO folders (folder_name) VALUES (?)");
                // $stmt->bind_param("s", $folder);
                // $stmt->execute();

                $sql = "INSERT IGNORE INTO qo7sn_regn_klienter (folder_name) VALUES ('" . $folder . "');";
                $db->setQuery((string) $sql);
                try {
                    $ret = $db->execute();
                } catch (Exception $e) {
                    echo "Error loading object list: " . $e->getMessage() . '<br>';
                }
                ;

                // $sql = $db->getQuery(true);
                // $sql = "USE " . $folder . "; GRANT ALL ON * TO 'admin'@'%' IDENTIFIED BY '230751';";
                // $db->setQuery((string) $sql);
                // try {
                //     $ret = $db->execute();
                // } catch (Exception $e) {
                //     echo "Error loading object list: " . $e->getMessage();
                // }
                // ;

                // $sql = $db->getQuery(true);
                // $sql = "GRANT ALL PRIVILEGES ON  " . $folder . ".* TO 'admin'@'%' identified by '230751';"; //FLUSH PRIVILEGES;;";
                // $db->setQuery((string) $sql);
                // try {
                //     $firma = $db->execute();
                // } catch (Exception $e) {
                //     echo "Error loading object list: " . $e->getMessage().'<br>';
                // }





                $sql = $db->getQuery(true);
                $sql = "select * from  " . $folder . ".qo7sn_regn_firma;";
                $db->setQuery((string) $sql);
                try {
                    $firma = $db->loadObject();
                } catch (Exception $e) {
                    echo "Error loading object list: " . $e->getMessage() . '<br>';
                }
                echo $firma->Firmanavn . '<br>';
                $sql = $db->getQuery(true);
                $sql = 'update qo7sn_regn_klienter set firma="' . $firma->Firmanavn . '", telefon="' . $firma->telefon . '" , epost="' . $firma->epost . '" where folder_name="' . $folder . '";';  //.$folder.'"';
                $db->setQuery((string) $sql);
                try {
                    $ret = $db->execute();
                } catch (Exception $e) {
                    echo "Error loading object list: " . $e->getMessage() . '<br>';
                }


                // $r = $db->close();
                // if ($r) {
                //     echo "Database connection closed successfully.<br>";
                // } else {
                //     echo "Error closing database connection.<br>";
                // }


                // $stmt = $conn->prepare('update folders set navn="hh" where folder_name="reg00011"');
                // //$stmt->bind_param("s", $folder);
                // $stmt->execute();
                // $stmt->close();
            }
        }
    }
    function hent_firma()
    {
        $model = new RegnModelKlienter;
        $database = $model->get_database();

        //   return null;
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_firma;';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadAssoc();
            if ($ret)
                return $ret;
            else
                return null;
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }
    }
    function oppdater_firma($firma)
    {
        $model = new RegnModelKlienter;
        $database = $model->get_database();
        //   return null;
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'update ' . $database . 'qo7sn_regn_firma set Firmanavn="' . $firma->firmanavn . '",'
            . ' Postnr="' . $firma->postnr . '", Poststed="' . $firma->poststed . '", regnskapsar="' . $firma->regnskapsar . '",'
            . ' epost="' . $firma->epost . '", Telefon="' . $firma->telefon . '", Adresse="' . $firma->adresse . '", '
            . ' kontaktperson="' . $firma->kontaktperson . '";';

        //     . ', regnskapsar="' . $firma->regnskapsar . '", orgnr="' . $firma->orgnr . '", epost="' . $firma->epost . '", '
        //     . 'telefon="' . $firma->telefon . '", adresse="' . $firma->adresse . '", postnr="' . $firma->postnr . '", '
        //     . 'poststed="' . $firma->poststed . '", kontonr="' . $firma->kontonr . '", '
        //     . 'faktura_tekst="' . $firma->faktura_tekst . '", faktura_ekstra="' . $firma->faktura_ekstra . '", '
        //     . 'faktura_mva="' . $firma->faktura_mva . '", faktura_kundeinfo="' . $firma->faktura_kundeinfo . '", '
        //     . 'faktura_levinfo="' . $firma->faktura_levinfo . '", faktura_varelinjer="' . $firma->faktura_varelinjer . '", '
        //     . 'faktura_tekst_bunn="' . $firma->faktura_ tekst_bunn . '", faktura_egenref="' . $firma->faktura_egenref . '", '
        //     . 'faktura_lev_egenref="' . $firma->faktura ->lev_egenref . '", faktura_lev_mva="' . $firma->faktura_lev_mva . '";';
        // //  . ' where ID=1;';           
        $db->setQuery((string) $sql);
        try {
            $ret = $db->execute();

        } catch (Exception $e) {
            echo 'Error oppdater firmareg: ' . $e->getMessage() . '<br>';
        }

        $sql = $db->getQuery(true);
        $sql = 'update qo7sn_users set name="' . $firma->firmanavn . '", email="' . $firma->epost . '" where username="' . $firma->brukernavn . '";';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->execute();
        } catch (Exception $e) {
            echo 'Error oppdater firmareg: ' . $e->getMessage() . '<br>';
        }


    }


    function kontoer($mode)
    {
        $user = JFactory::getUser();
        $username = $user->username;
        $database = $user->authProvider;
        if ($database[0] == "X")
            $database = substr($database, 1);
        else if ($database[0] == "$")
            $database = substr($database, 1);
        $database = $database . '.';
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . 'qo7sn_regn_kto where ResBal="B" order by Ktonr;';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadAssocList();
            if ($ret)
                return $ret;
            else
                return null;
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }
    }
    function oppdater_user($user)
    {
        $model = new RegnModelKlienter;
        $database = $model->get_database();
        //$model->oppdater_user($user);
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'update qo7sn_users  set authProvider="' . $user->authProvider . '" where username="' . $user->username . '";';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->execute(true);
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }

        // $sql = $db->getQuery(true);
        // $sql = 'select * from qo7sn_users;';
        // $db->setQuery((string) $sql);
        // try {
        //     $users = $db->loadAssoclist();
        // } catch (Exception $e) {
        //     echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        // }

        // $sql = $db->getQuery(true);
        // $sql = 'select * from qo7sn_regn_firma;';
        // $db->setQuery((string) $sql);
        // try {
        //     $firmadata = $db->loadAssoclist();
        // } catch (Exception $e) {
        //     echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        // }
        // name,username,email,password,authProvider
        $sql = $db->getQuery(true);
        //       $sql = 'update '.$database.'qo7sn_regn_firma a INNER JOIN qo7sn_users b  SET a.Firmanavn=b.name,a.epost=b.email,a.kontaktperson=b.username;
        $sql = 'update ' . $database . 'qo7sn_regn_firma   SET Firmanavn="' . $user->name . '", epost= "' . $user->email . '", kontaktperson="' . $user->username . '";';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->execute();
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }


        $sql = $db->getQuery(true);
        $sql = 'SELECT * FROM qo7sn_regn_klienter WHERE folder_name="reg100001";';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadAssocList();
        } catch (Exception $e) {
            echo 'Error fetching row: ' . $e->getMessage() . '<br>';
        }
        if (!$ret) {
            $sql = $db->getQuery(true);
            $sql = 'insert into qo7sn_regn_klienter  (firma,epost,telefon,folder_name,brukernavn) values '
                . '("' . $user->name . '","' . $user->email . '","12345","' . $user->authProvider . '","' . $user->username . '");';
            $db->setQuery((string) $sql);
            try {
                $ret = $db->execute();
            } catch (Exception $e) {
                echo 'Error fetching row: ' . $e->getMessage() . '<br>';
            }
        } else {
            $sql = $db->getQuery(true);
            //    $sql = 'update qo7sn_regn_klienter a inner join  set firma="' . $user->name . '", epost="' . $user->email . '", telefon= "' . $database . 'qo7sn_regn_firma.telefon ;';
            $sql = 'update qo7sn_regn_klienter a INNER JOIN  reg100001.qo7sn_regn_firma b set a.firma="' . $user->name . '", a.epost="' . $user->email . '", a.telefon= b.telefon ;';
            $db->setQuery((string) $sql);
            try {
                $ret = $db->execute();
            } catch (Exception $e) {
                echo 'Error fetching row: ' . $e->getMessage() . '<br>';
            }
        }


    }

    function hent_database($user)
    {
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





    function lag_balansesaldo($ar)
    {
        $model = new RegnModelKlienter;
        $database = $model->get_database();

        // henter henter transer for saldo
        $db = Factory::getDbo();
        //Henter transer for saldo 
   

        $sql = $db->getQuery(true);
        $sql = 'SELECT * FROM  ' . $database . 'qo7sn_regn_trans WHERE Buntnr=0 AND bilagsart=0 AND Dato LIKE "' . $ar . '-01-01";';
        $db->setQuery((string) $sql);
        try {
            $transer = $db->loadAssocList();
        } catch (Exception $e) {
            echo 'Error fetching transer: ' . $e->getMessage() . '<br>';
        }
        if ($transer)
            return;

        //henter transer fra hist historikken

        $sql = $db->getQuery(true);
        $sql = 'SELECT * FROM  ' . $database . 'qo7sn_regn_hist WHERE  bilagsart=0 AND Dato LIKE "' . $ar . '-01-01";';
        $db->setQuery((string) $sql);
        try {
            $histtranser = $db->loadAssocList();
        } catch (Exception $e) {
            echo 'Error fetching ref: ' . $e->getMessage() . '<br>';
        }


        if (!$histtranser)
            return;

        //henter neste refnr fra trans
        $sql = 'SELECT ref FROM  ' . $database . 'qo7sn_regn_trans order by ref desc limit 1;';
        $db->setQuery((string) $sql);
        try {
            $ref = $db->loadResult();
        } catch (Exception $e) {
            echo 'Error fetching refnr: ' . $e->getMessage() . '<br>';
        }

        if (!$ref)
            $ref = 0;
   
     
     //Setter in nye banaseposter fra historikken i trans
        foreach ($histtranser as $trans) {
            $ref++;
            //  $buntnr++;

            $sql = $db->getQuery(true);
            $sql = 'insert into ' . $database . 'qo7sn_regn_trans (Ref,Buntnr,Bilagsart,Dato,debet,kredit,belop,Tekst) values ('
                . $ref . ',0,0,"' . $trans['Dato'] . '",' . $trans['debet'] . ',' . $trans['kredit'] . ',' . $trans['belop'] . ',"' . $trans['Tekst'] . '");';
            $db->setQuery((string) $sql);
            try {
                $res = $db->execute();
            } catch (Exception $e) {
                echo 'Error fetching insert hist: ' . $e->getMessage() . '<br>';
            }
        }
            $sql = $db->getQuery(true);
            $sql = 'delete from ' . $database . 'qo7sn_regn_hist WHERE  bilagsart=0 AND Dato LIKE "' . $ar . '-01-01";';
            $db->setQuery((string) $sql);
            try {
                $result = $db->execute();
            } catch (Exception $e) {
                echo 'Error delete trans: ' . $e->getMessage() . '<br>';
            }

        




        //Sletter gamle saldoposter i historikken for årstallet
        $sql = $db->getQuery(true);
        $sql = 'delete  from ' . $database . 'qo7sn_regn_hist where bilagsart=0 AND Dato LIKE "' . $ar . '-01-01";';
        $db->setQuery((string) $sql);
        try {
            $res = $db->execute();
        } catch (Exception $e) {
            echo 'Error fetching slett hist balanse: ' . $e->getMessage() . '<br>';
        }


        // echo 'ferdig';
    }

}
