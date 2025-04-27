<?php

namespace App\Exports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class StudentsExport implements FromCollection, WithHeadings, WithStyles, WithColumnFormatting
{
    /**
    * استرجاع البيانات التي سيتم تصديرها.
    *
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // تحميل العلاقات مع الصف والفصل الدراسي للحصول على الأسماء
        return Student::with(['class', 'semester'])
            ->get()
            ->map(function ($student) {
                return [
                    'name' => $student->name,
                    'national_id' => $student->national_id,
                    'gender' => $student->gender,
                    'birth_date' => $student->birth_date,
                    'class' => $student->class ? $student->class->name : 'غير محدد', // استرجاع اسم الصف
                    'semester' => $student->semester ? $student->semester->name : 'غير محدد', // استرجاع اسم الفصل الدراسي
                    'academic_year' => $student->academic_year,
                    'status' => $student->status,
                ];
            });
    }

    /**
     * إضافة رؤوس الأعمدة
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'الاسم',
            'رقم الهوية',
            'الجنس',
            'تاريخ الميلاد',
            'الصف',
            'الفصل الدراسي',
            'السنة الدراسية',
            'الحالة',
        ];
    }

    /**
     * تخصيص تنسيق الأعمدة
     *
     * @return array
     */
    public function styles($sheet)
    {
        // جعل النص في رؤوس الأعمدة عريضًا ومركزيًا
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);
        $sheet->getStyle('A1:H1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // إضافة تنسيق للصفوف
        $sheet->getStyle('A2:H' . $sheet->getHighestRow())
              ->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [
            // تنسيق الخلايا
            'A1:H1' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
                'font' => [
                    'bold' => true,
                ],
            ],
        ];
    }

    /**
     * تنسيق بعض الأعمدة
     *
     * @return array
     */
    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY, // تنسيق التاريخ
        ];
    }
}
