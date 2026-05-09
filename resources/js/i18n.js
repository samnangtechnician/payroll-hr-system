import { createI18n } from 'vue-i18n';

import en from '../lang/en.json';
import km from '../lang/km.json';

export const SUPPORTED_LOCALES = ['en', 'km'];

export function detectInitialLocale() {
    const html = document.documentElement;
    const fromHtml = html.getAttribute('lang');
    if (fromHtml && SUPPORTED_LOCALES.includes(fromHtml)) {
        return fromHtml;
    }
    const stored = localStorage.getItem('app_locale');
    if (stored && SUPPORTED_LOCALES.includes(stored)) {
        return stored;
    }
    return 'en';
}

export function applyHtmlLang(locale) {
    const html = document.documentElement;
    html.setAttribute('lang', locale);
    html.classList.remove('locale-en', 'locale-km');
    html.classList.add(`locale-${locale}`);
}

export const i18n = createI18n({
    legacy: false,
    locale: detectInitialLocale(),
    fallbackLocale: 'en',
    messages: { en, km },
    globalInjection: true,
});
