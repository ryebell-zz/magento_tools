<?php

require_once ("./app/Mage.php");
Mage::app();
$version = Mage::getVersion();
$base_url = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_WEB);
$modules = (array)Mage::getConfig()->getNode('modules')->children();

echo "<b>Version:</b> <br>" . $version . "<br>";
echo "<b>Base URL:</b> <br>" . $base_url . "<br>";
echo "<b>Installed Modules:</b> <br>";
foreach ($modules as $module => $moduleSettings) {
    echo $module . ' [' 
    . ($moduleSettings->is('active') ? 'active' : 'disabled') . "] <br>";
}

?>

