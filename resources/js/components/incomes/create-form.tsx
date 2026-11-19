import { formatISO } from "date-fns";
import { Form } from "@inertiajs/react";
import { PlusIcon } from "lucide-react";

import { store } from "@/routes/incomes";
import { Label } from "@/components/ui/label";
import { Input } from "@/components/ui/input";
import InputError from "@/components/input-error";
import { Button } from "@/components/ui/button";
import { Spinner } from "@/components/ui/spinner";
import type { IncomeCategory } from "@/types";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectLabel,
    SelectTrigger,
    SelectValue,
    SelectItem,
} from "@/components/ui/select";

type CreateFormProps = {
    categories: IncomeCategory[];
};

function CreateForm({ categories }: CreateFormProps) {
    const today = formatISO(new Date(), { representation: "date" });

    return (
        <Form action={store()}>
            {({ processing, errors }) => (
                <>
                    <div className="space-y-6">
                        <div className="space-y-2">
                            <Label htmlFor="amount">Amount(THB)</Label>
                            <Input
                                id="amount"
                                name="amount"
                                type="number"
                                min={0.01}
                                step={0.01}
                                placeholder="15000"
                                autoFocus
                                required
                            />
                            <InputError message={errors.amount} />
                        </div>
                        <div className="space-y-2">
                            <Label htmlFor="note">Note</Label>
                            <Input id="note" name="note" />
                            <InputError message={errors.note} />
                        </div>
                        <div className="space-y-2">
                            <Label htmlFor="transaction_date" className="block">
                                Date
                            </Label>
                            <Input
                                id="transaction_date"
                                name="transaction_date"
                                type="date"
                                defaultValue={today}
                                max={today}
                                required
                            />
                            <InputError message={errors.transaction_date} />
                        </div>
                        <div className="space-y-2">
                            <Label htmlFor="category">Category</Label>
                            <Select name="category">
                                <SelectTrigger id="category" className="w-full">
                                    <SelectValue placeholder="Select a category" />
                                </SelectTrigger>
                                <SelectContent>
                                    <SelectGroup>
                                        <SelectLabel>
                                            Income Categories
                                        </SelectLabel>
                                        {categories.map((category) => (
                                            <SelectItem
                                                key={category}
                                                value={category}
                                                className="capitalize"
                                            >
                                                {category}
                                            </SelectItem>
                                        ))}
                                    </SelectGroup>
                                </SelectContent>
                            </Select>
                            <InputError message={errors.category} />
                        </div>
                    </div>

                    <div className="mt-8">
                        <Button type="submit" disabled={processing}>
                            Create
                            {processing ? <Spinner /> : <PlusIcon />}
                        </Button>
                    </div>
                </>
            )}
        </Form>
    );
}
export default CreateForm;
