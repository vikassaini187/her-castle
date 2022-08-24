<?php
class dsSearchAgent_ListingsWidget extends WP_Widget {
	public function __construct() {
		parent::__construct("dsidx-listings", "IDX Listings", array(
			"classname" => "dsidx-widget-listings",
			"description" => "Show a list of real estate listings"
		));
			
	}
	function widget($args, $instance) {
		extract($args);
		extract($instance);
		$title = apply_filters("widget_title", $title);
		$sort = isset($instance['sort'])?$instance['sort']:'';
		$options = get_option(DSIDXPRESS_OPTION_NAME);

		if (!isset($options["Activated"]) || !$options["Activated"])
			return;
			
		wp_enqueue_script('jquery', false, array(), false, true);

		echo $before_widget;
		if ($title)
			echo $before_title . $title . $after_title;

		$apiRequestParams = array();
		$apiRequestParams["directive.ResultsPerPage"] = $listingsToShow;
		$apiRequestParams["responseDirective.ViewNameSuffix"] = "widget";
		$apiRequestParams["responseDirective.DefaultDisplayType"] = $defaultDisplay;
		$apiRequestParams['responseDirective.IncludeDisclaimer'] = 'true';
		$sort = explode('|', $sort);
		$apiRequestParams["directive.SortOrders[0].Column"] = $sort[0];
		$apiRequestParams["directive.SortOrders[0].Direction"] = isset($sort[1])?$sort[1]:'';

		if ($querySource == "area") {
			switch ($areaSourceConfig["type"]) {
				case "city":
					$typeKey = "query.Cities";
					break;
				case "community":
					$typeKey = "query.Communities";
					break;
				case "tract":
					$typeKey = "query.TractIdentifiers";
					break;
				case "zip":
					$typeKey = "query.ZipCodes";
					break;
			}
			$apiRequestParams[$typeKey] = $areaSourceConfig["name"];
		} else if ($querySource == "link") {
			$apiRequestParams["query.ForceUsePropertySearchConstraints"] = "true";
			$apiRequestParams["query.LinkID"] = $linkSourceConfig["linkId"];
		} else if ($querySource == "agentlistings") {
			if (isset($options['AgentID']) && !empty($options['AgentID'])) $apiRequestParams["query.ListingAgentID"] = $options['AgentID'];
		} else if ($querySource == "officelistings") {
			if (isset($options['OfficeID']) && !empty($options['OfficeID'])) $apiRequestParams["query.ListingOfficeID"] = $options['OfficeID'];
		} 
		if (defined("DS_REQUEST_MULTI_AVAILABLE") && DS_REQUEST_MULTI_AVAILABLE==true)  {
			$apiHttpResponse = dsSearchAgent_ApiRequest::FetchData("Results", $apiRequestParams,true,null,null,false,true);
			if (empty($apiHttpResponse['body'])) {
				$apiHttpResponse['body'] = '%%ds_Results|' . json_encode($apiHttpResponse) . '|ds_end%%';
			}	
			$data = $apiHttpResponse["body"];	
			$data = str_replace('{$pluginUrlPath}', dsSearchAgent_ApiRequest::MakePluginsUrlRelative(plugin_dir_url(__FILE__)), $data);
			echo $data;
			echo $after_widget;
		} else {
					$apiHttpResponse = dsSearchAgent_ApiRequest::FetchData("Results", $apiRequestParams);
					if (empty($apiHttpResponse["errors"]) && $apiHttpResponse["response"]["code"] == "200") {
						$data = $apiHttpResponse["body"];
					} else {
						switch ($apiHttpResponse["response"]["code"]) {
							case 403:
								$data = '<p class="dsidx-error">'.DSIDXPRESS_INACTIVE_ACCOUNT_MESSAGE.'</p>';
							break;
							default:
								$data = '<p class="dsidx-error">'.DSIDXPRESS_IDX_ERROR_MESSAGE.'</p>';
						}
					}
					$data = str_replace('{$pluginUrlPath}', dsSearchAgent_ApiRequest::MakePluginsUrlRelative(plugin_dir_url(__FILE__)), $data);
					echo $data;
					echo $after_widget;
		}
		dsidx_footer::ensure_disclaimer_exists();
			
	}
	function update($new_instance, $old_instance) {
		// we need to do this first-line awkwardness so that the title comes through in the sidebar display thing
		$new_instance["listingsOptions"]["title"] = $new_instance["title"];
		$new_instance = $new_instance["listingsOptions"];
		return $new_instance;
	}
	function form($instance) {
		wp_enqueue_script('dsidxpress_widget_listings', DSIDXPRESS_PLUGIN_URL . 'js/widget-listings.js', array('jquery'), DSIDXPRESS_PLUGIN_VERSION, true);
		$options = get_option(DSIDXPRESS_OPTION_NAME);
		$instance = wp_parse_args($instance, array(
			"title"				=> "Latest Real Estate",
			"listingsToShow"	=> "25",
			"defaultDisplay"	=> "listed",
			"sort"				=> "DateAdded|DESC",
			"querySource"		=> "area",
			"areaSourceConfig"	=> array(
				"type"			=> "city",
				"name"			=> ""
			),
			"linkSourceConfig"	=> array(
				"linkId"		=> ""
			)
		));
		$titleFieldId = $this->get_field_id("title");
		$titleFieldName = $this->get_field_name("title");
		$baseFieldId = $this->get_field_id("listingsOptions");
		$baseFieldName = $this->get_field_name("listingsOptions");

		$checkedDefaultDisplay = array(
			"listed"		=> "",
			"slideshow" => "",
			"expanded"	=> "",
			"map"				=> "",
			$instance["defaultDisplay"] => "checked=\"checked\""
		);
		
		$checkedQuerySource = array(
			"area"						=> "",
			"officelistings"	=> "",
			"agentlistings"		=> "",
			"link"						=> "",
			$instance["querySource"] => "checked=\"checked\""
		);
		$selectedAreaType = array(
			"city"			=> "",
			"community"	=> "",
			"tract"			=> "",
			"zip"				=> "",
			$instance["areaSourceConfig"]["type"] => "selected=\"selected\""
		);
		$selectedAreaTypeNormalized = ucwords($instance["areaSourceConfig"]["type"]);

		$selectedSortOrder = array(
			"DateAddedDESC"								=> "",
			"PriceDESC"										=> "",
			"PriceASC"										=> "",
			"OverallPriceDropPercentDESC" => "",
			"ImprovedSqFtDESC"						=> "",
			"LotSqFtDESC"									=> "",
			str_replace("|", "", $instance["sort"]) => "selected=\"selected\""
		);
		
		$selectedLink = array($instance["linkSourceConfig"]["linkId"] => "selected=\"selected\"");

		$availableLinks = dsSearchAgent_ApiRequest::FetchData("AccountAvailableLinks", array(), true, 0);
		$availableLinks = json_decode($availableLinks["body"]);
		$pluginUrl = DSIDXPRESS_PLUGIN_URL;
		$ajaxUrl = admin_url( 'admin-ajax.php' );

		$agentListingsNote = null;
		$officeListingsNote = null;
		if ($options['AgentID'] == null) {
			$agentListingsNote = "There are no listings to show with your current settings.  Please make sure you have provided your Agent ID on the IDX > General page of your site dashboard, or change this widget's settings to show other listings.";
		}
		if ($options['OfficeID'] == null) {
			$officeListingsNote = "There are no listings to show with your current settings.  Please make sure you have provided your Office ID on the IDX > General page of your site dashboard, or change this widget's settings to show other listings.";
		}

		echo <<<HTML
			<p>
				<label for="{$titleFieldId}">Widget title</label>
				<input id="{$titleFieldId}" name="{$titleFieldName}" value="{$instance['title']}" class="widefat" type="text" />
			</p>
			<p>
				<label for="{$baseFieldId}[listingsToShow]"># of listings to show (max 50)</label>
				<input id="{$baseFieldId}[listingsToShow]" name="{$baseFieldName}[listingsToShow]" value="{$instance['listingsToShow']}" class="widefat" type="text" />
			</p>
			<p>
				<label for="{$baseFieldId}[sort]">Sort order</label>
				<select id="{$baseFieldId}[sort]" name="{$baseFieldName}[sort]" class="widefat">
					<option value="DateAdded|DESC" {$selectedSortOrder['DateAddedDESC']}>Time on market, newest first</option>
					<option value="Price|DESC" {$selectedSortOrder['PriceDESC']}>Price, highest first</option>
					<option value="Price|ASC" {$selectedSortOrder['PriceASC']}>Price, lowest first</option>
					<option value="OverallPriceDropPercent|DESC" {$selectedSortOrder['OverallPriceDropPercentDESC']}>Price drop %, largest first</option>
					<option value="ImprovedSqFt|DESC" {$selectedSortOrder['ImprovedSqFtDESC']}>Improved size, largest first</option>
					<option value="LotSqFt|DESC" {$selectedSortOrder['LotSqFtDESC']}>Lot size, largest first</option>
				</select>
			</p>
			<p>
				<input type="radio" name="{$baseFieldName}[defaultDisplay]" id="{$baseFieldId}[defaultDisplay-listed]" value="listed" {$checkedDefaultDisplay['listed']}/>
				<label for="{$baseFieldId}[defaultDisplay-listed]">Show in list by default</label>
				<br />
				<input type="radio" name="{$baseFieldName}[defaultDisplay]" id="{$baseFieldId}[defaultDisplay-slideshow]" value="slideshow" {$checkedDefaultDisplay['slideshow']}/>
				<label for="{$baseFieldId}[defaultDisplay-slideshow]">Show slideshow details by default</label>
				<br />
				<input type="radio" name="{$baseFieldName}[defaultDisplay]" id="{$baseFieldId}[defaultDisplay-expanded]" value="expanded" onclick="document.getElementById('{$baseFieldId}[listingsToShow]').value = 4;" {$checkedDefaultDisplay['expanded']}/>
				<label for="{$baseFieldId}[defaultDisplay-expanded]">Show expanded details by default</label>
				<br />
				<input type="radio" name="{$baseFieldName}[defaultDisplay]" id="{$baseFieldId}[defaultDisplay-map]" value="map" {$checkedDefaultDisplay['map']}/>
				<label for="{$baseFieldId}[defaultDisplay-map]">Show on map by default</label>
			</p>

			<div class="widefat" style="border-width: 0 0 1px; margin: 20px 0;"></div>

			<table>
				<tr>
					<td style="width: 20px;"><p><input type="radio" name="{$baseFieldName}[querySource]" id="{$baseFieldId}[querySource-area]" value="area" {$checkedQuerySource['area']}/></p></td>
					<td><p><label for="{$baseFieldId}[querySource-area]">Pick an area</label></p></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<p>
							<label for="{$baseFieldId}[areaSourceConfig][type]">Area type</label>
							<select id="{$baseFieldId}_areaSourceConfig_type" name="{$baseFieldName}[areaSourceConfig][type]" class="widefat" onchange="dsWidgetListings.SwitchType(this, '{$baseFieldId}_areaSourceConfig_title')">
								<option value="city" {$selectedAreaType['city']}>City</option>
								<option value="community" {$selectedAreaType['community']}>Community</option>
								<option value="tract" {$selectedAreaType['tract']}>Tract</option>
								<option value="zip" {$selectedAreaType['zip']}>Zip Code</option>
							</select>
						</p>

						<p>
							<label for="{$baseFieldId}[areaSourceConfig][name]">Area name</label>
							<input id="{$baseFieldId}[areaSourceConfig][name]" name="{$baseFieldName}[areaSourceConfig][name]" class="widefat" type="text" value="{$instance['areaSourceConfig']['name']}" />
						</p>

						<p>
							<span class="description">See all <span id="{$baseFieldId}_areaSourceConfig_title">{$selectedAreaTypeNormalized}</span> Names <a href="javascript:void(0);" onclick="dsWidgetListings.LaunchLookupList('{$ajaxUrl}?action=dsidx_locations', '{$baseFieldId}_areaSourceConfig_type')">here</a></span>
						</p>
					</td>
				</tr>
				<tr>
					<th colspan="2"><p> - OR - </p></th>
				</tr>
				<tr>
					<td valign="top"><p><input type="radio" name="{$baseFieldName}[querySource]" id="{$baseFieldId}[querySource-agentlistings]" value="agentlistings" {$checkedQuerySource['agentlistings']}/></p></td>
					<td>
						<p><label for="{$baseFieldId}[querySource-agentlistings]">My own listings (via agent ID, newest listings first)</label></p>
						<p><i>{$agentListingsNote}</i></p>
					</td>
				</tr>
				<tr>
					<th colspan="2"><p> - OR - </p></th>
				</tr>
				<tr>
					<td valign="top"><p><input type="radio" name="{$baseFieldName}[querySource]" id="{$baseFieldId}[querySource-officelistings]" value="officelistings" {$checkedQuerySource['officelistings']}/></p></td>
					<td>
						<p><label for="{$baseFieldId}[querySource-officelistings]">My office's listings (via office ID, newest listings first)</label></p>
						<p><i>{$officeListingsNote}</i></p>
					</td>
				</tr>
HTML;
		if (!defined('ZPRESS_API')) {
			echo <<<HTML
		
				<tr>
					<th colspan="2"><p> - OR - </p></th>
				</tr>
				<tr>
					<td><p><input type="radio" name="{$baseFieldName}[querySource]" id="{$baseFieldId}[querySource-link]" value="link" {$checkedQuerySource['link']}/></p></td>
					<td><p><label for="{$baseFieldId}[querySource-link]">Use a link you created in your website control panel</label></p></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<p>
							<select name="{$baseFieldName}[linkSourceConfig][linkId]" class="widefat">
HTML;
			foreach ($availableLinks as $link) {
				 $linkID = $link->LinkID;
				 $linkTitle = $link->Title;
				 $linkSelected = array_key_exists($linkID, $selectedLink) ? "selected" : "";
				 
				echo "<option value=\"{$linkID}\" {$linkSelected}>{$linkTitle}</option>";
			}
			echo <<<HTML
							</select>
						</p>
					</td>
				</tr>
HTML;
		}
		echo <<<HTML
			</table>
HTML;
	}
}
?>