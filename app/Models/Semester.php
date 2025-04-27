<?php

namespace App\Models;
use Carbon\Carbon; // فوق في موديل Semester

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'year', 'start_date', 'end_date'];

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
        $endDate = Carbon::parse($this->end_date);

        $remainingDays = $today->diffInDays($endDate, false); // false علشان يعطيك رقم سالب لو انتهى الفصل

        return $remainingDays >= 0 ? $remainingDays : 0; // لو الفصل منتهي، نرجع صفر
    }

}
