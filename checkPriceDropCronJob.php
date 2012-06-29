<?php
include_once 'utility.php';

// get product URL based on pinners ID

$cleanURLSring='';
$flag=0;


$allAlerts=getAllPinalerts();

foreach ($allAlerts as $k=>$v){
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
	foreach($productURLs as $productURL){
		$tempurl=explode("#",$productURL);
		if(count($tempurl)==1){
			$tempurl=explode("?",$productURL);
		}
	
		$productIndividualPrice=getProductPrice($linkArray, $tempurl[0]);
		if($productIndividualPrice==$alertCreatedPrice[$i++] && $productIndividualPrice!=''){
			echo "<br>Equal";
		}else{
			echo "<br>greater or less" . $productIndividualPrice;
		}
}

}


?>