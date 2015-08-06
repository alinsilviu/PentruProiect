<?php

$page_title = 'Change Your Password';
include ('includes/header2.html');

?>
	<div id="middle" class="col-md-4 col-md-offset-4 text-center">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Change Your Password</b></h3>
		  </div>
			<div class="panel-body">

				<form class="form-horizontal" action="password.php" method="post">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require ('mysqli_connect.php');
	$errors = array();

	if (empty($_POST['email'])) {
		$errors[] = 'You forgot to enter your email address.';
	} else {
		$e = mysqli_real_escape_string($dbc, trim($_POST['email']));
	}
	if (empty($_POST['pass'])) {
		$errors[] = 'You forgot to enter your current password.';
	} else {
		$p = mysqli_real_escape_string($dbc, trim($_POST['pass']));
	}
	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your new password did not match the confirmed password.';
		} else {
			$np = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your new password.';
	}
	if (empty($errors)) {
		$q = "SELECT user_id FROM users WHERE (email='$e' AND pass=SHA1('$p'))";
		$r = @mysqli_query($dbc, $q);
		$num = @mysqli_num_rows($r);
		if ($num == 1) {
			$row = mysqli_fetch_array($r, MYSQLI_NUM);
			$q = "UPDATE users SET pass=SHA1('$np') WHERE user_id=$row[0]";
			$r = @mysqli_query($dbc, $q);
			if (mysqli_affected_rows($dbc) == 1) {
				echo '<h1><span class="label label-success">Thank you!</span></h1><p><b>Your password has been updated. In Chapter 12 you will actually be able to log in!</b></p><p><br /></p>';
			} else {
				echo '<h1><span class="label label-danger">System Error</span></h1><p class="error"><b>Your password could not be changed dcue to a system error. We apologize for any inconvenience.</b></p>';
				echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
			}
			mysqli_close($dbc);
			include ('includes/footer.html');
			exit();
		} else {
			echo '<h1><span class="label label-danger">Error!</span></h1><p class="error"><b>The email address and password do not match those on file.</b></p>';
		}
	} else {
		echo '<h1><span class="label label-danger">Error!</span></h1><p class="error"><b>The following error(s) occurred:</b><br />';
		foreach ($errors as $msg) {
			echo " = $msg<br />\n";
		}
		echo '</p><h4><span class="label label-warning">Please try again.</span></h4>';
	}
	mysqli_close($dbc);
}
?>
					
					<div class="form-group">	
						<div class="col-md-8 col-md-offset-2">
							<input type="text" class="form-control" name="email" size="20" maxlength="60" placeholder="Your Email Address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
						</div>
					</div>

					<div class="form-group">	
						<div class="col-md-8 col-md-offset-2">
							<input type="password" class="form-control" name="pass" size="10" maxlength="20" placeholder="Current Password" value="<?php if (isset($_POST['pass'])) echo $_POST['pass']; ?>" />
						</div>
					</div>

					<div class="form-group">	
						<div class="col-md-8 col-md-offset-2">
							<input type="password" class="form-control" name="pass1" size="10" maxlength="20" placeholder="New Password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" />
						</div>
					</div>

					<div class="form-group">	
						<div class="col-md-8 col-md-offset-2">
							<input type="password" class="form-control" name="pass2" size="10" maxlength="20" placeholder="Confirm New Password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" />
						</div>
					</div>

					<div class="form-group">
						<div>
					      <input type="submit" name="submit" value="Submit" style="background: #337ab7; color: #fff; font-weight: bold; border: 0" />
					    </div>
				 	</div>

				</form>

			</div>
		</div>
	</div>