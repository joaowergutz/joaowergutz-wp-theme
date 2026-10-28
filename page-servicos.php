<?php
get_header();

get_template_part(
    'template-parts/components/page-hero',
    null,
    [
        'rotulo' => 'Serviços',
        'titulo' => 'Tudo o que sua empresa precisa para *crescer na internet*',
        'texto'  => 'Do site novo à manutenção do que já existe. Escolha o serviço ou me conta o seu desafio que eu te ajudo a definir o melhor caminho.',
    ]
);
?>

<nav class="servicos-atalhos" aria-label="Serviços nesta página">
    <div class="container">
        <ul>
            <?php foreach (site_get_servicos() as $servico) : ?>
                <li><a href="#<?php echo esc_attr($servico['id']); ?>"><?php echo esc_html($servico['titulo']); ?></a></li>
            <?php endforeach; ?>
        </ul>
    </div>
</nav>

<section class="secao servicos-pagina">
    <div class="container">
        <?php foreach (site_get_servicos() as $i => $servico) : ?>
            <article class="servico-bloco" id="<?php echo esc_attr($servico['id']); ?>" aria-labelledby="titulo-<?php echo esc_attr($servico['id']); ?>">
                <div class="row g-4">
                    <div class="col-lg-5">
                        <p class="rotulo rotulo-escuro" data-anime><?php echo esc_html(sprintf('(%02d)', $i + 1)); ?></p>
                        <div class="servico-icone" data-anime><?php echo site_icone($servico['icone']); ?></div>
                        <h2 class="titulo" id="titulo-<?php echo esc_attr($servico['id']); ?>" data-anime><?php echo esc_html($servico['titulo']); ?></h2>

                        <?php if (!empty($servico['termo'])) : ?>
                            <p class="servico-termo" data-anime>Também chamado de <strong><?php echo esc_html($servico['termo']); ?></strong></p>
                        <?php endif; ?>
                    </div>

                    <div class="col-lg-7">
                        <p class="texto texto-g" data-anime><?php echo esc_html($servico['texto']); ?></p>

                        <ul class="lista-check" data-anime>
                            <?php foreach ($servico['itens'] as $item) : ?>
                                <li><?php echo site_icone('check2'); ?> <?php echo esc_html($item); ?></li>
                            <?php endforeach; ?>
                        </ul>

                        <a
                            href="<?php echo esc_url(site_whatsapp_link('Olá, João! Quero saber mais sobre o serviço "' . $servico['titulo'] . '".')); ?>"
                            target="_blank"
                            rel="noopener"
                            class="link-seta"
                            data-anime
                        >
                            Falar sobre este serviço no WhatsApp <?php echo site_icone('arrow-up-right'); ?>
                            <span class="screen-reader-text">(<?php echo esc_html($servico['titulo']); ?>)</span>
                        </a>
                    </div>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<?php get_template_part('template-parts/components/incluso'); ?>

<section class="secao processo processo-escuro" aria-labelledby="processo-titulo">
    <div class="container">
        <div class="secao-topo">
            <div>
                <p class="rotulo" data-anime>Como funciona</p>
                <h2 class="titulo titulo-claro" id="processo-titulo" data-anime>Do primeiro “oi” ao <em>site no ar</em></h2>
            </div>
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

<?php get_template_part('template-parts/components/cta'); ?>

<?php
get_footer();
