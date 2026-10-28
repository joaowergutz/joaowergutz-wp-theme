<?php

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Google Analytics 4 com aviso de cookies (LGPD).
 *
 * Fica desligado enquanto site_get_site_data()['ga4'] estiver vazio. Com o ID preenchido (G-XXXXXXX):
 * - mostra o aviso de cookies e só carrega o Analytics depois do "Aceitar";
 * - registra os eventos clique_whatsapp (qualquer link wa.me) e generate_lead (envio dos formulários).
 */

/**
 * ID do Google Analytics ou vazio.
 *
 * @return string
 */
function site_ga4_id(): string
{
    return trim((string) (site_get_site_data()['ga4'] ?? ''));
}

/**
 * Script de consentimento + eventos.
 *
 * @return void
 */
function site_analytics_enqueue(): void
{
    if (!site_ga4_id()) {
        return;
    }

    wp_enqueue_script(
        'site-analytics',
        get_theme_file_uri('/assets/js/analytics.js'),
        [],
        wp_get_theme()->get('Version'),
        [
            'in_footer' => true,
            'strategy'  => 'defer',
        ]
    );

    wp_localize_script('site-analytics', 'siteAnalytics', ['id' => site_ga4_id()]);
}

add_action('wp_enqueue_scripts', 'site_analytics_enqueue');

/**
 * Aviso de cookies (aparece só para quem ainda não escolheu).
 *
 * @return void
 */
function site_aviso_cookies(): void
{
    if (!site_ga4_id()) {
        return;
    }
    ?>
    <div class="aviso-cookies" role="region" aria-label="Aviso de cookies" data-cookies hidden>
        <p>
            Uso cookies do Google Analytics para entender como o site é usado e melhorar a sua experiência.
            <a href="<?php echo esc_url(home_url('/politica-de-privacidade/')); ?>">Saiba mais</a>.
        </p>
        <div class="aviso-cookies-botoes">
            <button type="button" class="botao botao-contorno botao-p" data-cookies-recusar>Recusar</button>
            <button type="button" class="botao botao-destaque botao-p" data-cookies-aceitar>Aceitar</button>
        </div>
    </div>
    <?php
}

add_action('wp_footer', 'site_aviso_cookies', 5);
