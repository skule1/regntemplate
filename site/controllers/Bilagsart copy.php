<?php
defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

class RegnControllerBilagsart extends BaseController
{
      public function oppd() 
        {
          echo 'oppd subcontroller bilagsart   ';

            $db = Factory::getDbo();
            $query = $db->getQuery(true);
            $input = Factory::getApplication()->input;
            $id = $input->get('id', 0);
            $navn = $input->get('navn', 0);
            $val = $input->get('val', 0);

            $query= 'update #__regn_bilagsarter set '.$navn.'="'.$val.'" where id='.$id.';';

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
        echo 'f_slett subcontroller bilagsart     ';
        //           JFactory::getApplication()->close();
        $db = Factory::getDbo();
        $input = Factory::getApplication()->input;
        $id = $input->getString('id', '');
        $a = $input->getString('a', '');
        echo '  id: ' . $id;
        echo '  a: ' . $a;
        $id = $input->getString('id', '');
        $sql = 'DELETE FROM #__regn_bilagsarter WHERE id=' . $id . ';';
        echo 'sql: ' . $sql . '<br>';
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


    public function oppdater()
    {
        echo 'oppdater subcontroller bilagsart    ';
        // JFactory::getApplication()->close();
        // return;
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
        $query = 'select count(*) from #__regn_bilagsarter where id=' . $art . ';';
        $db->setQuery($query);
        $res = $db->execute();
        echo '$query1  ' . $query . '<br>res: ' . $res . '<br>';
        // Reset the query using our newly populated query object.
        $query = 'insert into  #__regn_bilagsarter ( id,beskrivelse,dato,debet,kredit,belop,tekst) ' .
            ' value ("' . $art . '","' . $beskrivelse . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","' . $tekst . '");';

        echo '$query' . $query . '<br>';

        $db->setQuery($query);
        try {
            $result = $db->execute();
            echo json_encode($result);
            echo 'Row inserted successfully!';
        } catch (Exception $e) {
            echo 'Error inserting row: ' . $e->getMessage();
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

        JFactory::getApplication()->close();
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
}
