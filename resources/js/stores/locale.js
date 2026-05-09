import { defineStore } from 'pinia';
import { i18n, applyHtmlLang, SUPPORTED_LOCALES } from '../i18n';

export const useLocaleStore = defineStore('locale', {
    state: () => ({
        current: 'en',
    }),
    getters: {
        isKhmer: (state) => state.current === 'km',
        isEnglish: (state) => state.current === 'en',
        supported: () => SUPPORTED_LOCALES,
    },
    actions: {
        hydrateFromHtml() {
            const html = document.documentElement.getAttribute('lang') || 'en';
            this.current = SUPPORTED_LOCALES.includes(html) ? html : 'en';
            i18n.global.locale.value = this.current;
        },

        switch(locale) {
            if (!SUPPORTED_LOCALES.includes(locale)) return;
            this.current = locale;
            i18n.global.locale.value = locale;
            applyHtmlLang(locale);
            localStorage.setItem('app_locale', locale);

            // Persist on the server (cookie) so the next full page render
            // uses the correct locale for server-rendered Blade strings,
            // BUT do NOT reload the page — UI strings update reactively.
            window.axios
                .post('/locale', { locale })
                .catch(() => { /* silently ignore */ });

            // Translate any element marked with data-i18n="key" so static
            // Blade strings can also flip without a page refresh.
            this.refreshDomTranslations();
        },

        refreshDomTranslations() {
            const t = i18n.global.t;
            document.querySelectorAll('[data-i18n]').forEach((el) => {
                const key = el.getAttribute('data-i18n');
                if (!key) return;
                el.textContent = t(key);
            });
            document.querySelectorAll('[data-i18n-placeholder]').forEach((el) => {
                const key = el.getAttribute('data-i18n-placeholder');
                if (!key) return;
                el.setAttribute('placeholder', t(key));
            });
            document.querySelectorAll('[data-i18n-title]').forEach((el) => {
                const key = el.getAttribute('data-i18n-title');
                if (!key) return;
                el.setAttribute('title', t(key));
            });
        },
    },
});
