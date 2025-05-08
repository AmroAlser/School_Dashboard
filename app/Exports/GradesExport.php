<?php

namespace App\Exports;

use App\Models\Grade;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class GradesExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    protected $semesterId;
    protected $subjectId;

    public function __construct($semesterId = null, $subjectId = null)
    {
        $this->semesterId = $semesterId;
        $this->subjectId = $subjectId;
    }

    public function title(): string
    {
        return 'سجل الدرجات';
    }

    public function collection()
    {
        $query = Grade::with(['student', 'subject', 'class', 'semester'])
            ->orderBy('class_id')
            ->orderBy('subject_id')
            ->orderBy('student_id');

        if ($this->semesterId) {
            $query->where('semester_id', $this->semesterId);
        }

        if ($this->subjectId) {
            $query->where('subject_id', $this->subjectId);
        }

        return $query->get();
    }

    public function map($grade): array
    {
        return [
            $grade->student->name,
            $grade->student->national_id,
            $grade->subject->name,
            $grade->class->name,
            $grade->semester->name,
            $grade->score,
            $grade->created_at->format('d/m/Y'),
        ];
    }

    public function headings(): array
    {
        return [
            'اسم الطالب',
            'رقم الهوية',
            'المادة الدراسية',
            'الصف الدراسي',
            'الفصل الدراسي',
            'الدرجة',
            'تاريخ التسجيل',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // تنسيق رأس الجدول
        $sheet->getStyle('A1:G1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '2c3e50'],
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '000000'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // تنسيق خلايا البيانات
        $sheet->getStyle('A2:G'.$sheet->getHighestRow())->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'DDDDDD'],
                ],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // تلوين الدرجات
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $score = $sheet->getCell("F{$row}")->getValue();
            $color = $this->getScoreColor($score);
            $sheet->getStyle("F{$row}")->getFont()->getColor()->setRGB($color);
        }

        // تجميد رأس الجدول
        $sheet->freezePane('A2');

        return [];
    }

    private function getScoreColor($score)
    {
        if ($score >= 90) return '2ecc71'; // أخضر
        if ($score >= 70) return 'f39c12'; // برتقالي
        return 'e74c3c'; // أحمر
    }

    public function columnFormats(): array
    {
        return [
            'G' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
