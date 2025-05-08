<?php

namespace App\Exports;

use App\Models\Student;
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
use Carbon\Carbon;

class StudentsExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    public function title(): string
    {
        return 'سجل الطلاب';
    }

    public function collection()
    {
        return Student::with(['class', 'semester'])
            ->orderBy('class_id')
            ->orderBy('name')
            ->get();
    }

    public function map($student): array
    {
        return [
            $student->name,
            $student->national_id,
            $this->formatGender($student->gender),
            $student->birth_date ? Carbon::parse($student->birth_date)->format('d/m/Y') : 'غير متوفر',
            $student->class ? $student->class->name : 'غير محدد',
            $student->semester ? $student->semester->name : 'غير محدد',
            $student->academic_year,
            $this->formatStatus($student->status),
            $student->phone ?: 'غير متوفر',
            $student->address ?: 'غير متوفر',
            $student->disability ?: 'لا يوجد',
            $student->guardian_national_id ?: 'غير متوفر',
            $student->entry_date ? Carbon::parse($student->entry_date)->format('d/m/Y') : 'غير متوفر',
        ];
    }

    public function headings(): array
    {
        return [
            'اسم الطالب',
            'رقم الهوية',
            'الجنس',
            'تاريخ الميلاد',
            'الصف الدراسي',
            'الفصل الدراسي',
            'السنة الدراسية',
            'الحالة',
            'رقم الجوال',
            'العنوان',
            'الإعاقة',
            'هوية ولي الأمر',
            'تاريخ التسجيل',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // تنسيق رأس الجدول
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '9b59b6'],
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
        $sheet->getStyle('A2:M'.$sheet->getHighestRow())->applyFromArray([
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

        // تلوين الحالة
        $highestRow = $sheet->getHighestRow();
        for ($row = 2; $row <= $highestRow; $row++) {
            $status = $sheet->getCell("H{$row}")->getValue();
            $color = $this->getStatusColor($status);
            $sheet->getStyle("H{$row}")->getFont()->getColor()->setRGB($color);
        }

        // تجميد رأس الجدول
        $sheet->freezePane('A2');

        return [];
    }

    private function formatGender($gender)
    {
        return $gender === 'ذكر' ? 'ذكر' : 'أنثى';
    }

    private function formatStatus($status)
    {
        return $status === 'مواطن' ? 'مواطن' : 'لاجئ';
    }

    private function getStatusColor($status)
    {
        return $status === 'مواطن' ? '2ecc71' : 'e74c3c';
    }

    public function columnFormats(): array
    {
        return [
            'D' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'M' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
