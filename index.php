<?php
/*
 * author: Jayaseelan Gabriel
 * Run: index.php?userid=ID
 *
 */
require_once 'simple_html_dom.php';

$userid= trim($_GET['userid']);
$url = "http://pinterest.com/$userid/";
$html = file_get_html($url);
$rs = array();
foreach($html->find('div[class=pinBoard]') as $pin){
    foreach($pin->find('h3') as $boardname){
        $rs[] = array(
            $boardname->plaintext,
            $boardname->find('a', 0)->href
        );
    }
}

header('Content-type: application/json');
echo json_encode($rs);
?>
