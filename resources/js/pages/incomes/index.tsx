import { Button } from "@/components/ui/button";
import AppLayout from "@/layouts/app-layout";
import incomeRoutes from "@/routes/incomes";
import { Income } from "@/types";
import { Head, Link } from "@inertiajs/react";
import { PlusIcon } from "lucide-react";

type IndexProps = {
    incomes: Income[];
};

function Index({ incomes = [] }: IndexProps) {
    return (
        <>
            <Head title="Incomes" />
            <div className="h-full p-6">
                <div className="flex items-center justify-between">
                    <h1>My Incomes</h1>
                    <Button asChild>
                        <Link>
                            Add
                            <PlusIcon />
                        </Link>
                    </Button>
                </div>

                <div>
                    <ul>
                        {incomes.map((income) => (
                            <li key={income.id}>
                                {income.amount} - {income?.note}
                            </li>
                        ))}
                    </ul>
                </div>
            </div>
        </>
    );
}

Index.layout = [
    AppLayout,
    {
        breadcrumbs: [{ title: "Incomes", href: incomeRoutes.index() }],
    },
];

export default Index;
