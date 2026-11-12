export type Income = {
    id: number;
    amount: number;
    note?: string;
    transaction_date: string;
    category: IncomeCategory;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};

enum IncomeCategory {
    Salary = "salary",
    Invest = "invest",
    Business = "business",
    Interest = "interest",
    ExtraIncome = "extra income",
    Other = "other",
}
