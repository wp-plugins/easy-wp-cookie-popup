/**
 * Admin Control Panel JavaScripts
 * 
 * @version 1.0.5
 * @since 1.0.0
 */

(function($){

/* Display cookie popup if user has not visited the site in the last 15 days */
if (document.cookie.indexOf('visited=true') == -1) {
	var fifteenDays = 1000*60*60*24*15;
	var expires = new Date((new Date()).valueOf() + fifteenDays);
	document.cookie = "visited=true;expires=" + expires.toUTCString();
	$('#eu-cookie').show("fast");
	$('.close-icon').click(function() {
		$('#eu-cookie').hide("fast");
		return false;
	});
}

/* Allow user to close cookie popup with escape, return or space button */	
$(document).keydown( function(eventObject) {
	if(eventObject.which==27) { //Escape button
		$('.close-icon').click(); //emulates click on prev button 
	}
});

})(jQuery);