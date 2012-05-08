<?php
/*
* author: Jayaseelan Gabriel
* Run: getproductlist.php?userid=ID&boardname=BOARDNAME
*example: http://localhost/<appname>/getproductlist.php?userid=rockey_nebhwani&boardname=value-clocks
*/
require_once 'simple_html_dom.php';
function getTextBetweenTags($string) {
	//"totalPages": 7
	$pattern = "/totalPages\": (\d)/";
	preg_match($pattern, $string, $matches);
	if(count($matches)>0){
		return str_replace('"',"",$matches[0]);
	}
	return '';
}

$userid= trim($_GET['userid']);
$boardname=trim($_GET['boardname']);
$url = "http://pinterest.com/$userid/$boardname/";
$html = file_get_html($url);

$totalnumberofpage='';
foreach($html->find('script') as $e){
	$x=getTextBetweenTags($e);
	if($x!=''){
		$totalnumberofpage=$x;
	}
}
if($totalnumberofpage!=''){
	$arr=explode(":",$totalnumberofpage);
	$totalPages= trim($arr[1]);
}else{
	$totalPages=1;
}

$rs = array();
$productName='';
$productURL='';

for($i=1;$i<=$totalPages;$i++){
	$url = "http://pinterest.com/$userid/$boardname/?page=".$i;
	$html = file_get_html($url);
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
}
header('Content-type: application/json');
echo json_encode($rs);




?>