<?php
include_once 'utility.php';
session_start();

if(!isset($_REQUEST['auth'])){
$pinid=$_REQUEST['pinid'];
$pinnerId=$_REQUEST['pinnerId'];
$id=$_REQUEST['id'];
$_SESSION['id']=$id;
}

if(isset($_SESSION['auth']) && isset($_REQUEST['currentPrice'])){
	$_SESSION['pinid']=$_REQUEST['pinid'];
	$_SESSION['pinnerid']=$_REQUEST['pinnerId'];
	$id=$_REQUEST['id'];
}

if(isset($_REQUEST['currentPrice'])){
	$currentPrice=$_REQUEST['currentPrice'];
	$_SESSION['currentPrice']=$currentPrice;
}

if(isset($_REQUEST['rfa'])){
	$_SESSION['requestType']="rfa";
}else{
	$_SESSION['requestType']="ata";
}


if(isset($_REQUEST['productURL'])){
	$productURL=$_REQUEST['productURL'];
	$_SESSION['productURL']=$productURL;
	
}


if(!isset($_SESSION['pinnerid'])&& !isset($_SESSION['email'])){
	header("Location: alertRegistration.php?pinid=$pinid&pinnerId=$pinnerId");
	return;
}

?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <title></title>
        
        <link rel="icon" href="http://passets-cdn.pinterest.com/images/favicon.png" type="image/x-icon" />
        <link rel="apple-touch-icon-precomposed" href="http://passets-cdn.pinterest.com/images/ipad_touch_icon.png" />
        <link rel="stylesheet" href="http://passets-cdn.pinterest.com/css/pinboard_a38aaafa.css" type="text/css" media="all"/>
        <!--[if (gt IE 6)&(lt IE 9)]><link rel="stylesheet" href="http://passets-cdn.pinterest.com/css/ie7-and-up_83d98ccb.css" type="text/css" media="all" /><![endif]-->
        <script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
        <script type="text/javascript">if (!window.console) { window.console = {log: function(){}} };</script>
        <script type="text/javascript">window.repinExperiment = "";</script>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
        <script src="http://passets-cdn.pinterest.com/js/bundle_pin_4d500df1.js" type="text/javascript" charset="utf-8"></script>

    </head>
    
<body>

	

<div id="Header">
<div class="LiquidContainer HeaderContainer">
<a href="/" id="Pinterest"><img src="http://passets-cdn.pinterest.com/images/LogoRed.png" width="100" height="26" alt="Pinterest Logo" /></a>
<!-- top level Menu -->
<ul id="Navigation">
	<li>
        <a href="/about/" class="nav">About<span></span></a>
        <ul>
            <li><a href="/about/help/">Help</a></li>
            <li class="divider"><a href="/about/terms/">Terms of Service</a></li>
            <li><a href="/about/privacy/">Privacy Policy</a></li>
            <li><a href="/about/copyright/">Copyright</a></li>
            <li><a href="/about/trademark/">Trademark</a></li>
        </ul>
    </li>
    <li><a href="logout.php" class="nav LoginNav">Logout</a></li>
</ul>
</div>
</div>


<div id="ColumnContainer" style="margin-top: 100px;">


<?php 


if($_SESSION['requestType']=='ata'){

$pinid=$_SESSION['pinid'];
$pinnerId=$_SESSION['pinnerid'];
$currentPrice=$_SESSION['currentPrice'];
$alertCreatedDate=date('Y-m-d');
$productURL=$_SESSION['productURL'];
addPinalerts("$pinid", "$pinnerId", "1", "y", "0", "$currentPrice", $alertCreatedDate, "$productURL");
echo "Your product addded into our database..";

?>


<br/>
<?php }

if($_SESSION['requestType']=='rfa'){
	$pinid=$_SESSION['pinid'];
	$pinnerId=$_SESSION['pinnerid'];
	delatePinalertsbyPinIdandPinnersId($pinid,$pinnerId);
	echo "Product remove from our database...";
}
?>

<a href="showproducts.php?id=<?php echo $_SESSION['id'];?>">Back to products</a>

</div>


</body>

</html>