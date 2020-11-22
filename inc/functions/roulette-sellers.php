<?php
add_action( 'phpmailer_init', 'roulette_sellers' );
function roulette_sellers( $phpmailer )
{
    $s = '[Solicitação de Orçamento]';
    if ( $s == $phpmailer->Subject ) {
        /* Limpa o Header do e-mail enviado e os recipients */
        $phpmailer->clearCustomHeaders();
        $phpmailer->ClearAllRecipients();
        //var_dump($phpmailer);
        /* Pega os emais dos vendedores da /options.php */
        $vendedores = get_option( 'odin_vendedores' );
        $debug = get_option( 'odin_debug' );
        if ( $debug[ 'debug_mode' ] >= 1 && !empty( $debug[ 'email_debuger' ] ) ) {
            $vendedores['email_vendedor_1'] = $debug[ 'email_debuger' ];
            $vendedores['email_vendedor_2'] = $debug[ 'email_debuger' ];
            $vendedores['email_vendedor_3'] = $debug[ 'email_debuger' ];
        }
        /* Pega o valor da ordem de venda da /options.php */
        $order_sale = get_option( 'order_sale' );
        /* Pega o valor do contador de orçamentos da /options.php */
        $count_quote = get_option( 'count_quote' );
        if ( ! $order_sale ) {
            
            /* Se a ordem de vendas não estiver preenchida, cria com o valor 1 */
            add_option( 'order_sale', '1' );
        }
        if ( ! $count_quote ) {
            
            /* Se o contador de orcamentos não estiver preenchido, cria com o valor 1 */
            add_action( 'count_quote', '1' );
            $count_quote = '1';
        }
        if ( $order_sale == '1' ) {
            /* Se a ordem de vendas for 1, concatena + 1 e envia o orçamento para o primeiro vendedor */
            $order_sale++;
            update_option( 'order_sale', $order_sale );
            $mailtosend = $vendedores['email_vendedor_1'];
            $phpmailer->AddAddress( $mailtosend, 'Vendedor 1');
            //$phpmailer->addCustomHeader( 'Reply-to:' . $mailtosend . ' Content-Type: text/html' );
        } elseif ( $order_sale == '2' ) {
            /* Se a ordem de vendas for 2, concatena + 1 e envia o orçamento para o segundo vendedor */
            $order_sale++;
            update_option( 'order_sale', $order_sale );
            $mailtosend = $vendedores['email_vendedor_2'];
            $phpmailer->AddAddress( $mailtosend, 'Vendedor 2');
            //$phpmailer->addCustomHeader( 'Reply-to:' . $mailtosend . ' Content-Type: text/html' );
        } elseif ( $order_sale == '3' ) {
            /* Se a ordem de vendas for 3, volta o valor para 1 e envia o orçamento para o terceiro vendedor */
            update_option( 'order_sale', '1' );
            $mailtosend = $vendedores['email_vendedor_3'];
            $phpmailer->AddAddress( $mailtosend, 'Vendedor 3');
            //$phpmailer->addCustomHeader( 'Reply-to:' . $mailtosend . ' Content-Type: text/html' );
        }
        //$parms['headers']= 'Reply-to: ' . get_option( 'admin_email' ) . ' Content-Type: text/html';
        /* Ao enviar o orçamento, adiciona 1 no contador de orçamentos */
        $count_quote++;
        update_option( 'count_quote', $count_quote );
        //$phpmailer->AddAddress( get_option( 'admin_email' ), 'Thander Trade');
        $phpmailer->addCustomHeader( 'Content-Type: text/html' );
        //var_dump( $phpmailer->getAllRecipientAddresses() );
        //$phpmailer->AddReplyTo( "everaldo@agpagencia.com.br", "Second Last" );
        $mail = new PHPMailer();
        $mail->CharSet = 'UTF-8';
        $mail->IsSendmail(); // telling the class to use SendMail transport
        $mail->SetFrom( get_option( 'admin_email' ), get_bloginfo( 'name' ) );
        $mail->AddReplyTo( get_option( 'admin_email' ), get_bloginfo( 'name' ) );
        $mail->AddAddress( get_option( 'admin_email' ), get_bloginfo( 'name' ) );
        $mail->Subject = "Novo pedido de orçamento [Nº " . $count_quote . "]";
        $message = 'Mais um pedido de orçamento foi solicitado através do site ' . get_bloginfo( 'name' ) . ', e foi direcionado ao vendedor ' . $mailtosend . ' [Nº ' . $count_quote . '].';
        $mail->MsgHTML( $message );
        $mail->Send();
       
    }
    //var_dump($phpmailer);
    //die();
    //var_dump( $mail );
    //die();
    return $phpmailer;
}
