<script setup lang="ts">
import { MonthlyIncome } from '@/types';
import {
    BarElement,
    CategoryScale,
    ChartData,
    Chart as ChartJS,
    ChartOptions,
    Colors,
    Legend,
    LinearScale,
    Title,
    Tooltip,
} from 'chart.js';
import { Bar } from 'vue-chartjs';

ChartJS.register(
    Title,
    Tooltip,
    Legend,
    BarElement,
    CategoryScale,
    LinearScale,
    Colors,
);

const props = defineProps<{
    monthlyIncomes: MonthlyIncome[];
}>();

const chartData = {
    labels: props.monthlyIncomes.map((item) => item.month_name),
    datasets: [
        {
            label: 'USD',
            data: props.monthlyIncomes.map((item) => item.total / 100),
        },
    ],
} satisfies ChartData;

const chartOptions = {
    responsive: true,
    scales: {
        y: {
            ticks: {
                callback: (value, index, ticks) => {
                    const formatter = new Intl.NumberFormat('en', {
                        notation: 'compact',
                        compactDisplay: 'short',
                        maximumFractionDigits: 1,
                    });

                    return formatter.format(+value);
                },
            },
        },
    },
} satisfies ChartOptions;
</script>

<template>
    <div>
        <Bar :data="chartData" :options="chartOptions" />
    </div>
</template>
