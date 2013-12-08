<?php
/**
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 */ 
 
include('Validate.php');
include('config.php');

$push = new \Darkflib\Pushover\Validate(PUSHOVER_TOKEN, PUSHOVER_USER);

$push->setDebug(true);

$go = $push->send();

echo '<pre>';
print_r($go);
echo '</pre>';
?>
