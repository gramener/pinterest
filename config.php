<?php
include_once'constants.php';
# Connect to MYSQL Server
$link = mysql_connect($HOST, $USERNAME, $PASSWORD) or 
		die("<h1>Unable to connect MYSQL Server.(Check Constant.php File)<br/>
		Reason:<br/>
		<ul>
		<li>MYSQL Server Username/Password may wrong</li>
		<li>MYSQL Host Address</li>
		</ul>
		</h1>");


# Make radials is the current db
$db_selected = mysql_select_db($DATABASE, $link)or 
		die("<h1>Unable to connect Database $DATABASE.(Check Constant.php File)<br/>
		Reason:<br/>
		<ul>
		<li>MYSQL Server don't have database name : $DATABASE </li>
		</ul>
		</h1>");
?>