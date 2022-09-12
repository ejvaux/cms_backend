<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'part_number',
        'chinese_name',
        'description',
        'category_id',
        'vendor_id',
        'allocation',
        'item_type_id',
        'unit_id',
        'item_location_id',
        'min',
        'max',
        'lead_time',
        'department_id',
        'site_id',
        'price',
        'status',
        'image',
        'created_at',
        'updated_at',
    ];
}
