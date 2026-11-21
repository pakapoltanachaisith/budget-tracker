import { Head } from "@inertiajs/react";

import IncomeForm from "@/components/incomes/income-form";
import AppLayout from "@/layouts/app-layout";
import { create, index } from "@/routes/incomes";
import { IncomeCategory } from "@/types";

type IncomeCreateProps = {
    categories: IncomeCategory[];
};

function IncomeCreate({ categories }: IncomeCreateProps) {
    return (
        <>
            <Head title="New Income" />
            <div className="w-full mx-auto max-w-200 p-6 lg:p-10">
                <h1 className="text-3xl font-bold mb-6 lg:mb-10">New Income</h1>
                <IncomeForm categories={categories} />
            </div>
        </>
    );
}

IncomeCreate.layout = [
    AppLayout,
    {
        breadcrumbs: [
            { title: "Incomes", href: index() },
            { title: "New", href: create() },
        ],
    },
];

export default IncomeCreate;
