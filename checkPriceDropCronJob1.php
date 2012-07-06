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

	$flag=0;
	$productURLs=array();
	$alertCreatedPrice=array();
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
	$i=0;
	
	$pinsArray=array();
	
	foreach($productURLs as $productURL){
		echo "<br>Product url";
		echo $productURL;
		echo "<br>";
		$tempurl=explode("#",$productURL);
		if(count($tempurl)==1){
			$tempurl=explode("?",$productURL);
		}
			
		$productIndividualPrice=getProductPrice($linkArray, $tempurl[0]);
		if($productIndividualPrice<$alertCreatedPrice[$i] && $productIndividualPrice!=''){
		$pinsArray[]=array("URL"=>$productURL,"WPRICE"=>$alertCreatedPrice[$i],"NPRICE"=>$productIndividualPrice);
		echo "<br>";
		print_r($pinsArray);
		echo "<br>";
		}
		$i++;
}


MC_batchSubscribe($userDetails, $pinsArray);

}


?>