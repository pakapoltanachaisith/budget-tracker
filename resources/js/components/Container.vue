<script setup lang="ts">
withDefaults(
    defineProps<{
        as?: keyof HTMLElementTagNameMap;
    }>(),
    { as: 'div' },
);
</script>
<template>
    <component :is="as" class="mx-auto w-[95%] max-w-360">
        <slot></slot>
    </component>
</template>
