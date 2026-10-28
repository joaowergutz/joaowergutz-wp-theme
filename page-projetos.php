<?php
get_header();

$projetos = site_get_projetos();

get_template_part(
    'template-parts/components/page-hero',
    null,
    [
        'rotulo' => 'Portfólio',
        'titulo' => 'Projetos e *estudos de caso*',
        'texto'  => 'Cada site começa com um desafio de negócio. Aqui você vê o que cada cliente precisava, o que eu fiz e o resultado.',
    ]
);
?>

<section class="secao projetos-pagina">
    <div class="container">
        <?php if ($projetos->have_posts()) : ?>
            <div class="lista-projetos">
                <?php
                while ($projetos->have_posts()) :
                    $projetos->the_post();
                    get_template_part('template-parts/components/card-projeto', null, ['titulo_tag' => 'h2']);
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php else : ?>
            <p class="texto">Novos projetos em breve.</p>
        <?php endif; ?>

        <a href="<?php echo esc_url(site_whatsapp_link('Olá, João! Quero que minha empresa seja o seu próximo projeto.')); ?>" target="_blank" rel="noopener" class="proximo-projeto" data-anime>
            <span class="proximo-projeto-texto">Sua empresa pode ser o <em>próximo projeto</em> daqui.</span>
            <span class="proximo-projeto-seta"><?php echo site_icone('arrow-up-right'); ?></span>
        </a>
    </div>
</section>

<?php get_template_part('template-parts/components/cta'); ?>

<?php
get_footer();
