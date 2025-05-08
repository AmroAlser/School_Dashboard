<?php

namespace App\Exports;

use App\Models\Semester;
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

class SemestersExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithTitle, ShouldAutoSize
{
    protected $semesterFilter;

    public function __construct($semesterFilter = null)
    {
        $this->semesterFilter = $semesterFilter;
    }

    public function title(): string
    {
        return 'الفصول الدراسية';
    }

    public function collection()
    {
        $query = Semester::orderBy('start_date', 'desc');

        if ($this->semesterFilter) {
            $query->where('name', 'like', '%'.$this->semesterFilter.'%')
                  ->orWhere('year', 'like', '%'.$this->semesterFilter.'%');
        }

        return $query->get();
    }

    public function map($semester): array
    {
        $status = $this->getSemesterStatus($semester);

        return [
            $semester->name,
            $semester->start_date ? Carbon::parse($semester->start_date)->format('d/m/Y') : 'غير متوفر',
            $semester->end_date ? Carbon::parse($semester->end_date)->format('d/m/Y') : 'غير متوفر',
            $semester->year,
            $status,
            $semester->created_at ? Carbon::parse($semester->created_at)->format('d/m/Y') : 'غير متوفر',
        ];
    }

    public function headings(): array
    {
        return [
            'اسم الفصل',
            'تاريخ البدء',
            'تاريخ الانتهاء',
            'السنة الدراسية',
            'الحالة',
            'تاريخ الإنشاء',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        // تنسيق رأس الجدول
        $sheet->getStyle('A1:F1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '3498db'],
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
        $sheet->getStyle('A2:F'.$sheet->getHighestRow())->applyFromArray([
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
            $status = $sheet->getCell("E{$row}")->getValue();
            $color = $this->getStatusColor($status);
            $sheet->getStyle("E{$row}")->getFont()->getColor()->setRGB($color);
        }

        // تجميد رأس الجدول
        $sheet->freezePane('A2');

        return [];
    }

    private function getSemesterStatus($semester)
    {
        $today = Carbon::today();

        if ($today->lt($semester->start_date)) {
            return 'لم يبدأ';
        } elseif ($today->gt($semester->end_date)) {
            return 'منتهي';
        } else {
            return 'جاري';
        }
    }

    private function getStatusColor($status)
    {
        switch ($status) {
            case 'جاري': return '2ecc71'; // أخضر
            case 'منتهي': return 'e74c3c'; // أحمر
            default: return 'f39c12'; // برتقالي
        }
    }

    public function columnFormats(): array
    {
        return [
            'B' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'C' => NumberFormat::FORMAT_DATE_DDMMYYYY,
            'F' => NumberFormat::FORMAT_DATE_DDMMYYYY,
        ];
    }
}
