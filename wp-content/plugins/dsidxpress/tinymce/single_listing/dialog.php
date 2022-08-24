<?php
if (!current_user_can("edit_posts"))
	wp_die("You can't do anything destructive in here, but you shouldn't be playing around with this anyway.");

global $wp_version, $tinymce_version;
$localJsUri = get_option("siteurl") . "/" . WPINC . "/js/";
if (is_ssl() && parse_url($localJsUri, PHP_URL_SCHEME)=="http") {
	$localJsUri = preg_replace('/http:/', 'https:', $localJsUri);
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>dsIDXpress: Insert Property</title>

	<script src="<?php echo $localJsUri ?>tinymce/tiny_mce_popup.js?ver=<?php echo urlencode($tinymce_version) ?>"></script>
	<script src="<?php echo $localJsUri ?>jquery/jquery.js"></script>
	<script src="<?php echo DSIDXPRESS_PLUGIN_URL; ?>/tinymce/single_listing/js/dialog.js?ver=<?php echo urlencode(DSIDXPRESS_PLUGIN_VERSION) ?>"></script>

	<style type="text/css">
		label {
			cursor: pointer;
		}
		th {
			text-align: left;
			vertical-align: top;
		}
		#data-table td {
			padding-bottom: 5px;
		}
	</style>
</head>
<body>

	<p>
		You can easily harness the power of dsIDXpress to insert a "live" real estate listing into your blog post.
	</p>
	<table id="data-table">
		<tr>
			<th style="width: 100px; padding-top: 2px;"><label for="mls-number">MLS #</label></th>
			<td><input id="mls-number" name="mls-number" type="text" class="text" /></td>
		</tr>
		<tr>
			<th style="padding-top: 7px;">Data to show</th>
			<td>
				<table id="data-show-options">
					<tr>
						<td>
							<label for="show-all">- Everything -
							<div style="color: #999;">(incl future data)</div>
						</td>
						<td><input type="checkbox" id="show-all" name="showall" checked="checked" /></td>
					</tr>
					<tr>
						<td><label for="show-price-history">Price History</td>
						<td><input type="checkbox" id="show-price-history" name="showpricehistory" checked="checked" /></td>
					</tr>
					<tr>
						<td><label for="show-schools">Schools</label></td>
						<td><input type="checkbox" id="show-schools" name="showschools" checked="checked" /></td>
					</tr>
					<tr>
						<td><label for="show-extra-details">Extra Details</td>
						<td><input type="checkbox" id="show-extra-details" name="showextradetails" checked="checked" /></td>
					</tr>
					<tr>
						<td><label for="show-features">Features</td>
						<td><input type="checkbox" id="show-features" name="showfeatures" checked="checked" /></td>
					</tr>
					<tr>
						<td><label for="show-location">Location (Map)</td>
						<td><input type="checkbox" id="show-location" name="showlocation" checked="checked" /></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="insert" name="insert" value="Insert listing" onclick="dsidxSingleListing.insert();" />
		</div>

		<div style="float: right">
			<input type="button" id="cancel" name="cancel" value="Cancel" onclick="tinyMCEPopup.close();" />
		</div>
	</div>

</body>
</html>
