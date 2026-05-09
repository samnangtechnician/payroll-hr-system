import axios from 'axios';
import jQuery from 'jquery';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';

window.$ = jQuery;
window.jQuery = jQuery;
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const csrf = document.head.querySelector('meta[name="csrf-token"]');
if (csrf) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf.content;
}

DataTable(jQuery);
