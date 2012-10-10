// User interface scripts

	// settings for the header dropdown
	var isMenuOpen = false;
	var menuSpeed = 200;
	var delay = 100; // to prevent dropdown event listeners from overlapping
	
	//trying to kick start IE DOM to recognize dynamically created input
	//myInput = document.createElement("<input type='text' value='Password' class='text-box password dummy-input' tabindex='2'/>");

jQuery(document).ready(function(){

	//IE6 SELECT z-Index bug fix
	var $searchSelectBoxes = $("#edit-filter1, #edit-filter2");
	if ($.browser.msie && $.browser.version == 6)
	{
		var fix_ie6_select_bug = true;
	}
	else
	{
		var fix_ie6_select_bug = false;
	}
	// Header dropdown
	jQuery(".city_edition_selection").click(function(){
		if(isMenuOpen == false){
			if (fix_ie6_select_bug)
			{
				$searchSelectBoxes.hide();
			}
			jQuery(".dropdown").slideDown(menuSpeed);
			setTimeout("isMenuOpen = true", delay);
		}
	});
	jQuery("body").click(function(){
		if(isMenuOpen == true){
			jQuery(".dropdown").slideUp(menuSpeed);
			if (fix_ie6_select_bug)
			{
				$searchSelectBoxes.show();
			}
			setTimeout("isMenuOpen = false", delay);
		}
	});
	
	
	// "swap values" background images for form-text fields
	$("div.login_layer #edit-name").val("");
	$(".login_layer .form-text").each(function(i){
      $(this).focus(function(){
				// move the background well below the visible input box
				$(this).css("background-position","0 32px");
			}).blur(function(){
				// check for if user has entered a value in input
				if ($(this).val() == "") {
					// haven't entered anything, so bring the bg back into view
					$(this).css("background-position","0 0");
				}
			});
		});


  jQuery(".login .text_box"). bind('focus', function(){
    var init_val = jQuery(this).val();
    if (init_val == "Your email") {
      jQuery(this).val("");
      jQuery(this).bind('blur', function(){
        if(jQuery(this).val() == ""){
          jQuery(this).val(init_val);
          }
      });
    }
  });

  // Clearing for do it field .text_box input elements
  jQuery(".do_it_field .text_box").bind('focus', function(){
      var init_val = jQuery(this).val();
      //if (init_val == "First Name") {
      if (isClearTheTextField(init_val)) {
        jQuery(this).val("");
        jQuery(this).bind('blur', function(){
          if(jQuery(this).val() == ""){
          jQuery(this).val(init_val);
          }
        });
      }
    });


	// enter & tab in form text inputs intercepted and attached to new functionality
	var loginFormId = $(".login_layer form").attr("id");
	$('.login_layer .form-text').keydown(function(e){
		// check if the key code is enter/return
		if (e.keyCode == 13){
			$(".login_layer .login_btn a").focus().css("background-position","-1px -25px").blur(function(){
				$(this).css("background-position","-1px -1px");
			});
			$(this).parents('form').submit();
			return false;
		}
		// check if key code is tab and keypress came from the password field
		if (e.keyCode==9 && $(this).hasClass("password")) {
			if ($(this).val() == "") {
				// bring the bg back into view when nothing entered
				$(this).css("background-position","0 0");
			}
			// use hover styling when selecting login anchor on tab
			$(".login_layer .login_btn a").focus().css("background-position","-1px -25px").blur(function(){
				$(this).css("background-position","-1px -1px");
			});
			return false;
		}
  });
	
/*	// Input form clearing ( for password fields )
	
	// Place the words ‘Your email address’ in the email input
	jQuery( 'input.username' ).attr( "value", "Your email address" );
	// Loop through each #edit-pass input
	jQuery.each(jQuery('.password'), function(i, n){

		var self = this;
		jQuery(this).hide();
		
		// we setup a dummy input field that is of type="text" 
		// and then we temporarily hide the real password field
		var dummyInput = jQuery("<input type='text' value='Password' class='text_box password dummy_input' tabindex='2'/>");
	
		jQuery( dummyInput ).insertBefore( this );
		
		jQuery( dummyInput ).bind("select focus", function(){
			jQuery(this).hide();
			jQuery(self).show();
			$("#edit-pass").select();
		});
		
	});*/
	
	/* add a select() statement like above for tabing into the new field, possibly include tabindex #s */
	
	
	/*// set pass value to dummy text value
	var valTarget = jQuery("#edit-pass").val();
	// pass value when move out of the dummy box
	$(".dummy_input").blur(function(){
		// get value at blur to ensure passing user entered value 
		var valGrab = jQuery(".dummy_input").val();
		// check that the field has a value and isn't the default
		if (valGrab != "" && valGrab != "Password") {	
			valTarget = valGrab;
			alert(""+valTarget+" = "+valGrab+"");
		}
	});*/

/*
  // the theory behind this is that when you are not focused on the element have its type set to password
  // otherwise we do not change the values
  jQuery.each(jQuery('.password'), function(i, n){

    // change the password type to type text
    jQuery(this).attr('type', 'text');
    jQuery(this).attr('value', 'Password');
    
    jQuery(this).bind("select focus", function(){
      jQuery(this).attr('type', 'password');
    });
  });
  

	// Clearing for ALL .text_box input elements
	jQuery(".text_box").bind('focus', function(){
		var init_val = jQuery(this).val();
		jQuery(this).val("");
		jQuery(this).bind('blur', function(){
			if(jQuery(this).val() == ""){
				jQuery(this).val(init_val);
			}
		});
	});
	*/

	// Search filters
	jQuery('.search_filter ul.filter_list li span').bind('click', function(){
		jQuery(this).toggleClass('selected');
		jQuery(this).next().next().slideToggle('fast');
	});
	jQuery('.search_filter ul.filter_list ul').hide();
	
	// Carousels
	// each carousel on the same page needs a different setup call 
	// and a unique initCallback function (for setting up pagination)
	
/*	
	jQuery('.media_carousel .thumbnails ul').jcarousel({
		scroll: 1
	});

	jQuery('.photo_picks .photo_carousel ul').jcarousel({
		scroll: 1,
		initCallback: paginatedPhotoPicks,
		buttonNextHTML: '',
		buttonPrevHTML: ''
	});

	jQuery('.photo_picks .photo_carousel_alt ul').jcarousel({
		scroll: 1
	});

	jQuery('.feature.carousel ul.jcarousel-skin').jcarousel({
		scroll: 1,
		initCallback: paginatedFeature,
		buttonNextHTML: '',
		buttonPrevHTML: ''
	});
	 */	
	// jGrowl demo
	// Themes:
		// error
		// warning
		// status
	
	//jQuery.jGrowl("Sticky notification with a header", { header: 'A Header', theme: 'error' });
	//jQuery.jGrowl("Sticky notification with a header", { header: 'A Header', theme: 'warning' });	
	//jQuery.jGrowl("Sticky notification with a header", { header: 'A Header', theme: 'status' });	
		
	// Fancybox demo
	//jQuery('a.fancy').fancybox({'hideOnContentClick': true });

  // conditional check to see if we are on the dcl_import form which would mean we have had a password
  // faux input placed in there
  var dummy_input = jQuery('div.import_section div.form-item input.text_box.password.dummy_input');
  if(dummy_input)
  {
    dummy_input.css('margin-left', '10px');
  }


  // Unsubscribe 
  jQuery(".unsubscribe .user_section input.text_box"). bind('focus', function(){
    var init_val = jQuery(this).val();
    if (init_val == "Your email") {
      jQuery(this).val("");
      jQuery(this).bind('blur', function(){
        if(jQuery(this).val() == ""){
          jQuery(this).val(init_val);
        }
      });
    }
  });

}); // end jQuery(document).ready( ) 

// Fields to clear

function isClearTheTextField(field){
	var lwCaseField = field.toLowerCase();
	var possibilities = new Array();
	
	possibilities[0]="Your email address";
	possibilities[1]="Guest's Last Name";
	possibilities[2]="Friend's email address";
	possibilities[3]="Company";
	possibilities[4]="First Name";
	possibilities[5]="Last Name";
	possibilities[6]="Guest's First Name";
	possibilities[7]="Guest Email Address";
	possibilities[8]="Friend's First Name";
	possibilities[9]="Friend's Last Name";
	possibilities[10]="Your e-mail address";
	possibilities[11]="Friend's e-mail address";
	possibilities[12]="Guest E-mail Address";
	possibilities[13]="E-mail Address";
	possibilities[14]="Email Address";
	
	for (x in possibilities){
		if (possibilities[x].toLowerCase() == lwCaseField){
			return true;
		}
	}
	
	return false;
}

// Login layer
function toggleLoginLayer(){
	jQuery("#login-link a").toggleClass("current");
	jQuery('.nav .login_layer').slideToggle("fast");
} 

// Carousel pagination setup

// this is the callback for setting up a paginated photo picks carousel
function paginatedPhotoPicks(carousel){
	jQuery('.photo_picks ul.pagination li a').bind('click', function(){
		carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
		return false;
	});		
}
// this is the callback for setting up a paginated feature carousel
function paginatedFeature(carousel){
	jQuery('.feature.carousel ul.pagination li a').bind('click', function(){
		carousel.scroll(jQuery.jcarousel.intval(jQuery(this).text()));
		return false;
	});
}
