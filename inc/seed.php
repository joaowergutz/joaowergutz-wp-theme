<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Conteúdo inicial criado ao ativar o tema (roda uma única vez):
 * páginas, projetos, página inicial estática e links permanentes.
 *
 * @return void
 */
function site_seed_content(): void
{
    if (get_option('site_seed_done')) {
        return;
    }

    $paginas = [
        'inicio'   => 'Início',
        'projetos' => 'Projetos',
        'servicos' => 'Serviços',
        'sobre'    => 'Sobre',
        'contato'  => 'Contato',

        'politica-de-privacidade' => 'Política de privacidade',
    ];

    $ids = [];

    foreach ($paginas as $slug => $titulo) {
        $pagina = get_page_by_path($slug);

        // A instalação do WP já cria a política como rascunho: publica a existente
        if ($pagina && 'publish' !== $pagina->post_status) {
            wp_update_post(['ID' => $pagina->ID, 'post_status' => 'publish']);
        }

        $ids[$slug] = $pagina ? $pagina->ID : wp_insert_post(
            [
                'post_type'   => 'page',
                'post_title'  => $titulo,
                'post_name'   => $slug,
                'post_status' => 'publish',
            ]
        );
    }

    update_option('show_on_front', 'page');
    update_option('page_on_front', $ids['inicio']);
    update_option('wp_page_for_privacy_policy', $ids['politica-de-privacidade']);
    update_option('blogname', 'João Wergutz');
    update_option('blogdescription', 'Desenvolvedor de sites');
    update_option('default_comment_status', 'closed');
    update_option('default_ping_status', 'closed');

    // Conteúdo de exemplo da instalação do WP vai para a lixeira
    foreach (['ola-mundo' => 'post', 'pagina-exemplo' => 'page', 'sample-page' => 'page', 'hello-world' => 'post'] as $exemplo => $tipo) {
        $post = get_page_by_path($exemplo, OBJECT, $tipo);

        if ($post) {
            wp_trash_post($post->ID);
        }
    }

    site_register_post_types();

    $existentes = get_posts(
        [
            'post_type'      => 'projeto',
            'posts_per_page' => 1,
            'post_status'    => 'any',
            'fields'         => 'ids',
        ]
    );

    if (!$existentes) {
        foreach (site_get_projetos_iniciais() as $ordem => $projeto) {
            wp_insert_post(
                [
                    'post_type'    => 'projeto',
                    'post_title'   => $projeto['titulo'],
                    'post_name'    => $projeto['slug'],
                    'post_excerpt' => $projeto['resumo'],
                    'post_status'  => 'publish',
                    'menu_order'   => $ordem,
                ]
            );
        }
    }

    // Aplica a estrutura no objeto em memória; o flush acontece em site_flush_rewrites (logo depois)
    global $wp_rewrite;
    $wp_rewrite->set_permalink_structure('/%postname%/');

    update_option('site_seed_done', 1);
}

add_action('after_switch_theme', 'site_seed_content');

/**
 * Garante as regras de URL do CPT ao trocar de tema.
 *
 * @return void
 */
function site_flush_rewrites(): void
{
    site_register_post_types();
    flush_rewrite_rules();
}

add_action('after_switch_theme', 'site_flush_rewrites', 20);

/**
 * Projetos cadastrados na ativação. Os detalhes do estudo de caso ficam em site_get_projetos_dados() (inc/post-types.php).
 *
 * @return array
 */
function site_get_projetos_iniciais(): array
{
    return [
        [
            'titulo' => "Desentupidora D'Luz",
            'slug'   => 'desentupidora-dluz',
            'resumo' => 'Site institucional para uma desentupidora com mais de 30 anos em Lajeado/RS: uma página para cada serviço, pronto para aparecer no Google da região e contato pelo WhatsApp em um clique.',
        ],
    ];
}
