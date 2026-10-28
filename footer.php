<?php
$site_data = site_get_site_data();
?>
</main>

<footer class="site-footer">
    <div class="container">
        <div class="row footer-topo g-5">
            <div class="col-lg-5">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="<?php echo esc_attr($site_data['nome']); ?>, página inicial">
                    <span class="logo-marca" aria-hidden="true">JW</span>
                    <span class="logo-nome"><?php echo esc_html($site_data['nome']); ?></span>
                </a>
                <p class="texto texto-c footer-sobre">
                    Desenvolvedor de sites para pequenas e médias empresas. Sites institucionais, lojas virtuais e páginas para anúncios
                    rápidos, bonitos e prontos para o Google. <?php echo esc_html($site_data['cidade']); ?>, Vale do Taquari.
                </p>
                <p class="selo-disponivel">
                    <span class="ponto" aria-hidden="true"></span>
                    Agenda aberta para novos projetos
                </p>
            </div>

            <div class="col-6 col-lg-2 offset-lg-1">
                <h2 class="footer-titulo">Navegação</h2>
                <nav class="footer-menu" aria-label="Menu do rodapé">
                    <ul>
                        <?php foreach ($site_data['menu'] as $item) : ?>
                            <li>
                                <a href="<?php echo esc_url($item['url']); ?>"><?php echo esc_html($item['label']); ?></a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </nav>
            </div>

            <div class="col-6 col-lg-4">
                <h2 class="footer-titulo">Contato</h2>
                <ul class="footer-contatos">
                    <li>
                        <a href="<?php echo esc_url(site_whatsapp_link()); ?>" target="_blank" rel="noopener">
                            <?php echo site_icone('whatsapp'); ?>
                            <span><?php echo esc_html($site_data['celular']); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="mailto:<?php echo esc_attr($site_data['email']); ?>">
                            <?php echo site_icone('envelope'); ?>
                            <span><?php echo esc_html($site_data['email']); ?></span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url($site_data['linkedin']); ?>" target="_blank" rel="noopener">
                            <?php echo site_icone('linkedin'); ?>
                            <span>LinkedIn</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?php echo esc_url($site_data['github']); ?>" target="_blank" rel="noopener">
                            <?php echo site_icone('github'); ?>
                            <span>GitHub</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-gigante" data-texto="João Wergutz" aria-hidden="true"></div>

        <div class="footer-base">
            <p>© <?php echo esc_html(wp_date('Y')); ?> <?php echo esc_html($site_data['nome_completo']); ?>. Todos os direitos reservados.</p>
            <a href="<?php echo esc_url(home_url('/politica-de-privacidade/')); ?>">Política de privacidade</a>
            <a href="#conteudo" class="topo">Voltar ao topo <?php echo site_icone('arrow-up-right'); ?></a>
        </div>
    </div>
</footer>

<nav class="barra-contato" aria-label="Contato rápido">
    <a href="<?php echo esc_url(site_whatsapp_link()); ?>" target="_blank" rel="noopener" class="botao botao-destaque">
        <?php echo site_icone('whatsapp'); ?>
        <span>WhatsApp</span>
    </a>
    <a href="<?php echo esc_url(is_front_page() ? '#analise' : home_url('/#analise')); ?>" class="botao botao-contorno">
        <?php echo site_icone('search'); ?>
        <span>Análise grátis</span>
    </a>
</nav>

<a
    href="<?php echo esc_url(site_whatsapp_link()); ?>"
    class="whatsapp-flutuante"
    target="_blank"
    rel="noopener"
    aria-label="Falar com João pelo WhatsApp"
>
    <?php echo site_icone('whatsapp'); ?>
</a>

<?php wp_footer(); ?>

</body>
</html>
