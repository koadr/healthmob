jQuery(document).ready(function($) {

	var window_width = $(window).width();
	var mobile_nav = false;

	// Check window width after resize
	$(window).resize(function() {
		if(mobile_nav != true) {
			window_width = $(window).width();

			// Create mobile nav
			if(window_width < 768) {
				mobile_nav = true;
				nav_select();
			}
		}
	});

/*---------------------------------------------------------------------------*
 * Nav Dropdown
/*---------------------------------------------------------------------------*/
	$('#nav ul.sub-menu').hide();
	$('#nav li').hover( 
		function() {
			$(this).children('ul.sub-menu').slideDown('fast');
		}, 
		function() {
			$(this).children('ul.sub-menu').hide();
		}
	);

/*---------------------------------------------------------------------------*
 * Nav Select
/*---------------------------------------------------------------------------*/
	// Check to see if mobile nav needs to be created
	if(window_width < 768) {
		mobile_nav = true;
		nav_select();
	}

	function nav_select() {
		// Insert dropdown nav container
		$('<div class="select-nav container"><select class="nav"></select></div>').appendTo('#header');

		// Create default option "Go to..."
		$('<option />', {
			'selected' : 'selected',
			'value'    : '',
			'text'     : 'Navigate to...'
		}).appendTo('#header select.nav');

		// Populate dropdown with menu items
		$("#header-nav a").each(function() {
			var el = $(this);
			var optText = '&nbsp;' + el.text();
			var optSub = el.parents('.sub-menu');
			var len = optSub.length;
			
			// if menu has sub menu
			if(el.parents('ul').hasClass('sub-menu') ) {
				dash = Array( len+1 ).join('&ndash;');
				optText = dash + optText;
			}

			$("<option />", {
				'value'		: this.href,
				'html'		: optText,
				'selected'	: (this.href == window.location.href)
			}).appendTo("#header select.nav");
		});

		$("#header select.nav").change(function() {
			window.location = $(this).find("option:selected").val();
		});
	}
	

/*---------------------------------------------------------------------------*
 * Portfolio
/*---------------------------------------------------------------------------*/
	if($('#work-size').length) {
		// Portfolio Size
		$('#work-size a').click(function(e) {
			$('#work-size li').removeClass('current');
			$(this).parent().addClass('current');
			var current_layout = $('#work-size').attr('data-current');
			var layout = $(this).attr('data-layout');
			$('#work div').removeClass(current_layout);
			$('#work div').addClass(layout);
			$('#work-size').attr('data-current',layout);

			// Reset isotope layout properties
			$('.isotope').isotope('reLayout');

			e.preventDefault();
		});
	}
	
/*---------------------------------------------------------------------------*
 * Shortcodes
/*---------------------------------------------------------------------------*/

/*  shortcode : alert
/* ------------------------------------ */
	$(".alert-close").click(function(){
		$(this).parent().slideUp();
		return false;
	});

/*  shortcode : accordion
/* ------------------------------------ */
	var allPanels = $('.accordion > .inner').hide();
    
  	$('.accordion > .title > a').click(function() {
      $this = $(this);
      $target =  $this.parent().next();

      if(!$target.hasClass('active')){
         allPanels.slideUp();
         $target.slideDown();
         $this.parent().parent().find('.title').removeClass('active');
         $this.parent().addClass('active');
      }
      
    	return false;
  	});
	
/*  shortcode : toggle
/* ------------------------------------ */
	$(".toggle .title").toggle(function(){
		$(this).addClass("active").parent().find('.inner').slideDown();
		}, function () {
		$(this).removeClass("active").parent().find('.inner').slideUp();
	});
	
/*  shortcode : tabs
/* ------------------------------------ */
	var tabContainers = $('div.tabs > div');
	tabContainers.hide().filter(':first').show();
			
	$('div.tabs ul.tabs-nav a').click(function () {
		tabContainers.hide();
		tabContainers.filter(this.hash).show();
		$('div.tabs ul.tabs-nav a').removeClass('active');
		$(this).addClass('active');
		return false;
	}).filter(':first').click();
	

/*---------------------------------------------------------------------------*
 * Misc
/*---------------------------------------------------------------------------*/
	
/*  table alt row
/* ------------------------------------ */
	if($('table').length) {
		$('table tr:odd').addClass('alt');
	}
	
/*  fancybox
/* ------------------------------------ */
	$('.fancybox').fancybox();
	
/*  smooth scroll to top
/* ------------------------------------ */
	$('#footer a#to-top').click(function() {
		$('html, body').animate({scrollTop:0},'slow');
		return false;
	});
	
});