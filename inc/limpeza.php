<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Site institucional sem blog: desliga comentários, feeds, XML-RPC, emojis
 * e a lista pública de usuários da API REST.
 */

/* Comentários: fechados em tudo e fora do painel */
add_filter('comments_open', '__return_false', 20);
add_filter('pings_open', '__return_false', 20);
add_filter('comments_array', '__return_empty_array', 10);

/**
 * Remove o suporte a comentários dos tipos de conteúdo.
 *
 * @return void
 */
function site_remover_comentarios(): void
{
    foreach (get_post_types() as $tipo) {
        if (post_type_supports($tipo, 'comments')) {
            remove_post_type_support($tipo, 'comments');
            remove_post_type_support($tipo, 'trackbacks');
        }
    }
}

add_action('init', 'site_remover_comentarios', 100);

add_action(
    'admin_menu',
    function (): void {
        remove_menu_page('edit-comments.php');
    }
);

add_action(
    'admin_bar_menu',
    function (WP_Admin_Bar $barra): void {
        $barra->remove_node('comments');
    },
    100
);

/* Feeds: sem links no <head> e redirecionados para a home */
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'feed_links_extra', 3);

/**
 * @return void
 */
function site_desligar_feed(): void
{
    wp_safe_redirect(home_url('/'), 301);
    exit;
}

foreach (['do_feed', 'do_feed_rdf', 'do_feed_rss', 'do_feed_rss2', 'do_feed_atom', 'do_feed_rss2_comments', 'do_feed_atom_comments'] as $acao) {
    add_action($acao, 'site_desligar_feed', 1);
}

/* XML-RPC (alvo comum de ataques de senha) */
add_filter('xmlrpc_enabled', '__return_false');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');

add_action(
    'init',
    function (): void {
        if (defined('XMLRPC_REQUEST') && XMLRPC_REQUEST) {
            status_header(403);
            exit;
        }
    },
    1
);

/* API REST: a lista de usuários só aparece para quem está logado */
add_filter(
    'rest_endpoints',
    function (array $rotas): array {
        if (!is_user_logged_in()) {
            unset($rotas['/wp/v2/users'], $rotas['/wp/v2/users/(?P<id>[\d]+)']);
        }

        return $rotas;
    }
);

/* Emojis do WordPress (script e CSS extras que o tema não usa) */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('emoji_svg_url', '__return_false');

/* oEmbed: sem links de descoberta e sem expor o usuário do painel */
remove_action('wp_head', 'wp_oembed_add_discovery_links');
remove_action('wp_head', 'wp_oembed_add_host_js');
add_filter(
    'oembed_response_data',
    function (array $dados): array {
        unset($dados['author_name'], $dados['author_url']);

        return $dados;
    }
);

/* Link curto (?p=) no <head> */
remove_action('wp_head', 'wp_shortlink_wp_head');

/* CSS do editor de blocos (Gutenberg): o tema não usa blocos no front, então nada disso precisa carregar */
add_action(
    'wp_enqueue_scripts',
    function (): void {
        foreach (['wp-block-library', 'wp-block-library-theme', 'classic-theme-styles', 'global-styles'] as $estilo) {
            wp_dequeue_style($estilo);
        }
    },
    100
);

remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
add_filter('wp_img_tag_add_auto_sizes', '__return_false');

/* Links da API REST no <head> (a API continua funcionando, só não é anunciada em cada página) */
remove_action('wp_head', 'rest_output_link_wp_head');
