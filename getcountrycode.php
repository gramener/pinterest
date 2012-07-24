<?php
/*
 * Author: Jayaseelan Gabriel
 * This is used to find the country name
 * run: getcountrycode.php?domain=<DOMAIN NAME>
 */


require_once 'simple_html_dom.php';
 $domain=trim($_GET['domain']);


$url="http://clues.yahoo.com/analysis#q1=$domain&q2=&tu=month";

echo $url;

$str = <<<HTML
<div class="controls" id="yui_3_3_0_2_1342685607372617">
                      
                      <ol idx="0" id="yui_3_3_0_2_1342685607372647">
                        <li id="yui_3_3_0_2_1342685607372651"><span id="yui_3_3_0_2_1342685607372656">1.</span><i _woeid="23424975" id="yui_3_3_0_2_1342685607372650">United Kingdom</i><b style="width:100%"></b><em>100</em></li>
                        <li id="yui_3_3_0_2_1342685607372660"><span id="yui_3_3_0_2_1342685607372659">2.</span><i _woeid="23424803">Ireland</i><b style="width:27%"></b><em>27</em></li>
                        <li id="yui_3_3_0_2_1342685607372664"><span id="yui_3_3_0_2_1342685607372663">3.</span><i _woeid="23424977">United States</i><b style="width:21%"></b><em>21</em></li>
                        <li id="yui_3_3_0_2_1342685607372646"><span>4.</span><i _woeid="23424922" id="yui_3_3_0_2_1342685607372645">Pakistan</i><b style="width:17%"></b><em>17</em></li>
                        <li id="yui_3_3_0_2_1342685607372677"><span>5.</span><i _woeid="23424910">Norway</i><b style="width:4%"></b><em>4</em></li>
                      </ol>
                      <ol idx="1" id="yui_3_3_0_2_1342685607372616">
                        <li><span>6.</span><i _woeid="23424925">Portugal</i><b style="width:4%"></b><em>4</em></li>
                        <li id="yui_3_3_0_2_1342685607372622"><span>7.</span><i _woeid="23424909" id="yui_3_3_0_2_1342685607372621">Netherlands</i><b style="width:3%"></b><em>3</em></li>
                        <li><span>8.</span><i _woeid="23424748">Australia</i><b style="width:3%"></b><em>3</em></li>
                        <li id="yui_3_3_0_2_1342685607372615"><span>9.</span><i _woeid="23424824">Ghana</i><b style="width:3%"></b><em>3</em></li>
                        <li><span>10.</span><i _woeid="23424938">Saudi Arabia</i><b style="width:3%"></b><em>3</em></li>
                      </ol>
                      <div class="clear"></div>
             </div>
HTML;

$html = file_get_html($url);
foreach($html->find('div[class=controls]ol') as $ul) {
	foreach($ul->find('li') as $li)
		echo $li->innertext . '<br>';
}


//echo $countryName;

/* $url = "http://trends.google.com/websites?q=$domain&geo=all&date=all&sort=0";
// Code for get all boards
$html = file_get_html($url);
$countryName=$html->find("div[class=trends-barchart-table-c]",0)->find("td[class=trends-barchart-name-cell]",0)->find("a",0)->plaintext;
 */
/* $ini_array = parse_ini_file("pinterest.ini", true);
if(isset($ini_array['cc'][$countryName])){
return $ini_array['cc'][$countryName];
}else{
	return null;
} */
?>