<template>
    <div class="card datatable-card">
        <div class="card-header d-flex flex-wrap gap-2 align-items-center">
            <h5 class="mb-0 me-auto">
                <slot name="title">{{ title }}</slot>
            </h5>
            <slot name="actions" />
        </div>
        <div class="card-body">
            <slot />
        </div>
    </div>
</template>

<script setup>
defineProps({
    title: { type: String, default: '' },
});
</script>
