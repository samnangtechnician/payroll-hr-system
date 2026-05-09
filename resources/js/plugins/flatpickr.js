import flatpickr from 'flatpickr';

export function initFlatpickr(root = document) {
    root.querySelectorAll('input.flatpickr-date:not(.fp-init)').forEach((el) => {
        flatpickr(el, {
            dateFormat: el.dataset.format || 'Y-m-d',
            altInput: false,
            allowInput: true,
        });
        el.classList.add('fp-init');
    });
    root.querySelectorAll('input.flatpickr-datetime:not(.fp-init)').forEach((el) => {
        flatpickr(el, {
            enableTime: true,
            dateFormat: el.dataset.format || 'Y-m-d H:i',
            time_24hr: true,
            allowInput: true,
        });
        el.classList.add('fp-init');
    });
    root.querySelectorAll('input.flatpickr-time:not(.fp-init)').forEach((el) => {
        flatpickr(el, {
            enableTime: true,
            noCalendar: true,
            dateFormat: el.dataset.format || 'H:i',
            time_24hr: true,
            allowInput: true,
        });
        el.classList.add('fp-init');
    });
}

window.initFlatpickr = initFlatpickr;
