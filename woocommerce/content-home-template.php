<!-- Template for include custom template Home -->
<div class="row">
    
    <aside class="category-products col-sm-3">
        <h2 id="category-toggle">Categorias <span class="toggle-equiv">&equiv;</span> </h2>
        <?php
        wp_nav_menu(
            array(
                'theme_location' => 'sidebar-home-menu',
                'depth'          => 2,
                'container'      => false,
                'menu_class'     => '-class-class',
            )
        );
        ?>
    </aside><!-- /.category-products -->
    <div class="col-sm-9 home-products">
        <h2>Produtos em Destaque</h2>
        
        <?php
        /**
         * Return products by term 'Destaques'
         */
        $args = array(
            'post_type'           => 'product',
            'posts_per_page'      => 6,
            'ignore_sticky_posts' => 1,
            'tax_query'           => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field'    => 'slug',
                    'terms'    => 'destaques'
                ),
            ),
        );
        $featured_products = new WP_Query( $args );
        if ( $featured_products->have_posts() ) : ?>
            <ul class="products columns-3">
                <?php while ( $featured_products->have_posts() ) : $featured_products->the_post(); ?>
                    <?php
                    /**
                     * Include template file for each element by loop
                     */
                    wc_get_template_part( 'content', 'product' );
                    ?>
                
                <?php endwhile; ?>
                <?php
                /**
                 * Print Banner 1
                 */
                $image_banner = get_theme_mod( 'image_publicity' );
                $link_publicity = get_theme_mod( 'link_publicity' );
                if ( $image_banner ) {
                    if ( $link_publicity ) {
                        echo '<a target="_blank" href="' . esc_url( $link_publicity ) . '">';
                            echo '<img class="banner" src="' . esc_url( $image_banner ) . '" />';
                        echo '</a>';
                    } else {
                        echo '<img class="banner" src="' . esc_url( $image_banner ) . '" />';
                    }                
                }
            ?>
            </ul><!-- /.products -->
        <?php endif; ?>
    </div><!-- /.home-products -->
</div><!-- /.row -->
<div class="row">
    <div class="col-sm-12 top-sale -nopadding">
        <?php do_action( 'homepage_popular_products' ); ?>
    </div><!-- /.top-sale -->
    <div class="col-sm-12 home-partners -nopadding">
        <h2>Nossos fornecedores</h2>
        <?php
            if ( function_exists( 'loop_clientes' ) ) {
                 loop_clientes( [], 'teste' );
            }
        ?>
    </div>
    <div class="col-sm-12 home-promotional-banner">
        <?php
            /**
             * Print Banner 2
             */
            $image_banner_2 = get_theme_mod( 'image_publicity_2' );
            $link_publicity_2 = get_theme_mod( 'link_publicity_2' );
            if ( $image_banner_2 ) {
                if ( $link_publicity_2 ) {
                    echo '<a target="_blank" href="' . esc_url( $link_publicity_2 ) . '">';
                        echo '<img class="banner" src="' . esc_url( $image_banner_2 ) . '" />';
                    echo '</a>';
                } else {
                    echo '<img class="banner" src="' . esc_url( $image_banner_2 ) . '" />';
                }                
            }
        ?>
    </div><!-- /.home-promotional-banner -->
</div><!-- /.row -->
</main>
</div><!-- primary -->
</div><!-- col-full -->
<div class="row">
    <div class="col-sm-6 form-contact">
        <div class="inner">
            <h3>Entre em contato conosco</h3>
            <?php echo do_shortcode( '[contact-form-7 id="5" title="Formulário de contato 1"]' ); ?>            
        </div><!-- .inner -->
    </div><!-- .form-contact -->
    <div class="col-sm-6 visite-nos">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3653.635309557088!2d-46.858445584412706!3d-23.688996472204558!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94cfacf1b1af97db%3A0x6848f026600d305a!2sR.+Tambe%2C+35+-+Jardim+Itapecerica%2C+Itapecerica+da+Serra+-+SP%2C+06853-480!5e0!3m2!1spt-BR!2sbr!4v1551201830389" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>              
        <p class="description-map">
            <a href="https://goo.gl/maps/iotKtvRi5gF2">
                R. Tambe, 35 - Jardim Itapecerica<br /> 
                Itapecerica da Serra<br />
                SP 06853-480
            </a>
        </p>
    </div> <!-- .visite-nos -->
</div><!-- .row -->
<main>
    <div class="content-area"><!-- primary -->
        <div class="col-full"><!-- col-full -->
