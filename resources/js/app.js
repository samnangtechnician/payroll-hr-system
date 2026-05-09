import './bootstrap';

import { createApp } from 'vue';
import { createPinia } from 'pinia';

import { i18n, applyHtmlLang } from './i18n';
import { useLocaleStore } from './stores/locale';

import Swal from 'sweetalert2';

import LanguageSwitcher from './components/LanguageSwitcher.vue';
import TranslatableText from './components/TranslatableText.vue';
import DataTableContainer from './components/DataTableContainer.vue';

import { initFlatpickr } from './plugins/flatpickr';
import { initTomSelect } from './plugins/tom-select';
import { initDeleteConfirms } from './plugins/delete-confirm';
import { initServerDataTables } from './plugins/datatables';

window.Swal = Swal;

const pinia = createPinia();
const app = createApp({
    components: {
        LanguageSwitcher,
        TranslatableText,
        DataTableContainer,
    },
    setup() {
        const locale = useLocaleStore();
        locale.hydrateFromHtml();
        applyHtmlLang(locale.current);
    },
});

app.use(pinia);
app.use(i18n);

app.component('LanguageSwitcher', LanguageSwitcher);
app.component('TranslatableText', TranslatableText);
app.component('DataTableContainer', DataTableContainer);

function bootstrapAdminUi() {
    if (document.getElementById('app')) {
        try {
            app.mount('#app');
        } catch (e) {
            console.error('Vue mount error', e);
        }
    }
    initFlatpickr();
    initTomSelect();
    initDeleteConfirms();
    initServerDataTables();
}

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', bootstrapAdminUi, { once: true });
} else {
    bootstrapAdminUi();
}

window.payrollHr = {
    Swal,
    initFlatpickr,
    initTomSelect,
    initDeleteConfirms,
    initServerDataTables,
};
