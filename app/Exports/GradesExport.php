<?php

namespace App\Exports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class GradesExport implements FromCollection, WithHeadings, WithStyles
{
    protected $semesterId;
    protected $subjectId;

    public function __construct($semesterId = null, $subjectId = null)
    {
        $this->semesterId = $semesterId;
        $this->subjectId = $subjectId;
    }

    public function collection()
    {
        // تطبيق الفلاتر إذا تم تحديدها
        $gradesQuery = Grade::with(['student', 'subject', 'class', 'semester']);

        if ($this->semesterId) {
            $gradesQuery->where('semester_id', $this->semesterId);
        }

        if ($this->subjectId) {
            $gradesQuery->where('subject_id', $this->subjectId);
        }

        return $gradesQuery->get()->map(function ($grade) {
            return [
                'student_name' => $grade->student->name,
                'student_id' => $grade->student->national_id,
                'subject_name' => $grade->subject->name,
                'class_name' => $grade->class->name,
                'semester_name' => $grade->semester->name,
                'score' => $grade->score,
                'created_at' => $grade->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'الطالب',
            'رقم الهوية',
            'المادة',
            'الصف',
            'الفصل الدراسي',
            'الدرجة',
            'التاريخ',
        ];
    }

    public function styles($sheet)
    {
        // جعل النص في رؤوس الأعمدة عريضًا ومركزيًا
        $sheet->getStyle('A1:G1')->getFont()->setBold(true);
        $sheet->getStyle('A1:G1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        return [
            // تنسيق الخلايا
            'A1:G1' => [
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
}
