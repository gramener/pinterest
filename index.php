<?php
/*
 * author: Jayaseelan Gabriel
 * Run: index.php?userid=ID
 *
 */
$userid= trim($_GET['userid']);
/* update your path accordingly */
include_once 'simple_html_dom.php';
$url = "http://pinterest.com/".$userid."/";
$html = file_get_html($url);
$pinboard =  $html->find('div[class=pin pinBoard]');
$json=array();
$i=0;
$rs=array();
foreach($pinboard as $pin){
	$boardnames = $pin->find('a');
	foreach($boardnames as $boardname){
    	//echo $a->plaintext. "<br>";
    	if($boardname->plaintext!='&nbsp;'){
    	$rs[$i++]=$boardname->plaintext;
    	}
    }
}
$json=array("boards"=>$rs);
echo json_encode($json);

?>
