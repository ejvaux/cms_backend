<?php

namespace App\Imports;

use App\Models\Requestor;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Row;
use Illuminate\Support\Facades\Storage;

class RequestorsImport implements ToModel, WithHeadingRow, WithProgressBar
{

    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Requestor([
            'employee_number' => $row['employee_number'],
            'name' => $row['name'],
            'code' => md5($row['name']),
        ]);
    }
}
