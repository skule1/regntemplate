<?php

echo 'abc tmpl<br>';
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Factory;
use Joomla\Registry\Registry;

defined('_JEXEC') or die;

// Get the application instance
$app = Factory::getApplication();

$moduleName = 'mod_banknorwegian'; // Replace with your module's name
$modules = ModuleHelper::getModule($moduleName);

// Render the module
if ($modules) {
    echo ModuleHelper::renderModule($modules);
} else {
    echo '<p>Module not found or not enabled.</p>';
}



$moduleName = 'mod_storebrand'; // Replace with your module's name
$modules = ModuleHelper::getModule($moduleName);

// Render the module
if ($modules) {
    echo ModuleHelper::renderModule($modules);
} else {
    echo '<p>Module not found or not enabled.</p>';
}

$storeb= new RegnModStorebrand();
echo $storeb->gg();

// $norw= new RegnModBanknorwegian();
// echo $norw->getData();

// $norw= new RegnModStorebrand();
// //echo $norw->gg();
// echo $norw->getData();

echo '<br>neste<br>';


// // Get the module by its name (replace 'mod_custommodule' with your module name)
// $moduleName = 'mod_banknorwegian';
// $module = ModuleHelper::getModule($moduleName);

// if ($module && $module->id) {
//     // Retrieve the module's parameters as a Registry object
//     $params = new Registry($module->params);

//     // Get the module class suffix
//     $moduleClassSuffix = $params->get('moduleclass_sfx', '');

//     // Output the module class suffix (optional debugging or customization)
//     echo "Module Class Suffix: " . htmlspecialchars($moduleClassSuffix, ENT_QUOTES, 'UTF-8') . "<br>";

//     // Add the class suffix to a custom wrapper, if needed
//     echo '<div class="module-wrapper ' . htmlspecialchars($moduleClassSuffix, ENT_QUOTES, 'UTF-8') . '">';
//     echo ModuleHelper::renderModule($module);
//     echo '</div>';
// } else {
//     echo "Module $moduleName not found or not published.";
// }
//echo '<br>ferdig<br>';
?>















