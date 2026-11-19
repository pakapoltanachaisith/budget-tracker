import { Form } from "@inertiajs/react";
import { PlusIcon } from "lucide-react";

import { store } from "@/routes/incomes";
import { Input } from "@/components/ui/input";
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
import {
    Field,
    FieldError,
    FieldGroup,
    FieldLabel,
    FieldSet,
} from "@/components/ui/field";
import { Textarea } from "@/components/ui/textarea";
import DatePicker from "../date-picker";

type CreateFormProps = {
    categories: IncomeCategory[];
};

function CreateForm({ categories }: CreateFormProps) {
    return (
        <Form action={store()}>
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
                                />
                                <FieldError>{errors?.amount}</FieldError>
                            </Field>
                            <Field>
                                <FieldLabel htmlFor="note">Note</FieldLabel>
                                <Textarea
                                    id="note"
                                    name="note"
                                    placeholder="(Optional)"
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
                                    />
                                    <FieldError>
                                        {errors?.transaction_date}
                                    </FieldError>
                                </Field>
                                <Field>
                                    <FieldLabel htmlFor="category">
                                        Category
                                    </FieldLabel>
                                    <Select name="category">
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
