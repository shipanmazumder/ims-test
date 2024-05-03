<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = ['category_id', 'product_name', 'selling_price',"restaurant_id","deleted_at","created_at","updated_at"];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }
}
