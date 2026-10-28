<?php
/**
 * O que vem incluso em todo site.
 *
 * @var array $args rotulo
 */
?>
<section class="secao incluso" aria-labelledby="incluso-titulo">
    <div class="container">
        <div class="secao-topo">
            <div>
                <p class="rotulo rotulo-escuro" data-anime><?php echo esc_html($args['rotulo'] ?? 'O que você recebe'); ?></p>
                <h2 class="titulo" id="incluso-titulo" data-anime>Tudo isso vem <em>em todo site</em></h2>
            </div>
            <p class="texto secao-topo-texto" data-anime>
                Sem surpresas: tudo isso já faz parte de todo projeto que eu entrego.
            </p>
        </div>

        <ul class="lista-incluso">
            <?php foreach (site_get_incluso() as $item) : ?>
                <li data-anime>
                    <span class="lista-incluso-icone"><?php echo site_icone($item['icone']); ?></span>
                    <h3><?php echo esc_html($item['titulo']); ?></h3>
                    <p><?php echo esc_html($item['texto']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
</section>
