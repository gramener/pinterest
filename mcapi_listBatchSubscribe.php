<?php
/**
This Example shows how to run a Batch Subscribe on a List using the MCAPI.php 
class and do some basic error checking or handle the return values.
**/
require_once 'inc/MCAPI.class.php';
require_once 'inc/config.inc.php'; //contains apikey

$api = new MCAPI($apikey);


$batch[] = array('EMAIL'=>'jeyaseelan.g@gmail.com', 'FNAME'=>'Jayaseelan', 'LNAME'=>'Gabriel','PIN1URL'=>'http://pinterest.com/pin1','PIN1WPRICE'=>'13','PIN1NPRICE'=>'12','PIN2URL'=>'http://pinterest.com/pin2','PIN2WPRICE'=>'25','PIN2NPRICE'=>'23','PIN3URL'=>'http://pinterest.com/pin3','PIN3WPRICE'=>'50','PIN3NPRICE'=>'45');

$optin = false; //yes, send optin emails
$up_exist = true; // yes, update currently subscribed users
$replace_int = false; // no, add interest, don't replace

$vals = $api->listBatchSubscribe($listId,$batch,$optin, $up_exist, $replace_int);

if ($api->errorCode){
    echo "Batch Subscribe failed!\n";
	echo "code:".$api->errorCode."\n";
	echo "msg :".$api->errorMessage."\n";
} else {
	echo "added:   ".$vals['add_count']."\n";
	echo "updated: ".$vals['update_count']."\n";
	echo "errors:  ".$vals['error_count']."\n";
	foreach($vals['errors'] as $val){
		echo $val['email_address']. " failed\n";
		echo "code:".$val['code']."\n";
		echo "msg :".$val['message']."\n";
	}}
?> 


