<?php
get_header();
?>

<section class="page-hero pagina-404">
    <div class="page-hero-brilho" aria-hidden="true"></div>
    <div class="container">
        <p class="rotulo" data-anime>Erro 404</p>
        <h1 class="page-hero-titulo" data-anime>Essa página <em>não existe</em>.</h1>
        <p class="page-hero-texto" data-anime>Talvez o link tenha mudado. Que tal começar pelo início ou ver os projetos?</p>
        <div class="hero-botoes" data-anime>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="botao botao-destaque">
                <span>Ir para o início</span>
                <?php echo site_icone('arrow-right'); ?>
            </a>
            <a href="<?php echo esc_url(home_url('/projetos/')); ?>" class="botao botao-contorno">
                <span>Ver projetos</span>
            </a>
        </div>
    </div>
</section>

<?php
get_footer();
