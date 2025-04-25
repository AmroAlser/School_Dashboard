<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;

class StudentsImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // dd(array_keys($row));
        return new Student([
            'name'                  => $row['name'],
            'gender'                => $row['gender'],
            'national_id'           => $row['national_id'],
            'birth_date'             => is_numeric($row['birth_date'])
                                        ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['birth_date'])
                                        : Carbon::parse($row['birth_date']),
            'disability'            => $row['disability'] ?? null,
            'phone'                 => $row['phone'] ?? null,
            'grade'                 => $row['grade'],
            'address'               => $row['address'] ?? null,
            'entry_date'             => is_numeric($row['entry_date'])
                                        ? \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['entry_date'])
                                        : Carbon::parse($row['entry_date']),
            'guardian_national_id' => $row['guardian_national_id'] ?? null,
            'status'                => $row['status'],
            'academic_year'         => $row['academic_year'],
            'transferred_from'      => $row['transferred_from'] ?? null,
            'transferred_to'        => $row['transferred_to'] ?? null,
        ]);
    }
}
