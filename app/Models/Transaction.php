<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'transaction_number',
        'requested_by',
        'station_id',
        'location_id',
        'shift_id',
        'updated_by',
        'department_id',
        'site_id',
        'transaction_type_id',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    public function all_history()
    {
        return $this->hasMany(TransactionHistory::class);
    }

    public function latest_history()
    {
        return $this->hasOne(TransactionHistory::class)->latestOfMany();
    }
}
