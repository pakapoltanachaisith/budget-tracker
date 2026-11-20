import { PlusIcon } from "lucide-react";
import { Head, Link } from "@inertiajs/react";

import IncomeItem from "@/components/incomes/income-item";
import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { create, index } from "@/routes/incomes";
import type { Income } from "@/types";

type IncomeIndexProps = {
    incomes: Income[];
};

function IncomeIndex({ incomes }: IncomeIndexProps) {
    return (
        <>
            <Head title="Incomes" />
            <div className="w-full mx-auto max-w-200 p-6 lg:p-10">
                <div className="flex items-center justify-between mb-6 lg:mb-10">
                    <h1 className="text-3xl font-bold">My Incomes</h1>
                    <Button asChild>
                        <Link href={create()}>
                            Add <PlusIcon />
                        </Link>
                    </Button>
                </div>

                <div className="space-y-6">
                    {incomes.map((income) => (
                        <IncomeItem key={income.id} data={income} />
                    ))}
                </div>
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
