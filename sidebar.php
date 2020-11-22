<?php
/**
 * The sidebar containing the main widget area.
 *
 * @package storefront
 */
?>
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