<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;

//class AbcController extends BaseController
class RegnControllerAbc extends BaseController
{


    // public function display($cachable = false, $urlparams = array())
    // {
    //     // Logic for the subcontroller
    //     // Default view
    //     $viewName = $this->input->get('view', 'defaultviewname');
    //     $this->input->set('view', $viewName);
    //     echo 'display controllers ';
    //     parent::display($cachable, $urlparams);
    // }

    public function display($cachable = false, $urlparams = [])
    {
        echo 'display views/abc<bt>';
        // $this->input->set('view', 'abc');
        // parent::display($cachable, $urlparams);
    }

    public function add()
    {
        // Logic to add an item
     echo 'add   subcontroller abc ';
        $responseData = 'add   subcontroller abc ';
        echo new JsonResponse($responseData);
        Factory::getApplication()->close();
        //   $this->setRedirect('index.php?option=com_regn&view=abc&layout=edit');
    }

    // Method to save an item
    public function save()
    {
        // Logic to save the item (interact with a model, for example)
        $this->setRedirect('index.php?option=com_regn&view=abc', 'Item saved!');
    }


    public function handleAjax()
    {
        // Get the input from the AJAX request
        $input = Factory::getApplication()->input;
        $param1 = $input->getString('param1', '');
        $param2 = $input->getString('param2', '');

        // Process the data as necessary
        $processedData = 'Received param1 CONTROLLERS: ' . $param1 . ', param2: ' . $param2;

        // Prepare the response data
        $responseData = array(
            'data' => $processedData
        );

        // Send a JSON response back to the client
        echo new JsonResponse($responseData);
        //  echo json_encode($responseData);
        // Stop further execution to prevent Joomla from rendering the full page
        Factory::getApplication()->close();
    }

    public function getData()
    {
        $responseData = 'getData   subcontroller abc ';
        echo new JsonResponse($responseData);
        Factory::getApplication()->close();
    //     echo 'getData in subcontrollers abc';
         Factory::getApplication()->close();
        // return;
return;


        $db = Factory::getDbo();
        $query = $db->getQuery(true);

        // $columns = ['id', 'beskrivelse', 'dato'];
        // $values = [$db->quote('20'), $db->quote('test'), $db->quote('2022-05-05')];

        // $query
        //     ->insert($db->quoteName('#__regn_bilagsarter'))
        //     ->columns($db->quoteName($columns))
        //     ->values(implode(',', $values));



















        $input = Factory::getApplication()->input;

        // $db = Factory::getDbo();
     
        $art = $input->getString('art', '');
        $beskrivelse = $input->getString('beskrivelse', '');
        $dato = $input->getString('dato', '');
        $debet = $input->getString('debet', '');
        $kredit = $input->getString('kredit', '');
        $belop = $input->getString('belop', '');
        $tekst = $input->getString('tekst', '');
  //      if ($dato='')  
       //  $dato = '0000-00-00';

        $query = $db->getQuery(true);
         $query = 'select count(*) from #__regn_bilagsarter where id='.$art.';';
        // $query = $db
        //     ->getQuery(true)
        //     ->select('COUNT(*)')
        //     ->from($db->quoteName('#__regn_bilagsarter'));
        //     ->where($db->quoteName('name') . " = " . $db->quote($value));
        $db->setQuery($query);
        $res=$db->execute();
         echo '$query1  '. $query . '<br>res: '.$res.'<br>';
        // // Reset the query using our newly populated query object.
        // $query = 'insert into  #__regn_bilagsarter ( id,beskrivelse,dato,debet,kredit,belop,tekst) ' .
        //     ' value ("' . $art . '","' . $beskrivelse . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","' . $tekst . '");';
        // // // $query = 'select * from   #__regn_bilagsarter';
        // // $query = 'insert into  #__regn_bilagsarter ( id,beskrivelse,dato) ' .
        // //     ' value ("' . $art . '","' . $beskrivelse . '","' . $dato . '");';

        // echo '$query' . $query . '<br>';


        // $db->setQuery($query);

        // try {
        //     $db->execute();
        //     echo 'Row inserted successfully!';
        // } catch (Exception $e) {
        //     echo 'Error inserting row: ' . $e->getMessage();
        // }



















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

    public function f_art()
    {

        $db    = JFactory::getDBO();
        $sql = $db->getQuery(true);
        // $query = 'select * from #__regn_bilagsarter';
        // $db->setQuery((string) $query);
        // $messages = $db->loadObjectList();
        // echo json_encode($messages);
        //    $result = $conn->query($sql);
        // $temparray1 = array();
        // while ($row = mysqli_fetch_assoc($messages))
        // $temparray1 = $row;
        // echo json_encode($temparray1);

        // $message = json_encode($db->loadObject());
        // $obj3 = json_decode($message);

        //     echo 'count: ' . count($messages).'<br>';
        //     $options  = array();

        //   $result = $db-> loadObjectList();// loadAssocList() 
        //         $row = $result->fetch_array(MYSQLI_ASSOC);
        //     echo json_encode($row);

        // $sql = 'select * from qo7sn_regn_bilagsarter';
        // $db->setQuery((string) $sql);
        // $temparray1 = array();
        //       $result = $db-> loadObjectList(); 
        // while ($row = mysqli_fetch_assoc($result))
        // $temparray1 = $row;
        // echo json_encode($temparray1);


        // $sql = 'select * from #__regn_bilagsarter';
        // $db->setQuery((string) $sql);
        // // echo 'sql: ' . $sql . '<br>';
        // $messages = $db->loadObjectList();
        // echo 'count: ' . count($messages);
        // $row = $messages->fetch_array(MYSQLI_ASSOC);
        // echo json_encode($row);

        // foreach ($messages as $message) {
        //     //                    $options[] = ('select.option', $message->id, $message->beskrivelse);
        //     echo 'id: ' . $message->id . '  ' . $message->beskrivelse . '<br>';
        // }


        //    $options = array_merge(parent::getOptions(), $options);

        //     return $options;







        $input = JFactory::getApplication()->input;
        //  echo 'input passed<br>';
        //  global $hash, $conn;
        // $mode = $input->get('mode',0); 
        $art = $input->get('art', 0);
        $task = $input->get('task', 0);
        $module = $input->get('module', 0);
        $option = $input->get('option', 0);
        $beskrivelse = $input->get('beskrivelse', 0);
        $dato = $input->get('dato', 0);
        $debet = $input->get('debet', 0);
        $kredit = $input->get('kredit', 0);
        $belop = $input->get('belop', 0);
        $tekst = $input->get('tekst', 0);
        echo '$art: ' . $art . '<br>';
        // echo '$task: ' . $task . '<br>';
        // echo '$module: ' . $module . '<br>';
        // echo '$option: ' . $option . '<br>';
        // echo '$dato: ' . $dato . '<br>';
        // echo '$beskrivelse: ' . $beskrivelse . '<br>';
        // echo '$belop: ' . $belop . '<br>';

        //  $sql = $db->getQuery(true);
        // // $query->select('h.greeting, h.params, h.image as image, c.title as category, h.latitude as latitude, h.longitude as longitude')
        // // ->from('#__helloworld as h')
        // // ->leftJoin('#__categories as c ON h.catid=c.id')
        // // ->where('h.id=' . (int)$id);
        // // $db->setQuery((string)$query);
        //   $sql = $db->getQuery(true);
        $sql = 'select * from #__regn_bilagsarter where id="' . $art . '";';
        //  $db->setQuery((string)$sql);
        //  echo 'sql: ' . $sql . '<br>';
        $db->setQuery((string) $sql);
        $messages = $db->loadObjectList();

        //  $result->free_result();        
        //     echo 'count: ' . count($messages) . '<br>';

        // if (count($messages) > 0) {
        //     $sql = 'update #__regn_bilagsarter  set id="' . $art . '",beskrivelse="' . $beskrivelse . '",dato="'
        //         . $dato . '",debet="' . $debet . '",kredit="' . $kredit . '",belop="' . $belop . '",tekst="' . $tekst . '" where id="' . $art . '";';
        //       $db->setQuery((string) $sql);
        //     //    echo 'sql: ' . $sql . '<br>';
        //     /  $result = $conn->query($sql);
        //     $result = $db->execute();     //               loadObjectList(); // loadAssocList() 
        //     //  $row = $result->fetch_array(MYSQLI_ASSOC);
        //     //     echo json_encode($row);
        //     //   $result->free_result();
        //     echo 'Oppdatert';
        // } else {
        //     // $sql = 'insert into  #__regn_bilagsarter  set id=' . $art . ',beskrivelse="' . $beskrivelse . '",dato="'
        //     // . $dato . '",debet="' . $debet . '",kredit="' . $kredit . '",belop="' . $belop . '",tekst="' . $tekst . '";';
        //     $sql = 'insert into  #__regn_bilagsarter ( id,beskrivelse,dato,debet,kredit,belop,tekst) ' .
        //         ' value ("' . $art . '","' . $beskrivelse . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","' . $tekst . '");';
        //     //     echo 'sql: ' . $sql . '<br>';
        //     //    $db->setQuery((string) $sql);
        //     $messages = $db->loadResult();
        //     //     $db->execute(); //            loadObjectList(); 
        //     //     $row = $result->fetch_array(MYSQLI_ASSOC);
        //     //     echo json_encode($row);
        //     //     $result->free_result();
        //     //    echo 'Insert';
        // }
        // JFactory::getApplication()->close();
    }
}
