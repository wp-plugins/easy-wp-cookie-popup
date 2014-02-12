/**
 * Admin Control Panel JavaScripts
 * 
 * @version 1.0.8
 * @since 1.0.0
 */

(function($){	

/* Check document cookie, do nothing if cookie shows user has visited before (in last 15 days) */
if( $.cookie("visited") != 'true' ) {
	
	/* Disply the cookie message */
	$('#eu-cookie').show("fast");
	
	/* Set popup not to display if user visited the site in the last 15 days */
	$.cookie('visited', 'true', { expires: 15, path: '/' }); //cookie to be valid for entire site

	/* Allow user to close cookie popup */
	$('.close-icon a').click(function() {
		$('#eu-cookie').hide("fast");
		return false;
	});

	/* Allow user to close cookie popup with escape, return or space button */	
	$(document).keydown( function(eventObject) {
		if(eventObject.which==27) { //Escape button
			$('.close-icon a').click(); //emulates click on prev button 
		}
	});
}

})(jQuery);