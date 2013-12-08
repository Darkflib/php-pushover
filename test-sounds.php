<?php
/**
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 */ 
 
include('Sounds.php');
include('config.php');

$push = new \Darkflib\Pushover\Sounds(PUSHOVER_TOKEN);

$push->setDebug(true);

$go = $push->send();

echo '<pre>';
print_r($go);
echo '</pre>';
?>
