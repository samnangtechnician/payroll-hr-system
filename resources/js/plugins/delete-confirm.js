import Swal from 'sweetalert2';

export function initDeleteConfirms(root = document) {
    root.addEventListener('click', handleClick, false);
}

function handleClick(event) {
    const trigger = event.target.closest('[data-confirm-delete]');
    if (!trigger) return;

    event.preventDefault();
    event.stopPropagation();

    const url = trigger.dataset.url || trigger.getAttribute('href');
    const method = (trigger.dataset.method || 'DELETE').toUpperCase();
    const csrfToken =
        document.head.querySelector('meta[name="csrf-token"]')?.content || '';
    const itemLabel = trigger.dataset.itemLabel || trigger.textContent.trim() || 'this record';
    const lang = document.documentElement.getAttribute('lang') || 'en';

    const dict = {
        en: {
            title: 'Delete confirmation',
            text: `Are you sure you want to delete ${itemLabel}? This action cannot be undone.`,
            confirm: 'Yes, delete it',
            cancel: 'Cancel',
            success: 'Deleted successfully',
            error: 'Could not delete the record. Please try again.',
        },
        km: {
            title: 'បញ្ជាក់​ការ​លុប',
            text: `តើ​អ្នក​ពិត​ជា​ចង់​លុប ${itemLabel} ឬ​ទេ? សកម្មភាព​នេះ​មិន​អាច​ត្រឡប់​វិញ​បានទេ។`,
            confirm: 'យល់ព្រម លុប',
            cancel: 'បោះបង់',
            success: 'លុប​បាន​ជោគជ័យ',
            error: 'មិន​អាច​លុប​បាន​ទេ។ សូម​ព្យាយាម​ម្តង​ទៀត។',
        },
    };
    const t = dict[lang] || dict.en;

    Swal.fire({
        title: t.title,
        text: t.text,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: t.confirm,
        cancelButtonText: t.cancel,
        confirmButtonColor: '#dc3545',
        cancelButtonColor: '#6c757d',
        reverseButtons: true,
    }).then((result) => {
        if (!result.isConfirmed) return;
        submitForm(url, method, csrfToken, t);
    });
}

function submitForm(url, method, csrfToken, t) {
    const form = document.createElement('form');
    form.action = url;
    form.method = 'POST';
    form.style.display = 'none';

    const csrfInput = document.createElement('input');
    csrfInput.type = 'hidden';
    csrfInput.name = '_token';
    csrfInput.value = csrfToken;
    form.appendChild(csrfInput);

    if (method !== 'POST' && method !== 'GET') {
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = method;
        form.appendChild(methodInput);
    }

    document.body.appendChild(form);
    form.submit();
}

window.initDeleteConfirms = initDeleteConfirms;
