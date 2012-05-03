<?php
/*
* author: Jayaseelan Gabriel
* Run: getproductlist.php?userid=ID&boardname=BOARDNAME
*example: http://localhost/<appname>/getproductlist.php?userid=rockey_nebhwani&boardname=value-clocks
*/
require_once 'simple_html_dom.php';
$userid= trim($_GET['userid']);
$boardname=trim($_GET['boardname']);
$url = "http://pinterest.com/$userid/$boardname/";
$html = file_get_html($url);
$rs = array();
$productName='';
$productURL='';
foreach($html->find('div[class=pin]') as $pin){
  foreach($pin->find('p[class=description]') as $desc){
		$productName=$desc->plaintext;
	}
	foreach($pin->find('p[class=NoImage]') as $pinid){
		foreach($pinid->find('a') as $p){
		 $productURL=$p->href;
		}
	}
	$rs[]=array($productName,$productURL);
}

header('Content-type: application/json');
echo json_encode($rs);




?>