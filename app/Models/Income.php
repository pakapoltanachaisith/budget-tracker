<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Facades\DB;

class Income extends Model
{
    use HasFactory;

    protected $fillable = ['amount', 'note', 'date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    #[Scope]
    protected function monthlyTotalForYear(Builder $query, ?int $year = null)
    {
        $year ??= now()->year;

        $monthsTable = DB::raw('(
            SELECT 1 AS month UNION SELECT 2 UNION SELECT 3 UNION SELECT 4
            UNION SELECT 5 UNION SELECT 6 UNION SELECT 7 UNION SELECT 8
            UNION SELECT 9 UNION SELECT 10 UNION SELECT 11 UNION SELECT 12
        ) months');

        return $query
            ->from($monthsTable)
            ->leftJoin('incomes', function (JoinClause $join) use ($year) {
                $join->on(DB::raw('MONTH(incomes.date)'), '=', 'months.month')
                    ->whereYear('incomes.date', $year);
            })
            ->selectRaw("
                months.month,
                COALESCE(SUM(incomes.amount), 0) AS total,
                DATE_FORMAT(
                    STR_TO_DATE(CONCAT(?, '-', months.month, '-01'), '%Y-%m-%d'),
                    '%M'
                ) as month_name
            ", [$year])
            ->groupBy('months.month')
            ->orderBy('months.month');
    }
}
