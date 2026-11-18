export type Income = {
    id: number;
    amount: number;
    note?: string;
    transaction_date: string;
    user_id: number;
    created_at: string;
    updated_at: string;
    [key: string]: unknown;
};
