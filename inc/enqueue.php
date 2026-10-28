<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * CSS e JS do tema. Tudo é servido do próprio tema (fontes em assets/fonts, bibliotecas em assets/vendor):
 * sem conexões extras com Google Fonts ou CDN, o que acelera o primeiro carregamento no celular.
 *
 * @return void
 */
function site_enqueue_assets(): void
{
    $theme_version = wp_get_theme()->get('Version');
    $adiado        = [
        'in_footer' => true,
        'strategy'  => 'defer',
    ];

    // Títulos: Bricolage Grotesque · destaques: Instrument Serif itálico · texto: Geist · rótulos: Geist Mono (@font-face no main.css)
    wp_enqueue_style(
        'site-main',
        get_theme_file_uri('/assets/css/main.css'),
        [],
        $theme_version
    );

    wp_enqueue_script(
        'site-navigation',
        get_theme_file_uri('/assets/js/navigation.js'),
        [],
        $theme_version,
        $adiado
    );

    wp_enqueue_script(
        'gsap',
        get_theme_file_uri('/assets/vendor/gsap.min.js'),
        [],
        '3.12.5',
        $adiado
    );

    wp_enqueue_script(
        'gsap-scrolltrigger',
        get_theme_file_uri('/assets/vendor/ScrollTrigger.min.js'),
        ['gsap'],
        '3.12.5',
        $adiado
    );

    wp_enqueue_script(
        'lenis',
        get_theme_file_uri('/assets/vendor/lenis.min.js'),
        [],
        '1.3.26',
        $adiado
    );

    wp_enqueue_script(
        'site-animations',
        get_theme_file_uri('/assets/js/animations.js'),
        ['gsap', 'gsap-scrolltrigger', 'lenis'],
        $theme_version,
        $adiado
    );

    if (is_page('contato')) {
        wp_enqueue_script(
            'site-contato',
            get_theme_file_uri('/assets/js/contato.js'),
            [],
            $theme_version,
            $adiado
        );

        wp_localize_script(
            'site-contato',
            'siteContato',
            [
                'whatsapp' => site_get_site_data()['whatsapp'],
            ]
        );
    }
}

add_action('wp_enqueue_scripts', 'site_enqueue_assets');

/**
 * Pré-carrega as fontes usadas no topo da página (título e texto), para o texto aparecer já com a fonte certa.
 *
 * @return void
 */
function site_preload_fontes(): void
{
    foreach (['bricolage-grotesque', 'instrument-serif-italic', 'geist'] as $fonte) {
        printf(
            '<link rel="preload" href="%s" as="font" type="font/woff2" crossorigin>' . "\n",
            esc_url(get_theme_file_uri('/assets/fonts/' . $fonte . '.woff2'))
        );
    }
}

add_action('wp_head', 'site_preload_fontes', 2);
