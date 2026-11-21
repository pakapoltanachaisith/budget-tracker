import {
    AlertDialog,
    AlertDialogAction,
    AlertDialogCancel,
    AlertDialogContent,
    AlertDialogDescription,
    AlertDialogFooter,
    AlertDialogHeader,
    AlertDialogTitle,
} from "@/components/ui/alert-dialog";
import { ComponentProps } from "react";

type ConfirmationModalProps = {
    open: boolean;
    onCancel: () => void;
    onConfirm: () => void;
    title: string;
    description?: string;
    actionLabel?: string;
    actionVariant?: ComponentProps<typeof AlertDialogAction>["variant"];
    cancelLabel?: string;
};

export default function ConfirmationModal({
    onCancel,
    onConfirm,
    open,
    title,
    description,
    actionLabel = "Continue",
    cancelLabel = "Cancel",
    actionVariant,
}: ConfirmationModalProps) {
    return (
        <AlertDialog open={open} onOpenChange={onCancel}>
            <AlertDialogContent>
                <AlertDialogHeader>
                    <AlertDialogTitle>{title}</AlertDialogTitle>
                    {!!description && (
                        <AlertDialogDescription>
                            {description}
                        </AlertDialogDescription>
                    )}
                </AlertDialogHeader>
                <AlertDialogFooter>
                    <AlertDialogCancel onClick={onCancel}>
                        {cancelLabel}
                    </AlertDialogCancel>
                    <AlertDialogAction
                        onClick={onConfirm}
                        variant={actionVariant}
                    >
                        {actionLabel}
                    </AlertDialogAction>
                </AlertDialogFooter>
            </AlertDialogContent>
        </AlertDialog>
    );
}
