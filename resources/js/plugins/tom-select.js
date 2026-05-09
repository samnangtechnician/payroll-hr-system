import TomSelect from 'tom-select';

export function initTomSelect(root = document) {
    root.querySelectorAll('select.tom-select:not(.ts-init)').forEach((el) => {
        const remoteUrl = el.dataset.remoteUrl;

        const config = {
            create: el.dataset.allowCreate === 'true',
            allowEmptyOption: true,
            plugins: el.multiple ? ['remove_button'] : [],
            maxOptions: 1000,
        };

        if (remoteUrl) {
            config.valueField = el.dataset.valueField || 'id';
            config.labelField = el.dataset.labelField || 'text';
            config.searchField = (el.dataset.searchField || 'text').split(',').map((s) => s.trim());
            config.load = function (query, callback) {
                const url = `${remoteUrl}${remoteUrl.includes('?') ? '&' : '?'}q=${encodeURIComponent(query)}`;
                fetch(url, { headers: { Accept: 'application/json' } })
                    .then((r) => r.json())
                    .then((data) => {
                        const items = Array.isArray(data) ? data : data.results || [];
                        callback(items);
                    })
                    .catch(() => callback());
            };
            config.preload = 'focus';
        }

        new TomSelect(el, config);
        el.classList.add('ts-init');
    });
}

window.initTomSelect = initTomSelect;
