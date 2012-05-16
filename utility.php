<?php
include_once 'constant.php';
require_once 'simple_html_dom.php';


function getcountryCode($domain){
	/* $url = 'http://trends.google.com/websites?q='.$domain;
	// Code for get all boards
	
	$html = file_get_html($url);
	$countryName=$html->find("div[class=trends-barchart-table-c]",0)->find("td[class=trends-barchart-name-cell]",0)->find("a",0)->plaintext;
	$ini_array = parse_ini_file("pinterest.ini", true);
	if(isset($ini_array['cc'][$countryName])){
		return $ini_array['cc'][$countryName];
	}else{
		return null;
	
	} */
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
	return file_get_contents($apiCall);

}

//Remove special Symbol
function cleanProductURLs($productURL){
	$urlElementsArray = parse_url($productURL);
	if(isset($urlElementsArray['query'])){
	$cleanURL = $urlElementsArray['host'] . $urlElementsArray['path'] . '?' . $urlElementsArray['query'];
	}else{
		$cleanURL = $urlElementsArray['host'] . $urlElementsArray['path'];
	}
	/* TODO:str_replace will work only for direct.asda.com URLs. Ideally we need a preg_replace here */
	$url = str_replace(array(",", "~", ".", "/","?","=","&amp;","(",")"), '+', $cleanURL);
	return $url;
}

function getProductPrice($array,$productURL){

	foreach ($array as $tmp){
	 $tt= explode("?",$tmp['link']);
	 //echo "-t->" . $tt[0] ."<--<br>";
	// echo "-p->" .$productURL . "<---<br>";
	 
	 if($tt[0]==$productURL){
	 	return $tmp['inventories'][0]['price'];
	 }
	}
	return '';
	
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


?>