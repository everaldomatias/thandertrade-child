<?php
/**
 * HTML Template Email
 *
 * @package AGP Woocommerce Request A Quote
 * @since   1.0.0
 * @author  YITH
 * @date 10/05/2019
 */
?>

<?php do_action( 'woocommerce_email_header', $email_heading ); ?>

<p><?php printf( __( 'Pedido de Orçamento recebido de %s. Seguem os detalhes do orçamento:', 'yith-woocommerce-request-a-quote' ), $raq_data['user_name'] ); ?></p>

<?php do_action( 'yith_ywraq_email_before_raq_table', $raq_data ); ?>

<h2><?php _e( 'Pedido de Orçamento', 'yith-woocommerce-request-a-quote' ) ?></h2>

<table cellspacing="0" cellpadding="4" style="width: 100%; border: 1px solid #eee;" border="1" bordercolor="#eee">
    <thead>
    <tr>
        <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Produto', 'yith-woocommerce-request-a-quote' ); ?></th>
        <th scope="col" style="text-align:left; border: 1px solid #eee;"><?php _e( 'Quantidade', 'yith-woocommerce-request-a-quote' ); ?></th>
    </tr>
    </thead>
    <tbody>
    <?php
    if( ! empty( $raq_data['raq_content'] ) ):
        foreach( $raq_data['raq_content'] as $item ):
            if( isset( $item['variation_id']) ){
                $_product = wc_get_product( $item['variation_id'] );
            }else{
                $_product = wc_get_product( $item['product_id'] );
            }
            ?>
            <tr>
                <td scope="col" style="text-align:left;"><a href="<?php echo get_edit_post_link( $_product->get_id() )?>"><?php echo $_product->get_title() ?></a>
                 <?php  if( isset($item['variations'])): ?><small><?php echo yith_ywraq_get_product_meta($item); ?></small><?php endif ?></td>
                <td scope="col" style="text-align:left;"><?php echo $item['quantity'] ?></td>
            </tr>
        <?php
        endforeach;
    endif;
    ?>
    </tbody>
</table>

<?php do_action( 'yith_ywraq_email_after_raq_table', $raq_data ); ?>

<?php if( ! empty( $raq_data['user_message']) ): ?>
    <br>
    <h2><?php printf( __( 'Mensagem do %s: ', 'yith-woocommerce-request-a-quote' ), $raq_data['user_name'] ); ?></h2>
    <p><?php echo $raq_data['user_message']; ?></p>
    <br>
<?php endif ?>

<h2><?php printf( __( 'Informações do %s: ', 'yith-woocommerce-request-a-quote' ), $raq_data['user_name'] ); ?></h2>

<p>
    <strong><?php _e( 'Nome:', 'yith-woocommerce-request-a-quote' ); ?></strong> <?php echo $raq_data['user_name'] ?><br>
    <strong><?php _e( 'Nome do Condomínio / Empresa:', 'yith-woocommerce-request-a-quote' ); ?></strong> <?php echo $raq_data['rqa_social'] ?><br>
    <strong><?php _e( 'Email:', 'yith-woocommerce-request-a-quote' ); ?></strong> 
    <a href="mailto:<?php echo $raq_data['user_email']; ?>"><?php echo $raq_data['user_email']; ?></a><br>
    <strong><?php _e( 'Telefone:', 'yith-woocommerce-request-a-quote' ); ?></strong> <?php echo $raq_data['rqa_phone'] ?><br>

</p>

<br>

<?php do_action( 'woocommerce_email_footer' ); ?>