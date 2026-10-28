<?php
$site_data  = site_get_site_data();
$menu_items = $site_data['menu'];
?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta
        name="viewport"
        content="width=device-width, initial-scale=1"
    >
    <script>
        document.documentElement.classList.add('js');

        /* Elementos animados começam ocultos (sem piscar); se as animações não rodarem em 3s
           (GSAP fora do ar, erro no animations.js), tudo aparece */
        if (!window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
            document.documentElement.classList.add('anime');
            setTimeout(function () {
                if (!window.siteAnime) {
                    document.documentElement.classList.remove('anime');
                }
            }, 3000);
        }
    </script>

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<a class="screen-reader-text" href="#conteudo">Pular para o conteúdo</a>

<header class="site-header">
    <div class="container">
        <div class="header-row">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="logo" aria-label="<?php echo esc_attr($site_data['nome']); ?>, página inicial">
                <span class="logo-marca" aria-hidden="true">JW</span>
                <span class="logo-nome"><?php echo esc_html($site_data['nome']); ?></span>
            </a>

            <nav class="nav-h d-none d-lg-block" aria-label="Menu principal">
                <ul>
                    <?php foreach ($menu_items as $item) : ?>
                        <li>
                            <a
                                href="<?php echo esc_url($item['url']); ?>"
                                <?php echo site_is_current_menu_item($item['url']) ? 'class="ativo" aria-current="page"' : ''; ?>
                            ><?php echo esc_html($item['label']); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </nav>

            <div class="acoes-h">
                <a
                    href="<?php echo esc_url(site_whatsapp_link()); ?>"
                    target="_blank"
                    rel="noopener"
                    class="botao botao-destaque botao-p botao-h"
                >
                    <?php echo site_icone('whatsapp'); ?>
                    <span>Vamos conversar</span>
                </a>

                <a
                    href="<?php echo esc_url(site_whatsapp_link()); ?>"
                    target="_blank"
                    rel="noopener"
                    class="icone-h d-lg-none"
                    aria-label="Falar com João pelo WhatsApp"
                >
                    <?php echo site_icone('whatsapp'); ?>
                </a>

                <button
                    class="menu-toggle d-lg-none"
                    type="button"
                    aria-controls="menu-mobile"
                    aria-expanded="false"
                    aria-label="Abrir menu"
                >
                    <span></span>
                    <span></span>
                </button>
            </div>
        </div>
    </div>
</header>

<div class="menu-mobile" id="menu-mobile" data-lenis-prevent hidden>
    <nav aria-label="Menu mobile">
        <ul>
            <?php foreach ($menu_items as $i => $item) : ?>
                <li>
                    <a
                        href="<?php echo esc_url($item['url']); ?>"
                        <?php echo site_is_current_menu_item($item['url']) ? 'aria-current="page"' : ''; ?>
                    >
                        <span class="rotulo"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
                        <?php echo esc_html($item['label']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </nav>

    <div class="menu-mobile-rodape">
        <a
            href="<?php echo esc_url(site_whatsapp_link()); ?>"
            target="_blank"
            rel="noopener"
            class="botao botao-destaque"
        >
            <?php echo site_icone('whatsapp'); ?>
            <span>Falar no WhatsApp</span>
        </a>
        <a href="mailto:<?php echo esc_attr($site_data['email']); ?>" class="menu-mobile-email">
            <?php echo esc_html($site_data['email']); ?>
        </a>
    </div>
</div>

<main id="conteudo" tabindex="-1">
