<?php

require_once 'inc/MCAPI.class.php';
require_once 'inc/config.inc.php';

function MC_batchSubscribe($userDetails,$pins){
	
	// Configuration Values
	//API Key - see http://admin.mailchimp.com/account/api
	$apikey = '61b57fe45c3f7d8503f7f66d639dbf07-us5';
		// A List Id to run examples against. use lists() to view all
	// Also, login to MC account, go to List, then List Tools, and look for the List ID entry
	// List name : pinalert2
	$listId = '6b128c250f';
	// A Campaign Id to run examples against. use campaigns() to view all
	//CompignName :  PriceTracker Test Campaign (copy 02)
	$campaignId = ' mailchimp096c3fb1e9f4934bffcc35879.5c74aa98f6';
	//some email addresses used in the examples:
	$my_email = 'rockey.nebhwani@leapgradient.com';
	$boss_man_email = 'rockey.nebhwani@leapgradient.com';
	//just used in xml-rpc examples
	$apiUrl = 'http://api.mailchimp.com/1.3/';
	
	$api = new MCAPI($apikey);

	/*
	 * GET all members info from subscription List
	 * START BLOCK
	 */
	
	$subscriberList=array();
	$retval = $api->listMembers($listId, 'subscribed', null, 0, 5000 );
	if ($api->errorCode){
		echo "Unable to load listMembers()!";
		echo "\n\tCode=".$api->errorCode;
		echo "\n\tMsg=".$api->errorMessage."\n";
	} else {
		echo "Members matched: ". $retval['total']. "\n";
		echo "Members returned: ". sizeof($retval['data']). "\n";
		foreach($retval['data'] as $member){
			$subscriberList[]= $member['email'];
		}
	}
	/*
	 * END BLOCK
	 */
	
	$batch=array();
	foreach ($subscriberList as $s){
		$batch[]=array("EMAIL"=>$s,"ALERTSEND"=>"false","PIN1URL"=>"","PIN1WPRICE"=>"","PIN1NPRICE"=>"","PIN2URL"=>"","PIN2WPRICE"=>"","PIN2NPRICE"=>"","PIN3URL"=>"","PIN3WPRICE"=>"","PIN3NPRICE"=>"","PIN4URL"=>"","PIN4WPRICE"=>"","PIN4NPRICE"=>"","PIN5URL"=>"","PIN5WPRICE"=>"","PIN5NPRICE"=>"","PIN6URL"=>"","PIN6WPRICE"=>"","PIN6NPRICE"=>"","PIN7URL"=>"","PIN7WPRICE"=>"","PIN7NPRICE"=>"","PIN8URL"=>"","PIN8WPRICE"=>"","PIN8NPRICE"=>"","PIN9URL"=>"","PIN9WPRICE"=>"","PIN9NPRICE"=>"","PIN10URL"=>"","PIN10WPRICE"=>"","PIN10NPRICE"=>"");
		
	}
	
	
	$optin = false; //yes, send optin emails
	$up_exist = true; // yes, update currently subscribed users
	$replace_int = false; // no, add interest, don't replace
	//Update all entries with Empty value
	$vals = $api->listBatchSubscribe($listId,$batch,$optin, $up_exist, $replace_int);
		
	$email=$userDetails['EMAIL'];
	$fname=$userDetails['FNAME'];
	$lname=$userDetails['LNAME'];
	
	$batch=array();
	$info=array();
	$info["EMAIL"]=$email;
	$info["FNAME"]=$fname;
	$info["LNAME"]=$lname;
	$info["SENDALERT"]="true";
	$i=1;
	foreach($pins as $pin)
	{
		$arrayindexURL="PIN" . $i . "URL";
		$arrayindexWPRICE="PIN".$i."WPRICE";
		$arrayindexNPRICE="PIN".$i."NPRICE";
		$info[$arrayindexURL]=$pin['URL'];
		$info[$arrayindexWPRICE]=$pin['WPRICE'];
		$info[$arrayindexNPRICE]=$pin['NPRICE'];
		$i++;
		// 'LNAME'=>"$lname",'PIN1URL'=>'http://pinterest.com/pin1','PIN1WPRICE'=>'13','PIN1NPRICE'=>'12','PIN2URL'=>'http://pinterest.com/pin2','PIN2WPRICE'=>'25','PIN2NPRICE'=>'23','PIN3URL'=>'http://pinterest.com/pin3','PIN3WPRICE'=>'50','PIN3NPRICE'=>'45');
	}
	
	$batch[] = $info;
	print_r($batch);
	
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
