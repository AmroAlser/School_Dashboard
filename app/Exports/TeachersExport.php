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

class TeachersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithProperties, ShouldAutoSize
{
    public function collection()
    {
        return Teacher::with('subject')->get();
    }

    public function map($teacher): array
    {
        return [
            $teacher->name,
            $teacher->national_id,
            $teacher->specialization,
            $teacher->subject ? $teacher->subject->name : '—',
        ];
    }

    public function headings(): array
    {
        return [
            'الاسم',
            'رقم الهوية',
            'التخصص',
            'المادة',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setRightToLeft(true);

        $lastRow = Teacher::count() + 1; // عدد الصفوف (بما فيهم عنوان الجدول)

        return [
            1 => [ // Style for header row
                'font' => [
                    'bold' => true,
                    'size' => 14,
                    'color' => ['rgb' => 'FFFFFF'],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '198754'], // لون رأس الجدول
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
            'A2:D' . $lastRow => [ // Style for all data cells
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => '000000'],
                    ],
                ],
            ],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30, // Name
            'B' => 20, // National ID
            'C' => 25, // Specialization
            'D' => 20, // Subject
        ];
    }

    public function properties(): array
    {
        return [
            'creator' => 'School Management System',
            'title' => 'قائمة المعلمين',
            'description' => 'قائمة المعلمين المسجلين في النظام',
            'subject' => 'Teachers Information',
            'keywords' => 'teachers, school, education',
            'category' => 'School Reports',
        ];
    }
}
