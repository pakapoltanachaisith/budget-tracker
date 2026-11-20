import { MoreVerticalIcon, WalletIcon } from "lucide-react";

import { Income } from "@/types";
import {
    Item,
    ItemActions,
    ItemContent,
    ItemDescription,
    ItemMedia,
    ItemTitle,
} from "@/components/ui/item";
import { formatTHB, formatTransactionDate } from "@/lib/utils";
import { Button } from "@/components/ui/button";
import CategoryIcon from "./category-icon";

type IncomeItemProps = {
    data: Income;
};

export default function IncomeItem({ data }: IncomeItemProps) {
    return (
        <Item variant="muted">
            {data.categery !== null && (
                <ItemMedia variant="icon">
                    <CategoryIcon category={data.category!} />
                </ItemMedia>
            )}
            <ItemContent>
                <ItemTitle className="text-lg">
                    {formatTHB(data.amount)}
                </ItemTitle>
                <ItemDescription>
                    <time dateTime={data.transaction_date} className="block">
                        {formatTransactionDate(data.transaction_date)}
                    </time>
                    {data?.note && (
                        <span className="text-sm mt-3">{data.note}</span>
                    )}
                </ItemDescription>
            </ItemContent>
            <ItemActions>
                <Button variant="secondary" size="icon">
                    <span className="sr-only">action</span>
                    <MoreVerticalIcon />
                </Button>
            </ItemActions>
        </Item>
    );
}
