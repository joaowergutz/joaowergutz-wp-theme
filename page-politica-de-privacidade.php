<?php
get_header();

$site_data = site_get_site_data();

get_template_part(
    'template-parts/components/page-hero',
    null,
    [
        'rotulo' => 'LGPD',
        'titulo' => 'Política de *privacidade*',
        'texto'  => 'Como este site trata os dados de quem visita e entra em contato.',
    ]
);
?>

<section class="secao">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2 conteudo-editor texto">
                <p><em>Última atualização: <?php echo esc_html(wp_date('j \d\e F \d\e Y', strtotime('2026-10-15'))); ?>.</em></p>

                <h2>Quem é o responsável</h2>
                <p>
                    Este site pertence a <?php echo esc_html($site_data['nome_completo']); ?>, desenvolvedor de sites.
                    Para qualquer assunto sobre os seus dados, escreva para
                    <a href="mailto:<?php echo esc_attr($site_data['email']); ?>"><?php echo esc_html($site_data['email']); ?></a>.
                </p>

                <h2>Quais dados são coletados</h2>
                <p>
                    Este site não tem cadastro e não grava formulários.
                    O formulário da página de contato e o da análise gratuita apenas montam uma mensagem e a abrem no seu WhatsApp: nada do que você digita é enviado
                    ou armazenado aqui. Os dados só chegam até mim se você decidir enviar a mensagem pelo WhatsApp ou por e-mail.
                </p>

                <h2>Como os dados de contato são usados</h2>
                <p>
                    Nome, telefone, e-mail e as informações que você enviar são usados somente para responder ao seu contato,
                    preparar propostas e conduzir o projeto combinado. Não vendo nem compartilho esses dados com terceiros.
                </p>

                <h2>Serviços de terceiros</h2>
                <p>
                    Para carregar fontes e bibliotecas, o site usa o Google Fonts e o jsDelivr, que recebem o endereço IP do seu navegador
                    para entregar esses arquivos. Ao clicar nos links de WhatsApp, LinkedIn ou GitHub, você passa a seguir as políticas
                    de privacidade dessas plataformas.
                </p>

                <h2>Cookies e estatísticas</h2>
                <?php if (site_ga4_id()) : ?>
                    <p>
                        Com a sua autorização no aviso de cookies, o site usa o Google Analytics para medir visitas, páginas vistas e cliques
                        nos botões de contato, de forma anônima. Se você recusar, nada disso é carregado. Para mudar a sua escolha, limpe os
                        dados de navegação deste site no seu navegador.
                    </p>
                <?php else : ?>
                    <p>Este site não usa cookies de rastreamento.</p>
                <?php endif; ?>

                <h2>Seus direitos</h2>
                <p>
                    Pela Lei Geral de Proteção de Dados (Lei 13.709/2018), você pode pedir a confirmação, o acesso, a correção ou a exclusão
                    dos seus dados a qualquer momento, pelo e-mail informado acima.
                </p>
            </div>
        </div>
    </div>
</section>

<?php
get_footer();
