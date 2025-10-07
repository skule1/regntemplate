
<?php

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;




$model = $this->getModel('klienter');
//$klientliste = $model->lagre_klient($res);
$session = Factory::getSession();

//echo 'session111: ' . $session->get('klient') . '<br>';


/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');


$app = \Joomla\CMS\Factory::getApplication();



if ($session->get('klient')) {
    echo 'session: ' . $session->get('klient') . '<br>';
    // echo '<a href="' . Route::_('index.php?option=com_regn&view=klienter&layout=default_ny') . '">Nyregistrering </a>';

    $app = Factory::getApplication();
    $app->redirect('index.php?option=com_regn&view=klienter&layout=default_ny'); // Internal
// or
// $app->redirect('https://example.com/another-page'); // External
// trinn1();;
}else if (isset($_POST["valg"])) {

    if ($_POST["valg"] == 'giver')
        $url = Route::_('index.php?option=com_arbeid&view=person2&layout=default_giver');
    else if ($_POST["valg"] == 'taker')
        $url = Route::_('index.php?option=com_arbeid&view=person2&layout=default_taker');

    $app->redirect($url);
    $app->close();
}

//$modKlient = new KlientModelKlienter;

if (isset($_POST["klient"])) {
    $bruker = $_POST["bruker"];
    $passw = $_POST["passw"];
    // echo "Bruker: " . $bruker . "<br>";
    // echo "Passord: " . $passw . "<br>";

    $model = $this->getModel('klienter');
    $klient = $model->hent_klient($bruker, $passw);
    echo 'pass<br>';


    if ($klient) {
        echo 'dine brukerdata: <br><br>';
        echo 'Brukernavn: ' . $klient->brukernavn . '<br>';
        echo 'Firma: ' . $klient->firma . '<br>';
        echo 'Telefon: ' . $klient->telefon . '<br>';
        echo 'Epost: ' . $klient->epost . '<br>';
        echo 'Folder navn: ' . $klient->folder_name . '<br>';
        echo 'Database: ' . $klient->folder_name . '<br>';
  
        //$session->set('klient', 'reg10004');
        $session->set('klient', $klient->folder_name);
        $value = $session->get('klient');
        echo 'value: '.$value.'<br>';
    
    } else {
        echo 'Ingen brukerdata funnet.';
        $session->clear('klient');
    }   

    // Logikk for å håndtere innlogging
}   
else {

?>
Her kan du registrere deg og føre regnskap til forskjellige formål.<br><br>

Dersom du allered har registrert deg, kan du logge inn med epost og passord.	
Deretter kan du føre regnskap for dine prosjekter.
<br><br
Dersom du ikke har registrert deg, kan du gjøre det her.


<br>
<form action=""  method="POST">
	<tabell>
		<tr>
			<td>Brukernavn<input type="text" name="bruker" id=""></td>
			<td>Passord<input type="text" name="passw" id=""></td>
		</tr>
		<tr>
			<td><input type="submit" name="klient" value="Neste"></td>
		</tr>
	</tabell>
</form>




<a href="<?php echo Route::_('index.php?option=com_regn&view=klienter&layout=default_ny'); ?>">Nyregistrering </a>

<?php
}