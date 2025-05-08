<?php

namespace App\Models;
use Carbon\Carbon; // فوق في موديل Semester

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'year', 'start_date', 'end_date'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];


    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
    public function students()
    {
        return $this->hasMany(Student::class);
    }
    public function classes()
    {
        return $this->hasMany(SchoolClass::class);
    }

    // تعريف علاقة الفصل الدراسي مع الدرجات

    public function getProgressPercentage()
    {
        if ($this->students_count == 0) {
            return 0;
        }

        // مثلا تفترض انه كل فصل كامل 100 طالب
        return round(($this->students_count / 100) * 100, 2); // نسبة مئوية
    }

    public function getRemainingDays()
    {
        if (!$this->end_date) {
            return null; // لو ما في تاريخ انتهاء
        }

        $today = Carbon::today();
        $endDate = $this->end_date; // سيتم تحويلها تلقائيًا إلى Carbon
        $remainingDays = $today->diffInDays($endDate, false); // false علشان يعطيك رقم سالب لو انتهى الفصل

        return $remainingDays >= 0 ? $remainingDays : 0; // لو الفصل منتهي، نرجع صفر
    }
    public function isActive()
    {
        $today = Carbon::now();
        return $today->betweenIncluded($this->start_date, $this->end_date); // سيتم تحويلهما تلقائيًا إلى Carbon
    }

    public function progress()
    {
        $startDate = $this->start_date; // سيتم تحويلها تلقائيًا إلى Carbon
        $endDate = $this->end_date;   // سيتم تحويلها تلقائيًا إلى Carbon
        $today = Carbon::now();

        if ($today < $startDate) {
            return 0; // لم يبدأ الفصل بعد
        }

        if ($today > $endDate) {
            return 100; // انتهى الفصل
        }

        $totalDays = $endDate->diffInDays($startDate);
        $elapsedDays = $today->diffInDays($startDate);

        if ($totalDays == 0) {
            return 0; // لتجنب القسمة على صفر إذا كان تاريخ البدء والانتهاء متطابقين
        }

        return round(($elapsedDays / $totalDays) * 100);
    }
}
