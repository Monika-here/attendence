<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome </title>
</head>
<body>

<div id="container">

	<div id="body">
		<h4><?php echo 'Welcome to Aesthetic Today'; ?></h4>
	</div>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'Site Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>

</body>
</html>
