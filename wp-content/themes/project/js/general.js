
jQuery(function($) {
    $( document ).ready(function() {
	    //Add JS class for JS users
        $('html').addClass('js');
        $('html').removeClass('no-js');
        
        // Set a cookie and hide the store notice when the dismiss button is clicked
        $( '.site-notice-dismiss' ).click( function() {
    		Cookies.set( 'site_notice', 'hidden', { path: '/' } );
    		$( '.site-notice' ).slideUp();
    		$('body').removeClass('site-notice-shown');
    	});
    	
    	// Check the value of that cookie and show/hide the notice accordingly
    	if ($(".site-notice")[0]){
	    	if ( 'hidden' === Cookies.get( 'site_notice' ) ) {
	    		$( '.site-notice' ).hide();
	    		$('body').removeClass('site-notice-shown');
            } else {
                $( '.site-notice' ).show();
                $('body').addClass('site-notice-shown');
            }
        };
        
        //Mobile nav toggle
		$('.mobile-button').click(function() {
			$( 'body' ).toggleClass('mobile-nav-open');
			$( '.overlay' ).toggleClass('overlay-open');
			//$('.site-notice-shown .site-notice').slideToggle();
		});
		
		$('.mobile-button.open').on('click', function(){
		    $(".overlay").removeClass('overlay-open');   
		    open = false;
		});
		
	
		
        //ScrollReveal
		var firstLeft = {
            origin: 'left',
            delay: '200',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var secondLeft = {
            origin: 'left',
            delay: '400',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var thirdLeft = {
            origin: 'left',
            delay: '600',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var firstRight = {
            origin: 'right',
            delay: '200',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var secondRight = {
            origin: 'right',
            delay: '400',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var thirdRight = {
            origin: 'right',
            delay: '600',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var firstBottom = {
            origin: 'bottom',
            delay: '200',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var secondBottom = {
            origin: 'bottom',
            delay: '300',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var thirdBottom = {
            origin: 'bottom',
            delay: '400',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
		var fourthBottom = {
            origin: 'bottom',
            delay: '550',
            distance: '40px',
            duration: '1200',
            easing: 'cubic-bezier(0.55, 0, 0.1, 1)',
            reset: false
		};
    });
});