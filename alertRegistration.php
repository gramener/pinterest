<?php 
include_once 'utility.php';
session_start();

?>

<?php 
 $errors=array();
 $pinid="";
 $email="";
 $password="";
 $errorKeys = parse_ini_file("error.ini");
 
 if(!isset($_SESSION['pinnerid']) && !isset($_SESSION['pinid'])){
 $pinId=$_GET['pinid'];
 $pinnerId=$_GET['pinnerId'];
 $_SESSION['pinnerid']=$pinnerId;
 $_SESSION['pinid']=$pinId;
 }
 $loginType="0";
  if(isset($_POST['pinnerid'])){
  	$loginType=1;
  	$pinnerid=trim($_POST['pinnerid']);
  	$email=trim($_POST['email']);
  	$password=trim($_POST['password']);
  	$errors=validateRegistration($pinnerid, $email, $password);
  	
  	if(count($errors)==0){
  		$res=insertRegistrationDetails($pinnerid, $email, $password);
  		$_SESSION['pinnerid']=$pinnerid;
  		$_SESSION['email']=$email;
  		$_SESSION['auth']=true;
  		header("Location: showindividualProduct.php?auth=true");
  	}
  }
  
  $message="";
  if(isset($_POST['existinguser'])){
  	$loginType=2;
  	$email=trim($_POST['email']);
  	$password=trim($_POST['password']);
  	$errors=validateRegistration("test", $email, $password);
  	if(checkExistingUser($email, $password) && count($errors)==0){
  	$_SESSION['email']=$email;
  	$_SESSION['auth']=true;
  	header("Location: showindividualProduct.php?auth=true");
  }else{
  	$message="Invalid username/password";
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
	
	<div class="row" style="padding-top: 50px;">
	&nbsp;
	</div>
	
    <div class="row">
    <div class="span12">
    
      <form class="form-horizontal" action="" method="POST">
      
        <fieldset>
          <div class="control-group">
            <label for="input01" class="control-label">Pinterest User Id</label>
            <div class="controls">
              <input type="text" id="pinid"  name="pinnerid" class="input-xlarge" value="<?php echo $_SESSION['pinnerid'];?>">
              <p class="help-block">This shuould be the pinterest userid</p>
            </div>
            <div>
             <?php 
             if(array_key_exists('1',$errors) && $loginType==1){
             	
             echo '<font color=red>' . $errorKeys[1] . '</font>';
             	
            }
            if(array_key_exists('5',$errors) && $loginType==1){
            
            	echo '<font color=red>' . $errorKeys[5] . '</font>';
            
            }
            ?>
            </div>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">Email</label>
            <div class="controls">
              <input type="text" id="email" name="email" class="input-xlarge">
            </div>
             <?php 
             if(array_key_exists('2',$errors) && $loginType==1){
             echo '<font color=red>' . $errorKeys[2] . '</font>';
             }
             if(array_key_exists('3',$errors) && $loginType==1){
             echo '<font color=red>' . $errorKeys[3] . '</font>';
             }
            ?>
          </div>
          <div class="control-group">
            <label for="input01" class="control-label">Password</label>
            <div class="controls">
              <input type="password" id="password" name="password" class="input-xlarge">
            </div>
            <div>
            <?php 
            if(array_key_exists('4',$errors) && $loginType==1){
            	echo '<font color=red>' . $errorKeys[4] . '</font>';
            }
            ?>
            </div>
          </div>
          <div class="control-group"> <div class="controls">
          <button class="btn btn-primary">Create Account</button>
          </div>
          </div>
         </fieldset>
      </form>
      </div>
  </div>

   <div class="row">
    <div class="span12">
    <label > Existing User: </label>
    <br/>
    <font color="red"><?php echo $message;?></font>
      <form class="form-horizontal" action="" method="POST">
      
      

      
       <div class="control-group">
            <label for="input01" class="control-label">Email</label>
            <div class="controls">
              <input type="text" id="email" name="email" class="input-xlarge">
            </div>
             <?php 
             if(array_key_exists('2',$errors) && $loginType==2){
             echo '<font color=red>' . $errorKeys[2] . '</font>';
             }
             if(array_key_exists('3',$errors) && $loginType==2){
             echo '<font color=red>' . $errorKeys[3] . '</font>';
             }
            ?>
          </div>
          
          <div class="control-group">
            <label for="input01" class="control-label">Password</label>
            <div class="controls">
              <input type="password" id="password" name="password" class="input-xlarge">
            </div>
            <div>
            <?php 
            if(array_key_exists('4',$errors) && $loginType==2){
            	echo '<font color=red>' . $errorKeys[4] . '</font>';
            }
            ?>
            </div>
          </div>
           <div class="control-group"> <div class="controls">
          <button class="btn btn-primary">Log in</button>
          </div>
          </div>
          <input type="hidden" name="existinguser" value="y">
      
      </form>
      </div>
      </div>
  
  
      <footer>
        <p>&copy; Company 2012</p>
      </footer>

</div>
    
  </body>
</html>
