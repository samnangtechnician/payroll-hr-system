<template>
    <div class="dropdown language-switcher">
        <button
            class="btn btn-light dropdown-toggle d-flex align-items-center gap-2"
            type="button"
            data-bs-toggle="dropdown"
            aria-expanded="false"
        >
            <i class="bi bi-translate"></i>
            <span class="fw-semibold">{{ activeLabel }}</span>
        </button>
        <ul class="dropdown-menu dropdown-menu-end">
            <li v-for="loc in options" :key="loc.code">
                <button
                    type="button"
                    class="dropdown-item d-flex align-items-center gap-2"
                    :class="{ active: locale.current === loc.code }"
                    @click="select(loc.code)"
                >
                    <span class="badge text-bg-light border">{{ loc.code.toUpperCase() }}</span>
                    <span>{{ loc.label }}</span>
                </button>
            </li>
        </ul>
    </div>
</template>

<script setup>
import { computed } from 'vue';
import { useLocaleStore } from '../stores/locale';

const locale = useLocaleStore();

const options = [
    { code: 'en', label: 'English' },
    { code: 'km', label: 'ភាសាខ្មែរ' },
];

const activeLabel = computed(
    () => options.find((o) => o.code === locale.current)?.label ?? 'English'
);

function select(code) {
    locale.switch(code);
}
</script>

<style scoped>
.language-switcher .dropdown-item.active {
    background-color: rgba(13, 110, 253, 0.1);
    color: #0d6efd;
}
</style>
