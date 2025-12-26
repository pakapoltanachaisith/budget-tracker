<script setup lang="ts">
import MainLayout from '@/layouts/MainLayout.vue';
import { create } from '@/routes/incomes';
import { Link } from '@inertiajs/vue3';

const props = defineProps<{
    monthlyIncome: {
        month: number;
        month_name: string;
        total: number;
    }[];
}>();

console.log(props.monthlyIncome);
</script>

<template>
    <MainLayout title="Incomes">
        <h1>Incomes Page</h1>
        <Link :href="create()">New Income</Link>
    </MainLayout>
</template>
