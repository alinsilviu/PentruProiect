<?php

$page_title = 'Register';
if (!isset($_COOKIE['user_id'])) {
	include ('includes/header.html');
} else {
	include ('includes/header2.html');
}


?>
	<div id="middle" class="col-md-4 col-md-offset-4 text-center">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Register</b></h3>
		  </div>
			<div class="panel-body">
				<form class="form-horizontal" action="register.php" method="post">

<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php');
	
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

	if (!empty($_POST['pass1'])) {
		if ($_POST['pass1'] != $_POST['pass2']) {
			$errors[] = 'Your password did not match the confirmed password.';
		} else {
			$p = mysqli_real_escape_string($dbc, trim($_POST['pass1']));
		}
	} else {
		$errors[] = 'You forgot to enter your password.';
	}

	if (empty($errors)) {
		$q = "INSERT INTO users (first_name, last_name, email, pass, registration_date) VALUES ('$fn', '$ln', '$e', SHA1('$p'), NOW())";
		$r = @mysqli_query ($dbc, $q);
		if ($r) {
			echo '<h1><span class="label label-success">Thank you!</span></h1><p><b>You are now registered. In Chapter 12 you will actually be able to log in!</b></p><p><br /></p>';
			header("refresh: 1; url=login.php");
		} else {
			echo '<h1><span class="label label-danger">System Error</span</h1><p class="error"><b>You could not be registered due to a system error. We apologize for any inconvenience.</b></p>';
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $q . '</p>';
		}
		mysqli_close($dbc);
		exit();
	} else {
		echo '<h1><span class="label label-danger">Error!</span></h1><p class="error"><b>The following error(s) occured:</b><br />';
		foreach ($errors as $msg) {
			echo " - $msg<br />\n";
		}
		echo '</p><h4><span class="label label-warning">Please try again.</span></h4>';
	}

	mysqli_close($dbc);

}
?>
					
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<input type="text" class="form-control" name="first_name" size="15" maxlength="20" placeholder="First Name" value="<?php if (isset($_POST['first_name'])) echo $_POST['first_name']; ?>" />
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<input type="text" class="form-control" name="last_name" size="15" maxlength="40" placeholder="Last Name"  value="<?php if (isset($_POST['last_name'])) echo $_POST['last_name']; ?>" />
						</div>
					</div>
					
					<div class="form-group">
						<div class="col-md-8 col-md-offset-2">
							<input type="email" class="form-control" name="email" size="20" maxlength="60" placeholder="Email Address" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" />
						</div>
					</div>
					
					<div class="form-group">	
						<div class="col-md-8 col-md-offset-2">
							<input type="password" class="form-control" name="pass1" size="10" maxlength="20" placeholder="Password" value="<?php if (isset($_POST['pass1'])) echo $_POST['pass1']; ?>" />
						</div>
					</div>

					<div class="form-group">	
						<div class="col-md-8 col-md-offset-2">
							<input type="password" class="form-control" name="pass2" size="10" maxlength="20" placeholder="Confirm Password" value="<?php if (isset($_POST['pass2'])) echo $_POST['pass2']; ?>" />
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