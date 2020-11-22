jQuery(document).ready(function($) {
	$("body").on("click", ".add-request-quote-button", function() {
		setTimeout(function() {
			$(".close-reveal-modal").trigger("click");
		}, 2000);
	});
	$.ajaxPrefilter(function(options) {
		console.log(options.url);
		console.log(options.data);
		if (options.url != ywraq_frontend.ajaxurl) {
			return;
		}
		console.log(options.data);
		//var data_json = JSON.parse('{"' + decodeURI( options.data.replace(/&/g, "\",\"").replace(/=/g,"\":\"")) + '"}');
		if (options.data.search("yith_ywraq_action") === -1) {
			return;
		}

		var qty = $("#woocommerce-qty-number").val();

		options.data = options.data + "&quantity=" + qty;
		console.log("qty");
		console.log(options.data);
	});
});
jQuery(document).ready(function($) {
	$(document).foundation();
	$(".reveal-modal").on("opened", function() {
		$("#single-slider").slick();
	});
});
