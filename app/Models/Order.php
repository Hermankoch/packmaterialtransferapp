<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function orderLines()
    {
        return $this->hasMany(OrderLine::class);
    }
    public function fromWarehouse()
    {
        //get warehouse by from_warehouse
        return $this->hasOne(Warehouse::class, 'id', 'from_warehouse');
    }
    public function toWarehouse()
    {
        return $this->hasOne(Warehouse::class, 'id', 'to_warehouse');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }


}
