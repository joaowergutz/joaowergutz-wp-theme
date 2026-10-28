<?php
/**
 * Card de projeto em destaque (mockup de navegador + celular e resumo do caso). Usar dentro do loop.
 *
 * @var array $args titulo_tag (h2 ou h3)
 */
$projeto    = site_get_projeto();
$titulo_tag = $args['titulo_tag'] ?? 'h3';
// Com imagem destacada no painel, usa só ela; sem, as versões do tema (480/720/800/1440px)
$srcset = has_post_thumbnail() ? '' : site_projeto_srcset($projeto['capa']);
?>
<article class="card-projeto" data-anime>
    <a href="<?php the_permalink(); ?>" class="card-projeto-midia" tabindex="-1" aria-hidden="true">
        <div class="mockup-navegador">
            <div class="mockup-barra"><span></span><span></span><span></span></div>
            <img
                src="<?php echo esc_url(site_get_projeto_capa(null, true)); ?>"
                <?php if ($srcset) : ?>
                    srcset="<?php echo esc_attr($srcset); ?>"
                    sizes="(min-width: 992px) 600px, calc(100vw - 112px)"
                <?php endif; ?>
                alt=""
                width="800"
                height="500"
                loading="lazy"
            >
        </div>

        <?php if ($projeto['capa_mobile']) : ?>
            <div class="mockup-celular">
                <img
                    src="<?php echo esc_url(site_projeto_img($projeto['capa_mobile'])); ?>"
                    srcset="<?php echo esc_attr(site_projeto_srcset($projeto['capa_mobile'])); ?>"
                    sizes="(min-width: 768px) 180px, 30vw"
                    alt=""
                    width="600"
                    height="1298"
                    loading="lazy"
                >
            </div>
        <?php endif; ?>
    </a>

    <div class="card-projeto-info">
        <p class="rotulo rotulo-escuro">
            <?php echo esc_html(implode(' · ', array_filter([$projeto['segmento'], $projeto['local'], $projeto['ano']]))); ?>
        </p>
        <<?php echo $titulo_tag; ?> class="card-projeto-titulo">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </<?php echo $titulo_tag; ?>>
        <p class="texto"><?php echo esc_html(get_the_excerpt()); ?></p>

        <?php if ($projeto['entregas']) : ?>
            <ul class="tags" aria-label="Entregas">
                <?php foreach ($projeto['entregas'] as $entrega) : ?>
                    <li><?php echo esc_html($entrega); ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <div class="card-projeto-links">
            <a href="<?php the_permalink(); ?>" class="botao botao-escuro">
                <span>Ver estudo de caso</span>
                <?php echo site_icone('arrow-right'); ?>
            </a>
            <?php if ($projeto['url']) : ?>
                <a href="<?php echo esc_url($projeto['url']); ?>" target="_blank" rel="noopener" class="link-seta">
                    Visitar o site <?php echo site_icone('arrow-up-right'); ?>
                    <span class="screen-reader-text">(abre em nova aba)</span>
                </a>
            <?php endif; ?>
        </div>
    </div>
</article>
