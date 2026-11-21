import { Head } from "@inertiajs/react";

import IncomeForm from "@/components/incomes/income-form";
import AppLayout from "@/layouts/app-layout";
import { create, edit, index } from "@/routes/incomes";
import { Income, IncomeCategory } from "@/types";

type IncomeEditProps = {
    categories: IncomeCategory[];
    income: Income;
};

function IncomeEdit({ categories, income }: IncomeEditProps) {
    return (
        <>
            <Head title="Edit Income" />
            <div className="w-full mx-auto max-w-200 p-6 lg:p-10">
                <h1 className="text-3xl font-bold mb-6 lg:mb-10">
                    Edit Income
                </h1>
                <IncomeForm categories={categories} initialData={income} />
            </div>
        </>
    );
}

IncomeEdit.layout = (props: IncomeEditProps) => [
    AppLayout,
    {
        breadcrumbs: [
            { title: "Incomes", href: index() },
            { title: "Edit", href: edit(props.income.id) },
        ],
    },
];

export default IncomeEdit;
