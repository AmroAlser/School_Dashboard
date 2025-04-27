<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AllStudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::all(['name', 'national_id', 'phone', 'class', 'gender', 'birthdate', 'address']);
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'رقم الهوية',
            'الهاتف',
            'الصف',
            'الجنس',
            'تاريخ الميلاد',
            'العنوان'
        ];
    }
}
