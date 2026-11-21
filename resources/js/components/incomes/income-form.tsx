import { Form } from "@inertiajs/react";
import { PlusIcon, SaveIcon } from "lucide-react";

import { store, update } from "@/routes/incomes";
import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Spinner } from "@/components/ui/spinner";
import type { Income, IncomeCategory } from "@/types";
import {
    Select,
    SelectContent,
    SelectGroup,
    SelectLabel,
    SelectTrigger,
    SelectValue,
    SelectItem,
} from "@/components/ui/select";
import {
    Field,
    FieldError,
    FieldGroup,
    FieldLabel,
    FieldSet,
} from "@/components/ui/field";
import { Textarea } from "@/components/ui/textarea";
import DatePicker from "@/components/date-picker";

type IncomeFormProps = {
    categories: IncomeCategory[];
    initialData?: Income;
};

function IncomeForm({ categories, initialData }: IncomeFormProps) {
    const submitText = initialData ? "Save Changes" : "Create";
    const SubmitIcon = initialData ? SaveIcon : PlusIcon;
    const action = initialData ? update(initialData.id) : store();

    return (
        <Form action={action}>
            {({ processing, errors }) => (
                <>
                    <FieldSet>
                        <FieldGroup>
                            <Field>
                                <FieldLabel htmlFor="amount">
                                    Amount(THB)
                                </FieldLabel>
                                <Input
                                    id="amount"
                                    name="amount"
                                    type="number"
                                    min={0.01}
                                    step={0.01}
                                    placeholder="15000"
                                    autoFocus
                                    required
                                    autoComplete="off"
                                    defaultValue={initialData?.amount}
                                />
                                <FieldError>{errors?.amount}</FieldError>
                            </Field>
                            <Field>
                                <FieldLabel htmlFor="note">Note</FieldLabel>
                                <Textarea
                                    id="note"
                                    name="note"
                                    placeholder="(Optional)"
                                    defaultValue={initialData?.note}
                                />
                                <FieldError>{errors?.note}</FieldError>
                            </Field>
                            <div className="flex flex-col lg:flex-row lg:gap-4 gap-6">
                                <Field>
                                    <FieldLabel htmlFor="transaction_date">
                                        Date
                                    </FieldLabel>
                                    <DatePicker
                                        id="transaction_date"
                                        name="transaction_date"
                                        defaultValue={
                                            initialData?.transaction_date
                                                ? new Date(
                                                      initialData.transaction_date,
                                                  )
                                                : new Date()
                                        }
                                    />
                                    <FieldError>
                                        {errors?.transaction_date}
                                    </FieldError>
                                </Field>
                                <Field>
                                    <FieldLabel htmlFor="category">
                                        Category
                                    </FieldLabel>
                                    <Select
                                        name="category"
                                        defaultValue={
                                            initialData?.category as string
                                        }
                                    >
                                        <SelectTrigger
                                            id="category"
                                            className="w-full"
                                        >
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
                                    <FieldError>{errors?.category}</FieldError>
                                </Field>
                            </div>
                        </FieldGroup>
                    </FieldSet>

                    <div className="mt-10">
                        <Button type="submit" disabled={processing}>
                            {submitText}
                            {processing ? <Spinner /> : <SubmitIcon />}
                        </Button>
                    </div>
                </>
            )}
        </Form>
    );
}
export default IncomeForm;
