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
//echo phpinfo();

defined('_JEXEC') or die('Restricted access');
echo '<h1>Klienter</h1>';

use Joomla\CMS\Factory;
use Joomla\CMS\Router\Route;
//	echo $this->loadTemplate('reg'); 
$session = Factory::getSession();

$model = $this->getModel('klienter');
// $model1 = $this->getModel('RegnModelKonto');

// // $model1 = new  RegnModelResultat;

// $perioderstart = $model1->kontoer();


$user = JFactory::getUser();
$name = $user->name;
$username = $user->username;
if ($name)
	echo '<h5>Klient: ' . $user->name . '<br></h5>';
//$model->scann_klienter();

if ($username) {
	if ($user->authProvider) {
		$session->set('klient', $username);

		if ($user->authProvider[0] == "r")
			echo $this->loadTemplate('firma');
		else if ($user->authProvider[0] == "X")
			echo $this->loadTemplate('reg');
		else if ($user->authProvider[0] == "$")
			echo $this->loadTemplate('balanse');
	} else {

		$database = $model->opprett_klient($username);
		$database = "X" . $database;
		$user->authProvider = $database;
		$model->oppdater_user($user);
		$session->set('klient', $username);
		echo $this->loadTemplate('reg');  // dette siftes ut med initialiseringsprosedyre
		//	echo $this->loadTemplate('reg');  // dette siftes ut med initialiseringsprosedyre
	}
} else
	$session->clear('klient');
// // echo $this->loadTemplate('firma');
