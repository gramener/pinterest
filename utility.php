<?php

require_once 'simple_html_dom.php';
include_once 'config.php';

function getProductIdfromURL($url){
		preg_match_all('!/\d+,!', $url, $matches);
		if(isset($matches[0][0])){
	    return str_replace(array(",","/"),"",$matches[0][0]);
		}else{
			return null;
		}
}


function duplicateUpdatePinalerts($pinid,$pinnerid,$isproduct,$pinstatus,$alertSend,$alertCreatedPrice,$alertCreatedDate,$productURL){
	$query="INSERT INTO tbl_pinalerts (`pinID`,`pinnerID`,`isProduct`,
			`pinStatus`,`alertSent`,`alertCreatedPrice`,`alertCreatedDate`,`productURL`) 
			VALUES ('$pinid','$pinnerid','$isproduct','$pinstatus','$alertSend','$alertCreatedPrice','$alertCreatedDate','$productURL') ON DUPLICATE KEY UPDATE 
			`alertCreatedPrice`='$alertCreatedPrice',`alertCreatedDate`='$alertCreatedDate',`productURL`='$productURL'";

	mysql_query($query);
}


function  getPricebyProductID($pid){
	
	$query="SELECT * FROM `pt_products` WHERE `buy_url` like '%$pid%'";
	$result=mysql_query($query);
	while($tmp=mysql_fetch_array($result)){
		return $tmp['price'];
	}
	
}

function ispinterestIdAvailable($pinid){
	$query="SELECT * FROM `tbl_userdetails` WHERE `pinnerID`='$pinid'";
	$result=mysql_query($query);
	if(mysql_num_rows($result)){
		return true;
	}else{
		return false;
	}
}

function getuserDetailsByPinnerId($pinnerid){
	$query="SELECT * FROM `tbl_userdetails` WHERE `pinnerID`='$pinnerid'";
	
	$result=mysql_query($query);
	
	
	
	$details=array();
	while($tmp=mysql_fetch_array($result)){
		$details['EMAIL']=$tmp['emailID'];
		$details['FNAME']=$tmp['firstName'];
		$details['LNAME']=$tmp['lastName'];
	}
	
	return $details;
}

function checkExistingUser($email,$password){
	
	$query="SELECT * FROM `tbl_userdetails` WHERE `emailID`='$email' `password` ='" . md5($password) ."'";
	$result=mysql_query($query);
	return count(mysql_num_rows($result));
	
}


function delatePinalertsbyPinIdandPinnersId($pinid,$pinnerid){
	
	$query="DELETE FROM `tbl_pinalerts` WHERE `pinID` = '$pinid' AND `pinnerID` = '$pinnerid'";
	mysql_query($query);
	
}


function getAllProductURL(){
	$query="SELECT `productURL` FROM `tbl_pinalerts`";
	$result=mysql_query($query);
	$productURLArray=array();
	while($tmp=mysql_fetch_array($result)){
		$productURLArray[]=$tmp['productURL'];
	}
	return $productURLArray;
}

function getAllPinalerts(){
	$query="SELECT * FROM `tbl_pinalerts` order by pinnerId";
	$result=mysql_query($query);
	$pinalertsArray=array();
	
	while($tmp=mysql_fetch_array($result)){
		$pinalertsArray[$tmp['pinnerID']][]= array(
				"URL"=>$tmp['productURL'],
				"pinID"=>$tmp['pinID'],
				"pinnerID"=>$tmp['pinnerID'],
				"alertCreatedPrice"=>$tmp['alertCreatedPrice']				
				);
	}
	return $pinalertsArray;
}

function sendCustomMail(){
	
}

function getPinalertsByPinId($pinid){
	$query="SELECT * FROM `tbl_pinalerts` WHERE `pinID`=" .$pinid;
	$result=mysql_query($query);
	return $result;
}

function getPinsByPinnerId($pinnerId){
	$query="SELECT `pinID` FROM `tbl_pinalerts` WHERE `pinnerID`='$pinnerId' and `pinStatus`='y'";
	$result=mysql_query($query);
	$pinids=array();
	while($tmp=mysql_fetch_array($result)){
		$pinids[$tmp['pinID']]=$tmp['pinID'];
	}
	return $pinids;
	
}

function addPinalerts($pinid,$pinnerId,$isProduct,$pinStatus,$alertSend,$alertCreatedPrice,$alertCreatedDate,$productURL){
$query="INSERT INTO `tbl_pinalerts` (
`pinID` ,`pinnerID` ,`isProduct` ,`pinStatus` ,
`alertSent` ,`alertCreatedPrice` ,`alertCreatedDate` ,
`productURL`)
VALUES ('$pinid', '$pinnerId', '$isProduct', '$pinStatus', '$alertSend', '$alertCreatedPrice', '$alertCreatedDate', '$productURL')";

mysql_query($query);

}

function insertRegistrationDetails($pinid,$email,$password,$fname,$lname){
	$query= "INSERT INTO tbl_userdetails(pinnerID,registrationDate,alertThreshold,firstName,lastName,emailID,password)
			VALUES ( '$pinid', CURRENT_TIMESTAMP , '10', '$fname','$lname','$email', MD5( '$password' ))";
	
	$result=mysql_query($query);
}

function getcountryCode($domain){
	/* $url = 'http://trends.google.com/websites?q='.$domain;
	
	$html = file_get_html($url);
	$countryName=$html->find("div[class=trends-barchart-table-c]",0)->find("td[class=trends-barchart-name-cell]",0)->find("a",0)->plaintext;
	$ini_array = parse_ini_file("pinterest.ini", true);
	if(isset($ini_array['cc'][$countryName])){
		return $ini_array['cc'][$countryName];
	}else{
		return null;
	
	}  */
	return "GB";
}


// This function will return the json response of product details
function fetchGoogleAPIResults($urlString,$cc){
	
	
	/* This is API key for Google Search API for Shopping */
	/*This query parameter is required to restrict the response elements for faster performance. You can easily find this out looking at response and these are just xpath statements. */
	$fields = 'totalItems,startIndex,itemsPerPage,currentItemCount,items(kind,product/inventories/price,product/inventories/currency,product/inventories/availability,product/link)';
	//$country = GB; /* Hard-coded for now */
	$ini_array = parse_ini_file("pinterest.ini", true);
	$GOOGLE_API_KEY=$ini_array['API']['GOOGLE_API_KEY'];
	$apiEndPoint = 'https://www.googleapis.com/shopping/search/v1/public/products?';
	$format = 'json';
	$apiCall = $apiEndPoint . 'country=' . $cc . '&restrictBy=link:' . $urlString . '&key=' . $GOOGLE_API_KEY . '&fields=' . $fields . '&alt=' . $format;
	//echo "<br><br><br><br>".$apiCall;
	
	return file_get_contents($apiCall);

}

//Remove special Symbol
function cleanProductURLs($productURL){
	$urlElementsArray = parse_url($productURL);
	if(isset($urlElementsArray['query'])){
	$cleanURL = $urlElementsArray['host'] . $urlElementsArray['path'] ;
	
	}else{
		
		$cleanURL = $urlElementsArray['host'] . $urlElementsArray['path'];
		
	}
	/* TODO:str_replace will work only for direct.asda.com URLs. Ideally we need a preg_replace here */
	$url = str_replace(array(",", "~", ".", "/","?","=","&amp;","(",")"), '+', $cleanURL);
	return $url;
}

function getProductPrice($array,$productURL,$type){
	
	if($type=="P"){
		$pid=getProductIdfromURL($productURL);
		if($pid!=null){
			return getPricebyProductID($pid);
		}else{
			return '';
		}
		
	}

	if($type=="G"){
	foreach ($array as $tmp){
	 $tt= explode("?",$tmp['link']);
	 if($tt[0]==$productURL){
	 	return $tmp['inventories'][0]['price'];
	 }
	}
	return '';
	}
}


function search($array, $key)
{
	$results = array();

	if (is_array($array))
	{
		if (isset($array[$key]))
			$results[] = $array;

		foreach ($array as $subarray)
			$results = array_merge($results, search($subarray, $key));
	}

	return $results;
}

function validateRegistration($pinid,$email,$password){
	$error=array();
	
	if(empty($pinid)){
		$error[1]=1;
	}
	
	if(empty($email)){
		$error[2]=2;
	}
	elseif(!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)){
		$error[3]=3;
	}
	if(empty($password)){
		$error[4]=4;
	}
	/* if(ispinterestIdAvailable($pinid)){
		$error[5]=5;
	} */
	
	return $error;
	
}



?>