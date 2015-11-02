jQuery( document ).ready(function( $ ) {

	$("#signout").click(function() {
	    return intuit.ipp.anywhere.logout(function () { window.location.href = "http://promis.local/openid"; });
	});


});