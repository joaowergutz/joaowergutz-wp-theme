<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * CPT Projetos (portfólio).
 *
 * A listagem fica na página "Projetos" (page-projetos.php), por isso o CPT não tem archive.
 * O single usa o mesmo prefixo de URL: /projetos/nome-do-projeto/
 *
 * @return void
 */
function site_register_post_types(): void
{
    register_post_type(
        'projeto',
        [
            'labels'        => [
                'name'               => 'Projetos',
                'singular_name'      => 'Projeto',
                'add_new'            => 'Adicionar projeto',
                'add_new_item'       => 'Adicionar novo projeto',
                'edit_item'          => 'Editar projeto',
                'new_item'           => 'Novo projeto',
                'view_item'          => 'Ver projeto',
                'search_items'       => 'Buscar projetos',
                'not_found'          => 'Nenhum projeto encontrado',
                'not_found_in_trash' => 'Nenhum projeto na lixeira',
                'all_items'          => 'Todos os projetos',
                'menu_name'          => 'Projetos',
            ],
            'public'        => true,
            'has_archive'   => false,
            'menu_icon'     => 'dashicons-portfolio',
            'menu_position' => 20,
            'show_in_rest'  => true,
            'supports'      => ['title', 'editor', 'excerpt', 'thumbnail', 'page-attributes'],
            'rewrite'       => [
                'slug'       => 'projetos',
                'with_front' => false,
            ],
        ]
    );
}

add_action('init', 'site_register_post_types');

/**
 * Detalhes de cada projeto (estudo de caso), pelo slug do post. Se o slug for alterado no painel, atualize aqui.
 * Imagens ficam em assets/img/projetos (prints em WebP: desktop 1440x900, celular 600px de largura).
 *
 * @return array<string, array>
 */
function site_get_projetos_dados(): array
{
    return [
        'desentupidora-dluz' => [
            'cliente'     => "Desentupidora D'Luz",
            'segmento'    => 'Saneamento e serviços',
            'local'       => 'Lajeado/RS',
            'ano'         => '2026',
            'url'         => 'https://desentupidoradaluz.com.br/',
            'entregas'    => ['Site institucional', 'Aparecer no Google', 'Site rápido', 'Contato pelo WhatsApp'],
            'tecnologias' => ['WordPress', 'PHP', 'GSAP', 'Schema.org'],
            'capa'        => 'dluz-home-desktop.webp',
            'capa_card'   => 'dluz-home-desktop-card.webp',
            'capa_mobile' => 'dluz-home-mobile.webp',
            'pagina'      => 'dluz-home-full.webp',
            'desafio'     => 'Com mais de 30 anos de mercado no Vale do Taquari, a D\'Luz precisava de uma presença online à altura da sua estrutura: um site que aparecesse nas buscas da região e que, no celular e muitas vezes no meio de uma emergência, mostrasse os serviços, a área de atendimento e um jeito rápido de chamar a equipe.',
            'solucao'     => 'Desenvolvi um site institucional sob medida com a identidade amarela e preta da marca, uma página para cada um dos 8 serviços e os botões de WhatsApp e ligação sempre à mão. Por trás, deixei tudo preparado para a empresa aparecer nas buscas da região e o site leve o bastante para abrir rápido mesmo no 4G.',
            'resultados'  => [
                ['valor' => '8', 'texto' => 'páginas de serviço preparadas para buscas locais'],
                ['valor' => '1 clique', 'texto' => 'para chamar no WhatsApp ou ligar, em qualquer página'],
                ['valor' => '100%', 'texto' => 'adaptado ao celular, onde acontece a maioria das buscas de emergência'],
            ],
            'galeria'     => [
                ['arquivo' => 'dluz-servicos-desktop.webp', 'tipo' => 'desktop', 'legenda' => 'Página de serviços'],
                ['arquivo' => 'dluz-servico-mobile.webp', 'tipo' => 'mobile', 'legenda' => 'Serviço aberto no celular'],
                ['arquivo' => 'dluz-sobre-desktop.webp', 'tipo' => 'desktop', 'legenda' => 'Página sobre a empresa'],
                ['arquivo' => 'dluz-contato-mobile.webp', 'tipo' => 'mobile', 'legenda' => 'Contato no celular'],
            ],
        ],
    ];
}

/**
 * Detalhes de um projeto, com valores vazios quando ele ainda não foi cadastrado em site_get_projetos_dados().
 *
 * @param int|null $post_id
 * @return array
 */
function site_get_projeto(?int $post_id = null): array
{
    $post_id = $post_id ?: get_the_ID();
    $dados   = site_get_projetos_dados()[get_post_field('post_name', $post_id)] ?? [];

    return array_merge(
        [
            'cliente'     => html_entity_decode(get_the_title($post_id), ENT_QUOTES, 'UTF-8'),
            'segmento'    => '',
            'local'       => '',
            'ano'         => '',
            'url'         => '',
            'entregas'    => [],
            'tecnologias' => [],
            'capa'        => '',
            'capa_card'   => '',
            'capa_mobile' => '',
            'pagina'      => '',
            'desafio'     => '',
            'solucao'     => '',
            'resultados'  => [],
            'galeria'     => [],
        ],
        $dados
    );
}

/**
 * Link de uma imagem em assets/img/projetos.
 *
 * @param string $arquivo
 * @return string
 */
function site_projeto_img(string $arquivo): string
{
    return $arquivo ? get_theme_file_uri('/assets/img/projetos/' . $arquivo) : '';
}

/**
 * srcset de uma imagem de projeto com todas as versões menores que existirem em disco
 * (nome-300.webp, nome-480.webp, nome-720.webp, nome-card.webp...), para o celular baixar só o tamanho que precisa.
 *
 * @param string $arquivo Nome da imagem original em assets/img/projetos
 * @return string srcset pronto ou vazio
 */
function site_projeto_srcset(string $arquivo): string
{
    static $cache = [];

    if (!$arquivo) {
        return '';
    }

    if (isset($cache[$arquivo])) {
        return $cache[$arquivo];
    }

    $pasta    = get_theme_file_path('/assets/img/projetos/');
    $base     = pathinfo($arquivo, PATHINFO_FILENAME);
    $arquivos = array_merge([$pasta . $arquivo], glob($pasta . $base . '-*.webp') ?: []);
    $versoes  = [];

    foreach ($arquivos as $caminho) {
        $medidas = @getimagesize($caminho);

        if ($medidas) {
            $versoes[$medidas[0]] = site_projeto_img(basename($caminho)) . ' ' . $medidas[0] . 'w';
        }
    }

    ksort($versoes);

    return $cache[$arquivo] = implode(', ', $versoes);
}

/**
 * Capa do projeto. A "Imagem destacada" do painel tem prioridade sobre a capa do tema.
 *
 * @param int|null $post_id
 * @param bool     $card true = versão menor (800px) para os cards
 * @return string Link da imagem ou vazio
 */
function site_get_projeto_capa(?int $post_id = null, bool $card = false): string
{
    $post_id = $post_id ?: get_the_ID();
    $imagem  = (string) get_the_post_thumbnail_url($post_id, $card ? 'medium_large' : 'large');

    if ($imagem) {
        return $imagem;
    }

    $projeto = site_get_projeto($post_id);

    return site_projeto_img($card && $projeto['capa_card'] ? $projeto['capa_card'] : $projeto['capa']);
}

/**
 * Projetos publicados, na ordem do painel (campo "Ordem").
 *
 * @param int $quantidade -1 para todos
 * @param int $exceto     ID de um projeto que não deve aparecer
 * @return WP_Query
 */
function site_get_projetos(int $quantidade = -1, int $exceto = 0): WP_Query
{
    return new WP_Query(
        [
            'post_type'      => 'projeto',
            'posts_per_page' => $quantidade,
            'post__not_in'   => $exceto ? [$exceto] : [],
            'orderby'        => ['menu_order' => 'ASC', 'date' => 'DESC'],
            'no_found_rows'  => true,
        ]
    );
}
