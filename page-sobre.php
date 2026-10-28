<?php
get_header();

$site_data = site_get_site_data();
?>

<section class="page-hero sobre-hero">
    <div class="page-hero-brilho" aria-hidden="true"></div>
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-7">
                <p class="rotulo" data-anime>Sobre</p>
                <h1 class="page-hero-titulo" data-anime>Oi, eu sou o <em>João</em>.</h1>
                <p class="page-hero-texto" data-anime>
                    <?php echo esc_html($site_data['nome_completo']); ?>, desenvolvedor frontend de Santa Clara do Sul (RS), com mais de
                    <?php echo esc_html($site_data['anos_experiencia']); ?> anos de experiência criando sites que unem desempenho,
                    usabilidade e uma boa experiência para quem visita.
                </p>
                <ul class="sobre-numeros" data-anime>
                    <li><strong>+<?php echo esc_html($site_data['anos_experiencia']); ?></strong> anos criando sites</li>
                    <li><strong>100%</strong> sob medida, sem tema pronto</li>
                    <li><strong>Direto</strong> comigo, sem intermediários</li>
                </ul>
                <div class="hero-botoes" data-anime>
                    <a href="<?php echo esc_url($site_data['linkedin']); ?>" target="_blank" rel="noopener" class="botao botao-contorno">
                        <?php echo site_icone('linkedin'); ?>
                        <span>LinkedIn</span>
                    </a>
                    <a href="<?php echo esc_url($site_data['github']); ?>" target="_blank" rel="noopener" class="botao botao-contorno">
                        <?php echo site_icone('github'); ?>
                        <span>GitHub</span>
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
                </div>
            </div>
        </div>
    </div>
</section>

<section class="secao sobre-historia">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-4">
                <p class="rotulo rotulo-escuro" data-anime>(01) Minha forma de trabalhar</p>
                <h2 class="titulo" data-anime>Código bem feito, <em>conversa simples</em></h2>
            </div>
            <div class="col-lg-8">
                <div class="texto texto-g conteudo-editor" data-anime>
                    <p>
                        Há mais de <?php echo esc_html($site_data['anos_experiencia']); ?> anos desenvolvo sites responsivos, modernos e otimizados
                        com JavaScript, HTML, CSS, PHP e WordPress. No dia a dia, crio e mantenho projetos aplicando boas práticas de
                        desenvolvimento, SEO e performance, sempre priorizando a usabilidade e a experiência de quem acessa.
                    </p>
                    <p>
                        Gosto de entender o problema antes de pensar na solução. Por isso, antes de falar de cores e animações, quero saber
                        quem são os seus clientes, o que eles procuram e o que precisam ver para escolher a sua empresa. O resultado é um site
                        funcional, intuitivo e alinhado ao que o seu negócio precisa.
                    </p>
                    <p>
                        A tecnologia muda rápido, e eu acompanho: estou sempre estudando e aplicando o que há de melhor no desenvolvimento web.
                        E, como você fala direto comigo do início ao fim, nada se perde no caminho. Depois que o site vai ao ar, continuo por perto
                        para ajustes, dúvidas e novas ideias.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="secao sobre-diferenciais">
    <div class="container">
        <p class="rotulo" data-anime>(02) O que você pode esperar</p>
        <h2 class="titulo titulo-claro mb-48" data-anime>Compromissos de <em>cada projeto</em></h2>

        <ul class="lista-diferenciais lista-diferenciais-escuro">
            <?php foreach (site_get_diferenciais() as $diferencial) : ?>
                <li data-anime>
                    <h3><?php echo esc_html($diferencial['titulo']); ?></h3>
                    <p><?php echo esc_html($diferencial['texto']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>


<?php get_template_part('template-parts/components/cta'); ?>

<?php
get_footer();
