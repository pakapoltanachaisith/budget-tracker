<script setup lang="ts">
import { store } from '@/actions/App/Http/Controllers/IncomeController';
import { Button } from '@/components/ui/button';
import {
    Field,
    FieldDescription,
    FieldError,
    FieldLabel,
} from '@/components/ui/field';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
    NumberField,
    NumberFieldContent,
    NumberFieldDecrement,
    NumberFieldIncrement,
} from '@/components/ui/number-field';
import NumberFieldInput from '@/components/ui/number-field/NumberFieldInput.vue';
import { Spinner } from '@/components/ui/spinner';
import MainLayout from '@/layouts/MainLayout.vue';
import { Form } from '@inertiajs/vue3';
</script>

<template>
    <MainLayout title="New Income">
        <div
            class="mx-auto max-w-2xl rounded-2xl bg-background p-6 shadow md:p-8 dark:bg-gray-900"
        >
            <h1 class="mb-6 text-xl font-medium md:mb-8">New Income Entry</h1>

            <Form :action="store()" #default="{ processing, errors }">
                <div>
                    <Field>
                        <FieldLabel for="note">Note</FieldLabel>
                        <Input
                            id="note"
                            name="note"
                            placeholder="Salary"
                            :disabled="processing"
                        />
                        <div class="flex items-center">
                            <FieldError>{{ errors?.note }}</FieldError>
                            <FieldDescription class="ml-auto">
                                (optional)
                            </FieldDescription>
                        </div>
                    </Field>
                    <NumberField
                        id="amount"
                        name="amount"
                        :defaultValue="1"
                        :formatOptions="{
                            style: 'currency',
                            currency: 'USD',
                            currencyDisplay: 'symbol',
                        }"
                        :min="0.01"
                        :step="0.01"
                        :disabled="processing"
                    >
                        <Label for="amount">Amount</Label>
                        <NumberFieldContent>
                            <NumberFieldDecrement />
                            <NumberFieldInput
                                class="font-mono font-medium"
                                autofocus
                                required
                            />
                            <NumberFieldIncrement />
                        </NumberFieldContent>
                        <div class="flex items-center">
                            <FieldError>{{ errors.amount }}</FieldError>
                            <FieldDescription class="ml-auto">
                                Minimum amount: $0.01
                            </FieldDescription>
                        </div>
                    </NumberField>
                    <Field>
                        <FieldLabel for="date">Date</FieldLabel>
                        <Input
                            id="date"
                            name="date"
                            type="date"
                            :defaultValue="
                                new Date().toISOString().split('T')[0]
                            "
                        />
                        <FieldError>{{ errors?.date }}</FieldError>
                    </Field>
                </div>
                <div class="mt-6 space-x-4 md:mt-8">
                    <Button type="submit" size="lg" :disabled="processing">
                        <Spinner v-if="processing" />
                        Create
                    </Button>
                    <Button type="reset" variant="secondary" size="lg">
                        Reset
                    </Button>
                </div>
            </Form>
        </div>
    </MainLayout>
</template>
