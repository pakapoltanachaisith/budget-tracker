<?php

namespace App\Models;

use App\Enums\IncomeCategory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

#[Fillable(['amount', 'note', 'date', 'user_id', 'category'])]
class Income extends Model
{
    /** @use HasFactory<\Database\Factories\IncomeFactory> */
    use HasFactory;

    public function casts(): array
    {
        return [
            'category' => IncomeCategory::class,
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
