import { format, formatISO } from "date-fns";
import { useState } from "react";

import { Button } from "@/components/ui/button";
import {
    Popover,
    PopoverContent,
    PopoverTrigger,
} from "@/components/ui/popover";
import { Calendar } from "@/components/ui/calendar";

type DatePickerProps = {
    defaultValue?: Date;
    id?: string;
    name?: string;
};

export default function DatePicker({
    defaultValue = new Date(),
    id,
    name,
}: DatePickerProps) {
    const [date, setDate] = useState<Date>(defaultValue);

    return (
        <>
            <Popover>
                <PopoverTrigger asChild>
                    <Button
                        variant="outline"
                        id={id}
                        className="justify-start font-normal"
                    >
                        {date ? format(date, "PPP") : <span>Pick a date</span>}
                    </Button>
                </PopoverTrigger>
                <PopoverContent className="w-auto p-0" align="start">
                    <Calendar
                        mode="single"
                        selected={date}
                        onSelect={setDate}
                        defaultMonth={date}
                        disabled={{ after: new Date() }}
                        required
                    />
                </PopoverContent>
            </Popover>
            <input
                type="hidden"
                name={name}
                value={formatISO(date, { representation: "date" })}
            />
        </>
    );
}
