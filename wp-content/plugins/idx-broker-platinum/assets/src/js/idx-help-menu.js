window.addEventListener('DOMContentLoaded', function(){
	document.querySelector('#contextual-help-link').classList.add('glow');
	document.querySelector('#contextual-help-link').addEventListener('click', disableGlow);


	function disableGlow(){
	    jQuery.post(
	    ajaxurl, {
	        'action': 'idx_disable_glow'
	    });
	    return document.querySelector('#contextual-help-link').classList.remove('glow');
	}
});
