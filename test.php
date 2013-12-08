<?php
/**
 * @author Chris Schalenborgh <chris.s@kryap.com>
 * @version 0.1
 */ 
 
include('Message.php');

$push = new \Darkflib\Pushover\Message();
$push->setToken('');
$push->setUser('');

$push->setTitle('Hey Mike');
$push->setMessage('Hello world! ' .time());
$push->setUrl('http://chris.schalenborgh.be/blog/');
$push->setUrlTitle('cool php blog');

//$push->setDevice('iPhone');
$push->setPriority(1);
$push->setRetry(60); //Used with Priority = 2; Pushover will resend the notification every 60 seconds until the user accepts.
$push->setExpire(3600); //Used with Priority = 2; Pushover will resend the notification every 60 seconds for 3600 seconds. After that point, it stops sending notifications.
$push->setTimestamp(time());
$push->setDebug(true);
$push->setSound('bike');

$go = $push->send();

echo '<pre>';
print_r($go);
echo '</pre>';
?>
