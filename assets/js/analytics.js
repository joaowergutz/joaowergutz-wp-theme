(function () {
    'use strict';

    /* Google Analytics só depois do "Aceitar" no aviso de cookies (inc/analytics.php) */
    if (typeof siteAnalytics === 'undefined' || !siteAnalytics.id) {
        return;
    }

    const CHAVE = 'jw_cookies';
    const aviso = document.querySelector('[data-cookies]');
    let carregado = false;

    const ler = () => {
        try {
            return localStorage.getItem(CHAVE);
        } catch (erro) {
            return null;
        }
    };

    const salvar = (valor) => {
        try {
            localStorage.setItem(CHAVE, valor);
        } catch (erro) {
            /* Sem armazenamento (aba anônima): a escolha vale só nesta visita */
        }
    };

    const carregar = () => {
        if (carregado) {
            return;
        }

        carregado = true;
        window.dataLayer = window.dataLayer || [];
        window.gtag = function () {
            window.dataLayer.push(arguments);
        };
        window.gtag('js', new Date());
        window.gtag('config', siteAnalytics.id, { anonymize_ip: true });

        const script = document.createElement('script');
        script.async = true;
        script.src = `https://www.googletagmanager.com/gtag/js?id=${encodeURIComponent(siteAnalytics.id)}`;
        document.head.appendChild(script);
    };

    /* Eventos de conversão (usados também pelos formulários: window.siteEvento) */
    window.siteEvento = (nome, parametros = {}) => {
        if (carregado && typeof window.gtag === 'function') {
            window.gtag('event', nome, parametros);
        }
    };

    document.addEventListener('click', (event) => {
        const link = event.target.closest('a[href*="wa.me/"]');

        if (link) {
            // Onde o botão está: id ou primeira classe da seção (hero, cta, site-header, barra-contato...)
            const secao = link.closest('section, header, footer, nav, .whatsapp-flutuante, .menu-mobile');
            window.siteEvento('clique_whatsapp', {
                local: secao ? (secao.id || secao.classList[0] || secao.tagName.toLowerCase()) : 'pagina',
                pagina: window.location.pathname,
            });
        }
    });

    const escolha = ler();

    if (escolha === 'aceito') {
        carregar();
    } else if (!escolha && aviso) {
        aviso.hidden = false;
    }

    aviso?.querySelector('[data-cookies-aceitar]')?.addEventListener('click', () => {
        salvar('aceito');
        aviso.hidden = true;
        carregar();
    });

    aviso?.querySelector('[data-cookies-recusar]')?.addEventListener('click', () => {
        salvar('recusado');
        aviso.hidden = true;
    });
})();
