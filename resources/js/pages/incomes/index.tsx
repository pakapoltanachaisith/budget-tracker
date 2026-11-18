import AppLayout from "@/layouts/app-layout";
import { index } from "@/routes/incomes";
import { Income } from "@/types";
import { Head } from "@inertiajs/react";

type IncomeIndexProps = {
    incomes: Income[];
};

function IncomeIndex({ incomes }: IncomeIndexProps) {
    return (
        <>
            <Head title="Incomes" />
            <div>
                <h1>My Incomes</h1>
                <ul>
                    {incomes.map((income) => (
                        <li key={income.id}>
                            {income.amount} - {income.note} -
                            {income.transaction_date}
                        </li>
                    ))}
                </ul>
            </div>
        </>
    );
}

IncomeIndex.layout = [
    AppLayout,
    {
        breadcrumbs: [{ title: "Incomes", href: index() }],
    },
];

export default IncomeIndex;
