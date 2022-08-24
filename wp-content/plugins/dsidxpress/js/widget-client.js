var dsidx_w = {};

dsidx_w.searchWidget = (function () {
	var $ = jQuery;

	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-search-box-type').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-search-box-type').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-PropertyTypes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-type-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-search-box-type').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Cities').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Cities').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-Cities<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-city-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Cities').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Communities').select2({ placeholder: "Any" });	

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Communities').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-Communities<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-community-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-Communities').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-TractIdentifiers').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-TractIdentifiers').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-TractIdentifiers<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-tract-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-TractIdentifiers').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-ZipCodes').select2({ placeholder: "Any" });		

	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-ZipCodes').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-ZipCodes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-search-zip-hidden-inputs').html(input_html);
	});	
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #idx-q-ZipCodes').change();
	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').select2({ placeholder: "Any" });		
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-PropertyTypes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-quick-search-type-hidden-inputs').html(input_html);
	});	
	$('.dsidx-resp-search-box .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change();

	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').select2({ placeholder: "All Types" });		
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change(function () {
		var input_html = '';
		$.each($(this).val(), function (i, val) {
		    input_html += '<input type="hidden" name="idx-q-PropertyTypes<' + i + '>" value="' + val + '" />';
		});
		$(this).parents('.dsidx-resp-search-form').find('.dsidx-quick-search-type-hidden-inputs').html(input_html);
	});	
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-type').change();

	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-status').select2({ placeholder: "All Statuses" });		
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-status').change(function () {
	    var statusEnumHash = 0;
	    $(this).find('option:selected').each(function () {
	        statusEnumHash += parseInt($(this).val());
		});		
		$(this).siblings('#dsidx-quick-search-status-hidden').val(statusEnumHash);
	});	
	$('.dsidx-resp-search-box-modern-view .dsidx-resp-search-form #dsidx-resp-quick-search-box-status').change();

	$('#dsidx-shortcode-registration form').submit(function () {
		var form = $(this).parents('form:first');
		function throwError(validationMessage) {
			if (validationMessage) {
				$("#"+form.context.id).find('.dsidx-shortcode-registration-dialog-message').show().html(validationMessage);
				return false;
			}			
		}
		var emailPattern = new RegExp(/^(("[\w-+\s]+")|([\w-+]+(?:\.[\w-+]+)*)|("[\w-+\s]+")([\w-+]+(?:\.[\w-+]+)*))(@((?:[\w-+]+\.)*\w[\w-+]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$)|(@\[?((25[0-5]\.|2[0-4][\d]\.|1[\d]{2}\.|[\d]{1,2}\.))((25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\.){2}(25[0-5]|2[0-4][\d]|1[\d]{2}|[\d]{1,2})\]?$)/i);
		var validationMessage = "";
		var redirectTo = $("#"+form.context.id).find("#dsidx-shortcode-registration-redirectURL").val();
		var dialogMessage = $("#"+form.context.id).find('.dsidx-shortcode-registration-dialog-message');

		if (!$("#"+form.context.id).find('#dsidx-shortcode-registration-first-name').val() || !$("#"+form.context.id).find('#dsidx-shortcode-registration-last-name').val()) 
			return throwError("First and last name are required.");	

		if (!emailPattern.test($("#"+form.context.id).find('#dsidx-shortcode-registration-email').val()))
			return throwError("You must use a valid email.");
	
		var phoneVal = $("#"+form.context.id).find('#dsidx-shortcode-registration-phone-number').val().replace(/\D/g, '');
		if (phoneVal[0] == 1) phoneVal = phoneVal.substr(1);
		if (phoneVal.length >= 10 && phoneVal.length <= 15) {
			if (phoneVal[0] == '0' || phoneVal[0] == '1' || phoneVal[1] == '9' || phoneVal.substr(0, 3) == '555' || phoneVal[3] == '0' || phoneVal[3] == '1') {
				return throwError("Phone number is not valid");
			}
		} else {
			if (typeof (dsIdxRequirePhone) != 'undefined') {
				return throwError("Phone number is not valid");
			}
		}
	
		if (!$("#"+form.context.id).find('#dsidx-shortcode-registration-password').val() || !$("#"+form.context.id).find('#dsidx-shortcode-registration-confirm-password').val())
		return throwError("Password is required.");	

		if (!$("#"+form.context.id).find('#dsidx-shortcode-registration-password').val() || $("#"+form.context.id).find('#dsidx-shortcode-registration-password').val() != $("#"+form.context.id).find('#dsidx-shortcode-registration-confirm-password').val())
			return throwError("Passwords do not match.");	

			$("#"+form.context.id).find('.dsidx-shortcode-registration-dialog-message').hide();

		var ajaxUrl = dsidx.pluginUrl + 'client-assist.php?action=Register';
		if (dsidx.useWPAjax) {
			ajaxUrl = dsidxAjaxHandler.ajaxurl + '?action=dsidx_client_assist&dsidx_action=Register';
		}
		$("#"+form.context.id).find('#dsidx-shortcode-registration-submit').prop('disabled', true);
		$.ajax({
			type: 'POST',
			url: ajaxUrl,
			data: $("#"+form.context.id).serialize(),
			dataType: 'json',
			success: function (response) {
				if (response.Success) {
					dialogMessage.addClass("dsidx-shortcode-registration-dialog-message-success")
					dialogMessage.removeClass("dsidx-shortcode-registration-dialog-message")
					dialogMessage.show().html("Success");
					if(redirectTo.startsWith("http") || redirectTo.startsWith("//"))
						redirectTo = redirectTo;
					else 
						redirectTo ="http://"+redirectTo;
					window.location.href = redirectTo;
				} else {
					dialogMessage.show().html(response.Message);
				}
			},
			error: function(response){
				dialogMessage.show().html(response.Message);
			},
			complete: function(){
				$("#"+form.context.id).find('#dsidx-shortcode-registration-submit').val('Register');
				$("#"+form.context.id).find('#dsidx-shortcode-registration-submit').prop('disabled', false);
			  }
		});	
		$("#"+form.context.id).find('#dsidx-shortcode-registration-submit').val('Sending...');	
		return false;
	});	
    function isLocationValid() {
        // Deactivating the location validation for case 9360
        // We will now accept no location fields and the - Any - value
        // This file doesn't do anything now.
    	var valid = true;
    	$('.idx-q-Location-Filter :selected').each(function(index) {
    		if($(this).val().length)
    			valid = true;
    	});
    	return valid;
    }   
    
    function isFieldShown() {
    	var returnStr = "";
    	$('.idx-q-Location-Filter').each( function() {
    		returnStr += $("label[for=" + $(this).attr('id') + "]").text() + ", ";
    	});
    	return returnStr.substring(0, returnStr.length - 2);
    }
    
    function MLSExists() {
    	if ($('#idx-q-MlsNumbers').length > 0 && $('#idx-q-MlsNumbers').val().length > 0)
    		return true;
    	else
    		return false;
    }
    
    var returnObj = {
    	validate: function () {
            if (!isLocationValid() && !MLSExists())
            {
            	$("#idx-search-invalid-msg").text("Please select at least one of the following fields: " + isFieldShown()).show();
            	return false;
            }
            else
            	return true;
        }
    };
    
    return returnObj;
})();