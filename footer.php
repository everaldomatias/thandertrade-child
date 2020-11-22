<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package storefront
 */

?>

		</div><!-- .col-full -->
	</div><!-- #content -->

	<?php do_action( 'storefront_before_footer' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="col-full">

			<?php
			/**
			 * Functions hooked in to storefront_footer action
			 *
			 * @hooked storefront_footer_widgets - 10
			 * @hooked storefront_credit         - 20
			 */
			do_action( 'storefront_footer' ); ?>

		</div><!-- .col-full -->
	</footer><!-- #colophon -->

	<?php do_action( 'storefront_after_footer' ); ?>

</div><!-- #page -->

<!-- Modal -->
<div class="modal fade" id="zoom-image-product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
        ...
      </div>
    </div>
  </div>
</div>

<?php wp_footer(); ?>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>

<script>

	var $j = jQuery;

	$j(function(){
        // modal		
		$j('.woocommerce-main-image').on('click', function() {

			var $image = $j(this).find('img').attr('src');

			$j('#zoom-image-product').modal('show');

			$j('#zoom-image-product').find('.modal-body').html('<img src="'+ $image +'" alt="">');

			return false;

		});
	
		// Xomm tumbnais
		
		$j('.storefront-full-width-content.single-product div.product .images .thumbnails a.zoom').on('click', function() {

			var $image = $j(this).find('img').attr('src').replace('-100x100', '');

			$j('#zoom-image-product').modal('show');

			$j('#zoom-image-product').find('.modal-body').html('<img src="'+ $image +'" alt="">');

			return false;
			
			
			
		});

	});
</script>

</body>
</html>
