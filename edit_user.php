<?php 

$page_title = 'Edit a User';
include ('includes/header2.html');

 ?>

<div id="middle" class="col-md-4 col-md-offset-4 text-center">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Edit a User</b></h3>
		  </div>
			<div class="panel-body">

<?php

if ((isset($_GET['id'])) && (is_numeric($_GET['id']))) {
	$id = $_GET['id'];
} elseif ((isset($_POST['id'])) && (is_numeric($_POST['id']))) {
	$id = $_POST['id'];
} else {
	echo '<p class="error"><b>This page has been accessed in error.</b></p>';
	exit();
}
require_once ('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$errors = array();
	if (empty($_POST['first_name'])) {
		$errors[] = 'You forgot to enter your first name.';
	} else {
		$fn = mysqli_real_escape_string($dbc, trim($_POST['first_name']));
	}
	if (empty($_POST['last_name'])) {
		$errors[] = 'You forgot to enter your last name.';
	} else {
		$ln = mysqli_real_escape_string($dbc, trim($_POST['last_name']));
	}
	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	if (empty($errors)) {
		$q = "SELECT user_id FROM users WHERE email='$e' AND user_id != $id";
		$r = @mysqli_query($dbc, $q);
		if (mysqli_num_rows($r) == 0) {
			$q = "UPDATE users SET first_name='$fn', last_name='$ln', email='$e' WHERE user_id=$id LIMIT 1";
			$r = @mysqli_query ($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) {
				echo '<p><b>The user has been edited.</b></p>';
			} else {
				echo '<p class="error"><b>The user could not be edited due to a system error. We apologize for any inconvenience.</b></p>';
				echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
			}
		} else {
			echo '<p class="error"><b>The email address has already been registered.</b></p>';
		}
	} else {
		echo '<p class="error"><b>The following error(s) occured:</b><br />';
		foreach ($errors as $msg) {
			echo " - $msg<br />\n";
		}
		echo '</p><h4><span class="label label-warning">Please try again.</span></h4>';
	}
}

$q = "SELECT first_name, last_name, email FROM users WHERE user_id=$id";
$r = @mysqli_query ($dbc, $q);

if (mysqli_num_rows($r) == 1) {
	$row = mysqli_fetch_array ($r, MYSQLI_NUM);
	echo '<form class="form-horizontal" action="edit_user.php" method="post">
		<div class="form-group"><div class="col-md-8 col-md-offset-2"><input class="form-control" type="text" name="first_name" size="15" maxlength="15" placeholder="First Name" value="' . $row[0] . '" /></div></div>
		<div class="form-group"><div class="col-md-8 col-md-offset-2"><input class="form-control" type="text" name="last_name" size="15" maxlength="30" placeholder="Last Name" value="' . $row[1] . '" /></div></div>
		<div class="form-group"><div class="col-md-8 col-md-offset-2"><input class="form-control" type="email" name="email" size="20" maxlength="60" placeholder="Email Address" value="' . $row[2] . '" /></div></div>
		<div class="form-group"><div><input type="submit" name="submit" value="Submit" style="background: #337ab7; color: #fff; font-weight: bold; border: 0" /></div></div>
		<input type="hidden" name="id" value="' . $id . '" />
		</form>';
} else {
	echo '<p class="error">This page has been accessed in error.</p>';
}

mysqli_close($dbc);
?>
		</div>
	</div>
</div>