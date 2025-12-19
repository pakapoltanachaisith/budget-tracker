<script setup lang="ts">
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { useAppearance } from '@/composables/useAppearance';
import { ChevronDown, Monitor, Moon, Sun } from 'lucide-vue-next';

const { appearance, updateAppearance } = useAppearance();

const themes = [
    { value: 'light', Icon: Sun, label: 'Light' },
    { value: 'dark', Icon: Moon, label: 'Dark' },
    { value: 'system', Icon: Monitor, label: 'System' },
] as const;
</script>

<template>
    <DropdownMenu v-slot="{ open }">
        <DropdownMenuTrigger asChild>
            <Button variant="ghost">
                <component
                    :is="
                        themes.find((theme) => theme.value === appearance)?.Icon
                    "
                    class="size-5"
                />
                <span class="sr-only">select theme</span>
                <ChevronDown
                    class="text-muted-foreground transition-all"
                    :class="{
                        'rotate-180': open,
                    }"
                />
            </Button>
        </DropdownMenuTrigger>
        <DropdownMenuContent>
            <DropdownMenuLabel>Themes</DropdownMenuLabel>
            <DropdownMenuSeparator />
            <DropdownMenuItem
                v-for="{ Icon, label, value } in themes"
                :key="value"
                @click="updateAppearance(value)"
            >
                <component :is="Icon" class="mr-2" />
                {{ label }}
            </DropdownMenuItem>
        </DropdownMenuContent>
    </DropdownMenu>
</template>
