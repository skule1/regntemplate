<?php
defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerKlienter extends BaseController
{


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


}