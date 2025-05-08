<?php

namespace App\Exports;

use App\Models\Student;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithDrawings;

class AllStudentsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    WithStyles,
    WithTitle,
    ShouldAutoSize,
    WithDrawings
{
    public function collection()
    {
        return Student::with(['class', 'semester'])
            ->orderBy('class_id')
            ->orderBy('name')
            ->get();
    }

    public function map($student): array
    {
        static $index = 1;

        return [
            $index++,
            $student->name,
            $student->national_id,
            $student->class->name ?? 'غير محدد',
            $student->semester->name ?? 'غير محدد',
            $this->formatGender($student->gender),
            $this->formatDate($student->birth_date),
            $student->phone ?? 'غير متوفر',
            $student->address ?? 'غير متوفر',
            $student->disability ?? 'لا يوجد',
            $student->guardian_national_id ?? 'غير متوفر',
            $this->formatStatus($student->status),
            $student->academic_year,
            $student->transferred_from ?? 'لا ينطبق',
            $student->transferred_to ?? '*',
            $this->formatDate($student->entry_date),
            '', // سيتم استبدالها بالصورة عبر WithDrawings
        ];
    }

    public function headings(): array
    {
        return [
            'الرقم التسلسلي',
            'اسم الطالب',
            'رقم الهوية الوطنية',
            'الصف الدراسي',
            'الفصل الحالي',
            'الجنس',
            'تاريخ الميلاد',
            'رقم الجوال',
            'عنوان السكن',
            'الإعاقة',
            'هوية ولي الأمر',
            'الحالة الاجتماعية',
            'السنة الدراسية',
            'منقول من',
            'منقول إلى',
            'تاريخ التسجيل',
            'صورة التقرير',
        ];
    }

    public function title(): string
    {
        return 'قائمة الطلاب';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->setRightToLeft(true);

        $highestRow = $sheet->getHighestRow();
        $highestColumn = 'Q';

        // Header style
        $sheet->getStyle("A1:{$highestColumn}1")->applyFromArray([
            'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
            'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '3498db']],
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Data rows style
        $sheet->getStyle("A2:{$highestColumn}{$highestRow}")->applyFromArray([
            'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'DDDDDD']]],
            'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
        ]);

        // Alternate row color
        for ($row = 2; $row <= $highestRow; $row++) {
            if ($row % 2 == 0) {
                $sheet->getStyle("A{$row}:{$highestColumn}{$row}")->applyFromArray([
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => 'F2F2F2']],
                ]);
            }
        }

        $sheet->freezePane('A2');
    }

    public function drawings()
    {
        $drawings = [];
        $students = $this->collection();

        foreach ($students as $index => $student) {
            if (!empty($student->report_image)) {
                $path = public_path($student->report_image);
                if (file_exists($path)) {
                    $drawing = new Drawing();
                    $drawing->setName('Report Image');
                    $drawing->setDescription('Report Image');
                    $drawing->setPath($path);
                    $drawing->setCoordinates('Q' . ($index + 2)); // Q = العمود 17
                    $drawing->setHeight(100);
                    $drawing->setWidth(100);
                    $drawings[] = $drawing;
                }
            }
        }

        return $drawings;
    }

    private function formatGender(?string $gender): string
    {
        return $gender === 'ذكر' ? 'ذكر' : ($gender === 'أنثى' ? 'أنثى' : 'غير محدد');
    }

    private function formatStatus(?string $status): string
    {
        return $status === 'مواطن' ? 'مواطن' : ($status === 'لاجئ' ? 'لاجئ' : 'غير محدد');
    }

    private function formatDate(?string $date): string
    {
        try {
            return $date ? Carbon::parse($date)->format('d/m/Y') : 'غير محدد';
        } catch (\Exception $e) {
            return 'تاريخ غير صالح';
        }
    }
}
