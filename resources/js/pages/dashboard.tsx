import { Head } from "@inertiajs/react";
import { dashboard } from "@/routes";

export default function Dashboard() {
    return (
        <>
            <Head title="Dashboard" />
            <div className="h-full p-4">
                <h1>Dashboard</h1>
            </div>
        </>
    );
}

Dashboard.layout = {
    breadcrumbs: [
        {
            title: "Dashboard",
            href: dashboard(),
        },
    ],
};
