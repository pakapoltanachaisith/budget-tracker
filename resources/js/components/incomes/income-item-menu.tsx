import { EditIcon, MoreVerticalIcon, TrashIcon } from "lucide-react";
import { Link } from "@inertiajs/react";

import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { Button } from "@/components/ui/button";
import { edit } from "@/routes/incomes";

type IncomeItemMenuProps = {
    incomeId: number;
    onDelete: () => void;
};

function IncomeItemMenu({ incomeId, onDelete }: IncomeItemMenuProps) {
    return (
        <DropdownMenu>
            <DropdownMenuTrigger asChild>
                <Button variant="secondary" size="icon">
                    <span className="sr-only">action</span>
                    <MoreVerticalIcon />
                </Button>
            </DropdownMenuTrigger>
            <DropdownMenuContent>
                <DropdownMenuGroup>
                    <DropdownMenuItem asChild>
                        <Link href={edit(incomeId)}>
                            <EditIcon className="mr-2" />
                            Edit
                        </Link>
                    </DropdownMenuItem>
                    <DropdownMenuItem variant="destructive" onClick={onDelete}>
                        <TrashIcon className="mr-2" />
                        Delete
                    </DropdownMenuItem>
                </DropdownMenuGroup>
            </DropdownMenuContent>
        </DropdownMenu>
    );
}
export default IncomeItemMenu;
