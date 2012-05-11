<!DOCTYPE html>
<html lang="en"><head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>Pinterest</title>
<link rel="icon" href="http://passets-cdn.pinterest.com/images/favicon.png" type="image/x-icon">
<link rel="apple-touch-icon-precomposed" href="http://passets-cdn.pinterest.com/images/ipad_touch_icon.png">
<link rel="stylesheet" href="pinassets/pinboard_216e5981.css" type="text/css" media="all">
<script type="text/javascript">var _sf_startpt=(new Date()).getTime()</script>
<script type="text/javascript">if (!window.console) { window.console = {log: function(){}} };</script>
<script src="assets/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.colorbox.js" type="text/javascript"></script>

<script type="text/javascript">
function getb(){
var url='getboards.php';
var query;
$(".sortable").text('');
		query=$("#userid").val();
		//$("#pinners").html('<img src="assets/img/spinner.gif" alt="Wait" align="middle"/>');
		$.getJSON(url+'?userid='+query,function(json){
		$.each(json,function(i,tweet){
			   $(".sortable").append('<li><div class="pin pinBoard" id="board56084026548594214"><h3 class="serif"><a href="showproducts.php?id='+tweet[1]+'">'+tweet[0]+'</a></h3>'+
				            '<h4>'+ tweet[3]+'</h4> <div class="board">'+  
						    '<div class="PinHolder">'+
				            '<div class="actions">'+
				            '<a class="Button Button11 WhiteButton" href="#">'+
				            '<strong><em></em>Add Alert</strong><span></span>'+
				            '</a>'+
				            '</div>'+
				            '</div>'+
				            '<a href="#" class="link">&nbsp;</a>'+
				          	'<div class="holder"><span class="cover"><img src="'+tweet[2]+'" style="opacity: 1;" onload="this.style.opacity=1" onerror="this.src = this.src.replace("_222.jpg", "_b.jpg"); this.onerror = null; return false;">'+
				            '</span></div><div class="followBoard"></div></div></div></li>');
		});
		});
	
	}

</script>
<script>
			$(document).ready(function(){
				//Examples of how to assign the ColorBox event to elements
				$(".ajax").colorbox();
				$(".iframe").colorbox({iframe:true, width:"80%", height:"80%"});
				//Example of preserving a JavaScript event for inline calls.
				$("#click").click(function(){ 
					$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
					return false;
				});
			});
		</script>


</head>

<body class="extraScroll" id="profile">
<!-- Header Starts -->
<div id="Header">
    <div class="FixedContainer HeaderContainer">
<a href="#" id="Pinterest"><img src="pinassets/LogoRed.png" alt="Pinterest Logo" width="100" height="26"></a>
<ul id="Navigation">
    <li>
        <a href="#" class="nav">About<span></span></a>
        <ul>
            <li><a href="#">Help</a></li>
            <li class="divider"><a href="#">Terms of Service</a></li>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Copyright</a></li>
            <li><a href="#">Trademark</a></li>
        </ul>
    </li>
        <li><a href="#" class="nav LoginNav">Login</a></li>
</ul>
</div>
</div>

<!-- Header Ends -->

<div style="padding:5px; font-size:14px; margin-bottom:10px; width:400px; ">
<div style="margin:10px;">
<div style="width:150px;  float:left;" id="username" >Pinterest User ID:</div>
<div ><input name="userid" value="" class="userid" id="userid"/></div>
</div>
<div style="margin:10px;">
<div style="width:150px;  float:left;" id="username" >User Email:</div>
<div ><input name="Email" value=""/></div>
</div>
<div style="margin:auto; text-align:center;"><input type="submit" name="submit" value="Search" class="getboard" onclick="getb();"/></div>





</div>


<!-- Summary Starts 
<div id="ContextBar" class="container sticky">
   <div class="FixedContainer">
            <ul class="links">
                <li><a href="#" class="selected"><strong>10</strong> Boards</a></li>
                <li><a href="#"><strong>46</strong> Pins</a></li>
                <li><a href="#"><strong>1</strong> Like</a></li>
                <li>
                    <a href="#">Activity</a>
                </li>
            </ul>
            <ul class="follow">
                <li><a href="#"><strong>14</strong> followers</a></li>
                <li><a href="#"><strong>17</strong> following</a></li>
            </ul>
        </div>
</div>
<div style="height: 48px; width: 10px; display: none;"></div>
Summary Ends -->


<div style="width: 933px; visibility: visible;" id="wrapper" class="BoardLayout">
   <div id="ColumnContainer">
       <div id="SortableButtons">
            <h2 style="opacity: 0;" class="colorless">Rearrange Boards</h2>
            <h3 style="opacity: 0;" class="colorless">Drag around your boards to reorder them.</h3>
       </div>
<ul class="sortable">
    
    
 </ul>
 <!-- <p><a class='ajax' href="content.php" title="Homer Defined">Outside HTML (Ajax)</a></p>
<p><a class='iframe' href="content.php">Outside Webpage (Iframe)</a></p> -->
        </div>

	</div>

</body></html>