<?php
/**
 * Perguntas frequentes (sanfona; uma aberta por vez).
 */
?>
<section class="secao faq" aria-labelledby="faq-titulo">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <p class="rotulo rotulo-escuro" data-anime><?php echo esc_html($args['rotulo'] ?? 'Dúvidas'); ?></p>
                <h2 class="titulo" id="faq-titulo" data-anime>Perguntas <em>frequentes</em></h2>
                <p class="texto" data-anime>
                    Não encontrou o que procurava?
                    <a href="<?php echo esc_url(site_whatsapp_link('Olá, João! Tenho uma dúvida sobre sites.')); ?>" target="_blank" rel="noopener">Me chama no WhatsApp</a>.
                </p>
            </div>

            <div class="col-lg-8">
                <div class="faq-lista" data-faq>
                    <?php foreach (site_get_faq() as $item) : ?>
                        <details class="faq-item" data-anime>
                            <summary>
                                <span><?php echo esc_html($item['pergunta']); ?></span>
                                <?php echo site_icone('plus-lg'); ?>
                            </summary>
                            <p><?php echo esc_html($item['resposta']); ?></p>
                        </details>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</section>
