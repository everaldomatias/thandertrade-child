<?php
// Função Roleta Mail envia em ordem crescente os e-mails para os
// vendedores cadastrados no site.
function roleta_mail( $recipient ) {
    /* Descomente as linhas abaixo para verificar quais dados a função está recebendo */
/*    echo '<pre>';
        var_dump( $recipient );
    echo '</pre>';*/
    global $woocommerce;
    /* Pega os emais dos vendedores da /options.php */
    $vendedores = array();  
    $vendedores['email_vendedor_1'] = get_theme_mod( 'email_vendedor_1' );
    $vendedores['email_vendedor_2'] = get_theme_mod( 'email_vendedor_2' );
    $vendedores['email_vendedor_3'] = get_theme_mod( 'email_vendedor_3' );
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
    	$count_quote = '0';
    }
    if ( $order_sale == '1' ) {
    	/* Se a ordem de vendas for 1, concatena + 1 e envia o orçamento para o primeiro vendedor */
    	$order_sale++;
    	update_option( 'order_sale', $order_sale );
		$recipient['user_email'] = $vendedores['email_vendedor_1'];
    } elseif ( $order_sale == '2' ) {
    	/* Se a ordem de vendas for 2, concatena + 1 e envia o orçamento para o segundo vendedor */
    	$order_sale++;
    	update_option( 'order_sale', $order_sale );
    	$recipient['user_email'] = $vendedores['email_vendedor_2'];
    } elseif ( $order_sale == '3' ) {
    	/* Se a ordem de vendas for 3, volta o valor para 1 e envia o orçamento para o terceiro vendedor */
    	update_option( 'order_sale', '1' );
		$recipient['user_email'] = $vendedores['email_vendedor_3'];
    }
    /* Ao enviar o orçamento, adiciona 1 no contador de orçamentos */
    $count_quote++;
    update_option( 'count_quote', $count_quote );
	/* Envia e-mail para o administrador do site, informando da nova requisição de orçamento */
	$headers = 'From: [' . get_bloginfo( 'name' ) . '] <' . get_option( 'admin_email' ) . '>' . "\r\n";
	$title = 'Novo pedido de orçamento [ Nº '. $count_quote .' ]';
	$message = 'Mais um pedido de orçamento foi solicitado através do site ' . get_bloginfo( 'name' ) . ', e foi direcionado ao vendedor ' . $recipient['user_email'] . '.';
	wp_mail( get_option( 'admin_email' ), $title, $message, $headers );
    /* Descomente a linha abaixo para verificar qual email receberá a mensagem atual */
    //echo $recipient['user_email'];
}
//add_filter( 'send_raq_mail_notification', 'roleta_mail', 15, 2 );
function teste_roleta() {
    $vendedores = array();
    $vendedores['email_vendedor_1'] = get_theme_mod( 'email_vendedor_1' );
    $vendedores['email_vendedor_2'] = get_theme_mod( 'email_vendedor_2' );
    $vendedores['email_vendedor_3'] = get_theme_mod( 'email_vendedor_3' );
    echo '<pre>';
        var_dump( $vendedores );
    echo '</pre>';
}
//add_action( 'wp_footer', 'teste_roleta' );
/**
 * Custom functions to send mail to sellers
 *
 * @package AGP
 */
//add_action( 'phpmailer_init', 'roulette_sellers' );
function roulette_sellers( $phpmailer ) {
    echo '<pre>';
        var_dump( $phpmailer );
    echo '</pre><hr>';
    /* Limpa o Header do e-mail enviado e os recipients */
    $phpmailer->clearCustomHeaders();
    $phpmailer->ClearAllRecipients();
    //var_dump($phpmailer);
    
    /* Pega os emais dos vendedores da /options.php */
    $vendedores = array();
    $vendedores['email_vendedor_1'] = get_theme_mod( 'email_vendedor_1' );
    $vendedores['email_vendedor_2'] = get_theme_mod( 'email_vendedor_2' );
    $vendedores['email_vendedor_3'] = get_theme_mod( 'email_vendedor_3' );
    $debug = array();
    $debug['debug_mode'] = get_theme_mod( 'debug_mode' );
    $debug['email_debuger'] = get_theme_mod( 'email_debuger' );
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
    $mail->SetFrom( 'site@agphost.com.br', get_bloginfo( 'name' ) );
    //$mail->SetFrom( get_option( 'admin_email' ), get_bloginfo( 'name' ) );
    $mail->AddReplyTo( get_option( 'admin_email' ), get_bloginfo( 'name' ) );
    $mail->AddAddress( get_option( 'admin_email' ), get_bloginfo( 'name' ) );
    $mail->Subject = "Novo pedido de orçamento [Nº " . $count_quote . "]";
    $message = 'Mais um pedido de orçamento foi solicitado através do site ' . get_bloginfo( 'name' ) . ', e foi direcionado ao vendedor ' . $mailtosend . ' [Nº ' . $count_quote . '].';
    $mail->MsgHTML( $message );
    $mail->Send();
    echo '<pre>';
        var_dump( $phpmailer );
    echo '</pre>';
    die();
    //var_dump($phpmailer);
    //die();
    //var_dump( $mail );
    //die();
    return $phpmailer;
}


/**
 * 
 * @link https://phpmailer.github.io/PHPMailer/classes/PHPMailer.PHPMailer.PHPMailer.html
 * @author Everaldo Matias <https://everaldo.dev>
 * @since 03/05/2019
 * @version 2.0
 *
 */
add_action( 'phpmailer_init', 'roulette_sellers_2' );
function roulette_sellers_2( $phpmailer ) {
    /**
     * Inicia a roleta de e-mails
     */
    // Pega os emais dos vendedores da /options.php
    $vendedores = array();
    $vendedores['email_vendedor_1'] = get_theme_mod( 'email_vendedor_1' );
    $vendedores['email_vendedor_2'] = get_theme_mod( 'email_vendedor_2' );
    $vendedores['email_vendedor_3'] = get_theme_mod( 'email_vendedor_3' );
    $vendedor_da_vez = '';
    // Opção para debugar a roleta de e-mails
    $debug = array();
    $debug['debug_mode'] = get_theme_mod( 'debug_mode' );
    $debug['email_debuger'] = get_theme_mod( 'email_debuger' );
    if ( $debug[ 'debug_mode' ] >= 1 && ! empty( $debug[ 'email_debuger' ] ) ) {
        $vendedores['email_vendedor_1'] = $debug[ 'email_debuger' ];
        $vendedores['email_vendedor_2'] = $debug[ 'email_debuger' ];
        $vendedores['email_vendedor_3'] = $debug[ 'email_debuger' ];
        $vendedor_da_vez = $debug[ 'email_debuger' ];
    }
    // Pega a ordem de venda da /options.php
    $order_sale = get_option( 'order_sale' );
    if ( ! $order_sale ) {
        // Se a ordem de vendas não estiver definida, cria com o valor 1
        add_option( 'order_sale', '1' );
    }
    // Pega o valor do contador de orçamentos da /options.php
    $count_quote = get_option( 'count_quote' );
    if ( ! $count_quote ) {
        // Se o contador de orcamentos não estiver preenchido, cria com o valor 1
        add_action( 'count_quote', '1' );
        $count_quote = '1';
    }
    // Roda a roleta :)
    if ( $order_sale == '1' ) {
        
        /* Se a ordem de vendas for 1, concatena + 1 e envia o orçamento para o primeiro vendedor */
        $order_sale++;
        update_option( 'order_sale', $order_sale );
        $phpmailer->addAddress( $vendedores['email_vendedor_1'], 'Vendedor 1');
        $vendedor_da_vez = $vendedores['email_vendedor_1'];
        
    } elseif ( $order_sale == '2' ) {
        
        /* Se a ordem de vendas for 2, concatena + 1 e envia o orçamento para o segundo vendedor */
        $order_sale++;
        update_option( 'order_sale', $order_sale );
        $phpmailer->addAddress( $vendedores['email_vendedor_2'], 'Vendedor 2');
        $vendedor_da_vez = $vendedores['email_vendedor_2'];
        
    } elseif ( $order_sale == '3' ) {
        
        /* Se a ordem de vendas for 3, volta o valor para 1 e envia o orçamento para o terceiro vendedor */
        update_option( 'order_sale', '1' );
        $phpmailer->addAddress( $vendedores['email_vendedor_3'], 'Vendedor 3');
        $vendedor_da_vez = $vendedores['email_vendedor_3'];
        
    }
    /**
     * Primeiro e-mail, esse é enviado a pessoa que está solicitando o orçamento
     * e para o vendedor
     */ 
    // Seta o e-mail remetente (quem envia)
    $from = 'wordpress@' . $_SERVER['SERVER_NAME'];
    $phpmailer->setFrom( $from, 'Contato' );
    // Definições de cabeçalho e charset
    $phpmailer->addCustomHeader( 'Content-Type: text/html' );
    $phpmailer->CharSet = 'UTF-8';
    
    /**
     * Segundo e-mail, esse é enviado para o gerente do site controlar qual vendedor recebeu determinada cotação
     */ 
    // Inicia a segunda mensagem
    $mail_gerente = new PHPMailer;
    $mail_gerente->CharSet = 'UTF-8';
    $mail_gerente->IsSendmail(); // telling the class to use SendMail transport
    
    // Seta o e-mail remetente (quem envia)
    $from = 'wordpress@' . $_SERVER['SERVER_NAME'];
    $mail_gerente->setFrom( $from, 'Contato' );
    // Seta o e-mail do gerente
    $mail_gerente->addAddress( 'matiaseveraldo@gmail.com', 'Eve Gerente' );
    // Mensagem
    $mail_gerente->Subject = "Novo pedido de orçamento [Nº " . $count_quote . "]";
    $mensagem = 'Mais um pedido de orçamento foi solicitado através do site ' . get_bloginfo( 'name' ) . ', e foi direcionado ao vendedor ' . $vendedor_da_vez . ' [Nº ' . $count_quote . '].';
    $mail_gerente->isHTML(true);
    $mail_gerente->Body    = nl2br($mensagem);
    $mail_gerente->AltBody = nl2br(strip_tags($mensagem));
    $mail_gerente->MsgHTML( $mensagem );
    //$mail_gerente->Send();
    if ( ! $mail_gerente->Send() ) {
        echo 'Não foi possível enviar sua mensagem.<br>';
        echo 'Erro: ' . $mail_gerente->ErrorInfo;
    }
     /* Ao enviar o orçamento, adiciona 1 no contador de orçamentos */
    $count_quote++;
    update_option( 'count_quote', $count_quote );
 /*   echo '<pre>';
        var_dump( $phpmailer );
    echo '</pre>';
    die();*/
    // Envia a primeira mensagem
    return $phpmailer;
}