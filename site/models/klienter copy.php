<?php

use Joomla\CMS\MVC\Model\ListModel;
use Joomla\CMS\Factory;
//global $db;$db = Factory::getDbo();



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

    function oppdater_klient($res)
    {
        if (!$res)
            return; // Check if the array is empty or not set

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'UPDATE klienter SET ';
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
            return   $db->loadAssoc;
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
    //     //       $sql = insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
    //     $sql = 'insert into klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
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

    //     $sql = "update klienter set firma='" . $firma . "', telefon='" . $telefon . "', epost='" . $epost . "' where brukernavn='" . $bruker . "' and passord='" . $passw . "'";
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
        $sql = 'select * from klienter where brukernavn = ' . $db->quote($bruker) . ' and passord = ' . $db->quote($password);
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
        $sql = 'select * from klienter where folder_name = ' . $db->quote($base);
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
        $sql = 'select * from klienter';
        $db->setQuery((string) $sql);
        try {
            $ret = $db->loadObjectlist();
            if ($ret)
                return $ret;
            // else { /*  Hvis ikke første post finnes, legges ny post i registeret. Egentlig skal dette gjøres i installasjonsprosedyren*/
            //     $sql = 'insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name) values (1,"test","test","test","regn100001","123456780","test@test.com","regn100001")';
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

        // if (!$array)
        //     return; // Check if the array is empty or not set
        //     $a = $array->ID;
        // $b = $array->ID;
        // $array_bk = $array;
        // $db = Factory::getDbo();
        // $sql = $db->getQuery(true);
        // $sql = 'select * from klienter order by idref desc limit 1';
        // $db->setQuery((string) $sql);
        // try {
        //     $array = $db->loadAssoc(); // Returns 
        // } catch (Exception $e) {
        //     echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        // }
        // if (!$array)  // $array er null dersom ingen poster finnes i klienter. Ellers lik oppsettarray
        // {
        //     $brukernavn = $array_bk["brukernavn"];
        //     $passord = $array_bk["passord"];

        //     /*  Hvis ikke første post finnes, legges ny post i registeret. Egentlig skal dette gjøres i installasjonsprosedyren*/
        //     $sql = 'insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name,idref) values (1,"test","test","test","reg100001","123456780","test@test.com","reg100001","reg100001")';
        //     $db->setQuery((string) $sql);
        //     try {
        //         $db->execute(); // Returns
        //         $array = ["idref" => "reg100001", "ID" => 1, "firma" => "test", "brukernavn" => $brukernavn, "telefon" => "123456780", "epost" => "test@test.com", "passord" => $passord];
        //         //     $this->opprett_klient($array);

        //     } catch (Exception $e) {
        //         echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        //     }
        // }
        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from qo7sn_users order by authProvider desc limit 1';
        $db->setQuery((string) $sql);
        $last = $db->loadAssoc();
        if ($last['authProvider']) {

            // $array->brukernavn = $array_bk->brukernavn;
            // $array->passord = $array_bk->passord;

            $letters = preg_replace('/[^a-zA-Z]/', '', $last['authProvider']); // "abcdef"

            // Extract only numbers
            $numbers = (int) preg_replace('/[^0-9]/', '', $last['authProvider']); // "123456"
            $numbers++;
            $nyfolder = $letters . $numbers;
        } else
            $nyfolder = 'reg100001';

        // $array["idref"] = $nyfolder;
        // $array["folder_name"] = $nyfolder;
        // $array["brukernavn"] = $array_bk["brukernavn"];
        // // echo 'nyfolder: |' . $nyfolder . '|<br>';   
        // //  $input = Factory::getApplication()->input;
        // //  $nr = $input->get('nr', 0);
        // //       $sql = insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
        // $sql = 'insert into klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
        //     . 'values ("' . $array["idref"] . '","' . $array["firma"] . '","' . $array["folder_name"] . '","' . $array_bk["brukernavn"] . '","' . $array["telefon"] . '","' . $array["epost"] . '","' . $array_bk["passord"] . '");';

        // $db->setQuery((string) $sql);
        // try {
        //     $db->execute(); // Returns 
        // } catch (Exception $e) {
        //     echo 'Error inserting row: ' . $e->getMessage() . '<br>';
        // }

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
        // $sql = $db->getQuery(true);
        // $sql = "CREATE DATABASE " . $nyfolder . ";";
        // $db->setQuery((string) $sql);

        // try {
        //     $ret = $db->execute();
        //     if ($ret)
        //         return $ret;
        //     else
        //         return null;
        // } catch (Exception $e) {
        //     echo 'Error create database: ' . $e->getMessage() . '<br>';
        // }
        $sql = "CREATE DATABASE " . $nyfolder . ";";

        if ($conn->query($sql) === TRUE) {
            //      echo "Database created successfully<br>";
        } else {
            echo "Error creating database: " . $conn->error . '<br>';
        }

        // // Use the newly created database
        // $sql = "USE " . $array["idref"] . ";";
        // if ($conn->query($sql) === TRUE) {
        //     echo "use " . $array['idref'] . "<br>";
        // } else {
        //     echo "Error creating database: " . $conn->error . '<br>';
        // }



        //         // use the test database
        //         $sql = "USE test ;";
        //         if ($conn->query($sql) === TRUE) {
        //    //         echo "use  test <br>";
        //         } else {
        //             echo "Error creating database: " . $conn->error . '<br>';
        //         }




            // Grant privileges to the new database
          $sql = "GRANT ALL PRIVILEGES ON " . $username . ".* TO 'admin'@'%' IDENTIFIED BY '230751';";
            // $sql = "GRANT ALL PRIVILEGES ON * TO 'admin'@'%'";
        //    $sql = "GRANT ALL PRIVILEGES ON * TO 'admin'@'%' IDENTIFIED BY '230751';";
            if ($conn->query($sql) === TRUE) {
                echo "grant successfull " . $username . "<br>";
            } else {
                echo "Error granting privileges " . $username . " " . $conn->error . '<br>';
            }


        // $sql = $db->getQuery(true);
        // $sql = "GRANT ALL PRIVILEGES ON " . $array["idref"] . ".* TO 'admin'@'%';"; // IDENTIFIED BY '230751';
        // // $sql = "GRANT ALL PRIVILEGES ON * TO 'admin'@'%' IDENTIFIED BY '230751';";
        // $db->setQuery((string) $sql);
        // try {
        //     $db->execute();
        //     //    return 'Bruker oppdatert';
        // } catch (Exception $e) {
        //     echo 'Error granting privileges: ' . $e->getMessage() . '<br>';
        // }



        // $sql = $db->getQuery(true);
        // $sql = "USE test ;";
        // $db->setQuery((string) $sql);
        // try {
        //     $db->execute();
        //     //     return 'Bruker oppdatert';
        // } catch (Exception $e) {
        //     echo 'Error granting privileges: ' . $e->getMessage() . '<br>';
        // }




        //
        //  system('mysql -u root -p < e:\sql\mal.sql');
        // $output = shell_exec('cd e:\xampp');
        // $r="mysql\bin\mysqld -uadmin -p230751 " . $array['idref'] . " < e:\sql\mal.sql";
        // $output = shell_exec($r);
        // echo "<pre>$output</pre>";
        return  $nyfolder   // returnerer ny klient, oppdatert klientliste og opprettet en tom database
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
        $sql = 'select * from klienter order by idref desc limit 1';
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
            $sql = 'insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name,idref) values (1,"test","test","test","reg100001","123456780","test@test.com","reg100001","reg100001")';
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
        //       $sql = insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
        $sql = 'insert into klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
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
        $sql = 'select * from klienter order by idref desc limit 1';
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
            $sql = 'insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost,folder_name,idref) values (1,"test","test","test","reg100001","123456780","test@test.com","reg100001","reg100001")';
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
        //       $sql = insert into klienter (ID,fornavn,etternavn,firma,brukernavn,telefon,epost)  '.$array['ID'].';';  
        $sql = 'insert into klienter (idref,firma,folder_name,brukernavn,telefon,epost,passord) '
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

    function hent_mal($array, $fil)
    {

        $servername = "localhost";
        $username = "root";
        $password = ""; // your MySQL password


        // Create connection
        $conn = new mysqli($servername, $username, $password);
        // copy content of mal.sql to the new database
        $targetDbName = $array['folder_name']; //$array->idref; // The database you want to import into
        $dir = 'c:/sql/klientmaler/';
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
            return $array['folder_name'];
        } catch (Exception $e) {
            echo "Error loading object list: " . $e->getMessage();
        }




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
        $sql = 'TRUNCATE TABLE klienter;';
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

                $sql = "INSERT IGNORE INTO klienter (folder_name) VALUES ('" . $folder . "');";
                $db->setQuery((string) $sql);
                try {
                    $ret = $db->execute();
                } catch (Exception $e) {
                    echo "Error loading object list: " . $e->getMessage() . '<br>';
                };

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
                $sql = 'update klienter set firma="' . $firma->Firmanavn . '", telefon="' . $firma->telefon . '" , epost="' . $firma->epost . '" where folder_name="' . $folder . '";';  //.$folder.'"';
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

    function hent_firma($database)
    {
        //   return null;

        $db = Factory::getDbo();
        $sql = $db->getQuery(true);
        $sql = 'select * from ' . $database . '.qo7sn_regn_firma;';
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
}
