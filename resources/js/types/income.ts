export type Income = {
    id: number;
    amount: number;
    note?: string;
    transaction_date: string;
    category: IncomeCategory | null;
    user_id: number;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};

export enum IncomeCategory {
    Salary = "salary",
    Invest = "invest",
    Business = "business",
    Interest = "interest",
    Other = "other",
}
