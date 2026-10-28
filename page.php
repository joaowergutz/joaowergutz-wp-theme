<?php
get_header();

while (have_posts()) :
    the_post();

    get_template_part('template-parts/components/page-hero', null, ['titulo' => get_the_title()]);
    ?>

    <section class="secao">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 offset-lg-2 conteudo-editor texto">
                    <?php the_content(); ?>
                </div>
            </div>
        </div>
    </section>

    <?php
endwhile;

get_footer();
