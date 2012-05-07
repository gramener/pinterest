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
    
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
function hello(str){
var arr=str.split('\/');
var url='getproductlist.php';
$("#product").text("");
$("#product").html('<img src="assets/img/spinner.gif" alt="Wait" />');
$.getJSON(url+"?userid="+arr[1]+"&boardname="+arr[2],function(json){
$("#product").text("");
			$.each(json,function(i,tweet){
			   $("#product").append('<div style="float:left; margin: 1em;;border:1px solid #FF0000;width=100px;height=100px;">'+tweet[0]+'</div>');
			});
});
}

$(document).ready(function(){
var url='index.php';
var query;
	$('.btn').click(function(){
		query=$("#input01").val();
		
		$("#board").html('<img src="assets/img/spinner.gif" alt="Wait" />');
		$.getJSON(url+'?userid='+query,function(json){
$("#board").text("");		
		$.each(json,function(i,tweet){
			   $("#board").append('<div onclick="hello(\''+tweet[1]+'\');" style="float:left; margin: 1em;;border:1px solid #FF0000;width=100px;height=100px;">'+tweet[0]+'</div>');
			});
		});
	});
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
<label class="control-label" for="input01">Pinterest User ID</label>
<div class="controls">
<input type="text" class="input-xlarge" id="input01">
<p class="help-block">please enter a valid pinterest userid</p>
</div>
<button type="submit" class="btn" onclick="getBoard();">Submit</button>
</div>
</fieldset>

<fieldset>
<legend>Avaliable Boards</legend>
<div id="board">

</div>

</fieldset>

<fieldset>
<legend>Product List</legend>
<div id="product">
</div>

</fieldset>      
    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
   

  </body>
</html>
