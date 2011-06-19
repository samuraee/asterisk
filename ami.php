<?php
	
include 'AsteriskManager.php';
define('ASTERIS_HOST', '192.168.50.41');
define('ASTERIS_PORT', '5038');
define('ASTERIS_USER', 'nima');
define('ASTERIS_PASS', 'nima');


/**
 * The parameters for connecting to the server
 */
$params = array('server' => ASTERIS_HOST, 'port' => ASTERIS_PORT);

/**
 * Instantiate Asterisk object and connect to server
 */
$ast = new Net_AsteriskManager($params);

/**
 * Connect to server
 */
try {
    $ast->connect();
} catch (PEAR_Exception $e) {
    echo $e;
}

/**
 * Login to manager API
 */
try {
    $ast->login(ASTERIS_USER, ASTERIS_PASS);
} catch(PEAR_Exception $e) {
    echo $e;
}

/**
 * Monitoring
 * Begin monitoring channel to filename "test.gsm"
 * If it fails then echo Asterisk error
 */
$chan = 'SIP/868';

try {
    $ast->startMonitor($chan, 'test', 'gsm', 1);
}  catch (PEAR_Exception $e) {
    echo $e;
}

/**
 * Queues
 * List queues then add and remove a handset from a queue
 */

/**
// Add the SIP handset 234 to a the applicants queue
try {
    $ast->queueAdd('200', 'SIP/301', 1);
} catch(PEAR_Exception $e) {
    echo $e;
}

try {
    echo $ast->queuePause('200', 'SIP/301', 'true');
} catch(PEAR_Exception $e) {
    echo $e;
}

/**
// Print all the queues on the server
try {
    echo $ast->getQueues();
} catch(PEAR_Exception $e) {
    echo $e;
}
die();
// Take it out again
try {
    $ast->queueRemove('applicants', 'SIP/234');
} catch (PEAR_Exception $e) {
    echo $e;
}
