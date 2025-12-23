<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3';
import { ArrowRightLeftIcon, HomeIcon, PiggyBankIcon } from 'lucide-vue-next';

const page = usePage();

const links = [
    {
        label: 'Incomes',
        href: '/incomes',
        icon: PiggyBankIcon,
        active: page.url.startsWith('/incomes'),
    },
    {
        label: 'Home',
        href: '/',
        icon: HomeIcon,
        active: page.url === '/',
    },
    {
        label: 'Expenses',
        href: '/expenses',
        icon: ArrowRightLeftIcon,
        active: page.url.startsWith('/expenses'),
    },
];
</script>

<template>
    <div class="fixed inset-x-0 bottom-0 z-10 md:pb-6">
        <nav
            class="mx-auto grid w-full grid-cols-3 overflow-hidden bg-white shadow transition duration-300 md:w-1/3 md:max-w-[300px] md:rounded-xl dark:bg-gray-900"
        >
            <Link
                v-for="link in links"
                :key="link.href"
                :href="link.href"
                class="grid place-content-center border border-x border-gray-200 py-2 text-muted-foreground first:border-transparent last:border-transparent hover:bg-primary/10 hover:text-primary dark:border-gray-800"
                :class="{
                    'bg-primary/10 text-primary': link.active,
                }"
            >
                <div>
                    <component :is="link.icon" class="mx-auto size-4" />
                    <span class="mt-2 font-mono text-xs">
                        {{ link.label }}
                    </span>
                </div>
            </Link>
        </nav>
    </div>
</template>
