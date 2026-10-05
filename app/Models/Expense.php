<?php

namespace App\Models;

use App\Enums\ExpenseCategory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['amount', 'note', 'date', 'user_id', 'category'])]
class Expense extends Model
{
    /** @use HasFactory<\Database\Factories\ExpenseFactory> */
    use HasFactory;

    public function casts(): array
    {
        return [
            'category' => ExpenseCategory::class,
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formatDisplayDate()
    {
        return Carbon::parse($this->date)->format('d M Y');
    }
}
