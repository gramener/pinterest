<?php

include_once 'utility.php';

class test{
	var $hello="helloo";
	function say(){
		echo $this->hello;
	}
}

$t=new test();
$t->say();

?>