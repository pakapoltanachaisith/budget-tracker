import CreateForm from "@/components/incomes/create-form";
import AppLayout from "@/layouts/app-layout";
import { create, index } from "@/routes/incomes";
import { IncomeCategory } from "@/types";
import { Head } from "@inertiajs/react";

type IncomeCreateProps = {
    categories: IncomeCategory[];
};

function IncomeCreate({ categories }: IncomeCreateProps) {
    return (
        <>
            <Head title="New Income" />
            <div>
                <h1>New Income</h1>
                <CreateForm categories={categories} />
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
