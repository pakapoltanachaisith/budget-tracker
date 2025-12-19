<script setup lang="ts">
import Container from '@/components/Container.vue';
import HeaderLogo from './HeaderLogo.vue';
import HeaderMenu from './HeaderMenu.vue';
import ThemeSelector from './ThemeSelector.vue';
</script>

<template>
    <header class="fixed inset-x-0 top-0 border-b bg-background">
        <Container class="flex items-center justify-between py-4">
            <!-- left -->
            <div>
                <HeaderLogo />
            </div>

            <!-- right -->
            <div class="flex items-center">
                <ThemeSelector />
                <HeaderMenu />
            </div>
        </Container>
    </header>
</template>
