<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class StudentsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Student::select([
            'id',
            'national_id',
            'name',
            'gender',
            'birth_date',
            'disability',
            'phone',
            'grade',
            'address',
            'entry_date',
            'guardian_national_id',
            'status',
            'academic_year',
            'transferred_from',
            'transferred_to'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'رقم الهوية',
            'الاسم',
            'الجنس',
            'تاريخ الميلاد',
            'الإعاقة',
            'رقم الهاتف',
            'الصف',
            'العنوان',
            'تاريخ الالتحاق',
            'رقم هوية ولي الأمر',
            'الحالة',
            'السنة الدراسية',
            'محول من',
            'محول إلى'
        ];
    }
}
