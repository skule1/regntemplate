<?php
defined('_JEXEC') or die;


use Joomla\CMS\Factory;
use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\Response\JsonResponse;


class RegnControllerReg extends BaseController
{

    function bilagsarter()
    {
        $model = $this->getModel('reg');
        $bilagsarter = $model->bilagsarter();
        $d = json_encode($bilagsarter);
        // $msg = '<table  border="0" cellspacing="2" cellpadding="2" width="100%"><tr> <th style="text-align:right; ">Id</th><th>Beskrivelse</th></tr>';
        // foreach ($bilagsarter as $bilagsart) {
        //     $msg = $msg . '<tr><td  style="text-align:right; border-width:0px; width:150px;"><input type="text" onclick="kto()" value="' . $bilagsart->id . '"/></td><td>' . $bilagsart->beskrivelse . '</td></td>';
        //     $msg = $msg . '</ta>';

        // }

    //    echo 'hei';
         echo $d;

        JFactory::getApplication()->close();
    }
    function kontoliste()
    {
        $model = $this->getModel('reg');
        $kontoer = $model->kontoliste();

        $msg = '<table  border="0" cellspacing="2" cellpadding="2" width="100%"><tr> <th style="text-align:right; ">Id</th><th>Beskrivelse</th></tr>';
        foreach ($kontoer as $konto) {
            $msg = $msg . '<tr><td  style="text-align:right; border-width:0px; width:150px;"><input type="text" id="ghg" onclick=clkc()" value="'. $konto->Ktonr . '"</td><td>' . $konto->Navn . '</td></td>';
            $msg = $msg . '</ta>';
        }

        echo $msg;

        JFactory::getApplication()->close();
    }

    function f_oppdater()
    {
        echo 'f_oppdater<br>';
        global $hash, $conn;
        //} function dddd(){
        $Ref = $_POST['ref'];
        $bilag = $_POST['bilagsnr'];
        $dato = $_POST['dato'];
        $debet = $_POST['debet'];
        $kredit = $_POST['kredit'];
        $belop = $_POST['belop'];
        $valuta = $_POST['valuta'];
        echo '$currency: ' . $currency . '  $valuta: ' . $valuta . ' 	$belop: ' . $belop . '<br>';
        if ($valuta != 0) {
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
        $tekst = $_POST['tekst'];
        $buntnr = $_POST['buntnr'];
        $bilagsart = $_POST['art'];
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
        $sql = 'INSERT INTO ' . $hash . 'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,currency_amount,currency,currency_rate,tekst,Buntnr,Regdato,Bilagsart,periode)
VALUES ("' . $Ref . '","' . $bilag . '","' . $dato . '","' . $debet . '","' . $kredit . '","' . $belop . '","' . $currency . '","' . $valuta . '","' . $rate . '","' . $tekst . '","' . $buntnr . '","' . date("Y-m-d") . '","' . $bilagsart . '","' . $periode . '")';
        //	echo $sql;

        /* $sql = 'INSERT INTO '.$hash.'regn_trans  (Ref,bilag,Dato,debet,kredit,belop,tekst,Buntnr,Regdato,Bilagsart)
                                                                     VALUES ('.$Ref.','.$bilag.',"'.$Dato.'","'.$debet.'","'.$kredit.'",'.$belop.',"'.$tekst.'",'.$buntnr.',"'.$now.'","'.$bilagsart.'")';
                                                                   */
        /*	$sql = "UPDATE `crud` 
                                                                       SET `name`='$name',
                                                                       `email`='$email',
                                                                       `phone`='$phone',
                                                                       `city`='$city' WHERE id=$id";
                                                                       echo 'sql: '.$sql.'<br>';
                                                                      */
        //$sql='insert into prmk2_regn_trans  (Ref,bilag) values (5,6);';
        //  $result -> free_result();

        //  $result = $conn -> query($sql);
        //$result = $conn -> query($sql);

        $result = mysqli_query($conn, $sql);

        //$result1=$buntnr;


        $sql = 'select * from ' . $hash . 'regn_trans order by Ref desc limit 1';
        $result = mysqli_query($conn, $sql);
        //echo json_encode($result);
        //echo $buntnr;
        /*
                                                                       if (mysqli_query($conn, $sql)) {
                                                                           echo json_encode(array("statusCode"=>200));
                                                                       } 
                                                                       else {
                                                                           echo json_encode(array("statusCode"=>201));
                                                                       }
                                                                       */
        mysqli_close($conn);
    }

    public function oppd()
    {
        echo 'oppd subcontroller bilagsart   ';

        $db = Factory::getDbo();
        $query = $db->getQuery(true);
        $input = Factory::getApplication()->input;
        $id = $input->get('id', 0);
        $navn = $input->get('navn', 0);
        $val = $input->get('val', 0);

        $query = 'update #__regn_bilagsarter set ' . $navn . '="' . $val . '" where id=' . $id . ';';

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
        echo '  id: ' . $id;
        $id = $input->getString('id', '');
        $sql = 'DELETE FROM #__regn_trans WHERE ref=' . $id . ';';
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

?>




<script src="http://code.jquery.com/jquery-3.1.1.min.js"></script>
<script type="text/javascript"></script>

function clkc(){
    console.log('clkc');
}

</script>