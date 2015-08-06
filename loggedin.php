
<?php

if (!isset($_COOKIE['user_id'])) {
	require ('login_functions.inc.php');
	redirect_user();
}
$page_title = 'Logged In!';
include ('includes/header2.html');
echo "<div class='col-md-4 col-md-offset-4 text-center'><h1><span class='label label-success'>Logged In!</span></h1><p><b>You are now logged in, <em>{$_COOKIE['first_name']}</em>!</b></p></div>";
header("refresh: 1; url=index.php");
?>