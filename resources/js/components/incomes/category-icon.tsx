import { IncomeCategory } from "@/types";
import {
    BriefcaseBusiness,
    ChartCandlestick,
    Ellipsis,
    Handshake,
    Landmark,
    LucideIcon,
} from "lucide-react";

type CategoryIconProps = {
    category: IncomeCategory;
};

const iconMap: Record<IncomeCategory, LucideIcon> = {
    [IncomeCategory.Salary]: BriefcaseBusiness,
    [IncomeCategory.Business]: Handshake,
    [IncomeCategory.Interest]: Landmark,
    [IncomeCategory.Invest]: ChartCandlestick,
    [IncomeCategory.Other]: Ellipsis,
};

export default function CategoryIcon({ category }: CategoryIconProps) {
    const Icon = iconMap[category] ?? Ellipsis;
    return <Icon />;
}
