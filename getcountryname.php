<?php
/*
 * Author: Jayaseelan Gabriel
 * This is used to find the country name
 * run: getcountryname.php?domain=<DOMAIN NAME>
 */


require_once 'simple_html_dom.php';
$domain=trim($_GET['domain']);
$url = "http://trends.google.com/websites?q=$domain&geo=all&date=all&sort=0";
// Code for get all boards
$html = file_get_html($url);
$countryName=$html->find("div[class=trends-barchart-table-c]",0)->find("td[class=trends-barchart-name-cell]",0)->find("a",0)->plaintext;
$ini_array = parse_ini_file("pinterest.ini", true);

if(isset($ini_array['cc'][$countryName])){
return $ini_array['cc'][$countryName];
}else{
	return null;
	
}


?>