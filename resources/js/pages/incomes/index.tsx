import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { create, index } from "@/routes/incomes";
import { Income } from "@/types";
import { Head, Link } from "@inertiajs/react";

type IncomeIndexProps = {
    incomes: Income[];
};

function IncomeIndex({ incomes }: IncomeIndexProps) {
    return (
        <>
            <Head title="Incomes" />
            <div>
                <div>
                    <h1>My Incomes</h1>
                    <Button asChild>
                        <Link href={create()}>Add</Link>
                    </Button>
                </div>
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
