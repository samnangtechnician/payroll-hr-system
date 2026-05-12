import axios from 'axios';
import jQuery from 'jquery';
import DataTable from 'datatables.net-bs5';
import 'datatables.net-responsive-bs5';

/*
 * The Skodash backend theme ships its own jQuery + plugins (metisMenu,
 * simplebar, perfect-scrollbar, etc.) loaded via classic <script> tags
 * in `admin_partials/scripts.blade.php`. Those classic scripts execute
 * before this Vite-bundled module, so by the time we run here
 * `window.jQuery` is already the theme's jQuery, decorated with all of
 * its plugins.
 *
 * If we blindly overwrote `window.jQuery` and `window.$` with the
 * npm-bundled jQuery, the theme's `$(function () { $('#menu').metisMenu() })`
 * callback (registered with the theme jQuery but reading `$` from the
 * global at fire-time) would later see the npm jQuery instead — which
 * has no `.metisMenu`, no `.simplebar`, etc. — and crash with
 *   "$(...).metisMenu is not a function"
 *   "no element is specified to initialize PerfectScrollbar"
 *
 * Prefer the theme jQuery when present; only fall back to the bundled
 * copy on pages without the theme (e.g. the auth/login layout).
 */
const activeJQuery = window.jQuery || jQuery;
window.jQuery = activeJQuery;
window.$ = activeJQuery;

// Decorate whichever jQuery is active with DataTables so the
// `initServerDataTables()` plugin (which reads `window.jQuery.fn.dataTable`)
// works regardless of which jQuery copy ended up on `window`.
DataTable(activeJQuery);

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

const csrf = document.head.querySelector('meta[name="csrf-token"]');
if (csrf) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = csrf.content;
}
