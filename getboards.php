<?php
/*
 * author: Jayaseelan Gabriel
 * Run: getboards.php?userid=ID
 *
 */
require_once 'simple_html_dom.php';

// new code 
function getTextBetweenTags($string) {
	//"totalPages": 7
	$pattern = "/totalPages\": (\d)/";
	preg_match($pattern, $string, $matches);
	if(count($matches)>0){
		return str_replace('"',"",$matches[0]);
	}
	return '';
}

// End
// Trim user ID
$userid= trim($_GET['userid']);
$url = "http://pinterest.com/$userid/";
// Code for get all boards
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

// End new code




$rs = array();
for($i=1;$i<=$totalPages;$i++){

	$url = "http://pinterest.com/$userid/?page=".$i;
	$html = file_get_html($url);
	
foreach($html->find('div[class=pinBoard]') as $pin){
	foreach($pin->find('h3') as $boardname){
		if($pin->find('span[class=cover] img',0)==null){
		$rs[] = array(
				$boardname->plaintext,
				$boardname->find('a', 0)->href,
				'#',
				$pin->find('h4', 0)->plaintext
				
		);
		}else{
			$rs[] = array(
					$boardname->plaintext,
					$boardname->find('a', 0)->href,
					$pin->find('span[class=cover] img',0)->src,
					$pin->find('h4', 0)->plaintext
					
			);
		}
	}
}
}
header('Content-type: application/json');
echo json_encode($rs);
?>
