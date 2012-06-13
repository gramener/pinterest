<?php 

header("Location: login.php");

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Pinterest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <style>
      body {
        padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
      }
      
      #bd {
	display: inline-block;
	outline: none;
	cursor: pointer;
	text-align: center;
	text-decoration: none;
	margin: 1em;
	font: 14px/100% Arial, Helvetica, sans-serif;
	padding: .4em 1em .45em;
	text-shadow: 0 1px 1px rgba(0,0,0,.3);
	-webkit-border-radius: .5em; 
	-moz-border-radius: .5em;
	border-radius: .5em;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,.2);
	box-shadow: 0 1px 2px rgba(0,0,0,.2);
}

#bd:hover {
	text-decoration: none;
}
#bd:active {
	position: relative;
	top: 1px;
}

.green {
	color: #fff;
	font-weight:bold;
	font-size:1em;
	border: solid 2px #fff;
	background: #a4c733;
	background: -webkit-gradient(linear, left top, left bottom, from(#bedf44), to(#a4c733));
	background: -moz-linear-gradient(top,  #bedf44,  #a4c733);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#bedf44', endColorstr='#a4c733');
}

.blue {
	color: #fff;
	font-weight:bold;
	font-size:1em;
	border: solid 2px #fff;
	background: #2981ad;
	background: -webkit-gradient(linear, left top, left bottom, from(#4aaacd), to(#2981ad));
	background: -moz-linear-gradient(top,  #4aaacd,  #2981ad);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#4aaacd', endColorstr='#2981ad');
}

.blue1 {
	color: #fff;
	font-weight:bold;
	font-size:1em;
	border: solid 2px #fff;
	background: #3373c7;
	background: -webkit-gradient(linear, left top, left bottom, from(#4489de), to(#3373c7));
	background: -moz-linear-gradient(top,  #4489de,  #3373c7);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#4489de', endColorstr='#3373c7');
}

.grey {
	color: #c9c9c9;
	font-weight:bold;
	font-size:1em;
	border: solid 2px #fff;
	background: #eaeaea;
	background: -webkit-gradient(linear, left top, left bottom, from(#f3f3f3), to(#eaeaea));
	background: -moz-linear-gradient(top,  #f3f3f3,  #eaeaea);
	filter:  progid:DXImageTransform.Microsoft.gradient(startColorstr='#f3f3f3', endColorstr='#eaeaea');
}

#group_boards{
	width:100%;
}

.boards{
	margin:1em;
	padding:0.5em;
	float:left;
}
      
</style>
<link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!-- Le fav and touch icons -->
<link rel="shortcut icon" href="assets/ico/favicon.ico">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">
<script src="assets/js/jquery.js"></script>
<script src="assets/js/bootstrap-transition.js"></script>
<script src="assets/js/bootstrap-alert.js"></script>
<script src="assets/js/bootstrap-modal.js"></script>
<script src="assets/js/bootstrap-dropdown.js"></script>
<script src="assets/js/bootstrap-scrollspy.js"></script>
<script src="assets/js/bootstrap-tab.js"></script>
<script src="assets/js/bootstrap-tooltip.js"></script>
<script src="assets/js/bootstrap-popover.js"></script>
<script src="assets/js/bootstrap-button.js"></script>
<script src="assets/js/bootstrap-collapse.js"></script>
<script src="assets/js/bootstrap-carousel.js"></script>
<script src="assets/js/bootstrap-typeahead.js"></script>
<script src="assets/jquery.min.js" type="text/javascript"></script>
<!--  Custom javascript for get pinners,getboards and getproducts -->
<script type="text/javascript">
function getproducts(str){
var arr=str.split('\/');
var url='getproductlist.php';
$("#product").text("");
$("#product").html('<img src="assets/img/spinner.gif" alt="Wait" align="middle" />');
$.getJSON(url+"?userid="+arr[1]+"&boardname="+arr[2],function(json){
$("#product").text("");
			$.each(json,function(i,tweet){
			   $("#product").append('<div id="bd" class="green">'+tweet[0]+'</div>');
			});
		});
}

function getboards(str){
	var url='getboards.php';
	$("#product").text("");
	$("#board").html('<img src="assets/img/spinner.gif" alt="Wait" align="middle"/>');
	$.getJSON(url+'?userid='+str,function(json){
	$("#board").text("");		
	$.each(json,function(i,tweet){
		   $("#board").append('<div id="bd" class="blue" onclick="getproducts(\''+tweet[1]+'\');">'+tweet[0]+'</div>');
		});
	});
}

//getpinners.php
$(document).ready(function(){
var url='getpinners.php';
var query;
	$('.btn').click(function(){
		query=$("#input01").val();
		var dd="http://pinterest.com/source/"+query+"/";
		$("#pinners").html('<img src="assets/img/spinner.gif" alt="Wait" align="middle"/>');
		$.getJSON(url+'?retailerid='+query,function(json){
		$("#pinners").text("");		
		$.each(json.page,function(index,page){
		$.each(json.pinners,function(i,tweet){
			   $("#pinners").append('<div id="bd" class="blue" onclick="getboards(\''+tweet[0]+'\');">'+tweet[0]+'</div>');
		});
		for(var i=2;i<=page;i++){
			$.getJSON(url+'?retailerid='+query+"&page="+i,function(json){
			$("#pin").html('<img src="assets/img/spinner.gif" alt="Wait" align="middle"/>');
			$.each(json.pinners,function(i,tweet){
		    $("#pinners").append('<div id="bd" class="blue" onclick="getboards(\''+tweet[0]+'\');">'+tweet[0]+'</div>');
				});
			});	
		}
		});
	});
	});
$("#pin").text("");
});


</script>
  </head>

  <body>
    
  
  
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="#">Pinterest</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">About</a></li>
              <li><a href="#contact">Contact</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

<div class="container">

<fieldset>
<legend>Pintest</legend>
<div class="control-group">
<label class="control-label" for="input01">Enter the Retailer Domain</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
<p class="help-block">please enter a valid retailer domain</p>
</div>
<button type="submit" class="btn">Submit</button>
</div>
</fieldset>



<div class="container-fluid">
    <div class="row-fluid">
    <div class="span4">
   <fieldset>
<legend>Avaliable Pinners</legend>
<div id="pinners">

</div>
<div id="pin">

</div>
</fieldset>
    </div>
    <div class="span4">
    
    <fieldset>
<legend>Avaliable Boards</legend>
<div id="board">

</div>

</fieldset>
    </div>
    <div class="span4">
    
   <fieldset>
<legend>Product List</legend>
<div id="product">
</div>

</fieldset> 
    </div>
    </div>
    </div>







     
    </div> 
    
    
    
    <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   

  </body>
</html>
