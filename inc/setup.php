<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Suportes básicos do tema.
 *
 * @return void
 */
function site_setup(): void
{
    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('responsive-embeds');

    add_theme_support(
        'html5',
        [
            'gallery',
            'caption',
            'style',
            'script',
        ]
    );
}

add_action('after_setup_theme', 'site_setup');

/**
 * Ícone da aba (favicon). Se um "Ícone do site" for definido em Aparência > Personalizar, ele tem prioridade.
 *
 * @return void
 */
function site_favicon(): void
{
    if (has_site_icon()) {
        return;
    }
    ?>
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url(get_theme_file_uri('/assets/img/favicon-32.png')); ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?php echo esc_url(get_theme_file_uri('/assets/img/favicon-192.png')); ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url(get_theme_file_uri('/assets/img/apple-touch-icon.png')); ?>">
    <?php
}

add_action('wp_head', 'site_favicon', 2);
