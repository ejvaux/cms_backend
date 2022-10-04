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
use App\Models\ItemStatus;
use App\Models\Allocation;

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
use Illuminate\Support\Facades\Storage;

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
        $image_exts = array('.jpg','.png');
        $img_binary = null;

        $group = ItemGroup::where('name',$row['group'])->first();
        $category = $row['category']? Category::firstOrCreate(['name'=> $row['category']]) : null;
        $vendor = Vendor::where('name',$row['vendor'])->first();
        $item_type = $row['item_type']? ItemType::firstOrCreate(['name' => $row['item_type']]) : null;
        $unit = Unit::where('name',$row['unit'])->first();
        $item_location = $row['item_location']? ItemLocation::firstOrCreate(['name' => $row['item_location']]) : null;
        $status = $row['status']? ItemStatus::where('name' , $row['status'])->first()->id : null;
        $department = Department::where('name',$row['department'])->first();
        $site = Site::where('initial',$row['site'])->first();
        $allocations = $row['allocation']? explode(",",$row['allocation']) : null;
        if ($allocations) {
            foreach ($allocations as $allocation) {
                Allocation::firstOrCreate(['name' => $allocation]);
            }
        }

        foreach ($image_exts as $ext) {
            if(Storage::exists('images/'.$row['part_number'].$ext)){
                $datastring = file_get_contents(Storage::path('images/'.$row['part_number'].$ext));
                $data = unpack("H*hex", $datastring);
                $img_binary = $data['hex'];
                break;
            }
        }

        return new Item([
            'part_number' => $row['part_number'],
            'chinese_name' => $row['chinese_name'],
            'description' => $row['description'],
            'group_id' => $group->id,
            'category_id' => $category? $category->id : null,
            'vendor_id' => $row['vendor']? $vendor->id : null,
            'allocation' => $allocations? implode(",",$allocations) : null,
            'item_type_id' => $item_type? $item_type->id : null,
            'unit_id' => $unit->id,
            'item_location_id' => $item_location? $item_location->id : null,
            'min' => $row['min']? $row['min'] : 0,
            'max' => $row['max'],
            'lead_time' => $row['lead_time'],
            'department_id' => $department->id,
            'site_id' => $site->id,
            'price' => $row['price'],
            'status' => $status,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'image' => \DB::raw('0x'.$img_binary),
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
