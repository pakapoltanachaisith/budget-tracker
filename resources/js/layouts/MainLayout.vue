<script setup lang="ts">
import Container from '@/components/Container.vue';
import { Head } from '@inertiajs/vue3';
import Header from './main/Header.vue';
import Navbar from './main/Navbar.vue';

defineProps<{
    title?: string;
}>();
</script>

<template>
    <Head :title="title" />

    <Header />

    <div class="h-24"></div>

    <Container as="main">
        <slot></slot>
    </Container>

    <Navbar />
</template>
