<?php # LYBE: Björn [Popup: Scripts] ?>

<?php # LYBE: Björn [Include jQuery] ?>
<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>

<?php # LYBE: Björn [Include jQuery Popup Overlay] ?>
<script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.10/jquery.popupoverlay.js"></script>

<?php # LYBE: Björn [Add content to the popup] ?>
<div id="my_popup">

	<div class="col1">
		<div class="text">”Hem till byn” nominerat till Stora Journalistpriset!</div>

		<form action="#" type="post" accept-charset="utf-8">
			<p><input name="phone" type="tel" pattern="(\d\s*){9,10}" placeholder="Telenr" id="input-phone" required></p>
			<p><input name="name" type="text" placeholder="Namn" required></p>
			<p><input name="streetaddress" type="text" placeholder="Gatuadress" required></p>
			<p><input name="zip" type="text" pattern="(\d\s*){5}" placeholder="Postnr" required></p>
			<p><input name="city" type="text" placeholder="Stad" required></p>
			<p>
				<input id="form-submit" type="submit" style="display: none;" value="">
				<label class="form-submit" for="form-submit">Skicka</label>
			</p>
		</form>
	</div>
	<div class="col2">
		<?php # LYBE: Björn [Add an optional button to close the popup] ?>
		<button class="my_popup_close">X</button>
		<img src="http://tidningenrepublic.se/sites/default/files/styles/huvudbild/public/grim1_2.jpg">
	</div>
	
	<div class="clear"></div>

	<div class="small-text"><span><b>Det här reportaget kom till efter hundratals timmar av ideellt arbete från skribent och fotograf Alexander Mahmoud samt Re:publics redaktion. Stöd oberoende journalistik! Teckna en prenumeration nu - de femtio första får ”Hem till byn”-numret som bonus!</b></span></div>
</div>

<script>
jQuery(document).ready(function($) {
	$.noConflict();
	
	var cookieName = 'popup_htb';
	// Initialize the plugin
	if (getCookie(cookieName) === '') {
		$('#my_popup').popup({
			autoopen: true,
			autozindex: true,
			focuselement: '#input-phone',
			transition: 'all 0.3s',
			onclose: setCookie(cookieName, 'true', 90)
		});
	}

	function setCookie(cname, cvalue, exdays) {
		/** LYBE: Björn [check] **/
		if (getCookie(cname) !== 'true') {
			/** LYBE: Björn [Set cookie] **/
			var d = new Date();
		    d.setTime(d.getTime() + (exdays*24*60*60*1000));
		    var expires = "expires="+d.toUTCString();
		    document.cookie = cname + "=" + cvalue + "; " + expires;
		}
	}

	function getCookie(cname) {
	    var name = cname + "=";
	    var ca = document.cookie.split(';');
	    for(var i=0; i<ca.length; i++) {
	        var c = ca[i];
	        while (c.charAt(0)==' ') c = c.substring(1);
	        if (c.indexOf(name) == 0) return c.substring(name.length,c.length);
	    }
	    return "";
	}

	
	// Variable to hold request
	var request;

	// Bind to the submit event of our form
	$("#my_popup form").submit(function(event){

	    // Abort any pending request
	    if (request) {
	        request.abort();
	    }
	    // setup some local variables
	    var $form = $(this);

	    // Let's select and cache all the fields
	    var $inputs = $form.find("input, select, button, textarea");

	    // Serialize the data in the form
	    var serializedData = $form.serialize();

	    // Let's disable the inputs for the duration of the Ajax request.
	    // Note: we disable elements AFTER the form data has been serialized.
	    // Disabled form elements will not be serialized.
	    $inputs.prop("disabled", true);

	    // Fire off the request to /form.php
	    request = $.ajax({
	        url: "sites/all/themes/rabash_republic1/bjorn_campaing-data.php",
	        type: "post",
	        data: serializedData
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
			if (response === '1') {
				$('#my_popup').popup('toggle');


				var tnxMsg = "<div class='tnx-msg'>Vad kul att du väljer oberoende journalistik. Trevlig läsning!</div>";


				$('body').prepend(tnxMsg);
			}
	    });

	    // Callback handler that will be called on failure
	    request.fail(function (jqXHR, textStatus, errorThrown){
	        // Log the error to the console
	        console.error(
	            "The following error occurred: "+
	            textStatus, errorThrown
	        );
	    });

	    // Callback handler that will be called regardless
	    // if the request failed or succeeded
	    request.always(function () {
	        // Reenable the inputs
	        $inputs.prop("disabled", false);
	    });

	    // Prevent default posting of form
	    event.preventDefault();
	});
});
</script>

<?php # LYBE: Björn [Popup: Styles] ?>
<style type="text/css" media="screen">
	.clear {
		clear: both;
	}
	#my_popup {
		font-family: sans-serif;
		transform: scale(0.9);
		background: white;
		padding: 2em;
		display: none;
	}
	.popup_visible #my_popup { transform: scale(1); }

	.col1, .col2 {
		/* width: 200px;*/
		width: 50%;
		float: left;
	}

	#my_popup .my_popup_close {
	    cursor: pointer;
	    border: 3px solid black;
	    background-color: white;
	    font-weight: bold;
	    width: 2em;
	    height: 60px;
	    font-size: 2em;
	    float: right;
	    padding: 15px 10px 10px;
	}
	#my_popup img {
	    width: 95%;
	    margin: 9px 0px 0px;
	    float: right;
	}
	
	#my_popup p {
		margin-bottom: 2px;
	}
	
	#my_popup p input { padding: 15px 20px; }
	@media (min-width: 768px) {
		#my_popup p input {
			width: 100%;
		}
	}	
	
	#my_popup .text {
	    font-size: 1.1em;
	    padding-left: 4px;
	    font-weight: bold;
	    position: absolute;
	}
	#my_popup .small-text {
	    margin-top: 10px;
	    font-size: 1.2em;
	    max-width: 500px;
	    float: left;
	}

	#my_popup label.form-submit {
		cursor: pointer;
	    background-color: #333;
	    display: inline-block;
	    width: 100%;
	    padding: 15px 20px;
	    text-align: center;
	    color: white;
	    text-transform: uppercase;
	    font-size: 0.8em;
	}
	
	#my_popup .col1 form { margin-top: 67px; }
	
	.tnx-msg {
		background-color: white;
	    margin: 0;
	    display: block;
	    width: 100%;
	    text-align: center;
	    font-family: sans-serif;
	    color: crimson;
	    position: fixed;
	    z-index: 99;
	    box-shadow: black 0px -7px 10px 2px;
	    padding: 20px 0;
	}
	
</style>