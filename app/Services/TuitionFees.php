<?php

namespace App\Services;

use Illuminate\Support\Collection;

/**
 * Turns tuition fee rows into comparable yearly amounts.
 *
 * The student's budget is "per year", so only fees that can be expressed per
 * year are used: yearly fees as they are, semester fees doubled. Per-course
 * and other fees have no known duration and are skipped.
 */
class TuitionFees
{
    /**
     * @param  Collection  $fees  TuitionFee rows
     * @return Collection<int, array{amount: float, currency: string}>
     */
    public static function yearly(Collection $fees): Collection
    {
        return $fees->map(function ($fee) {
            $period = $fee->fee_period ?? 'Year';

            $amount = match ($period) {
                'Year' => (float) $fee->amount,
                'Semester' => (float) $fee->amount * 2,
                default => null,
            };

            return $amount === null ? null : ['amount' => $amount, 'currency' => (string) $fee->currency];
        })->filter()->values();
    }
}
