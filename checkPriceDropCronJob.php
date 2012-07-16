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
	echo "$k";
	print_r($userDetails);
	
	/*
	 * User Attribute
	 * pinnerID 	registrationDate 	alertThreshold 	firstName 	lastName 	emailID 
	 */
	$productURLs=array();
	$alertCreatedPrice=array();
	$flag=0;
	if($PRICETRACKING=="G"){
	foreach ($v as $tmparray){
		if($flag==0){
			$cleanURLSring=cleanProductURLs( $tmparray['URL']);
			$productURLs[]=$tmparray['URL'];
			$alertCreatedPrice[]=$tmparray['alertCreatedPrice'];
			$flag=1;
		}else{
			$cleanURLSring=$cleanURLSring . "|" . cleanProductURLs( $tmparray['URL']);
			$productURLs[]=$tmparray['URL'];
			$alertCreatedPrice[]=$tmparray['alertCreatedPrice'];
		}
	}
	
	$results= fetchGoogleAPIResults($cleanURLSring,"GB");
	$obj = json_decode($results,true);
	$linkArray=search($obj, "link");
	
	}
	if($PRICETRACKING=="P"){
	foreach ($v as $tmparray){
			$productURLs[]=$tmparray['URL'];
			$alertCreatedPrice[]=$tmparray['alertCreatedPrice'];
	}
	}
	$pinsArray=array();
	$i=0;
	foreach($productURLs as $productURL){
		if($PRICETRACKING=="P"){
		if( getPricebyProductID(getProductIdfromURL($productURL))< $alertCreatedPrice[$i]){
		$pinsArray[]=array("URL"=>$productURL,"WPRICE"=>$alertCreatedPrice[$i],"NPRICE"=>getPricebyProductID(getProductIdfromURL($productURL)));
		}
		}
		
		if($PRICETRACKING=="G"){
			
			$tempurl=explode("#",$productURL);
			if(count($tempurl)==1){
				$tempurl=explode("?",$productURL);
			}
				
			$productIndividualPrice=getProductPrice($linkArray, $tempurl[0]);
			if($productIndividualPrice<$alertCreatedPrice[$i] && $productIndividualPrice!=''){
				$pinsArray[]=array("URL"=>$productURL,"WPRICE"=>$alertCreatedPrice[$i],"NPRICE"=>$productIndividualPrice);
			
			}
		}
		
		
		$i++;
		}
		
		MC_batchSubscribe($userDetails, $pinsArray);
}

?>