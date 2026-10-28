<?php
get_header();

get_template_part('template-parts/components/page-hero', null, ['titulo' => wp_strip_all_tags(get_the_archive_title()) ?: 'Conteúdo']);
?>

<section class="secao">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 conteudo-editor texto">
                <?php if (have_posts()) : ?>
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article>
                            <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <?php the_excerpt(); ?>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <p>Nada por aqui ainda.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
