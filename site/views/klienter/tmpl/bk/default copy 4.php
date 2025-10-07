<style>
	th {

		margin-right: 10px;
		margin-left: 10px;
		padding: 10px 10px;
	}

	td {

		margin-right: 10px;
		margin-left: 10px;
		padding: 10px 10px;
	}



	.btn {
		background-color: #2925a5ff;
		color: white;
		padding: 7px 20px;
		border: none;
		border-radius: 5px;
		cursor: pointer;
	}

	.btn:hover {
		background-color: #1f0a54ff;
		color: #b4eb0fff;
		font-weight: bold;
	}
</style>










<?php

defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;

$session = Factory::getSession();
//  $model = $this->getModel('klienter');
$model = $this->getModel('klienter');
$user = JFactory::getUser();
$username = $user->username;
if ($username) {
	if ($user->authProvider) {
		$session->set('klient', $username);
		echo $this->loadTemplate('firma');
	} else {
		$database = $model->opprett_klient($username);
		$user->authProvider = $database;
		$database = $user->authProvider;
		$session->set('klient', $username);
		echo $this->loadTemplate('reg');  // dette siftes ut med initialiseringsprosedyre
	}
} else
	$session->clear('klient');
//echo $this->loadTemplate('firma');
// ikke logget på.

// //$klientliste = $model->lagre_klient($res);
// //$session = Factory::getSession();
// //     $klient=$model->hent_klient1($session->get('klient'));
// // //echo 'session: '.$session->get("klient");
// // echo 'Klient: '.$klient["firma"].'<br>';
// // //$session->clear("klient");
// $kl = $session->get('klient');
// if ($kl) {
// 	$klient = $model->hent_klient1($session->get('klient'));
// 	//	echo 'Du er logget inn som: ' . $klient["firma"] . '<br>';
// 	// 	echo '<a href="index.php?option=com_regn&view=klienter&layout=firma">
// 	//    Go to Custom Layout
// 	// </a>';


// 	echo $this->loadTemplate('firma');

// 	echo '<a href="index.php?option=com_regn&view=klienter&layout=default_firma" class="btn btn-primary"> Fortsett</a><br><br>';
// 	echo '<a href="index.php?option=com_regn&view=klienter&layout=default_logout" class="btn btn-primary"> Logg ut</a><br><br>';
// } else if (isset($_POST["klient"])) {
// 	echo $_POST['bruker'] . '<br>';
// 	$klient = $model->hent_klient($_POST['bruker'], $_POST['passw']);
// 	if ($klient) {
// 		//	echo 'Innlogging ok<br>';
// 		$session->set('klient', $klient["folder_name"]);
// 		// $kj=$session->get('klient');
// 		// echo '$kj: '.$kj.'<br>';
// 		echo $this->loadTemplate('firma');
// 	} else {
// 		echo 'Feil brukernavn eller passord<br>';
// 		echo 'Gå tilbake og prøv igjen<br>';
// 		$session->clear('klient');
// 		echo '<a href="index.php?option=com_regn&view=klienter&layout=default" class="btn btn-primary"> Fortsett</a>';
// 
?>
// <a href="<?php echo Route::_('index.php?option=com_regn&view=klienter&layout=klient'); ?>">Nyregistrering1 </a>
// <?php
	// 		//	exit;
	// 	}
	// } else {
	// 	
	?>


// Her kan du registrere deg og føre regnskap til forskjellige formål.<br><br>

// Dersom du allered har registrert deg, kan du logge inn med epost og passord.
// Deretter kan du føre regnskap for dine prosjekter.
// <br><br Dersom du ikke har registrert deg, kan du gjøre det her. <br>
// <form action="" method="POST">
	// <table>
		// <tr>
			// <th>Brukernavn:</th>
			// <td><input type="text" name="bruker" id=""></td>
			// <th>Passord:</th>
			// <td><input type="text" name="passw" id=""></td>

			// <td><input type="submit" class="btn" name="klient" value="Neste"></td>
			// </tr>
		// </table>
	// </form>




// <a href="<?php echo Route::_('index.php?option=com_regn&view=klienter&layout=default_reg'); ?>">Nyregistrering </a>

// <?php
// }
