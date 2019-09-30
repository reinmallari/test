<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="<?php echo base_url('assets/css/qr_css.css')?>" >
</head>
<body>
	<input type=text size=16 placeholder="Tracking Code" class=qrcode-text><label class=qrcode-text-btn><input type=file accept="image/*" capture=environment onclick="return showQRIntro();" onchange="openQRCamera(this);" tabindex=-1></label>
	<input type=button value="Go" disabled>
</body>
<script type='text/javascript' src='<?php echo base_url('assets/scripts/qr.js')?>'></script>
</html>
