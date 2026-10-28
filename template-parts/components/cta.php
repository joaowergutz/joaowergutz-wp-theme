<?php
/**
 * Chamada final em bloco de cor (antes do rodapé).
 *
 * @var array $args titulo (aceita *destaque*), texto
 */
$site_data = site_get_site_data();
$titulo    = $args['titulo'] ?? 'Vamos tirar o seu *site* do papel?';
$texto     = $args['texto'] ?? 'Me conta sobre a sua empresa e o que você precisa. Eu respondo com ideias, prazo e valor, sem compromisso.';
?>
<section class="cta" aria-labelledby="cta-titulo">
    <div class="container">
        <div class="cta-caixa">
            <p class="rotulo" data-anime>Próximo passo</p>
            <h2 class="cta-titulo" id="cta-titulo" data-anime><?php echo site_destaque($titulo); ?></h2>
            <p class="cta-texto" data-anime><?php echo esc_html($texto); ?></p>

            <div class="cta-botoes" data-anime>
                <a href="<?php echo esc_url(site_whatsapp_link()); ?>" target="_blank" rel="noopener" class="botao botao-escuro botao-g">
                    <?php echo site_icone('whatsapp'); ?>
                    <span>Chamar no WhatsApp</span>
                </a>
                <a href="mailto:<?php echo esc_attr($site_data['email']); ?>" class="cta-email">
                    <?php echo esc_html($site_data['email']); ?>
                    <?php echo site_icone('arrow-up-right'); ?>
                </a>
            </div>
        </div>
    </div>
</section>
