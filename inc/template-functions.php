<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Dados gerais do site (contato, redes, menu). Toda edição de conteúdo global é feita aqui.
 *
 * @return array
 */
function site_get_site_data(): array
{
    static $data = null;

    if (null !== $data) {
        return $data;
    }

    $data = [
        'nome'          => 'João Wergutz',
        'nome_completo' => 'João Pedro Wergutz',
        'cargo'         => 'Desenvolvedor Frontend',
        'anos_experiencia' => 4,
        'cidade'        => 'Santa Clara do Sul/RS',
        'regiao'        => 'Vale do Taquari',
        'foto'          => 'joao.webp',
        'celular'       => '(51) 98936-5169',
        'whatsapp'      => '5551989365169',
        'email'         => 'joaowergutz06@gmail.com',
        'linkedin'      => 'https://www.linkedin.com/in/jo%C3%A3o-pedro-wergutz-27a6013b9/',
        'github'        => 'https://github.com/joaowergutz',
        'github_user'   => '@joaowergutz',
        // ID do Google Analytics 4 (ex.: G-ABC123XYZ). Vazio = sem Analytics e sem aviso de cookies (inc/analytics.php)
        'ga4'           => '',
        'menu'          => [
            [
                'label' => 'Início',
                'url'   => home_url('/'),
            ],
            [
                'label' => 'Projetos',
                'url'   => home_url('/projetos/'),
            ],
            [
                'label' => 'Serviços',
                'url'   => home_url('/servicos/'),
            ],
            [
                'label' => 'Sobre',
                'url'   => home_url('/sobre/'),
            ],
            [
                'label' => 'Contato',
                'url'   => home_url('/contato/'),
            ],
        ],
    ];

    return $data;
}

/**
 * Serviços oferecidos. A ordem aqui é a ordem no site; o "id" vira a âncora em /servicos/#id.
 *
 * @return array<int, array{id: string, icone: string, titulo: string, resumo: string, texto: string, itens: string[]}>
 */
function site_get_servicos(): array
{
    return [
        [
            'id'     => 'sites-institucionais',
            'icone'  => 'building',
            'titulo' => 'Sites institucionais',
            'resumo' => 'A vitrine da sua empresa na internet: quem você é, o que faz e como falar com você.',
            'texto'  => 'Um site sob medida para apresentar sua empresa com a credibilidade que ela tem fora da internet. Páginas de serviços, sobre, contato e tudo o que o seu cliente precisa para decidir, com botões de WhatsApp em cada página.',
            'itens'  => ['Layout exclusivo, sem tema pronto', 'Adaptado para celular, tablet e computador', 'Painel para editar textos e imagens'],
        ],
        [
            'id'     => 'lojas-virtuais',
            'icone'  => 'cart3',
            'titulo' => 'Lojas virtuais',
            'resumo' => 'Venda pela internet com uma loja fácil de navegar e de administrar.',
            'texto'  => 'Loja virtual com catálogo, carrinho, frete e pagamento online, pronta para vender todos os dias. Você cadastra produtos e acompanha pedidos por um painel simples.',
            'itens'  => ['Pagamento por Pix, cartão e boleto', 'Cálculo de frete integrado', 'Páginas de produto pensadas para vender'],
        ],
        [
            'id'     => 'landing-pages',
            'icone'  => 'rocket-takeoff',
            'titulo' => 'Páginas para anúncios',
            'termo'  => 'Landing pages',
            'resumo' => 'Uma página com um único objetivo: transformar quem clicou no seu anúncio em contato.',
            'texto'  => 'Página feita para anúncios no Google, Instagram e Facebook, lançamentos e promoções. Texto direto, motivos para confiar em você e botões de contato no lugar certo, para cada real investido em anúncio render mais.',
            'itens'  => ['Feita para gerar contatos', 'Pronta para Google Ads e Meta Ads', 'Fica pronta em poucos dias'],
        ],
        [
            'id'     => 'blogs',
            'icone'  => 'journal-text',
            'titulo' => 'Blogs',
            'resumo' => 'Conteúdo que atrai visitas do Google e mostra que você entende do assunto.',
            'texto'  => 'Blog integrado ao seu site para publicar artigos, novidades e dicas. Cada post bem estruturado é mais uma porta de entrada para novos clientes pelas buscas.',
            'itens'  => ['Categorias e busca', 'Posts preparados para o Google', 'Publicação simples pelo painel'],
        ],
        [
            'id'     => 'seo',
            'icone'  => 'graph-up-arrow',
            'titulo' => 'Aparecer no Google',
            'termo'  => 'SEO',
            'resumo' => 'Ajustes para sua empresa aparecer quando alguém procura no Google pelo que você faz.',
            'texto'  => 'Reviso o seu site por dentro e por fora para o Google entender o que você faz e onde atende, e mostrar a sua empresa para quem está procurando. Ideal para quem atende uma cidade ou região.',
            'itens'  => ['Análise do seu site atual', 'Ajustes para buscas da sua região', 'Relatório simples do que foi feito'],
        ],
        [
            'id'     => 'performance',
            'icone'  => 'speedometer2',
            'titulo' => 'Site mais rápido',
            'termo'  => 'Performance',
            'resumo' => 'Site lento perde cliente. Deixo o seu mais leve e rápido, principalmente no celular.',
            'texto'  => 'Quem espera o site carregar desiste e vai para o concorrente. Deixo imagens e código mais leves para o seu site abrir rápido, o que agrada o visitante e também o Google.',
            'itens'  => ['Imagens mais leves, sem perder qualidade', 'Carregamento rápido no celular e no 4G', 'Antes e depois medidos na ferramenta do Google'],
        ],
        [
            'id'     => 'manutencao',
            'icone'  => 'wrench-adjustable',
            'titulo' => 'Manutenção de sites',
            'resumo' => 'Seu site atualizado, seguro e funcionando, sem você precisar se preocupar.',
            'texto'  => 'Atualizações de segurança, cópias de segurança (backups), correção de erros, ajustes de visual e troca de textos e fotos. Um suporte de confiança para quando você precisar.',
            'itens'  => ['Atualizações e backups', 'Correções e pequenos ajustes', 'Atendimento direto pelo WhatsApp'],
        ],
    ];
}

/**
 * Etapas de como um projeto acontece.
 *
 * @return array<int, array{titulo: string, texto: string}>
 */
function site_get_processo(): array
{
    return [
        [
            'titulo' => 'Conversa',
            'texto'  => 'Entendo o seu negócio, seus clientes e o que o site precisa resolver.',
        ],
        [
            'titulo' => 'Planejamento',
            'texto'  => 'Defino as páginas, os conteúdos e o caminho que o visitante vai fazer até falar com você.',
        ],
        [
            'titulo' => 'Design',
            'texto'  => 'Crio o visual com a cara da sua marca e você aprova antes de qualquer linha de código.',
        ],
        [
            'titulo' => 'Desenvolvimento',
            'texto'  => 'Programo o site rápido, adaptado ao celular e preparado para o Google.',
        ],
        [
            'titulo' => 'Lançamento',
            'texto'  => 'Coloco no ar, te mostro como editar e sigo por perto para o que precisar.',
        ],
    ];
}

/**
 * O que vem incluso em todo site (seção "O que você recebe").
 *
 * @return array<int, array{icone: string, titulo: string, texto: string}>
 */
function site_get_incluso(): array
{
    return [
        [
            'icone'  => 'palette',
            'titulo' => 'Visual exclusivo',
            'texto'  => 'Criado para a sua marca e aprovado por você antes de eu começar a programar.',
        ],
        [
            'icone'  => 'phone',
            'titulo' => 'Funciona em qualquer tela',
            'texto'  => 'Celular, tablet ou computador: o site se adapta e fica fácil de usar em todos.',
        ],
        [
            'icone'  => 'search',
            'titulo' => 'Pronto para o Google',
            'texto'  => 'Preparado para o Google entender o que você faz e mostrar sua empresa nas buscas.',
        ],
        [
            'icone'  => 'whatsapp',
            'titulo' => 'Contato em um clique',
            'texto'  => 'Botões de WhatsApp, telefone e e-mail em todas as páginas, sem o cliente procurar.',
        ],
        [
            'icone'  => 'speedometer2',
            'titulo' => 'Rápido de verdade',
            'texto'  => 'Imagens e código leves para abrir rápido, até no 4G.',
        ],
        [
            'icone'  => 'globe2',
            'titulo' => 'Domínio, hospedagem e e-mail',
            'texto'  => 'Te ajudo a contratar e deixo tudo configurado, com o cadeado de segurança.',
        ],
        [
            'icone'  => 'pencil-square',
            'titulo' => 'Você consegue editar',
            'texto'  => 'Na entrega, te mostro como trocar textos e fotos sem depender de ninguém.',
        ],
        [
            'icone'  => 'shield-check',
            'titulo' => 'Suporte depois da entrega',
            'texto'  => 'Dúvidas e ajustes direto comigo pelo WhatsApp. Você não fica sozinho.',
        ],
    ];
}

/**
 * Diferenciais (seção escura da home).
 *
 * @return array<int, array{titulo: string, texto: string}>
 */
function site_get_diferenciais(): array
{
    return [
        [
            'titulo' => 'Você fala direto com quem desenvolve',
            'texto'  => 'Sem intermediários nem atendimento que passa o recado adiante. Suas ideias chegam inteiras ao site.',
        ],
        [
            'titulo' => 'Sob medida, sem tema pronto',
            'texto'  => 'Cada site é desenhado e programado para a sua empresa, com código limpo e sem plugins desnecessários.',
        ],
        [
            'titulo' => 'Rápido e preparado para o Google',
            'texto'  => 'Deixar o site pronto para aparecer no Google e abrir rápido no celular faz parte de todo projeto, não é um extra.',
        ],
        [
            'titulo' => 'Suporte depois da entrega',
            'texto'  => 'O site no ar é só o começo. Continuo disponível para ajustes, dúvidas e novas ideias.',
        ],
    ];
}

/**
 * Dores de quem precisa de um site (seção "Se alguma dessas frases..." da home).
 *
 * @return string[]
 */
function site_get_dores(): array
{
    return [
        'Ninguém encontra minha empresa no Google.',
        'Meu site é antigo e não passa confiança.',
        'No celular, meu site fica todo desconfigurado.',
        'Dependo só do Instagram para conseguir clientes.',
        'Recebo visitas, mas quase ninguém entra em contato.',
        'Toda vez que preciso mudar algo, não sei a quem pedir.',
    ];
}

/**
 * Depoimentos de clientes. Enquanto a lista estiver vazia, a seção não aparece.
 * Exemplo: ['texto' => '...', 'nome' => 'Nome', 'cargo' => 'Cargo, Empresa', 'projeto' => 'slug-do-projeto'],
 *
 * @return array<int, array{texto: string, nome: string, cargo: string}>
 */
function site_get_depoimentos(): array
{
    return [];
}

/**
 * Perguntas frequentes (aparecem na home e viram dados estruturados FAQPage).
 *
 * @return array<int, array{pergunta: string, resposta: string}>
 */
function site_get_faq(): array
{
    return [
        [
            'pergunta' => 'Quanto custa um site?',
            'resposta' => 'Depende do tipo de site, da quantidade de páginas e das funcionalidades. Me conta o que você precisa pelo WhatsApp ou pelo formulário e eu te envio uma proposta com valor e prazo, sem compromisso.',
        ],
        [
            'pergunta' => 'Quanto tempo leva para o site ficar pronto?',
            'resposta' => 'Uma landing page costuma ficar pronta em poucos dias. Um site institucional leva, em média, de 2 a 4 semanas, contando com a aprovação do layout e o envio dos textos e imagens.',
        ],
        [
            'pergunta' => 'Vou conseguir atualizar o site sozinho?',
            'resposta' => 'Sim. Os sites são feitos em WordPress e, na entrega, eu te mostro como trocar textos, imagens e publicar novidades. Se preferir, também posso cuidar disso para você.',
        ],
        [
            'pergunta' => 'Meu site vai aparecer no Google?',
            'resposta' => 'Todo site já sai preparado para o Google entender o que você faz e onde atende, e para abrir rápido. Isso prepara o terreno. A posição nas buscas também depende da concorrência e do conteúdo ao longo do tempo, e eu te oriento nisso.',
        ],
        [
            'pergunta' => 'Você cuida de domínio e hospedagem?',
            'resposta' => 'Te ajudo a registrar o domínio e escolher uma boa hospedagem, e faço toda a configuração para o site ir ao ar com o cadeado de segurança e os e-mails da empresa funcionando.',
        ],
        [
            'pergunta' => 'Você pode analisar o site que eu já tenho?',
            'resposta' => 'Posso, e sem custo. Me manda o endereço pelo WhatsApp que eu reviso a velocidade, como ele fica no celular e como aparece no Google, e te digo o que vale a pena melhorar.',
        ],
        [
            'pergunta' => 'Atende empresas de outras cidades?',
            'resposta' => 'Sim. Sou de Santa Clara do Sul, no Vale do Taquari, e atendo empresas da região e de qualquer lugar do Brasil: todo o processo pode ser feito a distância, por WhatsApp e chamadas de vídeo.',
        ],
    ];
}

/**
 * Aceita URL completa ou nome de arquivo dentro de assets/img.
 *
 * @param string $arquivo
 * @return string
 */
function site_img(string $arquivo): string
{
    if (str_starts_with($arquivo, 'http')) {
        return $arquivo;
    }

    return get_theme_file_uri('/assets/img/' . ltrim($arquivo, '/'));
}

/**
 * Link do WhatsApp com mensagem opcional.
 *
 * @param string $mensagem
 * @return string
 */
function site_whatsapp_link(string $mensagem = 'Olá, João! Vi seu portfólio e quero conversar sobre um site.'): string
{
    return 'https://wa.me/' . site_get_site_data()['whatsapp'] . '?text=' . rawurlencode($mensagem);
}

/**
 * Mês atual por extenso ("outubro"), usado no selo de disponibilidade.
 *
 * @return string
 */
function site_mes_atual(): string
{
    return wp_date('F');
}

/**
 * Verifica se o item do menu corresponde à página atual (projetos e serviços marcam o item pai).
 *
 * @param string $url
 * @return bool
 */
function site_is_current_menu_item(string $url): bool
{
    $atual = trailingslashit(strtok((string) home_url(add_query_arg([])), '?'));
    $url   = trailingslashit($url);

    if ($url === trailingslashit(home_url('/'))) {
        return is_front_page();
    }

    if (is_singular('projeto') && $url === trailingslashit(home_url('/projetos/'))) {
        return true;
    }

    return $atual === $url;
}

/**
 * Título com destaque: o texto entre *asteriscos* ganha a cor de destaque.
 *
 * @param string $texto
 * @return string HTML seguro
 */
function site_destaque(string $texto): string
{
    return preg_replace('/\*(.+?)\*/u', '<em>$1</em>', esc_html($texto));
}
