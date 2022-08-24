<?php

add_action('wp_head', array('dsSearchAgent_IdxQuickSearchWidget', 'LoadScripts'), 100);

class dsSearchAgent_IdxQuickSearchWidget extends WP_Widget {
    var $widgetsCdn;

    public function __construct() {
        parent::__construct("dsidx-quicksearch", "IDX Quick Search", array(
            "classname" => "dsidx-widget-quick-search",
            "description" => "Choose either horizontal or vertical format. A simple responsive search form. Allow users to type any location, select from available property types and filter by price range."
            ));

        $this->widgetsCdn = dsWidgets_Service_Base::$widgets_cdn;
    }
    public static function LoadScripts(){
        dsidxpress_autocomplete::AddScripts(true);
    }

    public static function shortcodeWidget($values){
        self::renderWidget(array(), $values);
    }

    function widget($args, $instance) { // public so we can use this on our shortcode as well
        self::renderWidget($args, $instance);
    }

    public static function renderWidget($args, $instance){
        extract($args);
        extract($instance);
        if (isset($title))
            $title = apply_filters("widget_title", $title);

        $options = get_option(DSIDXPRESS_OPTION_NAME);
        if (!isset($options["Activated"]) || !$options["Activated"])
            return;

        $pluginUrl = plugins_url() . '/dsidxpress/';
        $formAction = get_home_url() . "/idx/";

		$propertyTypes = dsSearchAgent_GlobalData::GetPropertyTypes();

        $widgetType = htmlspecialchars($instance["widgetType"]);
        $modernView = isset($instance["modernView"]) && strtolower($instance["modernView"]) == "yes";

        if($modernView){
            $capabilities = dsWidgets_Service_Base::getAllCapabilities();
            if (isset($capabilities['body'])) {
                $capabilities = json_decode($capabilities['body'], true);
            }
        }

        $values =array();
        $values['idx-q-Locations'] = isset($_GET['idx-q-Locations']) ? stripslashes($_GET['idx-q-Locations']) : null;
        $values['idx-q-PropertyTypes'] = findArrayItems($_GET, 'idx-q-PropertyTypes');
        $values['idx-q-PriceMin'] = isset($_GET['idx-q-PriceMin']) ? formatPrice($_GET['idx-q-PriceMin']) : null;
        $values['idx-q-PriceMax'] = isset($_GET['idx-q-PriceMax']) ? formatPrice($_GET['idx-q-PriceMax']) : null;
		$values['idx-q-BedsMin'] = isset($_GET['idx-q-BedsMin']) ? $_GET['idx-q-BedsMin'] : null;
        $values['idx-q-BathsMin'] = isset($_GET['idx-q-BathsMin']) ? $_GET['idx-q-BathsMin'] : null;
        
        if($modernView) {
            $values['idx-q-ListingStatuses'] = isset($_GET['idx-q-ListingStatuses']) ? $_GET['idx-q-ListingStatuses'] : null;
        }
		
        $specialSlugs = array(
            'city'      => 'idx-q-Cities',
            'community' => 'idx-q-Communities',
            'tract'     => 'idx-q-TractIdentifiers',
            'zip'       => 'idx-q-ZipCodes'
        );

        $urlParts = explode('/', $_SERVER['REQUEST_URI']);
        $count = 0;
        foreach($urlParts as $p){
            if(array_key_exists($p, $specialSlugs) && isset($urlParts[$count + 1])){
                $values['idx-q-Locations'] = ucwords($urlParts[$count + 1]);
            }
            $count++;
        }

        if (isset($before_widget))
            echo $before_widget;
        if (isset($title))
            echo $before_title . $title . $after_title;

        $widgetClass = ($widgetType == 1 || $widgetType == 'vertical')?'dsidx-resp-vertical':'dsidx-resp-horizontal';
        
        if(isset($instance['class'])){ //Allows us to add custim class for shortcode etc.
            $widgetClass .= ' '.$instance['class'];
        }   
        $widgetId='';
        if(isset($args["widget_id"]))
            $widgetId = '-'+$args["widget_id"];
        
        if($modernView) {
            echo <<<HTML
                <div class="dsidx-resp-search-box-modern-view {$widgetClass}">
                    <form  id="dsidx-quick-search-form{$widgetId}" class="dsidx-resp-search-form" action="{$formAction}" method="GET">
                        <fieldset>
                        <div class="dsidx-resp-area-container-row"> 
                            <div class="dsidx-resp-area dsidx-resp-location-area">
                                <label for="dsidx-resp-location" class="dsidx-resp-location">Location</label>
                                <div class="dsidx-autocomplete-box">
                                    <input placeholder="Address, City, Zip, MLS #, etc" 
                                    name="idx-q-Locations" type="text" class="text dsidx-search-omnibox-autocomplete" 
                                    style="border:none;background:none;"
                                    id="dsidx-resp-location-quick-search" />
                                </div> 
                                <div id="dsidx-autocomplete-spinner-quick-search" class="dsidx-autocomplete-spinner" style="display:none;"><img src="https://api-idx.diversesolutions.com/Images/dsIDXpress/loadingimage.gif"></div>
                            </div>
                            <div class="dsidx-resp-area dsidx-resp-type-area">
                                <label for="dsidx-resp-area-type" class="dsidx-resp-type">Property Types</label>                      
                                <select id="dsidx-resp-quick-search-box-type" multiple="multiple">
HTML;
                                    if (is_array($propertyTypes)) {
										$propertyTypesSelected = isset($values['idx-q-PropertyTypes']) && !empty($values['idx-q-PropertyTypes']);
                                        foreach ($propertyTypes as $propertyType) {
                                            $name = htmlentities($propertyType->DisplayName);
                                            if($propertyTypesSelected) {
                                                $selected = in_array($propertyType->SearchSetupPropertyTypeID, $values['idx-q-PropertyTypes'])?' selected="selected"':'';
                                            }
                                            else {
												$selected = isset($propertyType->IsSearchedByDefault) && $propertyType->IsSearchedByDefault == true ?' selected="selected"':'';
                                            }
                                            echo "<option value=\"{$propertyType->SearchSetupPropertyTypeID}\"{$selected}>{$name}</option>";
                                        }
                                    }

                                    echo <<<HTML
                                </select>
                                <div class="dsidx-quick-search-type-hidden-inputs"></div>
                            </div>
                            <div class="dsidx-resp-area dsidx-resp-status-area">
                                <label for="dsidx-resp-quick-search-box-status" class="dsidx-resp-status">Property Status</label>                      
                                <select id="dsidx-resp-quick-search-box-status" multiple="multiple">
HTML;
                                    $selectedStatus = $values['idx-q-ListingStatuses'];

                                    $selectActive = ($selectedStatus == 1 || $selectedStatus == 3 || $selectedStatus == 5 || $selectedStatus == 7 || $selectedStatus == 9 || $selectedStatus == 11 || $selectedStatus == 13 || $selectedStatus == 15) ? ' selected' : '';
                                    $selectConditional = ($selectedStatus == 2 || $selectedStatus == 3 || $selectedStatus == 6 || $selectedStatus == 7 || $selectedStatus == 10 || $selectedStatus == 11 || $selectedStatus == 14 || $selectedStatus == 15) ? ' selected' : '';
                                    $selectPending = ($selectedStatus == 4 || $selectedStatus == 5 || $selectedStatus == 6 || $selectedStatus == 7 || $selectedStatus == 12 || $selectedStatus == 13 || $selectedStatus == 14 || $selectedStatus == 15) ? ' selected' : '';
                                    $selectSold = ($selectedStatus == 8 || $selectedStatus == 9 || $selectedStatus == 10 || $selectedStatus == 11 || $selectedStatus == 12 || $selectedStatus == 13 || $selectedStatus == 14 || $selectedStatus == 15) ? ' selected' : '';

                                    echo "<option value=\"1\"{$selectActive}>Active</option>";


                                    if(isset($capabilities['HasConditionalData']) && $capabilities['HasConditionalData'] == true){
                                        echo "<option value=\"2\"{$selectConditional}>Conditional</option>";
                                    }                                
                                    if(isset($capabilities['HasPendingData']) && $capabilities['HasPendingData'] == true){
                                        echo "<option value=\"4\"{$selectPending}>Pending</option>";
                                    }
                                    if(isset($capabilities['HasSoldData']) && $capabilities['HasSoldData'] == true){
                                        echo "<option value=\"8\"{$selectSold}>Sold</option>";
                                    }
                                    
                                    echo <<<HTML
                                </select>
                                <input type="hidden" id="dsidx-quick-search-status-hidden" name="idx-q-ListingStatuses" />
                            </div>
                            </div>
                            <div class="dsidx-resp-area-container-row"> 
                            <div class="dsidx-resp-area dsidx-quick-resp-min-baths-area dsidx-resp-area-half dsidx-resp-area-left">
                                <label for="idx-q-BedsMin">Beds</label>
                                <select id="idx-q-BedsMin" name="idx-q-BedsMin" class="dsidx-beds">
                                    <option value="">0+</option>
HTML;
                                    for($i=1; $i<=9; $i++){
                                        $selected = $i == $values['idx-q-BedsMin']?' selected="selected"':'';
                                        echo '<option value="'.$i.'"'.$selected.'>'.$i.'+</option>';
                                    }
                                echo <<<HTML
                                </select>
                            </div>

                            <div class="dsidx-resp-area dsidx-quick-resp-min-baths-area dsidx-resp-area-half dsidx-resp-area-right">
                                <label for="idx-q-BathsMin">Baths</label>
                                <select id="idx-q-BathsMin" name="idx-q-BathsMin" class="dsidx-baths">
                                    <option value="">0+</option>
HTML;
                                    for($i=1; $i<=9; $i++){
                                        $selected = $i == $values['idx-q-BathsMin']?' selected="selected"':'';
                                        echo '<option value="'.$i.'"'.$selected.'>'.$i.'+</option>';
                                    }
                                echo <<<HTML
                                </select>
                            </div>

                            <div class="dsidx-resp-area dsidx-quick-resp-price-area dsidx-resp-price-area-min dsidx-resp-area-half dsidx-resp-area-left">
                                <label for="dsidx-resp-price-min" class="dsidx-resp-price">Price Min</label>
                                <input id="idx-q-PriceMin" name="idx-q-PriceMin" type="text" class="dsidx-price" placeholder="No Min" value="{$values['idx-q-PriceMin']}" maxlength="15" onkeypress="return dsidx.isNumber(event,this.id)" />
                            </div>
                            <div class="dsidx-resp-area dsidx-quick-resp-price-area dsidx-resp-price-area-max dsidx-resp-area-half dsidx-resp-area-right">
                                <label for="dsidx-resp-price-max" class="dsidx-resp-price">Price Max</label>
                                <input id="idx-q-PriceMax" name="idx-q-PriceMax" type="text" class="dsidx-price" placeholder="No Max" value="{$values['idx-q-PriceMax']}" maxlength="15" onkeypress="return dsidx.isNumber(event,this.id)" />
                            </div>
                            <input type="hidden" name="idx-st" value="qs">
                            <div class="dsidx-resp-area dsidx-resp-area-submit">
                                <label for="dsidx-resp-submit" class="dsidx-resp-submit">&nbsp;</label>
                                <input type="submit" class="dsidx-resp-submit" value="Search" onclick="return dsidx.compareMinMaxPrice_QuickSearch();"/>
                            </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
HTML;
        }
        else {
            echo <<<HTML
                <div class="dsidx-resp-search-box {$widgetClass}">
                    <form  id="dsidx-quick-search-form{$widgetId}" class="dsidx-resp-search-form" action="{$formAction}" method="GET">
                        <fieldset>
                            <div class="dsidx-resp-area dsidx-resp-location-area">
                                <label for="dsidx-resp-location" class="dsidx-resp-location">Location</label>
                                <div class="dsidx-autocomplete-box">
                                    <input placeholder="Search Term" 
                                    name="idx-q-Locations" type="text" class="text dsidx-search-omnibox-autocomplete" 
                                    style="border:none;background:none;"
                                    id="dsidx-resp-location-quick-search" />
                                </div> 
                                <div id="dsidx-autocomplete-spinner-quick-search" class="dsidx-autocomplete-spinner" style="display:none;"><img src="https://api-idx.diversesolutions.com/Images/dsIDXpress/loadingimage.gif"></div>
                            </div>
                            <div class="dsidx-resp-area dsidx-resp-type-area">
                                <label for="dsidx-resp-area-type" class="dsidx-resp-type">Type</label>                      
                                <select id="dsidx-resp-quick-search-box-type" multiple="multiple">
HTML;
                                    if (is_array($propertyTypes)) {
                                        foreach ($propertyTypes as $propertyType) {
                                            $name = htmlentities($propertyType->DisplayName);
                                            $selected = in_array($propertyType->SearchSetupPropertyTypeID, $values['idx-q-PropertyTypes'])?' selected="selected"':'';
                                            echo "<option value=\"{$propertyType->SearchSetupPropertyTypeID}\"{$selected}>{$name}</option>";
                                        }
                                    }

                                    echo <<<HTML
                                </select>
                                <div class="dsidx-quick-search-type-hidden-inputs"></div>
                            </div>
                            <div class="dsidx-resp-area dsidx-quick-resp-min-baths-area dsidx-resp-area-half dsidx-resp-area-left">
                                <label for="idx-q-BedsMin">Beds</label>
                                <select id="idx-q-BedsMin" name="idx-q-BedsMin" class="dsidx-beds">
                                    <option value="">Any</option>
HTML;
                                    for($i=1; $i<=9; $i++){
                                        $selected = $i == $values['idx-q-BedsMin']?' selected="selected"':'';
                                        echo '<option value="'.$i.'"'.$selected.'>'.$i.'+</option>';
                                    }
                                echo <<<HTML
                                </select>
                            </div>

                            <div class="dsidx-resp-area dsidx-quick-resp-min-baths-area dsidx-resp-area-half dsidx-resp-area-right">
                                <label for="idx-q-BathsMin">Baths</label>
                                <select id="idx-q-BathsMin" name="idx-q-BathsMin" class="dsidx-baths">
                                    <option value="">Any</option>
HTML;
                                    for($i=1; $i<=9; $i++){
                                        $selected = $i == $values['idx-q-BathsMin']?' selected="selected"':'';
                                        echo '<option value="'.$i.'"'.$selected.'>'.$i.'+</option>';
                                    }
                                echo <<<HTML
                                </select>
                            </div>

                            <div class="dsidx-resp-area dsidx-quick-resp-price-area dsidx-resp-price-area-min dsidx-resp-area-half dsidx-resp-area-left">
                                <label for="dsidx-resp-price-min" class="dsidx-resp-price">Price</label>
                                <input id="idx-q-PriceMin" name="idx-q-PriceMin" type="text" class="dsidx-price" placeholder="Any" value="{$values['idx-q-PriceMin']}" maxlength="15" onkeypress="return dsidx.isNumber(event,this.id)" />
                            </div>
                            <div class="dsidx-resp-area dsidx-quick-resp-price-area dsidx-resp-price-area-max dsidx-resp-area-half dsidx-resp-area-right">
                                <label for="dsidx-resp-price-max" class="dsidx-resp-price">To</label>
                                <input id="idx-q-PriceMax" name="idx-q-PriceMax" type="text" class="dsidx-price" placeholder="Any" value="{$values['idx-q-PriceMax']}" maxlength="15" onkeypress="return dsidx.isNumber(event,this.id)" />
                            </div>
                            <input type="hidden" name="idx-st" value="qs">
                            <div class="dsidx-resp-area dsidx-resp-area-submit">
                                <label for="dsidx-resp-submit" class="dsidx-resp-submit">&nbsp;</label>
                                <input type="submit" class="dsidx-resp-submit" value="Search" onclick="return dsidx.compareMinMaxPrice_QuickSearch();"/>
                            </div>
                        </fieldset>
                    </form>
                </div>
HTML;
            }
        \dsidx_footer::ensure_disclaimer_exists("search");
        if (isset($after_widget))
            echo $after_widget;
    }

    function update($new_instance, $old_instance) {
        $new_instance["quicksearchOptions"]["title"] = strip_tags($new_instance["title"]);
        $new_instance["quicksearchOptions"]["eDomain"] = $new_instance["eDomain"];
        $new_instance["quicksearchOptions"]["widgetType"] = $new_instance["widgetType"];
        
		if($new_instance["modernView"] == "on") $new_instance["quicksearchOptions"]["modernView"] = "yes";
        else $new_instance["quicksearchOptions"]["modernView"] = "no";
               
        $new_instance = $new_instance["quicksearchOptions"];
        return $new_instance;
    }
    function form($instance) {
        wp_enqueue_script('dsidxwidgets_widget_service_admin', DSIDXWIDGETS_PLUGIN_URL . 'js/widget-service-admin.js', array('jquery'), false, true);
        $instance = wp_parse_args($instance, array(
            "title" => "Real Estate Search",
            "eDomain" =>   "",
            "widgetType" => 1,
            "modernView" => 'no'
                    ));

        $title = htmlspecialchars($instance["title"]);
        $widgetType = htmlspecialchars($instance["widgetType"]);
        $widgetTypeFieldId = $this->get_field_id("widgetType");
        $widgetTypeFieldName = $this->get_field_name("widgetType");

        $titleFieldId = $this->get_field_id("title");
        $titleFieldName = $this->get_field_name("title");
        $baseFieldId = $this->get_field_id("quicksearchOptions");
        $baseFieldName = $this->get_field_name("quicksearchOptions");

        $modernView = $instance["modernView"] == "yes" ? "checked=\"checked\" " : "";
        $modernViewFieldId = $this->get_field_id("modernView");
        $modernViewFieldName = $this->get_field_name("modernView");

        $apiStub = dsWidgets_Service_Base::$widgets_admin_api_stub;

        echo <<<HTML
        <p>
            <label for="{$titleFieldId}">Widget title</label>
            <input id="{$titleFieldId}" name="{$titleFieldName}" value="{$title}" class="widefat" type="text" />
        </p>
        <p>
            <label>Widget Aspect Ratio</label><br/><br/>
            <input type="radio" name="{$widgetTypeFieldName}" id="{$widgetTypeFieldId}" 
HTML;
        if ($widgetType == '1') echo ' checked'; 
        echo <<<HTML
            value="1"/> Vertical - <i>Recommended for side columns</i><br/>
            <input type="radio" name="{$widgetTypeFieldName}" 
HTML;
        if ($widgetType == '0') echo 'checked'; 
        echo <<<HTML
            value="0"/> Horizontal - <i>Recommended for wider areas</i><br/>
        </p>
        <p>
            <input id="{$modernViewFieldId}" name="{$modernViewFieldName}" class="checkbox" type="checkbox" {$modernView} />
            <label for="{$modernViewFieldId}">Modern View</label>
        </p>
HTML;
}

function findArrayItems($args, $searchKey) {
    $itemsFound = array();
    
    while (list($key, $val) = each($args)) {
        if(strpos($key, $searchKey) === 0) {
            array_push($itemsFound, stripcslashes($val));
        }
    }
    
    return $itemsFound;
}

function formatPrice($price) {
    if(isset($price) && !empty($price)) {
        return number_format(str_replace(',', '', $price));
    }
    return "";
}

}?>