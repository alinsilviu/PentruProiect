
<?php

if (!isset($_COOKIE['user_id'])) {
	require ('login_functions.inc.php');
	redirect_user();
} else {
	setcookie ('user_id', '', time()-3600, '/', '', 0, 0);
	setcookie ('first_name', '', time()-3600, '/', '', 0, 0);
}
$page_title = 'Logged Out!';
include ('includes/header.html');
echo "<div class='col-md-4 col-md-offset-4 text-center'><h1><span class='label label-default'>Logged Out!</h1><p><b>You are now logged out, <em>{$_COOKIE['first_name']}</em>!<b></p></div>";
header("refresh: 1; url=index.php");
?>