<?php 
session_start();


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
//if(isset($_SESSION['pinnerid'])){
//$userid= trim($_SESSION['pinnerid']);
//}else{
	$userid=trim($_REQUEST['pinnerid']);
//}

$url = "http://pinterest.com/$userid/";

echo $url;
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



<link rel="stylesheet" href="scroller/css/feature-carousel.css" charset="utf-8" />
    <script src="scroller/js/jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="scroller/js/jquery.featureCarousel.js" type="text/javascript" charset="utf-8"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        var carousel = $("#carousel").featureCarousel({
        	
          // include options like this:
          // (use quotes only for string values, and no trailing comma after last option)
          // option: value,
          // option: value
        });
        carousel.pause();
        
        $("#but_prev").click(function () {
          carousel.prev();
        });
      
        $("#but_next").click(function () {
          carousel.next();
        });
      });


     
    </script>
<!--  Custom javascript for get pinners,getboards and getproducts -->
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
     
<div style="padding-top:50px;">
</div>
     
    <div class="carousel-container">
    
      <div id="carousel">
      
      <?php foreach($rs as $result){?>
        <div class="carousel-feature">
          <a href="showproducts.php?id=<?php echo $result[1];?>">
		  <img class="carousel-image" alt="" src="<?php echo $result[2];?>"></a>
          <div class="carousel-caption">
            <p>
             <?php echo $result[0];?>
            </p>
          </div>
          </div>
      <?php }?>
        
      </div>
    
      <div id="carousel-left"><img src="scroller/images/arrow-left.png" /></div>
      <div id="carousel-right"><img src="scroller/images/arrow-right.png" /></div>
    </div>
     
     
     <div id="products">
     
     </div>
     
     
     
      <footer>
        <p>&copy; Company 2012</p>
      </footer>

</div>
    
  </body>
</html>
