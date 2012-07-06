<?php
include_once 'utility.php';
include_once 'mailchimpAPI.php';
// get product URL based on pinners ID

$cleanURLSring='';
$flag=0;
// Get all records from pin alert table. The results are grouped by pinners id
$allAlerts=getAllPinalerts();
foreach ($allAlerts as $k=>$v){
	// $k represent user id 
	// get user details
	$userDetails=getuserDetailsByPinnerId($k);
	/*
	 * User Attribute
	 * pinnerID 	registrationDate 	alertThreshold 	firstName 	lastName 	emailID 
	 */

	
	$productURLs=array();
	$alertCreatedPrice=array();
	foreach ($v as $tmparray){
			$productURLs[]=$tmparray['URL'];
			$alertCreatedPrice[]=$tmparray['alertCreatedPrice'];
	}

	
		
	$pinsArray=array();
	$i=0;
	foreach($productURLs as $productURL){
	
		echo "<br>price1:" . getPricebyProductID(getProductIdfromURL($productURL));
		echo "<br>price2:" . $alertCreatedPrice[$i];
		
		
		$i++;
		}
		
}


//MC_batchSubscribe($userDetails, $pinsArray);




?>