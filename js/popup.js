/**
 * Admin Control Panel JavaScripts
 * 
 * @version 1.0.0
 * @since 1.0.0
 */

(function($){
if (document.cookie.indexOf('visited=true') == -1) {
	var fifteenDays = 60*60*24*15;
	var expires = new Date((new Date()).valueOf() + fifteenDays);
	document.cookie = "visited=true;expires=" + expires.toUTCString();
	$('#eu-cookie').show("fast");
	$('.close-icon').click(function() {
		$('#eu-cookie').hide("fast");
		return false;
	});
}  
})(jQuery);