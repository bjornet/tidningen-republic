<?php global $user; ?>

<div<?php print $css_id ? " id=\"$css_id\"" : ''; ?> class="layout--page <?php print $classes; ?>">

<div class="header-wrapper">
  <div class="container">
    <div class="row header">
      <header class="col-sm-5" role="banner">
        <?php print render($content['header']); ?>    
      </header>
      <div class="header-block col-sm-7 hidden-xs">
        <div class="header-block-inner pull-right clearfix">
          <?php print render($content['header_block']); ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container main-content">
  <?php if (!empty($content['help'])): ?>
    <div class="layout--fixed region--help clearfix">
      <?php print render($content['help']); ?>
    </div>
  <?php endif; ?>

  <a id="main-content"></a>
  <?php print $content['content']; ?>

  <?php if (!empty($content['footer'])): ?>
    <footer class="footer row" role="contentinfo">
      <div class="col-lg-12">
        <a id="menu"></a>
        <?php print render($content['footer']); ?>
      </div>
    </footer>
  <?php endif; ?>
</div>

<?php // =========
// = TEMP: Popup =
// ============ ?>

<?php # LYBE: Björn [Popup: Scripts] ?>

<?php # LYBE: Björn [Include jQuery] ?>
<script src="https://code.jquery.com/jquery-1.8.2.min.js"></script>

<?php # LYBE: Björn [Include jQuery Popup Overlay] ?>
<script src="https://cdn.rawgit.com/vast-engineering/jquery-popup-overlay/1.7.10/jquery.popupoverlay.js"></script>

<?php # LYBE: Björn [Add content to the popup] ?>
<div id="my_popup">

	<div class="col1">
		<div class="text">
			Some text here that explains whats going on here!
		</div>
		
		<form action="#" type="post" accept-charset="utf-8">
			<p><input name="phone" type="tel" pattern="\d{4}[\s]*\d{3}[\s]*\d{3}" placeholder="ex 0706 999 111" id="input-phone" required></p>
			<p><input name="name" type="text" placeholder="Fullständigt namn" required></p>
			<p><input name="streetaddress" type="text" placeholder="Gatuadress" required></p>
			<p><input name="zip" type="number" placeholder="Postnummer" required></p>
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
		<img src="http://tidningenrepublic.se/sites/default/files/styles/forstasida/public/hjarnornaskrig2.jpg">
	</div>		

</div>

<script>
jQuery(document).ready(function($) {
	$.noConflict();
	
	// Initialize the plugin
	if (getCookie('popup') === '') {
		$('#my_popup').popup({
			autoopen: true,
			autozindex: true,
			focuselement: '#input-phone',
			transition: 'all 0.3s',
			onclose: setCookie('popup', 'true', 90)
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
	        url: "sites/all/themes/rabash_republic1/campaing-data.php",
	        type: "post",
	        data: serializedData
	    });

	    // Callback handler that will be called on success
	    request.done(function (response, textStatus, jqXHR){
			if (response === '1') {
				$('#my_popup').popup('toggle');


				var tnxMsg = "<div class='tnx-msg'>Tack för din förfrågan vi skickar vad du vill snart!</div>";


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
	#my_popup {
		font-family: sans-serif;
		transform: scale(0.9);
		background: white;
		padding: 2em;
		display: none;
	}
	.popup_visible #my_popup { transform: scale(1); }

	.col1, .col2 {
		width: 200px;
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
	    width: 100%;
	    margin: 20px 0px 0px;
	    float: right;
	}
	
	#my_popup p {
		width: 65%;
		margin: 2px;
	}
	
	#my_popup p input {
		padding: 15px 20px;
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
	
	.tnx-msg {
	    background-color: white;
	    margin: 0;
	    display: block;
	    width: 96%;
	    padding: 2%;
	    text-align: center;
	    font-family: sans-serif;
	    color: crimson;
	}
	
</style>