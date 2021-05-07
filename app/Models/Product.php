<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pipeline\Pipeline;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'name',
        'price',
        'vendor_id',
        'sold_times',
        'currency'
    ];

    protected $casts = [
        'price' => 'float',
        'vendor_id' => 'integer',
        'sold_times' => 'integer',
    ];

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function votes()
    {
        return $this->hasMany(Vote::class, 'product_id');
    }

    public static function filtered()
    {
        return app(Pipeline::class)
            ->send(self::query())
            ->through([
                \App\QueryFilters\Name::class,
                \App\QueryFilters\Price::class,
                ])
            ->thenReturn();
    }
}
