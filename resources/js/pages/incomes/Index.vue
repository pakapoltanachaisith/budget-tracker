<script setup lang="ts">
import MonthlyIncomeChart from '@/components/incomes/MonthlyIncomeChart.vue';
import MainLayout from '@/layouts/MainLayout.vue';
import { create } from '@/routes/incomes';
import { MonthlyIncome } from '@/types';
import { Link } from '@inertiajs/vue3';

defineProps<{
    monthlyIncomes: MonthlyIncome[];
}>();
</script>

<template>
    <MainLayout title="Incomes">
        <h1>Incomes Page</h1>
        <div>
            <MonthlyIncomeChart :monthlyIncomes="monthlyIncomes" />
        </div>
        <Link :href="create()">New Income</Link>
    </MainLayout>
</template>
