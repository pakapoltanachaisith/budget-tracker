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
import CategoryIcon from "@/components/incomes/category-icon";
import IncomeItemMenu from "./income-item-menu";

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
                <IncomeItemMenu incomeId={data.id} />
            </ItemActions>
        </Item>
    );
}
