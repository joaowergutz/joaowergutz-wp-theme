<?php
get_header();

$site_data   = site_get_site_data();
$projetos    = site_get_projetos(3);
$servicos    = site_get_servicos();
$depoimentos = site_get_depoimentos();
?>

<section class="hero">
    <div class="hero-brilho" aria-hidden="true"></div>

    <div class="container">
        <div class="row align-items-center g-5">
            <div class="col-lg-7">
                <p class="selo-disponivel" data-anime>
                    <span class="ponto" aria-hidden="true"></span>
                    Agenda aberta para projetos em <?php echo esc_html(site_mes_atual()); ?>
                </p>

                <h1 class="hero-titulo" data-anime>
                    Sites que fazem sua empresa ser <em>encontrada</em> e <em>escolhida</em>.
                </h1>

                <p class="hero-texto" data-anime>
                    Sou o João, desenvolvedor de sites. Crio sites institucionais, lojas virtuais e páginas para anúncios
                    rápidos, bonitos e prontos para o Google, pensados para transformar visitas em clientes no seu WhatsApp.
                </p>

                <div class="hero-botoes" data-anime>
                    <a href="<?php echo esc_url(site_whatsapp_link('Olá, João! Quero um orçamento de site.')); ?>" target="_blank" rel="noopener" class="botao botao-destaque botao-g">
                        <?php echo site_icone('whatsapp'); ?>
                        <span>Quero um orçamento</span>
                    </a>
                    <a href="#analise" class="botao botao-contorno botao-g">
                        <?php echo site_icone('search'); ?>
                        <span>Análise grátis do meu site</span>
                    </a>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="hero-foto" data-anime>
                    <div class="hero-foto-moldura">
                        <img
                            src="<?php echo esc_url(site_img($site_data['foto'])); ?>"
                            alt="João Wergutz sorrindo, de camiseta preta"
                            width="400"
                            height="500"
                            fetchpriority="high"
                        >
                    </div>
                    <p class="hero-foto-chip hero-foto-chip-1">
                        <?php echo site_icone('code-slash'); ?> Sites para empresas · +<?php echo esc_html($site_data['anos_experiencia']); ?> anos
                    </p>
                    <p class="hero-foto-chip hero-foto-chip-2">
                        <?php echo site_icone('geo-alt'); ?> <?php echo esc_html($site_data['cidade']); ?> · Atendo todo o Brasil
                    </p>
                </div>
            </div>
        </div>

        <ul class="hero-provas" data-anime>
            <li><?php echo site_icone('check2'); ?> Mais de <?php echo esc_html($site_data['anos_experiencia']); ?> anos criando sites</li>
            <li><?php echo site_icone('check2'); ?> Atendimento direto com quem desenvolve</li>
            <li><?php echo site_icone('check2'); ?> Sob medida, sem tema pronto</li>
            <li><?php echo site_icone('check2'); ?> Pronto para o Google e rápido no celular</li>
        </ul>
    </div>
</section>

<div class="faixa" aria-hidden="true">
    <div class="faixa-trilho">
        <?php for ($i = 0; $i < 2; $i++) : ?>
            <ul>
                <?php foreach ($servicos as $servico) : ?>
                    <li><?php echo esc_html($servico['titulo']); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endfor; ?>
    </div>
</div>

<section class="secao projetos-home" id="projetos" aria-labelledby="projetos-titulo">
    <div class="container">
        <div class="secao-topo">
            <div>
                <p class="rotulo rotulo-escuro" data-anime>(01) Projetos</p>
                <h2 class="titulo" id="projetos-titulo" data-anime>Trabalhos <em>recentes</em></h2>
            </div>
            <a href="<?php echo esc_url(home_url('/projetos/')); ?>" class="link-seta" data-anime>
                Todos os projetos <?php echo site_icone('arrow-right'); ?>
            </a>
        </div>

        <div class="lista-projetos">
            <?php
            while ($projetos->have_posts()) :
                $projetos->the_post();
                get_template_part('template-parts/components/card-projeto');
            endwhile;
            wp_reset_postdata();
            ?>
        </div>

        <a href="<?php echo esc_url(site_whatsapp_link('Olá, João! Quero que minha empresa seja o seu próximo projeto.')); ?>" target="_blank" rel="noopener" class="proximo-projeto" data-anime>
            <span class="proximo-projeto-texto">Sua empresa pode ser o <em>próximo projeto</em> daqui.</span>
            <span class="proximo-projeto-seta"><?php echo site_icone('arrow-up-right'); ?></span>
        </a>
    </div>
</section>

<section class="secao dores" aria-labelledby="dores-titulo">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-5">
                <p class="rotulo rotulo-escuro" data-anime>(02) O problema</p>
                <h2 class="titulo" id="dores-titulo" data-anime>
                    Se alguma dessas frases já saiu da sua boca, seu site está <em>te custando clientes</em>.
                </h2>
                <p class="texto" data-anime>
                    Hoje, quase toda compra começa com uma busca no Google ou uma olhada no site. Se a sua empresa não aparece,
                    ou aparece mal, o cliente fecha com o concorrente sem nem te conhecer.
                </p>
                <a href="<?php echo esc_url(home_url('/servicos/')); ?>" class="link-seta" data-anime>
                    Ver como eu resolvo isso <?php echo site_icone('arrow-right'); ?>
                </a>
            </div>

            <div class="col-lg-7">
                <ul class="dores-lista">
                    <?php foreach (site_get_dores() as $dor) : ?>
                        <li data-anime>
                            <?php echo site_icone('chat-dots'); ?>
                            <span>“<?php echo esc_html($dor); ?>”</span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/components/analise'); ?>

<section class="secao servicos-home" aria-labelledby="servicos-titulo">
    <div class="container">
        <div class="secao-topo">
            <div>
                <p class="rotulo" data-anime>(03) Serviços</p>
                <h2 class="titulo titulo-claro" id="servicos-titulo" data-anime>O que eu posso fazer pela <em>sua empresa</em></h2>
            </div>
            <a href="<?php echo esc_url(home_url('/servicos/')); ?>" class="link-seta link-seta-claro" data-anime>
                Detalhes dos serviços <?php echo site_icone('arrow-right'); ?>
            </a>
        </div>

        <ol class="lista-servicos">
            <?php foreach ($servicos as $i => $servico) : ?>
                <li data-acende>
                    <a href="<?php echo esc_url(home_url('/servicos/#' . $servico['id'])); ?>">
                        <span class="lista-servicos-num"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
                        <span class="lista-servicos-titulo"><?php echo esc_html($servico['titulo']); ?></span>
                        <span class="lista-servicos-resumo"><?php echo esc_html($servico['resumo']); ?></span>
                        <span class="lista-servicos-seta"><?php echo site_icone('arrow-up-right'); ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ol>

    </div>
</section>

<?php get_template_part('template-parts/components/incluso', null, ['rotulo' => '(04) O que você recebe']); ?>

<section class="secao processo" aria-labelledby="processo-titulo">
    <div class="container">
        <div class="secao-topo">
            <div>
                <p class="rotulo rotulo-escuro" data-anime>(05) Como funciona</p>
                <h2 class="titulo" id="processo-titulo" data-anime>Do primeiro “oi” ao <em>site no ar</em></h2>
            </div>
            <p class="texto secao-topo-texto" data-anime>
                Um processo simples e transparente, com você acompanhando e aprovando cada etapa.
            </p>
        </div>

        <ol class="lista-processo">
            <?php foreach (site_get_processo() as $i => $etapa) : ?>
                <li data-anime>
                    <span class="lista-processo-num"><?php echo esc_html(sprintf('%02d', $i + 1)); ?></span>
                    <h3><?php echo esc_html($etapa['titulo']); ?></h3>
                    <p><?php echo esc_html($etapa['texto']); ?></p>
                </li>
            <?php endforeach; ?>
        </ol>
    </div>
</section>

<section class="secao sobre-home" aria-labelledby="sobre-titulo">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="sobre-foto" data-anime>
                    <img
                        src="<?php echo esc_url(site_img($site_data['foto'])); ?>"
                        alt="Retrato de João Wergutz"
                        width="400"
                        height="500"
                        loading="lazy"
                    >
                </div>
            </div>

            <div class="col-lg-7">
                <p class="rotulo rotulo-escuro" data-anime>(06) Quem faz</p>
                <h2 class="titulo" id="sobre-titulo" data-anime>Oi, eu sou o <em>João</em>.</h2>
                <p class="texto texto-g" data-anime>
                    Há mais de <?php echo esc_html($site_data['anos_experiencia']); ?> anos crio sites para pequenas e médias empresas que querem ser levadas a sério na internet.
                    Cuido de tudo pessoalmente, do planejamento ao site no ar, com atenção aos detalhes que fazem
                    diferença para quem visita e para o Google.
                </p>

                <a href="<?php echo esc_url(home_url('/sobre/')); ?>" class="botao botao-escuro" data-anime>
                    <span>Mais sobre mim</span>
                    <?php echo site_icone('arrow-right'); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<?php if ($depoimentos) : ?>
    <section class="secao depoimentos" aria-labelledby="depoimentos-titulo">
        <div class="container">
            <p class="rotulo rotulo-escuro" data-anime>Depoimentos</p>
            <h2 class="titulo" id="depoimentos-titulo" data-anime>O que dizem os <em>clientes</em></h2>

            <div class="row g-4 mt-4">
                <?php foreach ($depoimentos as $depoimento) : ?>
                    <div class="col-lg-6">
                        <figure class="card-depoimento" data-anime>
                            <blockquote>“<?php echo esc_html($depoimento['texto']); ?>”</blockquote>
                            <figcaption>
                                <strong><?php echo esc_html($depoimento['nome']); ?></strong>
                                <span><?php echo esc_html($depoimento['cargo']); ?></span>
                            </figcaption>
                        </figure>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
<?php endif; ?>

<?php get_template_part('template-parts/components/faq', null, ['rotulo' => '(07) Dúvidas']); ?>

<?php get_template_part('template-parts/components/cta'); ?>

<?php
get_footer();
