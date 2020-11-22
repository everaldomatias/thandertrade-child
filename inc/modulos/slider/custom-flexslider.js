jQuery(document).ready(function($) {
    $(window).load(function() {
        $('#main-slider').flexslider({
            controlNav: false,
            directionNav: true,
            touch: true,
            slideshow: true,
            after: function(){
                $( '#main-slider' ).find( 'iframe' ).each( function(){
                    $( this ).attr( 'src', $( this ).attr( 'src' ) );
                });
            }
        });
    });
});