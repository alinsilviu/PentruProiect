<?php 

$page_title = 'Delete a User';
include ('includes/header2.html');

 ?>

<div id="middle" class="col-md-4 col-md-offset-4 text-center">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Delete a User</b></h3>
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
	if ($_POST['sure'] == 'Yes') {
		$q = "DELETE FROM users WHERE user_id=$id LIMIT 1";
		$r = @mysqli_query ($dbc, $q);
		if (mysqli_affected_rows($dbc) == 1) {
			echo '<p>The user has been deleted.</p>';
		} else {
			echo '<p class="eror"><b>The user could not be deleted due to a system error.</b></p>';
			echo '<p>' . mysqli_error($dbc) . '<br />Query: ' . $q . '</p>';
		}
	} else {
		echo '<p><b>The user has NOT been deleted.</b></p>';
	}
} else {
	$q = "SELECT CONCAT(last_name, ',', ' ', first_name) FROM users WHERE user_id=$id";
	$r = @mysqli_query ($dbc, $q);
	if (mysqli_num_rows($r) == 1) {
		$row = mysqli_fetch_array ($r, MYSQLI_NUM);
		echo "<h3><b>Name: $row[0]</b></h3><b>Are you sure you want to delete this user?</b>";
		echo '<form action="delete_user.php" method="post">
			<input type="radio" name="sure" value="Yes" /> <b>Yes</b>
			<input type="radio" name="sure" value="No" /> <b>No</b>
			<div class="form-group"><div><input type="submit" name="submit" value="Submit" style="background: #337ab7; color: #fff; font-weight: bold; border: 0" /></div></div>
			<input type="hidden" name="id" value="' . $id . '" />
			</form>';
	} else {
		echo '<p class="error"><b>This page has been accessed in error.</b></p>';
	}
}

mysqli_close($dbc);
?>
		</div>
	</div>
</div>