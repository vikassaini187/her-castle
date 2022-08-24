<?php
if (!current_user_can("edit_posts"))
	wp_die("You can't do anything destructive in here, but you shouldn't be playing around with this anyway.");

global $wp_version, $tinymce_version;
$localJsUri = get_option("siteurl") . "/" . WPINC . "/js/";
if (is_ssl() && parse_url($localJsUri, PHP_URL_SCHEME)=="http") {
	$localJsUri = preg_replace('/http:/', 'https:', $localJsUri);
}
$adminUri = get_admin_url();
?>

<!DOCTYPE html>
<html>
<head>
	<title>dsIDXpress: IDX Registration Form</title>

	<script src="<?php echo $localJsUri ?>tinymce/tiny_mce_popup.js?ver=<?php echo urlencode($tinymce_version) ?>"></script>
	<script src="<?php echo $localJsUri ?>jquery/jquery.js"></script>
	<script src="<?php echo DSIDXPRESS_PLUGIN_URL; ?>/tinymce/idx_registration_form/js/dialog.js?ver=<?php echo urlencode(DSIDXPRESS_PLUGIN_VERSION) ?>"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo $adminUri ?>../wp-includes/css/dashicons.min.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DSIDXPRESS_PLUGIN_URL; ?>/css/admin-options.css?ver=<?php echo urlencode(DSIDXPRESS_PLUGIN_VERSION) ?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo $adminUri ?>css/wp-admin.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo DSIDXPRESS_PLUGIN_URL; ?>/tinymce/idx_registration_form/css/dialog.css?foo=bar" />
	<style type="text/css">
		label {
			cursor: pointer;
		}
	</style>
</head>
<body class="wp-admin js admin-color-fresh">
	<div id="wpbody">

		<div class="postbox" id="ds-idx-dialog-notice">
			<div class="inside">
				<p>
					Choose to include or exclude social login options for Google and Facebook on your registration form.
				</p>
			</div>
		</div>
		<div class="postbox" id="ds-idx-dialog-notice">
			<div class="inside">
				<div>
					<label for="dsidx-login-last-name">Include Social Login</label> 
					<input id="includeSocialLogin" type="checkbox" name="includeSocialLogin" /><label for="modern-view"><br>
					<label for="dsidx-login-email">Enter a URL where visitors will be sent once registered</label> <br>
					<input type="text" id="dsidx-RedirectToURL" style="width:100% !important;" class="text" name="dsidx-RedirectToURL" />
				</div>
			<p class="button-controls">
				<span class="add-to-menu">
					<input type="button" id="dsidxpress-lb-cancel" name="cancel" value="Cancel" class="button-secondary" onclick="tinyMCEPopup.close();">
					<input type="button" id="dsidxpress-lb-insert" name="insert" value="Insert Registration Form" class="button-primary" style="text-transform: capitalize;" onclick="dsidxRegistartionForm.insert();">
				</span>
			</p>

			</div>
		</div>
	</div>
</body>
</html>
