<?php

namespace App\Exports;

use App\Models\Semester;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class SemestersExport implements FromCollection, WithHeadings
{
    protected $semesterFilter;

    // تمرير الفلاتر المطلوبة
    public function __construct($semesterFilter = null)
    {
        $this->semesterFilter = $semesterFilter;
    }

    public function collection()
    {
        // استخدم الفلاتر إذا كانت موجودة
        $query = Semester::query();

        if ($this->semesterFilter) {
            $query->where('name', 'like', '%' . $this->semesterFilter . '%');
        }

        return $query->get([
            'name', 'start_date', 'end_date', 'year'
        ]);
    }

    public function headings(): array
    {
        return [
            'اسم الفصل',
            'تاريخ البدء',
            'تاريخ الانتهاء',
            'السنة'
        ];
    }
}
