; (function ($) {
	$('.slick-slider').slick({
		slidesToShow: 5,
		slidesToScroll: 1,
		arrows: false,
		autoplay: true,
		autoplaySpeed: 0,
		speed: 5000,
		cssEase: 'linear',
		centerPadding: '10px',
		responsive: [
			{
				breakpoint: 768,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			},
			{
				breakpoint: 493,
				settings: {
					slidesToShow: 3,
					slidesToScroll: 3
				}
			}
			// You can unslick at a given breakpoint now by adding:
			// settings: "unslick"
			// instead of a settings object
		]
	});
})(jQuery);
