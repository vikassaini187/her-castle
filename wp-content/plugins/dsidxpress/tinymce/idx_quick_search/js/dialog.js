
var dsidxSearchForm = (function() {
	var nodeEditing;
	var returnObj;
	
	returnObj = {
		init: function() {
			var startNode = tinyMCEPopup.editor.selection.getStart();
			var nodeTextContent = startNode ? startNode.textContent || startNode.innerText : '';
			var showAllIsSet;
			
			if (/^\[idx-quick-search /.test(nodeTextContent) && startNode.tagName == 'P') {
				nodeEditing = startNode;
				tinyMCEPopup.editor.execCommand('mceSelectNode', false, nodeEditing);
				format = /^[^\]]+ format=['"]?([^ "']+)/.exec(nodeTextContent)[1] || 'horizontal';
				jQuery("input[name=format][value=" + format + "]").prop('checked', true);

				modernView = /^[^\]]+ modernView=['"]?([^ "']+)/.exec(nodeTextContent)[1] || '';
				jQuery("input[name=modern-view]").prop('checked', modernView && modernView.toLowerCase() == "yes");
			}
		},
		insert: function() {
			format = jQuery('input:radio[name=format]:checked').val();
			if (!format)
				tinyMCEPopup.close();

			modernView = jQuery('input:checkbox[name=modern-view]:checked').val();
			modernViewCode= "";
			if(modernView && modernView == "on") {
				modernViewCode = ' modernView="yes"';

			}
			
			shortcode = '<p>[idx-quick-search format="' + format+ '"' + modernViewCode + ']</p>';
			
			tinyMCEPopup.editor.execCommand(nodeEditing ? 'mceReplaceContent' : 'mceInsertContent', false, shortcode);
			tinyMCEPopup.close();
		}
	};
	
	return returnObj;
})();

tinyMCEPopup.onInit.add(dsidxSearchForm.init, dsidxSearchForm);
