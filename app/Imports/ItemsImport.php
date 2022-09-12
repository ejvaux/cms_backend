<?php

namespace App\Imports;

use App\Models\Item;
use App\Models\Category;
use App\Models\Vendor;
use App\Models\ItemType;
use App\Models\Unit;
use App\Models\ItemLocation;
use App\Models\Department;
use App\Models\Site;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\Importable;

class ItemsImport implements ToModel, WithHeadingRow, WithProgressBar
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $category = Category::where('name',$row['category'])->first();
        $vendor = Vendor::where('name',$row['vendor'])->first();
        $item_type = ItemType::where('name',$row['item_type'])->first();
        $unit = Unit::where('name',$row['unit'])->first();
        $item_location = ItemLocation::where('name',$row['item_location'])->first();
        $department = Department::where('name',$row['department'])->first();
        $site = Site::where('initial',$row['site'])->first();

        return new Item([
            'part_number' => $row['part_number'],
            'chinese_name' => $row['chinese_name'],
            'description' => $row['description'],
            'category_id' => $category? $category->id : null,
            'vendor_id' => $vendor? $vendor->id : null,
            'allocation' => $row['allocation'],
            'item_type_id' => $item_type? $item_type->id : null,
            'unit_id' => $unit? $unit->id : null,
            'item_location_id' => $item_location? $item_location->id : null,
            'min' => $row['min'],
            'max' => $row['max'],
            'lead_time' => $row['lead_time'],
            'department_id' => $department? $department->id : null,
            'site_id' => $site? $site->id : null,
            'price' => $row['price'],
            'status' => $row['status'].$myFileName,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
