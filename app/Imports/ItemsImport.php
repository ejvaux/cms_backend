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
use App\Models\ItemGroup;
use App\Models\TransactionItem;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\WithProgressBar;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\OnEachRow;

class ItemsImport implements ToModel, WithHeadingRow, WithProgressBar, OnEachRow
{
    use Importable;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $group = ItemGroup::where('name',$row['group'])->first();
        $category = Category::where('name',$row['category'])->first();
        $vendor = Vendor::where('name',$row['vendor'])->first();
        $item_type = $row['item_type']? ItemType::firstOrCreate(['name' => $row['item_type']]) : null;
        $unit = Unit::where('name',$row['unit'])->first();
        $item_location = $row['item_location']? ItemLocation::firstOrCreate(['name' => $row['item_location']]) : null;
        $department = Department::where('name',$row['department'])->first();
        $site = Site::where('initial',$row['site'])->first();

        return new Item([
            'part_number' => $row['part_number'],
            'chinese_name' => $row['chinese_name'],
            'description' => $row['description'],
            'group_id' => $group->id,
            'category_id' => $row['category']? $category->id : null,
            'vendor_id' => $row['vendor']? $vendor->id : null,
            'allocation' => $row['allocation'],
            'item_type_id' => $item_type? $item_type->id : null,
            'unit_id' => $unit->id,
            'item_location_id' => $item_location? $item_location->id : null,
            'min' => $row['min']? $row['min'] : 0,
            'max' => $row['max'],
            'lead_time' => $row['lead_time'],
            'department_id' => $department->id,
            'site_id' => $site->id,
            'price' => $row['price'],
            'status' => $row['status'],
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }

    public function onRow(Row $row)
    {
        $row = $row->toArray();

        if($row['stocks'] > 0){
            //Get department
            $department = Department::where('name',$row['department'])->first();

            //Get site
            $site = Site::where('initial',$row['site'])->first();

            //Get item
            $item = Item::where('part_number',$row['part_number'])->where('department_id',$department->id)->where('site_id',$site->id)->first();

            //Insert to transaction item
            $ti = new TransactionItem;
            $ti->transaction_id = 1;
            $ti->item_id = $item->id;
            $ti->quantity = $row['stocks'];
            $ti->remarks = 'Initial data';
            $ti->save();
        }
    }
}
