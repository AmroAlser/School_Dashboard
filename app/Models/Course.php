<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'instructor',
        'participants',
        'start_date',
        'end_date'
    ];

    protected $dates = ['start_date', 'end_date'];


public function progress()
{
    $start = Carbon::parse($this->start_date);
    $end = Carbon::parse($this->end_date);
    $now = Carbon::now();

    if ($now->lessThan($start)) {
        return 0;
    }

    if ($now->greaterThanOrEqualTo($end)) {
        return 100;
    }

    $totalDays = $start->diffInDays($end);
    $passedDays = $start->diffInDays($now);

    if ($totalDays === 0) {
        return 100;
    }

    return round(($passedDays / $totalDays) * 100);
}

}
