<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItemList extends Model
{
    // テーブル定義
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $guarded = [
    ];

    protected $fillable = [
        'id','sale_user_id',
        'item_title',
        'item_description',
        'start_price',
        'expired_date'
    ];

    protected $casts = [
        'expired_date' => 'datetime',
    ];
}
