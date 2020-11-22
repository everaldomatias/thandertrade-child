<?php

/**
 * Checks whether Kirki is installed and active
 */

if ( ! class_exists( 'Kirki' ) ) {
	add_action( 'admin_notices', 'agp_kirki_notice' );
}

function agp_kirki_notice() {
	?>
	<div class="update-nag">
		<p><?php _e( 'Please install and/or activate <a href="' . get_admin_url() . 'plugin-install.php?s=kirki&tab=search&type=term">Kirki Toolkit</a>, it is required for the site work properly!', 'storefront' ); ?></p>
	</div><!-- /.update-nag notice -->
	<?php
}