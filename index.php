<?php

$page_title = 'Home';

if (!isset($_COOKIE['user_id'])) {
	include ('includes/header.html');
} else {
	include ('includes/header2.html');
}

?>