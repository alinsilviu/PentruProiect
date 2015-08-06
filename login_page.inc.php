<?php

$page_title = 'Login';
include ('includes/header.html');

?>
	<div id="middle" class="col-md-4 col-md-offset-4 text-center">
		<div class="panel panel-primary">
		  <div class="panel-heading">
		    <h3 class="panel-title"><b>Log in</b></h3>
		  </div>
		  <div class="panel-body">
			<form class="form-horizontal" action="login.php" method="POST">
				<?php

				if (isset($errors) && !empty($errors)) {
					echo '<h1><span class="label label-danger">Error!</span></h1><p class="error"><b>The following error(s) occurred:</b><br />';
					foreach ($errors as $msg) {
						echo " - $msg<br />\n";
					}
					echo '</p><h4><span class="label label-warning">Please try again.</span></h4>';
				}
				?>
			  <div class="form-group">
			    <div class="col-md-8 col-md-offset-2">
			      <input type="email" class="form-control" name="email" id="inputEmail3" placeholder="Type your email address">
			    </div>
			  </div>
			  <div class="form-group">
			    <div class="col-md-8 col-md-offset-2">
			      <input type="password" class="form-control" name="pass" id="inputPassword3" placeholder="Type your password">
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