<?php
get_header();

$site_data = site_get_site_data();
$prazos    = ['O quanto antes', 'Nos próximos 30 dias', 'Em 2 a 3 meses', 'Ainda estou pesquisando'];

get_template_part(
    'template-parts/components/page-hero',
    null,
    [
        'rotulo' => 'Contato',
        'titulo' => 'Vamos conversar sobre o *seu site*?',
        'texto'  => 'Responda três perguntas rápidas e a sua mensagem chega pronta no meu WhatsApp. Se preferir, fale direto pelos canais ao lado.',
    ]
);
?>

<section class="secao contato">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7">
                <form class="form-contato" data-form-contato novalidate>
                    <p class="form-progresso" aria-live="polite" data-progresso>Etapa 1 de 3</p>

                    <fieldset class="form-etapa" data-etapa="1">
                        <legend class="form-legenda">O que você precisa?</legend>
                        <div class="opcoes">
                            <?php foreach (site_get_servicos() as $servico) : ?>
                                <label class="opcao">
                                    <input type="radio" name="servico" value="<?php echo esc_attr($servico['titulo']); ?>" required>
                                    <span><?php echo site_icone($servico['icone']); ?> <?php echo esc_html($servico['titulo']); ?></span>
                                </label>
                            <?php endforeach; ?>
                            <label class="opcao">
                                <input type="radio" name="servico" value="Análise gratuita do meu site atual" required>
                                <span><?php echo site_icone('search'); ?> Análise gratuita do meu site</span>
                            </label>
                            <label class="opcao">
                                <input type="radio" name="servico" value="Ainda não sei, quero uma orientação" required>
                                <span><?php echo site_icone('chat-dots'); ?> Ainda não sei</span>
                            </label>
                        </div>
                        <p class="form-erro" data-erro hidden>Escolha uma opção para continuar.</p>
                    </fieldset>

                    <fieldset class="form-etapa" data-etapa="2">
                        <legend class="form-legenda">Para quando você precisa?</legend>
                        <div class="opcoes">
                            <?php foreach ($prazos as $prazo) : ?>
                                <label class="opcao">
                                    <input type="radio" name="prazo" value="<?php echo esc_attr($prazo); ?>" required>
                                    <span><?php echo esc_html($prazo); ?></span>
                                </label>
                            <?php endforeach; ?>
                        </div>
                        <p class="form-erro" data-erro hidden>Escolha uma opção para continuar.</p>
                    </fieldset>

                    <fieldset class="form-etapa" data-etapa="3">
                        <legend class="form-legenda">Conte um pouco sobre você</legend>
                        <div class="campos">
                            <label class="campo">
                                <span>Seu nome</span>
                                <input type="text" name="nome" autocomplete="name" required>
                            </label>
                            <label class="campo">
                                <span>Empresa <small>(opcional)</small></span>
                                <input type="text" name="empresa" autocomplete="organization">
                            </label>
                            <label class="campo campo-inteiro">
                                <span>Seu site atual <small>(se tiver)</small></span>
                                <input type="text" name="site" inputmode="url" autocomplete="url" placeholder="www.suaempresa.com.br">
                            </label>
                            <label class="campo campo-inteiro">
                                <span>Mensagem <small>(opcional)</small></span>
                                <textarea name="mensagem" rows="4" placeholder="Ex.: tenho uma loja de móveis e quero um site para mostrar os produtos."></textarea>
                            </label>
                        </div>
                        <p class="form-erro" data-erro hidden>Informe o seu nome para continuar.</p>
                    </fieldset>

                    <div class="form-botoes">
                        <button type="button" class="botao botao-contorno-escuro" data-voltar hidden>
                            <span>Voltar</span>
                        </button>
                        <button type="button" class="botao botao-escuro" data-avancar>
                            <span>Continuar</span>
                            <?php echo site_icone('arrow-right'); ?>
                        </button>
                        <button type="submit" class="botao botao-escuro" data-enviar>
                            <?php echo site_icone('whatsapp'); ?>
                            <span>Enviar pelo WhatsApp</span>
                        </button>
                    </div>

                    <p class="form-aviso">
                        Seus dados não ficam salvos neste site: a mensagem é aberta no seu WhatsApp para você enviar.
                    </p>
                </form>
            </div>

            <div class="col-lg-5">
                <ul class="canais">
                    <li data-anime>
                        <a href="<?php echo esc_url(site_whatsapp_link()); ?>" target="_blank" rel="noopener" class="canal">
                            <span class="canal-icone"><?php echo site_icone('whatsapp'); ?></span>
                            <span class="canal-texto">
                                <strong>WhatsApp</strong>
                                <span><?php echo esc_html($site_data['celular']); ?></span>
                            </span>
                            <?php echo site_icone('arrow-up-right'); ?>
                        </a>
                    </li>
                    <li data-anime>
                        <div class="canal">
                            <span class="canal-icone"><?php echo site_icone('envelope'); ?></span>
                            <a href="mailto:<?php echo esc_attr($site_data['email']); ?>" class="canal-texto">
                                <strong>E-mail</strong>
                                <span><?php echo esc_html($site_data['email']); ?></span>
                            </a>
                            <button type="button" class="canal-copiar" data-copiar="<?php echo esc_attr($site_data['email']); ?>" aria-label="Copiar e-mail">
                                <?php echo site_icone('copy'); ?>
                            </button>
                        </div>
                    </li>
                    <li data-anime>
                        <a href="<?php echo esc_url($site_data['linkedin']); ?>" target="_blank" rel="noopener" class="canal">
                            <span class="canal-icone"><?php echo site_icone('linkedin'); ?></span>
                            <span class="canal-texto">
                                <strong>LinkedIn</strong>
                                <span><?php echo esc_html($site_data['nome_completo']); ?></span>
                            </span>
                            <?php echo site_icone('arrow-up-right'); ?>
                        </a>
                    </li>
                    <li data-anime>
                        <a href="<?php echo esc_url($site_data['github']); ?>" target="_blank" rel="noopener" class="canal">
                            <span class="canal-icone"><?php echo site_icone('github'); ?></span>
                            <span class="canal-texto">
                                <strong>GitHub</strong>
                                <span><?php echo esc_html($site_data['github_user']); ?></span>
                            </span>
                            <?php echo site_icone('arrow-up-right'); ?>
                        </a>
                    </li>
                </ul>

                <p class="selo-disponivel selo-disponivel-escuro" data-anime>
                    <span class="ponto" aria-hidden="true"></span>
                    Agenda aberta para projetos em <?php echo esc_html(site_mes_atual()); ?>
                </p>
            </div>
        </div>
    </div>
</section>

<?php get_template_part('template-parts/components/faq'); ?>

<?php
get_footer();
