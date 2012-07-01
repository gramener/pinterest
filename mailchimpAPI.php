<?php

require_once 'inc/MCAPI.class.php';
require_once 'inc/config.inc.php';

function MC_batchSubscribe($userDetails,$pins){
	
	// Configuration Values
	//API Key - see http://admin.mailchimp.com/account/api
	$apikey = '61b57fe45c3f7d8503f7f66d639dbf07-us5';
	
	// A List Id to run examples against. use lists() to view all
	// Also, login to MC account, go to List, then List Tools, and look for the List ID entry
	$listId = '44a7d7b4ab';
	
	// A Campaign Id to run examples against. use campaigns() to view all
	$campaignId = 'mailchimp096c3fb1e9f4934bffcc35879.e2a5adf0f1';
	
	//some email addresses used in the examples:
	$my_email = 'rockey.nebhwani@leapgradient.com';
	$boss_man_email = 'rockey.nebhwani@leapgradient.com';
	
	//just used in xml-rpc examples
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	
	$api = new MCAPI($apikey);
	
	$email=$userDetails['EMAIL'];
	$fname=$userDetails['FNAME'];
	$lname=$userDetails['LNAME'];
	
	$batch=array();
	$info=array();
	$info["EMAIL"]=$email;
	$info["FNAME"]=$fname;
	$info["LNAME"]=$lname;
	$i=1;
	foreach($pins as $pin)
	{
		$arrayindexURL="PIN" . $i . "URL";
		$arrayindexWPRICE="PIN".$i."WPRICE";
		$arrayindexNPRICE="PIN".$i."NPRICE";
		$info[$arrayindexURL]=$pin['URL'];
		$info[$arrayindexWPRICE]=$pin['WPRICE'];
		$info[$arrayindexNPRICE]=$pin['NPRICE'];
		
		// 'LNAME'=>"$lname",'PIN1URL'=>'http://pinterest.com/pin1','PIN1WPRICE'=>'13','PIN1NPRICE'=>'12','PIN2URL'=>'http://pinterest.com/pin2','PIN2WPRICE'=>'25','PIN2NPRICE'=>'23','PIN3URL'=>'http://pinterest.com/pin3','PIN3WPRICE'=>'50','PIN3NPRICE'=>'45');
	}
	
	$batch[] = $info;
	print_r($batch);
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
		}
	}
	
}



?>
