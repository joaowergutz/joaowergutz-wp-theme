<?php
/**
 * Oferta de análise gratuita para quem já tem site. O formulário monta a mensagem e abre o WhatsApp
 * (sem JS, envia o endereço direto para o wa.me).
 */
$whatsapp = site_get_site_data()['whatsapp'];
?>
<section class="analise" id="analise" aria-labelledby="analise-titulo">
    <div class="container">
        <div class="analise-caixa">
            <div class="row g-5 align-items-center">
                <div class="col-lg-6">
                    <p class="rotulo" data-anime>Já tem um site?</p>
                    <h2 class="titulo titulo-claro" id="analise-titulo" data-anime>Receba uma <em>análise gratuita</em> do seu site</h2>
                    <p class="analise-texto" data-anime>
                        Eu olho a velocidade, como ele fica no celular e como aparece no Google, e te mando pelo WhatsApp
                        o que vale a pena melhorar. Sem custo e sem compromisso.
                    </p>
                </div>

                <div class="col-lg-6">
                    <form
                        class="form-analise"
                        action="https://wa.me/<?php echo esc_attr($whatsapp); ?>"
                        method="get"
                        target="_blank"
                        data-form-analise
                        data-anime
                    >
                        <label class="campo" for="analise-site">
                            <span>Endereço do seu site</span>
                        </label>
                        <div class="form-analise-linha">
                            <input
                                type="text"
                                id="analise-site"
                                name="text"
                                inputmode="url"
                                autocomplete="url"
                                placeholder="www.suaempresa.com.br"
                                required
                            >
                            <button type="submit" class="botao botao-destaque">
                                <?php echo site_icone('whatsapp'); ?>
                                <span>Quero a análise</span>
                            </button>
                        </div>
                        <p class="form-analise-aviso">A mensagem abre no seu WhatsApp, pronta para enviar.</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
