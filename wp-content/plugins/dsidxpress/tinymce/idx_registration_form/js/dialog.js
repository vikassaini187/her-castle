
var dsidxRegistartionForm = (function() {
	var nodeEditing;
	var returnObj;
	
	returnObj = {
		init: function() {			
			var startNode = tinyMCEPopup.editor.selection.getStart();
			var nodeTextContent = startNode ? startNode.textContent || startNode.innerText : '';
			if (/^\[idx-registration-form /.test(nodeTextContent) && startNode.tagName == 'P') {
				nodeEditing = startNode;
				tinyMCEPopup.editor.execCommand('mceSelectNode', false, nodeEditing);
				socialLogin = /^[^\]]+ includeSocialLogin=['"]?([^ "']+)/.exec(nodeTextContent)[1] || '';
				redirectToURL = /^[^\]]+ redirectToURL=['"]?([^ "']+)/.exec(nodeTextContent)[1] || '';
				jQuery("input[name=includeSocialLogin]").prop('checked', socialLogin && socialLogin.toLowerCase() == "yes");
				jQuery("input[name=dsidx-RedirectToURL]").val(redirectToURL);
			}
		},
		insert: function() {
			socialLoginOption = ' includeSocialLogin="no"';
			redirectURL = '';
			socialLogin = jQuery('input:checkbox[name=includeSocialLogin]:checked').val();
			redirectURL = jQuery('input:text[name=dsidx-RedirectToURL]').val();
			if(socialLogin && socialLogin == "on") 
				socialLoginOption = ' includeSocialLogin="yes"';
			shortcode = '<p>[idx-registration-form ' + socialLoginOption + ' redirectToURL="'+redirectURL +'"]</p>';
			tinyMCEPopup.editor.execCommand(nodeEditing ? 'mceReplaceContent' : 'mceInsertContent', false, shortcode);
			tinyMCEPopup.close();
		}
	};
	
	return returnObj;
})();

tinyMCEPopup.onInit.add(dsidxRegistartionForm.init, dsidxRegistartionForm);
