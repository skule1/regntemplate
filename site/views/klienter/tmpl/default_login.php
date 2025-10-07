<h1>Login</h1>

<form action="">
    <table border="0" cellpadding="4" cellspacing="4" class="adminform">
        <tr>
            <td>Brukernavn</td>
            <td><input type="text"></td>
        </tr>
        <tr>
            <td>Passord</td>
            <td><input type="text"></td>
        </tr>
        <tr>
            <td>
            <td><br><input type="submit"></td>
            </td>
        </tr>
    </table>
</form>


<?php
use Joomla\CMS\Factory;

$session = Factory::getSession();
$session->set('klient', 'reg00021');
echo 'session: ' . $session->get('klient') . '<br>';