<?php
/**
 * Banner escuro das páginas internas.
 *
 * @var array $args rotulo, titulo (aceita *destaque*), texto
 */
?>
<section class="page-hero">
    <div class="page-hero-brilho" aria-hidden="true"></div>
    <div class="container">
        <?php if (!empty($args['rotulo'])) : ?>
            <p class="rotulo" data-anime><?php echo esc_html($args['rotulo']); ?></p>
        <?php endif; ?>

        <h1 class="page-hero-titulo" data-anime><?php echo site_destaque($args['titulo'] ?? get_the_title()); ?></h1>

        <?php if (!empty($args['texto'])) : ?>
            <p class="page-hero-texto" data-anime><?php echo esc_html($args['texto']); ?></p>
        <?php endif; ?>
    </div>
</section>
