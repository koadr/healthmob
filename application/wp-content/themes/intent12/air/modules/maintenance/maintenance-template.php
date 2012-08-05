<?php header('HTTP/1.1 503 Service Temporarily Unavailable'); // Send 503 HTTP header ?>
<!DOCTYPE html> 
<html dir="ltr" lang="en-US"> 
<head> 
<meta charset="UTF-8"> 
<title><?php bloginfo('name'); ?></title>

<style type="text/css">
	body { color: #444; font-family: Arial,sans-serif; font-size: 15px; margin: 60px 80px; }
	h1 { color: #222; font-size: 32px; line-height: 45px; margin-top: 0; margin-bottom: 15px; }
	p { margin: 0; padding: 0; }
	.maintenance h1 { color: #444; font-size: 38px; letter-spacing: -1px; line-height: 45px; margin-bottom: 30px; }
	.maintenance .box { margin: 0 auto; text-align: center; width: 500px; }
	.maintenance .note { background: #fffad6; color: #846000; padding: 10px; margin: 0;
	  -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }
</style>

</head>
<body class="maintenance">
<div class="box">
	<h1>Site Maintenance</h1>
	<p class="note">Site is currently under maintenance. Please check back later.</p>
</div>
</body>
</html>
