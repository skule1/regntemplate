
<?php

/**
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');
?>

<h1><?php echo $this->msg; ?></h1>

<form action="" method="get"><table width="500" border="1" cellspacing="2" cellpadding="2">
<label>
    <input type="radio" name="RadioGroup1" value="Registrer" id="RadioGroup1_0" checked />
    Register</label>
  <br />
  <label>
    <input type="radio" name="RadioGroup1" value="Login" id="RadioGroup1_1" />
    Login</label><br><br>
    <input type="submit" name="option" value="Velg" />
</form>