<template>
    <component :is="tag">{{ t(translationKey) }}</component>
</template>

<script setup>
import { useI18n } from 'vue-i18n';

defineProps({
    translationKey: { type: String, required: true },
    tag: { type: String, default: 'span' },
});

const { t } = useI18n();
</script>
