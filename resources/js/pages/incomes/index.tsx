import { useState } from "react";
import { PlusIcon } from "lucide-react";
import { Head, Link, router } from "@inertiajs/react";
import { toast } from "sonner";

import type { Income } from "@/types";
import IncomeItem from "@/components/incomes/income-item";
import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import { create, index } from "@/routes/incomes";
import ConfirmationModal from "@/components/confirmation-modal";
import { destroy } from "@/actions/App/Http/Controllers/IncomeController";

type IncomeIndexProps = {
    incomes: Income[];
};

function IncomeIndex({ incomes }: IncomeIndexProps) {
    const [deletingId, setDeletingId] = useState<number | null>(null);

    const deleteIncome = () => {
        if (!deletingId) return;
        router.delete(destroy(deletingId), {
            preserveScroll: true,
            onSuccess: () =>
                toast.success("New income record deleted successfully!"),
            onError: () =>
                toast.error("Something went wrong. Please try again later."),
        });
    };

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
                        <IncomeItem
                            key={income.id}
                            data={income}
                            onDelete={(id) => setDeletingId(id)}
                        />
                    ))}
                </div>
            </div>

            <ConfirmationModal
                open={!!deletingId}
                onCancel={() => setDeletingId(null)}
                title="Do you want to delete this income?"
                description="This action cannot be undone. This will permanently delete your income record
        from our servers."
                onConfirm={deleteIncome}
                actionVariant="destructive"
            />
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
