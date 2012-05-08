<?php
/*
* author: Rockey Nebhwani
* Run: getpinners.php?retailerid=DOMAIN
*example: http://localhost/<appname>/getpinners.php?retailerid=direct.asda.com
*/
require_once 'simple_html_dom.php';
$retailerid= trim($_GET['retailerid']);

$url = "http://pinterest.com/source/$retailerid";
$html = file_get_html($url);


foreach($html->find('div[class=pin] div[class=convo] p') as $pinDetails){
/* Should find a better way to do this. PINs with comments result in additional
 data which we don't need. We get comments inforation as well if we don't check for this.
 I wish 'find' method let me select for multiple classes (e.g. div[class=convo attribution] */    
    if(isset($pinDetails->find('a', 1)->innertext)){
        
        $pinnerID = trim($pinDetails->find('a', 0)->href,'/');
        $pinnerBoards = $pinDetails->find('a', 1)->innertext;
        $pinnerBoardIDs = $pinDetails->find('a',1)->href;
        
        $pinners[$pinnerID] = array($pinnerID);
        $boards[] = array($pinnerBoards);
        $boardIDs[] = array($pinnerBoardIDs);

       }
    
}
  $json=array("pinners"=>$pinners,"boards"=>$boards,"boardids"=>$boardIDs);  
/* Remove duplicate pinners fro the $pinners array and duplicate boards from $boards. Not sure how to make array_unique work */        
    
header('Content-type: application/json');
echo json_encode($json);
//echo json_encode($boards);
//echo json_encode($boardIDs);

?>