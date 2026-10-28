<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * SEO de cada página: título, descrição (até ~155 caracteres) e imagem de compartilhamento.
 * A chave é o slug da página. Projetos usam o próprio título, o resumo e a capa.
 *
 * @return array
 */
function site_get_seo_paginas(): array
{
    $imagem_padrao = get_theme_file_uri('/assets/img/og-joao-wergutz.jpg');

    return [
        'inicio'    => [
            'titulo'    => 'João Wergutz | Criação de sites no Vale do Taquari',
            'descricao' => 'Criação de sites, lojas virtuais e landing pages em Santa Clara do Sul e no Vale do Taquari. Rápidos, bonitos e prontos para o Google.',
            'imagem'    => $imagem_padrao,
        ],
        'projetos'  => [
            'titulo'    => 'Projetos e estudos de caso',
            'descricao' => 'Veja sites desenvolvidos por João Wergutz para pequenas e médias empresas: o desafio de cada cliente, a solução e o resultado.',
            'imagem'    => $imagem_padrao,
        ],
        'servicos'  => [
            'titulo'    => 'Serviços: sites, lojas virtuais e SEO',
            'descricao' => 'Criação de sites institucionais, lojas virtuais, landing pages e blogs, além de SEO, otimização de performance e manutenção de sites WordPress.',
            'imagem'    => $imagem_padrao,
        ],
        'sobre'     => [
            'titulo'    => 'Sobre mim',
            'descricao' => 'Conheça João Pedro Wergutz, desenvolvedor frontend com mais de 4 anos de experiência em JavaScript, PHP e WordPress, focado em performance, UX e SEO.',
            'imagem'    => $imagem_padrao,
        ],
        'contato'   => [
            'titulo'    => 'Contato e orçamento',
            'descricao' => 'Peça um orçamento de site sem compromisso. Fale com João Wergutz pelo WhatsApp (51) 98936-5169 ou pelo e-mail joaowergutz06@gmail.com.',
            'imagem'    => $imagem_padrao,
        ],
        'politica-de-privacidade' => [
            'titulo'    => 'Política de privacidade',
            'descricao' => 'Como este site trata os dados de quem visita e entra em contato, de acordo com a LGPD.',
            'imagem'    => $imagem_padrao,
        ],
    ];
}

/**
 * Dados de SEO da página atual.
 *
 * @return array{titulo: string, descricao: string, imagem: string}
 */
function site_get_seo_atual(): array
{
    static $seo = null;

    if (null !== $seo) {
        return $seo;
    }

    $paginas = site_get_seo_paginas();
    $seo     = [
        'titulo'    => '',
        'descricao' => $paginas['inicio']['descricao'],
        'imagem'    => $paginas['inicio']['imagem'],
    ];

    if (is_front_page()) {
        $seo = $paginas['inicio'];
    } elseif (is_page() && isset($paginas[get_post_field('post_name', get_queried_object_id())])) {
        $seo = $paginas[get_post_field('post_name', get_queried_object_id())];
    } elseif (is_singular('projeto')) {
        $id      = get_queried_object_id();
        $projeto = site_get_projeto($id);
        $resumo  = wp_strip_all_tags(get_the_excerpt($id));

        $seo['titulo']    = 'Site ' . $projeto['cliente'] . ' · Estudo de caso';
        $seo['descricao'] = wp_html_excerpt($resumo ?: $projeto['desafio'], 155, '…');
        $seo['imagem']    = site_get_projeto_capa($id) ?: $seo['imagem'];
    } elseif (is_singular()) {
        // Outras páginas criadas no painel: descrição a partir do próprio texto
        $id    = get_queried_object_id();
        $texto = wp_strip_all_tags(strip_shortcodes(get_post_field('post_content', $id)));

        $seo['titulo'] = html_entity_decode(get_the_title($id), ENT_QUOTES, 'UTF-8');

        if ($texto) {
            $seo['descricao'] = wp_html_excerpt($texto, 155, '…');
        }
    }

    return $seo;
}

/**
 * Título da aba / Google: "Página | João Wergutz".
 *
 * @param array $partes
 * @return array
 */
function site_document_title_parts(array $partes): array
{
    $seo = site_get_seo_atual();

    if (is_front_page()) {
        return ['title' => $seo['titulo']];
    }

    if ($seo['titulo']) {
        $partes['title'] = $seo['titulo'];
    }

    $partes['site'] = site_get_site_data()['nome'];
    unset($partes['tagline']);

    return $partes;
}

add_filter('document_title_parts', 'site_document_title_parts');
add_filter('document_title_separator', fn() => '|');

/**
 * Meta description, Open Graph (WhatsApp, LinkedIn, Facebook) e Twitter.
 *
 * @return void
 */
function site_meta_tags(): void
{
    if (is_404()) {
        return;
    }

    $seo    = site_get_seo_atual();
    $url    = is_front_page() ? home_url('/') : (wp_get_canonical_url() ?: home_url('/'));
    $nome   = site_get_site_data()['nome'];
    $titulo = wp_get_document_title();
    ?>
    <meta name="description" content="<?php echo esc_attr($seo['descricao']); ?>">
    <meta name="author" content="<?php echo esc_attr(site_get_site_data()['nome_completo']); ?>">
    <meta name="theme-color" content="#0c0c0e">
    <meta property="og:locale" content="pt_BR">
    <meta property="og:type" content="<?php echo is_singular('projeto') ? 'article' : 'website'; ?>">
    <meta property="og:site_name" content="<?php echo esc_attr($nome); ?>">
    <meta property="og:title" content="<?php echo esc_attr($titulo); ?>">
    <meta property="og:description" content="<?php echo esc_attr($seo['descricao']); ?>">
    <meta property="og:url" content="<?php echo esc_url($url); ?>">
    <meta property="og:image" content="<?php echo esc_url($seo['imagem']); ?>">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="<?php echo esc_attr($titulo); ?>">
    <meta name="twitter:description" content="<?php echo esc_attr($seo['descricao']); ?>">
    <meta name="twitter:image" content="<?php echo esc_url($seo['imagem']); ?>">
    <?php
}

add_action('wp_head', 'site_meta_tags', 1);

/**
 * Pessoa (João) para os dados estruturados, com os serviços que oferece.
 *
 * @param bool $completo false = só a referência (@id), para usar dentro de outros schemas
 * @return array
 */
function site_schema_pessoa(bool $completo = true): array
{
    $dados  = site_get_site_data();
    $pessoa = ['@type' => 'Person', '@id' => home_url('/#joao')];

    if (!$completo) {
        return $pessoa;
    }

    return array_merge(
        $pessoa,
        [
            'name'        => $dados['nome_completo'],
            'alternateName' => $dados['nome'],
            'jobTitle'    => $dados['cargo'],
            'description' => site_get_seo_paginas()['inicio']['descricao'],
            'url'         => home_url('/'),
            'image'       => site_img($dados['foto']),
            'email'       => 'mailto:' . $dados['email'],
            'telephone'   => '+' . $dados['whatsapp'],
            'address'     => [
                '@type'          => 'PostalAddress',
                'addressLocality' => 'Santa Clara do Sul',
                'addressRegion'  => 'RS',
                'addressCountry' => 'BR',
            ],
            'sameAs'      => [$dados['linkedin'], $dados['github']],
            'knowsAbout'  => ['Desenvolvimento frontend', 'JavaScript', 'PHP', 'WordPress', 'HTML', 'CSS', 'SEO', 'Performance web', 'UX', 'Lojas virtuais', 'Landing pages'],
            'makesOffer'  => array_map(
                fn($servico) => [
                    '@type'       => 'Offer',
                    'itemOffered' => [
                        '@type'       => 'Service',
                        'name'        => $servico['titulo'] . (isset($servico['termo']) ? ' (' . $servico['termo'] . ')' : ''),
                        'description' => $servico['resumo'],
                        'url'         => home_url('/servicos/#' . $servico['id']),
                        'areaServed'  => 'BR',
                    ],
                ],
                site_get_servicos()
            ),
        ]
    );
}

/**
 * Dados estruturados (schema.org): site + pessoa na home, perfil no Sobre, serviços, estudo de caso
 * nos projetos, FAQ na home e breadcrumb nas internas.
 *
 * @return void
 */
function site_schema(): void
{
    if (is_404()) {
        return;
    }

    $schemas = [];
    $id      = get_queried_object_id();

    if (is_front_page()) {
        $schemas[] = [
            '@context'    => 'https://schema.org',
            '@type'       => 'WebSite',
            '@id'         => home_url('/#site'),
            'name'        => site_get_site_data()['nome'],
            'url'         => home_url('/'),
            'inLanguage'  => 'pt-BR',
            'publisher'   => site_schema_pessoa(false),
        ];

        $schemas[] = array_merge(['@context' => 'https://schema.org'], site_schema_pessoa());

        $schemas[] = [
            '@context'   => 'https://schema.org',
            '@type'      => 'FAQPage',
            'mainEntity' => array_map(
                fn($item) => [
                    '@type'          => 'Question',
                    'name'           => $item['pergunta'],
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text'  => $item['resposta'],
                    ],
                ],
                site_get_faq()
            ),
        ];
    }

    if (is_page('sobre')) {
        $schemas[] = [
            '@context'   => 'https://schema.org',
            '@type'      => 'ProfilePage',
            'url'        => get_permalink($id),
            'mainEntity' => site_schema_pessoa(),
        ];
    }

    if (is_page('contato')) {
        $schemas[] = [
            '@context'   => 'https://schema.org',
            '@type'      => 'ContactPage',
            'url'        => get_permalink($id),
            'mainEntity' => site_schema_pessoa(),
        ];
    }

    if (is_page('servicos')) {
        $schemas[] = [
            '@context'        => 'https://schema.org',
            '@type'           => 'ItemList',
            'name'            => 'Serviços',
            'itemListElement' => array_map(
                fn($servico, $i) => [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'item'     => [
                        '@type'       => 'Service',
                        'name'        => $servico['titulo'] . (isset($servico['termo']) ? ' (' . $servico['termo'] . ')' : ''),
                        'description' => $servico['texto'],
                        'url'         => home_url('/servicos/#' . $servico['id']),
                        'areaServed'  => 'BR',
                        'provider'    => site_schema_pessoa(false),
                    ],
                ],
                site_get_servicos(),
                array_keys(site_get_servicos())
            ),
        ];
    }

    if (is_singular('projeto')) {
        $projeto = site_get_projeto($id);
        $caso    = [
            '@context'    => 'https://schema.org',
            '@type'       => 'CreativeWork',
            'name'        => html_entity_decode(get_the_title($id), ENT_QUOTES, 'UTF-8'),
            'description' => site_get_seo_atual()['descricao'],
            'url'         => get_permalink($id),
            'image'       => site_get_projeto_capa($id),
            'creator'     => site_schema_pessoa(false),
            'inLanguage'  => 'pt-BR',
            'about'       => array_filter(
                [
                    '@type' => 'Organization',
                    'name'  => $projeto['cliente'],
                    'url'   => $projeto['url'],
                ]
            ),
            'keywords'    => implode(', ', array_merge($projeto['entregas'], $projeto['tecnologias'])),
        ];

        if ($projeto['ano']) {
            $caso['dateCreated'] = $projeto['ano'];
        }

        $schemas[] = array_filter($caso);
    }

    if (!is_front_page() && (is_page() || is_singular('projeto'))) {
        $itens = [
            ['Início', home_url('/')],
        ];

        if (is_singular('projeto')) {
            $itens[] = ['Projetos', home_url('/projetos/')];
        }

        $itens[] = [html_entity_decode(get_the_title($id), ENT_QUOTES, 'UTF-8'), get_permalink($id)];

        $schemas[] = [
            '@context'        => 'https://schema.org',
            '@type'           => 'BreadcrumbList',
            'itemListElement' => array_map(
                fn($item, $i) => [
                    '@type'    => 'ListItem',
                    'position' => $i + 1,
                    'name'     => $item[0],
                    'item'     => $item[1],
                ],
                $itens,
                array_keys($itens)
            ),
        ];
    }

    foreach ($schemas as $schema) {
        echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_HEX_TAG) . '</script>' . "\n";
    }
}

add_action('wp_head', 'site_schema', 5);

/**
 * Sitemap (/wp-sitemap.xml) só com o que interessa: páginas e projetos.
 */
add_filter(
    'wp_sitemaps_post_types',
    function (array $tipos): array {
        unset($tipos['post']);

        return $tipos;
    }
);

add_filter(
    'wp_sitemaps_taxonomies',
    function (array $taxonomias): array {
        unset($taxonomias['category'], $taxonomias['post_tag']);

        return $taxonomias;
    }
);

add_filter(
    'wp_sitemaps_add_provider',
    fn($provider, string $nome) => 'users' === $nome ? false : $provider,
    10,
    2
);

/**
 * Páginas de autor não fazem sentido aqui (e expõem o usuário do painel).
 *
 * @return void
 */
function site_redirecionar_autor(): void
{
    if (is_author()) {
        wp_safe_redirect(home_url('/'), 301);
        exit;
    }
}

// Prioridade 1: roda antes do redirect_canonical do WP, que mandaria ?author=1 para /author/usuario/
add_action('template_redirect', 'site_redirecionar_autor', 1);

remove_action('wp_head', 'wp_generator');
