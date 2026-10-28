<?php
get_header();

while (have_posts()) :
    the_post();

    $projeto = site_get_projeto();
    $outros  = site_get_projetos(2, get_the_ID());
    ?>

    <section class="page-hero projeto-hero">
        <div class="page-hero-brilho" aria-hidden="true"></div>
        <div class="container">
            <nav class="breadcrumb" aria-label="Você está em" data-anime>
                <a href="<?php echo esc_url(home_url('/projetos/')); ?>">Projetos</a>
                <span aria-hidden="true">/</span>
                <span aria-current="page"><?php the_title(); ?></span>
            </nav>

            <h1 class="page-hero-titulo" data-anime><?php the_title(); ?></h1>
            <p class="page-hero-texto" data-anime><?php echo esc_html(get_the_excerpt()); ?></p>

            <dl class="projeto-ficha" data-anime>
                <?php if ($projeto['segmento']) : ?>
                    <div><dt>Segmento</dt><dd><?php echo esc_html($projeto['segmento']); ?></dd></div>
                <?php endif; ?>
                <?php if ($projeto['local']) : ?>
                    <div><dt>Local</dt><dd><?php echo esc_html($projeto['local']); ?></dd></div>
                <?php endif; ?>
                <?php if ($projeto['ano']) : ?>
                    <div><dt>Ano</dt><dd><?php echo esc_html($projeto['ano']); ?></dd></div>
                <?php endif; ?>
                <?php if ($projeto['entregas']) : ?>
                    <div><dt>Entregas</dt><dd><?php echo esc_html(implode(', ', $projeto['entregas'])); ?></dd></div>
                <?php endif; ?>
            </dl>

            <?php if ($projeto['url']) : ?>
                <a href="<?php echo esc_url($projeto['url']); ?>" target="_blank" rel="noopener" class="botao botao-destaque" data-anime>
                    <span>Visitar o site</span>
                    <?php echo site_icone('arrow-up-right'); ?>
                    <span class="screen-reader-text">(abre em nova aba)</span>
                </a>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($projeto['capa']) : ?>
        <div class="projeto-capa">
            <div class="container">
                <div class="mockup-navegador mockup-navegador-g">
                    <div class="mockup-barra">
                        <span></span><span></span><span></span>
                        <?php if ($projeto['url']) : ?>
                            <p class="mockup-url"><?php echo esc_html(wp_parse_url($projeto['url'], PHP_URL_HOST)); ?></p>
                        <?php endif; ?>
                    </div>
                    <img
                        src="<?php echo esc_url(site_projeto_img($projeto['capa'])); ?>"
                        srcset="<?php echo esc_attr(site_projeto_srcset($projeto['capa'])); ?>"
                        sizes="(min-width: 1320px) 1272px, calc(100vw - 48px)"
                        alt="Página inicial do site <?php echo esc_attr($projeto['cliente']); ?> no computador"
                        width="1440"
                        height="900"
                        fetchpriority="high"
                    >
                </div>
            </div>
        </div>
    <?php endif; ?>

    <section class="secao projeto-caso">
        <div class="container">
            <?php if ($projeto['desafio']) : ?>
                <div class="row g-4 projeto-bloco">
                    <div class="col-lg-4">
                        <p class="rotulo rotulo-escuro" data-anime>(01)</p>
                        <h2 class="titulo" data-anime>O <em>desafio</em></h2>
                    </div>
                    <div class="col-lg-8">
                        <p class="texto texto-g" data-anime><?php echo esc_html($projeto['desafio']); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($projeto['solucao']) : ?>
                <div class="row g-4 projeto-bloco">
                    <div class="col-lg-4">
                        <p class="rotulo rotulo-escuro" data-anime>(02)</p>
                        <h2 class="titulo" data-anime>A <em>solução</em></h2>
                    </div>
                    <div class="col-lg-8">
                        <p class="texto texto-g" data-anime><?php echo esc_html($projeto['solucao']); ?></p>

                        <?php if ($projeto['tecnologias']) : ?>
                            <ul class="tags" aria-label="Tecnologias" data-anime>
                                <?php foreach ($projeto['tecnologias'] as $tecnologia) : ?>
                                    <li><?php echo esc_html($tecnologia); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (get_the_content()) : ?>
                <div class="row g-4 projeto-bloco">
                    <div class="col-lg-8 offset-lg-4 conteudo-editor" data-anime>
                        <?php the_content(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($projeto['resultados']) : ?>
                <div class="row g-4 projeto-bloco">
                    <div class="col-lg-4">
                        <p class="rotulo rotulo-escuro" data-anime>(03)</p>
                        <h2 class="titulo" data-anime>O <em>resultado</em></h2>
                    </div>
                    <div class="col-lg-8">
                        <ul class="lista-resultados">
                            <?php foreach ($projeto['resultados'] as $resultado) : ?>
                                <li data-anime>
                                    <strong><?php echo esc_html($resultado['valor']); ?></strong>
                                    <span><?php echo esc_html($resultado['texto']); ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <?php if ($projeto['galeria'] || $projeto['pagina']) : ?>
        <section class="secao projeto-galeria" aria-labelledby="galeria-titulo">
            <div class="container">
                <p class="rotulo" data-anime>Telas</p>
                <h2 class="titulo titulo-claro" id="galeria-titulo" data-anime>Por <em>dentro</em> do site</h2>

                <div class="galeria">
                    <?php foreach ($projeto['galeria'] as $imagem) : ?>
                        <figure class="galeria-item galeria-<?php echo esc_attr($imagem['tipo']); ?>" data-anime>
                            <?php if ('mobile' === $imagem['tipo']) : ?>
                                <div class="mockup-celular">
                                    <img src="<?php echo esc_url(site_projeto_img($imagem['arquivo'])); ?>" srcset="<?php echo esc_attr(site_projeto_srcset($imagem['arquivo'])); ?>" sizes="260px" alt="<?php echo esc_attr($imagem['legenda'] . ' do site ' . $projeto['cliente']); ?>" width="600" height="1298" loading="lazy">
                                </div>
                            <?php else : ?>
                                <div class="mockup-navegador">
                                    <div class="mockup-barra"><span></span><span></span><span></span></div>
                                    <img src="<?php echo esc_url(site_projeto_img($imagem['arquivo'])); ?>" srcset="<?php echo esc_attr(site_projeto_srcset($imagem['arquivo'])); ?>" sizes="(min-width: 992px) 800px, calc(100vw - 48px)" alt="<?php echo esc_attr($imagem['legenda'] . ' do site ' . $projeto['cliente']); ?>" width="1440" height="900" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <figcaption><?php echo esc_html($imagem['legenda']); ?></figcaption>
                        </figure>
                    <?php endforeach; ?>
                </div>

                <?php if ($projeto['pagina']) : ?>
                    <figure class="pagina-inteira" data-anime>
                        <div class="mockup-navegador">
                            <div class="mockup-barra"><span></span><span></span><span></span></div>
                            <div class="pagina-inteira-janela" tabindex="0" role="region" aria-label="Página inicial completa, role dentro da janela" data-lenis-prevent>
                                <img src="<?php echo esc_url(site_projeto_img($projeto['pagina'])); ?>" alt="Página inicial completa do site <?php echo esc_attr($projeto['cliente']); ?>" width="1200" height="6046" loading="lazy">
                            </div>
                        </div>
                        <figcaption>Página inicial completa: role dentro da janela</figcaption>
                    </figure>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <?php if ($outros->have_posts()) : ?>
        <section class="secao outros-projetos" aria-labelledby="outros-titulo">
            <div class="container">
                <h2 class="titulo mb-48" id="outros-titulo" data-anime>Outros <em>projetos</em></h2>
                <div class="lista-projetos">
                    <?php
                    while ($outros->have_posts()) :
                        $outros->the_post();
                        get_template_part('template-parts/components/card-projeto');
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php
    get_template_part(
        'template-parts/components/cta',
        null,
        [
            'titulo' => 'Quer um site assim para a *sua empresa*?',
        ]
    );
endwhile;

get_footer();
