<?php

namespace App\Exports;

use App\Models\Teacher;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithProperties;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Carbon\Carbon;
class TeachersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithProperties, ShouldAutoSize, WithColumnFormatting
{
    public function collection()
    {
        return Teacher::with(['subject'])->get();
    }

    public function map($teacher): array
    {
        return [
            $teacher->name,
            $teacher->national_id,
            $teacher->job_number ?? '—',
            $teacher->specialization,
            $teacher->subject ? $teacher->subject->name : '—',
            $teacher->tasks ?? '—',
            $teacher->task_date ? \Carbon\Carbon::parse($teacher->task_date)->format('Y-m-d') : '—',
            $teacher->created_at->format('Y-m-d H:i'),
            $teacher->updated_at->format('Y-m-d H:i'),
        ];
    }

    public function headings(): array
    {
        return [
            'الاسم الكامل',
            'رقم الهوية',
            'الرقم الوظيفي',
            'التخصص',
            'المادة الدراسية',
            'المهام المكلف بها',
            'تاريخ المهمة',
            'تاريخ التسجيل',
            'تاريخ آخر تحديث',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setRightToLeft(true);

        $lastRow = Teacher::count() + 1;

        return [
            1 => [
                'font' => [
                    'bold' => true,
                    'size' => 12,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '198754'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                    'wrapText' => true,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'FFFFFF'],
                    ],
                ],
            ],
            'A2:I' . $lastRow => [
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'DDDDDD'],
                    ],
                ],
            ],
            'B2:B' . $lastRow => [
                'numberFormat' => [
                    'formatCode' => NumberFormat::FORMAT_TEXT,
                ],
            ],
            'C2:C' . $lastRow => [
                'numberFormat' => [
                    'formatCode' => NumberFormat::FORMAT_TEXT,
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 25, // الاسم الكامل
            'B' => 15, // رقم الهوية
            'C' => 15, // الرقم الوظيفي
            'D' => 20, // التخصص
            'E' => 20, // المادة الدراسية
            'F' => 30, // المهام المكلف بها
            'G' => 15, // تاريخ المهمة
            'H' => 18, // تاريخ التسجيل
            'I' => 18, // تاريخ آخر تحديث
        ];
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function properties(): array
    {
        return [
            'creator' => 'نظام إدارة المدرسة',
            'title' => 'تصدير بيانات المعلمين',
            'description' => 'بيانات كاملة لجميع المعلمين المسجلين في النظام',
            'subject' => 'بيانات المعلمين',
            'keywords' => 'معلمين, مدرسة, تعليم',
            'category' => 'التقارير المدرسية',
            'company' => 'المدرسة الهلال الخاصة',
        ];
    }
}
