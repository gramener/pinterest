
<?php

$app_id = "377099469008437";
$app_secret = "1d8f3a70d89dfc12831837f65a1e518c";
$my_url = "http://localhost:8011/pin/facebook.php";

session_start();
 if(isset($_REQUEST["code"])){
 	$code = $_REQUEST["code"];	
}

if(empty($code)) {
	$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
	$dialog_url = "https://www.facebook.com/dialog/oauth?client_id="
	. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
	. $_SESSION['state'];

	echo("<script> top.location.href='" . $dialog_url . "'</script>");
}
if($_SESSION['state'] && ($_SESSION['state'] === $_REQUEST['state'])) {
	$token_url = "https://graph.facebook.com/oauth/access_token?"
	. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
	. "&client_secret=" . $app_secret . "&code=" . $code;
	$response = file_get_contents($token_url);
	$params = null;
	parse_str($response, $params);
	$graph_url = "https://graph.facebook.com/me?access_token="
	. $params['access_token'];
	$user = json_decode(file_get_contents($graph_url));
	print_r($user);
	echo("Hello " . $user->name);
}
else {
	echo("The state does not match. You may be a victim of CSRF.");
}

?>
