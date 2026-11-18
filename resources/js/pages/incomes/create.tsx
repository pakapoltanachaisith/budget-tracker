import CreateForm from "@/components/incomes/create-form";
import AppLayout from "@/layouts/app-layout";
import { create, index } from "@/routes/incomes";
import { Head } from "@inertiajs/react";

function IncomeCreate() {
    return (
        <>
            <Head title="New Income" />
            <div>
                <h1>New Income</h1>
                <CreateForm />
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
